<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codigocliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigoCliente',
        'lugar',
        'estado'
    ];

    public function cliente()
    {
        return $this->hasMany(Cliente::class);
    }
}
