<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/', [PaymentController::class, 'showForm']);
Route::post('/', [PaymentController::class, 'process'])->name('stripe.payment');
