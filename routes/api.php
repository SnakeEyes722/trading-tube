<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\BalanceController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register',[UserController::class,'createuser']);
Route::post('/login',[UserController::class,'login']);
Route::post('/updatepassword',[UserController::class,'updatepassword']);
Route::post('/AddPackage',[PackageController::class,'AddPackage']);
Route::get('/fetchallpackage',[PackageController::class,'fetchallpackage']);
Route::get('/fetch_package_id/{id}',[PackageController::class,'fetch_package_id']);
Route::post('/UpdatePackage/{id}',[PackageController::class,'UpdatePackage']);
Route::post('/UpdatePackageStatus/{id}',[PackageController::class,'UpdatePackageStatus']);
Route::post('/deletepackage/{id}',[PackageController::class,'deletepackage']);
Route::post('/AddDeposit',[DepositController::class,'AddDeposit']);
Route::post('/UpdateDeposit/{user_id}',[DepositController::class,'UpdateDeposit']);
Route::post('/AddBalance',[BalanceController::class,'AddBalance']);




