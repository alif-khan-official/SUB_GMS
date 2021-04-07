<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CT01Error02 implements Rule
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
        $ct1_marks = request()->ct1_marks;

        return !($ct1_marks != null && $value > $ct1_marks);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "*CT-01's Obtained Mark can't be more than CT-01's Total Mark.";
    }
}
