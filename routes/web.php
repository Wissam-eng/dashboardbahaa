<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookeController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\UserController;

Route::get('/', fn() => view('auth.login'));


Route::get('/pusher', fn() => view('pusher'));

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/all_slides/{type}', [SlideController::class, 'all_slides']);

Route::get('/get_blog_data/{type}', [SlideController::class, 'get_blog']);




Route::resource('bookes', BookeController::class);
Route::resource('contacts', ContactsController::class);
Route::resource('dashboard', DashboardController::class);


Route::get('/users/trash', [UserController::class, 'trash'])->name('users.trash');
Route::delete('/users/{id}/delete', [UserController::class, 'delete'])->name('users.delete');

Route::post('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');



Route::get('/gallery/{id}', [SlideController::class, 'gallery'])->name('gallery');

Route::resource('users', UserController::class);


Route::resource('slides', SlideController::class);
Route::patch('/slides/{id}', [SlideController::class, 'update'])->name('slides.update');
Route::get('/slides/trash/{id}', [SlideController::class, 'trash'])->name('slides.trash');
Route::get('/gallery/trash/{id}', [SlideController::class, 'trash'])->name('slides.trash');
Route::delete('/slides/{id}/delete', [SlideController::class, 'delete'])->name('slides.delete');
Route::post('/slides/{id}/restore', [SlideController::class, 'restore'])->name('slides.restore');
Route::get('/slides.show_slides/{id}', [SlideController::class, 'showslides'])->name('slides.show_slides');
