<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user', [App\Http\Controllers\HomeController::class, 'user'])->name('user');
// Route::get('/jurusan', [App\Http\Controllers\HomeController::class, 'jurusan'])->name('user');
// Route::get('/jurusan', [App\Http\Controllers\HomeController::class, 'jurusan'])->name('user');
Route::get('/jurusan', \App\Http\Livewire\Jurusan\JurusanTable::class);
Route::get('/guru', \App\Http\Livewire\Guru\GuruTable::class);