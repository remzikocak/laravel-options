<?php

namespace RKocak\Options\Types;

use RKocak\Options\Models\Option;
use RKocak\Options\Type;

class Number extends Type
{

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'number';
    }

    /**
     * @param Option $option
     * @return string
     */
    public function render(Option $option): string
    {
        return '<div>
    <input type="number" name="options['. htmlspecialchars($option->name) .']" id="options['. htmlspecialchars($option->name) .']" value="'. htmlspecialchars($option->getValue()) .'" class="form-input mt-1 block w-full"/>
</div>';
    }

    /**
     * @param $newValue
     * @param $oldValue
     * @return mixed
     */
    public function store($newValue, $oldValue)
    {
        return $newValue;
    }

    /**
     * @param $value
     * @return mixed|string
     */
    public function cast($value)
    {
        return (int) $value;
    }

}