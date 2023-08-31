<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GreaterThanFieldRule implements Rule
{
    protected $field;

    // protected $rule = 'max_bytes';
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($field)
    {
        $this->field = $field;
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
        return $value > request()->input($this->field);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be greater than'.$this->field;
    }
}
