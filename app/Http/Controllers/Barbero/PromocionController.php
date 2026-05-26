<?php

namespace App\Http\Controllers\Barbero;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Promocion;

class PromocionController extends Controller
{
    /**
     * LISTADO
     */
    public function index(Request $request)
    {
        $query = Promocion::where('barbero_id', Auth::id());

        // filtro estado
        if ($request->filled('estado')) {

            $query->where('estado', $request->estado);
        }

        $promociones = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        /**
         * 📊 ESTADÍSTICAS
         */

        $activas = Promocion::where('barbero_id', Auth::id())
            ->where('estado', 'activa')
            ->count();

        $inactivas = Promocion::where('barbero_id', Auth::id())
            ->where('estado', 'inactiva')
            ->count();

        $finalizadas = Promocion::where('barbero_id', Auth::id())
            ->where('estado', 'finalizada')
            ->count();

        $totalPromociones = Promocion::where('barbero_id', Auth::id())
            ->count();

        return view('barbero.promociones.index', compact(
            'promociones',
            'activas',
            'inactivas',
            'finalizadas',
            'totalPromociones'
        ));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        return view('barbero.promociones.create');
    }

    /**
     * GUARDAR
     */
    public function store(Request $request)
    {
        $request->validate([

            'nombre' => 'required|string|max:255',

            'descripcion' => 'nullable|string',

            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'descuento' => 'required|numeric|min:1|max:100',

            'fecha_inicio' => 'required|date',

            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',

            'estado' => 'required|in:activa,inactiva,finalizada',
        ]);

        $imagen = null;

        if ($request->hasFile('imagen')) {

            $archivo = $request->file('imagen');

            $imagen ='promociones/' . time() . '_' . $archivo->getClientOriginalName();

            $archivo->move(
                public_path('storage/promociones'),
                $imagen
            );
        }

        Promocion::create([

            'barbero_id' => Auth::id(),

            'nombre' => $request->nombre,

            'descripcion' => $request->descripcion,

            'imagen' => $imagen,

            'descuento' => $request->descuento,

            'fecha_inicio' => $request->fecha_inicio,

            'fecha_fin' => $request->fecha_fin,

            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('barbero.promociones.index')
            ->with('success', 'Promoción creada correctamente');
    }

    /**
     * DETALLE
     */
    public function show($id)
    {
        $promocion = Promocion::where('barbero_id', Auth::id())
            ->findOrFail($id);

        return view('barbero.promociones.show', compact('promocion'));
    }

    /**
     * FORM EDIT
     */
    public function edit($id)
    {
        $promocion = Promocion::where('barbero_id', Auth::id())
            ->findOrFail($id);

        return view('barbero.promociones.edit', compact('promocion'));
    }

    /**
     * ACTUALIZAR
     */
    public function update(Request $request, $id)
    {
        $promocion = Promocion::where('barbero_id', Auth::id())
            ->findOrFail($id);

        $request->validate([

            'nombre' => 'required|string|max:255',

            'descripcion' => 'nullable|string',

            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'descuento' => 'required|numeric|min:1|max:100',

            'fecha_inicio' => 'required|date',

            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',

            'estado' => 'required|in:activa,inactiva,finalizada',
        ]);

        $imagen = $promocion->imagen;

        if ($request->hasFile('imagen')) {

            $archivo = $request->file('imagen');

            $imagen =  'promociones/' .  time() . '_' . $archivo->getClientOriginalName();

            $archivo->move(
                public_path('storage/promociones'),
                $imagen
            );
        }

        $promocion->update([

            'nombre' => $request->nombre,

            'descripcion' => $request->descripcion,

            'imagen' => $imagen,

            'descuento' => $request->descuento,

            'fecha_inicio' => $request->fecha_inicio,

            'fecha_fin' => $request->fecha_fin,

            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('barbero.promociones.index')
            ->with('success', 'Promoción actualizada correctamente');
    }

    /**
     * ELIMINAR
     */
    public function destroy($id)
    {
        $promocion = Promocion::where('barbero_id', Auth::id())
            ->findOrFail($id);

        $promocion->delete();

        return redirect()
            ->route('barbero.promociones.index')
            ->with('success', 'Promoción eliminada correctamente');
    }
}
