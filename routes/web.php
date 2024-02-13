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

Route::get('/test', function(){
    \App\Models\User::where('email', 'javier.ciocci@sita.aero')
        ->update(['password' => \Hash::make('123456')]);
})->name('test');


Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
Route::post('/users/create', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::post('/users/{user}/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('users.delete');

Route::get('/analysts', [App\Http\Controllers\AnalystController::class, 'index'])->name('analysts');
Route::get('/analysts/{analyst}/edit', [App\Http\Controllers\AnalystController::class, 'edit'])->name('analysts.edit');
Route::post('/analysts/{analyst}/edit', [App\Http\Controllers\AnalystController::class, 'update'])->name('analysts.update');
Route::get('/analysts/create', [App\Http\Controllers\AnalystController::class, 'create'])->name('analysts.create');
Route::post('/analysts/create', [App\Http\Controllers\AnalystController::class, 'store'])->name('analysts.store');

Route::get('/groups', [App\Http\Controllers\GroupController::class, 'index'])->name('groups');
Route::get('/groups/create', [App\Http\Controllers\GroupController::class, 'create'])->name('groups.create');
Route::post('/groups/create', [App\Http\Controllers\GroupController::class, 'store'])->name('groups.store');
Route::get('/groups/{id}/edit', [App\Http\Controllers\GroupController::class, 'edit'])->name('groups.edit');
Route::post('/groups/{id}/edit', [App\Http\Controllers\GroupController::class, 'update'])->name('groups.update');

Route::get('/surveys', [App\Http\Controllers\SurveyController::class, 'index'])->name('surveys');
Route::get('/surveys/create', [App\Http\Controllers\SurveyController::class, 'create'])->name('surveys.create');
Route::post('/surveys/create', [App\Http\Controllers\SurveyController::class, 'store'])->name('surveys.store');
Route::get('/surveys/{survey}/edit', [App\Http\Controllers\SurveyController::class, 'edit'])->name('surveys.edit');
Route::post('/surveys/{id}/edit', [App\Http\Controllers\SurveyController::class, 'update'])->name('surveys.update');

Route::get('/services', [App\Http\Controllers\ServiceController::class, 'index'])->name('services');
Route::get('/services/create', [App\Http\Controllers\ServiceController::class, 'create'])->name('services.create');
Route::post('/services/create', [App\Http\Controllers\ServiceController::class, 'store'])->name('services.store');
Route::get('/services/{id}/edit', [App\Http\Controllers\ServiceController::class, 'show'])->name('services.show');
Route::post('/services/{id}/edit', [App\Http\Controllers\ServiceController::class, 'update'])->name('services.update');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
Route::post('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.update.password');

Route::get('/tickets', [App\Http\Controllers\TicketController::class, 'index'])->name('tickets');
Route::get('/tickets/download', [App\Http\Controllers\TicketDownloadController::class, 'index'])->name('tickets');
Route::get('/tickets/upload', [App\Http\Controllers\TicketUploadController::class, 'index'])->name('tickets');
Route::get('/tickets/{id}/show', [App\Http\Controllers\TicketController::class, 'show'])->name('tickets.show');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');