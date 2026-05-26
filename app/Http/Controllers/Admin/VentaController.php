<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        $query = Venta::with(['cita', 'cliente', 'barbero']);

        // 🔍 filtro estado de pago
        if ($request->filled('estado_pago')) {
            $query->where('estado_pago', $request->estado_pago);
        }

        // 🔍 filtro metodo de pago
        if ($request->filled('metodo_pago')) {
            $query->where('metodo_pago', $request->metodo_pago);
        }

        $ventas = $query->latest()->paginate(10)->withQueryString();

        $totalVentas = Venta::sum('total');

        return view('admin.ventas.index', compact('ventas', 'totalVentas'));
    }

    public function show($id)
    {
        $venta = Venta::with(['cita', 'cliente', 'barbero'])->findOrFail($id);

        return view('admin.ventas.show', compact('venta'));
    }
}
