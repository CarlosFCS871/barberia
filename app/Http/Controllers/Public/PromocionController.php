<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promocion;

class PromocionController extends Controller
{
    public function index()
    {
        $promociones = Promocion::with('barbero')
            ->where('estado', 'activa')
            ->latest()
            ->get();

        return view('publico.promociones', compact('promociones'));
    }
}
