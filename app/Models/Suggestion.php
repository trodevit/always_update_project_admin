<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $fillable = [
        'class_name',
        'types',
        'title',
        'description',
        'image',
        'pdf',
        'official_url'
    ];
}
