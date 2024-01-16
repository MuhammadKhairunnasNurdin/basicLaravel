<?php

namespace Tests\Feature;

use Illuminate\Support\Env;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class EnvironmentTest extends TestCase
{
    public function testGetEnv()
    {
        $newEnv = env('NEW_ENV_VAR');
        self::assertEquals('New Value', $newEnv);
    }

    public function testDefaultEnv()
    {
        /*if your ENV VAR exist, default value haven't picked*/
        $default = env('NOT_EXIST_KEY', 'THIS_DEFAULT_VALUE');
        /*another way to check environment var other than code above*/
        //$default = Env::get("NOT_EXIST_KEY", "THIS_DEFAULT_VALUE");
        assertEquals('THIS_DEFAULT_VALUE', $default);
    }
}
