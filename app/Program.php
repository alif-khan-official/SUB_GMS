<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'prog_code',
        'prog_name',
        'department_id',
    ];
}
