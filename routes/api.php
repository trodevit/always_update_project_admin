<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Use App\Http\Controllers\Api\FeatuerController;
use App\Http\Controllers\Web\DeviceController;
use App\Http\Middleware\CheckDeviceId;
use App\Http\Controllers\Api\PDFController;
use App\Http\Controllers\Api\ShortcutController;
use App\Http\Controllers\Api\ClassController;




Route::get('/notifications/center',[FeatuerController::class,'getnotification']);

Route::post('/device-id',[FeatuerController::class,'addDeviceId']);

Route::post('/login',[DeviceController::class,'login']);

//Route::group(['middleware' => CheckDeviceId::class], function () {
    Route::get('/class/ssc/pdf/{group}',[PDFController::class,'classGroup']);
    Route::get('/class/ssc/shortcut/{group}',[ShortcutController::class,'index']);
    Route::get('/class/ssc/allpdf/{group}/{question_types}/{subject_id}',[ShortcutController::class,'allPDF']);
    Route::get('/class/ssc/{id}',[PDFController::class,'classID']);
    Route::get('/subjects',[ShortcutController::class,'subjects']);

    Route::get('/class/{class_name}/{types}',[ClassController::class,'index']);
    Route::get('/class/{id}',[ClassController::class,'show']);
//});
