<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Use App\Http\Controllers\Api\FeatuerController;
use App\Http\Controllers\Web\DeviceController;
use App\Http\Middleware\CheckDeviceId;
use App\Http\Controllers\Api\PDFController;




Route::get('/notifications/center',[FeatuerController::class,'getnotification']);

Route::post('/device-id',[FeatuerController::class,'addDeviceId']);

Route::post('/login',[DeviceController::class,'login']);

//Route::group(['middleware' => CheckDeviceId::class], function () {
    Route::get('/class/SSC',[PDFController::class,'className']);
    Route::get('/class/SSC/PDF',[PDFController::class,'classPDF']);
    Route::get('/class/SSC/PDF/{group}',[PDFController::class,'classGroup']);
    Route::get('/class/{id}',[PDFController::class,'classID']);
//});
