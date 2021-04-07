<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TotalError implements Rule
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
        $ct_marks = request()->ct_marks;
        $mid_marks = request()->mid_marks;
        $final_marks = request()->final_marks;

        return $att_marks != null && $ct_marks != null && $mid_marks != null && $final_marks != null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "*Make sure all of Attendance, CT/ Lab Performance, Mid-Term & Final's Marks are Set.";
    }
}
