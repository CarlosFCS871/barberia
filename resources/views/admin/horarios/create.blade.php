@extends('layouts.admin')
@section('title', 'Crear Horario')
@section('AdminContenido')
    <style>
        /* ================= VARIABLES - SISTEMA CONSISTENTE ================= */
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

        /* ================= BASE ================= */
        .horario-create {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: var(--sb-text);
            padding: 1rem;
            max-width: 700px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }

        .horario-create *,
        .horario-create *::before,
        .horario-create *::after {
            box-sizing: border-box;
            max-width: 100%;
        }

        /* ================= HEADER ================= */
        .page-header {
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--sb-border);
            padding-bottom: 1rem;
            text-align: center;
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

        /* ================= FORM CARD ================= */
        .form-card {
            background: var(--sb-card);
            border: 1px solid var(--sb-border);
            border-radius: var(--sb-radius);
            padding: 1.75rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            transition: var(--sb-transition);
        }

        .form-card:hover {
            border-color: var(--sb-accent-soft);
        }

        /* ================= FORM GRID ================= */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        /* ================= FORM GROUPS ================= */
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

        /* ================= INPUTS ================= */
        .form-input,
        .form-select {
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
            transform: translateY(-1px);
        }

        .form-input::placeholder {
            color: var(--sb-muted);
            opacity: 0.6;
        }

        /* Time input special styling */
        .form-input[type="time"] {
            font-family: monospace;
            letter-spacing: 0.5px;
        }

        /* ================= ERRORS ================= */
        .error-msg {
            color: var(--sb-red);
            font-size: 0.75rem;
            margin-top: 0.15rem;
            display: block;
            font-weight: 500;
        }

        /* ================= ACTIONS ================= */
        .form-actions {
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            border-top: 1px solid var(--sb-border);
        }

        .btn-submit {
            padding: 0.75rem 1.75rem;
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
            box-shadow: 0 6px 16px rgba(245, 220, 91, 0.25);
        }

        .btn-cancel {
            padding: 0.75rem 1.75rem;
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

        /* ================= RESPONSIVE ================= */
        @media (max-width: 768px) {
            .horario-create {
                padding: 0.75rem;
            }

            .form-card {
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

        @media (max-width: 480px) {
            .horario-create {
                padding: 0.5rem;
            }

            .page-header h1 {
                font-size: 1.3rem;
            }

            .form-card {
                padding: 1.25rem;
            }
        }

        /* ================= TOUCH OPTIMIZATIONS ================= */
        @media (hover: none) and (pointer: coarse) {

            .form-input,
            .form-select,
            .btn-submit,
            .btn-cancel {
                min-height: 48px !important;
            }

            input,
            select {
                font-size: 16px !important;
            }
        }
    </style>

    <div class="horario-create">
        <header class="page-header">
            <h1>🗓️ Nuevo Horario</h1>
            <p>Configura el horario de atención para un barbero</p>
        </header>

        <div class="form-card">
            <form action="{{ route('admin.horarios.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <!-- Barbero -->
                    <div class="form-group">
                        <label class="form-label required">Barbero</label>
                        <select name="barbero_id" class="form-select" required>
                            <option value="">Selecciona un barbero</option>
                            @foreach ($barberos ?? [] as $barbero)
                                <option value="{{ $barbero->id }}"
                                    {{ old('barbero_id') == $barbero->id ? 'selected' : '' }}>
                                    {{ $barbero->nombre }} {{ $barbero->apellido }}
                                </option>
                            @endforeach
                        </select>
                        @error('barbero_id')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Día -->
                    <div class="form-group">
                        <label class="form-label required">Día de la semana</label>
                        <select name="dia" class="form-select" required>
                            <option value="">Selecciona un día</option>
                            @php $dias = ['lunes','martes','miércoles','jueves','viernes','sábado','domingo']; @endphp
                            @foreach ($dias as $dia)
                                <option value="{{ $dia }}" {{ old('dia') == $dia ? 'selected' : '' }}>
                                    {{ ucfirst($dia) }}</option>
                            @endforeach
                        </select>
                        @error('dia')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Hora Inicio -->
                    <div class="form-group">
                        <label class="form-label required">Hora de inicio</label>
                        <input type="time" name="hora_inicio" class="form-input" value="{{ old('hora_inicio') }}"
                            required>
                        @error('hora_inicio')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Hora Fin -->
                    <div class="form-group">
                        <label class="form-label required">Hora de fin</label>
                        <input type="time" name="hora_fin" class="form-input" value="{{ old('hora_fin') }}" required>
                        @error('hora_fin')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Estado -->
                    <div class="form-group">
                        <label class="form-label required">Estado</label>
                        <select name="estado" class="form-select" required>
                            <option value="disponible" {{ old('estado') == 'disponible' ? 'selected' : '' }}>✅ Activo</option>
                            <option value="descanso" {{ old('estado') == 'descanso' ? 'selected' : '' }}>⏸️ Inactivo
                            </option>
                        </select>
                        @error('estado')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.horarios.index') }}" class="btn-cancel">Cancelar</a>
                    <button type="submit" class="btn-submit">💾 Guardar Horario</button>
                </div>
            </form>
        </div>
    </div>
@endsection
