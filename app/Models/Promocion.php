<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promocion extends Model
{
    use HasFactory;

    protected $table = 'promociones';

    protected $fillable = [
        'barbero_id',
        'nombre',
        'descripcion',
        'imagen',
        'descuento',
        'fecha_inicio',
        'fecha_fin',
        'estado'
    ];

    /**
     * BARBERO
     */
    public function barbero()
    {
        return $this->belongsTo(User::class, 'barbero_id');
    }
}