<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CommonController;

Route::get('/{type}',[CommonController::class,'index']);
Route::get('/{type}/{id}',[CommonController::class,'show']);
