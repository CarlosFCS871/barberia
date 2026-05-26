@extends('layouts.admin')
@section('title', 'Gestión de Citas')
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
            --sb-yellow: #ca8a04;
            --sb-green: #16a34a;
            --sb-red: #dc2626;
            --sb-blue: #3b82f6;
        }

        /* ================= BASE RESPONSIVE ================= */
        .citas-index {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: var(--sb-text);
            background: transparent;
            padding: 1rem;
            width: 100%;
            max-width: 100vw;
            overflow-x: hidden;
            box-sizing: border-box;
        }

        .citas-index *,
        .citas-index *::before,
        .citas-index *::after {
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
            width: 100%;
        }

        .page-header p {
            color: var(--sb-muted);
            font-size: 0.9rem;
            margin: 0.25rem 0 0;
            width: 100%;
        }

        /* ================= FILTERS ================= */
        .filters-section {
            margin-bottom: 1.25rem;
        }

        .filters-form {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
            align-items: center;
            background: var(--sb-card);
            border: 1px solid var(--sb-border);
            border-radius: var(--sb-radius);
            padding: 0.85rem;
        }

        .filter-group {
            flex: 1;
            min-width: 140px;
            position: relative;
        }

        .filter-group input,
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
        }

        .filter-group select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%23a1a1aa' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 14px;
        }

        .filter-group input::placeholder {
            color: var(--sb-muted);
            opacity: 0.7;
        }

        .filter-group input:focus,
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

        /* ================= TABLE WRAPPER ================= */
        .table-wrapper {
            background: var(--sb-card);
            border: 1px solid var(--sb-border);
            border-radius: var(--sb-radius);
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
            scrollbar-color: var(--sb-accent-soft) transparent;
            margin-bottom: 1rem;
        }

        .table-wrapper::-webkit-scrollbar {
            height: 4px;
        }

        .table-wrapper::-webkit-scrollbar-thumb {
            background: var(--sb-accent-soft);
            border-radius: 10px;
        }

        /* ================= TABLE ================= */
        .citas-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
            min-width: 650px;
        }

        .citas-table th {
            text-align: left;
            padding: 0.85rem 1rem;
            font-weight: 600;
            color: var(--sb-muted);
            border-bottom: 1px solid var(--sb-border);
            background: rgba(255, 255, 255, 0.02);
            white-space: nowrap;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.4px;
        }

        .citas-table td {
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--sb-border);
            vertical-align: middle;
            white-space: nowrap;
            transition: var(--sb-transition);
        }

        .citas-table tbody tr:hover {
            background: var(--sb-accent-soft);
        }

        .citas-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Client/Barber Cells */
        .person-cell {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 140px;
        }

        .person-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--sb-accent-soft);
            color: var(--sb-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.75rem;
            flex-shrink: 0;
        }

        .person-name {
            font-weight: 600;
            display: block;
            line-height: 1.2;
            font-size: 0.88rem;
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Servicio & Fecha/Hora */
        .servicio-tag {
            color: var(--sb-accent);
            font-weight: 600;
            font-size: 0.85rem;
        }

        .fecha-hora {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .fecha-hora .fecha {
            font-weight: 600;
            color: var(--sb-text);
        }

        .fecha-hora .hora {
            color: var(--sb-muted);
            font-size: 0.8rem;
        }

        /* Badges */
        .badge {
            padding: 3px 9px;
            border-radius: 50px;
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 68px;
            text-align: center;
        }

        .badge-pendiente {
            background: rgba(234, 179, 8, 0.15);
            color: var(--sb-yellow);
            border: 1px solid rgba(234, 179, 8, 0.3);
        }

        .badge-confirmada {
            background: rgba(34, 197, 94, 0.15);
            color: var(--sb-green);
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .badge-cancelada {
            background: rgba(239, 68, 68, 0.15);
            color: var(--sb-red);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .badge-finalizada {
            background: rgba(96, 165, 250, 0.15);
            color: var(--sb-blue);
            border: 1px solid rgba(96, 165, 250, 0.3);
        }

        /* Actions (Read-Only) */
        .actions-cell {
            display: flex;
            gap: 6px;
            justify-content: flex-end;
            flex-wrap: nowrap;
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
        }

        .btn-view:hover {
            border-color: var(--sb-accent);
            color: var(--sb-accent);
            background: var(--sb-accent-soft);
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.85rem 1rem;
            border-top: 1px solid var(--sb-border);
            background: var(--sb-card);
            font-size: 0.8rem;
            color: var(--sb-muted);
            flex-wrap: wrap;
            gap: 0.6rem;
        }

        .pagination-wrapper .pagination {
            display: flex;
            gap: 3px;
            margin: 0;
            padding: 0;
            list-style: none;
            flex-wrap: wrap;
            justify-content: center;
        }

        .pagination-wrapper .page-item {
            display: inline-block;
        }

        .pagination-wrapper .page-link,
        .pagination-wrapper .page-item span {
            padding: 5px 10px;
            border-radius: 6px;
            border: 1px solid var(--sb-border);
            color: var(--sb-text);
            text-decoration: none;
            font-weight: 500;
            transition: var(--sb-transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            min-height: 32px;
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

        .pagination-wrapper .disabled .page-link,
        .pagination-wrapper .page-item.disabled span {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Empty State */
        .citas-table td[colspan] {
            text-align: center !important;
            padding: 2.5rem 1rem !important;
            color: var(--sb-muted) !important;
            font-size: 0.9rem !important;
        }

        .citas-table td[colspan] p {
            margin: 0.25rem 0;
            font-size: 0.95rem;
        }

        .citas-table td[colspan] p:first-child {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--sb-text);
            margin-bottom: 0.5rem;
        }

        /* ================= RESPONSIVE BREAKPOINTS ================= */
        @media (max-width: 1024px) {
            .citas-index {
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

            .filter-group input,
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

            .citas-table {
                min-width: 600px;
                font-size: 0.82rem;
            }

            .citas-table th,
            .citas-table td {
                padding: 0.75rem 0.9rem;
            }

            .person-avatar {
                width: 32px;
                height: 32px;
            }

            .pagination-wrapper {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 0.5rem;
                padding: 0.75rem;
            }
        }

        @media (max-width: 768px) {
            .citas-index {
                padding: 0.6rem;
            }

            .page-header {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 0.5rem !important;
                margin-bottom: 1.2rem !important;
                padding-bottom: 0.7rem !important;
            }

            .page-header h1 {
                font-size: 1.2rem !important;
            }

            .page-header p {
                font-size: 0.85rem !important;
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

            .filter-group input,
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

            .table-wrapper {
                margin: 0 -0.6rem;
                padding: 0 0.6rem;
                border-radius: 10px;
            }

            .citas-table {
                min-width: 550px;
                font-size: 0.78rem;
            }

            .citas-table th,
            .citas-table td {
                padding: 0.7rem 0.85rem;
            }

            .person-cell {
                gap: 8px;
                min-width: 130px;
            }

            .person-avatar {
                width: 30px;
                height: 30px;
            }

            .person-name {
                font-size: 0.8rem;
                max-width: 100px;
            }

            .badge {
                padding: 2px 6px;
                font-size: 0.6rem;
                min-width: 64px;
            }

            .actions-cell {
                gap: 4px;
                justify-content: center;
            }

            .btn-view {
                padding: 0.45rem 0.8rem;
                font-size: 0.78rem;
            }

            .pagination-wrapper {
                margin: 0 -0.6rem;
                padding: 0.8rem 0.6rem;
            }

            .pagination-wrapper .page-link,
            .pagination-wrapper .page-item span {
                padding: 4px 9px;
                font-size: 0.75rem;
                min-width: 30px;
                min-height: 30px;
            }
        }

        @media (max-width: 480px) {
            .citas-index {
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

            .filter-group input,
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

            .table-wrapper {
                margin: 0 -0.4rem;
                padding: 0 0.4rem;
            }

            .citas-table {
                min-width: 480px;
                font-size: 0.75rem;
            }

            .citas-table th,
            .citas-table td {
                padding: 0.65rem 0.75rem;
            }

            .person-avatar {
                width: 28px;
                height: 28px;
            }

            .person-name {
                font-size: 0.75rem;
                max-width: 90px;
            }

            .badge {
                padding: 2px 5px;
                font-size: 0.58rem;
                min-width: 60px;
            }

            .btn-view {
                padding: 0.4rem 0.7rem;
                font-size: 0.75rem;
            }

            .pagination-wrapper {
                margin: 0 -0.4rem;
                padding: 0.7rem 0.4rem;
            }

            .pagination-wrapper .page-link,
            .pagination-wrapper .page-item span {
                padding: 4px 8px;
                font-size: 0.72rem;
                min-width: 28px;
                min-height: 28px;
            }
        }

        @media (hover: none) and (pointer: coarse) {

            .btn-apply,
            .btn-reset,
            .btn-view,
            .filter-group input,
            .filter-group select {
                min-height: 44px !important;
                min-width: 44px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
            }

            input,
            select {
                font-size: 16px !important;
            }

            .btn-view:hover {
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

            input,
            select,
            textarea,
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

    <div class="citas-index">
        <!-- HEADER -->
        <header class="page-header">
            <div>
                <h1>📅 Gestión de Citas</h1>
                <p>Consulta y seguimiento de todas las citas agendadas en el sistema</p>
            </div>
        </header>

        <!-- FILTROS -->
        <section class="filters-section">
            <form class="filters-form" method="GET" action="{{ route('admin.citas.index') }}">
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
                        <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente
                        </option>
                        <option value="confirmada" {{ request('estado') == 'confirmada' ? 'selected' : '' }}>Confirmada
                        </option>
                        <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada
                        </option>
                        <option value="finalizada" {{ request('estado') == 'finalizada' ? 'selected' : '' }}>Finalizada
                        </option>
                    </select>
                </div>
                <div class="filter-group">
                    <input type="date" name="fecha" value="{{ request('fecha') }}">
                </div>
                <button type="submit" class="btn-apply">Filtrar</button>
                <a href="{{ route('admin.citas.index') }}" class="btn-reset">Limpiar</a>
            </form>
        </section>

        <!-- TABLA -->
        <section class="table-wrapper">
            <table class="citas-table">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Barbero</th>
                        <th>Servicio</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($citas ?? [] as $cita)
                        <tr>
                            <td>
                                <div class="person-cell">
                                    <div class="person-avatar">{{ substr($cita->cliente->nombre ?? 'C', 0, 1) }}</div>
                                    <span class="person-name">{{ $cita->cliente->nombre ?? 'Desconocido' }}
                                        {{ $cita->cliente->apellido ?? '' }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="person-cell">
                                    <div class="person-avatar">{{ substr($cita->barbero->nombre ?? 'B', 0, 1) }}</div>
                                    <span class="person-name">{{ $cita->barbero->nombre ?? 'Sin asignar' }}
                                        {{ $cita->barbero->apellido ?? '' }}</span>
                                </div>
                            </td>
                            <td><span class="servicio-tag">{{ $cita->servicio->nombre ?? '—' }}</span></td>
                            <td>
                                <div class="fecha-hora">
                                    <span class="fecha">{{ \Carbon\Carbon::parse($cita->fecha)->format('d M Y') }}</span>
                                </div>
                            </td>
                            <td><span class="hora">{{ $cita->hora }}</span></td>
                            <td>
                                <span class="badge badge-{{ $cita->estado }}">{{ ucfirst($cita->estado) }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.citas.show', $cita->id) }}" class="btn-view">👁️ Ver detalles</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <p>📅 No hay citas registradas</p>
                                <p style="font-size:0.85rem">Ajusta los filtros o espera nuevas reservas.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>

        <!-- PAGINACIÓN -->
        <div class="pagination-wrapper">
            {{ $citas->withQueryString()->links() ?? '' }}
        </div>
    </div>
@endsection
