<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Common extends Model
{
    protected $fillable = [
        'class_id',
        'title',
        'description',
        'image',
        'pdf',
        'offical_url',
        'check'
    ];
}
