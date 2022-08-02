<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

// Route::name('auth')->prefix("auth")->group(function ()
// {
//     Route::get('/login', 'login')->name('.login');

// });

// file welcome kita namakan url dia selamat datang
Route::get('/selamatdatang', function () {
    return view('welcome');
})->name('view.selamatdatang');

// file welcome kita namakan url dia selamat datang
Route::get('/home', function () {
    return view('home');
})->name('view.home');

// guna url direct terus return hello world
Route::get('/helloworld', function () {
    return 'Hello World';
});

// return url based on id yang di set
Route::get('/user/{id}', function ($id) {
    return 'Hello User ' .$id;
})->name('greeting');

Route::get('/post/testpost', [PostController::class, 'show']);

// Route::name('post')->prefix("post")->group(function () {
//     Route::get('/', [PostController::class, 'show'])
// })

// Route::get('/form/create', [FormController::class, 'create']);

// Route::name('form')->middleware('analysis.url')->prefix("form")->controller(FormController::class)->group(function ()
Route::middleware('auth')->name('form')->prefix("form")->controller(FormController::class)->group(function ()
{
    Route::get('/create', 'create')->name('.create');
    Route::post('/store', 'store')->name('.store');
    Route::get('/utama', 'show')->name('.show');
    Route::delete('/destroy/{id}', 'destroy')->name('.destroy');

    Route::get('/edit/{id}', 'edit')->name('.edit')->middleware('analysis.url');
    Route::patch('/update/{id}', 'update')->name('.update');

});

// file login authentication kita namakan url dia login
// Route::get('/login', function () {
//     return view('auth.login');
// })->name('auth.login.attempt');

Route::get('/login', [UserController::class, 'login'])->name('auth.login');
Route::post('/login', [UserController::class, 'loginattempt'])->name('auth.login.attempt');
Route::get('/logout', [UserController::class, 'logout'])->name('auth.logout.attempt');


// file authorization kita namakan url dia unauthorized
Route::get('/unauthorized', function () {
    return view('/errors/unauthorized');
})->name('errors.unauthorized');

