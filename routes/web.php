<?php


use App\Http\Controllers\Backend\V1\Transaction\PaymobHandle;
use App\Http\Controllers\PaymentController;
use App\Models\User;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
Route::post('/credit', [PaymentController::class, 'credit'])->name('checkout'); // this route send all functions data to paymob
Route::get('/callback', [PaymentController::class, 'callback'])->name('callback'); // this route get all reponse data to paymob
//Route::get('/thankyou', function () {return view('thank-you');});
//
//Route::get('/' , [CheckOutController::class, 'index']);


//Route::get('/credit', [PaymentController::class, 'credit'])->name('checkout'); // this route send all functions data to paymob
//Route::get('/callback', [PaymentController::class, 'callback'])->name('callback'); // this route get all reponse data to paymob

//Route::get('/get-token', [PaymentController::class, 'getToken']);

//Route::post('/paymob/order', [PaymentController::class, 'createOrder']);
//Route::post('/paymob/payment', [PaymentController::class, 'initiatePayment']);
//

Route::get('test', function () {

//    Cache::put('key', 'value', 600);
//    $value = Cache::get('key');
    Redis::set('name', 'Taylor');


//    dd('dsef');
//    \DB::disableQueryLog();

//    $users = Cache::remember('active_users', 60, function () {
//        return User::where('active', 1)->limit(1000000)->get();
//    });
//    $use = Cache::remember('name_users', 60, function () {
//        return \Illuminate\Support\Facades\DB::table('users')->select('name')->get();
//    });
//     Benchmark::dd([
////        'Count 1' => fn () => User::count(),
////        'Count 2' => fn () => User::all()->count(),
////        'Count 3' => fn () => $users ,
//        'Count 4' => fn () => $users->count(),
//        'Count 5' => fn () => \Illuminate\Support\Facades\DB::table('users')->count(),
//        'Count 6' => fn () => \Illuminate\Support\Facades\DB::table('users')->select('name'),
//        'Count 7' => fn () => $use ,
//
//    ]);

});

