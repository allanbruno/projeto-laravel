<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::get('/', [ClientController::class, 'index'])->name('client.index');

Route::get('/welcome', function () {
    return view('welcome');
});
