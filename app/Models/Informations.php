<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informations extends Model
{
    protected $table = 'informations';

    protected $fillable = [
        'type',
        'dr_text',
        'ps_text',
        'en_text',
    ];
}
