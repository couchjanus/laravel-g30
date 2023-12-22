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

use App\Livewire\Main\{HomePage, ProductsList, BlogPage, Catalog, ShoppingCart};
Route::get('/', HomePage::class)->name('home');
Route::get('/shop', ProductsList::class)->name('shop');
// Route::get('/blog', BlogPage::class)->name('blog');
Route::get('/shop', Catalog::class)->name('shop');
Route::get('shopping-cart', ShoppingCart::class)->name('shopping.cart');

use App\Http\Controllers\PostController;

Route::get('/blog', [PostController::class, 'index'])->name('posts.index');

Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('posts.show');

// Route::get('/checkout', function () {
//     return view('welcome');
// })->name('checkout.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout/order', [App\Http\Controllers\OrderController::class, 'placeOrder'])->name('checkout.place.order');
});

// 

Route::get('about', App\Http\Controllers\AboutController::class)->name('about');

// 
 
// Route::controller(PostController::class)->group(function () {
//     Route::get('/blog', 'index')->name('blog');
//     Route::get('/blog/{id}', 'show');
// });


Route::get('/contact', function () {
    return 'contact';
})->name('contact');


// Route::resource('admin/brands', App\Http\Controllers\Admin\BrandController::class);

use App\Http\Controllers\Admin\BrandController;

use App\Livewire\Admin\Users\UsersList;
use App\Livewire\Admin\Categories\{CategoryList, CreateCategory, EditCategory};
use App\Livewire\Admin\Products\{ProductList, CreateProduct, UpdateProduct};

use App\Livewire\Admin\Posts\{PostList, CreatePost, EditPost};
use App\Livewire\Admin\Tags\{TagList, CreateTag, EditTag};

Route::prefix('admin')->group(function () {
    Route::get('', App\Http\Controllers\Admin\DashboardController::class)->name('admin');
    Route::controller(BrandController::class)->group(function () {
        Route::get('brands/trashed', 'trashed')->name('brands.trashed');
        Route::post('brands/restore/{id}', 'restore')->name('brands.restore');
        Route::delete('brands/force/{id}', 'force')->name('brands.force');
    });
    Route::resource('brands', BrandController::class);
    Route::get('users', UsersList::class);
    
    Route::get('categories', CategoryList::class);
    Route::get('categories/create', CreateCategory::class)->name('categories.create');
    Route::get('categories/{category}/edit', EditCategory::class)->name('categories.edit');

    Route::get('products', ProductList::class)->name('products.index');
    Route::get('products/create', CreateProduct::class)->name('products.create');
    Route::get('products/{product}/edit', UpdateProduct::class)->name('products.edit');

    Route::get('posts', PostList::class);
    Route::get('posts/create', CreatePost::class);
    Route::get('posts/{post}/edit', EditPost::class)->name('posts.edit');

    Route::get('tags', TagList::class);
    Route::get('tags/{tag}/edit', EditTag::class)->name('tags.edit');
    
});

Route::get('/advices/edit', fn () => 'work')->name('advices.edit');
Route::get('/advices/trash', fn () => 'work')->name('advices.trash');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
