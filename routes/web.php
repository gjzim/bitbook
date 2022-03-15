<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
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

/**
 * Home routes definitions.
 */
Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])
        ->name('home');

    Route::get('/home/posts', [HomeController::class, 'postsIndex'])
        ->name('home.posts.index');
});

/**
 * User profile routes definitions.
 */
Route::middleware(['auth'])->name('users.')->group(function () {
    Route::get('/users/{user}', [UserController::class, 'show'])
        ->name('show');

    Route::get('/users/{user}/posts', [UserController::class, 'posts'])
        ->name('posts')->middleware('can:view-posts,user');

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->name('edit')->middleware(['can:update,user']);

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->name('update')->middleware(['can:update,user']);

    Route::post('/users/{user}/avatar/update', [UserAvatarController::class, 'update'])
        ->name('avatar.update')->middleware(['can:update,user']);

    Route::get('/users/{user}/change-password', [ChangePasswordController::class, 'show'])
        ->name('change.password')->middleware(['can:update,user']);

    Route::post('/users/{user}/change-password', [ChangePasswordController::class, 'store'])
        ->name('update.password')->middleware(['can:update,user']);

    Route::get('/users/{user}/delete', [UserController::class, 'confirmDelete'])
        ->name('delete.confirm')->middleware(['can:update,user', 'password.confirm']);

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('destroy')->middleware(['can:update,user']);
});

/**
 * Friends & Friendship routes definitions.
 */
Route::middleware(['auth'])->name('users.')->group(function () {
    Route::post('/users/{receiver}/friendships', [FriendshipController::class, 'create'])
        ->name('friendships.create')->middleware(['can:add-as-friend,receiver']);

    Route::put('/users/{sender}/friendships/{receiver}', [FriendshipController::class, 'update'])
        ->name('friendships.update');

    Route::delete('/users/{sender}/friendships/{receiver}', [FriendshipController::class, 'destroy'])
        ->name('friendships.destroy');

    Route::get('/users/{user}/friends', [FriendshipController::class, 'index'])
        ->name('friends')->middleware(['can:view-friends,user']);

    Route::get('/users/{user}/friends/pending', [FriendshipController::class, 'pendingIndex'])
        ->name('friends.pending')->middleware(['can:update-friends,user']);

    Route::get('/users/{user}/friends/suggestions', [FriendshipController::class, 'suggestionsIndex'])
        ->name('friends.suggestions')->middleware(['can:update-friends,user']);
});

/**
 * Post routes definitions.
 */
Route::middleware(['auth'])->name('posts.')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])
        ->name('index');

    Route::post('/posts', [PostController::class, 'store'])
        ->name('store');

    Route::get('/posts/{post}', [PostController::class, 'show'])
        ->name('show');

    Route::delete('/posts/{post}', [PostController::class, 'destroy'])
        ->name('destroy');
});

/**
 * Post likes routes definitions.
 */
Route::middleware(['auth'])->name('posts.likes.')->group(function () {
    Route::post('/posts/{post}/likes', [LikeController::class, 'store'])
        ->name('store');

    Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])
        ->name('destroy');
});

/**
 * Post comments routes definitions.
 */
Route::middleware(['auth'])->group(function () {
    Route::get('/posts/{post}/comments', [PostController::class, 'indexComments'])
        ->name('posts.comments.index');

    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
        ->name('posts.comments.store')->middleware(['can:comment,post']);

    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy')->middleware(['can:delete,comment']);
});

/**
 * Notification routes definitions.
 */
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::put('/notifications/{notification}', [NotificationController::class, 'markAsChecked'])
        ->name('notifications.check')->middleware(['can:update,notification']);

    Route::put('users/{user}/notifications', [UserController::class, 'checkAllUnreadNotifications'])
        ->name('users.unread-notifications.check')->middleware(['can:update,user']);
});

/**
 * Search routes definitions.
 */
Route::get('/search', [SearchController::class, 'index'])
    ->name('search')->middleware(['auth']);

require __DIR__ . '/auth.php';
