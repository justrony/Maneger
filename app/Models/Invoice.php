<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    protected $fillable = [
            'name',
            'card_id',
            'purchase_id',
            'status',
            'open'
    ];

    public function purchase(){
        return $this->HasMany(Purchase::class, 'invoice_id','id' );
    }
    public function card(){
        return $this->belongsTo(Card::class, 'card_id','id' );
    }
}
