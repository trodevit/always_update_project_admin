<?php


use App\Http\Controllers\Web\AdminAuthController;
use App\Http\Controllers\Web\AllPDFController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\DeviceController;
use App\Http\Controllers\Web\HonorsQuestionController;
use App\Http\Controllers\Web\NoticeController;
use App\Http\Controllers\Web\PDFCourseController;
use App\Http\Controllers\Web\ResultController;
use App\Http\Controllers\Web\ScholarshipController;
use App\Http\Controllers\Web\ShortcutController;
use App\Http\Controllers\Web\SubjectController;
use App\Http\Controllers\Web\SuggestionController;
use App\Http\Controllers\Web\VideoCourseController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

Route::get('/',[AdminAuthController::class,'index'])->name('home');

Route::get('/login',[AdminAuthController::class,'loginPage'])->name('loginPage');
Route::post('/login',[AdminAuthController::class,'login'])->name('login');

Route::group(['middleware' => AdminAuth::class], function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::get('/subjects/create',[SubjectController::class,'create'])->name('subjects.create');
    Route::post('/subjects',[SubjectController::class,'store'])->name('subjects.store');
    Route::put('/subjects/{id}',[SubjectController::class,'update'])->name('subjects.update');
    Route::delete('/subjects/{id}',[SubjectController::class,'destroy'])->name('subjects.destroy');

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

    Route::get('/ssc/course/pdf',[PDFCourseController::class,'index'])->name('course.SSC');
    Route::get('/ssc/course/video-course',[PDFCourseController::class,'videoindex'])->name('course.SSC.video');
    Route::get('/honors/course/group-pdf',[PDFCourseController::class,'honorsindex'])->name('course.honors');
    Route::get('/ssc/course/pdf-course',[PDFCourseController::class,'create'])->name('course.SSC.PDF-Course');
    Route::get('/ssc/course/video-course/create',[PDFCourseController::class,'videocreate'])->name('course.SSC.video.create');
    Route::get('/honors/course/group-pdf/create',[PDFCourseController::class,'honorscreate'])->name('course.honors.create');
    Route::post('/ssc/course/pdf-course',[PDFCourseController::class,'store'])->name('course.SSC.Course');
    Route::get('/ssc/course/pdf-course/{id}',[PDFCourseController::class,'edit'])->name('course.SSC.edit');
    Route::patch('/ssc/course/pdf-course/{id}',[PDFCourseController::class,'update'])->name('course.SSC.update');
    Route::delete('/ssc/course/delete/{id}',[PDFCourseController::class,'destroy'])->name('course.SSC.delete');

    Route::get('/ssc/course/shortcut',[ShortcutController::class,'create'])->name('course.SSC.Shortcut');
    Route::get('/ssc/course/video/shortcut/create',[ShortcutController::class,'videocreate'])->name('course.SSC.Shortcut.video');
    Route::get('/ssc/course/shortcut-technique',[ShortcutController::class,'index'])->name('course.SSC.Shortcut.index');
    Route::get('/ssc/course/shortcut-technique/video',[ShortcutController::class,'videoindex'])->name('course.SSC.Shortcut.index.video');
    Route::post('/ssc/course/shortcut',[ShortcutController::class,'store'])->name('course.SSC.shortcut.store');
    Route::get('/ssc/course/shortcut/{id}',[ShortcutController::class,'edit'])->name('course.SSC.shortcut.edit');
    Route::patch('/ssc/course/shortcut/{id}',[ShortcutController::class,'update'])->name('course.SSC.shortcut.update');
//    Route::delete('/SSC/SSC/Delete/{id}',[ShortcutController::SSC,'destroy'])->name('SSC.SSC.shortcut.delete');

    Route::get('/ssc/course/all-pdf',[AllPDFController::class,'index'])->name('course.SSC.All-PDF');
    Route::get('/ssc/course/all-pdf/video',[AllPDFController::class,'videoindex'])->name('course.SSC.All-PDF.video');
    Route::get('/ssc/course/all-pdf/create',[AllPDFController::class,'create'])->name('course.SSC.All-PDF.create');
    Route::get('/ssc/course/all-pdf/video/create',[AllPDFController::class,'videocreate'])->name('course.SSC.All-PDF.create.video');
    Route::post('/ssc/course/all-pdf',[AllPDFController::class,'store'])->name('course.SSC.All-PDF.store');
    Route::get('/ssc/course/all-pdf/{id}',[AllPDFController::class,'edit'])->name('course.SSC.All-PDF.edit');
    Route::patch('/ssc/course/all-pdf/{id}',[AllPDFController::class,'update'])->name('course.SSC.All-PDF.update');
    Route::delete('/ssc/course/all-pdf/{id}',[AllPDFController::class,'destroy'])->name('course.SSC.All-PDF.delete');
    Route::get('/subjects/{id}/related-data', [AllPDFController::class, 'relatedData']);

    Route::get('/ssc/course/video/create',[VideoCourseController::class,'create'])->name('video.create');
    Route::get('/ssc/course/video',[VideoCourseController::class,'index'])->name('video.index');
    Route::post('/ssc/course/video',[VideoCourseController::class,'store'])->name('video.store');
    Route::get('/ssc/course/video/{id}/edit',[VideoCourseController::class,'edit'])->name('video.edit');
    Route::patch('/ssc/course/video/{id}/update',[VideoCourseController::class,'update'])->name('video.update');
    Route::delete('/ssc/course/video/{id}/delete',[VideoCourseController::class,'destroy'])->name('video.delete');

    Route::get('/honors/course/question/create',[HonorsQuestionController::class,'create'])->name('honors.create');
    Route::get('/honors/course/question',[HonorsQuestionController::class,'index'])->name('honors.index');
    Route::post('/honors/course/question',[HonorsQuestionController::class,'store'])->name('honors.store');
    Route::get('/honors/course/question/{id}/edit',[HonorsQuestionController::class,'edit'])->name('honors.edit');
    Route::patch('/honors/course/question/{id}/update',[HonorsQuestionController::class,'update'])->name('honors.update');
    Route::delete('/honors/course/question/{id}/delete',[HonorsQuestionController::class,'destroy'])->name('honors.delete');

    Route::get('/device_id',[DeviceController::class,'device_id'])->name('device_id');
    Route::post('/updatedeviceid/{device_id}',[DeviceController::class,'devicesUpdate'])->name('updatedeviceid');
    Route::delete('/delete/device/{id}',[\App\Http\Controllers\Api\FeatuerController::class,'delete'])->name('delete.device');
    Route::get('/logout',[AdminAuthController::class,'logout'])->name('logout');
});
