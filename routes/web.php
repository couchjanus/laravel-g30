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

Route::get('/home', function () {
    return view('index');
})->name('home');

Route::get('/hello', function () {
    // return 'Hello world!';
    $title = "laravel";
    // return view('hello', ['title'=>"World" ]);
    return view('hello', compact('title'));

});

// Route::get('/home', 'App\Http\Controllers\HomeController@index');

// Route::get('/about', 'App\Http\Controllers\AboutController');
Route::get('about', App\Http\Controllers\AboutController::class)->name('about');

Route::get('/hello/{name}', function () {
    return "hello world";
})->where('name', '[A-Za-z]+');

Route::get('/hello/{id?}', function () {
    return "hello world";
})->where('id', '[0-9]+');

Route::get('/hello/{string}/{id?}', function () {
    return "hello world";
})->where(['id'=>'[0-9]+', 'string'=> '[A-Za-z]+']);


use App\Http\Controllers\PostController;

Route::controller(PostController::class)->group(function() {
    Route::get('blog', 'index')->name('blog');
    Route::get('blog/{id}', 'show');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
