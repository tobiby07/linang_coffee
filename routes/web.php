<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');



    Route::resource('kategori-menu', KategoriMenuController::class);
    Route::put('kategori-menu/{kategori_menu}', [KategoriMenuController::class, 'update'])->name('kategori-menu.update');

    Route::resource('menu', MenuController::class);
    Route::post('menu/{menu}/update', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('menu/{menu}', [MenuController::class, 'destroy'])->name('menu.destroy');
    Route::put('/menu/{id}/toggle-status', [MenuController::class, 'toggleStatus'])->name('menu.toggle-status');


    // Route::get('/kasir', [TransactionController::class, 'kasir'])->name('kasir');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::post('/transactions/remove-from-cart/{id}', [TransactionController::class, 'removeFromCart'])->name('transactions.remove_from_cart');
    Route::get('/laporan', [TransactionController::class, 'laporanHarian'])->name('laporanHarian');
    Route::get('/laporanBulanan', [TransactionController::class, 'laporanBulanan'])->name('laporanBulanan');
    Route::get('/reports/monthly/download/{month}', [TransactionController::class, 'cetakLaporanBulanan'])->name('reports.monthly.download');

    Route::get('/kasir', [TransactionController::class, 'viewCart'])->name('kasir');
    Route::post('/add-to-cart', [TransactionController::class, 'addToCart'])->name('transactions.add_to_cart');
    Route::post('/checkout', [TransactionController::class, 'checkout'])->name('transactions.checkout');

});
