@extends('layouts.admin')
@section('title', 'Editar Horario')
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

        /* ================= BADGE HEADER ================= */
        .badge-header {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 1rem;
            background: var(--sb-accent-soft);
            border: 1px solid var(--sb-accent);
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .badge-header.activo {
            background: rgba(34, 197, 94, 0.12);
            border-color: var(--sb-green);
            color: var(--sb-green);
        }

        .badge-header.inactivo {
            background: rgba(107, 114, 128, 0.12);
            border-color: var(--sb-gray);
            color: var(--sb-gray);
        }

        /* ================= BARBERO INFO ================= */
        .barbero-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--sb-bg);
            border-radius: 10px;
            margin-bottom: 1.5rem;
            border: 1px solid var(--sb-border);
        }

        .barbero-avatar-lg {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: var(--sb-accent-soft);
            color: var(--sb-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            border: 3px solid var(--sb-accent);
            flex-shrink: 0;
        }

        .barbero-detalles h3 {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0 0 0.25rem;
        }

        .barbero-detalles p {
            font-size: 0.85rem;
            color: var(--sb-muted);
            margin: 0;
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

        .form-input:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            background: rgba(255, 255, 255, 0.02);
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

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .barbero-info {
                flex-direction: column;
                text-align: center;
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

            .barbero-avatar-lg {
                width: 48px;
                height: 48px;
                font-size: 1rem;
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
            <div>
                <h1>✏️ Editar Horario</h1>
                <p>Modifica el horario de atención. Los cambios se aplicarán inmediatamente.</p>
            </div>
            <span class="badge-header {{ $horario->estado ?? 'inactivo' }}">
                {{ $horario->estado === 'activo' ? '● Activo' : '⏸️ Inactivo' }}
            </span>
        </header>

        <!-- Barbero Info Block -->
        <div class="barbero-info">
            <div class="barbero-avatar-lg">
                {{ substr($horario->barbero->nombre ?? 'B', 0, 1) }}{{ substr($horario->barbero->apellido ?? '', 0, 1) }}
            </div>
            <div class="barbero-detalles">
                <h3>{{ $horario->barbero->nombre ?? 'Sin asignar' }} {{ $horario->barbero->apellido ?? '' }}</h3>
                <p>🗓️ {{ ucfirst($horario->dia ?? 'lunes') }} • {{ $horario->hora_inicio ?? '--:--' }} -
                    {{ $horario->hora_fin ?? '--:--' }}</p>
            </div>
        </div>

        <div class="form-card">
            <form action="{{ route('admin.horarios.update', $horario->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="form-grid">
                    <!-- Barbero (readonly) -->
                    <div class="form-group">
                        <label class="form-label">Barbero</label>
                        <input type="text" class="form-input"
                            value="{{ $horario->barbero->nombre ?? '' }} {{ $horario->barbero->apellido ?? '' }}"
                            disabled>
                    </div>

                    <!-- Día (readonly) -->
                    <div class="form-group">
                        <label class="form-label">Día</label>
                        <input type="text" class="form-input" value="{{ ucfirst($horario->dia ?? '') }}" disabled>
                    </div>

                    <!-- Hora Inicio -->
                    <div class="form-group">
                        <label class="form-label required">Hora de inicio</label>
                        <input type="time" name="hora_inicio" class="form-input"
                            value="{{ old('hora_inicio', $horario->hora_inicio) }}" required>
                        @error('hora_inicio')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Hora Fin -->
                    <div class="form-group">
                        <label class="form-label required">Hora de fin</label>
                        <input type="time" name="hora_fin" class="form-input"
                            value="{{ old('hora_fin', $horario->hora_fin) }}" required>
                        @error('hora_fin')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Estado -->
                    <div class="form-group">
                        <label class="form-label required">Estado</label>
                        <select name="estado" class="form-select" required>
                            <option value="activo" {{ old('estado', $horario->estado) == 'activo' ? 'selected' : '' }}>✅
                                Activo</option>
                            <option value="inactivo" {{ old('estado', $horario->estado) == 'inactivo' ? 'selected' : '' }}>
                                ⏸️ Inactivo</option>
                        </select>
                        @error('estado')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.horarios.index') }}" class="btn-cancel">Cancelar</a>
                    <button type="submit" class="btn-submit">💾 Actualizar Horario</button>
                </div>
            </form>
        </div>
    </div>
@endsection
