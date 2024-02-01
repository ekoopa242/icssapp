<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'sexo',
        'codigoCliente_id'
    ];

    public function codigocliente(){
        return $this->belongsTo(Codigocliente::class, 'codigoCliente_id');
    }

    public function servicio()
    {
        return $this->hasMany(Servicio::class);
    }
}
