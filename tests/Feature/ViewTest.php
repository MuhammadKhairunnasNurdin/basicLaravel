<?php

namespace Tests\Feature;

use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/urlName')
            ->assertStatus(200)
            ->assertSeeText('Hey test: BLADE');

        /**
         * remember assertSeeText() method just test prefix our echo text,
         * so rest of letter will ignored like this(actual letter is: 'Hey
         * test: BLADE2', but you can test just like below)
         */
        $this->get('/urlName2')
            ->assertSeeText('H');
    }

    public function testNestedView()
    {
        $this->get('/nestedView')
            ->assertSeeText('hey this:anas view from resource/views/nestedFolder/nestedView.blade.php');
    }

    public function testViewWithoutRoute()
    {
        /**
         * compare to get() method, view() method is stricter in param
         * assertSeeText() method, so will likely more accurate
         * I assume I don't had information regarding get() method in this
         * test, so you have to study again
         */
        $this->view('nestedFolder.viewWithoutRoute', ['name' => 'Anas'])
            ->assertSeeText('Hallo: Anas');
    }
}
