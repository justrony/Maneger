<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'card.home');


Route::controller(CardController::class)->name('card.')->group(function () {

    Route::get('/home',[CardController::class,'index'])->name('home');
    Route::get('/card/create',[CardController::class,'create'])->name('create');
    Route::post('/card/store',[CardController::class,'store'])->name('store');
    Route::get('/card/show/{card}',[CardController::class,'show'])->name('show');
    Route::get('/card/edit/{card}',[CardController::class,'edit'])->name('edit');
    Route::post('/card/update/{card}',[CardController::class,'update'])->name('update');
    Route::get('/card/delete/{card}',[CardController::class,'destroy'])->name('delete');

});


Route::controller(PurchaseController::class)->prefix('purchase')
    ->name('purchase.')->group(function () {

    Route::get('/,',[PurchaseController::class,'index'])->name('index');
});

