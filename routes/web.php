<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembelianDetailController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualanDetailController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
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

// Routes untuk user belum login (guest)
Route::middleware(['guest:web'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'index')->name('login');
        Route::post('/login', 'login')->name('login.proses');
    });
});
// Route untuk user yang sudah login (auth)
Route::group(['middleware' => 'auth'], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::get('/', function () {
        return view('home');
    });

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::group(['middleware' => ['cekuserlogin:1']], function () {
        // KATEGORI
        Route::get('/kategori/data', [KategoriController::class, 'data'])->name('kategori.data');
        Route::resource('/kategori', KategoriController::class);
        // PRODUK
        Route::get('/produk/data', [ProdukController::class, 'data'])->name('produk.data');
        Route::post('/produk/delete_selected', [ProdukController::class, 'delete_selected'])->name('produk.delete_selected');
        Route::post('/produk/cetak_barcode', [ProdukController::class, 'cetak_barcode'])->name('produk.cetak_barcode');
        Route::resource('/produk', ProdukController::class);
        // MEMBER
        Route::get('/member/data', [MemberController::class, 'data'])->name('member.data');
        Route::post('/member/cetak_member', [MemberController::class, 'cetak_member'])->name('member.cetak_member');
        Route::resource('/member', MemberController::class);
        // SUPPLIER
        Route::get('/supplier/data', [SupplierController::class, 'data'])->name('supplier.data');
        Route::resource('/supplier', SupplierController::class);
        // USER
        Route::get('/user/data', [UserController::class, 'data'])->name('user.data');
        Route::resource('/user', UserController::class);
        // SETTING
        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::get('/setting/first', [SettingController::class, 'show'])->name('setting.show');
        Route::post('/setting', [SettingController::class, 'update'])->name('setting.update');
    });

    Route::group(['middleware' => ['cekuserlogin:1,2']], function () {
        // PENGELUARAN
        Route::get('/pengeluaran/data', [PengeluaranController::class, 'data'])->name('pengeluaran.data');
        Route::resource('/pengeluaran', PengeluaranController::class);
        // PEMBELIAN
        Route::get('/pembelian/data', [PembelianController::class, 'data'])->name('pembelian.data');
        Route::get('/pembelian/{id}/create', [PembelianController::class, 'create'])->name('pembelian.create');
        Route::resource('/pembelian', PembelianController::class)
            ->except(['create']);
        // PEMBELIAN DETAIL
        Route::get('/pembelian_detail/{id}/data', [PembelianDetailController::class, 'data'])->name('pembelian_detail.data');
        Route::get('/pembelian_detail/loadform/{diskon}/{total}', [PembelianDetailController::class, 'loadForm'])->name('pembelian_detail.load_form');
        Route::resource('/pembelian_detail', PembelianDetailController::class)
            ->except(['create', 'show', 'edit']);
        // PENJUALAN
        Route::get('/penjualan/data', [PenjualanController::class, 'data'])->name('penjualan.data');
        Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
        Route::get('/penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
        Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
        // TRANSAKSI
        Route::get('/transaksi/baru', [PenjualanController::class, 'create'])->name('transaksi.baru');
        Route::post('/transaksi/simpan', [PenjualanController::class, 'store'])->name('transaksi.simpan');
        Route::get('/transaksi/selesai', [PenjualanController::class, 'selesai'])->name('transaksi.selesai');
        Route::get('/transaksi/nota-kecil', [PenjualanController::class, 'notaKecil'])->name('transaksi.nota_kecil');
        Route::get('/transaksi/nota-besar', [PenjualanController::class, 'notaBesar'])->name('transaksi.nota_besar');
        // TRANSAKSI DETAIL
        Route::get('/transaksi/{id}/data', [PenjualanDetailController::class, 'data'])->name('transaksi.data');
        Route::get('/transaksi/loadform/{diskon}/{total}/{diterima}', [PenjualanDetailController::class, 'loadForm'])->name('transaksi.load_form');
        Route::resource('/transaksi', PenjualanDetailController::class)
            ->except('create', 'show', 'edit');
        // LAPORAN
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/data/{awal}/{akhir}', [LaporanController::class, 'data'])->name('laporan.data');
        Route::get('/laporan/pdf/{awal}/{akhir}', [LaporanController::class, 'exportPDF'])->name('laporan.export_pdf');
        // PROFIL
        Route::get('/profil', [UserController::class, 'profil'])->name('user.profil');
        Route::post('/profil', [UserController::class, 'updateProfil'])->name('user.update_profil');
    });
});