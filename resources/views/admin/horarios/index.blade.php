@extends('layouts.admin')
@section('title', 'Gestión de Horarios')
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
        }

        /* ================= BASE RESPONSIVE ================= */
        .horarios-index {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: var(--sb-text);
            background: transparent;
            padding: 1rem;
            width: 100%;
            max-width: 100vw;
            overflow-x: hidden;
            box-sizing: border-box;
        }

        .horarios-index *,
        .horarios-index *::before,
        .horarios-index *::after {
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

        .btn-create {
            background: var(--sb-accent);
            color: #000;
            padding: 0.7rem 1.2rem;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.9rem;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--sb-transition);
            white-space: nowrap;
            min-height: 44px;
        }

        .btn-create:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(245, 220, 91, 0.3);
            background: var(--sb-accent-hover);
            color: #000;
        }

        .btn-create svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        /* ================= STATS ================= */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: var(--sb-card);
            border: 1px solid var(--sb-border);
            border-radius: var(--sb-radius);
            padding: 1rem;
            position: relative;
            transition: var(--sb-transition);
            min-height: 90px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            border-color: var(--sb-accent-soft);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--sb-accent), transparent);
        }

        .stat-label {
            font-size: 0.75rem;
            color: var(--sb-muted);
            display: block;
            margin-bottom: 0.25rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .stat-value {
            font-size: 1.35rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            display: block;
        }

        .stat-icon {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            font-size: 1rem;
            opacity: 0.5;
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

        .filter-group.search {
            flex: 2;
            min-width: 180px;
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
        .horarios-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
            min-width: 560px;
        }

        .horarios-table th {
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

        .horarios-table td {
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--sb-border);
            vertical-align: middle;
            white-space: nowrap;
            transition: var(--sb-transition);
        }

        .horarios-table tbody tr:hover {
            background: var(--sb-accent-soft);
            transform: translateX(3px);
        }

        .horarios-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Barbero cell con avatar */
        .barbero-cell {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 160px;
        }

        .barbero-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--sb-accent-soft);
            background: var(--sb-accent-soft);
            color: var(--sb-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .barbero-nombre {
            font-weight: 600;
            display: block;
            line-height: 1.2;
            font-size: 0.9rem;
            max-width: 130px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Hora y día */
        .dia-badge {
            background: var(--sb-accent-soft);
            color: var(--sb-accent);
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            display: inline-block;
        }

        .hora-rango {
            font-weight: 600;
            color: var(--sb-text);
            font-size: 0.9rem;
        }

        .hora-rango span {
            color: var(--sb-muted);
            font-weight: 400;
            font-size: 0.8rem;
        }

        /* Badges */
        .badge {
            padding: 3px 8px;
            border-radius: 50px;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 62px;
            text-align: center;
        }

        .badge-activo {
            background: rgba(34, 197, 94, 0.12);
            color: var(--sb-green);
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .badge-inactivo {
            background: rgba(107, 114, 128, 0.12);
            color: var(--sb-gray);
            border: 1px solid rgba(107, 114, 128, 0.2);
        }

        /* Actions */
        .actions-cell {
            display: flex;
            gap: 5px;
            justify-content: flex-end;
            flex-wrap: nowrap;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            min-width: 32px;
            min-height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            border: 1px solid var(--sb-border);
            background: transparent;
            cursor: pointer;
            transition: var(--sb-transition);
            color: var(--sb-muted);
            font-size: 0.95rem;
            text-decoration: none;
            flex-shrink: 0;
        }

        .btn-action:hover {
            border-color: var(--sb-accent);
            color: var(--sb-accent);
            background: var(--sb-accent-soft);
            transform: scale(1.05);
        }

        .btn-action.delete:hover {
            border-color: var(--sb-red);
            color: var(--sb-red);
            background: rgba(239, 68, 68, 0.1);
        }

        .actions-cell form {
            display: inline-flex;
            margin: 0;
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
        .horarios-table td[colspan] {
            text-align: center !important;
            padding: 2.5rem 1rem !important;
            color: var(--sb-muted) !important;
            font-size: 0.9rem !important;
        }

        .horarios-table td[colspan] p {
            margin: 0.25rem 0;
            font-size: 0.95rem;
        }

        .horarios-table td[colspan] p:first-child {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--sb-text);
            margin-bottom: 0.5rem;
        }

        /* ================= RESPONSIVE BREAKPOINTS ================= */
        @media (max-width: 1024px) {
            .horarios-index {
                padding: 0.85rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.65rem;
            }

            .stat-card {
                padding: 0.9rem;
                min-height: 85px;
            }

            .stat-value {
                font-size: 1.25rem;
            }

            .filters-form {
                padding: 0.75rem;
                gap: 0.55rem;
            }

            .filter-group {
                min-width: calc(50% - 0.35rem);
                flex: none;
            }

            .filter-group.search {
                flex: 1 1 100%;
                min-width: 100%;
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

            .horarios-table {
                min-width: 540px;
                font-size: 0.82rem;
            }

            .horarios-table th,
            .horarios-table td {
                padding: 0.75rem 0.9rem;
            }

            .barbero-avatar {
                width: 32px;
                height: 32px;
            }

            .barbero-nombre {
                font-size: 0.85rem;
                max-width: 110px;
            }

            .badge {
                padding: 2px 7px;
                font-size: 0.62rem;
                min-width: 60px;
            }

            .btn-action {
                width: 30px;
                height: 30px;
                font-size: 0.9rem;
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
            .horarios-index {
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

            .btn-create {
                width: 100% !important;
                justify-content: center !important;
                padding: 0.75rem 1rem !important;
                font-size: 0.875rem !important;
                min-height: 46px !important;
                margin-top: 0.2rem !important;
            }

            .stats-grid {
                grid-template-columns: 1fr !important;
                gap: 0.6rem !important;
                margin-bottom: 1.2rem !important;
            }

            .stat-card {
                padding: 0.8rem 0.9rem !important;
                flex-direction: row !important;
                align-items: center !important;
                gap: 0.8rem !important;
                min-height: auto !important;
            }

            .stat-card::before {
                width: 2px !important;
                height: 100% !important;
                top: 0 !important;
                left: 0 !important;
                right: auto !important;
            }

            .stat-icon {
                position: static !important;
                font-size: 1.15rem !important;
                opacity: 0.85 !important;
                margin: 0 !important;
            }

            .stat-label {
                margin: 0 !important;
                font-size: 0.72rem !important;
            }

            .stat-value {
                font-size: 1.15rem !important;
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

            .horarios-table {
                min-width: 500px;
                font-size: 0.78rem;
            }

            .horarios-table th,
            .horarios-table td {
                padding: 0.7rem 0.85rem;
            }

            .barbero-cell {
                gap: 8px;
                min-width: 140px;
            }

            .barbero-avatar {
                width: 30px;
                height: 30px;
            }

            .barbero-nombre {
                font-size: 0.8rem;
                max-width: 100px;
            }

            .badge {
                padding: 2px 6px;
                font-size: 0.6rem;
                min-width: 58px;
            }

            .actions-cell {
                gap: 4px;
                justify-content: center;
            }

            .btn-action {
                width: 30px;
                height: 30px;
                font-size: 0.9rem;
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
            .horarios-index {
                padding: 0.4rem !important;
            }

            .page-header h1 {
                font-size: 1.1rem !important;
            }

            .page-header p {
                font-size: 0.8rem !important;
            }

            .btn-create {
                padding: 0.7rem 0.9rem !important;
                font-size: 0.85rem !important;
                min-height: 44px !important;
            }

            .stat-card {
                padding: 0.7rem 0.8rem !important;
                gap: 0.7rem !important;
            }

            .stat-value {
                font-size: 1.05rem !important;
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

            .horarios-table {
                min-width: 460px;
                font-size: 0.75rem;
            }

            .horarios-table th,
            .horarios-table td {
                padding: 0.65rem 0.75rem;
            }

            .barbero-avatar {
                width: 28px;
                height: 28px;
            }

            .barbero-nombre {
                font-size: 0.75rem;
                max-width: 90px;
            }

            .badge {
                padding: 2px 5px;
                font-size: 0.58rem;
                min-width: 54px;
            }

            .btn-action {
                width: 28px;
                height: 28px;
                font-size: 0.85rem;
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

            .btn-action,
            .btn-apply,
            .btn-reset,
            .btn-create,
            .filter-group input,
            .filter-group select {
                min-height: 44px !important;
                min-width: 44px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
            }

            input,
            select,
            textarea {
                font-size: 16px !important;
            }

            .btn-action:hover,
            .stat-card:hover,
            .horarios-table tbody tr:hover {
                transform: none !important;
                transition: none !important;
            }

            .btn-action:active,
            .stat-card:active {
                opacity: 0.9 !important;
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
            .btn-action,
            .btn-apply,
            .btn-reset {
                display: inline-flex !important;
                flex-shrink: 0 !important;
            }
        }
    </style>

    <div class="horarios-index">
        <!-- HEADER -->
        <header class="page-header">
            <div>
                <h1>🗓️ Gestión de Horarios</h1>
                <p>Administra los horarios de atención de los barberos</p>
            </div>
            <a href="{{ route('admin.horarios.create') }}" class="btn-create">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Nuevo Horario
            </a>
        </header>

        <!-- STATS -->
        <section class="stats-grid">
            <article class="stat-card">
                <span class="stat-label">Total Horarios</span>
                <span class="stat-value">{{ $total ?? 0 }}</span>
                <span class="stat-icon">📅</span>
            </article>
            <article class="stat-card">
                <span class="stat-label">Activos</span>
                <span class="stat-value">{{ $activos ?? 0 }}</span>
                <span class="stat-icon">🟢</span>
            </article>
            <article class="stat-card">
                <span class="stat-label">Inactivos</span>
                <span class="stat-value">{{ $inactivos ?? 0 }}</span>
                <span class="stat-icon">🔴</span>
            </article>
        </section>

        <!-- FILTROS -->
        <section class="filters-section">
            <form class="filters-form" method="GET" action="{{ route('admin.horarios.index') }}">
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
                    </select>
                </div>
                <button type="submit" class="btn-apply">Filtrar</button>
                <a href="{{ route('admin.horarios.index') }}" class="btn-reset">Limpiar</a>
            </form>
        </section>

        <!-- TABLA -->
        <section class="table-wrapper">
            <table class="horarios-table">
                <thead>
                    <tr>
                        <th>Barbero</th>
                        <th>Día</th>
                        <th>Horario</th>
                        <th>Estado</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($horarios ?? [] as $horario)
                        <tr>
                            <td>
                                <div class="barbero-cell">
                                    <div class="barbero-avatar">
                                        {{ substr($horario->barbero->nombre ?? 'B', 0, 1) }}{{ substr($horario->barbero->apellido ?? '', 0, 1) }}
                                    </div>
                                    <span class="barbero-nombre">{{ $horario->barbero->nombre ?? 'Sin asignar' }}
                                        {{ $horario->barbero->apellido ?? '' }}</span>
                                </div>
                            </td>
                            <td><span class="dia-badge">{{ ucfirst($horario->dia) }}</span></td>
                            <td>
                                <span class="hora-rango">
                                    {{ $horario->hora_inicio }} <span>-</span> {{ $horario->hora_fin }}
                                </span>
                            </td>
                            <td>
                                <span
                                    class="badge {{ $horario->estado === 'activo' ? 'badge-activo' : 'badge-inactivo' }}">
                                    {{ ucfirst($horario->estado) }}
                                </span>
                            </td>
                            <td class="actions-cell">
                                <a href="{{ route('admin.horarios.show', $horario->id) }}" class="btn-action"
                                    title="Ver">👁️</a>
                                <a href="{{ route('admin.horarios.edit', $horario->id) }}" class="btn-action"
                                    title="Editar">✏️</a>
                                <form action="{{ route('admin.horarios.destroy', $horario->id) }}" method="POST"
                                    onsubmit="return confirm('¿Eliminar este horario?')" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn-action delete" title="Eliminar">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <p>🗓️ No hay horarios registrados</p>
                                <p style="font-size:0.85rem">Crea el primer horario para comenzar.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>

        <!-- PAGINACIÓN -->
        <div class="pagination-wrapper">
            {{ $horarios->withQueryString()->links() ?? '' }}
        </div>
    </div>
@endsection
