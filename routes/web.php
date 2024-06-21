<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriMenuController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\users;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\EnsureLoggedIn;
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



// Routes for guests (not logged in)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('login');
    });
    Route::get('/', function () {
        return view('login');
    });

    Route::get('/register', function () {
        return view('register');
    });

    Route::post('/register', [Users::class, 'store'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

// Route to log out
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes for authenticated users
Route::middleware(EnsureLoggedIn::class)->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/home', function () {
        return view('dashboard');
    });



    Route::resource('kategori-menu', KategoriMenuController::class);
    Route::put('kategori-menu/{kategori_menu}', [KategoriMenuController::class, 'update'])->name('kategori-menu.update');

    Route::resource('menu', MenuController::class);
    Route::post('menu/{menu}/update', [MenuController::class, 'update'])->name('menu.update');
    Route::post('menu/{menu}/delete', [MenuController::class, 'destroy'])->name('menu.destroy');

    // Route::get('/kasir', [TransactionController::class, 'kasir'])->name('kasir');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/laporan', [TransactionController::class, 'laporan'])->name('laporan');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');

    Route::get('/kasir', [TransactionController::class, 'viewCart'])->name('kasir');
    Route::post('/add-to-cart', [TransactionController::class, 'addToCart'])->name('transactions.add_to_cart');
    Route::post('/checkout', [TransactionController::class, 'checkout'])->name('transactions.checkout');

});
