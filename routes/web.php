<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MerkController;
use App\Http\Controllers\NilaikriteriaController;
use App\Http\Controllers\NormalisasiController;
use App\Http\Controllers\ProdukSuplierController;
use App\Http\Controllers\RabController;
use App\Http\Controllers\RabDetailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SkorTotalController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\TabelHasilWsmController;
use App\Http\Controllers\TabelPengaturanBobotController;
use App\Http\Controllers\UserController;
use App\Models\Tabel_hasil_wsm;
use App\Models\Tabel_pengaturan_bobot;
use Illuminate\Support\Facades\Route;


Route::resource('skor_total', SkortotalController::class);
Route::resource('normalisasi', NormalisasiController::class);
Route::resource('nilai_kriteria', NilaikriteriaController::class);
Route::resource('kriteria', KriteriaController::class);
Route::resource('suplier', SuplierController::class);
Route::resource('material', MaterialController::class);
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('merk', MerkController::class);
Route::resource('kategori_produk', KategoriProdukController::class);
Route::resource('satuan', SatuanController::class);
Route::resource('produk_suplier', ProdukSuplierController::class);
Route::resource('rab', RabController::class);
Route::resource('rab_detail', RabDetailController::class);
Route::resource('kegiatan', KegiatanController::class);
Route::resource('tabel_pengaturan_bobot', TabelPengaturanBobotController::class);
Route::resource('tabel_hasil_wsm', TabelHasilWsmController::class);
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
// rute algoritma
Route::get('hitung', [MaterialController::class, 'hitungWsmTotal'])->name('hitungWsmTotal');

Route::get('/', function () {
    return view('welcome');
});

Route::get('export-pdf-data', [RabController::class, 'exportPdf'])->name('rab.exportPdf');

// Route untuk mendapatkan detail RAB via AJAX
Route::get('rab/{id}/details', [RabController::class, 'getDetails'])->name('rab.details');

Route::get('cetak_rab/{id}', [RabController::class, 'cetak'])->name('cetak_rab');

// Route yang sudah ada sebelumnya
Route::post('rab/{id}/verified', [RabController::class, 'verifikasi_berkas_verified'])->name('rab.verified');
Route::post('rab/{id}/not-verified', [RabController::class, 'verifikasi_berkas_notverified'])->name('rab.not_verified');
