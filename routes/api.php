<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CommonController;
Use App\Http\Controllers\Api\CourseAPIController;

Route::get('/class_list',[CommonController::class,'class_list']);
Route::get('/class/{id}/{type}',[CommonController::class,'class_detail']);
Route::get('/{type}',[CommonController::class,'index']);
Route::get('{type}/{id}',[CommonController::class,'show']);

Route::get('/all-course/{check}',[CourseAPIController::class,'allCourses']);
Route::get('/single-course/{course_id}',[CourseAPIController::class,'singleCourse']);
Route::get('/class-course/{class_name}',[CourseAPIController::class,'classCourses']);
