<?php

use App\Http\Controllers\Web\ClassController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AdminAuthController;
use App\Http\Controllers\Web\DashboardController;

Route::get('/',[AdminAuthController::class,'index'])->name('home');

Route::post('/login',[AdminAuthController::class,'login'])->name('login');

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

Route::get('/classes',[ClassController::class,'index'])->name('class.index');
Route::get('/class/create',[ClassController::class,'create'])->name('class.create');
Route::post('/class/store',[ClassController::class,'store'])->name('class.store');
Route::get('/class/edit/{id}',[ClassController::class,'edit'])->name('class.edit');
Route::get('/class/show/{id}',[ClassController::class,'edit'])->name('class.show');
Route::post('/class/update/{id}',[ClassController::class,'update'])->name('class.update');
Route::get('/class/delete/{id}',[ClassController::class,'destroy'])->name('class.delete');
