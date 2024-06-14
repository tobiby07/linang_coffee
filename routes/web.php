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

// login user route
Route::get('/login', function () {
    return view('login');
});

// dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/home', function () {
    return view('dashboard');
});

// kasir route
Route::get('/kasir', function () {
    return view('kasir');
});

// Daftar Menu Route
Route::get('/menu', function () {
    return view('menu');
});

// Tambah Menu Route
Route::get('/tambah-menu', function () {
    return view('tambah-menu');
});

// tambah kategori route
Route::get('/tambah-kategori', function () {
    return view('tambah-kategori');
});

// laporan route
Route::get('/laporan', function () {
    return view('laporan');
});
Route::get('/laporan-harian', function () {
    return view('laporan-harian');
});
Route::get('/laporan-bulanan', function () {
    return view('laporan-bulanan');
});



