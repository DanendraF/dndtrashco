<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TpsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MarketController;


/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Halaman Register
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Route untuk logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');



//user
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/tps', function () {
        return view('tps.tpsuser');
    })->name('tps');

    Route::get('/blog', function () {
        return view('news.bloguser');
    })->name('blog');

    Route::get('/shop', function () {
        return view('shop.marketuser');
    })->name('shop');

    Route::get('/profile', function () {
        return view('profile.profile');
    })->name('profile');

    Route::get('/blogdetails', function () {
        return view('news.blogdetails');
    })->name('blogdetails');

    Route::get('blogsection', [BlogController::class, 'blogsection'])->name('news.blogsection');
    Route::get('news/blogdetails/{slug}', [BlogController::class, 'blogdetails'])->name('news.blogdetails');

    Route::get('tpssection', [TpsController::class, 'tpssection'])->name('tps.tpssection');
    Route::get('tps/tpsdetails/{slug}', [TpsController::class, 'tpsdetails'])->name('tps.tpsdetails');

    Route::get('marketsection', [MarketController::class, 'marketsection'])->name('shop.marketsection');
    Route::get('shop/marketdetails/{slug}', [MarketController::class, 'marketdetails'])->name('shop.marketdetails');

});


//admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/userlist', [AdminController::class, 'userlist'])->name('admin.userlist');
    Route::delete('/admin/user/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');

    Route::get('/admin/tps', [TpsController::class, 'index'])->name('admin.tps');
    Route::post('/tps/store', [TpsController::class, 'store'])->name('admin.tps.store');
    Route::get('/tps/{id}/edit', [TpsController::class, 'edit'])->name('admin.tps.edit');
    Route::match(['put', 'patch'], '/tps/{id}', [TpsController::class, 'update'])->name('admin.tps.update');
    Route::put('/tps/{id}/update', [TpsController::class, 'update'])->name('admin.tps.update');
    Route::delete('/tps/{id}', [TpsController::class, 'destroy'])->name('admin.tps.destroy');

    Route::get('/admin/blog', [BlogController::class, 'index'])->name('admin.blog');
    Route::post('/admin/blog', [BlogController::class, 'store'])->name('admin.blog.store');
    Route::get('/admin/blog/{blogId}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::put('/admin/blog/{blogId}', [BlogController::class, 'update'])->name('admin.blog.update');
    Route::delete('/admin/blog/{blogId}', [BlogController::class, 'destroy'])->name('admin.blog.destroy');

    Route::get('/admin/market', [MarketController::class, 'index'])->name('admin.market');
    Route::post('/admin/market', [MarketController::class, 'store'])->name('admin.market.store');
    Route::patch('/market/{id}/status', [MarketController::class, 'updateStatus'])->name('admin.market.updateStatus');
    Route::delete('/market/{id}', [MarketController::class, 'destroy'])->name('admin.market.destroy');
    Route::put('/admin/market/{id}', [MarketController::class, 'update'])->name('admin.market.update');

});

