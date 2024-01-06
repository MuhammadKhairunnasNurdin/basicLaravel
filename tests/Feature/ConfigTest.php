<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigTest extends TestCase
{
    public function testGetConfig()
    {
        $firstName = config("example.author.first", "Default_First");
        $lastName = config("example.author.last", "Default_Last");
        $email = config("example.email", "Default_Email");

        self::assertEquals("Anas", $firstName);
        self::assertEquals("Nurdin", $lastName);
        self::assertEquals("anasnurdin936@gmail.com", $email);
    }
}
