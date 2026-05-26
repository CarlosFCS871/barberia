<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contacto extends Model
{
    use HasFactory;

    protected $table = 'contactos';

    protected $fillable = [
        'cliente_id',
        'nombre',
        'correo',
        'telefono',
        'mensaje',
        'estado'
    ];

    /**
     * CLIENTE
     */
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }
}