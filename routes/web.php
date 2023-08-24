<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');

Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');

Route::post('/users/create', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');

Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');

Route::post('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');

Route::post('/users/{id}/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('users.delete');

Route::get('/analysts', [App\Http\Controllers\AnalystController::class, 'index'])->name('analysts');

Route::get('/analysts/{id}/edit', [App\Http\Controllers\AnalystController::class, 'edit'])->name('analysts.edit');

Route::post('/analysts/{id}/edit', [App\Http\Controllers\AnalystController::class, 'update'])->name('analysts.update');

Route::get('/analysts/create', [App\Http\Controllers\AnalystController::class, 'create'])->name('analysts.create');

Route::post('/analysts/create', [App\Http\Controllers\AnalystController::class, 'store'])->name('analysts.store');

Route::get('/groups', [App\Http\Controllers\GroupController::class, 'index'])->name('groups');

Route::get('/groups/create', [App\Http\Controllers\GroupController::class, 'create'])->name('groups.create');

Route::post('/groups/create', [App\Http\Controllers\GroupController::class, 'store'])->name('groups.store');

Route::get('/groups/{id}/edit', [App\Http\Controllers\GroupController::class, 'edit'])->name('groups.edit');

Route::post('/groups/{id}/edit', [App\Http\Controllers\GroupController::class, 'update'])->name('groups.update');




