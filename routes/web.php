<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;

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


//middleware dn
Route::middleware('auth', 'checkadmin')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/tps', function () {
        return view('tps.tps');
    })->name('tps');

    Route::get('/blog', function () {
        return view('news.blog');
    })->name('blog');

    Route::get('/shop', function () {
        return view('shop.market');
    })->name('shop');

    Route::get('/profile', function () {
        return view('profile.profile');
    })->name('profile');

    Route::get('/blogsection', function () {
        return view('news.blogsection');
    })->name('blogsection');

    Route::get('/blogdetails', function () {
        return view('news.blogdetails');
    })->name('blogdetails');
});


// Route untuk logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

//admin

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin/userlist', [AdminController::class, 'userlist'])->name('admin.userlist');
    Route::delete('/admin/user/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');

    Route::get('/admin/tps', [AdminController::class, 'tps'])->name('admin.tps');

    Route::get('/admin/blog', [AdminController::class, 'blog'])->name('admin.blog');

    Route::get('/admin/market', [AdminController::class, 'market'])->name('admin.market');
});

