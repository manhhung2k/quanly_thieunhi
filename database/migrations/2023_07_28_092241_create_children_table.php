<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date')->nullable();
            $table->string('strawberry_church')->nullable();
            $table->string('academy_year')->nullable();
            $table->string('parents')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('gender')->nullable();
            $table->string('parish')->nullable();
            $table->string('mid_semester_1')->nullable();
            $table->string('semester_1')->nullable();
            $table->string('mid_semester_2')->nullable();
            $table->string('semester_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel');
    }
};
