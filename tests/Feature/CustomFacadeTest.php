<?php

namespace Tests\Feature;

use App\TestFacades\FacadeExtensor\AccessingOriginalClass;
use Tests\TestCase;

class CustomFacadeTest extends TestCase
{
    public function testCustomFacade()
    {
        $hey = AccessingOriginalClass::hey();
        $bro = AccessingOriginalClass::bro();

        self::assertEquals('hey bro', $hey);
        self::assertEquals(['hey', 'anas'], $bro);
    }
}
