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
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('room_category_id')->references('id')->on('room_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('payment_method_id')->nullable()->references('id')->on('payment_methods')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('room_id')->nullable()->references('id')->on('rooms')->onUpdate('cascade')->onDelete('cascade');
            $table->string('number');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('guest');
            $table->enum('status', ['active', 'inactive', 'canceled', 'waiting', 'payment', 'confirmation'])->default('waiting');
            $table->string('payment_slip')->nullable();
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
