<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\ReferalController;
use App\Http\Controllers\ApprovedepositController;
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
Route::post('/fetchallusers',[UserController::class,'fetchallusers']);
Route::post('/updateuserwithid/{id}',[UserController::class,'updateuserwithid']);
Route::post('/fetchuserwithid/{id}',[UserController::class,'fetchuserwithid']);
Route::post('/deleteuserwithid/{id}',[UserController::class,'deleteuserwithid']);

Route::post('/updatepassword',[UserController::class,'updatepassword']);
Route::post('/AddPackage',[PackageController::class,'AddPackage']);
Route::get('/fetchallpackage',[PackageController::class,'fetchallpackage']);
Route::get('/fetch_package_id/{id}',[PackageController::class,'fetch_package_id']);
Route::post('/UpdatePackage/{id}',[PackageController::class,'UpdatePackage']);
Route::post('/UpdatePackageStatus/{id}',[PackageController::class,'UpdatePackageStatus']);
Route::post('/deletepackage/{id}',[PackageController::class,'deletepackage']);
Route::post('/AddDeposit',[DepositController::class,'AddDeposit']);
// Route::post('/UpdateDeposit/{user_id}',[DepositController::class,'UpdateDeposit']);
Route::post('/addDeposit',[DepositController::class,'addDeposit']);
Route::post('/fetchdepositwithid',[DepositController::class,'fetchdepositwithid']);
Route::post('/getalldeposits',[DepositController::class,'getalldeposits']);

Route::post('/addreferrals',[ReferalController::class,'addreferrals']);
Route::post('/show',[ApprovedepositController::class,'show']);






