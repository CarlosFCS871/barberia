@extends('layouts.barbero')
@section('title', 'Detalle de Horario')
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
            --info: #3b82f6;
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

        .horario-show {
            font-family: var(--font);
            color: var(--text-primary);
            padding: 1.5rem;
            max-width: 800px;
            margin: 0 auto
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border)
        }

        .page-header h1 {
            font-size: clamp(1.3rem, 2.5vw, 1.8rem);
            font-weight: 800;
            margin: 0
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
            transition: var(--transition);
            min-height: 40px
        }

        .btn-primary {
            background: var(--accent);
            color: #000;
            border: none
        }

        .btn-primary:hover {
            transform: translateY(-2px)
        }

        .btn-secondary {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text-primary)
        }

        .btn-secondary:hover {
            border-color: var(--accent);
            color: var(--accent)
        }

        .show-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3)
        }

        .show-hero {
            padding: 2.5rem 2rem;
            text-align: center;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(180deg, var(--bg-card), var(--bg-primary))
        }

        .day-icon {
            width: 64px;
            height: 64px;
            background: var(--bg-hover);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            margin: 0 auto 1.5rem
        }

        .show-title {
            font-size: 2rem;
            font-weight: 800;
            margin: 0 0 0.5rem
        }

        .status-badge {
            display: inline-flex;
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px
        }

        .status-activo {
            background: rgba(34, 197, 94, 0.15);
            color: var(--success);
            border: 2px solid var(--success)
        }

        .status-inactivo {
            background: rgba(107, 114, 128, 0.15);
            color: var(--text-muted);
            border: 2px solid var(--text-muted)
        }

        .info-grid {
            padding: 1.5rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem
        }

        .info-block {
            padding: 1.25rem;
            background: var(--bg-primary);
            border-radius: 10px;
            border: 1px solid var(--border)
        }

        .info-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 6px
        }

        .info-value {
            font-weight: 600;
            font-size: 1rem
        }

        .info-value.highlight {
            color: var(--accent);
            font-size: 1.2rem
        }

        .timeline {
            padding: 1.5rem;
            border-top: 1px solid var(--border)
        }

        .timeline-item {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            position: relative;
            padding-left: 1.5rem
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 6px;
            top: 8px;
            bottom: 0;
            width: 2px;
            background: var(--border)
        }

        .timeline-icon {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: var(--accent);
            flex-shrink: 0;
            margin-top: 3px
        }

        .timeline-content {
            flex: 1
        }

        .timeline-title {
            font-weight: 600;
            font-size: 0.9rem
        }

        .timeline-date {
            color: var(--text-muted);
            font-size: 0.8rem
        }

        @media(max-width:768px) {
            .horario-show {
                padding: 1rem
            }

            .page-header {
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

            .info-grid {
                grid-template-columns: 1fr
            }
        }

        @media(hover:none) and (pointer:coarse) {
            .btn {
                min-height: 48px
            }
        }
    </style>

    <div class="horario-show">
        <header class="page-header">
            <h1>📅 Detalle de Horario</h1>
            <div style="display:flex;gap:0.75rem"><a href="{{ route('barbero.horarios.index') }}" class="btn btn-secondary">←
                    Volver</a><a href="{{ route('barbero.horarios.edit', $horario->id) }}" class="btn btn-primary">✏️
                    Editar</a></div>
        </header>

        <article class="show-card">
            <div class="show-hero">
                <div class="day-icon"><i data-lucide="calendar-check"></i></div>
                <h2 class="show-title">{{ ucfirst($horario->dia) }}</h2>
                <span class="status-badge status-{{ $horario->estado }}">{{ ucfirst($horario->estado) }}</span>
            </div>

            <div class="info-grid">
                <div class="info-block">
                    <div class="info-label"><i data-lucide="sunrise" style="width:16px"></i> Inicio</div>
                    <div class="info-value highlight">{{ $horario->hora_inicio }}</div>
                </div>
                <div class="info-block">
                    <div class="info-label"><i data-lucide="sunset" style="width:16px"></i> Fin</div>
                    <div class="info-value highlight">{{ $horario->hora_fin }}</div>
                </div>
               
               
            </div>

            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-icon"></div>
                    <div class="timeline-content">
                        <div class="timeline-title">Creado</div>
                        <div class="timeline-date">{{ $horario->created_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-icon"></div>
                    <div class="timeline-content">
                        <div class="timeline-title">Última modificación</div>
                        <div class="timeline-date">{{ $horario->updated_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>
            </div>
        </article>
    </div>
@endsection
