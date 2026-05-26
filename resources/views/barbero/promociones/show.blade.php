@extends('layouts.barbero')
@section('title', 'Detalle de Promoción')
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

        .promo-show {
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

        .campaign-card {
            background: var(--card-glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .3);
            margin-bottom: 1.5rem
        }

        .campaign-hero {
            position: relative;
            height: 300px;
            overflow: hidden
        }

        .campaign-hero img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }

        .campaign-hero .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, var(--bg), transparent 70%)
        }

        .hero-badge {
            position: absolute;
            bottom: 1.5rem;
            left: 1.5rem;
            right: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap
        }

        .discount-pill {
            background: var(--gold);
            color: #000;
            font-size: 2rem;
            font-weight: 900;
            padding: 8px 18px;
            border-radius: 50px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, .3)
        }

        .status-tag {
            padding: 6px 12px;
            border-radius: 50px;
            font-weight: 700;
            text-transform: uppercase;
            font-size: .85rem;
            border: 2px solid
        }

        .tag-activa {
            background: rgba(34, 197, 94, .15);
            color: var(--success);
            border-color: var(--success)
        }

        .tag-inactiva {
            background: rgba(234, 179, 8, .15);
            color: var(--warning);
            border-color: var(--warning)
        }

        .tag-finalizada {
            background: rgba(239, 68, 68, .15);
            color: var(--danger);
            border-color: var(--danger)
        }

        .campaign-body {
            padding: 1.5rem
        }

        .campaign-title {
            font-size: 1.6rem;
            font-weight: 800;
            margin: 0 0 .5rem
        }

        .campaign-desc {
            font-size: 1rem;
            line-height: 1.7;
            color: var(--text-sec);
            margin-bottom: 1.5rem
        }

        .details-grid {
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
            font-size: 1.15rem
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
            .promo-show {
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

            .campaign-hero {
                height: 220px
            }

            .discount-pill {
                font-size: 1.5rem
            }
        }

        @media(hover:none) and (pointer:coarse) {
            .btn {
                min-height: 48px
            }
        }
    </style>

    <div class="promo-show">
        <header class="page-head">
            <h1>🎁 {{ $promocion->nombre }}</h1>
            <div style="display:flex;gap:.75rem"><a href="{{ route('barbero.promociones.index') }}" class="btn btn-ghost">←
                    Volver</a><a href="{{ route('barbero.promociones.edit', $promocion->id) }}" class="btn btn-gold">✏️ Editar</a>
            </div>
        </header>

        <article class="campaign-card">
            <div class="campaign-hero">
                @if ($promocion->imagen)
                    <img src="{{ asset('storage/' . $promocion->imagen) }}" alt="{{ $promocion->nombre }}">
                @else
                    <div
                        style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--card),var(--bg));color:var(--gold);font-size:4rem">
                        🎯</div>
                @endif
                <div class="overlay"></div>
                <div class="hero-badge">
                    <span class="discount-pill">-{{ $promocion->descuento }}%</span>
                    <span class="status-tag tag-{{ $promocion->estado }}">{{ ucfirst($promocion->estado) }}</span>
                </div>
            </div>
            <div class="campaign-body">
                <h2 class="campaign-title">Detalles de la Campaña</h2>
                <p class="campaign-desc">{{ $promocion->descripcion ?? 'Esta promoción no incluye descripción.' }}</p>
                <div class="details-grid">
                    <div class="detail-box">
                        <div class="detail-label"><i data-lucide="calendar" style="width:16px"></i> Vigencia</div>
                        <div class="detail-val">{{ \Carbon\Carbon::parse($promocion->fecha_inicio)->format('d/m/Y') }} →
                            {{ \Carbon\Carbon::parse($promocion->fecha_fin)->format('d/m/Y') }}</div>
                    </div>
                    <div class="detail-box">
                        <div class="detail-label"><i data-lucide="user" style="width:16px"></i> Creador</div>
                        <div class="detail-val">Barbero ID: {{ $promocion->barbero_id }}</div>
                    </div>
                    <div class="detail-box">
                        <div class="detail-label"><i data-lucide="hash" style="width:16px"></i> Código Interno</div>
                        <div class="detail-val highlight">#PROM-{{ $promocion->id }}</div>
                    </div>
                    <div class="detail-box">
                        <div class="detail-label"><i data-lucide="clock" style="width:16px"></i> Última Edición</div>
                        <div class="detail-val">{{ $promocion->updated_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>
            </div>
        </article>

        <article class="campaign-card timeline">
            <h3 style="margin:0 0 1rem;font-size:1.1rem"><i data-lucide="history"></i> Actividad de la Promoción</h3>
            <div class="tl-item">
                <div class="tl-dot"></div>
                <div class="tl-title">Campaña creada</div>
                <div class="tl-date">{{ $promocion->created_at->format('d M Y, H:i') }}</div>
            </div>
            <div class="tl-item">
                <div class="tl-dot"></div>
                <div class="tl-title">Estado actualizado a "{{ ucfirst($promocion->estado) }}"</div>
                <div class="tl-date">{{ $promocion->updated_at->format('d M Y, H:i') }}</div>
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
