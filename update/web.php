<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

Route::get('/', fn() => view('auth.login'));

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/all_slides/{type}', [SlideController::class, 'all_slides']);


Route::get('/slides.show_slides/{id}', [SlideController::class, 'showslides'])->name('slides.show_slides');
Route::get('/slides/trash/{id}', [SlideController::class, 'trash'])->name('slides.trash');
Route::post('/slides/{id}/restore', [SlideController::class, 'restore'])->name('slides.restore');
Route::delete('/slides/{id}/delete', [SlideController::class, 'delete'])->name('slides.delete');
Route::patch('/slides/{id}', [SlideController::class, 'update'])->name('slides.update');
Route::resource('slides', SlideController::class);

Route::resource('dashboard', DashboardController::class);
