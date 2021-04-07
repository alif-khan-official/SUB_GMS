<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('stu_id')->primary();
            $table->integer('batch');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('program_id');
            $table->timestamps();

            $table->foreign("department_id")->references("id")->on("departments");
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
        Schema::dropIfExists('students');
    }
}
