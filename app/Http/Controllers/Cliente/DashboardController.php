<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cita;
use App\Models\Venta;

class DashboardController extends Controller
{
    public function index()
    {
        $clienteId = Auth::id();

        /**
         * =========================
         * ESTADÍSTICAS
         * =========================
         */

        $totalCitas = Cita::where('cliente_id', $clienteId)->count();

        $citasPendientes = Cita::where('cliente_id', $clienteId)
            ->where('estado', 'pendiente')
            ->count();

        $citasFinalizadas = Cita::where('cliente_id', $clienteId)
            ->where('estado', 'finalizado')
            ->count();

        $totalGastado = Venta::where('cliente_id', $clienteId)
            ->where('estado_pago', 'pagado')
            ->sum('total');

        /**
         * =========================
         * PRÓXIMAS CITAS
         * =========================
         */

        $proximasCitas = Cita::with([
            'barbero',
            'servicio'
        ])
            ->where('cliente_id', $clienteId)
            ->whereDate('fecha', '>=', now())
            ->orderBy('fecha')
            ->orderBy('hora')
            ->take(5)
            ->get();

        /**
         * =========================
         * HISTORIAL
         * =========================
         */

        $historialCitas = Cita::with([
            'barbero',
            'servicio'
        ])
            ->where('cliente_id', $clienteId)
            ->latest()
            ->take(10)
            ->get();

        return view('cliente.dashboard', compact(
            'totalCitas',
            'citasPendientes',
            'citasFinalizadas',
            'totalGastado',
            'proximasCitas',
            'historialCitas'
        ));
    }
}
