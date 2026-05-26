@extends('layouts.admin')
@section('title', 'Perfil de Usuario')
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
            --sb-red: #ef4444;
            --sb-green: #22c55e;
            --sb-blue: #60a5fa;
            --sb-purple: #c084fc;
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

        .user-show-view {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: var(--sb-text);
            padding: 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--sb-border);
        }

        .page-header h1 {
            font-size: clamp(1.5rem, 2.5vw, 2rem);
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .page-header .actions {
            display: flex;
            gap: 0.75rem;
        }

        .btn {
            padding: 0.7rem 1.4rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            cursor: pointer;
            transition: var(--sb-transition);
            border: none;
        }

        .btn-primary {
            background: var(--sb-accent);
            color: #000;
        }

        .btn-primary:hover {
            background: var(--sb-accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(245, 220, 91, 0.25);
            color: #000;
        }

        .btn-secondary {
            background: transparent;
            border: 1px solid var(--sb-border);
            color: var(--sb-text);
        }

        .btn-secondary:hover {
            border-color: var(--sb-accent);
            color: var(--sb-accent);
            background: var(--sb-accent-soft);
        }

        .profile-hero {
            background: var(--sb-card);
            border: 1px solid var(--sb-border);
            border-radius: var(--sb-radius);
            padding: 2.5rem;
            text-align: center;
            margin-bottom: 2rem;
            transition: var(--sb-transition);
        }

        .profile-hero:hover {
            border-color: var(--sb-accent-soft);
        }

        .profile-avatar {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--sb-accent-soft);
            margin: 0 auto 1.25rem;
            display: block;
            transition: var(--sb-transition);
        }

        .profile-avatar:hover {
            transform: scale(1.03);
            border-color: var(--sb-accent);
        }

        .profile-name {
            font-size: 1.8rem;
            font-weight: 800;
            margin: 0 0 0.5rem;
            letter-spacing: -0.5px;
        }

        .profile-email {
            color: var(--sb-muted);
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .badges-row {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .badge {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge-admin {
            background: var(--sb-accent-soft);
            color: var(--sb-accent);
            border: 1px solid rgba(245, 220, 91, 0.25);
        }

        .badge-barber {
            background: rgba(59, 130, 246, 0.12);
            color: var(--sb-blue);
            border: 1px solid rgba(59, 130, 246, 0.25);
        }

        .badge-client {
            background: rgba(168, 85, 247, 0.12);
            color: var(--sb-purple);
            border: 1px solid rgba(168, 85, 247, 0.25);
        }

        .badge-active {
            background: rgba(34, 197, 94, 0.12);
            color: var(--sb-green);
            border: 1px solid rgba(34, 197, 94, 0.25);
        }

        .badge-inactive {
            background: rgba(107, 114, 128, 0.12);
            color: var(--sb-gray);
            border: 1px solid rgba(107, 114, 128, 0.25);
        }

        .badge-suspended {
            background: rgba(239, 68, 68, 0.12);
            color: var(--sb-red);
            border: 1px solid rgba(239, 68, 68, 0.25);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .info-card {
            background: var(--sb-card);
            border: 1px solid var(--sb-border);
            border-radius: var(--sb-radius);
            padding: 1.5rem;
            transition: var(--sb-transition);
        }

        .info-card:hover {
            transform: translateY(-3px);
            border-color: var(--sb-accent-soft);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .info-card h3 {
            font-size: 1rem;
            font-weight: 700;
            margin: 0 0 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--sb-border);
            color: var(--sb-accent);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px dashed var(--sb-border);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: var(--sb-muted);
            font-size: 0.85rem;
            font-weight: 500;
        }

        .info-value {
            font-weight: 600;
            font-size: 0.95rem;
            text-align: right;
            max-width: 60%;
            word-break: break-word;
        }

        .info-value.muted {
            color: var(--sb-muted);
            font-weight: 400;
        }

        .system-meta {
            background: var(--sb-bg);
            padding: 1rem;
            border-radius: 10px;
            margin-top: 1rem;
        }

        .system-meta p {
            margin: 0.4rem 0;
            font-size: 0.85rem;
            color: var(--sb-muted);
            display: flex;
            justify-content: space-between;
        }

        .system-meta strong {
            color: var(--sb-text);
        }

        @media (max-width: 768px) {
            .user-show-view {
                padding: 1rem;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .page-header .actions {
                width: 100%;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .profile-hero {
                padding: 1.5rem;
            }

            .profile-avatar {
                width: 110px;
                height: 110px;
            }

            .profile-name {
                font-size: 1.4rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.4rem;
            }

            .info-value {
                text-align: left;
                max-width: 100%;
            }
        }
    </style>

    <div class="user-show-view">
        <header class="page-header">
            <h1>👤 Detalle de Usuario</h1>
            <div class="actions">
                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">
                    ← Volver
                </a>
                <a href="{{ route('admin.usuarios.edit', $usuario->id) }}" class="btn btn-primary">
                    ✏️ Editar Usuario
                </a>
            </div>
        </header>
        <section class="profile-hero">
            @if ($usuario->foto)
                <img src="{{ asset('storage/' . $usuario->foto) }}" alt="{{ $usuario->nombre }} {{ $usuario->apellido }}"
                    class="profile-avatar">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($usuario->nombre . ' ' . $usuario->apellido) }}&background=F5DC5B&color=000&size=280"
                    alt="{{ $usuario->nombre }} {{ $usuario->apellido }}" class="profile-avatar">
            @endif
            <h2 class="profile-name">{{ $usuario->nombre }} {{ $usuario->apellido }}</h2>
            <p class="profile-email">{{ $usuario->email }}</p>
            <div class="badges-row">
                @php
                    $rolClass = match ($usuario->rol) {
                        'admin' => 'badge-admin',
                        'barbero' => 'badge-barber',
                        default => 'badge-client',
                    };
                    $estadoClass = match ($usuario->estado) {
                        'activo' => 'badge-active',
                        'inactivo' => 'badge-inactive',
                        default => 'badge-suspended',
                    };
                @endphp
                <span class="badge {{ $rolClass }}">
                    @if ($usuario->rol === 'admin')
                        🛡️
                    @elseif($usuario->rol === 'barbero')
                        ✂️
                    @else
                        👤
                    @endif
                    {{ ucfirst($usuario->rol) }}
                </span>
                <span class="badge {{ $estadoClass }}">
                    @if ($usuario->estado === 'activo')
                        ●
                    @elseif($usuario->estado === 'inactivo')
                        ◌
                    @else
                        ✕
                    @endif
                    {{ ucfirst($usuario->estado) }}
                </span>
            </div>
        </section>

        <section class="info-grid">
            <article class="info-card">
                <h3>📋 Información Personal</h3>
                <div class="info-row">
                    <span class="info-label">Nombre</span>
                    <span class="info-value">{{ $usuario->nombre }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Apellido</span>
                    <span class="info-value">{{ $usuario->apellido }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nombre Completo</span>
                    <span class="info-value">{{ $usuario->nombre }} {{ $usuario->apellido }}</span>
                </div>
            </article>

            <article class="info-card">
                <h3>📞 Información de Contacto</h3>
                <div class="info-row">
                    <span class="info-label">Correo Electrónico</span>
                    <span class="info-value">{{ $usuario->email }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Teléfono</span>
                    <span class="info-value {{ $usuario->telefono ? '' : 'muted' }}">
                        {{ $usuario->telefono ?? 'No registrado' }}
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Contacto Vía</span>
                    <span class="info-value">
                        @if ($usuario->telefono)
                            <a href="tel:{{ $usuario->telefono }}" style="color:var(--sb-accent);text-decoration:none;">📞
                                Llamar</a>
                        @else
                            <span class="muted">—</span>
                        @endif
                    </span>
                </div>
            </article>

            <article class="info-card">
                <h3>⚙️ Información del Sistema</h3>
                <div class="info-row">
                    <span class="info-label">ID de Usuario</span>
                    <span class="info-value">#{{ $usuario->id }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Rol</span>
                    <span class="info-value">{{ ucfirst($usuario->rol) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Estado</span>
                    <span class="info-value">{{ ucfirst($usuario->estado) }}</span>
                </div>
                <div class="system-meta">
                    <p><span>Registrado el:</span>
                        <strong>{{ $usuario->created_at ? $usuario->created_at->format('d M Y') : '—' }}</strong>
                    </p>
                    <p><span>Última actualización:</span>
                        <strong>{{ $usuario->updated_at ? $usuario->updated_at->format('d M Y, H:i') : '—' }}</strong>
                    </p>
                </div>
            </article>
        </section>

    </div>
@endsection
