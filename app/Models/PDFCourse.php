<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PDFCourse extends Model
{
    protected $fillable = [
        'class_name','types','group','title','thumbnail','url','pdf'
    ];
}
