<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $primaryKey = 'user_id';
    public $fillable = [
            'full_name',
            'phone',
            'email',
            'password',
            'company_name',
            'company_address',
            'company_phone',
            'company_logo_path',
    ];

    public function project() : HasMany
    {
        return $this->hasMany(Project::class);
    }
}
