<?php

use App\Http\Controllers\PesertaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pendaftaran/kelas-by-peserta', [PendaftaranController::class, 'kelasByPeserta'])->name('pendaftaran.kelas-by-peserta');
Route::get('/pendaftaran/peserta-by-kelas', [PendaftaranController::class, 'pesertaByKelas'])->name('pendaftaran.peserta-by-kelas');

Route::resource('peserta', PesertaController::class)->parameters(['peserta' => 'peserta']);
Route::resource('kelas', KelasController::class);
Route::resource('pendaftaran', PendaftaranController::class);