<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\BusinessController;
use App\Http\Controllers\Home\CustomController;

Route::get('/', [ BusinessController::class, 'page']);
Route::get('news/{id?}', [ BusinessController::class, 'list']);
Route::get('newsView/{id?}', [ BusinessController::class, 'listView']);
Route::get('product/{id?}', [ BusinessController::class, 'list']);
Route::get('productView/{id?}', [ BusinessController::class, 'listView']);
