<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/hello', function () {
    // return 'Hello world!';
    $title = "laravel";
    // return view('hello', ['title'=>"World" ]);
    return view('hello', compact('title'));

});

Route::get('/home', 'App\Http\Controllers\HomeController@index');

Route::get('/about', 'App\Http\Controllers\AboutController');



