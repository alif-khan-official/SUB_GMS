<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CT03Error02 implements Rule
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
        $ct3_marks = request()->ct3_marks;

        return !($ct3_marks != null && $value > $ct3_marks);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "*CT-03's Obtained Mark can't be more than CT-03's Total Mark.";
    }
}
