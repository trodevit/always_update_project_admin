<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use App\Traits\UploadFile;

abstract class Controller
{
    use UploadFile, ApiResponse;
}
