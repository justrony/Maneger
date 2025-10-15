<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\FaturaController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'card.home');


Route::prefix('fatura')->controller(FaturaController::class)->group(function () {
    Route::get('/', 'index');
});

Route::controller(CardController::class)->name('card.')->group(function () {

    Route::get('/home',[CardController::class,'index'])->name('home');

});

