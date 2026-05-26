<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'cliente_id',
        'barbero_id',
        'servicio_id',
        'fecha',
        'hora',
        'estado'
    ];

    /**
     * CLIENTE
     */
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    /**
     * BARBERO
     */
    public function barbero()
    {
        return $this->belongsTo(User::class, 'barbero_id');
    }

    /**
     * SERVICIO
     */
    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    /**
     * VENTA
     */
    public function venta()
    {
        return $this->hasOne(Venta::class);
    }
}