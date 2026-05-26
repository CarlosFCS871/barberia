@extends('layouts.barbero')
@section('title', 'Editar Horario')
@section('BarberoContenido')
    <style>
        :root {
            --bg-primary: #0f172a;
            --bg-sidebar: #111827;
            --bg-card: #1e293b;
            --bg-hover: rgba(245, 220, 91, 0.08);
            --border: rgba(255, 255, 255, 0.06);
            --border-hover: rgba(245, 220, 91, 0.25);
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
            --accent: #f5dc5b;
            --accent-hover: #e6c94a;
            --accent-glow: rgba(245, 220, 91, 0.3);
            --success: #22c55e;
            --danger: #ef4444;
            --radius: 16px;
            --radius-sm: 10px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --font: 'Plus Jakarta Sans', system-ui, sans-serif
        }

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

        .horario-form {
            font-family: var(--font);
            color: var(--text-primary);
            padding: 1.5rem;
            max-width: 700px;
            margin: 0 auto
        }

        .page-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border)
        }

        .page-header h1 {
            font-size: clamp(1.3rem, 2.5vw, 1.8rem);
            font-weight: 800;
            margin: 0
        }

        .page-header p {
            color: var(--text-secondary);
            margin: 0.4rem 0 0
        }

        .form-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 2rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3)
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem
        }

        .form-group {
            position: relative
        }

        .form-input {
            width: 100%;
            padding: 1rem;
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text-primary);
            font-size: 0.95rem;
            transition: var(--transition);
            appearance: none
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow)
        }

        .form-label {
            position: absolute;
            left: 1rem;
            top: 1rem;
            color: var(--text-muted);
            pointer-events: none;
            transition: var(--transition);
            background: var(--bg-primary);
            padding: 0 0.3rem
        }

        .form-input:focus+.form-label,
        .form-input:not(:placeholder-shown)+.form-label,
        .form-input:-webkit-autofill+.form-label {
            top: -0.5rem;
            font-size: 0.75rem;
            color: var(--accent)
        }

        .form-select {
            padding-top: 1.5rem;
            cursor: pointer
        }

        .time-input::-webkit-calendar-picker-indicator {
            filter: invert(0.6);
            cursor: pointer
        }

        .error-msg {
            color: var(--danger);
            font-size: 0.75rem;
            margin-top: 0.4rem;
            display: block
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            padding-top: 1.5rem;
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
            transition: var(--transition)
        }

        .btn-submit:hover {
            background: var(--accent-hover);
            transform: translateY(-2px)
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
            text-decoration: none
        }

        .btn-cancel:hover {
            border-color: var(--danger);
            color: var(--danger)
        }

        @media(max-width:768px) {
            .horario-form {
                padding: 1rem
            }

            .form-card {
                padding: 1.5rem
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
            .btn-submit,
            .btn-cancel {
                min-height: 48px
            }

            select,
            input {
                font-size: 16px !important
            }
        }
    </style>

    <div class="horario-form">
        <header class="page-header">
            <h1>✏️ Editar Horario</h1>
            <p>Modifica el día y franja horaria. Los cambios se aplican de inmediato.</p>
        </header>

        <form class="form-card" action="{{ route('barbero.horarios.update', $horario->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <select name="dia" class="form-input form-select" required>
                        <option value="lunes" {{ $horario->dia == 'lunes' ? 'selected' : '' }}>Lunes</option>
                        <option value="martes" {{ $horario->dia == 'martes' ? 'selected' : '' }}>Martes</option>
                        <option value="miercoles" {{ $horario->dia == 'miercoles' ? 'selected' : '' }}>Miércoles</option>
                        <option value="jueves" {{ $horario->dia == 'jueves' ? 'selected' : '' }}>Jueves</option>
                        <option value="viernes" {{ $horario->dia == 'viernes' ? 'selected' : '' }}>Viernes</option>
                        <option value="sabado" {{ $horario->dia == 'sabado' ? 'selected' : '' }}>Sábado</option>
                        <option value="domingo" {{ $horario->dia == 'domingo' ? 'selected' : '' }}>Domingo</option>
                    </select>
                    <label class="form-label">Día de la semana</label>
                    @error('dia')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <select name="estado" class="form-input form-select" required>
                        <option value="disponible" {{ $horario->estado == 'disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="descanso" {{ $horario->estado == 'descanso' ? 'selected' : '' }}>Descanso</option>
                    </select>
                    <label class="form-label">Estado</label>
                    @error('estado')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="time" name="hora_inicio" class="form-input time-input"
                        value="{{ $horario->hora_inicio }}" required>
                    <label class="form-label">Hora inicio</label>
                    @error('hora_inicio')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="time" name="hora_fin" class="form-input time-input" value="{{ $horario->hora_fin }}"
                        required>
                    <label class="form-label">Hora fin</label>
                    @error('hora_fin')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-actions">
                <a href="{{ route('barbero.horarios.index') }}" class="btn-cancel">Cancelar</a>
                <button type="submit" class="btn-submit">💾 Actualizar Horario</button>
            </div>
        </form>
    </div>
@endsection
