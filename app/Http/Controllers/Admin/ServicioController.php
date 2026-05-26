<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ServicioController extends Controller
{
    public function index(Request $request)
    {
        $query = Servicio::query();

        // 🔍 BUSCADOR
        if ($request->filled('search')) {
            $query->where('nombre', 'like', "%{$request->search}%");
        }

        // 🎯 FILTRO ESTADO
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // 📊 ORDEN
        $query->latest();

        $servicios = $query->paginate(10)->withQueryString();

        // 📊 ESTADÍSTICAS
        $totalServicios = Servicio::count();
        $activos = Servicio::where('estado', 'activo')->count();
        $inactivos = Servicio::where('estado', 'inactivo')->count();

        return view('admin.servicios.index', compact(
            'servicios',
            'totalServicios',
            'activos',
            'inactivos'
        ));
    }

    public function create()
    {
        $barberos = User::where('rol', 'barbero')->get();

        return view('admin.servicios.create', compact('barberos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'estado' => 'required|in:activo,inactivo',
            'barbero_id' => 'required|exists:users,id',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only([
            'nombre',
            'descripcion',
            'precio',
            'estado',
            'barbero_id'
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('servicios', 'public');
        }

        Servicio::create($data);

        return redirect()->route('admin.servicios.index')
            ->with('success', 'Servicio creado correctamente');
    }

    public function show($id)
    {
        $servicio = Servicio::findOrFail($id);

        return view('admin.servicios.show', compact('servicio'));
    }

    public function edit($id)
    {
        $servicio = Servicio::findOrFail($id);

        return view('admin.servicios.edit', compact('servicio'));
    }

    public function update(Request $request, $id)
    {
        $servicio = Servicio::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'estado' => 'required|in:activo,inactivo',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['nombre', 'descripcion', 'precio', 'estado']);

        // 🖼️ IMAGEN
        if ($request->hasFile('imagen')) {

            if ($servicio->imagen && Storage::disk('public')->exists($servicio->imagen)) {
                Storage::disk('public')->delete($servicio->imagen);
            }

            $data['imagen'] = $request->file('imagen')->store('servicios', 'public');
        }

        $servicio->update($data);

        return redirect()->route('admin.servicios.index')
            ->with('success', 'Servicio actualizado correctamente');
    }

    public function destroy($id)
    {
        $servicio = Servicio::findOrFail($id);

        if ($servicio->imagen && Storage::disk('public')->exists($servicio->imagen)) {
            Storage::disk('public')->delete($servicio->imagen);
        }

        $servicio->delete();

        return redirect()->route('admin.servicios.index')
            ->with('success', 'Servicio eliminado correctamente');
    }
}
