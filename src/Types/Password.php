<?php

namespace RKocak\Options\Types;

use RKocak\Options\Models\Option;
use RKocak\Options\Type;

class Password extends Type
{

    /**
     * @var string
     */
    protected string $defaultValue = '******';

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'password';
    }

    /**
     * @param Option $option
     * @return string
     */
    public function render(Option $option): string
    {
        return '<div>
    <input type="password" name="options['. htmlspecialchars($option->name) .']" id="options['. htmlspecialchars($option->name) .']" value="'. $this->value .'" class="form-input mt-1 block w-full"/>
</div>';
    }

    /**
     * @param $newValue
     * @param $oldValue
     * @return mixed
     */
    public function store($newValue, $oldValue)
    {
        if($newValue == $this->defaultValue)
        {
            return $oldValue;
        }

        return $newValue;
    }

    /**
     * @param $value
     * @return mixed|string
     */
    public function cast($value)
    {
        return (string) $value;
    }

}