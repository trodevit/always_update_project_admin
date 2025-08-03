<?php

use App\Http\Controllers\Web\ClassController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AdminAuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\SuggestionController;
use App\Http\Controllers\Web\Scholarship;
use App\Http\Controllers\Web\Result;
use App\Http\Controllers\Web\Notice;
use App\Http\Middleware\AdminAuth;

Route::get('/',[AdminAuthController::class,'index'])->name('home');

Route::get('/login',[AdminAuthController::class,'loginPage'])->name('loginPage');
Route::post('/login',[AdminAuthController::class,'login'])->name('login');

Route::group(['middleware' => AdminAuth::class], function () {
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
Route::get('/{type}/edit/{id}',[SuggestionController::class,'edit'])->name('common.edit');
Route::get('/{type}/show/{id}',[SuggestionController::class,'show'])->name('common.show');
Route::post('/{type}/update/{id}',[SuggestionController::class,'update'])->name('common.update');
Route::get('/{type}/delete/{id}',[SuggestionController::class,'destroy'])->name('common.delete');

Route::get('/scholarship/index',[Scholarship::class,'index'])->name('scholarship.index');
Route::get('/scholarship/create',[Scholarship::class,'create'])->name('scholarship.create');

Route::get('/result/index',[Result::class,'index'])->name('result.index');
Route::get('/result/create',[Result::class,'create'])->name('result.create');

Route::get('/notice/index',[Notice::class,'index'])->name('notice.index');
Route::get('/notice/create',[Notice::class,'create'])->name('notice.create');

Route::get('/logout',[AdminAuthController::class,'logout'])->name('logout');
});
