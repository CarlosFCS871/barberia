<?php

namespace App\Http\Controllers\Barbero;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Venta;

class VentaController extends Controller
{
    /**
     * LISTADO
     */
    public function index(Request $request)
    {
        $query = Venta::with([
            'cliente',
            'barbero',
            'cita.servicio'
        ])
            ->where('barbero_id', Auth::id());

        // filtro estado
        if ($request->filled('estado_pago')) {

            $query->where('estado_pago', $request->estado_pago);
        }

        // filtro método
        if ($request->filled('metodo_pago')) {

            $query->where('metodo_pago', $request->metodo_pago);
        }

        $ventas = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        /**
         * 📊 ESTADÍSTICAS
         */

        $totalVentas = Venta::where('barbero_id', Auth::id())
            ->sum('total');

        $ventasPagadas = Venta::where('barbero_id', Auth::id())
            ->where('estado_pago', 'pagado')
            ->count();

        $ventasPendientes = Venta::where('barbero_id', Auth::id())
            ->where('estado_pago', 'pendiente')
            ->count();

        $ventasAnuladas = Venta::where('barbero_id', Auth::id())
            ->where('estado_pago', 'anulado')
            ->count();

        return view('barbero.ventas.index', compact(
            'ventas',
            'totalVentas',
            'ventasPagadas',
            'ventasPendientes',
            'ventasAnuladas'
        ));
    }

    /**
     * DETALLE
     */
    public function show($id)
    {
        $venta = Venta::with([
            'cliente',
            'barbero',
            'cita.servicio'
        ])
            ->where('barbero_id', Auth::id())
            ->findOrFail($id);

        return view('barbero.ventas.show', compact('venta'));
    }

    /**
     * EDITAR
     */
    public function edit($id)
    {
        $venta = Venta::where('barbero_id', Auth::id())
            ->findOrFail($id);

        return view('barbero.ventas.edit', compact('venta'));
    }

    /**
     * ACTUALIZAR
     */
    public function update(Request $request, $id)
    {
        $venta = Venta::where('barbero_id', Auth::id())
            ->findOrFail($id);

        $request->validate([

            'metodo_pago' => 'required|in:efectivo,yape,plin,tarjeta',

            'estado_pago' => 'required|in:pendiente,pagado,anulado',
        ]);

        $venta->update([

            'metodo_pago' => $request->metodo_pago,

            'estado_pago' => $request->estado_pago,
        ]);

        return redirect()
            ->route('barbero.ventas.index')
            ->with('success', 'Venta actualizada correctamente');
    }
}
