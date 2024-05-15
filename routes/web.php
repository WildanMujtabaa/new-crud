<?php

use App\Http\Controllers\ProductController;
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


Route::get('/kelola-produk', [ProductController::class, 'viewIndex'])->name('kelola');


Route::get('/tambah-produk', function () {
    return view('produk.create');
});

Route::post('/kelola-produk/create', [ProductController::class, 'create'])->name('tambah');

Route::delete('/kelola-produk/delete/{id}', [ProductController::class, 'delete'])->name('hapus');

Route::get('/edit-produk/{id}', [ProductController::class, 'viewEdit'])->name('edit');

Route::post('/edit-produk/{id}/store', [ProductController::class, 'edit'])->name('store.edit');