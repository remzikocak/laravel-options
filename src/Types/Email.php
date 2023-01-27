<?php

namespace RKocak\Options\Types;

use RKocak\Options\Type;

class Email extends Type
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'email';
    }

    /**
     * @param  Option  $option
     * @return string
     */
    public function render($option): string
    {
        return '<div>
    <input type="email" name="options['.htmlspecialchars($option->name).']" id="options['.htmlspecialchars($option->name).']" value="'.htmlspecialchars($option->getValue()).'" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
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
