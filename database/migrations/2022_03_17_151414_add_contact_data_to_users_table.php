<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContactDataToUsersTable extends Migration
{
    
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('identification_number', 20)->nullable();
            $table->foreignId('document_type_id')->nullable();
            $table->foreign('document_type_id')->references('id')->on('document_types');
            $table->string('last_name',30)->nullable();
            $table->string('mobile_number', 15)->nullable();
            $table->string('address', 50)->nullable();
            $table->string('postal_code', 10)->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
