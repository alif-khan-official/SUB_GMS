<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllCourse extends Model
{
    protected $fillable = [
        'course_code',
        'course_name',
        'course_type',
        'department_id'
    ];
}

