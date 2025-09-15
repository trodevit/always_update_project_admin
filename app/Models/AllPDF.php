<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllPDF extends Model
{
    protected $fillable = [
        'class_name','types','group','question_types','subjects','title','thumbnail','pdf','hsc_year'
    ];
}
