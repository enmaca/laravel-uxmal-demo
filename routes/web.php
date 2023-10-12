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

Route::get('/components', [ \App\Http\Controllers\ComponentsController::class, 'index'])->name('components');
Route::get('/components/buttons', [ \App\Http\Controllers\ComponentsController::class, 'buttons'])->name('components_buttons');
Route::get('/components/inputs', [ \App\Http\Controllers\ComponentsController::class, 'inputs'])->name('components_input');
