<?php


namespace RKocak\Options;


use RKocak\Options\Models\Option;

abstract class Type
{

    /**
     * @return string
     */
    abstract public static function getName(): string;

    /**
     * @param $value
     * @return mixed
     */
    abstract public function cast($value);

    /**
     * @param $newValue
     * @param $oldValue
     * @return mixed
     */
    abstract public function store($newValue, $oldValue);

    /**
     * @param Option $option
     * @return string
     */
    public function render(Option $option): string
    {
        return '<div></div>';
    }

}