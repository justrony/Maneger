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
        'invoice_id'
    ];

    public function card(){
        return $this->belongsTo(Card::class, 'id');
    }
}
