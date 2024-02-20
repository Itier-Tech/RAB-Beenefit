<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rab extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $fillable = [
            'project_id',
            'status',
            'rab_discount',
            'total_price',
    ];
    
    public function project() 
    {
        return $this->belongsTo(Project::class);
    }

    public function rab_item()
    {
        return $this->hasMany(Rab_item::class);
    }
}
