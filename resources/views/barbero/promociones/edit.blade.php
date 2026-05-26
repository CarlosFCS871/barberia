@extends('layouts.barbero')
@section('title', 'Editar Promoción')
@section('BarberoContenido')
    <style>
        :root {
            --bg: #0f172a;
            --sidebar: #111827;
            --card: #1e293b;
            --card-glass: rgba(30, 41, 59, 0.85);
            --hover: rgba(245, 220, 91, 0.08);
            --border: rgba(255, 255, 255, 0.08);
            --text: #f8fafc;
            --text-sec: #94a3b8;
            --muted: #64748b;
            --gold: #f5dc5b;
            --gold-hover: #e6c94a;
            --success: #22c55e;
            --warning: #eab308;
            --danger: #ef4444;
            --radius: 16px;
            --sm: 10px;
            --tr: all .3s cubic-bezier(.4, 0, .2, 1);
            --font: 'Plus Jakarta Sans', system-ui, sans-serif
        }

        [data-theme="light"] {
            --bg: #f8fafc;
            --card: #ffffff;
            --card-glass: rgba(255, 255, 255, 0.9);
            --hover: rgba(245, 220, 91, 0.12);
            --border: #e2e8f0;
            --text: #111827;
            --text-sec: #475569;
            --muted: #64748b;
            --gold: #b89600;
            --gold-hover: #a38500
        }

        .promo-edit {
            font-family: var(--font);
            color: var(--text);
            padding: 1.5rem;
            max-width: 800px;
            margin: 0 auto;
            opacity: 0;
            animation: fadeIn .4s ease forwards
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .page-head {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border)
        }

        .page-head h1 {
            font-size: clamp(1.3rem, 2.5vw, 1.8rem);
            font-weight: 800;
            margin: 0
        }

        .page-head p {
            color: var(--text-sec);
            margin: .4rem 0 0
        }

        .current-img {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1rem;
            background: var(--bg);
            border-radius: var(--sm);
            border: 1px solid var(--border);
            margin-bottom: 1.5rem
        }

        .current-img img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid var(--gold)
        }

        .current-info h3 {
            margin: 0 0 .25rem;
            font-size: 1rem
        }

        .current-info p {
            margin: 0;
            font-size: .8rem;
            color: var(--muted)
        }

        .form-card {
            background: var(--card-glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 2rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .3)
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
            gap: .5rem
        }

        .form-group.full {
            grid-column: 1/-1
        }

        .form-label {
            font-size: .8rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            font-weight: 600
        }

        .form-input,
        .form-select,
        .form-textarea {
            padding: .85rem 1rem;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: var(--sm);
            color: var(--text);
            font-size: .95rem;
            transition: var(--tr);
            width: 100%;
            min-height: 46px
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(245, 220, 91, .15)
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical
        }

        .upload-zone {
            border: 2px dashed var(--border);
            border-radius: var(--radius);
            padding: 2rem 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: var(--tr);
            background: var(--bg);
            position: relative;
            overflow: hidden
        }

        .upload-zone:hover,
        .upload-zone.dragover {
            border-color: var(--gold);
            background: var(--hover)
        }

        .upload-zone input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer
        }

        .upload-zone p {
            margin: .5rem 0 0;
            color: var(--text-sec);
            font-size: .9rem
        }

        .preview-img {
            max-height: 180px;
            border-radius: var(--sm);
            margin-top: 1rem;
            display: none;
            object-fit: cover;
            border: 2px solid var(--gold)
        }

        .error-msg {
            color: var(--danger);
            font-size: .75rem;
            margin-top: .25rem
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border)
        }

        .btn-submit {
            padding: .8rem 2rem;
            background: var(--gold);
            color: #000;
            border: none;
            border-radius: var(--sm);
            font-weight: 700;
            cursor: pointer;
            transition: var(--tr)
        }

        .btn-submit:hover {
            background: var(--gold-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(245, 220, 91, .3)
        }

        .btn-cancel {
            padding: .8rem 2rem;
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: var(--sm);
            font-weight: 600;
            cursor: pointer;
            transition: var(--tr);
            text-decoration: none
        }

        .btn-cancel:hover {
            border-color: var(--danger);
            color: var(--danger)
        }

        @media(max-width:768px) {
            .promo-edit {
                padding: 1rem
            }

            .form-card {
                padding: 1.5rem
            }

            .current-img {
                flex-direction: column;
                text-align: center
            }

            .form-grid {
                grid-template-columns: 1fr
            }

            .form-actions {
                flex-direction: column
            }

            .btn-submit,
            .btn-cancel {
                width: 100%
            }
        }

        @media(hover:none) and (pointer:coarse) {

            .form-input,
            .form-select,
            .form-textarea,
            .btn-submit,
            .btn-cancel {
                min-height: 48px
            }

            select,
            textarea {
                font-size: 16px !important
            }
        }
    </style>

    <div class="promo-edit">
        <header class="page-head">
            <h1>✏️ Editar Promoción</h1>
            <p>Modifica los detalles de tu campaña activa o pausada</p>
        </header>

        @if ($promocion->imagen)
            <div class="current-img">
                <img src="{{ asset('storage/' . $promocion->imagen) }}" alt="{{ $promocion->nombre }}">
                <div class="current-info">
                    <h3>Imagen Actual</h3>
                    <p>Se reemplazará si subes una nueva al guardar</p>
                </div>
            </div>
        @endif

        <form class="form-card" action="{{ route('barbero.promociones.update', $promocion->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group"><label class="form-label">Nombre</label><input type="text" name="nombre"
                        class="form-input" value="{{ old('nombre', $promocion->nombre) }}" required><span class="error-msg">
                        @error('nombre')
                            {{ $message }}
                        @enderror
                    </span></div>
                <div class="form-group"><label class="form-label">Descuento (%)</label><input type="number"
                        name="descuento" class="form-input" value="{{ old('descuento', $promocion->descuento) }}" min="0"
                        max="100" required><span class="error-msg">
                        @error('descuento')
                            {{ $message }}
                        @enderror
                    </span></div>
                <div class="form-group"><label class="form-label">Fecha Inicio</label><input type="date"
                        name="fecha_inicio" class="form-input" value="{{ old('fecha_inicio', $promocion->fecha_inicio) }}"
                        required><span class="error-msg">
                        @error('fecha_inicio')
                            {{ $message }}
                        @enderror
                    </span></div>
                <div class="form-group"><label class="form-label">Fecha Fin</label><input type="date" name="fecha_fin"
                        class="form-input" value="{{ old('fecha_fin', $promocion->fecha_fin) }}" required><span
                        class="error-msg">
                        @error('fecha_fin')
                            {{ $message }}
                        @enderror
                    </span></div>
                <div class="form-group"><label class="form-label">Estado</label><select name="estado" class="form-select">
                        <option value="activa" {{ old('estado', $promocion->estado) == 'activa' ? 'selected' : '' }}>✅ Activa</option>
                        <option value="inactiva" {{ old('estado', $promocion->estado) == 'inactiva' ? 'selected' : '' }}>⏸ Inactiva
                        </option>
                    </select></div>
                <div class="form-group full"><label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-textarea">{{ old('descripcion', $promocion->descripcion) }}</textarea>
                </div>
                <div class="form-group full">
                    <label class="form-label">Cambiar Imagen (Opcional)</label>
                    <div class="upload-zone" id="dropZone">
                        <div style="font-size:2rem">📤</div>
                        <p>Arrastra nueva imagen o haz clic para cambiar</p>
                        <input type="file" name="imagen" id="fileInput" accept="image/jpeg,image/png,image/webp">
                    </div>
                    <img src="" alt="Preview" class="preview-img" id="preview">
                    <span class="error-msg">
                        @error('imagen')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="form-actions">
                <a href="{{ route('barbero.promociones.index') }}" class="btn-cancel">Cancelar</a>
                <button type="submit" class="btn-submit">💾 Actualizar Promoción</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const drop = document.getElementById('dropZone'),
                file = document.getElementById('fileInput'),
                preview = document.getElementById('preview');
            ['dragenter', 'dragover'].forEach(e => drop.addEventListener(e, ev => {
                ev.preventDefault();
                drop.classList.add('dragover')
            }));
            ['dragleave', 'drop'].forEach(e => drop.addEventListener(e, ev => {
                ev.preventDefault();
                drop.classList.remove('dragover')
            }));
            drop.addEventListener('drop', ev => {
                const f = ev.dataTransfer.files;
                if (f.length) handle(f[0])
            });
            file.addEventListener('change', () => handle(file.files[0]));

            function handle(f) {
                if (f && f.type.startsWith('image/')) {
                    const r = new FileReader();
                    r.onload = e => {
                        preview.src = e.target.result;
                        preview.style.display = 'block'
                    };
                    r.readAsDataURL(f)
                }
            }
        });
    </script>
@endsection
