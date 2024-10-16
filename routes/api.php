<?php


use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Transaction\PaymobHandle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/static-payment', [PaymentController::class, 'createStaticPayment']);

Route::post('/credit', [PaymentController::class, 'credit'])->name('checkout'); // this route send all functions data to paymob
Route::get('/callback', [PaymentController::class, 'callback'])->name('callback'); // this route get all reponse data to paymob

//Route::post('/payment/initiate', [PaymentController::class, 'initiatePayment']);
Route::apiResource('products', \App\Http\Controllers\ProductController::class);
