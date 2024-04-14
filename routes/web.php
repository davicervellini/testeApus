<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/favoritosAdd', [App\Http\Controllers\FavoritosController::class, 'store'])->name('favoritosAdd');
Route::post('/favoritosShow', [App\Http\Controllers\FavoritosController::class, 'show'])->name('favoritosShow');
Route::post('/favoritosDestroy', [App\Http\Controllers\FavoritosController::class, 'destroy'])->name('favoritosDestroy');
