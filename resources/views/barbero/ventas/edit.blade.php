@extends('layouts.barbero')
@section('title', 'Editar Venta')
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
            --info: #3b82f6;
            --warning: #eab308;
            --danger: #ef4444;
            --purple: #9333ea;
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

        .venta-edit {
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

        .summary-bar {
            background: var(--card-glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.25rem;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem
        }

        .summary-info h3 {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0 0 .25rem
        }

        .summary-info p {
            color: var(--muted);
            font-size: .85rem;
            margin: 0
        }

        .summary-total {
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--gold)
        }

        .summary-status {
            padding: .3rem .8rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: .8rem;
            text-transform: uppercase;
            border: 1px solid
        }

        .status-pagado {
            background: rgba(34, 197, 94, .15);
            color: var(--success);
            border-color: var(--success)
        }

        .status-pendiente {
            background: rgba(234, 179, 8, .15);
            color: var(--warning);
            border-color: var(--warning)
        }

        .status-anulado {
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

        .readonly-box {
            padding: .9rem 1rem;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: var(--sm);
            color: var(--muted);
            opacity: .7;
            min-height: 48px;
            display: flex;
            align-items: center
        }

        .alert-box {
            background: rgba(234, 179, 8, .1);
            border-left: 3px solid var(--warning);
            border-radius: var(--sm);
            padding: 1rem;
            color: var(--text);
            font-size: .9rem;
            margin-bottom: 1.5rem;
            display: flex;
            gap: .75rem;
            align-items: flex-start
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
            .venta-edit {
                padding: 1rem
            }

            .summary-bar {
                flex-direction: column;
                align-items: flex-start
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
            .readonly-box,
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

    <div class="venta-edit">
        <header class="page-head">
            <h1>⚙️ Editar Venta #{{ $venta->id }}</h1>
            <p>Modifica únicamente el método y estado de pago. Los datos de la cita y total son inmutables.</p>
        </header>

        <div class="summary-bar">
            <div class="summary-info">
                <h3>{{ $venta->cliente->nombre ?? 'Cliente' }} {{ $venta->cliente->apellido ?? '' }}</h3>
                <p>{{ $venta->cita->servicio->nombre ?? 'Servicio' }} • {{ $venta->created_at->format('d M Y') }}</p>
            </div>
            <div style="text-align:right">
                <div class="summary-total">S/ {{ number_format($venta->total, 2) }}</div>
                <span class="summary-status status-{{ $venta->estado_pago }}">{{ ucfirst($venta->estado_pago) }}</span>
            </div>
        </div>

        <form class="form-card" action="{{ route('barbero.ventas.update', $venta->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="alert-box"><i data-lucide="alert-triangle" style="width:20px;color:var(--warning)"></i>
                <div>Los campos cliente, cita y total se generan automáticamente y no pueden modificarse desde aquí.</div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label>Cliente (solo lectura)</label>
                    <div class="readonly-box">{{ $venta->cliente->nombre ?? 'N/A' }} {{ $venta->cliente->apellido ?? '' }}
                    </div>
                </div>
                <div class="form-group">
                    <label>Total (solo lectura)</label>
                    <div class="readonly-box" style="color:var(--gold);font-weight:700">S/
                        {{ number_format($venta->total, 2) }}</div>
                </div>
                <div class="form-group">
                    <label for="metodo_pago">Método de Pago</label>
                    <select id="metodo_pago" name="metodo_pago" class="modern-select" required>
                        <option value="efectivo" {{ $venta->metodo_pago == 'efectivo' ? 'selected' : '' }}>💵 Efectivo</option>
                        <option value="yape" {{ $venta->metodo_pago == 'yape' ? 'selected' : '' }}>🟣 Yape</option>
                        <option value="plin" {{ $venta->metodo_pago == 'plin' ? 'selected' : '' }}>🔵 Plin</option>
                        <option value="tarjeta" {{ $venta->metodo_pago == 'tarjeta' ? 'selected' : '' }}>💳 Tarjeta</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="estado_pago">Estado de Pago</label>
                    <select id="estado_pago" name="estado_pago" class="modern-select" required>
                        <option value="pendiente" {{ $venta->estado_pago == 'pendiente' ? 'selected' : '' }}>⏳ Pendiente</option>
                        <option value="pagado" {{ $venta->estado_pago == 'pagado' ? 'selected' : '' }}>✅ Pagado</option>
                        <option value="anulado" {{ $venta->estado_pago == 'anulado' ? 'selected' : '' }}>❌ Anulado</option>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('barbero.ventas.index') }}" class="btn btn-cancel">Cancelar</a>
                <button type="submit" class="btn btn-update" id="submitBtn">💾 Guardar Cambios</button>
            </div>
        </form>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
            const estado = document.getElementById('estado_pago'),
                btn = document.getElementById('submitBtn');
            if (estado && btn) {
                estado.addEventListener('change', () => {
                    btn.textContent = estado.value === 'anulado' ? '⚠️ Confirmar Anulación' :
                        '💾 Guardar Cambios';
                    btn.style.background = estado.value === 'anulado' ? '#ef4444' : 'var(--gold)';
                    btn.style.color = estado.value === 'anulado' ? '#fff' : '#000';
                })
                document.querySelector('form').addEventListener('submit', e => {
                    if (estado.value === 'anulado' && !confirm(
                            '¿Estás seguro de anular esta venta? Esta acción afectará los reportes de ingresos.'
                            )) {
                        e.preventDefault()
                    }
                })
            }
        })
    </script>
@endsection
