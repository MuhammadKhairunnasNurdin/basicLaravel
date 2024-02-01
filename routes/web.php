<?php

use App\Http\Controllers\DependentDependencyController;
use App\Http\Controllers\SingleActionController;
use App\Http\Controllers\TryBasicController;
use App\Http\Controllers\TryDependencyInjectionController;
use App\Http\Controllers\TryRequestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Inertia\Inertia;

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

/**
 * Route for Inertia Svelte
 */
Route::get('/testSvelte', function () {
    return Inertia::render('Test');
});

/**
 * Route for Required parameters
 */
Route::get('/param1/{arg}/param2/{arg2}', function (string $arg, int $arg2) {
    return "param 1: $arg, param 2: $arg2";
});

/**
 * Route for Optional parameters
 */
Route::get('/required/{arg}/optional/{arg2?}', function ($arg, ?string $arg2 = 'default') {
    return "Required param: $arg, Optional param: $arg2";
});

/**
 * Route for Regex manual
 */
Route::get('/testRegex/{arg}', function ($arg) {
    return "Test regex: $arg";
})->where('arg', '[0-9]+');

/**
 * Route for Regex with helper function
 */
Route::get('/testRegex2/{arg}', function ($arg) {
    return "Test regex: $arg";
})->whereNumber('arg');

/**
 * Route for Global constraint regex. In this case Just Alphabetical
 */
Route::get('/globalRegex/{globalRegexTest}', function ($globalRegexTest) {
    // Only executed if {globalRegexTest} is alphabetic...
    return "Global regex: $globalRegexTest";
});

/**
 * Route for Conflict test
 *
 * if name = 'anas', First route that will be executed
 */
Route::get('/conflict/anas', function () {
    return 'Second conflict';
});
Route::get('/conflict/{name}', function ($name) {
    return "First conflict: $name";
});

/**
 * Route for named routing
 */
Route::get('/namedRoute/{id?}', function (?int $id = null) {
    return 'Id: '.$id;
})->name('named.route');
Route::get('/UrlsTest/{data}', function ($data) {
    $ulr = route('named.route');

    return 'From UrlsTest: '.$data.' ;retrieved data: '.$ulr;
})->name('named.route.UrlsTest');
Route::get('/namedRedirect/{data}', function ($data) {
    return to_route('named.route', ['id' => $data]);
});

/**
 * Route for basic controller
 */
Route::get('/testController', [TryBasicController::class, 'index']);

/**
 * Route for test Dependency Injection for controller
 */
Route::get('/dependencyController', [TryDependencyInjectionController::class, 'dependencyInjection']);

/**
 * Route for instance that dependent in other dependency
 *
 * Here also example how parameter processed by controller,
 *
 * as you can see, you just need to make param in {} like usually
 */
Route::get('/dependentController/{arg}', [DependentDependencyController::class, 'getDependentFunc']);

/**
 * Route for Single Action Controller
 */
Route::get('/singleActionController/{param}', SingleActionController::class);

/**
 * Route for Path() Request method
 */
Route::get('/requestPath', [TryRequestController::class, 'requestPath']);

/**
 * Route for url() Request method
 */
Route::get('/requestUrl/{arg}', [TryRequestController::class, 'requestUrlWithoutQueryString']);

/**
 * Route for fullUrl() Request method
 */
Route::get('/requestFullUrl/{param}', [TryRequestController::class, 'requestUrlWithQueryString']);

/**Route for Check Http verb*/
Route::get('/checkHttpVerb1', [TryRequestController::class, 'checkHttpVerb']);
Route::post('/checkHttpVerb2', [TryRequestController::class, 'checkHttpVerb']);

/**
 * Route for Header test
 */
Route::get('/checkHeader', [TryRequestController::class, 'testHeader']);
