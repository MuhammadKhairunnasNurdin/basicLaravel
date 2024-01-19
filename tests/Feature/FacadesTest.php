<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadesTest extends TestCase
{
    public function testFacades()
    {
        $helperFunc = config('author.first');
        $facades = Config::get('author.first');

        self::assertEquals($helperFunc, $facades);
    }
}
