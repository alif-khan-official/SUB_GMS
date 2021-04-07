<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AttendanceError02 implements Rule
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
        return !($total_classes != null && $att_marks != null && $value > $total_classes);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "*Number of 'Attended Classes' can't be more than Number of 'Taken Classes'.";
    }
}
