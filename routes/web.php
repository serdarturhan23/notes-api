<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\NoteWebController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [NoteWebController::class, 'index'])->name('dashboard');
    Route::get('/notes/create', [NoteWebController::class, 'create'])->name('notes.create');
    Route::post('/notes', [NoteWebController::class, 'store'])->name('notes.store');
    Route::get('/notes/{note}/edit', [NoteWebController::class, 'edit'])->name('notes.edit');
    Route::put('/notes/{note}', [NoteWebController::class, 'update'])->name('notes.update');
    Route::delete('/notes/{note}', [NoteWebController::class, 'destroy'])->name('notes.destroy');
    Route::patch('/notes/{note}/complete', [NoteWebController::class, 'toggleComplete'])->name('notes.complete');
});