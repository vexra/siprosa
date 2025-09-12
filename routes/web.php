<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [ArticleController::class, 'dashboard'])->middleware('verified')->name('dashboard');
    
    Route::get('/artikel-saya', [ArticleController::class, 'index'])->name('articles.index');
    Route::resource('articles', ArticleController::class)->except(['show', 'index']);
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminArticleController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/articles', [AdminArticleController::class, 'index'])->name('admin.articles.index');
    Route::put('/admin/articles/{article}/approve', [AdminArticleController::class, 'approve'])->name('admin.articles.approve');
    Route::put('/admin/articles/{article}/reject', [AdminArticleController::class, 'reject'])->name('admin.articles.reject');
    Route::get('/admin/articles/{article}/edit', [AdminArticleController::class, 'edit'])->name('admin.articles.edit');
    Route::put('/admin/articles/{article}', [AdminArticleController::class, 'update'])->name('admin.articles.update');

    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';