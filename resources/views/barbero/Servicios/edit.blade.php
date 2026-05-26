@extends('layouts.barbero')
@section('title', 'Editar Servicio')
@section('BarberoContenido')
    <style>
        

        [data-theme="light"] {
            --bg-primary: #f8fafc;
            --bg-sidebar: #ffffff;
            --bg-card: #ffffff;
            --bg-hover: rgba(245, 220, 91, 0.12);
            --border: #e2e8f0;
            --border-hover: rgba(245, 220, 91, 0.4);
            --text-primary: #111827;
            --text-secondary: #475569;
            --text-muted: #64748b;
            --accent: #b89600;
            --accent-hover: #a38500;
            --accent-glow: rgba(245, 220, 91, 0.2)
        }

        .servicio-create {
            font-family: var(--font);
            color: var(--text-primary);
            padding: 1.5rem;
            max-width: 800px;
            margin: 0 auto
        }

        .servicio-create *,
        .servicio-create *::before,
        .servicio-create *::after {
            box-sizing: border-box
        }

        .page-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border)
        }

        .page-header h1 {
            font-size: clamp(1.3rem, 2.5vw, 1.8rem);
            font-weight: 800;
            margin: 0 0 0.4rem
        }

        .page-header p {
            color: var(--text-secondary);
            margin: 0;
            font-size: 0.9rem
        }

        .form-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 2rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            transition: var(--transition)
        }

        .form-card:hover {
            border-color: var(--border-hover)
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem
        }

        .form-group.full {
            grid-column: 1/-1
        }

        .form-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px
        }

        .form-label.required::after {
            content: '*';
            color: var(--danger);
            margin-left: 3px
        }

        .form-input,
        .form-select,
        .form-textarea {
            padding: 0.8rem 1rem;
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text-primary);
            font-size: 0.95rem;
            transition: var(--transition);
            width: 100%
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow)
        }

        .form-input::placeholder {
            color: var(--text-muted);
            opacity: 0.6
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
            line-height: 1.5
        }

        .form-input[readonly] {
            background: rgba(255, 255, 255, 0.02);
            cursor: not-allowed;
            opacity: 0.7
        }

        .image-upload {
            position: relative;
            padding: 1.5rem;
            border: 2px dashed var(--border);
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
            background: var(--bg-primary)
        }

        .image-upload:hover {
            border-color: var(--accent);
            background: var(--bg-hover)
        }

        .image-upload.dragover {
            border-color: var(--accent);
            background: var(--accent-glow)
        }

        .image-upload input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer
        }

        .image-upload p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.9rem;
            pointer-events: none
        }

        .image-preview {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-top: 1rem;
            display: none;
            border: 2px solid var(--accent)
        }

        .image-preview.show {
            display: block
        }

        .current-image {
            margin-bottom: 1rem;
            text-align: center
        }

        .current-image img {
            width: 100px;
            height: 100px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid var(--accent);
            margin: 0 auto 0.5rem
        }

        .current-image p {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin: 0
        }

        .error-msg {
            color: var(--danger);
            font-size: 0.75rem;
            margin-top: 0.15rem;
            display: block;
            font-weight: 500
        }

        .form-actions {
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            border-top: 1px solid var(--border)
        }

        .btn-submit {
            padding: 0.8rem 2rem;
            background: var(--accent);
            color: #000;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 6px
        }

        .btn-submit:hover {
            background: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px var(--accent-glow)
        }

        .btn-cancel {
            padding: 0.8rem 2rem;
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text-primary);
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.9rem;
            text-decoration: none
        }

        .btn-cancel:hover {
            border-color: var(--danger);
            color: var(--danger);
            background: rgba(239, 68, 68, 0.05)
        }

        @media(max-width:768px) {
            .servicio-create {
                padding: 1rem
            }

            .form-card {
                padding: 1.5rem
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 1rem
            }

            .form-actions {
                flex-direction: column
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
                justify-content: center
            }
        }

        @media(max-width:480px) {
            .servicio-create {
                padding: 0.75rem
            }

            .page-header h1 {
                font-size: 1.3rem
            }

            .form-card {
                padding: 1.25rem
            }
        }

        @media(hover:none) and (pointer:coarse) {

            .form-input,
            .form-select,
            .form-textarea,
            .btn-submit,
            .btn-cancel {
                min-height: 48px !important
            }

            input,
            select,
            textarea {
                font-size: 16px !important
            }
        }
    </style>

    <div class="servicio-create">
        <header class="page-header">
            <h1>✏️ Editar Servicio</h1>
            <p>Modifica la información del servicio. Los cambios se reflejarán inmediatamente.</p>
        </header>

        <div class="form-card">
            <form action="{{ route('barbero.servicios.update', $servicio->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label required">Nombre del Servicio</label>
                        <input type="text" name="nombre" class="form-input"
                            value="{{ old('nombre', $servicio->nombre) }}" placeholder="Ej: Corte Clásico" required>
                        @error('nombre')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label required">Precio ($)</label>
                        <input type="number" name="precio" class="form-input"
                            value="{{ old('precio', $servicio->precio) }}" placeholder="0.00" step="0.01" min="0"
                            max="999999.99" required>
                        @error('precio')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required">Estado</label>
                        <select name="estado" class="form-select" required>
                            <option value="activo" {{ old('estado', $servicio->estado) == 'activo' ? 'selected' : '' }}>Activo
                            </option>
                            <option value="inactivo" {{ old('estado', $servicio->estado) == 'inactivo' ? 'selected' : '' }}>
                                Inactivo</option>
                        </select>
                        @error('estado')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group full">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-textarea" placeholder="Describe brevemente el servicio...">{{ old('descripcion', $servicio->descripcion) }}</textarea>
                        @error('descripcion')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group full">
                        <label class="form-label">Imagen Actual</label>
                        @if ($servicio->imagen)
                            <div class="current-image">
                                <img src="{{ asset('storage/' . $servicio->imagen) }}" alt="{{ $servicio->nombre }}">
                                <p>{{ basename($servicio->imagen) }}</p>
                            </div>
                        @else
                            <p style="font-size:0.8rem;color:var(--text-muted);margin-bottom:0.5rem">Sin imagen</p>
                        @endif
                        <label class="form-label">Nueva Imagen (opcional)</label>
                        <div class="image-upload" id="dropZone">
                            <input type="file" name="imagen" id="imagenInput" accept="image/jpeg,image/png,image/webp">
                            <p>📷 Dejar vacío para mantener la imagen actual</p>
                            <img src="" alt="Preview" class="image-preview" id="imagePreview">
                        </div>
                        @error('imagen')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ route('barbero.servicios.index') }}" class="btn-cancel">Cancelar</a>
                    <button type="submit" class="btn-submit">💾 Actualizar Servicio</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('imagenInput'),
                preview = document.getElementById('imagePreview'),
                dropZone = document.getElementById('dropZone');
            if (input && preview) {
                input.addEventListener('change', function(e) {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.classList.add('show')
                        };
                        reader.readAsDataURL(this.files[0])
                    }
                })
            }
            if (dropZone && input) {
                ['dragenter', 'dragover'].forEach(evt => {
                    dropZone.addEventListener(evt, (e) => {
                        e.preventDefault();
                        dropZone.classList.add('dragover')
                    })
                });
                ['dragleave', 'drop'].forEach(evt => {
                    dropZone.addEventListener(evt, (e) => {
                        e.preventDefault();
                        dropZone.classList.remove('dragover')
                    })
                });
                dropZone.addEventListener('drop', (e) => {
                    const files = e.dataTransfer.files;
                    if (files.length) {
                        input.files = files;
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.classList.add('show')
                        };
                        reader.readAsDataURL(files[0])
                    }
                })
            }
        });
    </script>
@endsection
