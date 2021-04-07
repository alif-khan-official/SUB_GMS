<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class LabPerformanceError implements Rule
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
        $ct_marks = request()->ct_marks;

        return !($ct_marks != null && $value > $ct_marks);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "*Lab Performance's Obtained Mark can't be more than Lab Performance's Total Mark.";
    }
}
