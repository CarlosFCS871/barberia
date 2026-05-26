@extends('layouts.barbero')
@section('title', 'Mis Horarios')
@section('BarberoContenido')
    <style>
        :root {
            --bg-primary: #0f172a;
            --bg-sidebar: #111827;
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

        .horarios-index {
            font-family: var(--font);
            color: var(--text-primary);
            padding: 1.5rem;
            max-width: 1400px;
            margin: 0 auto
        }

        .horarios-index *,
        .horarios-index *::before,
        .horarios-index *::after {
            box-sizing: border-box
        }

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
            margin: 0.25rem 0 0
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
            background: var(--accent-hover)
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.25rem;
            position: relative;
            transition: var(--transition)
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--accent), transparent)
        }

        .stat-card:hover {
            transform: translateY(-2px);
            border-color: var(--border-hover)
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            background: var(--bg-hover);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            margin-bottom: 0.75rem
        }

        .stat-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-primary)
        }

        .filters-form {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1rem;
            margin-bottom: 1.5rem
        }

        .filter-group {
            flex: 1;
            min-width: 160px;
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

        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 2px var(--accent-glow)
        }

        .btn-apply {
            background: var(--accent);
            color: #000;
            padding: 0.7rem 1.2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: var(--transition)
        }

        .btn-apply:hover {
            background: var(--accent-hover)
        }

        .table-container {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden
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

        .modern-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
            min-width: 600px
        }

        .modern-table th {
            text-align: left;
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.02);
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.4px
        }

        .modern-table td {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border);
            transition: var(--transition)
        }

        .modern-table tbody tr:hover {
            background: var(--bg-hover)
        }

        .modern-table tbody tr:last-child td {
            border-bottom: none
        }

        .day-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 0.35rem 0.8rem;
            border-radius: 8px;
            background: var(--bg-hover);
            color: var(--text-primary);
            font-weight: 600;
            font-size: 0.85rem
        }

        .time-chip {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 0.3rem 0.7rem;
            border-radius: 50px;
            background: var(--bg-primary);
            border: 1px solid var(--border);
            color: var(--text-secondary);
            font-size: 0.8rem;
            font-family: monospace
        }

        .status-pill {
            padding: 0.3rem 0.7rem;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase
        }

        .status-activo {
            background: rgba(34, 197, 94, 0.15);
            color: var(--success)
        }

        .status-inactivo {
            background: rgba(239, 68, 68, 0.15);
            color: var(--danger)
        }

        .action-btns {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-end
        }

        .btn-sm {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: transparent;
            color: var(--text-secondary);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center
        }

        .btn-sm:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--bg-hover)
        }

        .btn-sm.delete:hover {
            border-color: var(--danger);
            color: var(--danger)
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            padding: 1.5rem 1rem
        }

        .page-link {
            padding: 0.5rem 0.9rem;
            border-radius: 8px;
            border: 1px solid var(--border);
            color: var(--text-secondary);
            text-decoration: none;
            transition: var(--transition)
        }

        .page-link:hover {
            border-color: var(--accent);
            color: var(--accent)
        }

        .page-link.active {
            background: var(--accent);
            color: #000;
            border-color: var(--accent)
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            grid-column: 1/-1
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--accent);
            opacity: 0.5;
            margin-bottom: 1rem
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .stat-card,
        .modern-table tbody tr,
        .empty-state {
            animation: fadeIn 0.4s ease forwards;
            opacity: 0
        }

        .stat-card:nth-child(1) {
            animation-delay: 0.1s
        }

        .stat-card:nth-child(2) {
            animation-delay: 0.2s
        }

        .stat-card:nth-child(3) {
            animation-delay: 0.3s
        }

        @media(max-width:768px) {
            .horarios-index {
                padding: 1rem
            }

            .page-header {
                flex-direction: column;
                align-items: stretch
            }

            .btn-create {
                width: 100%;
                justify-content: center
            }

            .filters-form {
                flex-direction: column
            }

            .filter-group {
                min-width: 100%
            }

            .stats-grid {
                grid-template-columns: 1fr
            }

            .modern-table {
                min-width: 500px
            }
        }

        @media(hover:none) and (pointer:coarse) {

            .btn-create,
            .btn-apply,
            .btn-sm {
                min-height: 44px
            }

            select,
            input {
                font-size: 16px !important
            }
        }
    </style>

    <div class="horarios-index">
        <header class="page-header">
            <div>
                <h1>📅 Mis Horarios</h1>
                <p>Administra tus días y franjas horarias de atención</p>
            </div>
            <a href="{{ route('barbero.horarios.create') }}" class="btn-create"><i data-lucide="plus"></i> Nuevo Horario</a>
        </header>

        <section class="stats-grid">
            <article class="stat-card">
                <div class="stat-icon"><i data-lucide="check-circle"></i></div>
                <div class="stat-label">Activos</div>
                <div class="stat-value">{{ $activos}}</div>
            </article>
            <article class="stat-card">
                <div class="stat-icon"><i data-lucide="x-circle"></i></div>
                <div class="stat-label">Inactivos</div>
                <div class="stat-value">{{ $inactivos}}</div>
            </article>
            <article class="stat-card">
                <div class="stat-icon"><i data-lucide="calendar"></i></div>
                <div class="stat-label">Total</div>
                <div class="stat-value">{{ $totalHorarios}}</div>
            </article>
        </section>

        <form class="filters-form" method="GET" action="{{ route('barbero.horarios.index') }}">
            <div class="filter-group"><select name="dia">
                    <option value="">Todos los días</option>
                    <option value="lunes">Lunes</option>
                    <option value="martes">Martes</option>
                    <option value="miercoles">Miércoles</option>
                    <option value="jueves">Jueves</option>
                    <option value="viernes">Viernes</option>
                    <option value="sabado">Sábado</option>
                    <option value="domingo">Domingo</option>
                </select></div>
            <div class="filter-group"><select name="estado">
                    <option value="">Todos los estados</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select></div>
            <button type="submit" class="btn-apply">Aplicar Filtros</button>
        </form>

        <div class="table-container">
            <div class="table-scroll">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Día</th>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                            <th>Estado</th>
                            <th>Fecha Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($horarios ?? [] as $horario)
                            <tr>
                                <td><span class="day-badge"><i data-lucide="calendar-days"></i>
                                        {{ ucfirst($horario->dia) }}</span></td>
                                <td><span class="time-chip"><i data-lucide="sunrise" style="width:12px"></i>
                                        {{ $horario->hora_inicio }}</span></td>
                                <td><span class="time-chip"><i data-lucide="sunset" style="width:12px"></i>
                                        {{ $horario->hora_fin }}</span></td>
                                <td><span
                                        class="status-pill status-{{ $horario->estado }}">{{ ucfirst($horario->estado) }}</span>
                                </td>
                                <td>{{ $horario->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="action-btns"><a href="{{ route('barbero.horarios.show', $horario->id) }}"
                                            class="btn-sm" title="Ver"><i data-lucide="eye" style="width:16px"></i></a><a
                                            href="{{ route('barbero.horarios.edit', $horario->id) }}" class="btn-sm"
                                            title="Editar"><i data-lucide="edit" style="width:16px"></i></a><button
                                            class="btn-sm delete" onclick="deleteHorario('{{ $horario->id }}')"
                                            title="Eliminar"><i data-lucide="trash" style="width:16px"></i></button></div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state"><i data-lucide="calendar-off"></i>
                                        <h3>No hay horarios registrados</h3>
                                        <p>Crea tu primer horario para comenzar a recibir citas</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if (isset($horarios) && $horarios->hasPages())
            <div class="pagination">{{ $horarios->withQueryString()->links() }}</div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons()
        })

        function deleteHorario(id) {
            Swal.fire({
                title: '¿Eliminar horario?',
                text: 'Esta acción no se puede deshacer',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f5dc5b',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Sí, eliminar',
                background: '#1e293b',
                color: '#f8fafc'
            }).then((res) => {
                if (res.isConfirmed) {
                    /* Aquí iría la petición DELETE */ }
            })
        }
    </script>
@endsection
