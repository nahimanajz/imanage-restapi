<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebitPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debit_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->unsignedBigInteger('debit_id');        
            $table->foreign('debit_id')->references('id')->on('debits')
                    ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('debit_payments');
    }
}
