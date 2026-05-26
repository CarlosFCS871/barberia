@extends('layouts.barbero')
@section('title', 'Actualizar Estado de Cita')
@section('BarberoContenido')
    <style>
        /* ================= VARIABLES ================= */
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
            --info: #3b82f6;
            --warning: #eab308;
            --danger: #ef4444;
            --radius: 16px;
            --sm: 10px;
            --tr: all .3s cubic-bezier(.4, 0, .2, 1);
            --font: 'Plus Jakarta Sans', system-ui, sans-serif
        }

        [data-theme="light"] {
            --bg: #f8fafc;
            --sidebar: #ffffff;
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

        .cita-edit {
            font-family: var(--font);
            color: var(--text);
            padding: 1.5rem;
            max-width: 750px;
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

        .summary-card {
            background: var(--card-glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 1rem;
            align-items: center
        }

        .summary-info h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0 0 .25rem
        }

        .summary-info p {
            color: var(--muted);
            font-size: .9rem;
            margin: 0
        }

        .summary-status {
            padding: .4rem 1rem;
            border-radius: 50px;
            font-weight: 700;
            text-transform: uppercase;
            font-size: .85rem;
            border: 1px solid
        }

        .status-pendiente {
            background: rgba(234, 179, 8, .15);
            color: var(--warning);
            border-color: var(--warning)
        }

        .status-confirmada {
            background: rgba(59, 130, 246, .15);
            color: var(--info);
            border-color: var(--info)
        }

        .status-finalizada {
            background: rgba(34, 197, 94, .15);
            color: var(--success);
            border-color: var(--success)
        }

        .status-cancelada {
            background: rgba(239, 68, 68, .15);
            color: var(--danger);
            border-color: var(--danger)
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
            gap: 1.5rem;
            margin-bottom: 2rem
        }

        .form-group label {
            display: block;
            font-size: .8rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            font-weight: 600;
            margin-bottom: .5rem
        }

        .modern-select {
            width: 100%;
            padding: .9rem 1rem;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: var(--sm);
            color: var(--text);
            font-size: 1rem;
            transition: var(--tr);
            appearance: none;
            min-height: 48px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center
        }

        .modern-select:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(245, 220, 91, .15)
        }

        .alert-box {
            background: rgba(245, 220, 91, .1);
            border: 1px dashed var(--gold);
            border-radius: var(--sm);
            padding: 1rem;
            color: var(--text);
            font-size: .9rem;
            margin-bottom: 1.5rem;
            display: flex;
            gap: .75rem;
            align-items: flex-start
        }

        .alert-box i {
            color: var(--gold);
            flex-shrink: 0
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border)
        }

        .btn-update {
            padding: .8rem 2rem;
            background: var(--gold);
            color: #000;
            border: none;
            border-radius: var(--sm);
            font-weight: 700;
            cursor: pointer;
            transition: var(--tr)
        }

        .btn-update:hover {
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
            .cita-edit {
                padding: 1rem
            }

            .summary-card {
                grid-template-columns: 1fr;
                text-align: center
            }

            .summary-status {
                margin: 0 auto
            }

            .form-card {
                padding: 1.5rem
            }

            .form-actions {
                flex-direction: column
            }

            .btn-update,
            .btn-cancel {
                width: 100%
            }
        }

        @media(hover:none) and (pointer:coarse) {

            .modern-select,
            .btn-update,
            .btn-cancel {
                min-height: 48px
            }

            select,
            input {
                font-size: 16px !important
            }
        }
    </style>

    <div class="cita-edit">
        <header class="page-head">
            <h1>⚙️ Actualizar Estado de Cita</h1>
            <p>Modifica el estado de la cita. Los cambios se aplicarán en tiempo real.</p>
        </header>

        <div class="summary-card">
            <div class="summary-info">
                <h3>{{ $cita->cliente->nombre ?? 'Cliente' }} {{ $cita->cliente->apellido ?? '' }}</h3>
                <p>{{ $cita->servicio->nombre ?? 'Servicio' }} •
                    {{ \Carbon\Carbon::parse($cita->fecha)->format('d M Y, H:i') }}</p>
            </div>
            <span class="summary-status status-{{ $cita->estado }}">{{ ucfirst($cita->estado) }}</span>
        </div>

        <form class="form-card" action="{{ route('barbero.citas.update', $cita->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="alert-box"><i data-lucide="alert-circle" style="width:20px"></i>
                <div><strong>Importante:</strong> Si cambias el estado a <em>"Finalizada"</em>, el sistema generará
                    automáticamente la venta y la facturación correspondiente.</div>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label for="estado">Nuevo Estado</label>
                    <select id="estado" name="estado" class="modern-select" required>
                        <option value="pendiente" {{ $cita->estado == 'pendiente' ? 'selected' : '' }}>⏳ Pendiente (Esperando
                            confirmación)</option>
                        <option value="confirmada" {{ $cita->estado == 'confirmada' ? 'selected' : '' }}>✅ Confirmada (Lista para
                            atender)</option>
                        <option value="finalizada" {{ $cita->estado == 'finalizada' ? 'selected' : '' }}>🎉 Finalizada (Servicio
                            completado)</option>
                        <option value="cancelada" {{ $cita->estado == 'cancelada' ? 'selected' : '' }}>❌ Cancelada (No se
                            realizará)</option>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <a href="{{ route('barbero.citas.index') }}" class="btn btn-cancel">Cancelar</a>
                <button type="submit" class="btn btn-update" id="submitBtn">💾 Actualizar Estado</button>
            </div>
        </form>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
            const select = document.getElementById('estado'),
                btn = document.getElementById('submitBtn');
            if (select && btn) {
                select.addEventListener('change', () => {
                    btn.textContent = select.value === 'finalizada' ? '💾 Finalizar y Generar Venta' :
                        '💾 Actualizar Estado';
                    btn.style.background = select.value === 'finalizada' ? '#22c55e' : 'var(--gold)';
                })
                document.querySelector('form').addEventListener('submit', e => {
                    if (select.value === 'finalizada' && !confirm(
                            '¿Confirmar finalización? Esto generará automáticamente la venta asociada.')) {
                        e.preventDefault()
                    }
                })
            }
        })
    </script>
@endsection
