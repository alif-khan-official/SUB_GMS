<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'id',
        'stu_id',
        'batch',
        'department_id',
        'program_id',
    ];
}
