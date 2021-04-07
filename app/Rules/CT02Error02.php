<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CT02Error02 implements Rule
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
        $ct2_marks = request()->ct2_marks;

        return !($ct2_marks != null && $value > $ct2_marks);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "*CT-02's Obtained Mark can't be more than CT-02's Total Mark.";
    }
}
