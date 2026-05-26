<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Testimonio;

class TestimonioController extends Controller
{
    /**
     * LISTADO
     */

    public function index()
    {
        $testimonios = Testimonio::where(
            'cliente_id',
            Auth::id()
        )->latest()->paginate(10);

        return view(
            'cliente.testimonios.index',
            compact('testimonios')
        );
    }

    /**
     * FORMULARIO
     */

    public function create()
    {
        return view('cliente.testimonios.create');
    }

    /**
     * GUARDAR
     */

    public function store(Request $request)
    {
        $request->validate([

            'comentario' => 'required|string|max:1000',

            'calificacion' => 'required|integer|min:1|max:5',
        ]);

        Testimonio::create([

            'cliente_id' => Auth::id(),

            'comentario' => $request->comentario,

            'calificacion' => $request->calificacion,

            'estado' => 'pendiente',
        ]);

        return redirect()
            ->route('cliente.testimonios.index')
            ->with(
                'success',
                'Testimonio enviado correctamente'
            );
    }

    /**
     * ELIMINAR
     */

    public function destroy($id)
    {
        $testimonio = Testimonio::where(
            'cliente_id',
            Auth::id()
        )->findOrFail($id);

        $testimonio->delete();

        return redirect()
            ->route('cliente.testimonios.index')
            ->with(
                'success',
                'Testimonio eliminado correctamente'
            );
    }
}