<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tlog extends Model
{
    use HasFactory;

    protected $fillable = [
        'movimiento',
        'mensaje',
        'empleado_id'
    ];

    public function empleado(){
        return $this->belongsTo(Empleado::class);
    }

}
