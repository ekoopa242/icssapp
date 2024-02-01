<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombrePlan',
        'precio',
        'velocidad_id'
    ];

    public function velocidad(){
        return $this->belongsTo(Velocidad::class, 'velocidad_id');
    }
}
