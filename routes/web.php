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
    return redirect('dashboard');
    return view('welcome');
});
Route::get('/home', function () {
    return redirect('dashboard');
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
Route::post('/users/{user}/password', [App\Http\Controllers\UserController::class, 'password'])->name('users.password');

Route::get('/analysts', [App\Http\Controllers\AnalystController::class, 'index'])->name('analysts');
Route::get('/analysts/{analyst}/edit', [App\Http\Controllers\AnalystController::class, 'edit'])->name('analysts.edit');
Route::post('/analysts/{analyst}/edit', [App\Http\Controllers\AnalystController::class, 'update'])->name('analysts.update');
Route::get('/analysts/create', [App\Http\Controllers\AnalystController::class, 'create'])->name('analysts.create');
Route::post('/analysts/create', [App\Http\Controllers\AnalystController::class, 'store'])->name('analysts.store');
Route::get('analysts/qsearch', [App\Http\Controllers\AnalystController::class, 'qsearch'])->name('analysts.qsearch');


Route::get('/groups', [App\Http\Controllers\GroupController::class, 'index'])->name('groups');
Route::get('/groups/create', [App\Http\Controllers\GroupController::class, 'create'])->name('groups.create');
Route::post('/groups/create', [App\Http\Controllers\GroupController::class, 'store'])->name('groups.store');
Route::get('/groups/{id}/edit', [App\Http\Controllers\GroupController::class, 'edit'])->name('groups.edit');
Route::post('/groups/{id}/edit', [App\Http\Controllers\GroupController::class, 'update'])->name('groups.update');
Route::get('/groups/{name}/analysts', [App\Http\Controllers\GroupController::class, 'getAnalysts'])->name('groups.getAnalysts');


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
Route::post('/profile/password', [App\Http\Controllers\ProfileController::class, 'password'])->name('profile.update.password');

Route::get('/tickets', [App\Http\Controllers\TicketController::class, 'index'])->name('tickets');
Route::get('/tickets/qsearch', [App\Http\Controllers\TicketController::class, 'qsearch'])->name('qsearch');
Route::get('/tickets/{ticket}/show', [App\Http\Controllers\TicketController::class, 'show'])->name('tickets.show');
Route::post('/tickets/{ticket}/delete', [App\Http\Controllers\TicketController::class, 'destroy'])->name('tickets.delete');
Route::post('/tickets/{id}/begin', [App\Http\Controllers\TicketSurveyController::class, 'store'])->name('tickets.begin');
Route::post('/tickets/{ticket}/update', [App\Http\Controllers\TicketSurveyController::class, 'update'])->name('tickets.update');
Route::post('/tickets/{ticket}/finished', [App\Http\Controllers\TicketSurveyController::class, 'finished'])->name('tickets.finished');
Route::post('/tickets/{ticket}/coached', [App\Http\Controllers\TicketSurveyController::class, 'coached'])->name('tickets.coached');
Route::get('/tickets/create/{id}', [App\Http\Controllers\TicketController::class, 'create'])->name('tickets.create');
Route::post('/tickets/createandstart', [App\Http\Controllers\TicketController::class, 'createAndStartSurvey'])->name('tickets.createAndStartSurvey');

Route::get('/tickets/download', [App\Http\Controllers\TicketDownloadController::class, 'index'])->name('tickets.download');
Route::post('/tickets/download', [App\Http\Controllers\TicketDownloadController::class, 'download']);
Route::get('/tickets/upload', [App\Http\Controllers\TicketUploadController::class, 'index'])->name('tickets.upload');
Route::post('/tickets/upload', [App\Http\Controllers\TicketUploadController::class, 'upload']);


Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');


Route::get('/dashboard/chart/groups', [App\Http\Controllers\ChartController::class, 'barByGroupByMonth'] );
Route::get('/dashboard/chart/pie', [App\Http\Controllers\ChartController::class, 'pieByTeam'] );