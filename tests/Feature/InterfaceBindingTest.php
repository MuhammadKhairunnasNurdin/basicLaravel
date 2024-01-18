<?php

namespace Tests\Feature;

use App\TestInterface\HelloService;
use App\TestInterface\Implementor;
use Tests\TestCase;

class InterfaceBindingTest extends TestCase
{
    public function testInterfaceToClass()
    {
        /**
         * so interface in default way can't be instantiated, except if you
         * pass object like this: InterfaceName implementorObject, so in
         * here with singleton, bind you can do dependency injection on interface just as simple lke this
         */
        $this->app->singleton(HelloService::class, Implementor::class);

        $helloService = $this->app->make(HelloService::class);
        self::assertEquals('hey anas', $helloService->hello('anas'));

        /**
         * you can make with closure like this
         */
        $this->app->bind(HelloService::class, function () {
            return new Implementor();
        });

        $helloService2 = $this->app->make(HelloService::class);

        self::assertNotSame($helloService, $helloService2);
    }
}
