@extends('layouts.barbero')
@section('title', 'Mis Ventas')
@section('BarberoContenido')
    <style>
        /* ================= VARIABLES & THEME ================= */
        :root {
            --bg: #0f172a;
            --sidebar: #111827;
            --card: #1e293b;
            --card-glass: rgba(30, 41, 59, 0.85);
            --hover: rgba(245, 220, 91, 0.08);
            --border: rgba(255, 255, 255, 0.08);
            --text: #f8fafc;
            --text-sec: #94a3b8;
            --muted: #64748b;
            --gold: #f5dc5b;
            --gold-hover: #e6c94a;
            --success: #22c55e;
            --info: #3b82f6;
            --warning: #eab308;
            --danger: #ef4444;
            --purple: #9333ea;
            --radius: 16px;
            --sm: 10px;
            --tr: all .3s cubic-bezier(.4, 0, .2, 1);
            --font: 'Plus Jakarta Sans', system-ui, sans-serif
        }

        [data-theme="light"] {
            --bg: #f8fafc;
            --sidebar: #ffffff;
            --card: #ffffff;
            --card-glass: rgba(255, 255, 255, 0.9);
            --hover: rgba(245, 220, 91, 0.12);
            --border: #e2e8f0;
            --text: #111827;
            --text-sec: #475569;
            --muted: #64748b;
            --gold: #b89600;
            --gold-hover: #a38500
        }

        /* ================= BASE ================= */
        .ventas-module {
            font-family: var(--font);
            color: var(--text);
            padding: 1.5rem;
            max-width: 1400px;
            margin: 0 auto;
            opacity: 0;
            animation: fadeIn .4s ease forwards
        }

        .ventas-module * {
            box-sizing: border-box
        }

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

        .module-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border)
        }

        .module-header h1 {
            font-size: clamp(1.5rem, 2.5vw, 2rem);
            font-weight: 800;
            margin: 0
        }

        .module-header p {
            color: var(--text-sec);
            font-size: .95rem;
            margin: .25rem 0 0
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem
        }

        .stat-card {
            background: var(--card-glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.25rem;
            transition: var(--tr);
            position: relative;
            overflow: hidden
        }

        .stat-card:hover {
            transform: translateY(-2px);
            border-color: var(--gold)
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--gold)
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            background: var(--hover);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            margin-bottom: .75rem
        }

        .stat-label {
            font-size: .75rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            font-weight: 600
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text)
        }

        .filters-bar {
            display: flex;
            flex-wrap: wrap;
            gap: .75rem;
            background: var(--card-glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1rem;
            margin-bottom: 1.5rem
        }

        .flt-group {
            flex: 1;
            min-width: 160px
        }

        .flt-select {
            width: 100%;
            padding: .75rem 1rem;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: var(--sm);
            color: var(--text);
            font-size: .9rem;
            transition: var(--tr);
            appearance: none;
            min-height: 44px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 14px
        }

        .flt-select:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(245, 220, 91, .15)
        }

        .flt-btn {
            background: var(--gold);
            color: #000;
            padding: .75rem 1.2rem;
            border-radius: var(--sm);
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: var(--tr);
            min-height: 44px
        }

        .flt-btn:hover {
            background: var(--gold-hover)
        }

        .table-wrap {
            background: var(--card-glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .3)
        }

        .table-scroll {
            overflow-x: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--border) transparent
        }

        .table-scroll::-webkit-scrollbar {
            height: 4px
        }

        .table-scroll::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 10px
        }

        .premium-table {
            width: 100%;
            border-collapse: collapse;
            font-size: .9rem;
            min-width: 750px
        }

        .premium-table th {
            text-align: left;
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: var(--muted);
            border-bottom: 1px solid var(--border);
            font-size: .72rem;
            text-transform: uppercase;
            letter-spacing: .4px;
            background: rgba(255, 255, 255, .02)
        }

        .premium-table td {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border);
            transition: var(--tr);
            vertical-align: middle
        }

        .premium-table tbody tr:hover {
            background: var(--hover)
        }

        .premium-table tbody tr:last-child td {
            border-bottom: none
        }

        .client-cell {
            display: flex;
            align-items: center;
            gap: 10px
        }

         .client-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--hover);
            color: var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: .75rem;
            flex-shrink: 0;
            overflow: hidden; /* ✅ IMPORTANTE: para que la imagen no se salga */
            border: 2px solid var(--gold) /* ✅ Borde dorado para consistencia */
        }

        .client-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* ✅ La imagen cubre el círculo sin deformarse */
            display: block;
            border-radius: 50%;
        }

        .client-avatar img:hover {
            filter: brightness(0.9);
        }

        .client-name {
            font-weight: 600
        }

        .badge {
            display: inline-flex;
            padding: .3rem .7rem;
            border-radius: 50px;
            font-size: .7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .3px;
            align-items: center;
            gap: 4px
        }

        .state-pagado {
            background: rgba(34, 197, 94, .15);
            color: var(--success);
            border: 1px solid rgba(34, 197, 94, .3)
        }

        .state-pendiente {
            background: rgba(234, 179, 8, .15);
            color: var(--warning);
            border: 1px solid rgba(234, 179, 8, .3)
        }

        .state-anulado {
            background: rgba(239, 68, 68, .15);
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, .3)
        }

        .method-pill {
            padding: .25rem .6rem;
            border-radius: 6px;
            font-size: .75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px
        }

        .method-efectivo {
            background: rgba(34, 197, 94, .1);
            color: var(--success)
        }

        .method-yape {
            background: rgba(147, 51, 234, .15);
            color: #a855f7
        }

        .method-plin {
            background: rgba(59, 130, 246, .15);
            color: var(--info)
        }

        .method-tarjeta {
            background: rgba(234, 179, 8, .15);
            color: var(--warning)
        }

        .total-val {
            font-weight: 800;
            color: var(--gold);
            font-size: 1rem
        }

        .action-cell {
            display: flex;
            gap: .5rem;
            justify-content: flex-end
        }

        .action-btn {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: transparent;
            color: var(--text-sec);
            cursor: pointer;
            transition: var(--tr);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none
        }

        .action-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: var(--hover)
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: .5rem;
            padding: 1.5rem 1rem
        }

        .page-link {
            padding: .5rem .9rem;
            border-radius: 8px;
            border: 1px solid var(--border);
            color: var(--text-sec);
            text-decoration: none;
            transition: var(--tr)
        }

        .page-link:hover {
            border-color: var(--gold);
            color: var(--gold)
        }

        .page-link.active {
            background: var(--gold);
            color: #000;
            border-color: var(--gold)
        }

        .empty-state {
            text-align: center;
            padding: 4rem 1rem
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--gold);
            opacity: .4;
            margin-bottom: 1rem
        }

        @media(max-width:768px) {
            .ventas-module {
                padding: 1rem
            }

            .module-header {
                flex-direction: column;
                align-items: stretch
            }

            .filters-bar {
                flex-direction: column
            }

            .flt-group {
                min-width: 100%
            }

            .stats-row {
                grid-template-columns: 1fr
            }

            .premium-table {
                min-width: 650px
            }
        }

        @media(hover:none) and (pointer:coarse) {

            .flt-select,
            .flt-btn,
            .action-btn {
                min-height: 44px
            }

            select,
            input {
                font-size: 16px !important
            }
        }
    </style>

    <div class="ventas-module">
        <header class="module-header">
            <div>
                <h1>💰 Mis Ventas</h1>
                <p>Historial de ingresos generados automáticamente al finalizar citas</p>
            </div>
        </header>

        <section class="stats-row">
            <article class="stat-card">
                <div class="stat-icon"><i data-lucide="banknote"></i></div>
                <div class="stat-label">Total Generado</div>
                <div class="stat-value">S/ {{ number_format($totalVentas ?? 0, 2) }}</div>
            </article>
            <article class="stat-card">
                <div class="stat-icon" style="color:var(--success);background:rgba(34,197,94,.1)"><i
                        data-lucide="check-circle"></i></div>
                <div class="stat-label">Pagadas</div>
                <div class="stat-value">{{ $ventasPagadas ?? 0 }}</div>
            </article>
            <article class="stat-card">
                <div class="stat-icon" style="color:var(--warning);background:rgba(234,179,8,.1)"><i
                        data-lucide="clock"></i></div>
                <div class="stat-label">Pendientes</div>
                <div class="stat-value">{{ $ventasPendientes ?? 0 }}</div>
            </article>
            <article class="stat-card">
                <div class="stat-icon" style="color:var(--danger);background:rgba(239,68,68,.1)"><i
                        data-lucide="x-circle"></i></div>
                <div class="stat-label">Anuladas</div>
                <div class="stat-value">{{ $ventasAnuladas ?? 0 }}</div>
            </article>
        </section>

        <form class="filters-bar" method="GET" action="{{ route('barbero.ventas.index') }}">
            <div class="flt-group"><select name="estado_pago" class="flt-select">
                    <option value="">Todos los estados</option>
                    <option value="pagado" {{ request('estado_pago') == 'pagado' ? 'selected' : '' }}>✅ Pagado</option>
                    <option value="pendiente" {{ request('estado_pago') == 'pendiente' ? 'selected' : '' }}>⏳ Pendiente
                    </option>
                    <option value="anulado" {{ request('estado_pago') == 'anulado' ? 'selected' : '' }}>❌ Anulado</option>
                </select></div>
            <div class="flt-group"><select name="metodo_pago" class="flt-select">
                    <option value="">Todos los métodos</option>
                    <option value="efectivo" {{ request('metodo_pago') == 'efectivo' ? 'selected' : '' }}>💵 Efectivo
                    </option>
                    <option value="yape" {{ request('metodo_pago') == 'yape' ? 'selected' : '' }}>🟣 Yape</option>
                    <option value="plin" {{ request('metodo_pago') == 'plin' ? 'selected' : '' }}>🔵 Plin</option>
                    <option value="tarjeta" {{ request('metodo_pago') == 'tarjeta' ? 'selected' : '' }}>💳 Tarjeta</option>
                </select></div>
            <button type="submit" class="flt-btn">Aplicar Filtros</button>
        </form>

        <div class="table-wrap">
            <div class="table-scroll">
                <table class="premium-table">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Servicio</th>
                            <th>Método</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ventas ?? [] as $venta)
                            <tr>
                                <td>
                                    <div class="client-cell">
                                        <!-- ✅ AVATAR CORREGIDO - SIMPLE Y SEGURO -->
                                        <div class="client-avatar">
                                            @if ($venta->cliente && $venta->cliente->foto)
                                                <img src="{{ asset('storage/' . $venta->cliente->foto) }}" 
                                                     alt="{{ $venta->cliente->nombre ?? 'Cliente' }}"
                                                     onerror="this.style.display='none'; this.parentElement.textContent='{{ substr($venta->cliente->nombre ?? 'C', 0, 1) }}'">
                                            @else
                                                {{ substr($venta->cliente->nombre ?? 'C', 0, 1) }}
                                            @endif
                                        </div>
                                        <span class="client-name">{{ $venta->cliente->nombre ?? 'Desconocido' }}</span>
                                    </div>
                                </td>
                                <td>{{ $venta->cita->servicio->nombre ?? 'Sin servicio' }}</td>
                                <td><span
                                        class="method-pill method-{{ $venta->metodo_pago }}">{{ ucfirst($venta->metodo_pago) }}</span>
                                </td>
                                <td><span class="total-val">S/ {{ number_format($venta->total, 2) }}</span></td>
                                <td><span
                                        class="badge state-{{ $venta->estado_pago }}">{{ ucfirst($venta->estado_pago) }}</span>
                                </td>
                                <td>{{ $venta->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="action-cell"><a href="{{ route('barbero.ventas.show', $venta->id) }}"
                                            class="action-btn" title="Ver detalle"><i data-lucide="eye"
                                                style="width:16px"></i></a><a
                                            href="{{ route('barbero.ventas.edit', $venta->id) }}" class="action-btn"
                                            title="Editar venta"><i data-lucide="pencil" style="width:16px"></i></a></div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state"><i data-lucide="receipt"></i>
                                        <h3>No hay ventas registradas</h3>
                                        <p style="color:var(--muted)">Las ventas aparecerán automáticamente cuando se
                                            finalicen citas</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if (isset($ventas) && $ventas->hasPages())
            <div class="pagination">{{ $ventas->withQueryString()->links() }}</div>
        @endif
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons()
        })
    </script>
@endsection