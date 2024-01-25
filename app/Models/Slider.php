<?php
// File: app/models/Slider.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';

    protected $fillable = [
        'language',
        'title',
        'text',
        'photo',
    ];
}

