<?php

use App\Http\Controllers\ImagesController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::resource('images', ImagesController::class);
Route::get('stats', [ImagesController::class, 'stats']);
Route::resource('game', GameController::class);
