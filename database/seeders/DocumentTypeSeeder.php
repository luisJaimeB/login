<?php

namespace Database\Seeders;

use App\Constants\DocumentTypes;
use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (DocumentTypes::toArray() as $documentType) {
            DocumentType::create([
                'type' => $documentType
            ]);
        }
    }
}
