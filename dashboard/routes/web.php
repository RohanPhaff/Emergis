<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\UsersController;
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

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.index');

Route::resource('/projects', App\Http\Controllers\ProjectController::class)->middleware(['auth', 'verified']);
Route::resource('/programs', App\Http\Controllers\ProgramController::class)->middleware(['auth', 'verified']);

Route::get('/admin', [UsersController::class, 'index'])
    ->middleware(['auth', 'verified', 'can:access-admin'])
    ->name('admin.index');

Route::put('/admin/{users}', [UsersController::class, 'update'])
    ->middleware(['auth', 'verified', 'can:access-admin'])
    ->name('admin.update');

Route::get('/invite', [UsersController::class, 'invite'])
    ->middleware(['auth', 'verified'])
    ->name('invite');

Route::put('/sendInvite', [UsersController::class, 'sendInvite'])
    ->middleware(['auth', 'verified'])
    ->name('sendInvite');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->middleware(['auth', 'verified'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->middleware(['auth', 'verified'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->middleware(['auth', 'verified'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
