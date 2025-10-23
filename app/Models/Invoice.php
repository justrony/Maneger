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
    ];

    public function purchase(){
        return $this->HasMany(Purchase::class, 'id', 'purchase_id');
    }
}
