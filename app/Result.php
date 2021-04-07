<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'semester',
        'att_days',
        'att_weighted',
        'ct1_obtained',
        'ct1_weighted',
        'ct2_obtained',
        'ct2_weighted',
        'ct3_obtained',
        'ct3_weighted',
        'ct_weighted',
        'mid_obtained',
        'final_obtained',
        'total_weighted',
        'letter_grade',
        'offered_courses_id',
        'stu_id',
    ];
}
