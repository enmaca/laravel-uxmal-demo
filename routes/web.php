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

Route::get('/', [ \App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/components/forms', [ \App\Http\Controllers\ComponentsFormsController::class, 'index'])->name('components_forms');
Route::get('/components/forms/buttons', [ \App\Http\Controllers\ComponentsFormsController::class, 'buttons'])->name('components_forms_buttons');
Route::get('/components/forms/inputs', [ \App\Http\Controllers\ComponentsFormsController::class, 'inputs'])->name('components_forms_inputs');
Route::get('/components/ui/card', [ \App\Http\Controllers\ComponentsUiController::class, 'card'])->name('components_ui_card');
Route::get('/components/ui/modal', [ \App\Http\Controllers\ComponentsUiController::class, 'modal'])->name('components_ui_modal');
Route::get('/components/ui/table', [ \App\Http\Controllers\ComponentsUiController::class, 'table'])->name('components_ui_table');
Route::get('/components/ui/listjs', [ \App\Http\Controllers\ComponentsUiController::class, 'listjs'])->name('components_ui_listjs');
Route::get('/test', [ \App\Http\Controllers\HomeController::class, 'test'])->name('home');
