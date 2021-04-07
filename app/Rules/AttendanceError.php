<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AttendanceError implements Rule
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
        return $att_marks != null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "*First Set Attendance's Total Mark.";
    }
}
