<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembelianDetailController;
use App\Http\Controllers\PengeluaranController;
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
Route::post('/produk/delete_selected', [ProdukController::class, 'delete_selected'])->name('produk.delete_selected');
Route::post('/produk/cetak_barcode', [ProdukController::class, 'cetak_barcode'])->name('produk.cetak_barcode');
Route::resource('/produk', ProdukController::class);

Route::get('/member/data', [MemberController::class, 'data'])->name('member.data');
Route::post('/member/cetak_member', [MemberController::class, 'cetak_member'])->name('member.cetak_member');
Route::resource('/member', MemberController::class);

Route::get('/supplier/data', [SupplierController::class, 'data'])->name('supplier.data');
Route::resource('/supplier', SupplierController::class);

Route::get('/pengeluaran/data', [PengeluaranController::class, 'data'])->name('pengeluaran.data');
Route::resource('/pengeluaran', PengeluaranController::class);

Route::get('/pembelian/data', [PembelianController::class, 'data'])->name('pembelian.data');
Route::get('/pembelian/{id}/create', [PembelianController::class, 'create'])->name('pembelian.create');
Route::resource('/pembelian', PembelianController::class)
    ->except(['create']);

Route::get('/pembelian_detail/{id}/data', [PembelianDetailController::class, 'data'])->name('pembelian_detail.data');
Route::get('/pembelian_detail/loadform/{diskon}/{total}', [PembelianDetailController::class, 'loadForm'])->name('pembelian_detail.load_form');
Route::resource('/pembelian_detail', PembelianDetailController::class)
    ->except(['create', 'show', 'edit']);