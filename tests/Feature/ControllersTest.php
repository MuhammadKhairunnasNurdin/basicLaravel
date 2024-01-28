<?php

namespace Tests\Feature;

use Tests\TestCase;

class ControllersTest extends TestCase
{
    public function testBasicController()
    {
        $this->get('/testController')
            ->assertContent('hello from TestController');
    }

    public function testSingleActionController()
    {
        $this->get('/singleActionController/ten')
            ->assertContent('from dependency and dependent: ten');
    }
}
