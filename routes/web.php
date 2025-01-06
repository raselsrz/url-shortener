<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



//logout
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


//login
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginStor'])->name('loginStor');


//register
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'registerStore'])->name('registerStore');


//auth user
Route::middleware(['auth'])->group(function () {
    
    Route::get('/', function () {
        return view('home.index');
    })->name('home');
    
    //


    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'profileUpdate'])->name('profileUpdate');
    Route::get('/change-password', [UserController::class, 'changePassword'])->name('changePassword');
    Route::post('/change-password', [UserController::class, 'changePasswordUpdate'])->name('changePasswordUpdate');
});






