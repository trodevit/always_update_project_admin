<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoCourse extends Model
{
    protected $fillable = [
        'class_name','types','group','subjects','title','thumbnail','url'
    ];
}
