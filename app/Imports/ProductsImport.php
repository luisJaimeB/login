<?php

namespace App\Imports;

use App\Constants\ImportStatus;
use App\Models\Import;
use App\Models\Product;
use App\Models\Category;
use App\Rules\ProductRules;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\ImportFailed;

class ProductsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation, SkipsOnFailure, ShouldQueue, WithEvents
{
    use Importable;

    private Collection $categories;
    private Import $import;

    public function __construct(Import $import)
    {
        $this->import = $import;
        $this->categories = Category::pluck('id', 'name');
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name' => $row['name'],
            'description' => $row['description'],
            'price' => $row['price'],
            'category_id' => $this->categories[$row['category']],
            'quantity' => $row['quantity'],
            'status' => $row['status'],
        ]);
    }
    
    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function rules(): array
    {
        return ProductRules::toArray();
    }

    public function onFailure(Failure ...$failures)
    {
        $errors = collect();

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
            BeforeImport::class => function(BeforeImport $event) {
                $this->import->update(['import_status' => ImportStatus::PROCESSING]);
                Log::channel('imports')->info('processing');
            },
            AfterImport::class => function(AfterImport $event) {
                $this->import->refresh();
                if (!$this->import->completeWithErrors()) {
                    $this->import->update(['import_status' => ImportStatus::COMPLETE]);
                }
                Log::channel('imports')->info('complete');
            },
            ImportFailed::class => function (ImportFailed $event){
                $this->import->update(['import_status' => ImportStatus::FAILED]);
                Log::channel('imports')->info('fail');
            }

        ];
    }
}
