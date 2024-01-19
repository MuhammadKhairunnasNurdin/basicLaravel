<?php

namespace Tests\Feature;

use App\TestFacades\FacadeExtensor\MainClass;
use Tests\TestCase;

class CustomFacadeTest extends TestCase
{
    public function testCustomFacade()
    {
        $hey = MainClass::hey();
        $bro = MainClass::bro();

        self::assertEquals('hey bro', $hey);
        self::assertEquals(['hey', 'anas'], $bro);
    }
}
