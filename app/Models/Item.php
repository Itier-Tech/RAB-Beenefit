<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $primaryKey = 'item_id';
    public $fillable = [
            'item_name',
            'buy_price',
            'sell_price',
            'category',
            'unit'
    ];

    public function rab_item()
    {
        return $this->hasMany(RabItem::class);
    }
}
