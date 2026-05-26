<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contacto;
use Illuminate\Support\Facades\Mail;

class ContactoPageController extends Controller
{
    public function index()
    {
        return view('publico.contacto');
    }

    public function store(Request $request)
    {
        $request->validate([

            'nombre' => 'required',

            'correo' => 'required|email',

            'telefono' => 'nullable',

            'mensaje' => 'required',
        ]);

        Contacto::create([

            'nombre' => $request->nombre,

            'correo' => $request->correo,

            'telefono' => $request->telefono,

            'mensaje' => $request->mensaje,
        ]);

        Mail::raw(

            "Nuevo mensaje de contacto\n\n" .

            "Nombre: {$request->nombre}\n" .

            "Correo: {$request->correo}\n" .

            "Teléfono: {$request->telefono}\n\n" .

            "Mensaje:\n{$request->mensaje}",

            function ($message) {

                $message->to('carloscantaro35@gmail.com')
                    ->subject('Nuevo mensaje desde la página de contacto');
            }

        );

        return back()->with(
            'success',
            'Mensaje enviado correctamente'
        );
    }
}