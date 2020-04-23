<?php


namespace RKocak\Options\Facades;


use Illuminate\Support\Facades\Facade;

class Options extends Facade
{

    protected static function getFacadeAccessor()
    {
        return \RKocak\Options\Contracts\Options::class;
    }

}