<?php

use App\Http\Controllers\AuthController;
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

//Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\DashboardController::class, 'lang']);

// Route no-protected
Route::prefix('auth')->middleware('guest:client')->group(function () {
    // login
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth:client')->group(function () {
    Route::get('/', function () {

        return redirect('/dashboard');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index'])->name('project');
    Route::get('/objects', [App\Http\Controllers\ObjectController::class, 'index'])->name('object');
    Route::get('/objects/{id}', [App\Http\Controllers\ObjectController::class, 'details'])->name('object.details');
});
