<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    protected $fillable = [
        'cita_id',
        'cliente_id',
        'barbero_id',
        'total',
        'metodo_pago',
        'estado_pago'
    ];

    /**
     * CITA
     */
    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

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
}