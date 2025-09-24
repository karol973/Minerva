<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController; 


Route::get('/', function () {
    return view('welcome');
});

Route::get('books', [BookController::class, 'index']);

Route::get('/home', function (){
    return view('home');
});

Route::post('/register', [UserController::class, 'register']);

Route::post('/logout', [UserController::class, 'logout']);
