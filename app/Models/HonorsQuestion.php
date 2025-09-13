<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HonorsQuestion extends Model
{
    protected $fillable = [
        'class_name', 'question','group','subject','title','pdf','thumbnail'
    ];
}
