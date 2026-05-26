<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contacto;

class ContactoController extends Controller
{
    public function index(Request $request)
    {
        $query = Contacto::query();

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('search')) {
            $query->where('nombre', 'like', "%{$request->search}%")
                  ->orWhere('correo', 'like', "%{$request->search}%");
        }

        $contactos = $query->latest()->paginate(10);

        return view('admin.contactos.index', compact('contactos'));
    }

    public function show($id)
    {
        $contacto = Contacto::findOrFail($id);

        return view('admin.contactos.show', compact('contacto'));
    }

    public function edit($id)
    {
        $contacto = Contacto::findOrFail($id);

        return view('admin.contactos.edit', compact('contacto'));
    }

    public function update(Request $request, $id)
    {
        $contacto = Contacto::findOrFail($id);

        $request->validate([
            'estado' => 'required|in:pendiente,respondido,cerrado',
        ]);

        $contacto->update([
            'estado' => $request->estado
        ]);

        return redirect()->route('admin.contactos.index')
            ->with('success', 'Estado actualizado correctamente');
    }
}