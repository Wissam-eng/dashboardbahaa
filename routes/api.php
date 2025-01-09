<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\BookeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/contacts', [ContactsController::class, 'store_api'])->name('contacts.store_api');

Route::post('/bookes', [BookeController::class, 'store_api'])->name('contacts.store_api');

