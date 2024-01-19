<?php

namespace App\TestFacades\FacadeExtensor;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string hey()
 * @method static array bro()
 * @method static string paramTest(string $arg)
 *
 * @see \App\TestFacades\OriginalClass
 */
class AccessingOriginalClass extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'originalClass';
    }
}
