<?php

namespace App\Http\Controllers\Barbero;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    /**
     * VER PERFIL
     */
    public function index()
    {
        $user = Auth::user();

        return view('barbero.perfil.index', compact('user'));
    }

    /**
     * ACTUALIZAR PERFIL
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telefono' => 'nullable|string|max:20',
            'password' => 'nullable|min:6|confirmed',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only([
            'nombre',
            'apellido',
            'email',
            'telefono'
        ]);

        /**
         * PASSWORD
         */
        if ($request->filled('password')) {

            $data['password'] = Hash::make($request->password);
        }

        /**
         * FOTO
         */
        if ($request->hasFile('foto')) {

            // eliminar foto anterior
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {

                Storage::disk('public')->delete($user->foto);
            }

            $data['foto'] = $request
                ->file('foto')
                ->store('usuarios', 'public');
        }

        $user->update($data);

        return back()->with(
            'success',
            'Perfil actualizado correctamente'
        );
    }

    /**
     * ELIMINAR CUENTA
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        /**
         * ELIMINAR FOTO
         */
        if ($user->foto && Storage::disk('public')->exists($user->foto)) {

            Storage::disk('public')->delete($user->foto);
        }

        $user->delete();

        Auth::logout();

        return redirect('/login')
            ->with('success', 'Cuenta eliminada correctamente');
    }
}