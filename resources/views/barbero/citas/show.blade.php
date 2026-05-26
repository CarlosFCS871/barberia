@extends('layouts.barbero')
@section('title', 'Detalle de Cita')
@section('BarberoContenido')
    <style>
        /* ================= VARIABLES - HEREDA DE TU LAYOUT ================= */
        :root {
            --bg: #000000;
            --sidebar: #111827;
            --card: #000000;
            --card-glass: rgba(30, 41, 59, 0.85);
            --hover: rgba(245, 220, 91, 0.08);
            --border: rgba(255, 255, 255, 0.08);
            --text: #f8fafc;
            --text-sec: #94a3b8;
            --muted: #64748b;
            --gold: #f5dc5b;
            --gold-hover: #e6c94a;
            --gold-glow: rgba(245, 220, 91, 0.3);
            --success: #22c55e;
            --info: #3b82f6;
            --warning: #eab308;
            --danger: #ef4444;
            --radius: 16px;
            --sm: 10px;
            --tr: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
            --gold-hover: #a38500;
            --gold-glow: rgba(245, 220, 91, 0.2)
        }

        /* ================= BASE ================= */
        .cita-show {
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

        /* ================= HEADER ================= */
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
            box-shadow: 0 6px 16px var(--gold-glow)
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

        /* ================= CARD PRINCIPAL ================= */
        .show-card {
            background: var(--card-glass);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            margin-bottom: 1.5rem;
            transition: var(--tr)
        }

        .show-card:hover {
            border-color: var(--gold);
            box-shadow: 0 12px 40px rgba(245, 220, 91, 0.15)
        }

        /* ================= HERO SECTION ================= */
        .show-hero {
            padding: 2.5rem 2rem;
            text-align: center;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(180deg, var(--card), var(--bg));
            position: relative
        }

        .show-hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 2rem;
            right: 2rem;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            opacity: 0.5
        }

        .hero-avatar {
            position: relative;
            width: 100px;
            height: 100px;
            margin: 0 auto 1.25rem;
            border-radius: 50%;
            border: 4px solid var(--gold);
            background: var(--hover);
            color: var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: 800;
            overflow: hidden;
            box-shadow: 0 0 0 4px var(--gold-glow), 0 8px 24px rgba(0, 0, 0, 0.3);
            transition: var(--tr)
        }

        .hero-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 0 0 4px var(--gold-glow), 0 12px 32px rgba(245, 220, 91, 0.25)
        }

        /* ✅ IMAGEN DEL AVATAR - CORREGIDO */
        .hero-avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            border-radius: 50%;
            transition: var(--tr)
        }

        .hero-avatar:hover .hero-avatar-img {
            transform: scale(1.1)
        }

        .hero-name {
            font-size: 1.6rem;
            font-weight: 800;
            margin: 0 0 .5rem;
            letter-spacing: -0.3px
        }

        .status-badge {
            display: inline-flex;
            padding: .45rem 1.1rem;
            border-radius: 50px;
            font-size: .78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            border: 2px solid;
            transition: var(--tr)
        }

        .status-badge:hover {
            transform: translateY(-1px)
        }

        .badge-pendiente {
            background: rgba(234, 179, 8, .15);
            color: var(--warning);
            border-color: var(--warning)
        }

        .badge-confirmada {
            background: rgba(59, 130, 246, .15);
            color: var(--info);
            border-color: var(--info)
        }

        .badge-finalizada {
            background: rgba(34, 197, 94, .15);
            color: var(--success);
            border-color: var(--success)
        }

        .badge-cancelada {
            background: rgba(239, 68, 68, .15);
            color: var(--danger);
            border-color: var(--danger)
        }

        /* ================= INFO GRID ================= */
        .info-grid {
            padding: 1.5rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem
        }

        .info-box {
            padding: 1.2rem;
            background: var(--bg);
            border-radius: var(--sm);
            border: 1px solid var(--border);
            transition: var(--tr);
            display: flex;
            flex-direction: column;
            gap: .5rem
        }

        .info-box:hover {
            border-color: var(--gold);
            transform: translateY(-2px)
        }

        .info-label {
            font-size: .72rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .6px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px
        }

        .info-label i {
            color: var(--gold);
            flex-shrink: 0
        }

        .info-val {
            font-weight: 600;
            font-size: 1.05rem;
            line-height: 1.3
        }

        .info-val.price {
            color: var(--gold);
            font-size: 1.4rem;
            font-weight: 800;
            letter-spacing: -0.5px
        }

        /* ================= TIMELINE ================= */
        .timeline {
            padding: 1.5rem;
            border-top: 1px solid var(--border)
        }

        .timeline h3 {
            margin: 0 0 1.25rem;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: .5rem
        }

        .tl-list {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            position: relative
        }

        .tl-list::before {
            content: '';
            position: absolute;
            left: 23px;
            top: 8px;
            bottom: 8px;
            width: 2px;
            background: var(--border)
        }

        .tl-item {
            display: flex;
            gap: 1rem;
            align-items: flex-start;
            padding-left: 1.5rem;
            position: relative;
            z-index: 1
        }

        .tl-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: var(--gold);
            flex-shrink: 0;
            margin-top: 4px;
            box-shadow: 0 0 0 4px var(--gold-glow);
            transition: var(--tr)
        }

        .tl-item:hover .tl-dot {
            transform: scale(1.2)
        }

        .tl-content {
            flex: 1
        }

        .tl-title {
            font-weight: 600;
            font-size: .92rem;
            margin-bottom: .2rem
        }

        .tl-date {
            color: var(--muted);
            font-size: .8rem;
            font-family: monospace
        }

        /* ================= DECORATIVE ELEMENTS ================= */
        .show-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent)
        }

        /* ================= RESPONSIVE ================= */
        @media(max-width:768px) {
            .cita-show {
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

            .show-hero {
                padding: 1.5rem 1rem
            }

            .hero-avatar {
                width: 85px;
                height: 85px;
                font-size: 2rem
            }

            .hero-name {
                font-size: 1.4rem
            }

            .info-grid {
                grid-template-columns: 1fr
            }

            .info-box {
                padding: 1rem
            }

            .timeline {
                padding: 1.25rem
            }

            .tl-list::before {
                left: 21px
            }
        }

        @media(max-width:480px) {
            .cita-show {
                padding: .75rem
            }

            .page-head h1 {
                font-size: 1.3rem
            }

            .hero-avatar {
                width: 75px;
                height: 75px;
                font-size: 1.75rem
            }

            .info-val.price {
                font-size: 1.25rem
            }
        }

        @media(hover:none) and (pointer:coarse) {
            .btn {
                min-height: 48px
            }

            .hero-avatar:hover {
                transform: none
            }

            .info-box:hover {
                transform: none
            }
        }
    </style>

    <div class="cita-show">
        <header class="page-head">
            <h1>📋 Cita #{{ str_pad($cita->id, 4, '0', STR_PAD_LEFT) }}</h1>
            <div style="display:flex;gap:.75rem;flex-wrap:wrap">
                <a href="{{ route('barbero.citas.index') }}" class="btn btn-ghost">← Volver</a>
                <a href="{{ route('barbero.citas.edit', $cita->id) }}" class="btn btn-gold">✏️ Cambiar Estado</a>
            </div>
        </header>

        <article class="show-card">
            <div class="show-hero">
                <div class="hero-avatar">
                    @if ($cita->cliente && $cita->cliente->foto)
                        <img src="{{ asset('storage/' . $cita->cliente->foto) }}"
                            alt="{{ $cita->cliente->nombre ?? 'Cliente' }}" class="hero-avatar-img"
                            onerror="this.parentElement.innerHTML='{{ substr($cita->cliente->nombre ?? 'C', 0, 1) }}'">
                    @else
                        {{ substr($cita->cliente->nombre ?? 'C', 0, 1) }}
                    @endif
                </div>
                <h2 class="hero-name">{{ $cita->cliente->nombre ?? 'Cliente' }} {{ $cita->cliente->apellido ?? '' }}</h2>
                <span class="status-badge badge-{{ $cita->estado }}">{{ ucfirst($cita->estado) }}</span>
            </div>

            <div class="info-grid">
                <div class="info-box">
                    <div class="info-label"><i data-lucide="scissors" style="width:16px"></i> Servicio</div>
                    <div class="info-val">{{ $cita->servicio->nombre ?? 'N/A' }}</div>
                </div>
                <div class="info-box">
                    <div class="info-label"><i data-lucide="banknote" style="width:16px"></i> Precio</div>
                    <div class="info-val price">${{ number_format($cita->servicio->precio ?? 0, 2) }}</div>
                </div>
                <div class="info-box">
                    <div class="info-label"><i data-lucide="calendar" style="width:16px"></i> Fecha</div>
                    <div class="info-val">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</div>
                </div>
                <div class="info-box">
                    <div class="info-label"><i data-lucide="clock" style="width:16px"></i> Hora</div>
                    <div class="info-val" style="font-family:monospace;font-size:1.1rem">{{ $cita->hora }}</div>
                </div>
            </div>
        </article>

        <article class="show-card timeline">
            <h3><i data-lucide="history" style="width:18px"></i> Registro & Actividad</h3>
            <div class="tl-list">
                <div class="tl-item">
                    <div class="tl-dot"></div>
                    <div class="tl-content">
                        <div class="tl-title">Cita creada</div>
                        <div class="tl-date">{{ $cita->created_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>
                <div class="tl-item">
                    <div class="tl-dot"></div>
                    <div class="tl-content">
                        <div class="tl-title">Última actualización</div>
                        <div class="tl-date">{{ $cita->updated_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>
            </div>
        </article>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();

            // Efecto sutil de entrada para las cards
            document.querySelectorAll('.show-card').forEach((card, i) => {
                card.style.animationDelay = `${i * 0.1}s`;
            });
        });
    </script>
@endsection
