<?php

use Illuminate\Support\Facades\Route;

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
    return view('pages.dashboard', ['page_uri' => 'dashboard']);
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/company', [App\Http\Controllers\CompanyController::class, 'index']);
    Route::post('/company', [App\Http\Controllers\CompanyController::class, 'store']);
    Route::get('/company/{id}', [App\Http\Controllers\CompanyController::class, 'show']);
    Route::post('/company/{id}', [App\Http\Controllers\CompanyController::class, 'update']);
    Route::delete('/company/{id}', [App\Http\Controllers\CompanyController::class, 'destroy']);

    Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index']);
    Route::post('/employee', [App\Http\Controllers\EmployeeController::class, 'store']);
    Route::get('/employee/{id}', [App\Http\Controllers\EmployeeController::class, 'show']);
    Route::post('/employee/{id}', [App\Http\Controllers\EmployeeController::class, 'update']);
    Route::delete('/employee/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy']);

    Route::post('/register', [App\Http\Controllers\UserController::class, 'registerUser']);
    Route::get('/check-email', [App\Http\Controllers\UserController::class, 'checkEmail']);
});
