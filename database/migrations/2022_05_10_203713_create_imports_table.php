<?php

use App\Constants\ImportStatus;
use App\Constants\ImportType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportsTable extends Migration
{
    public function up(): void
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->json('errors')->nullable();
            $table->enum('import_type', ImportType::toArray());
            $table->enum('import_status', ImportStatus::toArray())->default(ImportStatus::PENDING);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imports');
    }
}
