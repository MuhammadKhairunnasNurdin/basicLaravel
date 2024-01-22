<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * Basic routing example
 */
Route::get('/testRoute', function () {
    return 'hey this is a test route';
});

/**
 * Router can be used to redirect from one page to another like this
 */
Route::redirect('/testRedirect', '/testRoute');

/**
 * Router to custom 404 page
 */
Route::fallback(function () {
    return '404 custom page';
});

/**
 * Route for view with single line
 */
Route::view('/urlName', 'bladeTest', ['name' => 'BLADE']);

/**
 * Route for view with closure
 */
Route::get('/urlName2', function () {
    return view('bladeTest', ['name' => 'BLADE2']);
});

/**
 * Route with Facade function
 */
Route::get('/urlName3', function () {
    return View::make('bladeTest', ['name' => 'BLADE3']);
});

/**
 * Route for nested view
 */
Route::view('/nestedView', 'nestedFolder.nestedView', ['name' => 'anas']);
