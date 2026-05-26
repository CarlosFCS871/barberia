<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class CitaController extends Controller
{
    public function index(Request $request)
    {
        $query = Cita::with(['cliente', 'barbero', 'servicio']);

        // 🔍 filtro por barbero
        if ($request->filled('barbero_id')) {
            $query->where('barbero_id', $request->barbero_id);
        }

        // 🔍 filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // 🔍 filtro por fecha
        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->fecha);
        }

        $citas = $query->latest()->paginate(10)->withQueryString();

        $barberos = User::where('rol', 'barbero')->get();

        return view('admin.citas.index', compact('citas', 'barberos'));
    }

    public function show($id)
    {
        $cita = Cita::with(['cliente', 'barbero', 'servicio'])->findOrFail($id);

        return view('admin.citas.show', compact('cita'));
    }


    public function finalizarCita($id)
    {
        DB::transaction(function () use ($id) {

            $cita = Cita::findOrFail($id);

            $cita->estado = 'finalizado';
            $cita->save();

            Venta::create([
                'cita_id' => $cita->id,
                'cliente_id' => $cita->cliente_id,
                'barbero_id' => $cita->barbero_id,
                'total' => $cita->servicio->precio ?? 0,
                'metodo_pago' => 'efectivo',
                'estado_pago' => 'pagado',
            ]);
        });

        return back()->with('success', 'Cita finalizada y venta generada');
    }
}
