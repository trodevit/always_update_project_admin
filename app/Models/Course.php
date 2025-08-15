<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'class_name',
        'title',
        'short_description',
        'video_link',
        'pdf',
        'check'
    ];
}
