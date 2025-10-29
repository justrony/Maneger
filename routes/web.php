<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'home');


Route::controller(CardController::class)->name('card.')->group(function () {

    Route::get('/home','index')->name('home');
    Route::get('/card/create','create')->name('create');
    Route::post('/card/store','store')->name('store');
    Route::get('/card/show/{card}','show')->name('show');
    Route::get('/card/edit/{card}','edit')->name('edit');
    Route::put('/card/update/{card}','update')->name('update');
    Route::get('/card/delete/{card}','destroy')->name('delete');

});

Route::controller(InvoiceController::class)->name('invoice.')->group(function () {
    Route::post('/invoice/store','store')->name('store');
    Route::put('/invoice/update/{invoice}','update')->name('update');
    Route::delete('/invoice/delete/{invoice}','destroy')->name('destroy');
    Route::get('/invoice/show/{invoice}','show')->name('show');
});

Route::controller(PurchaseController::class)->prefix('purchase')
    ->name('purchase.')->group(function () {

    Route::get('/,','index')->name('index');
    Route::post('/store','store')->name('store');
    Route::put('/update/{purchase}','update')->name('update');
    Route::delete('/delete/{purchase}','destroy')->name('destroy');
});

