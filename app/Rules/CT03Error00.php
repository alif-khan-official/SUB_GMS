<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CT03Error00 implements Rule
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
        $ct1_obtained = request()->ct1_obtained;
        $ct2_obtained = request()->ct2_obtained;

        return $ct1_obtained != null && $ct2_obtained != null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "*First Fill Up both CT-01's & CT-02's Obtained Mark.";
    }
}
