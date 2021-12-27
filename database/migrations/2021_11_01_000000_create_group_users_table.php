<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->boolean('1_1')->default(false);
            $table->boolean('1_2')->default(false);
            $table->boolean('1_3')->default(false);
            $table->boolean('1_4')->default(false);
            $table->boolean('2_1')->default(false);
            $table->boolean('2_2')->default(false);
            $table->boolean('2_3')->default(false);
            $table->boolean('2_4')->default(false);
            $table->boolean('3_1')->default(false);
            $table->boolean('3_2')->default(false);
            $table->boolean('3_3')->default(false);
            $table->boolean('3_4')->default(false);
            $table->boolean('4_1')->default(false);
            $table->boolean('4_2')->default(false);
            $table->boolean('4_3')->default(false);
            $table->boolean('4_4')->default(false);
            $table->boolean('5_1')->default(false);
            $table->boolean('5_2')->default(false);
            $table->boolean('5_3')->default(false);
            $table->boolean('5_4')->default(false);
            $table->boolean('6_1')->default(false);
            $table->boolean('6_2')->default(false);
            $table->boolean('6_3')->default(false);
            $table->boolean('6_4')->default(false);
            $table->boolean('7_1')->default(false);
            $table->boolean('7_2')->default(false);
            $table->boolean('7_3')->default(false);
            $table->boolean('7_4')->default(false);
            $table->boolean('8_1')->default(false);
            $table->boolean('8_2')->default(false);
            $table->boolean('8_3')->default(false);
            $table->boolean('8_4')->default(false);
            $table->boolean('9_1')->default(false);
            $table->boolean('9_2')->default(false);
            $table->boolean('9_3')->default(false);
            $table->boolean('9_4')->default(false);
            $table->boolean('10_1')->default(false);
            $table->boolean('10_2')->default(false);
            $table->boolean('10_3')->default(false);
            $table->boolean('10_4')->default(false);
            $table->boolean('11_1')->default(false);
            $table->boolean('11_2')->default(false);
            $table->boolean('11_3')->default(false);
            $table->boolean('11_4')->default(false);
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
        Schema::dropIfExists('group_users');
    }
}
