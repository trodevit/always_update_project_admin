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

// ===== Specific Routes =====

// SSC routes
Route::get('/ssc/subjects', [ShortcutController::class,'subjects']);
Route::get('/class/ssc/pdf/{group}', [PDFController::class,'classGroup']);
Route::get('/class/ssc/video/{group}', [PDFController::class,'videoclassGroup']);
Route::get('/class/ssc/shortcut/{group}', [ShortcutController::class,'index']);
Route::get('/class/ssc/shortcut/video/{group}', [ShortcutController::class,'videoindex']);
Route::get('/class/ssc/allpdf/{group}/{question_types}/{subject_id}', [ShortcutController::class,'allPDF']);
Route::get('/class/ssc/allpdf/video/{group}/{question_types}/{subject_id}', [ShortcutController::class,'videoallPDF']);
Route::get('/class/ssc/video/{group}/{subject_id}', [ShortcutController::class,'videoCourse']);
Route::get('/class/ssc/{id}', [PDFController::class,'classID']);

// HSC routes
Route::get('/hsc/subjects', [ShortcutController::class,'hscsubjects']);
Route::get('/hsc/pdf/{group}/{hsc_year}', [PDFController::class,'hscpdf']);
Route::get('/hsc/shortcut/{group}/{hsc_year}', [ShortcutController::class,'hscshortcut']);
Route::get('/hsc/allpdf/{group}/{question_types}/{subject_id}/{hsc_year}', [ShortcutController::class,'hscallPDF']);
Route::get('/hsc/class', [ShortcutController::class,'hscClassList']);

// Honors routes
Route::get('/honors/subjects', [ShortcutController::class,'honorssubjects']);
Route::get('/class/honors/group-pdf/{group}', [PDFController::class,'honorsGroup']);
Route::get('/class/honors/mcq/question/{group}/{subject_id}', [ShortcutController::class,'mcqQuestion']);

// ===== Generic Routes (Catch-all) =====
Route::get('/class/{id}', [ClassController::class,'show']);
Route::get('{class_name}/{check}', [ClassController::class,'rubayet']);
