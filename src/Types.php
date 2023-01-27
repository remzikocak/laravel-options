<?php

namespace RKocak\Options;

use InvalidArgumentException;

class Types
{
    /**
     * @var array
     */
    protected array $types = [];

    /**
     * @param  string  $class
     * @return bool
     */
    public function add(string $class): bool
    {
        if (! class_exists($class)) {
            throw new InvalidArgumentException('Class does not exists!');
        }

        $type = new $class;

        if (! $type instanceof Type) {
            throw new InvalidArgumentException('Class should extend Type class');
        }

        $this->types[$class::getName()] = $type;

        return true;
    }

    /**
     * @param  string  $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return array_key_exists($name, $this->types);
    }

    /**
     * @param  string  $name
     * @return Type
     */
    public function get(string $name): Type
    {
        if (! $this->has($name)) {
            throw new InvalidArgumentException('Option type does not exist!');
        }

        return $this->types[trim($name)];
    }
}
