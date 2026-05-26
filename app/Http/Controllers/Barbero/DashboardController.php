<?php

namespace App\Http\Controllers\Barbero;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cita;
use App\Models\Venta;
use App\Models\Servicio;
use App\Models\Promocion;

class DashboardController extends Controller
{
    public function index()
    {
        $barberoId = Auth::id();

        /**
         * =========================
         * ESTADÍSTICAS
         * =========================
         */

        $totalCitas = Cita::where('barbero_id', $barberoId)->count();

        $citasHoy = Cita::where('barbero_id', $barberoId)
            ->whereDate('fecha', now())
            ->count();

        $ventasHoy = Venta::where('barbero_id', $barberoId)
            ->whereDate('created_at', now())
            ->sum('total');

        $ingresosTotales = Venta::where('barbero_id', $barberoId)
            ->where('estado_pago', 'pagado')
            ->sum('total');

        $serviciosActivos = Servicio::where('barbero_id', $barberoId)
            ->where('estado', 'activo')
            ->count();

        $promocionesActivas = Promocion::where('barbero_id', $barberoId)
            ->where('estado', 'activa')
            ->count();

        /**
         * =========================
         * ÚLTIMAS CITAS
         * =========================
         */

        $ultimasCitas = Cita::with(['cliente', 'servicio'])
            ->where('barbero_id', $barberoId)
            ->latest()
            ->take(5)
            ->get();

        /**
         * =========================
         * ÚLTIMAS VENTAS
         * =========================
         */

        $ultimasVentas = Venta::with([
            'cliente',
            'cita.servicio'
        ])
            ->where('barbero_id', $barberoId)
            ->latest()
            ->take(5)
            ->get();

        /**
         * =========================
         * HORARIOS HOY
         * =========================
         */

        $horariosHoy = Cita::with([
            'cliente',
            'servicio'
        ])
            ->where('barbero_id', $barberoId)
            ->whereDate('fecha', now())
            ->orderBy('hora')
            ->get();

        /**
         * =========================
         * PROMOCIONES ACTIVAS
         * =========================
         */

        $promociones = Promocion::where('barbero_id', $barberoId)
            ->where('estado', 'activa')
            ->latest()
            ->take(3)
            ->get();

        return view('barbero.dashboard', compact(
            'totalCitas',
            'citasHoy',
            'ventasHoy',
            'ingresosTotales',
            'serviciosActivos',
            'promocionesActivas',
            'ultimasCitas',
            'ultimasVentas',
            'horariosHoy',
            'promociones'
        ));
    }
}
