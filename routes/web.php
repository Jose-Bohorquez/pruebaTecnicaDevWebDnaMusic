<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\HomeController;

// Ruta principal
Route::get('/', function () {
    return view('index');
});

// Rutas de autenticación
Auth::routes();

// Ruta para el home después de iniciar sesión
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    // Rutas para la gestión de tareas
    Route::resource('tasks', TaskController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/run-scheduler', function () {
    Artisan::call('schedule:run');
    return 'Scheduler run!';
});
