<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use App\Traits\UploadFile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;

abstract class Controller
{
    use UploadFile, ApiResponse, AuthorizesRequests, DispatchesJobs;
}
