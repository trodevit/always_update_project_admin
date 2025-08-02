<?php

use App\Http\Controllers\Web\ClassController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AdminAuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\SuggestionController;

Route::get('/',[AdminAuthController::class,'index'])->name('home');

Route::post('/login',[AdminAuthController::class,'login'])->name('login');

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

Route::get('/class',[ClassController::class,'index'])->name('class.index');
Route::get('/class/create',[ClassController::class,'create'])->name('class.create');
Route::post('/class/store',[ClassController::class,'store'])->name('class.store');
Route::get('/class/edit/{id}',[ClassController::class,'edit'])->name('class.edit');
Route::get('/class/show/{id}',[ClassController::class,'show'])->name('class.show');
Route::post('/class/update/{id}',[ClassController::class,'update'])->name('class.update');
Route::get('/class/delete/{id}',[ClassController::class,'destroy'])->name('class.delete');

Route::get('/suggestion/index',[SuggestionController::class,'index'])->name('suggestion.index');
Route::get('/suggestion/create',[SuggestionController::class,'create'])->name('suggestion.create');
Route::post('/common/store',[SuggestionController::class,'store'])->name('common.store');
Route::get('/suggestion/edit/{id}',[SuggestionController::class,'edit'])->name('suggestion.edit');
Route::get('/suggestion/show/{id}',[SuggestionController::class,'show'])->name('suggestion.show');
Route::post('/suggestion/update/{id}',[SuggestionController::class,'update'])->name('suggestion.update');
Route::get('/suggestion/delete/{id}',[SuggestionController::class,'destroy'])->name('suggestion.delete');
