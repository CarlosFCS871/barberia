@extends('layouts.admin')
@section('title', 'Gestión de Ventas')
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
            --sb-blue: #3b82f6;
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
            --sb-blue: #2563eb;
        }

        /* ================= BASE ================= */
        .ventas-index {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: var(--sb-text);
            padding: 1rem;
            width: 100%;
            max-width: 100vw;
            overflow-x: hidden;
            box-sizing: border-box;
        }

        .ventas-index *,
        .ventas-index *::before,
        .ventas-index *::after {
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

        /* ================= TOTAL SALES CARD ================= */
        .total-card {
            background: linear-gradient(135deg, var(--sb-accent), var(--sb-accent-hover));
            color: #000;
            border-radius: var(--sb-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            box-shadow: 0 8px 24px rgba(245, 220, 91, 0.2);
        }

        .total-card .label {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.8;
        }

        .total-card .amount {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .total-card .meta {
            font-size: 0.8rem;
            opacity: 0.9;
        }

        /* ================= FILTERS ================= */
        .filters-section {
            margin-bottom: 1.25rem;
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
        .ventas-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
            min-width: 680px;
        }

        .ventas-table th {
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

        .ventas-table td {
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--sb-border);
            vertical-align: middle;
            white-space: nowrap;
            transition: var(--sb-transition);
        }

        .ventas-table tbody tr:hover {
            background: var(--sb-accent-soft);
        }

        .ventas-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Person & Amount */
        .person-cell {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 120px;
        }

        .person-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--sb-accent-soft);
            color: var(--sb-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.7rem;
            flex-shrink: 0;
        }

        .person-name {
            font-weight: 600;
            font-size: 0.88rem;
        }

        .total-amount {
            font-weight: 800;
            color: var(--sb-accent);
            font-size: 0.95rem;
            letter-spacing: -0.3px;
        }

        /* Badges */
        .badge {
            padding: 3px 8px;
            border-radius: 50px;
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 70px;
            text-align: center;
        }

        .badge-pagado {
            background: rgba(34, 197, 94, 0.15);
            color: var(--sb-green);
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .badge-pendiente {
            background: rgba(234, 179, 8, 0.15);
            color: var(--sb-yellow);
            border: 1px solid rgba(234, 179, 8, 0.3);
        }

        .badge-anulado {
            background: rgba(239, 68, 68, 0.15);
            color: var(--sb-red);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .method-tag {
            padding: 3px 8px;
            border-radius: 6px;
            background: var(--sb-bg);
            border: 1px solid var(--sb-border);
            color: var(--sb-text);
            font-size: 0.72rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .method-efectivo::before {
            content: '💵';
        }

        .method-yape::before {
            content: '📱';
            color: #6b21a8;
        }

        .method-plin::before {
            content: '📲';
            color: #2563eb;
        }

        .method-tarjeta::before {
            content: '💳';
            color: var(--sb-blue);
        }

        /* Actions */
        .btn-view {
            padding: 0.5rem 0.9rem;
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
        .ventas-table td[colspan] {
            text-align: center !important;
            padding: 2.5rem 1rem !important;
            color: var(--sb-muted) !important;
            font-size: 0.9rem !important;
        }

        .ventas-table td[colspan] p {
            margin: 0.25rem 0;
        }

        .ventas-table td[colspan] p:first-child {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--sb-text);
            margin-bottom: 0.5rem;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 1024px) {
            .ventas-index {
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

            .ventas-table {
                min-width: 620px;
                font-size: 0.82rem;
            }

            .ventas-table th,
            .ventas-table td {
                padding: 0.75rem 0.9rem;
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
            .ventas-index {
                padding: 0.6rem;
            }

            .page-header {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 0.5rem !important;
                margin-bottom: 1.2rem !important;
            }

            .total-card {
                flex-direction: column;
                align-items: flex-start;
                padding: 1.25rem;
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

            .table-wrapper {
                margin: 0 -0.6rem;
                padding: 0 0.6rem;
                border-radius: 10px;
            }

            .ventas-table {
                min-width: 550px;
                font-size: 0.78rem;
            }

            .ventas-table th,
            .ventas-table td {
                padding: 0.7rem 0.85rem;
            }

            .person-cell {
                gap: 6px;
                min-width: 110px;
            }

            .person-avatar {
                width: 28px;
                height: 28px;
            }

            .badge {
                padding: 2px 6px;
                font-size: 0.6rem;
                min-width: 64px;
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
            .ventas-index {
                padding: 0.4rem !important;
            }

            .page-header h1 {
                font-size: 1.1rem !important;
            }

            .page-header p {
                font-size: 0.8rem !important;
            }

            .total-card .amount {
                font-size: 1.6rem;
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

            .table-wrapper {
                margin: 0 -0.4rem;
                padding: 0 0.4rem;
            }

            .ventas-table {
                min-width: 480px;
                font-size: 0.75rem;
            }

            .ventas-table th,
            .ventas-table td {
                padding: 0.65rem 0.75rem;
            }

            .person-name {
                font-size: 0.75rem;
                max-width: 80px;
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

    <div class="ventas-index">
        <header class="page-header">
            <div>
                <h1>💰 Ventas del Sistema</h1>
                <p>Historial de cobros generados automáticamente al finalizar citas</p>
            </div>
        </header>

        <!-- TOTAL CARD -->
        <div class="total-card">
            <div>
                <div class="label">Total Recaudado</div>
                <div class="amount">S/ {{ number_format($totalVentas ?? 0, 2) }}</div>
            </div>
            <div class="meta">
                📅 {{ $citas_count ?? 0 }} transacciones registradas<br>
                🕒 Última: {{ $ultima_venta?->format('d M Y') ?? 'N/A' }}
            </div>
        </div>

        <!-- FILTROS -->
        <section class="filters-section">
            <form class="filters-form" method="GET" action="{{ route('admin.ventas.index') }}">
                <div class="filter-group">
                    <select name="metodo_pago">
                        <option value="">Todos los métodos</option>
                        <option value="efectivo" {{ request('metodo_pago') == 'efectivo' ? 'selected' : '' }}>💵 Efectivo
                        </option>
                        <option value="yape" {{ request('metodo_pago') == 'yape' ? 'selected' : '' }}>📱 Yape</option>
                        <option value="plin" {{ request('metodo_pago') == 'plin' ? 'selected' : '' }}>📲 Plin</option>
                        <option value="tarjeta" {{ request('metodo_pago') == 'tarjeta' ? 'selected' : '' }}>💳 Tarjeta
                        </option>
                    </select>
                </div>
                <div class="filter-group">
                    <select name="estado_pago">
                        <option value="">Todos los estados</option>
                        <option value="pagado" {{ request('estado_pago') == 'pagado' ? 'selected' : '' }}>✅ Pagado</option>
                        <option value="pendiente" {{ request('estado_pago') == 'pendiente' ? 'selected' : '' }}>⏳ Pendiente
                        </option>
                        <option value="anulado" {{ request('estado_pago') == 'anulado' ? 'selected' : '' }}>❌ Anulado
                        </option>
                    </select>
                </div>
                <button type="submit" class="btn-apply">Filtrar</button>
                <a href="{{ route('admin.ventas.index') }}" class="btn-reset">Limpiar</a>
            </form>
        </section>

        <!-- TABLA -->
        <section class="table-wrapper">
            <table class="ventas-table">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Cliente</th>
                        <th>Barbero</th>
                        <th>Total</th>
                        <th>Método</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ventas ?? [] as $venta)
                        <tr>
                            <td><strong>#{{ str_pad($venta->id, 4, '0', STR_PAD_LEFT) }}</strong></td>
                            <td>
                                <div class="person-cell">z
                                    <div class="person-avatar">{{ substr($venta->cliente->nombre ?? 'C', 0, 1) }}</div>
                                    <span class="person-name">{{ $venta->cliente->nombre ?? 'Desconocido' }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="person-cell">
                                    <div class="person-avatar">{{ substr($venta->barbero->nombre ?? 'B', 0, 1) }}</div>
                                    <span class="person-name">{{ $venta->barbero->nombre ?? 'Sin asignar' }}</span>
                                </div>
                            </td>
                            <td><span class="total-amount">S/ {{ number_format($venta->total, 2) }}</span></td>
                            <td><span
                                    class="method-tag method-{{ $venta->metodo_pago }}">{{ ucfirst($venta->metodo_pago) }}</span>
                            </td>
                            <td><span
                                    class="badge badge-{{ $venta->estado_pago }}">{{ ucfirst($venta->estado_pago) }}</span>
                            </td>
                            <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.ventas.show', $venta->id) }}" class="btn-view">👁️ Ver detalle</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <p>💰 No hay ventas registradas</p>
                                <p style="font-size:0.85rem">Las ventas aparecerán automáticamente al finalizar citas.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>

        <!-- PAGINACIÓN -->
        <div class="pagination-wrapper">
            {{ $ventas->withQueryString()->links() ?? '' }}
        </div>
    </div>
@endsection
