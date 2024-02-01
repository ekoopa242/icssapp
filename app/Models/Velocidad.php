<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Velocidad extends Model
{
    use HasFactory;

    protected $fillable = [
        'cantVelocidad'
    ];


    public function plan()
    {
        return $this->hasMany(Plan::class);
    }
}
