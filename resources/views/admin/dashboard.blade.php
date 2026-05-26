@extends('layouts.admin')


@section('title', 'Dashboard')


@section('AdminContenido')

    <style>
        /* =========================================
                                   DASHBOARD GRID
                                ========================================= */

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 1.5rem;
            width: 100%;
        }

        /* Cards generales */
        .dashboard-grid .card {
            min-width: 0;
            overflow: hidden;
        }

        /* Tamaños desktop */
        .chart-card {
            grid-column: span 7;
        }

        .table-card {
            grid-column: span 5;
        }

        .activity-card {
            grid-column: span 4;
        }

        .testimonial-card {
            grid-column: span 4;
        }

        .promo-card {
            grid-column: span 4;
        }

        /* =========================================
                               TABLET
                            ========================================= */

        @media (max-width: 992px) {

            .dashboard-grid {
                grid-template-columns: repeat(6, 1fr);
            }

            .chart-card,
            .table-card,
            .activity-card,
            .testimonial-card,
            .promo-card {
                grid-column: span 6;
            }
        }

        /* =========================================
                               MOBILE
                            ========================================= */

        @media (max-width: 768px) {

            .dashboard-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .chart-card,
            .table-card,
            .activity-card,
            .testimonial-card,
            .promo-card {
                grid-column: span 1;
            }

            .card {
                padding: 1rem;
            }

            /* Tablas responsive */
            .table-card {
                overflow-x: auto;
            }

            .data-table {
                min-width: 600px;
            }

            /* Charts */
            .chart-placeholder {
                height: 220px;
            }

            /* Actividad */
            .activity-list li {
                font-size: 0.9rem;
                line-height: 1.5;
            }

            /* Testimonios */
            .testimonial-item {
                padding: 1rem 0;
            }

        }

        .chart-placeholder {
            height: 300px;
            display: flex;
            align-items: flex-end;
            gap: 12px;
            padding-top: 1rem;
        }

        .chart-bar {
            flex: 1;
            border-radius: 10px 10px 0 0;
            background: linear-gradient(to top,
                    var(--accent),
                    #ffe98a);
        }

        @media (max-width:768px) {

            .chart-placeholder {
                height: 180px;
                gap: 8px;
            }
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            list-style: none;
        }

        .activity-list li {
            display: flex;
            gap: .75rem;
            align-items: flex-start;
        }

        .activity-list i {
            color: var(--accent);
            width: 18px;
            flex-shrink: 0;
        }

        .testimonial-item {
            border-bottom: 1px solid var(--border);
            padding: 1rem 0;
        }

        .testimonial-item:last-child {
            border-bottom: none;
        }

        .testimonial-text {
            color: var(--text-secondary);
            margin-bottom: .5rem;
        }

        .testimonial-author {
            font-weight: 600;
            margin-bottom: .5rem;
        }
    </style>


    <div class="content-wrapper">
        <section class="page-header">
            <h1>Panel de Administración</h1>
            <p>Resumen general del negocio Snyder Barber</p>
        </section>

        <!-- STATS -->
        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i data-lucide="users"></i></div>
                <div class="stat-info">
                    <span class="stat-value">{{ $totalClientes }}</span>
                    <span class="stat-label">Total Clientes</span>
                </div>
                <span class="stat-trend up">+12%</span>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i data-lucide="calendar-check"></i></div>
                <div class="stat-info">
                    <span class="stat-value">{{ $citasMes }}</span>
                    <span class="stat-label">Citas Este Mes</span>
                </div>
                <span class="stat-trend up">+8%</span>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i data-lucide="credit-card"></i></div>
                <div class="stat-info">
                    <span class="stat-value">S/ {{ number_format($totalVentas, 2) }}</span>
                    <span class="stat-label">Ventas Totales</span>
                </div>
                <span class="stat-trend up">+22%</span>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i data-lucide="dollar-sign"></i></div>
                <div class="stat-info">
                    <span class="stat-value">S/ {{ number_format($ingresosNetos, 2) }}</span>
                    <span class="stat-label">Ingresos Netos</span>
                </div>
                <span class="stat-trend down">-3%</span>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i data-lucide="user-check"></i></div>
                <div class="stat-info">
                    <span class="stat-value">{{ $totalBarberos }}</span>
                    <span class="stat-label">Barberos Activos</span>
                </div>
                <span class="stat-trend neutral">Estable</span>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i data-lucide="award"></i></div>
                <div class="stat-info">
                    <span class="stat-value">
                        {{ $servicioTop->nombre ?? 'Sin datos' }}
                    </span>
                    <span class="stat-label">Servicio Top</span>
                </div>
                <span class="stat-trend up">+41%</span>
            </div>
        </section>

        <!-- CHARTS & TABLES -->
        <section class="dashboard-grid">
            <div class="card chart-card">
                <h3 class="card-title">Rendimiento de Citas</h3>
                <div class="chart-placeholder">
                    <div class="chart-bar" style="height: 65%"></div>
                    <div class="chart-bar" style="height: 82%"></div>
                    <div class="chart-bar" style="height: 45%"></div>
                    <div class="chart-bar" style="height: 90%"></div>
                    <div class="chart-bar" style="height: 70%"></div>
                    <div class="chart-bar" style="height: 88%"></div>
                    <div class="chart-bar" style="height: 75%"></div>
                </div>
                <p class="chart-note">Lun - Dom • Datos semanales</p>
            </div>

            <div class="card table-card">
                <h3 class="card-title">Últimas Citas</h3>
                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Barbero</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ultimasCitas as $cita)
                                <tr>
                                    <td>{{ $cita->cliente->nombre ?? 'N/A' }}</td>
                                    <td>{{ $cita->barbero->nombre ?? 'N/A' }}</td>
                                    <td>{{ $cita->created_at->format('d/m H:i') }}</td>
                                    <td>
                                        <span class="badge">{{ $cita->estado }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="card table-card">
                    <div class="table-wrapper">
                        <h3 class="card-title">Últimas Ventas</h3>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Servicio</th>
                                    <th>Monto</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ultimasVentas as $venta)
                                    <tr>
                                        <td>Cita #{{ $venta->cita_id }}</td>
                                        <td>S/ {{ number_format($venta->total, 2) }}</td>
                                        <td>{{ $venta->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card activity-card">
                        <h3 class="card-title">Actividad Reciente</h3>


                        <ul class="activity-list">
                            @foreach ($actividad as $item)
                                <li>
                                    @if ($item instanceof \App\Models\User)
                                        <i data-lucide="plus-circle"></i>
                                        Nuevo cliente: <strong>{{ $item->nombre }}</strong>
                                    @elseif($item instanceof \App\Models\Cita)
                                        <i data-lucide="check-circle"></i>
                                        Cita finalizada: <strong>{{ $item->cliente->nombre ?? 'N/A' }}</strong>
                                    @elseif($item instanceof \App\Models\Promocion)
                                        <i data-lucide="badge-check"></i>
                                        Promoción: <strong>{{ $item->nombre }}</strong>
                                    @elseif($item instanceof \App\Models\Horario)
                                        <i data-lucide="alert-triangle"></i>
                                        Horario modificado: <strong>{{ $item->dia }}</strong>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </div>

                <div class="card testimonial-card">
                    <h3 class="card-title">Testimonios Recientes</h3>
                    @foreach ($testimonios as $t)
                        <div class="testimonial-item">
                            <div class="testimonial-text">
                                "{{ Str::limit($t->comentario, 80) }}"
                            </div>
                            <div class="testimonial-author">
                                — {{ $t->cliente->nombre ?? 'Cliente' }}
                            </div>
                            <div class="testimonial-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i data-lucide="star"
                                        style="color: {{ $i <= $t->calificacion ? '#facc15' : '#d1d5db' }};">
                                    </i>
                                @endfor
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="card promo-card">
                    <h3 class="card-title">Promociones Activas</h3>
                    @foreach ($promociones as $p)
                        <div class="promo-item">
                            <div class="promo-header">
                                <span class="promo-badge">Vigente</span>
                                <span>{{ $p->nombre }}</span>
                            </div>
                            <div class="promo-footer">
                                <span>Vence: {{ \Carbon\Carbon::parse($p->fecha_fin)->format('d M') }}</span>
                                <span>{{ $p->descuento }}% OFF</span>
                            </div>
                        </div>
                    @endforeach
                </div>
        </section>
    </div>

@endsection
