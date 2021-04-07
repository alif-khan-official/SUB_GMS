<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CTError01 implements Rule
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
        $ct2_marks = request()->ct2_marks;

        return $ct1_marks != null && $ct2_marks != null;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "*At least Two(2) CTs must be taken.";
    }
}
