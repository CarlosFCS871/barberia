<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';

    protected $fillable = [
        'barbero_id',
        'dia',
        'hora_inicio',
        'hora_fin',
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