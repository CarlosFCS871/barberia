<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonio;

class TestimonioController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimonio::with('cliente');

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('calificacion')) {
            $query->where('calificacion', $request->calificacion);
        }

        $testimonios = $query->latest()->paginate(10);

        return view('admin.testimonios.index', compact('testimonios'));
    }

    public function show($id)
    {
        $testimonio = Testimonio::with('cliente')->findOrFail($id);

        return view('admin.testimonios.show', compact('testimonio'));
    }

    public function edit($id)
    {
        $testimonio = Testimonio::findOrFail($id);

        return view('admin.testimonios.edit', compact('testimonio'));
    }

    public function update(Request $request, $id)
    {
        $testimonio = Testimonio::findOrFail($id);

        $request->validate([
            'estado' => 'required|in:pendiente,aprobado,rechazado',
        ]);

        $testimonio->update([
            'estado' => $request->estado
        ]);

        return redirect()->route('admin.testimonios.index')
            ->with('success', 'Estado actualizado correctamente');
    }
}