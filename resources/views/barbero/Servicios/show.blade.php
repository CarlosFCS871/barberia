@extends('layouts.barbero')
@section('title', 'Detalle de Servicio')
@section('BarberoContenido')
    <style>
       

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

        .servicio-show {
            font-family: var(--font);
            color: var(--text-primary);
            padding: 1.5rem;
            max-width: 900px;
            margin: 0 auto
        }

        .servicio-show *,
        .servicio-show *::before,
        .servicio-show *::after {
            box-sizing: border-box
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
            background: var(--accent-hover);
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

        .btn-danger {
            background: transparent;
            border: 1px solid var(--danger);
            color: var(--danger)
        }

        .btn-danger:hover {
            background: rgba(239, 68, 68, 0.1)
        }

        .servicio-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            transition: var(--transition)
        }

        .servicio-card:hover {
            border-color: var(--border-hover)
        }

        .servicio-hero {
            position: relative;
            padding: 2rem;
            text-align: center;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(180deg, var(--bg-card), var(--bg-primary))
        }

        .servicio-img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 10px;
            margin: 0 auto 1.5rem;
            border: 3px solid var(--accent);
            background: var(--bg-primary)
        }

        .servicio-img.placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: var(--accent);
            background: var(--bg-hover)
        }

        .servicio-name {
            font-size: 1.8rem;
            font-weight: 800;
            margin: 0 0 0.5rem
        }

        .servicio-badge {
            display: inline-flex;
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 0.5rem
        }

        .badge-activo {
            background: rgba(34, 197, 94, 0.15);
            color: var(--success);
            border: 2px solid var(--success)
        }

        .badge-inactivo {
            background: rgba(107, 114, 128, 0.15);
            color: var(--text-muted);
            border: 2px solid var(--text-muted)
        }

        .servicio-info {
            padding: 1.5rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.25rem
        }

        .info-block {
            padding: 1.25rem;
            background: var(--bg-primary);
            border-radius: 10px;
            border: 1px solid var(--border)
        }

        .info-title {
            font-size: 0.7rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 6px
        }

        .info-title::before {
            content: '';
            width: 3px;
            height: 14px;
            background: var(--accent);
            border-radius: 2px
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 0.4rem 0;
            border-bottom: 1px dotted var(--border)
        }

        .info-row:last-child {
            border-bottom: none
        }

        .info-label {
            color: var(--text-muted);
            font-size: 0.85rem
        }

        .info-value {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-primary);
            text-align: right
        }

        .info-value.highlight {
            color: var(--accent);
            font-size: 1.3rem;
            font-weight: 800
        }

        .servicio-desc {
            padding: 1.5rem;
            border-top: 1px solid var(--border);
            background: var(--bg-primary)
        }

        .servicio-desc h3 {
            font-size: 0.8rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 0.75rem
        }

        .servicio-desc p {
            font-size: 1rem;
            line-height: 1.6;
            color: var(--text-primary);
            margin: 0
        }

        .servicio-meta {
            padding: 1rem 1.5rem;
            background: var(--bg-primary);
            border-top: 1px solid var(--border);
            font-size: 0.8rem;
            color: var(--text-muted);
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.5rem
        }

        @media(max-width:768px) {
            .servicio-show {
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

            .servicio-hero {
                padding: 1.5rem
            }

            .servicio-img {
                max-height: 250px
            }

            .servicio-name {
                font-size: 1.5rem
            }

            .servicio-info {
                grid-template-columns: 1fr;
                gap: 1rem;
                padding: 1.25rem
            }

            .info-block {
                padding: 1rem
            }

            .servicio-desc {
                padding: 1.25rem
            }
        }

        @media(max-width:480px) {
            .servicio-show {
                padding: 0.75rem
            }

            .page-header h1 {
                font-size: 1.3rem
            }

            .servicio-hero {
                padding: 1.25rem
            }

            .servicio-img {
                max-height: 200px
            }

            .servicio-name {
                font-size: 1.3rem
            }

            .info-value {
                text-align: left
            }
        }

        @media(hover:none) and (pointer:coarse) {
            .btn {
                min-height: 48px !important
            }
        }
    </style>

    <div class="servicio-show">
        <header class="page-header">
            <h1>📋 {{ $servicio->nombre }}</h1>
            <div style="display:flex;gap:0.5rem;flex-wrap:wrap">
                <a href="{{ route('barbero.servicios.index') }}" class="btn btn-secondary">← Volver</a>
                <a href="{{ route('barbero.servicios.edit', $servicio->id) }}" class="btn btn-primary">✏️ Editar</a>
                <button class="btn btn-danger" onclick="confirm('¿Eliminar este servicio?')&&event.preventDefault()">🗑️
                    Eliminar</button>
            </div>
        </header>

        <article class="servicio-card">
            <div class="servicio-hero">
                @if ($servicio->imagen)
                    <img src="{{ asset('storage/' . $servicio->imagen) }}" alt="{{ $servicio->nombre }}"
                        class="servicio-img">
                @else
                    <div class="servicio-img placeholder">✂️</div>
                @endif
                <h2 class="servicio-name">{{ $servicio->nombre }}</h2>
                <span
                    class="servicio-badge {{ $servicio->estado === 'activo' ? 'badge-activo' : 'badge-inactivo' }}">{{ ucfirst($servicio->estado) }}</span>
            </div>

            <div class="servicio-info">
                <div class="info-block">
                    <div class="info-title">💰 Precio</div>
                    <div class="info-value highlight">S/.{{ number_format($servicio->precio, 2) }}</div>
                </div>
                <div class="info-block">
                    <div class="info-title">📅 Creado</div>
                    <div class="info-value">{{ $servicio->created_at->format('d M Y') }}</div>
                </div>
                <div class="info-block">
                    <div class="info-title">🔄 Actualizado</div>
                    <div class="info-value">{{ $servicio->updated_at->format('d M Y') }}</div>
                </div>
            </div>

            @if ($servicio->descripcion)
                <div class="servicio-desc">
                    <h3>📝 Descripción</h3>
                    <p>{{ nl2br(e($servicio->descripcion)) }}</p>
                </div>
            @endif

            <div class="servicio-meta">
                <span>🆔 ID: #{{ $servicio->id }}</span>
                @if ($servicio->imagen)
                    <span>📷 Imagen: {{ basename($servicio->imagen) }}</span>
                @endif
            </div>
        </article>
    </div>
@endsection
