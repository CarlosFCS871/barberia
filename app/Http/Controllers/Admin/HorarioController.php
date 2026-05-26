<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\User;

class HorarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Horario::with('barbero');

        // 🔍 filtro barbero
        if ($request->filled('barbero_id')) {
            $query->where('barbero_id', $request->barbero_id);
        }

        // 🎯 filtro estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $horarios = $query->latest()->paginate(10)->withQueryString();

        $totalHorarios = Horario::count();
        $activos = Horario::where('estado', 'disponible')->count();
        $inactivos = Horario::where('estado', 'descanso')->count();

        $barberos = User::where('rol', 'barbero')->get();

        return view('admin.horarios.index', compact(
            'horarios',
            'totalHorarios',
            'activos',
            'inactivos',
            'barberos'
        ));
    }

    public function create()
    {
        $barberos = User::where('rol', 'barbero')->get();

        return view('admin.horarios.create', compact('barberos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barbero_id' => 'required|exists:users,id',
            'dia' => 'required|string',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'estado' => 'required|in:disponible,descanso',
        ]);

        Horario::create([
            'barbero_id' => $request->barbero_id,
            'dia' => $request->dia,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'estado' => $request->estado,
        ]);

        return redirect()->route('admin.horarios.index')
            ->with('success', 'Horario creado correctamente');
    }

    public function show($id)
    {
        $horario = Horario::with('barbero')->findOrFail($id);

        return view('admin.horarios.show', compact('horario'));
    }

    public function edit($id)
    {
        $horario = Horario::findOrFail($id);
        $barberos = User::where('rol', 'barbero')->get();

        return view('admin.horarios.edit', compact('horario', 'barberos'));
    }

    public function update(Request $request, $id)
    {
        $horario = Horario::findOrFail($id);

        $request->validate([
            'barbero_id' => 'required|exists:users,id',
            'dia' => 'required|string',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'estado' => 'required|in:disponible,descanso',
        ]);

        $horario->update([
            'barbero_id' => $request->barbero_id,
            'dia' => $request->dia,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'estado' => $request->estado,
        ]);

        return redirect()->route('admin.horarios.index')
            ->with('success', 'Horario actualizado correctamente');
    }

    public function destroy($id)
    {
        $horario = Horario::findOrFail($id);
        $horario->delete();

        return redirect()->route('admin.horarios.index')
            ->with('success', 'Horario eliminado correctamente');
    }
}
