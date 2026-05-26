@extends('layouts.admin')
@section('title', 'Gestión de Promociones')
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
            --sb-radius: 14px;
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
        .promos-index {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: var(--sb-text);
            padding: 1rem;
            width: 100%;
            max-width: 100vw;
            overflow-x: hidden;
            box-sizing: border-box;
        }

        .promos-index *,
        .promos-index *::before,
        .promos-index *::after {
            box-sizing: border-box;
            max-width: 100%;
            overflow-wrap: break-word;
        }

        /* ================= HEADER ================= */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
        }

        .page-header h1 {
            font-size: clamp(1.25rem, 4vw, 1.75rem);
            font-weight: 800;
            margin: 0;
            line-height: 1.2;
        }

        .page-header p {
            color: var(--sb-muted);
            font-size: 0.9rem;
            margin: 0.25rem 0 0;
            width: 100%;
        }

        /* ================= FILTERS ================= */
        .filters-section {
            margin-bottom: 1.5rem;
        }

        .filters-form {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
            background: var(--sb-card);
            border: 1px solid var(--sb-border);
            border-radius: var(--sb-radius);
            padding: 0.85rem;
        }

        .filter-group {
            flex: 1;
            min-width: 150px;
        }

        .filter-group select {
            width: 100%;
            padding: 0.65rem 0.9rem;
            padding-right: 2rem;
            border-radius: 8px;
            border: 1px solid var(--sb-border);
            background: var(--sb-bg);
            color: var(--sb-text);
            font-size: 0.875rem;
            transition: var(--sb-transition);
            appearance: none;
            min-height: 42px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%23a1a1aa' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 14px;
        }

        .filter-group select:focus {
            outline: none;
            border-color: var(--sb-accent);
            box-shadow: 0 0 0 2px var(--sb-accent-soft);
        }

        .btn-apply,
        .btn-reset {
            padding: 0.65rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: var(--sb-transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            white-space: nowrap;
        }

        .btn-apply {
            background: var(--sb-accent);
            color: #000;
            border: none;
        }

        .btn-apply:hover {
            background: var(--sb-accent-hover);
        }

        .btn-reset {
            background: transparent;
            border: 1px solid var(--sb-border);
            color: var(--sb-muted);
        }

        .btn-reset:hover {
            border-color: var(--sb-red);
            color: var(--sb-red);
        }

        /* ================= GRID & CARDS ================= */
        .promo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .promo-card {
            background: var(--sb-card);
            border: 1px solid var(--sb-border);
            border-radius: var(--sb-radius);
            overflow: hidden;
            transition: var(--sb-transition);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .promo-card:hover {
            transform: translateY(-4px);
            border-color: var(--sb-accent-soft);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
        }

        .promo-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background: var(--sb-bg);
            border-bottom: 1px solid var(--sb-border);
        }

        .promo-img.placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--sb-accent-soft), var(--sb-card));
            color: var(--sb-accent);
            font-size: 3rem;
        }

        .promo-body {
            padding: 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .promo-name {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0;
            line-height: 1.3;
        }

        .promo-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
            color: var(--sb-muted);
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .promo-barber {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .promo-barber span {
            font-weight: 500;
        }

        .discount-badge {
            background: var(--sb-accent);
            color: #000;
            font-weight: 800;
            padding: 0.3rem 0.6rem;
            border-radius: 6px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
        }

        .promo-dates {
            font-size: 0.78rem;
            color: var(--sb-muted);
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
            margin-top: 0.5rem;
        }

        .promo-dates i {
            width: 12px;
            text-align: center;
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
            justify-content: center;
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

        /* Actions */
        .card-actions {
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid var(--sb-border);
            display: flex;
            justify-content: center;
        }

        .btn-view {
            padding: 0.5rem 1rem;
            background: transparent;
            border: 1px solid var(--sb-border);
            border-radius: 8px;
            color: var(--sb-text);
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: var(--sb-transition);
            width: 100%;
            justify-content: center;
        }

        .btn-view:hover {
            border-color: var(--sb-accent);
            color: var(--sb-accent);
            background: var(--sb-accent-soft);
        }

        /* Pagination & Empty */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0.85rem;
            border-top: 1px solid var(--sb-border);
            background: var(--sb-card);
        }

        .pagination-wrapper .pagination {
            display: flex;
            gap: 4px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .pagination-wrapper .page-item {
            display: inline-block;
        }

        .pagination-wrapper .page-link,
        .pagination-wrapper .page-item span {
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid var(--sb-border);
            color: var(--sb-text);
            text-decoration: none;
            font-weight: 500;
            transition: var(--sb-transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            min-height: 34px;
            font-size: 0.8rem;
        }

        .pagination-wrapper .page-link:hover {
            border-color: var(--sb-accent);
            color: var(--sb-accent);
        }

        .pagination-wrapper .active .page-link,
        .pagination-wrapper .page-item.active span {
            background: var(--sb-accent);
            color: #000;
            border-color: var(--sb-accent);
            font-weight: 700;
        }

        .pagination-wrapper .disabled span {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--sb-muted);
            grid-column: 1 / -1;
        }

        .empty-state p {
            margin: 0.25rem 0;
        }

        .empty-state p:first-child {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--sb-text);
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 1024px) {
            .promos-index {
                padding: 0.85rem;
            }

            .filters-form {
                padding: 0.75rem;
                gap: 0.55rem;
            }

            .filter-group {
                min-width: calc(50% - 0.35rem);
                flex: none;
            }

            .filter-group select {
                padding: 0.6rem 0.85rem;
                font-size: 0.85rem;
                min-height: 40px;
            }

            .btn-apply,
            .btn-reset {
                padding: 0.6rem 0.9rem;
                font-size: 0.85rem;
                min-height: 40px;
            }

            .promo-grid {
                gap: 1.25rem;
            }
        }

        @media (max-width: 768px) {
            .promos-index {
                padding: 0.6rem;
            }

            .page-header {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 0.5rem !important;
                margin-bottom: 1.2rem !important;
            }

            .filters-section {
                margin-bottom: 1rem !important;
            }

            .filters-form {
                flex-direction: column !important;
                align-items: stretch !important;
                padding: 0.8rem !important;
                gap: 0.6rem !important;
            }

            .filter-group {
                min-width: 100% !important;
                width: 100% !important;
                flex: none !important;
            }

            .filter-group select {
                padding: 0.7rem 0.9rem !important;
                font-size: 0.9rem !important;
                min-height: 46px !important;
            }

            .btn-apply,
            .btn-reset {
                width: 100% !important;
                padding: 0.7rem 1rem !important;
                font-size: 0.9rem !important;
                min-height: 46px !important;
                justify-content: center !important;
            }

            .promo-grid {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
            }

            .promo-img {
                height: 160px;
            }
        }

        @media (max-width: 480px) {
            .promos-index {
                padding: 0.4rem !important;
            }

            .page-header h1 {
                font-size: 1.1rem !important;
            }

            .page-header p {
                font-size: 0.8rem !important;
            }

            .filters-form {
                padding: 0.7rem !important;
                gap: 0.5rem !important;
            }

            .filter-group select {
                padding: 0.65rem 0.85rem !important;
                font-size: 0.875rem !important;
                min-height: 44px !important;
            }

            .btn-apply,
            .btn-reset {
                padding: 0.65rem 0.9rem !important;
                font-size: 0.875rem !important;
                min-height: 44px !important;
            }

            .promo-img {
                height: 140px;
            }

            .promo-body {
                padding: 1rem;
            }
        }

        @media (hover: none) and (pointer: coarse) {

            .btn-apply,
            .btn-reset,
            .btn-view,
            .filter-group select {
                min-height: 44px !important;
                min-width: 44px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
            }

            select,
            input {
                font-size: 16px !important;
            }

            .btn-view:hover {
                transform: none !important;
            }

            .promo-card:hover {
                transform: none !important;
            }
        }

        @media (max-width: 480px) {

            html,
            body {
                overflow-x: hidden !important;
                width: 100% !important;
                max-width: 100vw !important;
            }

            .main-content,
            .content-wrapper {
                overflow-x: hidden !important;
                width: 100% !important;
            }

            img {
                max-width: 100% !important;
                height: auto !important;
            }

            select,
            button {
                max-width: 100% !important;
            }

            .badge,
            .btn-view,
            .btn-apply,
            .btn-reset {
                display: inline-flex !important;
                flex-shrink: 0 !important;
            }
        }
    </style>

    <div class="promos-index">
        <header class="page-header">
            <div>
                <h1>🎁 Promociones Activas</h1>
                <p>Visualiza y consulta las campañas de marketing y descuentos de la barbería</p>
            </div>
        </header>

        <section class="filters-section">
            <form class="filters-form" method="GET" action="{{ route('admin.promociones.index') }}">
                <div class="filter-group">
                    <select name="barbero_id">
                        <option value="">Todos los barberos</option>
                        @foreach ($barberos ?? [] as $barbero)
                            <option value="{{ $barbero->id }}"
                                {{ request('barbero_id') == $barbero->id ? 'selected' : '' }}>
                                {{ $barbero->nombre }} {{ $barbero->apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <select name="estado">
                        <option value="">Todos los estados</option>
                        <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        <option value="expirado" {{ request('estado') == 'expirado' ? 'selected' : '' }}>Expirado</option>
                    </select>
                </div>
                <button type="submit" class="btn-apply">Filtrar</button>
                <a href="{{ route('admin.promociones.index') }}" class="btn-reset">Limpiar</a>
            </form>
        </section>

        <section class="promo-grid">
            @forelse($promociones ?? [] as $promo)
                @php
                    $esExpirado = $promo->fecha_fin && \Carbon\Carbon::parse($promo->fecha_fin)->isPast();
                    $estadoDisplay =
                        $promo->estado === 'activo' && !$esExpirado
                            ? 'activo'
                            : ($esExpirado
                                ? 'expirado'
                                : 'inactivo');
                    $badgeClass = match ($estadoDisplay) {
                        'activo' => 'badge-activo',
                        'expirado' => 'badge-expirado',
                        default => 'badge-inactivo',
                    };
                @endphp
                <article class="promo-card">
                    @if ($promo->imagen)
                        <img src="{{ asset('storage/' . $promo->imagen) }}" alt="{{ $promo->nombre }}" class="promo-img"
                            onerror="this.classList.add('placeholder'); this.src=''; this.textContent='🎯';">
                    @else
                        <div class="promo-img placeholder">🎯</div>
                    @endif
                    <div class="promo-body">
                        <h3 class="promo-name">{{ $promo->nombre }}</h3>
                        <div class="discount-badge">-{{ $promo->descuento }}%</div>
                        <div class="promo-meta">
                            <div class="promo-barber">✂️ {{ $promo->barbero->nombre ?? 'General' }}
                                {{ $promo->barbero->apellido ?? '' }}</div>
                            <span class="badge {{ $badgeClass }}">{{ ucfirst($estadoDisplay) }}</span>
                        </div>
                        <div class="promo-dates">
                            <span>📅 Inicio: {{ \Carbon\Carbon::parse($promo->fecha_inicio)->format('d/m/Y') }}</span>
                            <span>🏁 Fin: {{ \Carbon\Carbon::parse($promo->fecha_fin)->format('d/m/Y') }}</span>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.promociones.show', $promo->id) }}" class="btn-view">👁️ Ver
                                Detalle</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <p>🎁 No hay promociones registradas</p>
                    <p style="font-size:0.85rem">Ajusta los filtros o crea nuevas campañas desde el panel.</p>
                </div>
            @endforelse
        </section>

        @if (isset($promociones) && $promociones->hasPages())
            <div class="pagination-wrapper">
                {{ $promociones->links() }}
            </div>
        @endif
    </div>
@endsection
