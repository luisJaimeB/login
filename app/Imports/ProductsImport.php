<?php

namespace App\Imports;

use App\Constants\ImportStatus;
use App\Models\Import;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\ImportFailed;
use PHPUnit\Util\InvalidDataSetException;

class ProductsImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading, SkipsOnFailure, ShouldQueue, WithEvents
{
    use Importable;

    private array $errors = [];
    private Import $import;

    public function __construct(Import $import)
    {
        $this->import = $import;
    }

    public function collection(Collection $rows)
    {
         $validator = Validator::make($rows->toArray(), [
            '*.id' => ['nullable', 'exists:products,id'],
            '*.name' => ['required', 'max:50'],
            '*.description' => ['required','min:50','max:340'],
            '*.price' => ['required'],
            '*.quantity' => ['required'],
            '*.category_id' => ['required', 'int', 'exists:categories,id'],
            '*.status' => ['required', 'int', 'in:0,1'],
         ]);

         if ($validator->fails()) {
            throw new InvalidDataSetException($validator->errors()->toJson());
         }

        foreach ($rows as $row) {
            if (isset($row['id'])) {
                Product::where('id', $row['id'])->update($row->except(['id'])->toArray());
            } else {
                Product::create($row->toArray());
            }
            
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function onFailure(Failure ...$failures)
    {
        $errors = collect();
        info('onFailure');

        foreach ($failures as $failure) {
            $errors->push([
                    'row' => $failure->row(),
                    'attribute' => $failure->attribute(),
                    'errors' => $failure->errors(),
                    'values' => $failure->values(),
                ]);
        }
        if (!empty($errors)) {
            $this->import->update(['errors' => $errors->toJson()]);
            $this->import->update(['import_status' => ImportStatus::COMPLETERRORS]);
            Log::channel('imports')->info('complete with errors');
        }
    }

    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function (BeforeImport $event) {
                $this->import->update(['import_status' => ImportStatus::PROCESSING]);
                Log::channel('imports')->info('processing');
            },
            AfterImport::class => function (AfterImport $event) {
                $this->import->refresh();
                if (!$this->import->completeWithErrors()) {
                    $this->import->update(['import_status' => ImportStatus::COMPLETE]);
                }
                Log::channel('imports')->info('complete');
            },
            ImportFailed::class => function (ImportFailed $event) {
                $this->import->update([
                    'errors' => $event->getException()->getMessage(),
                    'import_status' => ImportStatus::FAILED
                ]);
                Log::channel('imports')->info('fail');
            }

        ];
    }
}
