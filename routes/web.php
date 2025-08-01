<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

Route::get('/{any}', function () {
    return file_get_contents(public_path('react/index.html'));
})->where('any', '.*');

