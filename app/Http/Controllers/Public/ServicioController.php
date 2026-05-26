<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function servicios()
    {
        $servicios = Servicio::with('barbero')
            ->where('estado', 'activo')
            ->latest()
            ->get();

        return view('publico.servicios', compact('servicios'));
    }
}
