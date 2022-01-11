<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;
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

Route::get('/tests',[TestController::class, 'index']);

Route::get('/allPatientList/{from}/{to}/{search?}',[PatientController::class, 'index']);
//Route::post('/allPatientList',[PatientController::class, 'index']);

Route::get('/getdetail/{id}',[PatientController::class, 'show']);
Route::get('/gettestdetail/{id}',[TestController::class, 'show']);

Route::post('/store',[PatientController::class, 'store']);
// Total Counts
Route::get('/get-test-count',[TestController::class, 'getTestCount']);
Route::get('/get-total-count',[PatientController::class, 'getTotalCount']);
//Update
Route::post('/update/{id}',[TestController::class, 'update']);
Route::post('/savetestdata',[TestController::class, 'store']);
Route::post('/soft-delete/{id}',[TestController::class, 'softDelete']);
// user Login
Route::post('/front-user',[UserController::class, 'checkUser']);
// Download excel
Route::post('/download',[PatientController::class, 'downloadExcel']);


Route::prefix('/admin')->group(function () {
    Route::post('/store',[TestController::class, 'store']);
});
