<?php


namespace RKocak\Options\Contracts;


interface Options
{

    public function get(string $name, $default = null);

    public function has(string $name): bool;

    public function load(): void;

}