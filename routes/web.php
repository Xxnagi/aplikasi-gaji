<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KaryawanController;
use App\Models\Karyawan;

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

Route::get('/presence', function () {
    return view('presence', [
        'title' => 'Presence'
    ]);
});

Route::get('/payroll', function () {
    return view('payroll', [
        'title' => 'Payroll'
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');

Route::get('/',  function () {
    return view('dashboard.index');
})->middleware('auth');


Route::get('/karyawan/checkSlug', [KaryawanController::class, 'checkSlug']);
Route::resource('/karyawan', KaryawanController::class)->middleware('auth');
