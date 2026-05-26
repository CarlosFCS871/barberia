@extends('layouts.admin')
@section('title', 'Detalle de Horario')
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
        }

        /* ================= BASE ================= */
        .horario-show {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: var(--sb-text);
            padding: 1rem;
            max-width: 600px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }

        .horario-show *,
        .horario-show *::before,
        .horario-show *::after {
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

        .btn-secondary {
            background: transparent;
            border: 1px solid var(--sb-border);
            color: var(--sb-text);
        }

        .btn-secondary:hover {
            border-color: var(--sb-accent);
            color: var(--sb-accent);
        }

        /* ================= CARD PRINCIPAL ================= */
        .horario-card {
            background: var(--sb-card);
            border: 2px solid var(--sb-accent-soft);
            border-radius: var(--sb-radius);
            overflow: hidden;
            transition: var(--sb-transition);
        }

        .horario-card:hover {
            border-color: var(--sb-accent);
            box-shadow: 0 8px 32px rgba(245, 220, 91, 0.15);
        }

        /* ================= HERO SECTION ================= */
        .horario-hero {
            padding: 2rem;
            text-align: center;
            border-bottom: 1px solid var(--sb-border);
            background: linear-gradient(180deg, var(--sb-card), var(--sb-bg));
        }

        .barbero-avatar-xl {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: var(--sb-accent-soft);
            color: var(--sb-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 2rem;
            border: 4px solid var(--sb-accent);
            margin: 0 auto 1rem;
        }

        .barbero-nombre {
            font-size: 1.4rem;
            font-weight: 800;
            margin: 0 0 0.5rem;
        }

        .dia-badge {
            display: inline-block;
            padding: 0.4rem 1.2rem;
            background: var(--sb-accent-soft);
            color: var(--sb-accent);
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1rem;
        }

        /* ================= ESTADO BADGE GRANDE ================= */
        .estado-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .estado-badge.activo {
            background: rgba(34, 197, 94, 0.15);
            color: var(--sb-green);
            border: 2px solid var(--sb-green);
        }

        .estado-badge.inactivo {
            background: rgba(107, 114, 128, 0.15);
            color: var(--sb-gray);
            border: 2px solid var(--sb-gray);
        }

        /* ================= INFO GRID ================= */
        .horario-info {
            padding: 1.5rem;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            padding: 1rem;
            background: var(--sb-bg);
            border-radius: 10px;
            border: 1px solid var(--sb-border);
            transition: var(--sb-transition);
        }

        .info-item:hover {
            border-color: var(--sb-accent-soft);
        }

        .info-label {
            font-size: 0.7rem;
            color: var(--sb-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--sb-text);
        }

        .info-value.hora {
            color: var(--sb-accent);
            font-size: 1.3rem;
            font-family: monospace;
            letter-spacing: 1px;
        }

        /* ================= META FOOTER ================= */
        .horario-meta {
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
            .horario-show {
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

            .horario-hero {
                padding: 1.5rem;
            }

            .barbero-avatar-xl {
                width: 80px;
                height: 80px;
                font-size: 1.6rem;
            }

            .barbero-nombre {
                font-size: 1.2rem;
            }

            .horario-info {
                grid-template-columns: 1fr;
                gap: 0.85rem;
                padding: 1.25rem;
            }

            .info-item {
                padding: 0.85rem;
            }
        }

        @media (max-width: 480px) {
            .horario-show {
                padding: 0.5rem;
            }

            .page-header h1 {
                font-size: 1.3rem;
            }

            .horario-hero {
                padding: 1.25rem;
            }

            .barbero-avatar-xl {
                width: 70px;
                height: 70px;
                font-size: 1.4rem;
            }

            .barbero-nombre {
                font-size: 1.1rem;
            }

            .dia-badge {
                font-size: 0.75rem;
                padding: 0.3rem 1rem;
            }

            .estado-badge {
                font-size: 0.75rem;
                padding: 0.4rem 1.2rem;
            }

            .info-value {
                font-size: 1rem;
            }

            .info-value.hora {
                font-size: 1.15rem;
            }
        }

        /* ================= TOUCH OPTIMIZATIONS ================= */
        @media (hover: none) and (pointer: coarse) {

            .btn,
            .info-item {
                min-height: 48px !important;
            }
        }
    </style>

    <div class="horario-show">
        <!-- HEADER -->
        <header class="page-header">
            <h1>🗓️ Detalle de Horario</h1>
            <div style="display:flex; gap:0.5rem; width:100%; max-width:400px;">
                <a href="{{ route('admin.horarios.index') }}" class="btn btn-secondary"
                    style="flex:1; justify-content:center;">← Volver</a>
                <a href="{{ route('admin.horarios.edit', $horario->id) }}" class="btn btn-primary"
                    style="flex:1; justify-content:center;">✏️ Editar</a>
            </div>
        </header>

        <!-- CARD PRINCIPAL -->
        <article class="horario-card">
            <!-- HERO -->
            <div class="horario-hero">
                <div class="barbero-avatar-xl">
                    {{ substr($horario->barbero->nombre ?? 'B', 0, 1) }}{{ substr($horario->barbero->apellido ?? '', 0, 1) }}
                </div>
                <h2 class="barbero-nombre">{{ $horario->barbero->nombre ?? 'Sin asignar' }}
                    {{ $horario->barbero->apellido ?? '' }}</h2>
                <span class="dia-badge">📅 {{ ucfirst($horario->dia ?? 'lunes') }}</span>
                <br>
                <span class="estado-badge {{ $horario->estado ?? 'descanso' }}">
                    {{ $horario->estado === 'disponible' ? '●' : '⏸️' }} {{ ucfirst($horario->estado ?? 'descanso') }}
                </span>
            </div>

            <!-- INFO GRID -->
            <div class="horario-info">
                <div class="info-item">
                    <span class="info-label">Hora de inicio</span>
                    <span class="info-value hora">{{ $horario->hora_inicio ?? '--:--' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Hora de fin</span>
                    <span class="info-value hora">{{ $horario->hora_fin ?? '--:--' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Duración</span>
                    @php
                        if ($horario->hora_inicio && $horario->hora_fin) {
                            $start = strtotime($horario->hora_inicio);
                            $end = strtotime($horario->hora_fin);
                            $diff = floor(($end - $start) / 60);
                            echo '<span class="info-value">' . $diff . ' minutos</span>';
                        } else {
                            echo '<span class="info-value">—</span>';
                        }
                    @endphp
                </div>
                <div class="info-item">
                    <span class="info-label">ID</span>
                    <span class="info-value">#{{ $horario->id ?? '—' }}</span>
                </div>
            </div>

            <!-- META FOOTER -->
            <div class="horario-meta">
                <span>Creado: {{ $horario->created_at?->format('d M Y') ?? '—' }}</span>
                <span>Actualizado: {{ $horario->updated_at?->format('d M Y, H:i') ?? '—' }}</span>
            </div>
        </article>
    </div>
@endsection
