<?php

namespace App\Http\Controllers\Barbero;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Horario;

class HorarioController extends Controller
{
    /**
     * LISTADO
     */
    public function index(Request $request)
    {
        $query = Horario::where('barbero_id', Auth::id());

        // filtro por día
        if ($request->filled('dia')) {
            $query->where('dia', $request->dia);
        }

        // filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $horarios = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // 📊 ESTADÍSTICAS
        $activos = Horario::where('barbero_id', Auth::id())
            ->where('estado', 'disponible')
            ->count();

        $inactivos = Horario::where('barbero_id', Auth::id())
            ->where('estado', 'descanso')
            ->count();

        $totalHorarios = Horario::where('barbero_id', Auth::id())
            ->count();

        return view('barbero.horarios.index', compact(
            'horarios',
            'activos',
            'inactivos',
            'totalHorarios'
        ));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        return view('barbero.horarios.create');
    }

    /**
     * GUARDAR
     */
    public function store(Request $request)
    {
        $request->validate([
            'dia' => 'required|in:lunes,martes,miercoles,jueves,viernes,sabado,domingo',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'estado' => 'required|in:disponible,descanso',
        ]);

        Horario::create([
            'barbero_id' => Auth::id(),
            'dia' => $request->dia,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('barbero.horarios.index')
            ->with('success', 'Horario creado correctamente');
    }

    /**
     * DETALLE
     */
    public function show($id)
    {
        $horario = Horario::where('barbero_id', Auth::id())
            ->findOrFail($id);

        return view('barbero.horarios.show', compact('horario'));
    }

    /**
     * FORM EDIT
     */
    public function edit($id)
    {
        $horario = Horario::where('barbero_id', Auth::id())
            ->findOrFail($id);

        return view('barbero.horarios.edit', compact('horario'));
    }

    /**
     * ACTUALIZAR
     */
    public function update(Request $request, $id)
    {
        $horario = Horario::where('barbero_id', Auth::id())
            ->findOrFail($id);

        $request->validate([
            'dia' => 'required|in:lunes,martes,miercoles,jueves,viernes,sabado,domingo',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'estado' => 'required|in:disponible,descanso',
        ]);

        $horario->update([
            'dia' => $request->dia,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('barbero.horarios.index')
            ->with('success', 'Horario actualizado correctamente');
    }

    /**
     * ELIMINAR
     */
    public function destroy($id)
    {
        $horario = Horario::where('barbero_id', Auth::id())
            ->findOrFail($id);

        $horario->delete();

        return redirect()
            ->route('barbero.horarios.index')
            ->with('success', 'Horario eliminado correctamente');
    }
}
