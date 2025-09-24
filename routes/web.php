<?php

use App\Http\Controllers\FaturaController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'home');

Route::get('/home',[FaturaController::class,'index'])->name('home');
