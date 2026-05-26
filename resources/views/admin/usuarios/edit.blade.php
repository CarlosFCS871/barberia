@extends('layouts.admin')
@section('title', 'Editar Usuario')
@section('AdminContenido')
    <style>
        :root {
            --sb-bg: #000000;
            --sb-card: #0a0a0a;
            --sb-border: rgba(255, 255, 255, 0.08);
            --sb-text: #ffffff;
            --sb-muted: #a1a1aa;
            --sb-accent: #F5DC5B;
            --sb-accent-hover: #e6c94a;
            --sb-accent-soft: rgba(245, 220, 91, 0.12);
            --sb-red: #ef4444;
            --sb-green: #22c55e;
            --sb-blue: #60a5fa;
            --sb-purple: #c084fc;
            --sb-gray: #6b7280;
            --sb-radius: 14px;
            --sb-transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [data-theme="light"] {
            --sb-bg: #f8f9fa;
            --sb-card: #ffffff;
            --sb-border: #e5e7eb;
            --sb-text: #0a0a0a;
            --sb-muted: #4b5563;
            --sb-accent: #b89600;
            --sb-accent-hover: #a38500;
            --sb-accent-soft: rgba(245, 220, 91, 0.18);
        }

        .user-edit-view {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: var(--sb-text);
            padding: 1.5rem;
            max-width: 1100px;
            margin: 0 auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--sb-border);
            padding-bottom: 1rem;
        }

        .page-header h1 {
            font-size: clamp(1.5rem, 2.5vw, 2.2rem);
            font-weight: 800;
            margin: 0 0 0.4rem;
            letter-spacing: -0.5px;
        }

        .page-header p {
            color: var(--sb-muted);
            margin: 0;
            font-size: 0.95rem;
        }

        .badges-current {
            display: flex;
            gap: 0.75rem;
            margin-top: 0.5rem;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-admin {
            background: var(--sb-accent-soft);
            color: var(--sb-accent);
            border: 1px solid rgba(245, 220, 91, 0.2);
        }

        .badge-barber {
            background: rgba(59, 130, 246, 0.12);
            color: var(--sb-blue);
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .badge-client {
            background: rgba(168, 85, 247, 0.12);
            color: var(--sb-purple);
            border: 1px solid rgba(168, 85, 247, 0.2);
        }

        .badge-active {
            background: rgba(34, 197, 94, 0.12);
            color: var(--sb-green);
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .badge-inactive {
            background: rgba(107, 114, 128, 0.12);
            color: var(--sb-gray);
            border: 1px solid rgba(107, 114, 128, 0.2);
        }

        .badge-suspended {
            background: rgba(239, 68, 68, 0.12);
            color: var(--sb-red);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .form-card {
            background: var(--sb-card);
            border: 1px solid var(--sb-border);
            border-radius: var(--sb-radius);
            padding: 2rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--sb-muted);
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        .form-label.required::after {
            content: '*';
            color: var(--sb-red);
            margin-left: 4px;
        }

        .form-input,
        .form-select {
            padding: 0.85rem 1rem;
            background: var(--sb-bg);
            border: 1px solid var(--sb-border);
            border-radius: 10px;
            color: var(--sb-text);
            font-size: 0.95rem;
            transition: var(--sb-transition);
            width: 100%;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--sb-accent);
            box-shadow: 0 0 0 2px var(--sb-accent-soft);
        }

        .form-input::placeholder {
            color: var(--sb-muted);
            opacity: 0.6;
        }

        .img-upload-area {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            border: 2px dashed var(--sb-border);
            border-radius: 12px;
            cursor: pointer;
            transition: var(--sb-transition);
            background: var(--sb-bg);
            min-height: 180px;
            text-align: center;
        }

        .img-upload-area:hover,
        .img-upload-area.dragover {
            border-color: var(--sb-accent);
            background: var(--sb-accent-soft);
        }

        .img-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--sb-accent-soft);
            margin-bottom: 0.75rem;
            transition: var(--sb-transition);
        }

        .upload-text {
            font-size: 0.85rem;
            color: var(--sb-muted);
            pointer-events: none;
        }

        .upload-text strong {
            color: var(--sb-accent);
        }

        .form-file-wrapper input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .error-msg {
            color: var(--sb-red);
            font-size: 0.8rem;
            margin-top: 0.2rem;
            display: block;
            font-weight: 500;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--sb-border);
        }

        .btn-submit {
            padding: 0.85rem 2rem;
            background: var(--sb-accent);
            color: #000;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: var(--sb-transition);
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-submit:hover {
            background: var(--sb-accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(245, 220, 91, 0.25);
            color: #000;
        }

        .btn-cancel {
            padding: 0.85rem 2rem;
            background: transparent;
            border: 1px solid var(--sb-border);
            color: var(--sb-text);
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--sb-transition);
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-cancel:hover {
            border-color: var(--sb-red);
            color: var(--sb-red);
            background: rgba(239, 68, 68, 0.05);
        }

        @media (max-width: 768px) {
            .user-edit-view {
                padding: 1rem;
            }

            .form-card {
                padding: 1.5rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 1.25rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="user-edit-view">
        <header class="page-header">
            <div>
                <h1>Editar Usuario</h1>
                <p>Modifica la información del perfil. Los cambios se reflejarán inmediatamente.</p>
                <div class="badges-current">
                    @php
                        $rolClass = match ($usuario->rol) {
                            'admin' => 'badge-admin',
                            'barbero' => 'badge-barber',
                            default => 'badge-client',
                        };
                        $estadoClass = match ($usuario->estado) {
                            'activo' => 'badge-active',
                            'inactivo' => 'badge-inactive',
                            default => 'badge-suspended',
                        };
                    @endphp
                    <span class="badge {{ $rolClass }}">Rol: {{ ucfirst($usuario->rol) }}</span>
                    <span class="badge {{ $estadoClass }}">Estado: {{ ucfirst($usuario->estado) }}</span>
                </div>
            </div>
        </header>

        <div class="form-card">
            <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label required">Nombre</label>
                        <input type="text" name="nombre" class="form-input"
                            value="{{ old('nombre', $usuario->nombre) }}" placeholder="Ej: Carlos" required>
                        @error('nombre')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label required">Apellido</label>
                        <input type="text" name="apellido" class="form-input"
                            value="{{ old('apellido', $usuario->apellido) }}" placeholder="Ej: Snyder" required>
                        @error('apellido')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label required">Correo Electrónico</label>
                        <input type="email" name="email" class="form-input" value="{{ old('email', $usuario->email) }}"
                            placeholder="ejemplo@snyderbarber.com" required>
                        @error('email')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Teléfono</label>
                        <input type="tel" name="telefono" class="form-input"
                            value="{{ old('telefono', $usuario->telefono) }}" placeholder="+34 612 345 678">
                        @error('telefono')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label required">Nueva Contraseña (Opcional)</label>
                        <input type="password" name="password" class="form-input"
                            placeholder="Dejar vacío para mantener la actual">
                        @error('password')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label required">Rol en el Sistema</label>
                        <select name="rol" class="form-select" required>
                            <option value="admin" {{ old('rol', $usuario->rol) == 'admin' ? 'selected' : '' }}>
                                Administrador</option>
                            <option value="barbero" {{ old('rol', $usuario->rol) == 'barbero' ? 'selected' : '' }}>Barbero
                            </option>
                            <option value="cliente" {{ old('rol', $usuario->rol) == 'cliente' ? 'selected' : '' }}>Cliente
                            </option>
                        </select>
                        @error('rol')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label required">Estado de la Cuenta</label>
                        <select name="estado" class="form-select" required>
                            <option value="activo" {{ old('estado', $usuario->estado) == 'activo' ? 'selected' : '' }}>
                                Activo</option>
                            <option value="inactivo" {{ old('estado', $usuario->estado) == 'inactivo' ? 'selected' : '' }}>
                                Inactivo</option>
                            <option value="suspendido"
                                {{ old('estado', $usuario->estado) == 'suspendido' ? 'selected' : '' }}>Suspendido</option>
                        </select>
                        @error('estado')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Foto de Perfil</label>
                        <div class="img-upload-area" id="dropZone">
                            @if ($usuario->foto)
                                <img src="{{ $usuario->foto
                                    ? asset('storage/' . $usuario->foto)
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($usuario->nombre) }}"
                                @else <img
                                    src="https://ui-avatars.com/api/?name={{ urlencode($usuario->nombre . ' ' . $usuario->apellido) }}&background=F5DC5B&color=000&size=200"
                                    id="img-preview" class="img-preview" alt="Avatar por defecto">
                            @endif
                            <span class="upload-text">Arrastra una nueva imagen o <strong>haz clic aquí</strong></span>
                            <input type="file" name="foto" id="fileInput" accept="image/*" class="form-file-wrapper">
                        </div>
                        @error('foto')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.usuarios.index') }}" class="btn-cancel">Cancelar</a>
                    <button type="submit" class="btn-submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fileInput = document.getElementById('fileInput');
            const imgPreview = document.getElementById('img-preview');
            const dropZone = document.getElementById('dropZone');

            // Preview al seleccionar archivo
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (ev) => imgPreview.src = ev.target.result;
                    reader.readAsDataURL(file);
                }
            });

            // Drag & Drop visual
            ['dragenter', 'dragover'].forEach(evt => {
                dropZone.addEventListener(evt, (e) => {
                    e.preventDefault();
                    dropZone.classList.add('dragover');
                });
            });

            ['dragleave', 'drop'].forEach(evt => {
                dropZone.addEventListener(evt, (e) => {
                    e.preventDefault();
                    dropZone.classList.remove('dragover');
                });
            });

            // Soltar archivo
            dropZone.addEventListener('drop', (e) => {
                const files = e.dataTransfer.files;
                if (files.length) {
                    fileInput.files = files;
                    const reader = new FileReader();
                    reader.onload = (ev) => imgPreview.src = ev.target.result;
                    reader.readAsDataURL(files[0]);
                }
            });
        });
    </script>
@endsection
