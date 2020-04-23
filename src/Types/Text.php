<?php

namespace RKocak\Options\Types;

use RKocak\Options\Models\Option;
use RKocak\Options\Type;

class Text extends Type
{

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'text';
    }

    /**
     * @param Option $option
     * @return string
     */
    public function render(Option $option): string
    {
        return '<div>
    <input type="text" name="options['. htmlspecialchars($option->name) .']" id="options['. htmlspecialchars($option->name) .']" value="'. htmlspecialchars($option->getValue()) .'" class=""/>
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
        return (string) $value;
    }

}