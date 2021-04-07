<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FinalError02 implements Rule
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
        $final_marks = request()->final_marks;

        return !($final_marks != null && $value > $final_marks);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "*Final's Obtained Mark can't be more than Final's Total Mark.";
    }
}
