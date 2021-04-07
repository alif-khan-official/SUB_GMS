<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferedCourse extends Model
{
    protected $fillable = [
        'user_id',
        'year',
        'semester',
        'total_classes',
        'att_marks',
        'ct1_marks',
        'ct2_marks',
        'ct3_marks',
        'ct_marks',
        'mid_marks',
        'final_marks',
        'total_marks',
        'ct',
        'status',
        'department_id',
        'all_course_id',
        'program_id'
    ];
}
