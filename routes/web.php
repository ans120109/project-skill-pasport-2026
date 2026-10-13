<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\ProfilSekolahController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\NilaiUjikomController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/profil', [LandingController::class, 'profil'])->name('profil');
Route::get('/guru-staff', [LandingController::class, 'guruStaff'])->name('guru-staff');

Route::view('/akademik', 'akademik')->name('akademik');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{berita}', [BeritaController::class, 'show'])
    ->whereNumber('berita')->name('berita.show');

Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
Route::get('/galeri/{galeri}', [GaleriController::class, 'show'])
    ->whereNumber('galeri')->name('galeri.show');

Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('ekstrakurikuler.index');
Route::get('/ekstrakurikuler/{ekstrakurikuler}', [EkstrakurikulerController::class, 'show'])
    ->whereUuid('ekstrakurikuler')->name('ekstrakurikuler.show');

Route::get('/nilai-ujikom', [NilaiUjikomController::class, 'index'])->name('nilai-ujikom.index');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

Route::middleware('auth')->group(function () {

    Route::view('/profile', 'profile')->name('profile');

    Route::get('/profile-sekolah', [ProfilSekolahController::class, 'index'])
        ->middleware('role:admin,operator,guru,siswa')
        ->name('profile-sekolah.index');

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->middleware('role:admin,operator,guru,siswa')
        ->name('admin.dashboard');

    Route::get('/guru/dashboard', [GuruDashboardController::class, 'index'])
        ->middleware('role:guru')
        ->name('guru.dashboard');

    Route::get('/siswa/dashboard', [SiswaDashboardController::class, 'index'])
        ->middleware('role:siswa')
        ->name('siswa.dashboard');

    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])
        ->middleware('role:user')
        ->name('user.dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/profile-sekolah/edit', [ProfilSekolahController::class, 'edit'])->name('profile-sekolah.edit');
    Route::put('/profile-sekolah', [ProfilSekolahController::class, 'update'])->name('profile-sekolah.update');
});

Route::middleware(['auth', 'role:admin,operator'])->group(function () {

    Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');

    Route::get('/galeri/tambah', [GaleriController::class, 'create'])->name('galeri.create');
    Route::post('/galeri/simpan', [GaleriController::class, 'store'])->name('galeri.store');
    Route::get('/galeri/{galeri}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
    Route::put('/galeri/{galeri}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/galeri/{galeri}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

    Route::get('/ekstrakurikuler/create', [EkstrakurikulerController::class, 'create'])->name('ekstrakurikuler.create');
    Route::post('/ekstrakurikuler', [EkstrakurikulerController::class, 'store'])->name('ekstrakurikuler.store');
    Route::get('/ekstrakurikuler/{ekstrakurikuler}/edit', [EkstrakurikulerController::class, 'edit'])->name('ekstrakurikuler.edit');
    Route::put('/ekstrakurikuler/{ekstrakurikuler}', [EkstrakurikulerController::class, 'update'])->name('ekstrakurikuler.update');
    Route::delete('/ekstrakurikuler/{ekstrakurikuler}', [EkstrakurikulerController::class, 'destroy'])->name('ekstrakurikuler.destroy');

    Route::get('/nilai-ujikom/create', [NilaiUjikomController::class, 'create'])->name('nilai-ujikom.create');
    Route::post('/nilai-ujikom', [NilaiUjikomController::class, 'store'])->name('nilai-ujikom.store');
    Route::get('/nilai-ujikom/{nilai}/edit', [NilaiUjikomController::class, 'edit'])->name('nilai-ujikom.edit');
    Route::put('/nilai-ujikom/{nilai}', [NilaiUjikomController::class, 'update'])->name('nilai-ujikom.update');
    Route::delete('/nilai-ujikom/{nilai}', [NilaiUjikomController::class, 'destroy'])->name('nilai-ujikom.destroy');

    Route::get('/data-siswa', [SiswaController::class, 'index'])->name('data-siswa.index');

    Route::prefix('siswa-guru')->name('siswa-guru.')->group(function () {
        Route::get('/', [DataUserController::class, 'create'])->name('create');

        Route::post('/siswa', [DataUserController::class, 'store'])->name('store');
        Route::get('/siswa/{siswa}/edit', [DataUserController::class, 'editSiswa'])->name('siswa.edit');
        Route::put('/siswa/{siswa}', [DataUserController::class, 'updateSiswa'])->name('siswa.update');
        Route::delete('/siswa/{siswa}', [DataUserController::class, 'destroySiswa'])->name('siswa.destroy');

        Route::post('/guru', [DataUserController::class, 'storeGuru'])->name('guru.store');
        Route::get('/guru/{guru}/edit', [DataUserController::class, 'editGuru'])->name('guru.edit');
        Route::put('/guru/{guru}', [DataUserController::class, 'updateGuru'])->name('guru.update');
        Route::delete('/guru/{guru}', [DataUserController::class, 'destroyGuru'])->name('guru.destroy');
    });

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::middleware('role:admin')->group(function () {
            Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/users', [UserController::class, 'store'])->name('users.store');
            Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        });

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    });
});