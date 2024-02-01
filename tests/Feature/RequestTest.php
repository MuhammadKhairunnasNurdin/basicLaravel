<?php

namespace Tests\Feature;

use Tests\TestCase;

class RequestTest extends TestCase
{
    public function testPathRequest()
    {
        $this->get('/requestPath')
            ->assertContent('requestPath');
    }

    public function testUrlRequest()
    {
        $this->get('/requestUrl/name?value=50')
            ->assertContent('http://localhost:81/requestUrl/name');
    }

    public function testFullUrlRequest()
    {
        $this->get('/requestFullUrl/name?value=50')
            ->assertContent('http://localhost:81/requestFullUrl/name?value=50');
    }

    public function testIsMethodRequest()
    {
        $this->get('/checkHttpVerb1')
            ->assertContent('get');

        $this->post('/checkHttpVerb2')
            ->assertContent('post');
    }

    public function testHeaderRequest()
    {
        /**
         * if header isn't provides, will return empty string('')
         */
        $this->get('/checkHeader')
            ->assertContent('');

        /**
         * We can mock header with array like this
         */
        $this->get('/checkHeader', ['X-Whatever' => 'this value'])
            ->assertContent('this value');
    }

    public function testHostRequest()
    {
        $this->get('/checkHost')
            ->assertContent('localhost');

        /**
         * unlike method host() in Request, httpHost() method return host with port
         */
        $this->get('/checkHttpHost')
            ->assertContent('localhost:81');

        /**
         * unlike method host() in Request, schemeHttpHost() method return full host like
         *
         * http://localhost with port
         *
         * and became http://localhost:81
         */
        $this->get('/checkSchemeHttpHost')
            ->assertContent('http://localhost:81');
        $this->get('/checkSchemeHttpHost/added')
            ->assertContent('http://localhost:81');
    }
}
