<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonio extends Model
{
    use HasFactory;

    protected $table = 'testimonios';

    protected $fillable = [
        'cliente_id',
        'comentario',
        'calificacion',
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