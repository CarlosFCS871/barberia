@extends('layouts.barbero')
@section('title', 'Detalle de Venta')
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

        .venta-show {
            font-family: var(--font);
            color: var(--text);
            padding: 1.5rem;
            max-width: 900px;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: .75rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border)
        }

        .page-head h1 {
            font-size: clamp(1.3rem, 2.5vw, 1.8rem);
            font-weight: 800;
            margin: 0
        }

        .btn {
            padding: .65rem 1.2rem;
            border-radius: var(--sm);
            font-weight: 600;
            font-size: .875rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            transition: var(--tr);
            min-height: 40px
        }

        .btn-gold {
            background: var(--gold);
            color: #000;
            border: none
        }

        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(245, 220, 91, .3)
        }

        .btn-ghost {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text)
        }

        .btn-ghost:hover {
            border-color: var(--gold);
            color: var(--gold)
        }

        .invoice-card {
            background: var(--card-glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .3);
            margin-bottom: 1.5rem
        }

        .invoice-header {
            padding: 2rem;
            text-align: center;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(180deg, var(--card), var(--bg))
        }

        .invoice-code {
            font-family: monospace;
            font-size: .9rem;
            color: var(--muted);
            margin-bottom: .5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px
        }

        .invoice-total {
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--gold);
            margin: .5rem 0;
            line-height: 1
        }

        .invoice-status {
            display: inline-flex;
            padding: .4rem 1rem;
            border-radius: 50px;
            font-size: .85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            border: 2px solid
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

        .details-grid {
            padding: 1.5rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem
        }

        .detail-box {
            padding: 1.2rem;
            background: var(--bg);
            border-radius: var(--sm);
            border: 1px solid var(--border)
        }

        .detail-label {
            font-size: .75rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            font-weight: 600;
            margin-bottom: .5rem;
            display: flex;
            align-items: center;
            gap: 6px
        }

        .detail-val {
            font-weight: 600;
            font-size: 1rem
        }

        .detail-val.highlight {
            color: var(--gold);
            font-size: 1.2rem;
            font-weight: 800
        }

        .timeline {
            padding: 1.5rem;
            border-top: 1px solid var(--border)
        }

        .tl-item {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            position: relative;
            padding-left: 1.5rem
        }

        .tl-item::before {
            content: '';
            position: absolute;
            left: 6px;
            top: 24px;
            bottom: 0;
            width: 2px;
            background: var(--border)
        }

        .tl-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: var(--gold);
            flex-shrink: 0;
            margin-top: 4px;
            z-index: 2
        }

        .tl-title {
            font-weight: 600;
            font-size: .9rem;
            margin-bottom: 2px
        }

        .tl-date {
            color: var(--muted);
            font-size: .8rem
        }

        @media(max-width:768px) {
            .venta-show {
                padding: 1rem
            }

            .page-head {
                flex-direction: column;
                align-items: flex-start
            }

            .btn {
                width: 100%;
                justify-content: center
            }

            .invoice-header {
                padding: 1.5rem 1rem
            }

            .details-grid {
                grid-template-columns: 1fr
            }
        }

        @media(hover:none) and (pointer:coarse) {
            .btn {
                min-height: 48px
            }
        }
    </style>

    <div class="venta-show">
        <header class="page-head">
            <h1>🧾 Detalle de Venta #{{ str_pad($venta->id, 5, '0', STR_PAD_LEFT) }}</h1>
            <div style="display:flex;gap:.75rem"><a href="{{ route('barbero.ventas.index') }}" class="btn btn-ghost">←
                    Volver</a><a href="{{ route('barbero.ventas.edit', $venta->id) }}" class="btn btn-gold">✏️ Editar
                    Estado</a></div>
        </header>

        <article class="invoice-card">
            <div class="invoice-header">
                <div class="invoice-code"><i data-lucide="hash" style="width:14px"></i> Código:
                    SNY-{{ date('Y') }}-{{ str_pad($venta->id, 4, '0', STR_PAD_LEFT) }}</div>
                <h2 style="margin:0;font-size:1.5rem">Venta de Servicio</h2>
                <div class="invoice-total">S/ {{ number_format($venta->total, 2) }}</div>
                <span class="invoice-status status-{{ $venta->estado_pago }}">{{ ucfirst($venta->estado_pago) }}</span>
            </div>
            <div class="details-grid">
                <div class="detail-box">
                    <div class="detail-label"><i data-lucide="user" style="width:16px"></i> Cliente</div>
                    <div class="detail-val">{{ $venta->cliente->nombre ?? 'Cliente' }} {{ $venta->cliente->apellido ?? '' }}
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-label"><i data-lucide="scissors" style="width:16px"></i> Servicio</div>
                    <div class="detail-val">{{ $venta->cita->servicio->nombre ?? 'N/A' }}</div>
                </div>
                <div class="detail-box">
                    <div class="detail-label"><i data-lucide="wallet" style="width:16px"></i> Método de Pago</div>
                    <div class="detail-val" style="text-transform:capitalize">{{ $venta->metodo_pago }}</div>
                </div>
                <div class="detail-box">
                    <div class="detail-label"><i data-lucide="calendar" style="width:16px"></i> Fecha de Venta</div>
                    <div class="detail-val">{{ $venta->created_at->format('d M Y, H:i') }}</div>
                </div>
            </div>
        </article>

        <article class="invoice-card timeline">
            <h3 style="margin:0 0 1rem;font-size:1.1rem"><i data-lucide="history"></i> Historial & Registro</h3>
            <div class="tl-item">
                <div class="tl-dot"></div>
                <div class="tl-title">Venta generada automáticamente</div>
                <div class="tl-date">{{ $venta->created_at->format('d M Y, H:i') }}</div>
            </div>
            <div class="tl-item">
                <div class="tl-dot"></div>
                <div class="tl-title">Cita asociada #{{ $venta->cita_id }}</div>
                <div class="tl-date">{{ $venta->cita->fecha ?? 'N/A' }} a las {{ $venta->cita->hora ?? '--:--' }}</div>
            </div>
        </article>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons()
        })
    </script>
@endsection
