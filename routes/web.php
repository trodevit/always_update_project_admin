<?php


use App\Http\Controllers\Web\AdminAuthController;
use App\Http\Controllers\Web\AllClassController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\DeviceController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

Route::get('/',[AdminAuthController::class,'index'])->name('home');

Route::get('/login',[AdminAuthController::class,'loginPage'])->name('loginPage');
Route::post('/login',[AdminAuthController::class,'login'])->name('login');

Route::group(['middleware' => AdminAuth::class], function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::get('/class/SSC',[AllClassController::class,'index'])->name('class.SSC');
    Route::get('/class/SSC/PDF-Course',[AllClassController::class,'create'])->name('class.SSC.PDF-Course');
    Route::post('/class/SSC/PDF-Course',[AllClassController::class,'store'])->name('class.SSC.Course');
    Route::get('/class/SSC/PDF-Course/{id}',[AllClassController::class,'edit'])->name('class.SSC.edit');
    Route::patch('/class/SSC/PDF-Course/{id}',[AllClassController::class,'update'])->name('class.SSC.update');
    Route::delete('/class/SSC/Delete/{id}',[AllClassController::class,'destroy'])->name('class.SSC.delete');

    Route::get('/device_id',[DeviceController::class,'device_id'])->name('device_id');
    Route::post('/updatedeviceid/{device_id}',[DeviceController::class,'devicesUpdate'])->name('updatedeviceid');
    Route::delete('/delete/device/{id}',[\App\Http\Controllers\Api\FeatuerController::class,'delete'])->name('delete.device');
    Route::get('/logout',[AdminAuthController::class,'logout'])->name('logout');
});
