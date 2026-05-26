<?php

namespace App\Http\Controllers\Barbero;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cita;
use App\Models\Venta;
use Illuminate\Support\Facades\Mail;
use App\Mail\EstadoCitaClienteMail;

class CitaController extends Controller
{
    /**
     * LISTADO
     */
    public function index(Request $request)
    {
        $query = Cita::with([
            'cliente',
            'servicio'
        ])->where('barbero_id', Auth::id());

        // filtro estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // filtro fecha
        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->fecha);
        }

        $citas = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // 📊 estadísticas
        $pendientes = Cita::where('barbero_id', Auth::id())
            ->where('estado', 'pendiente')
            ->count();

        $confirmadas = Cita::where('barbero_id', Auth::id())
            ->where('estado', 'confirmada')
            ->count();

        $finalizadas = Cita::where('barbero_id', Auth::id())
            ->where('estado', 'finalizada')
            ->count();

        $canceladas = Cita::where('barbero_id', Auth::id())
            ->where('estado', 'cancelada')
            ->count();

        return view('barbero.citas.index', compact(
            'citas',
            'pendientes',
            'confirmadas',
            'finalizadas',
            'canceladas'
        ));
    }

    /**
     * DETALLE
     */
    public function show($id)
    {
        $cita = Cita::with([
            'cliente',
            'servicio'
        ])
            ->where('barbero_id', Auth::id())
            ->findOrFail($id);

        return view('barbero.citas.show', compact('cita'));
    }

    /**
     * EDITAR ESTADO
     */
    public function edit($id)
    {
        $cita = Cita::where('barbero_id', Auth::id())
            ->findOrFail($id);

        return view('barbero.citas.edit', compact('cita'));
    }

    /**
     * ACTUALIZAR ESTADO
     */
    public function update(Request $request, $id)
    {
        $cita = Cita::with('servicio')
            ->where('barbero_id', Auth::id())
            ->findOrFail($id);

        $request->validate([
            'estado' => 'required|in:pendiente,confirmada,cancelada,finalizada',
        ]);

        $estadoAnterior = $cita->estado;

        $cita->update([
            'estado' => $request->estado
        ]);

        $cita->load('cliente', 'barbero', 'servicio');

        Mail::to($cita->cliente->email)
            ->send(new EstadoCitaClienteMail($cita));

        /**
         * 💰 GENERAR VENTA AUTOMÁTICA
         */
        if (
            $estadoAnterior !== 'finalizada' &&
            $request->estado === 'finalizada'
        ) {

            $existeVenta = Venta::where('cita_id', $cita->id)->exists();

            if (!$existeVenta) {

                Venta::create([
                    'cita_id' => $cita->id,
                    'cliente_id' => $cita->cliente_id,
                    'barbero_id' => $cita->barbero_id,
                    'total' => $cita->servicio->precio ?? 0,
                    'metodo_pago' => 'efectivo',
                    'estado_pago' => 'pagado',
                ]);
            }
        }

        return redirect()
            ->route('barbero.citas.index')
            ->with('success', 'Estado de la cita actualizado');
    }
}
