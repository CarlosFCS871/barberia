@extends('layouts.admin')
@section('title', 'Crear Servicio')
@section('AdminContenido')
    <style>
        /* Mismo sistema de variables que index */
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

        .servicio-create {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: var(--sb-text);
            padding: 1rem;
            max-width: 900px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }

        .servicio-create *,
        .servicio-create *::before,
        .servicio-create *::after {
            box-sizing: border-box;
            max-width: 100%;
        }

        .page-header {
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--sb-border);
            padding-bottom: 1rem;
        }

        .page-header h1 {
            font-size: clamp(1.3rem, 3vw, 1.8rem);
            font-weight: 800;
            margin: 0 0 0.4rem;
        }

        .page-header p {
            color: var(--sb-muted);
            margin: 0;
            font-size: 0.9rem;
        }

        .form-card {
            background: var(--sb-card);
            border: 1px solid var(--sb-border);
            border-radius: var(--sb-radius);
            padding: 1.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--sb-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-label.required::after {
            content: '*';
            color: var(--sb-red);
            margin-left: 3px;
        }

        .form-input,
        .form-select,
        .form-textarea {
            padding: 0.7rem 0.9rem;
            background: var(--sb-bg);
            border: 1px solid var(--sb-border);
            border-radius: 8px;
            color: var(--sb-text);
            font-size: 0.9rem;
            transition: var(--sb-transition);
            width: 100%;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--sb-accent);
            box-shadow: 0 0 0 2px var(--sb-accent-soft);
        }

        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-input::placeholder {
            color: var(--sb-muted);
            opacity: 0.6;
        }

        .form-file-wrapper {
            position: relative;
            padding: 1.25rem;
            border: 2px dashed var(--sb-border);
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: var(--sb-transition);
            background: var(--sb-bg);
        }

        .form-file-wrapper:hover {
            border-color: var(--sb-accent);
            background: var(--sb-accent-soft);
        }

        .form-file-wrapper p {
            margin: 0;
            color: var(--sb-muted);
            font-size: 0.85rem;
            pointer-events: none;
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
            font-size: 0.75rem;
            margin-top: 0.15rem;
            display: block;
            font-weight: 500;
        }

        .form-actions {
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            border-top: 1px solid var(--sb-border);
        }

        .btn-submit {
            padding: 0.7rem 1.5rem;
            background: var(--sb-accent);
            color: #000;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: var(--sb-transition);
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-submit:hover {
            background: var(--sb-accent-hover);
            transform: translateY(-2px);
        }

        .btn-cancel {
            padding: 0.7rem 1.5rem;
            background: transparent;
            border: 1px solid var(--sb-border);
            color: var(--sb-text);
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--sb-transition);
            font-size: 0.9rem;
            text-decoration: none;
        }

        .btn-cancel:hover {
            border-color: var(--sb-red);
            color: var(--sb-red);
        }

        @media (max-width:768px) {
            .servicio-create {
                padding: 0.75rem;
            }

            .form-card {
                padding: 1.25rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
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

        @media (max-width:480px) {
            .servicio-create {
                padding: 0.5rem;
            }

            .page-header h1 {
                font-size: 1.3rem;
            }

            .form-card {
                padding: 1rem;
            }
        }
    </style>

    <div class="servicio-create">
        <header class="page-header">
            <h1>Nuevo Servicio</h1>
            <p>Define el nombre, precio y duración del servicio que ofrecerás</p>
        </header>



        <div class="form-card">
            <form action="{{ route('admin.servicios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">


                    <div class="form-group">
                        <label class="form-label required">Barbero</label>
                        <select name="barbero_id" class="form-select" required>
                            <option value="">Selecciona barbero</option>
                            @foreach ($barberos as $barbero)
                                <option value="{{ $barbero->id }}">
                                    {{ $barbero->nombre }} {{ $barbero->apellido }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label required">Nombre del Servicio</label>
                        <input type="text" name="nombre" class="form-input" value="{{ old('nombre') }}"
                            placeholder="Ej: Corte Clásico" required>
                        @error('nombre')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label required">Precio ($)</label>
                        <input type="number" name="precio" class="form-input" value="{{ old('precio') }}"
                            placeholder="0.00" step="0.01" min="0" max="999999.99" required>
                        @error('precio')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required">Estado</label>
                        <select name="estado" class="form-select" required>
                            <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" style="grid-column:1/-1;">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-textarea" placeholder="Describe brevemente el servicio...">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" style="grid-column:1/-1;">
                        <label class="form-label">Imagen del Servicio</label>
                        <div class="form-file-wrapper">
                            <input type="file" name="imagen" id="imagenInput" accept="image/jpeg,image/png,image/webp">
                            <p id="fileName">📷 Arrastra o haz clic para subir imagen (JPG/PNG/WebP, máx 2MB)</p>
                        </div>
                        @error('imagen')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ route('admin.servicios.index') }}" class="btn-cancel">Cancelar</a>
                    <button type="submit" class="btn-submit">💾 Guardar Servicio</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('imagenInput');
            const name = document.getElementById('fileName');
            if (input && name) {
                input.addEventListener('change', () => {
                    if (input.files.length) name.textContent = '📄 ' + input.files[0].name;
                    else name.textContent =
                        '📷 Arrastra o haz clic para subir imagen (JPG/PNG/WebP, máx 2MB)';
                });
            }
        });
    </script>
@endsection
