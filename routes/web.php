<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserAvatarController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::get('/home/posts', [HomeController::class, 'postsIndex'])
    ->name('home.posts.index')->middleware(['auth']);

Route::get('/users/{user}', [UserController::class, 'show'])
    ->name('users.show')->middleware(['auth']);

Route::get('/users/{user}/posts', [UserController::class, 'posts'])
    ->name('users.posts.show')->middleware(['auth']);

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

Route::delete('/users/{user}', [UserController::class, 'destroy'])
    ->name('users.destroy')->middleware(['auth', 'can:update,user']);

Route::post('users/{receiver}/friendships', [FriendshipController::class, 'create'])
    ->name('users.friendships.create')
    ->middleware(['auth', 'can:add-as-friend,receiver']);

Route::put('users/{sender}/friendships/{receiver}', [FriendshipController::class, 'update'])
    ->name('users.friendships.update')
    ->middleware(['auth']);

Route::delete('users/{sender}/friendships/{receiver}', [FriendshipController::class, 'destroy'])
    ->name('users.friendships.destroy')
    ->middleware(['auth']);

Route::get('/users/{user}/friends', [FriendshipController::class, 'index'])
    ->name('users.friends')->middleware(['auth', 'can:view-friends,user']);

Route::get('/users/{user}/friends/pending', [FriendshipController::class, 'pendingIndex'])
    ->name('users.friends.pending')->middleware(['auth', 'can:update-friends,user']);

Route::get('/users/{user}/friends/suggestions', [FriendshipController::class, 'suggestionsIndex'])
    ->name('users.friends.suggestions')->middleware(['auth', 'can:update-friends,user']);

// Post related routes
Route::get('/posts', [PostController::class, 'index'])
    ->name('posts.index')->middleware(['auth']);

Route::post('/posts', [PostController::class, 'store'])
    ->name('posts.store')->middleware(['auth']);

Route::get('/posts/{post}', [PostController::class, 'show'])
    ->name('posts.show')->middleware(['auth']);

Route::post('/posts/{post}/likes', [LikeController::class, 'store'])
    ->name('posts.likes.store')->middleware(['auth']);

Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])
    ->name('posts.likes.destroy')->middleware(['auth']);

Route::get('/posts/{post}/comments', [PostController::class, 'indexComments'])
    ->name('posts.comments.index')->middleware(['auth']);

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
    ->name('comments.store')->middleware(['auth', 'can:comment,post']);

Route::get('/comments', [CommentController::class, 'index'])
    ->name('comments.index')->middleware(['auth']);

Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
    ->name('comments.destroy')->middleware(['auth', 'can:delete,comment']);

require __DIR__ . '/auth.php';
