<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use App\Models\Promocion;
use App\Models\Testimonio;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $servicios = Servicio::latest()
            ->take(6)
            ->get();

        $promociones = Promocion::with('barbero')
            ->where('estado', 'activa')
            ->latest()
            ->take(6)
            ->get();

        $barberos = User::where('rol', 'barbero')
            ->latest()
            ->take(6)
            ->get();

       $testimonios = Testimonio::with('cliente')
    ->where('estado', 'aprobado')
    ->latest()
    ->take(6)
    ->get();

        return view('welcome', compact(
            'servicios',
            'promociones',
            'barberos',
            'testimonios'
        ));
    }
}