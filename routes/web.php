<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\userCheck;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/setpdf', function () {
    return view('dummy');
});

Route::get('/testpdf',[PatientController::class, 'testPdf']);
// Routes added to handle vue componet page load issue
Route::get('/login', function () {
    return view('login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/patient-list', function () {
    return view('dashboard');
})->middleware(['auth'])->name('patient-list');

Route::get('/admin-tests', function () {
    return view('dashboard');
})->middleware(['auth'])->name('admin-tests');

// Custom Auth for User Login
//Route::get('/tests',[TestController::class, 'index'])->middleware(userCheck::class);
Route::get('/tests', function () { 
    return view('welcome');
})->middleware(userCheck::class);


Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');

require __DIR__.'/auth.php';
