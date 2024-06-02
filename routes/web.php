<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImagesController;
Route::get('/', function () {
    return view('layouts.index');
})->name('index');
Route::get('/images', [ImagesController::class, 'show'])->name('images');
Route::get('/images/download/{filename}', [ImagesController::class, 'download'])->name('download');
Route::post('/upload', [ImagesController::class, 'upload'])->name('form');
