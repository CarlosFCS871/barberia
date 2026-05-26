@extends('layouts.admin')
@section('title', 'Detalle de Mensaje')
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

        .contacto-show {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: var(--sb-text);
            padding: 1rem;
            max-width: 750px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }

        .contacto-show *,
        .contacto-show *::before,
        .contacto-show *::after {
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

        .btn-secondary {
            background: transparent;
            border: 1px solid var(--sb-border);
            color: var(--sb-text);
        }

        .btn-secondary:hover {
            border-color: var(--sb-accent);
            color: var(--sb-accent);
        }

        .contacto-card {
            background: var(--sb-card);
            border: 1px solid var(--sb-border);
            border-radius: var(--sb-radius);
            overflow: hidden;
            transition: var(--sb-transition);
        }

        .contacto-card:hover {
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

        .contacto-badge {
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

        .badge-respondido {
            background: rgba(34, 197, 94, 0.15);
            color: var(--sb-green);
            border: 2px solid var(--sb-green);
        }

        .badge-cerrado {
            background: rgba(239, 68, 68, 0.15);
            color: var(--sb-red);
            border: 2px solid var(--sb-red);
        }

        .card-body {
            padding: 1.5rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        .info-block {
            padding: 1rem;
            background: var(--sb-bg);
            border-radius: 10px;
            border: 1px solid var(--sb-border);
        }

        .info-title {
            font-size: 0.7rem;
            color: var(--sb-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 0.6rem;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 0.35rem 0;
            border-bottom: 1px dotted var(--sb-border);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: var(--sb-muted);
            font-size: 0.85rem;
        }

        .info-value {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--sb-text);
            text-align: right;
            max-width: 60%;
            overflow-wrap: break-word;
        }

        .mensaje-box {
            grid-column: 1/-1;
            background: var(--sb-bg);
            border-radius: 10px;
            border: 1px solid var(--sb-border);
            padding: 1.25rem;
            margin-top: 0.5rem;
        }

        .mensaje-title {
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

        .mensaje-title::before {
            content: '';
            width: 3px;
            height: 100%;
            background: var(--sb-accent);
            border-radius: 2px;
            position: absolute;
            left: 0;
        }

        .mensaje-content {
            font-size: 1rem;
            line-height: 1.6;
            color: var(--sb-text);
            white-space: pre-wrap;
        }

        .mensaje-meta {
            margin-top: 1rem;
            padding-top: 0.85rem;
            border-top: 1px dashed var(--sb-border);
            font-size: 0.75rem;
            color: var(--sb-muted);
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        @media (max-width:768px) {
            .contacto-show {
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

            .card-body {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .info-value {
                text-align: left;
            }
        }

        @media (max-width:480px) {
            .contacto-show {
                padding: 0.5rem;
            }

            .page-header h1 {
                font-size: 1.3rem;
            }

            .card-body {
                padding: 1rem;
            }

            .mensaje-content {
                font-size: 0.95rem;
            }
        }

        @media (hover:none) and (pointer:coarse) {
            .btn {
                min-height: 48px !important;
            }
        }
    </style>

    <div class="contacto-show">
        <header class="page-header">
            <h1>💬 Detalle del Mensaje</h1>
            <a href="{{ route('admin.contactos.edit', $contacto->id) }}" class="btn btn-primary">✏️ Cambiar estado</a>
        </header>

        <article class="contacto-card">
            <div class="card-header">
                <h2 style="margin:0;font-size:1.4rem;">De: {{ $contacto->nombre }}</h2>
                <span class="contacto-badge badge-{{ $contacto->estado }}">{{ ucfirst($contacto->estado) }}</span>
            </div>

            <div class="card-body">
                <div class="info-block">
                    <div class="info-title">👤 Información del Cliente</div>
                    <div class="info-row"><span class="info-label">Correo</span><span
                            class="info-value">{{ $contacto->correo }}</span></div>
                    <div class="info-row"><span class="info-label">Teléfono</span><span
                            class="info-value">{{ $contacto->telefono ?? 'No proporcionado' }}</span></div>
                    <div class="info-row"><span class="info-label">ID Sistema</span><span
                            class="info-value">{{ $contacto->cliente_id ? '#' . $contacto->cliente_id : 'Visitante' }}</span>
                    </div>
                </div>

                <div class="info-block">
                    <div class="info-title">📅 Registro & Metadatos</div>
                    <div class="info-row"><span class="info-label">Enviado</span><span
                            class="info-value">{{ $contacto->created_at->format('d/m/Y H:i') }}</span></div>
                    <div class="info-row"><span class="info-label">Última actualización</span><span
                            class="info-value">{{ $contacto->updated_at->format('d/m/Y H:i') }}</span></div>
                </div>

                <div class="mensaje-box">
                    <div class="mensaje-title">📝 Mensaje Completo</div>
                    <div class="mensaje-content">{{ nl2br(e($contacto->mensaje)) }}</div>
                    <div class="mensaje-meta">
                        <span>🕒 Recibido hace {{ $contacto->created_at->diffForHumans() }}</span>
                        <span>🆔 ID: #{{ $contacto->id }}</span>
                    </div>
                </div>
            </div>
        </article>
    </div>
@endsection
