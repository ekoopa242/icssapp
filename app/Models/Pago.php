<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'montopagado',
        'mes',
        'estado',
        'tipopago',
        'comentario',
        'servicio_id'
    ];

    public function servicio(){
        return $this->belongsTo(Servicio::class);
    }
}
