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


// Route::get('/home', 'App\Http\Controllers\HomeController@index');


Route::get('about', App\Http\Controllers\AboutController::class)->name('about');

use App\Http\Controllers\PostController;

Route::controller(PostController::class)->group(function() {
    Route::get('blog', 'index')->name('blog');
    Route::get('blog/{id}', 'show');
});



use App\Http\Controllers\Admin\{DashboardController, BrandController};
use App\Livewire\Admin\Categories\{CategoryList,};

Route::prefix('admin')->group(function() {
    Route::get('', DashboardController::class)->name('admin');
   
    Route::controller(BrandController::class)->group(function () {
        Route::get('brands/trashed', 'trashed')->name('brands.trashed');
        Route::post('brands/restore/{id}', 'restore')->name('brands.restore');
        Route::delete('brands/force/{id}', 'force')->name('brands.force');
    });
    Route::get('categories', CategoryList::class);
    Route::resource('brands', BrandController::class);
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
