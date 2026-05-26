@extends('layouts.admin')
@section('title', 'Detalle de Promoción')
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
            --sb-green: #22c55e;
            --sb-red: #ef4444;
            --sb-gray: #6b7280;
            --sb-radius: 16px;
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
            --sb-green: #16a34a;
            --sb-red: #dc2626;
            --sb-gray: #6b7280;
        }

        /* ================= BASE ================= */
        .promo-show {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: var(--sb-text);
            padding: 1rem;
            max-width: 900px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }

        .promo-show *,
        .promo-show *::before,
        .promo-show *::after {
            box-sizing: border-box;
            max-width: 100%;
        }

        /* ================= HEADER ================= */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--sb-border);
        }

        .page-header h1 {
            font-size: clamp(1.3rem, 3vw, 1.8rem);
            font-weight: 800;
            margin: 0;
        }

        .btn {
            padding: 0.65rem 1.2rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.875rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: var(--sb-transition);
            min-height: 40px;
        }

        .btn-primary {
            background: var(--sb-accent);
            color: #000;
        }

        .btn-primary:hover {
            background: var(--sb-accent-hover);
            transform: translateY(-2px);
        }

        /* ================= LANDING CARD ================= */
        .promo-detail-card {
            background: var(--sb-card);
            border: 1px solid var(--sb-border);
            border-radius: var(--sb-radius);
            overflow: hidden;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.25);
        }

        .promo-hero {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 0;
            min-height: 400px;
        }

        .promo-hero-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            background: var(--sb-bg);
        }

        .promo-hero-img.placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5rem;
            background: linear-gradient(135deg, var(--sb-accent-soft), var(--sb-bg));
        }

        .promo-hero-content {
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            border-left: 1px solid var(--sb-border);
            background: var(--sb-card);
        }

        .promo-title {
            font-size: 1.8rem;
            font-weight: 800;
            line-height: 1.2;
            margin: 0;
        }

        .promo-desc {
            font-size: 1rem;
            line-height: 1.6;
            color: var(--sb-text);
            margin: 0;
            background: var(--sb-bg);
            padding: 1rem;
            border-radius: 10px;
            border: 1px solid var(--sb-border);
        }

        /* Badges & Meta */
        .meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            align-items: center;
        }

        .badge-status {
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .badge-activo {
            background: rgba(34, 197, 94, 0.15);
            color: var(--sb-green);
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .badge-inactivo {
            background: rgba(239, 68, 68, 0.15);
            color: var(--sb-red);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .badge-expirado {
            background: rgba(107, 114, 128, 0.15);
            color: var(--sb-gray);
            border: 1px solid rgba(107, 114, 128, 0.3);
        }

        .discount-pill {
            background: var(--sb-accent);
            color: #000;
            font-weight: 800;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 1.1rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .barber-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.95rem;
            color: var(--sb-text);
        }

        .barber-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--sb-accent-soft);
            color: var(--sb-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            flex-shrink: 0;
        }

        /* Dates Grid */
        .dates-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .date-block {
            padding: 0.85rem;
            background: var(--sb-bg);
            border-radius: 10px;
            border: 1px solid var(--sb-border);
        }

        .date-label {
            font-size: 0.7rem;
            color: var(--sb-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .date-value {
            font-size: 1rem;
            font-weight: 600;
            color: var(--sb-text);
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 768px) {
            .promo-show {
                padding: 0.75rem;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .promo-hero {
                grid-template-columns: 1fr;
            }

            .promo-hero-img {
                height: 250px;
            }

            .promo-hero-content {
                border-left: none;
                border-top: 1px solid var(--sb-border);
                padding: 1.5rem;
            }

            .promo-title {
                font-size: 1.5rem;
            }

            .dates-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .promo-show {
                padding: 0.5rem;
            }

            .page-header h1 {
                font-size: 1.3rem;
            }

            .promo-hero-img {
                height: 200px;
            }

            .promo-hero-content {
                padding: 1.25rem;
            }

            .meta-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .discount-pill {
                width: fit-content;
            }
        }

        @media (hover: none) and (pointer: coarse) {
            .btn {
                min-height: 48px !important;
            }
        }
    </style>

    <div class="promo-show">
        <header class="page-header">
            <h1>🎁 Detalle de Promoción</h1>
            <a href="{{ route('admin.promociones.index') }}" class="btn btn-primary">← Volver al listado</a>
        </header>


        @php
            $esExpirado = $promocion->fecha_fin && \Carbon\Carbon::parse($promocion->fecha_fin)->isPast();
            $estadoDisplay =
                $promocion->estado === 'activo' && !$esExpirado ? 'activo' : ($esExpirado ? 'expirado' : 'inactivo');
            $badgeClass = match ($estadoDisplay) {
                'activo' => 'badge-activo',
                'expirado' => 'badge-expirado',
                default => 'badge-inactivo',
            };
        @endphp

        <article class="promo-detail-card">
            <div class="promo-hero">
                @if ($promocion->imagen)
                    <img src="{{ asset('storage/' . $promocion->imagen) }}" alt="{{ $promocion->nombre }}" class="promo-hero-img"
                        onerror="this.classList.add('placeholder'); this.src=''; this.textContent='🎯';">
                @else
                    <div class="promo-hero-img placeholder">🎯</div>
                @endif
                <div class="promo-hero-content">
                    <div class="meta-row">
                        <span class="badge-status {{ $badgeClass }}">{{ ucfirst($estadoDisplay) }}</span>
                        <span class="discount-pill">🔥 {{ $promocion->descuento }}% OFF</span>
                    </div>
                    <h2 class="promo-title">{{ $promocion->nombre }}</h2>
                    <p class="promo-desc">{{ $promocion->descripcion ?? 'Sin descripción disponible para esta promoción.' }}</p>

                    <div class="barber-info">
                        <div class="barber-avatar">
                            {{ substr($promocion->barbero->nombre ?? 'B', 0, 1) }}{{ substr($promocion->barbero->apellido ?? '', 0, 1) }}
                        </div>
                        <div>
                            <div style="font-weight:600;">{{ $promocion->barbero->nombre ?? 'Barbero General' }}
                                {{ $promocion->barbero->apellido ?? '' }}</div>
                            <div style="font-size:0.8rem; color:var(--sb-muted);">Responsable asignado</div>
                        </div>
                    </div>

                    <div class="dates-grid">
                        <div class="date-block">
                            <div class="date-label">Fecha de Inicio</div>
                            <div class="date-value">📅 {{ \Carbon\Carbon::parse($promocion->fecha_inicio)->format('d M Y') }}
                            </div>
                        </div>
                        <div class="date-block">
                            <div class="date-label">Fecha de Fin</div>
                            <div class="date-value">🏁 {{ \Carbon\Carbon::parse($promocion->fecha_fin)->format('d M Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
@endsection
