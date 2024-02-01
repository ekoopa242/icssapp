<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serviciodata extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_port',
        'OLT_port',
        'ONT_ID',
        'PPPOE',
        'SN',
        'VLAN',
        'servicio_id'
    ];

    public function servicio(){
        return $this->belongsTo(Servicio::class);
    }
}
