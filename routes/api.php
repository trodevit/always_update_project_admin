<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Use App\Http\Controllers\Api\FeatuerController;
use App\Http\Controllers\Web\DeviceController;
use App\Http\Middleware\CheckDeviceId;
use App\Http\Controllers\Api\PDFController;
use App\Http\Controllers\Api\ShortcutController;




Route::get('/notifications/center',[FeatuerController::class,'getnotification']);

Route::post('/device-id',[FeatuerController::class,'addDeviceId']);

Route::post('/login',[DeviceController::class,'login']);

//Route::group(['middleware' => CheckDeviceId::SSC], function () {
    Route::get('/SSC/SSC/PDF/{group}',[PDFController::class,'classGroup']);
    Route::get('/SSC/SSC/Shortcut/{group}',[ShortcutController::class,'index']);
    Route::get('/SSC/SSC/{id}',[PDFController::class,'classID']);


//});
