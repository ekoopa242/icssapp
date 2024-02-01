<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;


    protected $fillable = [
        'modelo',
        'mac',
        'tipoEquipo',
        'estado'
    ];

    public function servicio()
    {
        return $this->hasMany(Servicio::class);
    }
}
