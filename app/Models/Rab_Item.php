<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rab_item extends Model
{
    use HasFactory;
    public $fillable = [
            'rab_id',
            'item_id',
            'item_discount',
            'item_count',
    ];

    public function rab()
    {
        return $this->belongsTo(Rab::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
