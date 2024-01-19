<?php

namespace App\TestFacades\FacadeExtensor;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string hey()
 * @method static array bro()
 *
 * @see \App\TestFacades\MainClass
 */
class MainClass extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'mainclass';
    }
}
