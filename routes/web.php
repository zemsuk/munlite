<?php
use App\Controllers\HomeController;
use App\Auth\Controllers\AuthController;
use App\Dashboard\DashboardController;
use Zems\Route;

Route::get('/', HomeController::class, 'index');
Route::get('/about', HomeController::class, 'about');
Route::get('/service', HomeController::class, 'service');
Route::get('/seed-content', HomeController::class, 'seedContent');
Route::get('/where-in', HomeController::class, 'whereIn');
Route::get('/where-between', HomeController::class, 'whereBetween');
Route::get('/create-content', HomeController::class, 'createContent');
Route::post('/store-content', HomeController::class, 'storeContent');
Route::get('/edit-content', HomeController::class, 'editContent');
Route::post('/update-content', HomeController::class, 'updateContent');
Route::get('/delete-content', HomeController::class, 'deleteContent');
Route::get('/group-by', HomeController::class, 'groupBy');
Route::get('/pagination', HomeController::class, 'pagination');
Route::get('/join', HomeController::class, 'join');
Route::get('/aggregate', HomeController::class, 'aggregate');

Route::get('/register', AuthController::class, 'showRegister');
Route::post('/register', AuthController::class, 'register');
Route::get('/login', AuthController::class, 'showLogin');
Route::post('/login', AuthController::class, 'login');
Route::get('/logout', AuthController::class, 'logout');
Route::get('/dashboard', DashboardController::class, 'index');

Route::dispatch();