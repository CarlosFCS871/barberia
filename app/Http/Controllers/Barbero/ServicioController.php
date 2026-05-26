<?php

namespace App\Http\Controllers\Barbero;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;

class ServicioController extends Controller
{
    public function index(Request $request)
    {
        $query = Servicio::where('barbero_id', Auth::id());

        // filtro estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // buscador
        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        $servicios = $query->latest()->paginate(10);

        return view('barbero.servicios.index', compact('servicios'));
    }

    public function create()
    {
        return view('barbero.servicios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'estado' => 'required|in:activo,inactivo',
        ]);

        $imagen = null;

        if ($request->hasFile('imagen')) {

            $archivo = $request->file('imagen');

            $imagen = 'servicios/' . time() . '_' . $archivo->getClientOriginalName();

            $archivo->move(
                public_path('storage/servicios'),
                $imagen
            );
        }

        Servicio::create([
            'barbero_id' => Auth::id(),
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'imagen' => $imagen,
            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('barbero.servicios.index')
            ->with('success', 'Servicio creado correctamente');
    }

    public function show($id)
    {
        $servicio = Servicio::where('barbero_id', Auth::id())
            ->findOrFail($id);

        return view('barbero.servicios.show', compact('servicio'));
    }

    public function edit($id)
    {
        $servicio = Servicio::where('barbero_id', Auth::id())
            ->findOrFail($id);

        return view('barbero.servicios.edit', compact('servicio'));
    }

    public function update(Request $request, $id)
    {
        $servicio = Servicio::where('barbero_id', Auth::id())
            ->findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'estado' => 'required|in:activo,inactivo',
        ]);

        $imagen = $servicio->imagen;

        if ($request->hasFile('imagen')) {

            $archivo = $request->file('imagen');

            $imagen = 'servicios/' . time() . '_' . $archivo->getClientOriginalName();

            $archivo->move(
                public_path('storage/servicios'),
                $imagen
            );
        }

        $servicio->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'imagen' => $imagen,
            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('barbero.servicios.index')
            ->with('success', 'Servicio actualizado correctamente');
    }

    public function destroy($id)
    {
        $servicio = Servicio::where('barbero_id', Auth::id())
            ->findOrFail($id);

        $servicio->delete();

        return redirect()
            ->route('barbero.servicios.index')
            ->with('success', 'Servicio eliminado correctamente');
    }
}