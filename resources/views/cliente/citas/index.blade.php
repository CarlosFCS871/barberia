@extends('layouts.cliente')

@section('title', 'Mis Citas')

@section('contenidoCliente')

    <style>
        :root {
            --bg: #0a0a0b;
            --card: rgba(20, 20, 22, 0.85);
            --card-solid: #161618;
            --border: rgba(245, 220, 91, 0.15);
            --border-hover: rgba(245, 220, 91, 0.4);
            --text: #f8fafc;
            --muted: #a1a1aa;
            --accent: #F5DC5B;
            --accent-hover: #e6c94a;
            --success: #22c55e;
            --warning: #eab308;
            --danger: #ef4444;
            --radius: 16px;
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .citas-container {
            padding: 1.5rem;
            color: var(--text);
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header */
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .top-header h1 {
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .top-header p {
            color: var(--muted);
            margin: 0.25rem 0 0;
            font-size: 0.95rem;
        }

        /* Buttons */
        .btn {
            padding: 0.75rem 1.25rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .btn-primary {
            background: var(--accent);
            color: #000;
            box-shadow: 0 4px 12px rgba(245, 220, 91, 0.25);
        }

        .btn-primary:hover {
            background: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(245, 220, 91, 0.35);
        }

        .btn-sm {
            padding: 0.5rem 0.85rem;
            font-size: 0.8rem;
            border-radius: 8px;
        }

        .btn-edit {
            background: rgba(59, 130, 246, 0.15);
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .btn-edit:hover {
            background: rgba(59, 130, 246, 0.25);
            transform: translateY(-1px);
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.15);
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .btn-delete:hover {
            background: rgba(239, 68, 68, 0.25);
            transform: translateY(-1px);
        }

        /* Card & Table */
        .card {
            background: var(--card);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            transition: var(--transition);
        }

        .card:hover {
            border-color: var(--border-hover);
        }

        .table-responsive {
            overflow-x: auto;
            position: relative;
        }

        /* Mobile scroll indicator */
        .table-responsive::after {
            content: '← Desliza →';
            position: absolute;
            right: 1rem;
            bottom: 0.5rem;
            font-size: 0.75rem;
            color: var(--muted);
            background: var(--card-solid);
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
            display: none;
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .table-responsive::after {
                display: block;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th,
        td {
            padding: 1rem 1.25rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        th {
            color: var(--muted);
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.02);
            white-space: nowrap;
        }

        td {
            font-size: 0.92rem;
            transition: var(--transition);
        }

        tbody tr:hover td {
            background: rgba(245, 220, 91, 0.06);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* Badges */
        .badge {
            padding: 0.4rem 0.85rem;
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            vertical-align: middle;
            /* <--- AGREGA ESTO */
        }

        

        .badge-pendiente {
            background: rgba(234, 179, 8, 0.15);
            color: var(--warning);
            border: 1px solid rgba(234, 179, 8, 0.3);
        }

        .badge-confirmado {
            background: rgba(34, 197, 94, 0.15);
            color: var(--success);
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .badge-cancelado {
            background: rgba(239, 68, 68, 0.15);
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        /* Alert */
        .alert {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            border-left: 4px solid var(--success);
            color: var(--success);
            padding: 1rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--muted);
        }

        .empty-state span {
            font-size: 2.5rem;
            display: block;
            margin-bottom: 0.75rem;
            opacity: 0.5;
        }

        /* Pagination Styling for Laravel Default */
        .pagination-wrapper {
            margin-top: 1.5rem;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            gap: 6px;
            list-style: none;
            padding: 0;
            margin: 0;
            flex-wrap: wrap;
            justify-content: center;
        }

        .page-item {
            display: inline-block;
        }

        .page-link,
        .page-item span {
            padding: 0.5rem 0.85rem;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: var(--card-solid);
            color: var(--muted);
            text-decoration: none;
            font-size: 0.85rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
        }

        .page-link:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .active span {
            background: var(--accent);
            color: #000;
            border-color: var(--accent);
            font-weight: 700;
        }

        .disabled span {
            opacity: 0.4;
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .citas-container {
                padding: 1rem;
            }

            .top-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-primary {
                width: 100%;
                justify-content: center;
            }

            th,
            td {
                padding: 0.85rem 1rem;
                font-size: 0.85rem;
            }

            .acciones {
                flex-direction: column;
                gap: 0.4rem;
            }

            .btn-sm {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="citas-container">

        <div class="top-header">
            <div>
                <h1>📅 Mis Citas</h1>
                <p>Administra y visualiza todas tus reservas programadas</p>
            </div>

            <a href="{{ route('cliente.citas.create') }}" class="btn btn-primary">
                ➕ Nueva Cita
            </a>
        </div>

        @if (session('success'))
            <div class="alert">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Barbero</th>
                            <th>Servicio</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>

                        </tr>
                    </thead>

                    <tbody>
                        @forelse($citas as $cita)
                            <tr>
                                <td>
                                    <strong>{{ $cita->barbero->nombre ?? 'No disponible' }}</strong>
                                </td>

                                <td>
                                    {{ $cita->servicio->nombre ?? 'Sin servicio' }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}
                                </td>

                                <td style="font-family: monospace; font-weight: 600;">
                                    {{ $cita->hora }}
                                </td>

                                <td>
                                    {{ ucfirst($cita->estado) }}
                                    <span class="badge badge-{{ $cita->estado }}">
                                        {{ ucfirst($cita->estado) }}
                                    </span>
                                </td>


                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <span>📭</span>
                                        No tienes citas registradas.<br>
                                        <small>Reserva tu primera cita para comenzar.</small>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="pagination-wrapper">
            {{ $citas->links() }}
        </div>

    </div>

@endsection
