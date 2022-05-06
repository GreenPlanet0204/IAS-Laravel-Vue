<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->unsignedBigInteger('app_id');
            $table->foreign('app_id')->references('id')->on('applications')->onDelete('CASCADE');
            $table->string('transaction_id')->unique()->nullable();
            $table->string('transaction_status')->nullable();
            $table->integer('transaction_price')->nullable();
            $table->string('payee_email')->nullable();
            $table->string('payee_id')->nullable();
            $table->string('payer_email')->nullable();
            $table->string('payer_id')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
