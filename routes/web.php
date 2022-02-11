<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/purchase', function () {
    return view('purchase');
})->name('purchase');

Route::get('/certificatephp', function () {
    return view('certificatephp');
})->name('certificatephp');

Route::post('/certificatephp', function () {
    return view('certificatephp');
})->name('certificatephp');

Route::post('/frmsb', function () {
    return view('frmsb');
})->name('frmsb');

Route::get('/frmsb', function () {
    return view('frmsb');
})->name('frmsb');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified','nonPayingCustomer'])->get('/subscribe', function () {
    return view('subscribe', [
        'intent' => auth()->user()->createSetupIntent(),
    ]);
})->name('subscribe');

Route::middleware(['auth:sanctum', 'verified','nonPayingCustomer'])->post('/subscribe', function (Request $request) {
    // dd($request->all());
    auth()->user()->newSubscription('cashier', $request->plan)->create($request->paymentMethod);

    return redirect('/dashboard');
})->name('subscribe.post');

Route::middleware(['auth:sanctum', 'verified','payingCustomer'])->get('/change', function () {
    return view('change', [
        'intent' => auth()->user()->createSetupIntent(),
    ]);
})->name('change');

Route::middleware(['auth:sanctum', 'verified','payingCustomer'])->post('/change', function (Request $request) {
   
    auth()->user()->updateDefaultPaymentMethod($request->paymentMethod);
    auth()->user()->subscription('cashier')->swap($request->plan);
    // auth()->user()->newSubscription('cashier', $request->plan)->create($request->paymentMethod);
    // auth()->user()->subscription('cashier')->swap('price_1JlIrsDBfyvrAKAqAELdn22p');
    return redirect('/dashboard');
})->name('change.post');

// Route::middleware(['auth:sanctum', 'verified','payingCustomer'])->get('/renew', function () {
//     return view('renew', [
//         'intent' => auth()->user()->createSetupIntent(),
//     ]);
// })->name('renew');

Route::middleware(['auth:sanctum', 'verified','payingCustomer'])->post('/renew', function (Request $request) {
   
    auth()->user()->updateDefaultPaymentMethod($request->paymentMethod);
    auth()->user()->subscription('cashier')->swap($request->plan);
    // auth()->user()->newSubscription('cashier', $request->plan)->create($request->paymentMethod);
    // auth()->user()->subscription('cashier')->swap('price_1JlIrsDBfyvrAKAqAELdn22p');
    return redirect('/dashboard');
})->name('renew.post');



Route::middleware(['auth:sanctum', 'verified','payingCustomer'])->get('/members', function () {
    return view('members');
})->name('members');

Route::middleware(['auth:sanctum', 'verified'])->get('/charge', function () {
    return view('charge');
})->name('charge');

Route::middleware(['auth:sanctum', 'verified'])->post('/charge', function (Request $request) {
    // dd($request->all());
    // auth()->user()->charge(1000, $request->paymentMethod);
    auth()->user()->createAsStripeCustomer();
    auth()->user()->updateDefaultPaymentMethod($request->paymentMethod);
    auth()->user()->invoiceFor('One Time Fee', 1500);

    return redirect('/dashboard');
})->name('charge.post');

Route::middleware(['auth:sanctum', 'verified'])->get('/invoices', function () {
    return view('invoices', [
        'invoices' => auth()->user()->invoices(),
    ]);
})->name('invoices');

Route::get('user/invoice/{invoice}', function (Request $request, $invoiceId) {
    return $request->user()->downloadInvoice($invoiceId, [
        'vendor' => 'Your Company',
        'product' => 'Your Product',
    ]);
});

Route::get('/uploadagreement', function () {
    return view('uploadagreement');
})->name('uploadagreement');

Route::post('/createagreement', function () {
    return view('createagreement');
})->name('createagreement');

Route::post('/upload', 'App\Http\Controllers\Contracts@index');
Route::get('/upload', function () {
    return view('createagreement');
})->name('createagreement');