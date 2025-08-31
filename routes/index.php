<?php
use App\Affiliate\AffiliateController;
use App\Affiliate\Model\Package;
// use App\Affiliate\PackageController;
use App\Auth\Authentic;
use App\Dashboard\DashboardController;
use App\Auth\LoginController;
// use App\Customer\CustomerController;
// use App\Customer\UserCustomerController;
use App\Lenden\LendenController;
use App\user\UserController;
use App\Dashboard\NewController;
use App\Web\HomeController;
use App\Event\EventController;
use App\Gateway\BkasPayment;
use App\History\HistoryController;
use Zems\Route;

// $router = new Router();
Route::get('/', HomeController::class, 'index');


/// Auth
Route::get('/login', LoginController::class, 'login');
Route::post('/login', LoginController::class, 'login_verify');
Route::post('/verify', LoginController::class, 'verify');
Route::get('/register', LoginController::class, 'create');
Route::post('/register', LoginController::class, 'store');
Route::get('/logout', Authentic::class, 'logOut');
Route::post('/get_user', LoginController::class, 'get_user');
// forget password


Route::get('/dashboard', DashboardController::class, 'index');
Route::get('/message', DashboardController::class, 'success');


Route::get('/event', EventController::class,'index');
Route::get('/api/event/{id}', EventController::class,'details');
Route::get('/event/create', EventController::class,'create');
Route::post('/event/store', EventController::class,'store');
Route::get('/event/{id}/edit', EventController::class,'edit');
Route::post('/event/update', EventController::class,'update');
Route::get('/api/event/{id}/delete', EventController::class,'destroy');



// Deposit

Route::get('/deposit_history', HistoryController::class,'deposit_history');
Route::post('/deposit_history/store', HistoryController::class,'deposit_store');
Route::get('/deposit_succes', HistoryController::class,'deposit_succes');
Route::get('/event_join/{id}', HistoryController::class,'event_join');
Route::get('/event_create', HistoryController::class,'event_create');
Route::post('/event_store/{id}', HistoryController::class,'event_store');
Route::put('/event_store/{id}', HistoryController::class,'event_put');
Route::delete('/event_store/{id}', HistoryController::class,'event_delete');


Route::get('/withdrawal_history', HistoryController::class,'index');
Route::post('/withdrawal_history/store', HistoryController::class,'withdrawal_store');
Route::post('/with_test/{id}', HistoryController::class,'with_test');
// Route::post('/withdrawal_history/update', HistoryController::class,'withdrawal_update');



// Admin Route

Route::get('/withdrawal_request',HistoryController::class,'withdrawal_request');
Route::get('/api/withdrawal_accept/{id}',HistoryController::class,'withdrawal_accept');
Route::post('/withdrawal_update',HistoryController::class,'withdrawal_update');


Route::get('/user', UserController::class, 'index');
// Route::get('/user/create', UserController::class, 'create');
// Route::post('/user/store', UserController::class, 'store');
Route::get('/user/{id}', UserController::class, 'details');
Route::get('/user/{id}/edit', UserController::class, 'edit');
Route::post('/user/update', UserController::class, 'update');
Route::get('/user/{id}/delete', UserController::class, 'destroy');




Route::get('/all_transection', LendenController::class, 'all_transection');
Route::get('/transection', LendenController::class, 'index');
Route::get('/transection/create', LendenController::class, 'create');
Route::post('/transection/store', LendenController::class, 'store');
Route::get('/transection/{id}/edit', LendenController::class, 'edit');
Route::post('/transection/update', LendenController::class, 'update');
Route::get('/transection/{id}/delete', LendenController::class, 'delete');







Route::get('/invite/{id}',AffiliateController::class,'invite');
Route::post('/invited',AffiliateController::class,'store');
Route::get('/affiliate',AffiliateController::class,'index');
Route::get('/affiliate/{id}',AffiliateController::class,'details');
Route::get('/affiliate/{id}/edit',AffiliateController::class,'edit');



/// Payment Gateway
Route::post('/bkas_pay',BkasPayment::class,'pay_now');
Route::get('/api/execute_payment',BkasPayment::class,'pay_success');
Route::post('/create_payment',BkasPayment::class,'create_payment');


Route::dispatch();
