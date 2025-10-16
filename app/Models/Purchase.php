<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchase';
    protected $fillable = [
        'name',
        'store',
        'description',
        'price',
        'card_id'
    ];

    public function card(){
        return $this->belongsTo(Card::class, 'card_id');
    }
}
