@extends('layouts.admin')
@section('title', 'Detalle de Cita')
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
            --sb-yellow: #eab308;
            --sb-green: #22c55e;
            --sb-red: #ef4444;
            --sb-blue: #60a5fa;
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
            --sb-yellow: #ca8a04;
            --sb-green: #16a34a;
            --sb-red: #dc2626;
            --sb-blue: #3b82f6;
        }

        /* ================= BASE ================= */
        .cita-show {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: var(--sb-text);
            padding: 1rem;
            max-width: 800px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }

        .cita-show *,
        .cita-show *::before,
        .cita-show *::after {
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

        /* ================= CARD PRINCIPAL ================= */
        .cita-card {
            background: var(--sb-card);
            border: 1px solid var(--sb-border);
            border-radius: var(--sb-radius);
            overflow: hidden;
            transition: var(--sb-transition);
        }

        .cita-card:hover {
            border-color: var(--sb-accent-soft);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        /* ================= HERO SECTION ================= */
        .cita-hero {
            padding: 1.75rem;
            text-align: center;
            border-bottom: 1px solid var(--sb-border);
            background: linear-gradient(180deg, var(--sb-card), var(--sb-bg));
        }

        .estado-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 0.75rem;
        }

        .estado-badge.pendiente {
            background: rgba(234, 179, 8, 0.15);
            color: var(--sb-yellow);
            border: 2px solid var(--sb-yellow);
        }

        .estado-badge.confirmada {
            background: rgba(34, 197, 94, 0.15);
            color: var(--sb-green);
            border: 2px solid var(--sb-green);
        }

        .estado-badge.cancelada {
            background: rgba(239, 68, 68, 0.15);
            color: var(--sb-red);
            border: 2px solid var(--sb-red);
        }

        .estado-badge.finalizada {
            background: rgba(96, 165, 250, 0.15);
            color: var(--sb-blue);
            border: 2px solid var(--sb-blue);
        }

        .cita-id {
            font-size: 0.75rem;
            color: var(--sb-muted);
            margin-top: 0.5rem;
        }

        /* ================= INFO GRID ================= */
        .cita-info {
            padding: 1.5rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.25rem;
        }

        .info-block {
            padding: 1.25rem;
            background: var(--sb-bg);
            border-radius: 12px;
            border: 1px solid var(--sb-border);
            transition: var(--sb-transition);
        }

        .info-block:hover {
            border-color: var(--sb-accent-soft);
        }

        .block-title {
            font-size: 0.7rem;
            color: var(--sb-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .block-title::before {
            content: '';
            width: 3px;
            height: 100%;
            background: var(--sb-accent);
            border-radius: 2px;
            position: absolute;
            left: 0;
        }

        .block-row {
            display: flex;
            justify-content: space-between;
            padding: 0.4rem 0;
            border-bottom: 1px dashed var(--sb-border);
        }

        .block-row:last-child {
            border-bottom: none;
        }

        .label {
            color: var(--sb-muted);
            font-size: 0.85rem;
        }

        .value {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--sb-text);
        }

        .value.highlight {
            color: var(--sb-accent);
        }

        /* ================= OBSERVACIONES ================= */
        .cita-obs {
            padding: 1.5rem;
            border-top: 1px solid var(--sb-border);
            background: var(--sb-bg);
        }

        .cita-obs h3 {
            font-size: 0.8rem;
            color: var(--sb-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .cita-obs p {
            font-size: 0.95rem;
            line-height: 1.6;
            color: var(--sb-text);
            background: var(--sb-card);
            padding: 1rem;
            border-radius: 10px;
            border: 1px solid var(--sb-border);
            margin: 0;
        }

        .cita-obs .empty {
            color: var(--sb-muted);
            font-style: italic;
        }

        /* ================= META FOOTER ================= */
        .cita-meta {
            padding: 1rem 1.5rem;
            background: var(--sb-bg);
            border-top: 1px solid var(--sb-border);
            font-size: 0.8rem;
            color: var(--sb-muted);
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 768px) {
            .cita-show {
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

            .cita-hero {
                padding: 1.25rem;
            }

            .cita-info {
                grid-template-columns: 1fr;
                gap: 1rem;
                padding: 1.25rem;
            }

            .info-block {
                padding: 1rem;
            }

            .cita-obs {
                padding: 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .cita-show {
                padding: 0.5rem;
            }

            .page-header h1 {
                font-size: 1.3rem;
            }

            .estado-badge {
                font-size: 0.75rem;
                padding: 0.4rem 1rem;
            }

            .block-row {
                flex-direction: column;
                gap: 0.2rem;
            }

            .label {
                font-size: 0.78rem;
            }

            .value {
                font-size: 0.88rem;
            }

            .cita-meta {
                flex-direction: column;
                gap: 0.3rem;
            }
        }

        /* ================= TOUCH OPTIMIZATIONS ================= */
        @media (hover: none) and (pointer: coarse) {
            .btn {
                min-height: 48px !important;
            }
        }
    </style>

    <div class="cita-show">
        <!-- HEADER -->
        <header class="page-header">
            <h1>📋 Detalle de Cita</h1>
            <a href="{{ route('admin.citas.index') }}" class="btn btn-primary">← Volver al listado</a>
        </header>

        <!-- CARD PRINCIPAL -->
        <article class="cita-card">
            <!-- HERO -->
            <div class="cita-hero">
                <span class="estado-badge {{ $cita->estado ?? 'pendiente' }}">
                    {{ ucfirst($cita->estado ?? 'pendiente') }}
                </span>
                <h2 class="cita-id">CITA #{{ str_pad($cita->id, 4, '0', STR_PAD_LEFT) }}</h2>
            </div>

            <!-- INFO GRID -->
            <div class="cita-info">
                <!-- CLIENTE -->
                <div class="info-block">
                    <div class="block-title">👤 Datos del Cliente</div>
                    <div class="block-row"><span class="label">Nombre</span><span
                            class="value">{{ $cita->cliente->nombre ?? 'N/A' }} {{ $cita->cliente->apellido ?? '' }}</span>
                    </div>
                    <div class="block-row"><span class="label">Email</span><span
                            class="value">{{ $cita->cliente->email ?? 'N/A' }}</span></div>
                    <div class="block-row"><span class="label">Teléfono</span><span
                            class="value">{{ $cita->cliente->telefono ?? 'No registrado' }}</span></div>
                </div>

                <!-- BARBERO & SERVICIO -->
                <div class="info-block">
                    <div class="block-title">✂️ Asignación & Servicio</div>
                    <div class="block-row"><span class="label">Barbero</span><span
                            class="value">{{ $cita->barbero->nombre ?? 'N/A' }} {{ $cita->barbero->apellido ?? '' }}</span>
                    </div>
                    <div class="block-row"><span class="label">Servicio</span><span
                            class="value highlight">{{ $cita->servicio->nombre ?? 'N/A' }}</span></div>


                    <!-- FECHA & HORA -->
                    <div class="info-block">
                        <div class="block-title">📅 Programación</div>
                        <div class="block-row"><span class="label">Fecha</span><span
                                class="value highlight">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</span>
                        </div>
                        <div class="block-row"><span class="label">Hora</span><span
                                class="value">{{ $cita->hora }}</span></div>
                        <div class="block-row"><span class="label">Registrado</span><span
                                class="value">{{ $cita->created_at->format('d/m/Y H:i') }}</span></div>
                    </div>
                </div>

                <!-- OBSERVACIONES -->
                <div class="cita-obs">
                    <h3>📝 Observaciones / Notas</h3>
                    @if (trim($cita->observaciones))
                        <p>{{ nl2br(e($cita->observaciones)) }}</p>
                    @else
                        <p class="empty">Sin observaciones registradas para esta cita.</p>
                    @endif
                </div>

                <!-- META FOOTER -->
                <div class="cita-meta">
                    <span>🕒 Última actualización: {{ $cita->updated_at->format('d M Y, H:i') }}</span>
                    <span>🆔 ID Base de Datos: {{ $cita->id }}</span>
                </div>
        </article>
    </div>
@endsection
