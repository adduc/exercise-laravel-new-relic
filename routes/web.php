<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return <<<HTML
    <h1>New Relic Tests</h1>
    <ul>
        <li><a href="/example">Example Page</a></li>
        <li><a href="/exception">Exception</a></li>
        <li><a href="/error">Error</a></li>
    </ul>
    HTML;
});

Route::get('/example', [Controller::class, 'index']);

Route::get('/exception', function () {
    throw new \Exception("Test Exception");
});

Route::get('/error', function () {
    $a = 1;
    return $a[1];
});

Route::get('/phpinfo', function () {
    ob_start();
    phpinfo();
    $result = ob_get_clean();
    ob_end_clean();
    return $result;
});