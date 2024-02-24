<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $primaryKey = 'project_id';
    public $fillable = [
            'user_id',
            'client_name',
            'project_address',
            'project_name',
            'budget',
            'status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function rab()
    {
        return $this->hasMany(Rab::class);
    }
}
