<?php

use App\Constants\InvoiceStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 32)->unique();
            $table->unsignedBigInteger('request_id')->nullable();
            $table->decimal('total', 10, 2);
            $table->enum('invoice_status', InvoiceStatus::toArray())->default(InvoiceStatus::PENDING);
            $table->string('issuer_name')->nullable();
            $table->string('payment_method_name')->nullable();
            $table->date('date')->nullable();
            $table->timestamp('payment_expiration');
            $table->foreignId('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
