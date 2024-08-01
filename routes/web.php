<?php

use App\Http\Controllers\ShortController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/short', [ShortController::class, 'index'])->name('short.index');
