<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/home', [TodoController::class, 'index'])->name('home');
Route::post('/create', [TodoController::class, 'create'])->name('create');
Route::post('/{id}/update', [TodoController::class, 'update'])->name('update');
Route::post('/{id}/delete', [TodoController::class, 'delete'])->name('delete');
Route::get('/find', [TodoController::class, 'find'])->name('find');
Route::get('/find/search', [TodoController::class, 'search'])->name('search');

require __DIR__.'/auth.php';
