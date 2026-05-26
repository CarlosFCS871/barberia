<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Servicio;
use App\Models\Promocion;

class BarberoController extends Controller
{
    public function index()
    {
        $barberos = User::where('rol', 'barbero')
            ->where('estado', 'activo')
            ->latest()
            ->get();

        return view('publico.barberos', compact('barberos'));
    }

    public function show($id)
    {
        $barbero = User::where('rol', 'barbero')
            ->where('estado', 'activo')
            ->findOrFail($id);

        $servicios = Servicio::where('barbero_id', $barbero->id)
            ->where('estado', 'activo')
            ->latest()
            ->get();

        $promociones = Promocion::where('barbero_id', $barbero->id)
            ->where('estado', 'activa')
            ->latest()
            ->get();

        return view('publico.barberosShow', compact(
            'barbero',
            'servicios',
            'promociones'
        ));
    }
}
