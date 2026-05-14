<?php
use App\Controllers\HomeController;
use Zems\Route;

Route::get('/', HomeController::class, 'index');
Route::get('/about', HomeController::class, 'about');
Route::get('/service', HomeController::class, 'service');
Route::get('/seed-content', HomeController::class, 'seedContent');
Route::get('/where-in', HomeController::class, 'whereIn');
Route::get('/where-between', HomeController::class, 'whereBetween');

Route::dispatch();