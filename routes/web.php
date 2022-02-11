<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserAvatarController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'index'])
    ->name('home')->middleware('auth');

Route::get('/users/{user}', [UserController::class, 'show'])
    ->name('users.show')->middleware(['auth']);

Route::get('/users/{user}/posts', [UserController::class, 'posts'])
    ->name('users.show.posts')->middleware(['auth']);

Route::get('/users/{user}/edit', [UserController::class, 'edit'])
    ->name('users.edit')->middleware(['auth', 'can:update,user']);

Route::put('/users/{user}', [UserController::class, 'update'])
    ->name('users.update')->middleware(['auth', 'can:update,user']);

Route::post('/users/{user}/avatar/update', [UserAvatarController::class, 'update'])
    ->name('users.avatar.update')->middleware(['auth', 'can:update,user']);

Route::get('/users/{user}/change-password', [ChangePasswordController::class, 'show'])
    ->name('users.change.password')->middleware(['auth', 'can:update,user']);

Route::post('/users/{user}/change-password', [ChangePasswordController::class, 'store'])
    ->name('users.update.password')->middleware(['auth', 'can:update,user']);

Route::get('/users/{user}/delete', [UserController::class, 'confirmDelete'])
    ->name('users.delete.confirm')->middleware(['auth', 'can:update,user', 'password.confirm']);

Route::delete('/users/{user}/destroy', [UserController::class, 'destroy'])
    ->name('users.destroy')->middleware(['auth', 'can:update,user']);

require __DIR__ . '/auth.php';
