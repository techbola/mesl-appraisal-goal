<?php

namespace Cavidel\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateValueDateYear implements Rule
{

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
        $current_year = \Carbon\Carbon::now()->format('Y');
        foreach ($value as $key => $val) {
            $selected_year = \Carbon\Carbon::parse($val)->format('Y');
            if ($selected_year < $current_year) {
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Value Date can\'t be below ' . \Carbon\Carbon::now()->format('Y');
    }
}
