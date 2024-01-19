<?php

namespace Tests\Feature;

use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testBasicRouting()
    {
        $this->get('/testRoute')
            ->assertStatus(200)
            ->assertSeeText('hey this is a test route');
    }

    public function testRedirectRouting()
    {
        $this->get('/testRedirect')
            ->assertRedirect('/testRoute');
    }

    public function testNotExistRoute()
    {
        $this->get('notExist')
            ->assertSeeText('404 custom page');
    }
}
