<?php


namespace RKocak\Options\Facades;


use Illuminate\Support\Facades\Facade;
use RKocak\Options\Loader;
use RKocak\Options\Types;

/**
 * @method static mixed get(string $key, $default = null)
 * @method static bool has(string $key)
 * @method static Types getTypes()
 * @method static Loader getLoader()
 * @method static void load()
 */
class Options extends Facade
{

    protected static function getFacadeAccessor()
    {
        return \RKocak\Options\Contracts\Options::class;
    }

}