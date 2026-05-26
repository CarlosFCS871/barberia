<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // 🔍 BUSCADOR
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                    ->orWhere('apellido', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('telefono', 'like', "%{$search}%");
            });
        }

        // 🎭 FILTRO ROL
        if ($request->filled('rol')) {
            $query->where('rol', $request->rol);
        }

        // ⚡ FILTRO ESTADO
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // 📊 ORDEN
        if ($request->filled('sort')) {
            $direction = $request->direction ?? 'asc';
            $query->orderBy($request->sort, $direction);
        } else {
            $query->latest();
        }

        // 📄 PAGINACIÓN
        $usuarios = $query->paginate(10)->withQueryString();

        // 📊 ESTADÍSTICAS
        $totalUsuarios = User::count();
        $totalAdmins = User::where('rol', 'admin')->count();
        $totalBarberos = User::where('rol', 'barbero')->count();
        $clientesActivos = User::where('rol', 'cliente')
            ->where('estado', 'activo')
            ->count();

        return view('admin.usuarios.index', compact(
            'usuarios',
            'totalUsuarios',
            'totalAdmins',
            'totalBarberos',
            'clientesActivos'
        ));
    }

    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email|unique:users,email',
            'telefono' => 'nullable',
            'rol' => 'required',
            'estado' => 'required',
            'password' => 'required|min:6',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('usuarios', 'public');
        }

        User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'rol' => $request->rol,
            'estado' => $request->estado,
            'password' => bcrypt($request->password),
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario creado correctamente');
    }

    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $validated = $request->validate([
            'nombre'   => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email'    => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($usuario->id)
            ],
            'telefono' => 'nullable|string|max:20',
            'rol'      => 'required|in:admin,barbero,cliente',
            'estado'   => 'required|in:activo,inactivo,suspendido',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // 2MB max
        ]);

        // Preparar datos para actualizar
        $data = $request->only(['nombre', 'apellido', 'email', 'telefono', 'rol', 'estado']);

        // Manejo de imagen
        if ($request->hasFile('foto')) {
            // Eliminar imagen anterior si existe
            if ($usuario->foto && Storage::disk('public')->exists('usuarios/' . $usuario->foto)) {
                Storage::disk('public')->delete('usuarios/' . $usuario->foto);
            }
            // Guardar nueva imagen
            $data['foto'] = $request->file('foto')->store('usuarios', 'public');
        }

        $usuario->update($data);

        return redirect()
            ->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario eliminado correctamente');
    }
}
