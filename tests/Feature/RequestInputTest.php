<?php

namespace Tests\Feature;

use Tests\TestCase;

class RequestInputTest extends TestCase
{
    public function testAllInput()
    {
        $this->get('/testAllInput?arr[]=1&arr[]=2&arr[]=3&4')
            ->assertContent('{"arr":["1","2","3"],"4":null}');

        $this->post('/testAllInput', ['arr' => [1, 2, 3], 4, 5, 'six' => 6, 7])
            ->assertContent('{"arr":[1,2,3],"0":4,"1":5,"six":6,"2":7}');
    }

    public function testCollectWithAvgMethodInInput()
    {
        $this->get('/testCollectInput?1&2&3&4')
            ->assertContent('2.5');

        $this->post('/testCollectInput', [1, 2, 3, 4])
            ->assertContent('2.5');
    }

    public function testInputMethod()
    {
        $this->get('/testInput?nameVar=10')
            ->assertContent('10');

        $this->post('/testInput', [1, 2, 3, 4, 'nameVar' => 30])
            ->assertContent('30');
    }

    public function testInputNoArg()
    {
        $this->get('/testInputNoArg?10&11&12&nameVar=13')
            ->assertContent('{"10":null,"11":null,"12":null,"nameVar":"13"}');

        $this->post('/testInputNoArg', [10, 11, 12, 'nameVar' => '13'])
            ->assertContent('{"0":10,"1":11,"2":12,"nameVar":"13"}');
    }

    public function testInputArray()
    {
        $this->post('/testInputArray', [
            'key1' => [
                'keyA' => [
                    'key3' => 1,
                ],
                'keyB' => [
                    'key3' => 2,
                ],
                'keyC' => [
                    3,
                ],
            ],
        ])
            ->assertContent('[1,2,null]');
    }
}
