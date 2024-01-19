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

    public function testMockingCustomFacade()
    {
        AccessingOriginalClass::shouldReceive('paramTest')
            ->with('this parameter')
            ->andReturn('mocking param');

        $paramTest = AccessingOriginalClass::paramTest('this parameter');

        self::assertEquals('mocking param', $paramTest);

        /**
         * if you mock your method, this hadn't return original value, but
         * will return whatever value in andReturn() method. If you try to
         * echo like this:
         *
         * will print 'mocking param' instead of 'param: this parameter'
         */
        echo $paramTest;
    }
}
