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

Route::get('/welcome', function () {
    return view('welcome');
});

// Route::get('/home', function () {
//     return view('index');
// })->name('home');


// Route::get('/home', 'App\Http\Controllers\HomeController@index');


Route::get('about', App\Http\Controllers\AboutController::class)->name('about');

use App\Livewire\Main\{HomePage, BlogPage, BlogShow};

Route::get('/', HomePage::class)->name('home');
Route::get('/blog', BlogPage::class)->name('blog');
Route::get('/blog/showe/{slug}', BlogShow::class)->name('blog.detail');

use App\Livewire\Main\{Catalog, ShoppingCart};
Route::get('/shop', Catalog::class)->name('shop');
Route::get('/shopping-cart', ShoppingCart::class)->name('shopping.cart');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout/order', [App\Http\Controllers\OrderController::class, 'placeOrder'])->name('checkout.place.order');
});

// use App\Http\Controllers\PostController;

// Route::controller(PostController::class)->group(function() {
//     Route::get('blog', 'index')->name('blog');
//     Route::get('blog/{id}', 'show');
// });

use App\Http\Controllers\Admin\{DashboardController, BrandController};
use App\Livewire\Admin\Categories\{CategoryList, CreateCategory, EditCategory};
use App\Livewire\Admin\Products\{ProductList, CreateProduct, UpdateProduct};
use App\Livewire\Admin\Posts\{PostList, CreatePost};
use App\Livewire\Admin\Tags\{TagList, CreateTag, EditTag};

Route::prefix('admin')->group(function() {
    Route::get('', DashboardController::class)->name('admin');

    Route::controller(BrandController::class)->group(function () {
        Route::get('brands/trashed', 'trashed')->name('brands.trashed');
        Route::post('brands/restore/{id}', 'restore')->name('brands.restore');
        Route::delete('brands/force/{id}', 'force')->name('brands.force');
    });
    Route::get('categories', CategoryList::class)->name('categories.index');
    Route::get('categories/create', CreateCategory::class)->name('categories.create');
    Route::get('categories/{category}/edit', EditCategory::class)->name('categories.edit');
    Route::resource('brands', BrandController::class);

    Route::get('products', ProductList::class)->name('products.index');
    Route::get('products/create', CreateProduct::class)->name('products.create');
    Route::get('products/{product}/edit', UpdateProduct::class)->name('products.edit');

    Route::get('posts', PostList::class)->name('posts.index');
    Route::get('posts/create', CreatePost::class)->name('posts.create');
    Route::get('tags', TagList::class);
    Route::get('tags/{tag}/edit', EditTag::class)->name('tags.edit');
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
