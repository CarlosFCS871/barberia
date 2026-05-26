@extends('layouts.barbero')
@section('title', 'Dashboard Barbero')

@section('BarberoContenido')

<style>
    /* ================= RESPONSIVE FIX - CSS PLANO (NO ANIDADO) ================= */
    
    /* TABLETS (≤1024px) */
    @media (max-width: 1024px) {
        .dashboard-grid {
            grid-template-columns: 1fr !important;
        }
        .main-column,
        .side-column {
            width: 100% !important;
        }
        .card-header {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 0.6rem !important;
        }
        .stats-grid {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }

    /* MÓVILES (≤768px) */
    @media (max-width: 768px) {
        .content-wrapper {
            padding: 1rem !important;
        }
        .page-title {
            font-size: 1.5rem !important;
            line-height: 1.2 !important;
        }
        .page-subtitle {
            font-size: 0.9rem !important;
        }
        /* Stats */
        .stats-grid {
            grid-template-columns: 1fr !important;
        }
        .stat-card {
            padding: 1rem !important;
        }
        .stat-value {
            font-size: 1.3rem !important;
        }
        /* Tablas */
        .table-wrapper {
            overflow-x: auto !important;
            width: 100% !important;
            border-radius: 12px !important;
            -webkit-overflow-scrolling: touch !important;
        }
        .data-table {
            min-width: 550px !important;
        }
        .data-table th,
        .data-table td {
            padding: 0.85rem 1rem !important;
            font-size: 0.85rem !important;
        }
        /* Cards */
        .card {
            padding: 1rem !important;
        }
        .card-header {
            flex-direction: column !important;
            align-items: flex-start !important;
        }
        /* Promos */
        .promo-card {
            flex-direction: row !important;
            align-items: center !important;
        }
        .promo-content {
            width: 100% !important;
        }
        .promo-name {
            white-space: normal !important;
        }
        /* Horarios */
        .schedule-card {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 0.7rem !important;
        }
        /* Badges */
        .badge {
            font-size: 0.65rem !important;
            padding: 3px 8px !important;
        }
    }

    /* MÓVILES PEQUEÑOS (≤480px) */
    @media (max-width: 480px) {
        .content-wrapper {
            padding: 0.8rem !important;
        }
        .page-title {
            font-size: 1.25rem !important;
        }
        .card-title {
            font-size: 0.95rem !important;
        }
        .card {
            padding: 0.9rem !important;
        }
        /* Stat Card */
        .stat-card {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 0.6rem !important;
        }
        .stat-card .stat-trend {
            margin-left: 0 !important;
            margin-top: 0.3rem !important;
        }
        /* Promos */
        .promo-card {
            flex-direction: column !important;
            text-align: center !important;
        }
        .promo-img {
            margin: 0 auto 0.5rem !important;
        }
        /* Tablas */
        .data-table {
            min-width: 480px !important;
        }
        .data-table th,
        .data-table td {
            padding: 0.7rem 0.85rem !important;
            font-size: 0.75rem !important;
        }
        /* Botones de acción */
        .btn-action {
            width: 30px !important;
            height: 30px !important;
            min-width: 30px !important;
            font-size: 0.8rem !important;
        }
    }

    /* ================= TOUCH OPTIMIZATIONS ================= */
    @media (hover: none) and (pointer: coarse) {
        .btn-action,
        .nav-item,
        .icon-btn {
            min-height: 44px !important;
            min-width: 44px !important;
        }
        .stat-card:hover,
        .card:hover,
        .promo-card:hover,
        .schedule-card:hover {
            transform: none !important;
            transition: none !important;
        }
    }

    /* ================= REDUCE MOTION ================= */
    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>

<!-- CONTENT WRAPPER -->
<div class="content-wrapper">
    <h1 class="page-title">Dashboard Barber</h1>
    <p class="page-subtitle">Resumen de tu actividad y gestión diaria</p>

    <!-- STATS CARDS -->
    <section class="stats-grid">
        <article class="stat-card animate-fade">
            <div class="stat-icon"><i data-lucide="calendar-check"></i></div>
            <span class="stat-label">Total Citas</span>
            <span class="stat-value">{{ $totalCitas }}</span>
            <span class="stat-trend up"><i data-lucide="trending-up" style="width:12px"></i> +12%</span>
        </article>
        <article class="stat-card animate-fade">
            <div class="stat-icon"><i data-lucide="calendar-day"></i></div>
            <span class="stat-label">Citas Hoy</span>
            <span class="stat-value">{{ $citasHoy }}</span>
            <span class="stat-trend neutral">Estable</span>
        </article>
        <article class="stat-card animate-fade">
            <div class="stat-icon"><i data-lucide="credit-card"></i></div>
            <span class="stat-label">Ventas Hoy</span>
            <span class="stat-value">S/ {{ number_format($ventasHoy, 2) }}</span>
            <span class="stat-trend up"><i data-lucide="trending-up" style="width:12px"></i> +8%</span>
        </article>
        <article class="stat-card animate-fade">
            <div class="stat-icon"><i data-lucide="dollar-sign"></i></div>
            <span class="stat-label">Ingresos Totales</span>
            <span class="stat-value">S/ {{ number_format($ingresosTotales, 2) }}</span>
            <span class="stat-trend up"><i data-lucide="trending-up" style="width:12px"></i> +22%</span>
        </article>
        <article class="stat-card animate-fade">
            <div class="stat-icon"><i data-lucide="scissors"></i></div>
            <span class="stat-label">Servicios Activos</span>
            <span class="stat-value">{{ $serviciosActivos }}</span>
            <span class="stat-trend neutral">Estable</span>
        </article>
        <article class="stat-card animate-fade">
            <div class="stat-icon"><i data-lucide="badge-percent"></i></div>
            <span class="stat-label">Promociones</span>
            <span class="stat-value">{{ $promocionesActivas }}</span>
            <span class="stat-trend up"><i data-lucide="trending-up" style="width:12px"></i> +1</span>
        </article>
    </section>

    <!-- DASHBOARD GRID -->
    <div class="dashboard-grid">
        <div class="main-column">
            <!-- ÚLTIMAS CITAS -->
            <div class="card animate-slide">
                <div class="card-header">
                    <h3 class="card-title"><i data-lucide="calendar" style="width:18px"></i> Últimas Citas</h3>
                    <a href="#" style="font-size:0.8rem;color:var(--accent);font-weight:600;">Ver todas →</a>
                </div>
                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Servicio</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Estado</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ultimasCitas as $cita)
                            <tr>
                                <td><strong>{{ $cita->cliente->nombre ?? 'Cliente' }}</strong></td>
                                <td>{{ $cita->servicio->nombre ?? 'Servicio' }}</td>
                                <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d M') }}</td>
                                <td>{{ $cita->hora }}</td>
                                <td><span class="badge badge-{{ $cita->estado }}">{{ ucfirst($cita->estado) }}</span></td>
                            
                            </tr>
                            @empty
                            <tr><td colspan="6">No hay citas registradas</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ÚLTIMAS VENTAS -->
            <div class="card animate-slide">
                <div class="card-header">
                    <h3 class="card-title"><i data-lucide="credit-card" style="width:18px"></i> Últimas Ventas</h3>
                    <a href="#" style="font-size:0.8rem;color:var(--accent);font-weight:600;">Ver todas →</a>
                </div>
                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Servicio</th>
                                <th>Método</th>
                                <th>Total</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ultimasVentas as $venta)
                            <tr>
                                <td><strong>{{ $venta->cliente->nombre ?? 'Cliente' }}</strong></td>
                                <td>{{ $venta->cita->servicio->nombre ?? 'Servicio' }}</td>
                                <td><span class="badge">{{ ucfirst($venta->metodo_pago) }}</span></td>
                                <td><strong style="color:var(--accent)">S/ {{ number_format($venta->total, 2) }}</strong></td>
                                <td>{{ $venta->created_at->format('d M') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="5">No hay ventas registradas</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="side-column">
            <!-- HORARIOS DE HOY -->
            <div class="card animate-slide">
                <div class="card-header">
                    <h3 class="card-title"><i data-lucide="clock" style="width:18px"></i> Horarios de Hoy</h3>
                </div>
                <div style="display:flex;flex-direction:column;gap:0.75rem">
                    @forelse ($horariosHoy as $horario)
                    <div class="schedule-card">
                        <div>
                            <div class="schedule-time">{{ $horario->hora }}</div>
                            <div class="schedule-range">
                                {{ $horario->servicio->nombre ?? 'Servicio' }} • {{ $horario->cliente->nombre ?? 'Cliente' }}
                            </div>
                        </div>
                        <span class="badge badge-{{ $horario->estado }}">{{ ucfirst($horario->estado) }}</span>
                    </div>
                    @empty
                    <p>No hay horarios hoy</p>
                    @endforelse
                </div>
            </div>

            <!-- PROMOCIONES ACTIVAS -->
            <div class="card animate-slide">
                <div class="card-header">
                    <h3 class="card-title"><i data-lucide="badge-percent" style="width:18px"></i> Promociones Activas</h3>
                </div>
                <div style="display:flex;flex-direction:column;gap:0.85rem">
                    @forelse ($promociones as $promo)
                    <div class="promo-card">
                        <div class="promo-img">
                            @if ($promo->imagen)
                                <img src="{{ asset('storage/' . $promo->imagen) }}" style="width:50px;height:50px;object-fit:cover;border-radius:10px;">
                            @else
                                🎁
                            @endif
                        </div>
                        <div class="promo-content">
                            <div class="promo-name">{{ $promo->nombre }}</div>
                            <div class="promo-discount">-{{ $promo->descuento }}%</div>
                            <div class="promo-date">Vence: {{ \Carbon\Carbon::parse($promo->fecha_fin)->format('d M') }}</div>
                        </div>
                    </div>
                    @empty
                    <p>No hay promociones activas</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@endsection