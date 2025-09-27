<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'card';
    protected $fillable = [
        'name',
        'last_four',
        'maturity',
        'theme'
    ];

}
