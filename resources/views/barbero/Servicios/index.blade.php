@extends('layouts.barbero')

@section('title', 'Lista de Servicios')


@section('BarberoContenido')
    <style>
        /* ================= VARIABLES - SISTEMA CONSISTENTE ================= */
        :root {
            --bg-primary: #000000;
            --bg-sidebar: #000000;
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
            --warning: #eab308;
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

        /* ================= BASE ================= */
        .servicios-index {
            font-family: var(--font);
            color: var(--text-primary);
            padding: 1.5rem;
            max-width: 1400px;
            margin: 0 auto
        }

        .servicios-index *,
        .servicios-index *::before,
        .servicios-index *::after {
            box-sizing: border-box
        }

        /* ================= HEADER ================= */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border)
        }

        .page-header h1 {
            font-size: clamp(1.5rem, 2.5vw, 2rem);
            font-weight: 800;
            margin: 0
        }

        .page-header p {
            color: var(--text-secondary);
            font-size: 0.95rem;
            margin: 0.25rem 0 0;
            max-width: 600px
        }

        .btn-create {
            background: var(--accent);
            color: #000;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.9rem;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            box-shadow: 0 4px 14px rgba(245, 220, 91, 0.2)
        }

        .btn-create:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(245, 220, 91, 0.3);
            background: var(--accent-hover);
            color: #000
        }

        .btn-create i {
            width: 18px;
            height: 18px
        }

        /* ================= FILTERS ================= */
        .filters-section {
            margin-bottom: 1.5rem
        }

        .filters-form {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1rem
        }

        .filter-group {
            flex: 1;
            min-width: 180px;
            position: relative
        }

        .filter-group input,
        .filter-group select {
            width: 100%;
            padding: 0.7rem 1rem;
            padding-right: 2rem;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: var(--bg-primary);
            color: var(--text-primary);
            font-size: 0.9rem;
            transition: var(--transition);
            appearance: none;
            min-height: 44px
        }

        .filter-group select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 14px
        }

        .filter-group input::placeholder {
            color: var(--text-muted);
            opacity: 0.7
        }

        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 2px var(--accent-glow)
        }

        .btn-apply,
        .btn-reset {
            padding: 0.7rem 1.2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            white-space: nowrap
        }

        .btn-apply {
            background: var(--accent);
            color: #000;
            border: none
        }

        .btn-apply:hover {
            background: var(--accent-hover)
        }

        .btn-reset {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text-secondary)
        }

        .btn-reset:hover {
            border-color: var(--danger);
            color: var(--danger)
        }

        /* ================= GRID & CARDS ================= */
        .servicios-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem
        }

        .servicio-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            position: relative
        }

        .servicio-card:hover {
            transform: translateY(-4px);
            border-color: var(--border-hover);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25), var(--accent-glow)
        }

        .servicio-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--accent), transparent)
        }

        .servicio-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: var(--bg-primary);
            border-bottom: 1px solid var(--border);
            transition: var(--transition)
        }

        .servicio-img.placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--bg-hover), var(--bg-card));
            color: var(--accent);
            font-size: 3rem
        }

        .servicio-body {
            padding: 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.75rem
        }

        .servicio-name {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0;
            line-height: 1.3
        }

        .servicio-desc {
            font-size: 0.9rem;
            color: var(--text-secondary);
            line-height: 1.5;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden
        }

        .servicio-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: var(--text-muted);
            flex-wrap: wrap;
            gap: 0.5rem
        }

        .servicio-price {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--accent);
            letter-spacing: -0.5px
        }

        .servicio-duration {
            display: flex;
            align-items: center;
            gap: 4px
        }

        .servicio-duration i {
            width: 14px;
            height: 14px
        }

        .servicio-date {
            font-size: 0.75rem;
            color: var(--text-muted)
        }

        /* Badges */
        .badge {
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            justify-content: center
        }

        .badge-activo {
            background: rgba(34, 197, 94, 0.15);
            color: var(--success);
            border: 1px solid rgba(34, 197, 94, 0.3)
        }

        .badge-inactivo {
            background: rgba(107, 114, 128, 0.15);
            color: var(--text-muted);
            border: 1px solid rgba(107, 114, 128, 0.3)
        }

        /* Actions */
        .card-actions {
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: center;
            gap: 0.5rem
        }

        .btn-view,
        .btn-edit,
        .btn-delete {
            padding: 0.5rem 1rem;
            background: transparent;
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text-secondary);
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: var(--transition)
        }

        .btn-view:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--bg-hover)
        }

        .btn-edit:hover {
            border-color: var(--info);
            color: var(--info);
            background: rgba(59, 130, 246, 0.1)
        }

        .btn-delete:hover {
            border-color: var(--danger);
            color: var(--danger);
            background: rgba(239, 68, 68, 0.1)
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
            border-top: 1px solid var(--border);
            background: var(--bg-card)
        }

        .pagination {
            display: flex;
            gap: 4px;
            margin: 0;
            padding: 0;
            list-style: none
        }

        .pagination .page-item {
            display: inline-block
        }

        .pagination .page-link,
        .pagination .page-item span {
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid var(--border);
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            min-height: 34px;
            font-size: 0.8rem
        }

        .pagination .page-link:hover {
            border-color: var(--accent);
            color: var(--accent)
        }

        .pagination .active .page-link,
        .pagination .page-item.active span {
            background: var(--accent);
            color: #000;
            border-color: var(--accent);
            font-weight: 700
        }

        .pagination .disabled span {
            opacity: 0.5;
            cursor: not-allowed
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--text-muted);
            grid-column: 1/-1;
            background: var(--bg-card);
            border: 1px dashed var(--border);
            border-radius: var(--radius)
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--accent);
            opacity: 0.5;
            margin-bottom: 1rem
        }

        .empty-state p:first-child {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem
        }

        .empty-state .btn-create {
            margin-top: 1rem
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .servicio-card {
            animation: fadeIn 0.4s ease forwards;
            opacity: 0
        }

        .servicio-card:nth-child(1) {
            animation-delay: 0.05s
        }

        .servicio-card:nth-child(2) {
            animation-delay: 0.1s
        }

        .servicio-card:nth-child(3) {
            animation-delay: 0.15s
        }

        .servicio-card:nth-child(4) {
            animation-delay: 0.2s
        }

        .servicio-card:nth-child(5) {
            animation-delay: 0.25s
        }

        .servicio-card:nth-child(6) {
            animation-delay: 0.3s
        }

        /* ================= RESPONSIVE ================= */
        @media(max-width:1024px) {
            .servicios-index {
                padding: 1rem
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem
            }

            .btn-create {
                width: 100%;
                justify-content: center
            }

            .filters-form {
                flex-direction: column;
                align-items: stretch
            }

            .filter-group {
                min-width: 100%
            }

            .servicios-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 1.25rem
            }
        }

        @media(max-width:768px) {
            .servicios-index {
                padding: 0.75rem
            }

            .page-header h1 {
                font-size: 1.4rem
            }

            .page-header p {
                font-size: 0.9rem
            }

            .servicios-grid {
                grid-template-columns: 1fr
            }

            .servicio-img {
                height: 180px
            }

            .servicio-body {
                padding: 1rem
            }

            .servicio-name {
                font-size: 1rem
            }

            .servicio-price {
                font-size: 1.2rem
            }
        }

        @media(max-width:480px) {
            .servicios-index {
                padding: 0.5rem
            }

            .page-header h1 {
                font-size: 1.3rem
            }

            .servicio-img {
                height: 160px
            }

            .servicio-card {
                border-radius: 12px
            }

            .card-actions {
                flex-direction: column
            }

            .btn-view,
            .btn-edit,
            .btn-delete {
                width: 100%;
                justify-content: center
            }
        }

        @media(hover:none) and (pointer:coarse) {

            .btn-create,
            .btn-apply,
            .btn-reset,
            .btn-view,
            .btn-edit,
            .btn-delete,
            .filter-group input,
            .filter-group select {
                min-height: 48px !important
            }

            input,
            select {
                font-size: 16px !important
            }

            .servicio-card:hover {
                transform: none !important
            }
        }
    </style>

    <div class="servicios-index">
        <header class="page-header">
            <div>
                <h1>✂️ Mis Servicios</h1>
                <p>Gestiona los servicios que ofreces en tu barbería: precios y disponibilidad</p>
            </div>
            <a href="{{ route('barbero.servicios.create') }}" class="btn-create">
                <i data-lucide="plus"></i> Nuevo Servicio
            </a>
        </header>

        <section class="filters-section">
            <form class="filters-form" method="GET" action="{{ route('barbero.servicios.index') }}">
                <div class="filter-group">
                    <input type="text" name="search" placeholder="Buscar servicio..." value="{{ request('search') }}">
                </div>
                <div class="filter-group">
                    <select name="estado">
                        <option value="">Todos los estados</option>
                        <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select name="orden">
                        <option value="">Ordenar por</option>
                        <option value="precio_asc" {{ request('orden') == 'precio_asc' ? 'selected' : '' }}>Precio: Menor a
                            Mayor
                        </option>
                        <option value="precio_desc" {{ request('orden') == 'precio_desc' ? 'selected' : '' }}>Precio: Mayor
                            a
                            Menor</option>
                        <option value="nombre" {{ request('orden') == 'nombre' ? 'selected' : '' }}>Nombre: A-Z</option>
                    </select>
                </div>
                <button type="submit" class="btn-apply">Filtrar</button>
                <a href="{{ route('barbero.servicios.index') }}" class="btn-reset">Limpiar</a>
            </form>
        </section>

        <section class="servicios-grid">
            @forelse($servicios ?? [] as $servicio)
                <article class="servicio-card">
                    @if ($servicio->imagen)
                        <img src="{{ asset('storage/' . $servicio->imagen) }}" alt="{{ $servicio->nombre }}"
                            class="servicio-img"
                            onerror="this.classList.add('placeholder');this.src='';this.textContent='✂️'">
                    @else
                        <div class="servicio-img placeholder">✂️</div>
                    @endif
                    <div class="servicio-body">
                        <h3 class="servicio-name">{{ $servicio->nombre }}</h3>
                        <p class="servicio-desc">{{ $servicio->descripcion ?? 'Sin descripción' }}</p>
                        <div class="servicio-meta">
                            <span class="servicio-price">S/. {{ number_format($servicio->precio, 2) }}</span>
                            
                        </div>
                        <span
                            class="badge {{ $servicio->estado === 'activo' ? 'badge-activo' : 'badge-inactivo' }}">{{ ucfirst($servicio->estado) }}</span>
                        <span class="servicio-date">Creado: {{ $servicio->created_at->format('d M Y') }}</span>
                        <div class="card-actions">
                            <a href="{{ route('barbero.servicios.show', $servicio->id) }}" class="btn-view">👁️ Ver</a>
                            <a href="{{ route('barbero.servicios.edit', $servicio->id) }}" class="btn-edit">✏️ Editar</a>
                            <form action="{{ route('barbero.servicios.destroy', $servicio->id) }}" method="POST"
                                onsubmit="return confirm('¿Eliminar este servicio?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-delete">
                                    🗑️ Eliminar
                                </button>

                            </form>
                        </div>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <i data-lucide="scissors"></i>
                    <p>No tienes servicios registrados</p>
                    <p style="font-size:0.9rem;margin-bottom:1rem">Crea tu primer servicio para comenzar a ofrecerlo a tus
                        clientes</p>
                    <a href="{{ route('barbero.servicios.create') }}" class="btn-create">Crear Primer Servicio</a>
                </div>
            @endforelse
        </section>

        @if (isset($servicios) && $servicios->hasPages())
            <div class="pagination-wrapper">{{ $servicios->withQueryString()->links() }}</div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.servicio-card').forEach((card, index) => {
                card.style.animationDelay = `${index*0.05}s`
            });
        });
    </script>
@endsection
