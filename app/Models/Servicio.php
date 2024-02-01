<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'ssid',
        'password',
        'fecha_inicio',
        'fecha_vence',
        'preciototal',
        'estado',
        'referencia',
        'latitud',
        'longitud',
        'user_id',
        'cliente_id',
        'plan_id',
        'equipo_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function plan(){
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function equipo(){
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }

    public function serviciodata(){
        return $this->hasOne(Serviciodata::class);
    }

    public function pago()
    {
        return $this->hasMany(Pago::class);
    }
}
