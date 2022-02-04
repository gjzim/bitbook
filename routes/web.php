<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserAvatarController;

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

Route::get('/', [HomeController::class, 'index'])
    ->name('home')->middleware('auth');

Route::get('/users/{user}', [UserController::class, 'show'])
    ->name('users.show')->middleware(['auth']);

Route::get('/users/{user}/edit', [UserController::class, 'edit'])
    ->name('users.edit')->middleware(['auth','can:update,user']);

Route::put('/users/{user}', [UserController::class, 'update'])
    ->name('users.update')->middleware(['auth','can:update,user']);

Route::post('/users/{user}/avatar/update', [UserAvatarController::class, 'update'])
    ->name('users.avatar.update')->middleware(['auth','can:update,user']);

require __DIR__.'/auth.php';
