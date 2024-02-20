<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $fillable = [
            'user_id',
            'client_name',
            'project_address',
            'project_name',
            'budget',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function rab()
    {
        return $this->hasMany(Rab::class);
    }

    public function status()
    {
        $allRab = $this->rab;
        if (count($allRab) > 0) {
            $allRabFinished = $this->rab->every(function ($rab) {
                return $rab->status === 1;
            });
            return $allRabFinished;
        } else {
            return 0;
        }
    }
}
