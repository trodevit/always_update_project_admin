<?php


use App\Http\Controllers\Web\AdminAuthController;
use App\Http\Controllers\Web\PDFCourseController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\DeviceController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ShortcutController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\NoticeController;

Route::get('/',[AdminAuthController::class,'index'])->name('home');

Route::get('/login',[AdminAuthController::class,'loginPage'])->name('loginPage');
Route::post('/login',[AdminAuthController::class,'login'])->name('login');

Route::group(['middleware' => AdminAuth::class], function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::get('/class/suggestion/create',[SuggestionController::class,'create'])->name('suggestion.create');
    Route::get('/class/suggestion',[SuggestionController::class,'index'])->name('suggestion.index');
    Route::post('/class/suggestion/store',[SuggestionController::class,'store'])->name('suggestion.store');
    Route::get('/class/suggestion/edit/{id}',[SuggestionController::class,'edit'])->name('suggestion.edit');
    Route::patch('/class/suggestion/upload/{id}',[SuggestionController::class,'update'])->name('suggestion.update');
    Route::delete('/class/suggestion/delete/{id}',[SuggestionController::class,'destroy'])->name('suggestion.delete');


    Route::get('/class/scholarship/create',[ScholarshipController::class,'create'])->name('scholarship.create');
    Route::get('/class/scholarship',[ScholarshipController::class,'index'])->name('scholarship.index');
    Route::post('/class/scholarship/store',[ScholarshipController::class,'store'])->name('scholarship.store');
    Route::get('/class/scholarship/edit/{id}',[ScholarshipController::class,'edit'])->name('scholarship.edit');
    Route::patch('/class/scholarship/upload/{id}',[ScholarshipController::class,'update'])->name('scholarship.update');
    Route::delete('/class/scholarship/delete/{id}',[ScholarshipController::class,'destroy'])->name('scholarship.delete');

    Route::get('/class/result/create',[ResultController::class,'create'])->name('result.create');
    Route::get('/class/result',[ResultController::class,'index'])->name('result.index');
    Route::post('/class/result/store',[ResultController::class,'store'])->name('result.store');
    Route::get('/class/result/edit/{id}',[ResultController::class,'edit'])->name('result.edit');
    Route::patch('/class/result/upload/{id}',[ResultController::class,'update'])->name('result.update');
    Route::delete('/class/result/delete/{id}',[ResultController::class,'destroy'])->name('result.delete');

    Route::get('/class/notice/create',[NoticeController::class,'create'])->name('notice.create');
    Route::get('/class/notice',[NoticeController::class,'index'])->name('notice.index');
    Route::post('/class/notice/store',[NoticeController::class,'store'])->name('notice.store');
    Route::get('/class/notice/edit/{id}',[NoticeController::class,'edit'])->name('notice.edit');
    Route::patch('/class/notice/upload/{id}',[NoticeController::class,'update'])->name('notice.update');
    Route::delete('/class/notice/delete/{id}',[NoticeController::class,'destroy'])->name('notice.delete');

    Route::get('/ssc/course/PDF',[PDFCourseController::class,'index'])->name('course.SSC');
    Route::get('/ssc/course/PDF-Course',[PDFCourseController::class,'create'])->name('course.SSC.PDF-Course');
    Route::post('/ssc/course/PDF-Course',[PDFCourseController::class,'store'])->name('course.SSC.Course');
    Route::get('/ssc/course/PDF-Course/{id}',[PDFCourseController::class,'edit'])->name('course.SSC.edit');
    Route::patch('/ssc/course/PDF-Course/{id}',[PDFCourseController::class,'update'])->name('course.SSC.update');
    Route::delete('/ssc/course/Delete/{id}',[PDFCourseController::class,'destroy'])->name('course.SSC.delete');

    Route::get('/ssc/course/Shortcut',[ShortcutController::class,'create'])->name('course.SSC.Shortcut');
    Route::get('/ssc/course/Shortcut-Technique',[ShortcutController::class,'index'])->name('course.SSC.Shortcut.index');
    Route::post('/ssc/course/Shortcut',[ShortcutController::class,'store'])->name('course.SSC.shortcut.store');
    Route::get('/ssc/course/Shortcut/{id}',[ShortcutController::class,'edit'])->name('course.SSC.shortcut.edit');
    Route::patch('/ssc/course/Shortcut/{id}',[ShortcutController::class,'update'])->name('course.SSC.shortcut.update');
//    Route::delete('/SSC/SSC/Delete/{id}',[ShortcutController::SSC,'destroy'])->name('SSC.SSC.shortcut.delete');


    Route::get('/device_id',[DeviceController::class,'device_id'])->name('device_id');
    Route::post('/updatedeviceid/{device_id}',[DeviceController::class,'devicesUpdate'])->name('updatedeviceid');
    Route::delete('/delete/device/{id}',[\App\Http\Controllers\Api\FeatuerController::class,'delete'])->name('delete.device');
    Route::get('/logout',[AdminAuthController::class,'logout'])->name('logout');
});
