<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->get('/mytasks', function () {
    return view('myTask');
})->name('myTask');

Route::middleware(['auth:sanctum', 'verified'])->get('/rating/{task}', 'Rating@render')->name('rating');

Route::middleware(['auth:sanctum', 'verified'])->get('/task/{task}', 'TaskDetailsController@render')->name('task_detail');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/{user_id?}', 'DashController@render')->name('dashboard');

/* Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/{user_id?}', function ($user_id) {
    
    return view('dashboard');
})->name('dashboard'); */