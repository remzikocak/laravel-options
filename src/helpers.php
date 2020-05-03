<?php

/**
 * @param string $name
 * @param null $default
 * @return mixed
 */
function options(string $name, $default = null)
{
    return \RKocak\Options\Facades\Options::get($name, $default);
}