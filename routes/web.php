<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

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

Route::get('/product', [ProductController::class,'index'])->name('product.index') ;
Route::get('/product/create', [ProductController::class,'create'])->name('product.create') ;
Route::post('/product', [ProductController::class,'store'])->name('product.store') ;
Route::get('/product/{product}/edit', [ProductController::class,'edit'])->name('product.edit');
Route::put('/product/{product}/update', [ProductController::class,'update'])->name('product.update');
Route::delete('/product/{product}/destroy', [ProductController::class,'destroy'])->name('product.destroy');

// subjected to change 
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
     ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/register', [RegisteredUserController::class, 'create'])
     ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
     ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
     ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
     ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
     ->name('password.update');

Route::get('/logout', function () {
        return view('logout');
    })->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard'); 
})->name('dashboard');
// end of changes 

Route::get('/documentation', function () {
    return view('documentation');
});
