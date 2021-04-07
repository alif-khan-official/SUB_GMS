<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(/**
         * @param Blueprint $table
         */ 'results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('att_days')->nullable();
            $table->decimal('att_weighted')->nullable();
            $table->decimal('ct1_obtained')->nullable();
            $table->decimal('ct1_weighted')->nullable();
            $table->decimal('ct2_obtained')->nullable();
            $table->decimal('ct2_weighted')->nullable();
            $table->decimal('ct3_obtained')->nullable();
            $table->decimal('ct3_weighted')->nullable();
            $table->decimal('ct_weighted')->nullable();
            $table->decimal('mid_obtained')->nullable();
            $table->decimal('final_obtained')->nullable();
            $table->decimal('total_weighted')->nullable();
            $table->string('letter_grade')->nullable();
            $table->unsignedBigInteger('offered_courses_id');
            $table->string('stu_id');
            $table->timestamps();

            $table->foreign("offered_courses_id")->references("id")->on("offered_courses");
            $table->foreign("stu_id")->references("stu_id")->on("students");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
