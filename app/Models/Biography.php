<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biography extends Model
{
    protected $table = 'biography';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name', 'photo', 'dr_text', 'ps_text', 'en_text'
    ];
}

