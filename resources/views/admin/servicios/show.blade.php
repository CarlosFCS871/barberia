@extends('layouts.admin')
@section('title', 'Detalle de Servicio')
@section('AdminContenido')
    <style>
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

        .servicio-show {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: var(--sb-text);
            padding: 1rem;
            max-width: 800px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }

        .servicio-show *,
        .servicio-show *::before,
        .servicio-show *::after {
            box-sizing: border-box;
            max-width: 100%;
        }

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

        .servicio-card {
            background: var(--sb-card);
            border: 1px solid var(--sb-border);
            border-radius: var(--sb-radius);
            overflow: hidden;
        }

        .servicio-hero {
            padding: 2rem;
            text-align: center;
            border-bottom: 1px solid var(--sb-border);
        }

        .servicio-img {
            width: 160px;
            height: 160px;
            border-radius: 20px;
            object-fit: cover;
            border: 3px solid var(--sb-accent-soft);
            margin: 0 auto 1rem;
            background: #222;
        }

        .servicio-img.placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            background: var(--sb-accent-soft);
            color: var(--sb-accent);
        }

        .servicio-nombre {
            font-size: 1.5rem;
            font-weight: 800;
            margin: 0 0 0.5rem;
        }

        .servicio-badge {
            display: inline-flex;
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .badge-activo {
            background: rgba(34, 197, 94, 0.12);
            color: var(--sb-green);
        }

        .badge-inactivo {
            background: rgba(107, 114, 128, 0.12);
            color: var(--sb-muted);
        }

        .servicio-info {
            padding: 1.5rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .info-label {
            font-size: 0.75rem;
            color: var(--sb-muted);
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .info-value {
            font-size: 1rem;
            font-weight: 600;
        }

        .info-value.precio {
            color: var(--sb-accent);
            font-size: 1.4rem;
        }

        .servicio-desc {
            padding: 0 1.5rem 1.5rem;
            color: var(--sb-muted);
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .servicio-meta {
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

        @media (max-width:768px) {
            .servicio-show {
                padding: 0.75rem;
            }

            .servicio-hero {
                padding: 1.5rem;
            }

            .servicio-img {
                width: 120px;
                height: 120px;
            }

            .servicio-nombre {
                font-size: 1.3rem;
            }

            .servicio-info {
                padding: 1.25rem;
                grid-template-columns: 1fr;
            }

            .servicio-desc {
                padding: 0 1.25rem 1.25rem;
            }
        }

        @media (max-width:480px) {
            .servicio-show {
                padding: 0.5rem;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .servicio-hero {
                padding: 1.25rem;
            }

            .servicio-img {
                width: 100px;
                height: 100px;
            }
        }
    </style>

    <div class="servicio-show">
        <header class="page-header">
            <h1>📋 {{ $servicio->nombre }}</h1>
            <div style="display:flex; gap:0.5rem;">
                <a href="{{ route('admin.servicios.index') }}" class="btn btn-secondary">← Volver</a>
                <a href="{{ route('admin.servicios.edit', $servicio->id) }}" class="btn btn-primary">✏️ Editar</a>
            </div>
        </header>

        <article class="servicio-card">
            <div class="servicio-hero">
                @if ($servicio->imagen)
                    <img src="{{ asset('storage/' . $servicio->imagen) }}" alt="{{ $servicio->nombre }}"
                        class="servicio-img"
                        onerror="this.className+=' placeholder'; this.src=''; this.textContent='{{ substr($servicio->nombre, 0, 1) }}'">
                @else
                    <div class="servicio-img placeholder">{{ substr($servicio->nombre, 0, 1) }}</div>
                @endif
                <h2 class="servicio-nombre">{{ $servicio->nombre }}</h2>
                <span class="servicio-badge {{ $servicio->estado === 'activo' ? 'badge-activo' : 'badge-inactivo' }}">
                    {{ ucfirst($servicio->estado) }}
                </span>
            </div>

            <div class="servicio-info">
                <div class="info-item">
                    <span class="info-label">Precio</span>
                    <span class="info-value precio">S/ {{ number_format($servicio->precio, 2) }}</span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">ID</span>
                    <span class="info-value">#{{ $servicio->id }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Creado</span>
                    <span class="info-value">{{ $servicio->created_at->format('d M Y') }}</span>
                </div>
            </div>

            @if ($servicio->descripcion)
                <div class="servicio-desc">
                    <strong style="color:var(--sb-text);">Descripción:</strong><br>
                    {{ $servicio->descripcion }}
                </div>
            @endif

            <div class="servicio-meta">
                <span>Actualizado: {{ $servicio->updated_at->format('d M Y, H:i') }}</span>
                @if ($servicio->imagen)
                    <span>📷 Imagen: {{ basename($servicio->imagen) }}</span>
                @endif
            </div>
        </article>
    </div>
@endsection
