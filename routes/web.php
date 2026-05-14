<?php
use App\Controllers\HomeController;
use Zems\Route;

Route::get('/', HomeController::class, 'index');
Route::get('/about', HomeController::class, 'about');

Route::dispatch();