<?php

use Zems\Route;
use App\Auth\LoginController;


// $router = new Router();
Route::get('/', HomeController::class, 'index');


/// Auth
Route::get('/login', LoginController::class, 'login');
Route::post('/login', LoginController::class, 'login_verify');
Route::post('/verify', LoginController::class, 'verify');
Route::get('/register', LoginController::class, 'create');
Route::post('/register', LoginController::class, 'store');
Route::get('/logout', Authentic::class, 'logOut');

// forget password



Route::dispatch();
