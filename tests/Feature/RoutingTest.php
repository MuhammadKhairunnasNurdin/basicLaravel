<?php

namespace Tests\Feature;

use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testBasicRouting()
    {
        $this->get('/testRoute')
            ->assertStatus(200)
            ->assertContent('hey this is a test route');
    }

    public function testRedirectRouting()
    {
        $this->get('/testRedirect')
            ->assertRedirect('/testRoute');
    }

    public function testNotExistRoute()
    {
        $this->get('notExist')
            ->assertContent('404 custom page');
    }

    public function testRequireRouteParameters()
    {
        $this->get('/param1/satu/param2/22')
            ->assertContent('param 1: satu, param 2: 22');
    }

    public function testOptionalRouteParameters()
    {
        $this->get('/required/2/optional/')
            ->assertContent('Required param: 2, Optional param: default');
    }

    public function testRegexManual()
    {
        $this->get('/testRegex/false')
            ->assertContent('404 custom page');

        $this->get('/testRegex/1')
            ->assertContent('Test regex: 1');
    }

    public function testRegexHelperFunc()
    {
        $this->get('/testRegex2/false')
            ->assertContent('404 custom page');

        $this->get('/testRegex2/1')
            ->assertContent('Test regex: 1');
    }

    public function testGlobalRegex()
    {
        $this->get('/globalRegex/10')
            ->assertContent('404 custom page');

        $this->get('/globalRegex/true')
            ->assertContent('Global regex: true');
    }

    public function testConflictRoute()
    {
        $this->get('/conflict/john')
            ->assertContent('First conflict: john');

        $this->get('/conflict/anas')
            ->assertDontSee('First conflict: anas')
            ->assertContent('Second conflict');
    }

    public function testNamedRoute()
    {
        $this->get('/UrlsTest/1')
            ->assertContent('From UrlsTest: 1 ;retrieved data: http://localhost/namedRoute');

        $this->get('/namedRedirect/10')
            ->assertRedirect('/namedRoute/10');
    }
}
