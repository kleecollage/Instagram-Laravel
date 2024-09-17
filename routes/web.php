<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home')
    ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/configuration', [UserController::class, 'config'])->name('config');
    Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/avatar/{filename}', [UserController::class, 'getImage'])->name('user.avatar');

    Route::get('/upload-image', [ImageController::class, 'create'])->name('image.create');
    Route::post('/image/save', [ImageController::class, 'save'])->name('image.save');
    Route::get('/image/file/{filename}', [ImageController::class, 'getImage'])->name('image.file');
    Route::get('/image/{id}', [ImageController::class, 'detail'])->name('image.detail');

    Route::post('comment/save', [CommentController::class, 'save'])->name('comment.save');
    Route::get('/comment/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');

    Route::get('/like/{image_id}', [LikeController::class, 'like'])->name('like.save');
    Route::get('/dislike/{image_id}', [LikeController::class, 'dislike'])->name('like.delete');
});

require __DIR__.'/auth.php';
