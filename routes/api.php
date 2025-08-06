<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CommonController;

Route::get('/class_list',[CommonController::class,'class_list']);
Route::get('/class/{id}/{type}',[CommonController::class,'class_detail']);
Route::get('/{type}',[CommonController::class,'index']);
Route::get('/{type}/{id}',[CommonController::class,'show']);
