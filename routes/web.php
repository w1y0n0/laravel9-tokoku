<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kategori/data', [KategoriController::class, 'data'])->name('kategori.data');
Route::resource('/kategori', KategoriController::class);

Route::get('/produk/data', [ProdukController::class, 'data'])->name('produk.data');
Route::post('/produk/delete_selected', [ProdukController::class, 'delete_selected'])->name('produk.deleteSelected');
Route::post('/produk/cetak_barcode', [ProdukController::class, 'cetak_barcode'])->name('produk.cetakBarcode');
Route::resource('/produk', ProdukController::class);

Route::get('/member/data', [MemberController::class, 'data'])->name('member.data');
Route::post('/member/cetak_member', [MemberController::class, 'cetak_member'])->name('member.cetakMember');
Route::resource('/member', MemberController::class);

Route::get('/supplier/data', [SupplierController::class, 'data'])->name('supplier.data');
Route::resource('/supplier', SupplierController::class);