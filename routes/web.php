<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\FaturaController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'home');

Route::get('/home',[CardController::class,'index'])->name('home');
