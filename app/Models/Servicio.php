<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';

    protected $fillable = [
        'barbero_id',
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'estado'
    ];

    /**
     * BARBERO
     */
    public function barbero()
    {
        return $this->belongsTo(User::class, 'barbero_id');
    }

    /**
     * CITAS
     */
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}