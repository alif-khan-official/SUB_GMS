<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AttendanceError01 implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $att_marks = request()->att_marks;
        $total_classes = request()->total_classes;

        return $att_marks != null && $total_classes != null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "*Make sure both Number of Taken Classes & Attendance's Total Mark are Set.";
    }
}
