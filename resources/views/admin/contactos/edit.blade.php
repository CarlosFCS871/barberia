@extends('layouts.admin')
@section('title', 'Actualizar Estado de Contacto')
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
            --sb-red: #dc2626;
        }

        .contacto-edit {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: var(--sb-text);
            padding: 1rem;
            max-width: 700px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }

        .contacto-edit *,
        .contacto-edit *::before,
        .contacto-edit *::after {
            box-sizing: border-box;
            max-width: 100%;
        }

        .page-header {
            margin-bottom: 1.5rem;
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

        .edit-card {
            background: var(--sb-card);
            border: 1px solid var(--sb-border);
            border-radius: var(--sb-radius);
            padding: 1.75rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
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

        .form-input,
        .form-select,
        .form-textarea {
            padding: 0.75rem 1rem;
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
            box-shadow: 0 0 0 3px var(--sb-accent-soft);
        }

        .form-input[readonly],
        .form-textarea[readonly] {
            background: rgba(255, 255, 255, 0.02);
            cursor: not-allowed;
            opacity: 0.7;
        }

        .form-textarea {
            min-height: 120px;
            resize: none;
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
            padding: 0.75rem 1.5rem;
            background: var(--sb-accent);
            color: #000;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: var(--sb-transition);
            font-size: 0.9rem;
        }

        .btn-submit:hover {
            background: var(--sb-accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(245, 220, 91, 0.25);
        }

        .btn-cancel {
            padding: 0.75rem 1.5rem;
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
            background: rgba(239, 68, 68, 0.05);
        }

        @media (max-width:768px) {
            .contacto-edit {
                padding: 0.75rem;
            }

            .edit-card {
                padding: 1.5rem;
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
            .contacto-edit {
                padding: 0.5rem;
            }

            .edit-card {
                padding: 1.25rem;
            }
        }

        @media (hover:none) and (pointer:coarse) {

            .form-input,
            .form-select,
            .form-textarea,
            .btn-submit,
            .btn-cancel {
                min-height: 48px !important;
            }

            input,
            select,
            textarea {
                font-size: 16px !important;
            }
        }
    </style>

    <div class="contacto-edit">
        <header class="page-header">
            <h1>⚙️ Actualizar Estado</h1>
            <p>Modifica el estado del mensaje. Los demás datos son de solo lectura.</p>
        </header>

        <div class="edit-card">
            <form action="{{ route('admin.contactos.update', $contacto->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="form-grid">
                    <!-- Solo estado es editable -->
                    <div class="form-group">
                        <label class="form-label">Estado del Contacto</label>
                        <select name="estado" class="form-select" required>
                            <option value="pendiente"
                                {{ old('estado', $contacto->estado) == 'pendiente' ? 'selected' : '' }}>⏳ Pendiente</option>
                            <option value="respondido"
                                {{ old('estado', $contacto->estado) == 'respondido' ? 'selected' : '' }}>✅ Respondido
                            </option>
                            <option value="cerrado" {{ old('estado', $contacto->estado) == 'cerrado' ? 'selected' : '' }}>❌
                                Cerrado</option>
                        </select>
                        @error('estado')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campos de solo lectura -->
                    <div class="form-group">
                        <label class="form-label">Nombre del Cliente</label>
                        <input type="text" class="form-input" value="{{ $contacto->nombre }}" readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-input" value="{{ $contacto->correo }}" readonly>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom:1.25rem;">
                    <label class="form-label">Mensaje Original</label>
                    <textarea class="form-textarea" readonly>{{ $contacto->mensaje }}</textarea>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.contactos.show', $contacto->id) }}" class="btn-cancel">Cancelar</a>
                    <button type="submit" class="btn-submit">💾 Guardar Cambio</button>
                </div>
            </form>
        </div>
    </div>
@endsection
