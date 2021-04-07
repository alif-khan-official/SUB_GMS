<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferedCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offered_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('year');
            $table->string('semester');
            $table->integer('total_classes')->nullable();
            $table->integer('att_marks')->nullable()->default(10);
            $table->string('ct')->nullable()->default("Best Two(Average)");
            $table->integer('ct1_marks')->nullable()->default(20);
            $table->integer('ct2_marks')->nullable()->default(20);
            $table->integer('ct3_marks')->nullable();
            $table->integer('ct_marks')->nullable()->default(20);
            $table->integer('mid_marks')->nullable()->default(30);
            $table->integer('final_marks')->nullable()->default(40);
            $table->integer('total_marks')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('all_course_id');
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("department_id")->references("id")->on("departments");
            $table->foreign("all_course_id")->references("id")->on("all_courses");
            $table->foreign("program_id")->references("id")->on("programs");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offered_courses');
    }
}
