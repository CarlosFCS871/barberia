<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promocion;
use App\Models\Contacto;
use App\Models\Testimonio;

use App\Models\User;
use App\Models\Cita;
use App\Models\Horario;
use App\Models\Venta;
use App\Models\Servicio;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClientes = User::where('rol', 'cliente')->count();
        $totalBarberos = User::where('rol', 'barbero')->count();

        $citasMes = Cita::whereMonth('created_at', now()->month)->count();

        $ultimasCitas = Cita::with(['cliente', 'barbero'])
            ->latest()
            ->take(5)
            ->get();

        $totalVentas = Venta::sum('total');

        $ingresosNetos = Venta::where('estado_pago', 'pagado')->sum('total');

        $ultimasVentas = Venta::with(['cliente'])
            ->latest()
            ->take(5)
            ->get();

        $servicioTop = Servicio::withCount('citas')
            ->orderBy('citas_count', 'desc')
            ->first();

        // 🟡 ACTIVIDAD (ESTO VA ANTES DEL RETURN)
        $actividad = collect()
            ->merge(User::where('rol', 'cliente')->latest()->take(2)->get())
            ->merge(Cita::where('estado', 'finalizado')->latest()->take(2)->get())
            ->merge(Promocion::latest()->take(2)->get())
            ->merge(Horario::latest()->take(2)->get())
            ->sortByDesc('created_at')
            ->take(6);

        // 🟡 TESTIMONIOS
        $testimonios = Testimonio::with('cliente')
            ->where('estado', 'aprobado')
            ->latest()
            ->take(2)
            ->get();

        // 🟡 PROMOCIONES
        $promociones = Promocion::where('estado', 'activo')
            ->where('fecha_fin', '>=', now())
            ->latest()
            ->take(2)
            ->get();

        return view('admin.dashboard', compact(
            'totalClientes',
            'totalBarberos',
            'citasMes',
            'ultimasCitas',
            'totalVentas',
            'ingresosNetos',
            'ultimasVentas',
            'servicioTop',
            'actividad',
            'testimonios',
            'promociones'
        ));
    }
}
