@extends('layouts.admin')
@section('title', 'Crear Usuario')
@section('AdminContenido')
<style>
/* ================= SCOPED STYLES: USER CREATE ================= */
.user-create-view {
font-family: 'Inter', system-ui, -apple-system, sans-serif;
color: var(--sb-text, #ffffff);
background: transparent;
padding: 1.5rem;
max-width: 1100px;
margin: 0 auto;
}
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

    /* HEADER */
    .page-header {
        margin-bottom: 2rem;
        border-bottom: 1px solid var(--sb-border);
        padding-bottom: 1rem;
    }

    .page-header h1 {
        font-size: clamp(1.5rem, 2.5vw, 2.2rem);
        font-weight: 800;
        margin: 0 0 0.4rem;
        letter-spacing: -0.5px;
        color: var(--sb-text);
    }

    .page-header p {
        color: var(--sb-muted);
        margin: 0;
        font-size: 0.95rem;
    }

    /* FORM CARD */
    .form-card {
        background: var(--sb-card);
        border: 1px solid var(--sb-border);
        border-radius: var(--sb-radius);
        padding: 2rem;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        transition: var(--sb-transition);
    }

    .form-card:hover {
        border-color: var(--sb-accent-soft);
    }

    /* FORM GRID */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    /* FORM GROUPS */
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

    /* FILE UPLOAD */
    .form-file-wrapper {
        position: relative;
        padding: 1.5rem;
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

    .form-file-wrapper.dragover {
        border-color: var(--sb-accent);
        background: var(--sb-accent-soft);
    }

    .form-file-wrapper p {
        margin: 0;
        color: var(--sb-muted);
        font-size: 0.9rem;
        font-weight: 500;
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

    /* ERROR MESSAGES */
    .error-msg {
        color: var(--sb-red);
        font-size: 0.8rem;
        margin-top: 0.2rem;
        display: block;
        font-weight: 500;
    }

    /* FORM ACTIONS */
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

    /* REQUIRED MARKER */
    .form-label.required::after {
        content: '*';
        color: var(--sb-red);
        margin-left: 4px;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .user-create-view {
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

<div class="user-create-view">
    <header class="page-header">
        <h1>Nuevo Usuario</h1>
        <p>Completa la información para registrar un administrador, barbero o cliente en Snyder Barber.</p>
    </header>

    <div class="form-card">
        {{-- 🔥 LÓGICA INTACTA - SOLO ESTILO ACTUALIZADO --}}
        <form action="{{ route('admin.usuarios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label required">Nombre</label>
                    <input type="text" name="nombre" class="form-input" value="{{ old('nombre') }}" placeholder="Ej: Carlos" required>
                    @error('nombre') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label required">Apellido</label>
                    <input type="text" name="apellido" class="form-input" value="{{ old('apellido') }}" placeholder="Ej: Snyder" required>
                    @error('apellido') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label required">Correo Electrónico</label>
                    <input type="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="ejemplo@snyderbarber.com" required>
                    @error('email') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Teléfono</label>
                    <input type="tel" name="telefono" class="form-input" value="{{ old('telefono') }}" placeholder="+34 612 345 678">
                    @error('telefono') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label required">Contraseña</label>
                    <input type="password" name="password" class="form-input" placeholder="Mínimo 8 caracteres" required>
                    @error('password') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label required">Rol en el Sistema</label>
                    <select name="rol" class="form-select" required>
                        <option value="">Selecciona un rol</option>
                        <option value="admin" {{ old('rol')=='admin' ? 'selected' : '' }}>Administrador</option>
                        <option value="barbero" {{ old('rol')=='barbero' ? 'selected' : '' }}>Barbero</option>
                        <option value="cliente" {{ old('rol')=='cliente' ? 'selected' : '' }}>Cliente</option>
                    </select>
                    @error('rol') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label required">Estado de la Cuenta</label>
                    <select name="estado" class="form-select" required>
                        <option value="">Selecciona un estado</option>
                        <option value="activo" {{ old('estado')=='activo' ? 'selected' : '' }}>Activo</option>
                        <option value="inactivo" {{ old('estado')=='inactivo' ? 'selected' : '' }}>Inactivo</option>
                        <option value="suspendido" {{ old('estado')=='suspendido' ? 'selected' : '' }}>Suspendido</option>
                    </select>
                    @error('estado') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Foto</label>
                    <div class="form-file-wrapper" id="dropZone">
                        <input type="file" name="foto" accept="image/*" id="fileInput">
                        <p id="file-name">📷 Arrastra o haz clic para seleccionar</p>
                    </div>
                    @error('foto') <span class="error-msg">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.usuarios.index') }}" class="btn-cancel">Cancelar</a>
                <button type="submit" class="btn-submit">Guardar Usuario</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // File input name update
        const fileInput = document.getElementById('fileInput');
        const fileName = document.getElementById('file-name');
        const dropZone = document.getElementById('dropZone');

        if (fileInput && fileName) {
            fileInput.addEventListener('change', function() {
                if (this.files.length) {
                    fileName.textContent = this.files[0].name;
                } else {
                    fileName.textContent = '📷 Arrastra o haz clic para seleccionar';
                }
            });
        }

        // Drag & drop visual feedback
        if (dropZone && fileInput) {
            ['dragenter', 'dragover'].forEach(evt => {
                dropZone.addEventListener(evt, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropZone.classList.add('dragover');
                });
            });

            ['dragleave', 'drop'].forEach(evt => {
                dropZone.addEventListener(evt, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropZone.classList.remove('dragover');
                });
            });
        }
    });
</script>

@endsection