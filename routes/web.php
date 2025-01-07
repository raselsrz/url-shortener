<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LinkController;


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
    
    //link routes
    Route::get('/links', [LinkController::class, 'index'])->name('links');
    Route::get('/links/add', [LinkController::class, 'add'])->name('add');
    Route::post('/links/create', [LinkController::class, 'create'])->name('links.create');

    //link edit
    Route::get('/links/edit/{id}', [LinkController::class, 'edit'])->name('links.edit');
    Route::post('/links/edit/{id}', [LinkController::class, 'update'])->name('links.update');

    //link delete
    Route::get('/links/delete/{id}', [LinkController::class, 'delete'])->name('links.delete');


    Route::get('/short/{short_link}', [LinkController::class, 'shortLink'])->name('shortLink');



    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'profileUpdate'])->name('profileUpdate');
});






