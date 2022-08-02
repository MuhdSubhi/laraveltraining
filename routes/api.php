<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FormController;
use App\Http\Controllers\Api\LoginController;

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

Route::get('/v1/status-check', function() {
    return 'API is Alive';
});

//url dia mesti ada api dulu baru nama url
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/liststaff', [FormController::class, 'getAllStaff'])->name('api.liststaff');
    Route::post('/createstaff', [FormController::class, 'createStaff'])->name('api.createstaff');
    Route::delete('/deletestaff/{id}', [FormController::class, 'destroy'])->name('api.deletestaff');
    Route::patch('/updatestaff/{id}', [FormController::class, 'updateStaff'])->name('api.updatestaff');
    Route::get('/logout', [LoginController::class, 'logoutapi']);
});

Route::post('/login', [LoginController::class, 'loginapi']);
