<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cita;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NuevaCitaBarberoMail;

class CitaController extends Controller
{
    public function index()
    {
        $clienteId = Auth::id();

        $citas = Cita::with([
            'barbero',
            'servicio'
        ])
            ->where('cliente_id', $clienteId)
            ->latest()
            ->paginate(10);

        return view('cliente.citas.index', compact('citas'));
    }

    public function create(Request $request)
    {
        $servicios = Servicio::with('barbero')
            ->where('estado', 'activo')
            ->get();
        $barberos = User::where('rol', 'barbero')
            ->where('estado', 'activo')
            ->get();

        $servicioSeleccionado = $request->servicio;
        $barberoSeleccionado = $request->barbero;

        return view('cliente.citas.create', compact(
            'servicios',
            'barberos',
            'servicioSeleccionado',
            'barberoSeleccionado'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barbero_id' => 'required|exists:users,id',
            'servicio_id' => 'required|exists:servicios,id',
            'fecha' => 'required|date',
            'hora' => 'required',
        ]);

        


        $cita = Cita::create([
            'cliente_id' => Auth::id(),
            'barbero_id' => $request->barbero_id,
            'servicio_id' => $request->servicio_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'estado' => 'pendiente',
        ]);

        $cita->load('barbero', 'cliente', 'servicio');

        Mail::to($cita->barbero->email)
            ->send(new NuevaCitaBarberoMail($cita));

        return redirect()
            ->route('cliente.citas.index')
            ->with('success', 'Cita reservada correctamente');
    }
}
