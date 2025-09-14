<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use App\Traits\UploadFile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    use UploadFile, ApiResponse, AuthorizesRequests;
}
