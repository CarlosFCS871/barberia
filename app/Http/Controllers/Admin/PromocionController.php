<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promocion;
use App\Models\User;

class PromocionController extends Controller
{
    public function index(Request $request)
    {
        $query = Promocion::with('barbero');

        // 🔍 filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // 🔍 filtro por barbero
        if ($request->filled('barbero_id')) {
            $query->where('barbero_id', $request->barbero_id);
        }

        $promociones = $query->latest()->paginate(10)->withQueryString();

        $barberos = User::where('rol', 'barbero')->get();

        return view('admin.promociones.index', compact('promociones', 'barberos'));
    }

    public function show($id)
    {
        $promocion = Promocion::with('barbero')->findOrFail($id);

        return view('admin.promociones.show', compact('promocion'));
    }
}
