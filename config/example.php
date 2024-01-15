<?php

/*usually in config setting, you can use env() function for value*/
return [
    'author' => [
        'first' => env('FIRST_NAME', 'Anas'),
        'last' => env('LAST_NAME', 'Nurdin'),
    ],
    'email' => 'anasnurdin936@gmail.com',
];
