@extends('layouts.admin')
@section('title', 'Detalle de Testimonio')
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
            --sb-yellow: #eab308;
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
            --sb-yellow: #ca8a04;
            --sb-green: #16a34a;
            --sb-red: #dc2626;
        }

        .testimonio-show {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: var(--sb-text);
            padding: 1rem;
            max-width: 750px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }

        .testimonio-show *,
        .testimonio-show *::before,
        .testimonio-show *::after {
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
            cursor: pointer;
        }

        .btn-primary {
            background: var(--sb-accent);
            color: #000;
            border: none;
        }

        .btn-primary:hover {
            background: var(--sb-accent-hover);
            transform: translateY(-2px);
        }

        .testimonio-card {
            background: var(--sb-card);
            border: 1px solid var(--sb-border);
            border-radius: var(--sb-radius);
            overflow: hidden;
            transition: var(--sb-transition);
        }

        .testimonio-card:hover {
            border-color: var(--sb-accent-soft);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px dashed var(--sb-border);
            background: linear-gradient(180deg, var(--sb-card), var(--sb-bg));
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .client-name {
            font-size: 1.3rem;
            font-weight: 700;
            margin: 0;
        }

        .badge-status {
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .badge-pendiente {
            background: rgba(234, 179, 8, 0.15);
            color: var(--sb-yellow);
            border: 2px solid var(--sb-yellow);
        }

        .badge-aprobado {
            background: rgba(34, 197, 94, 0.15);
            color: var(--sb-green);
            border: 2px solid var(--sb-green);
        }

        .badge-rechazado {
            background: rgba(239, 68, 68, 0.15);
            color: var(--sb-red);
            border: 2px solid var(--sb-red);
        }

        .card-body {
            padding: 1.5rem;
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .stars-display {
            color: var(--sb-accent);
            font-size: 1.6rem;
            letter-spacing: 3px;
            margin-bottom: 0.5rem;
        }

        .quote-box {
            background: var(--sb-bg);
            border-radius: 10px;
            border: 1px solid var(--sb-border);
            padding: 1.5rem;
            position: relative;
        }

        .quote-box::before {
            content: '“';
            position: absolute;
            top: 0.5rem;
            left: 0.85rem;
            font-size: 3rem;
            color: var(--sb-accent);
            opacity: 0.3;
            line-height: 1;
        }

        .quote-text {
            font-size: 1.1rem;
            line-height: 1.7;
            color: var(--sb-text);
            padding-left: 2.5rem;
            font-style: italic;
        }

        .meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            padding-top: 0.85rem;
            border-top: 1px dashed var(--sb-border);
            font-size: 0.85rem;
            color: var(--sb-muted);
            margin-top: 1rem;
        }

        @media (max-width:768px) {
            .testimonio-show {
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

            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .quote-box {
                padding: 1.25rem;
            }

            .quote-text {
                font-size: 1rem;
            }
        }

        @media (max-width:480px) {
            .testimonio-show {
                padding: 0.5rem;
            }

            .page-header h1 {
                font-size: 1.3rem;
            }

            .stars-display {
                font-size: 1.3rem;
            }
        }

        @media (hover:none) and (pointer:coarse) {
            .btn {
                min-height: 48px !important;
            }
        }
    </style>

    <div class="testimonio-show">
        <header class="page-header">
            <h1>📝 Testimonio #{{ str_pad($testimonio->id, 3, '0', STR_PAD_LEFT) }}</h1>
            <a href="{{ route('admin.testimonios.edit', $testimonio->id) }}" class="btn btn-primary">✏️ Cambiar estado</a>
        </header>

        <article class="testimonio-card">
            <div class="card-header">
                <h2 class="client-name">De: {{ $testimonio->cliente->nombre ?? 'Visitante' }}
                    {{ $testimonio->cliente->apellido ?? '' }}</h2>
                <span class="badge-status badge-{{ $testimonio->estado }}">{{ ucfirst($testimonio->estado) }}</span>
            </div>

            <div class="card-body">
                <div class="stars-display">
                    @for ($i = 1; $i <= $testimonio->calificacion; $i++)
                        ★
                    @endfor
                    @for ($i = $testimonio->calificacion + 1; $i <= 5; $i++)
                        ☆
                    @endfor
                </div>

                <div class="quote-box">
                    <p class="quote-text">{{ nl2br(e($testimonio->comentario)) }}</p>
                </div>

                <div class="meta-row">
                    <span>📅 Recibido: {{ $testimonio->created_at->format('d/m/Y H:i') }}</span>
                    <span>🔄 Actualizado: {{ $testimonio->updated_at->format('d/m/Y H:i') }}</span>
                    <span>👤 ID Cliente: {{ $testimonio->cliente_id ?? 'N/A' }}</span>
                </div>
            </div>
        </article>
    </div>
@endsection
