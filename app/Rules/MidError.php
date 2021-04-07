<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MidError implements Rule
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
        $mid_marks = request()->mid_marks;

        return $mid_marks != null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "*First Set Mid-Term's Total Mark.";
    }
}
