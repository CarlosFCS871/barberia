@extends('layouts.barbero')
@section('title', 'Mis Promociones')
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
            --warning: #eab308;
            --danger: #ef4444;
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

        .promo-module {
            font-family: var(--font);
            color: var(--text);
            padding: 1.5rem;
            max-width: 1400px;
            margin: 0 auto;
            opacity: 0;
            animation: fadeIn .4s ease forwards
        }

        .promo-module * {
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

        .filter-bar {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: .75rem;
            margin-bottom: 1.5rem
        }

        .flt-select {
            padding: .65rem 2.5rem .65rem 1rem;
            background: var(--card-glass);
            border: 1px solid var(--border);
            border-radius: var(--sm);
            color: var(--text);
            font-size: .9rem;
            transition: var(--tr);
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center
        }

        .flt-select:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(245, 220, 91, .15)
        }

        .promos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem
        }

        .promo-card {
            background: var(--card-glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            transition: var(--tr);
            display: flex;
            flex-direction: column
        }

        .promo-card:hover {
            transform: translateY(-4px);
            border-color: var(--gold);
            box-shadow: 0 8px 24px rgba(0, 0, 0, .3)
        }

        .promo-img-wrap {
            position: relative;
            height: 180px;
            overflow: hidden;
            background: var(--bg)
        }

        .promo-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--tr)
        }

        .promo-card:hover .promo-img-wrap img {
            transform: scale(1.05)
        }

        .discount-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: var(--gold);
            color: #000;
            font-weight: 800;
            font-size: .85rem;
            padding: 6px 10px;
            border-radius: 50px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .2)
        }

        .status-pill {
            position: absolute;
            top: 12px;
            left: 12px;
            padding: 5px 10px;
            border-radius: 50px;
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            border: 1px solid
        }

        .status-activa {
            background: rgba(34, 197, 94, .2);
            color: var(--success);
            border-color: rgba(34, 197, 94, .3)
        }

        .status-inactiva {
            background: rgba(234, 179, 8, .2);
            color: var(--warning);
            border-color: rgba(234, 179, 8, .3)
        }

        .status-finalizada {
            background: rgba(239, 68, 68, .2);
            color: var(--danger);
            border-color: rgba(239, 68, 68, .3)
        }

        .promo-content {
            padding: 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: .75rem
        }

        .promo-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0
        }

        .promo-desc {
            font-size: .88rem;
            color: var(--text-sec);
            margin: 0;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden
        }

        .promo-dates {
            font-size: .78rem;
            color: var(--muted);
            display: flex;
            gap: .5rem
        }

        .promo-actions {
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid var(--border);
            display: flex;
            gap: .5rem;
            justify-content: flex-end
        }

        .action-btn {
            padding: .45rem .8rem;
            background: transparent;
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text-sec);
            font-size: .8rem;
            cursor: pointer;
            transition: var(--tr);
            display: inline-flex;
            align-items: center;
            gap: 4px;
            text-decoration: none
        }

        .action-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: var(--hover)
        }

        .action-btn.delete:hover {
            border-color: var(--danger);
            color: var(--danger);
            background: rgba(239, 68, 68, .1)
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: .5rem;
            padding: 1rem
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
            padding: 4rem 1rem;
            grid-column: 1/-1;
            background: var(--card-glass);
            border: 1px dashed var(--border);
            border-radius: var(--radius)
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--gold);
            opacity: .4;
            margin-bottom: 1rem
        }

        @media(max-width:768px) {
            .promo-module {
                padding: 1rem
            }

            .module-header {
                flex-direction: column;
                align-items: stretch
            }

            .filter-bar {
                justify-content: stretch
            }

            .flt-select {
                width: 100%
            }

            .promos-grid {
                grid-template-columns: 1fr
            }
        }

        @media(hover:none) and (pointer:coarse) {

            .flt-select,
            .action-btn {
                min-height: 44px
            }

            select,
            input {
                font-size: 16px !important
            }
        }
    </style>

    <div class="promo-module">
        <header class="module-header">
            <div>
                <h1>🎁 Mis Promociones</h1>
                <p>Gestiona tus campañas y ofertas especiales para clientes</p>
            </div>
            <a href="{{ route('barbero.promociones.create') }}" class="action-btn"
                style="background:var(--gold);color:#000;border:none;font-weight:600">➕ Nueva Promoción</a>
        </header>

        <section class="stats-row">
            <article class="stat-card">
                <div class="stat-icon"><i data-lucide="check-circle"></i></div>
                <div class="stat-label">Activas</div>
                <div class="stat-value">{{ $activas ?? 0 }}</div>
            </article>
            <article class="stat-card">
                <div class="stat-icon" style="color:var(--warning);background:rgba(234,179,8,.1)"><i
                        data-lucide="pause-circle"></i></div>
                <div class="stat-label">Inactivas</div>
                <div class="stat-value">{{ $inactivas ?? 0 }}</div>
            </article>
            
            <article class="stat-card">
                <div class="stat-icon"><i data-lucide="layers"></i></div>
                <div class="stat-label">Total</div>
                <div class="stat-value">{{ $totalPromociones ?? 0 }}</div>
            </article>
        </section>

        <div class="filter-bar">
            <select name="estado" class="flt-select"
                onchange="window.location='{{ route('barbero.promociones.index') }}?estado='+this.value">
                <option value="">Todos los estados</option>
                <option value="activa" {{ request('estado') == 'activa' ? 'selected' : '' }}>✅ Activas</option>
                <option value="inactiva" {{ request('estado') == 'inactiva' ? 'selected' : '' }}>⏸ Inactivas</option>
                <option value="finalizada" {{ request('estado') == 'finalizada' ? 'selected' : '' }}>🏁 Finalizadas</option>
            </select>
        </div>

        <div class="promos-grid">
            @forelse($promociones ?? [] as $promo)
                <article class="promo-card">
                    <div class="promo-img-wrap">
                        @if ($promo->imagen)
                            <img src="{{ asset('storage/' . $promo->imagen) }}" alt="{{ $promo->nombre }}">
                        @else
                            <div
                                style="display:flex;align-items:center;justify-content:center;height:100%;background:linear-gradient(135deg,var(--card),var(--bg));color:var(--gold);font-size:2.5rem">
                                🎯</div>
                        @endif
                        <span class="status-pill status-{{ $promo->estado }}">{{ ucfirst($promo->estado) }}</span>
                        <span class="discount-badge">-{{ $promo->descuento }}%</span>
                    </div>
                    <div class="promo-content">
                        <h3 class="promo-title">{{ $promo->nombre }}</h3>
                        <p class="promo-desc">{{ $promo->descripcion ?? 'Sin descripción disponible' }}</p>
                        <div class="promo-dates">
                            <span><i data-lucide="calendar" style="width:12px;display:inline"></i>
                                {{ \Carbon\Carbon::parse($promo->fecha_inicio)->format('d/m') }}</span>
                            <span>→</span>
                            <span><i data-lucide="calendar-off" style="width:12px;display:inline"></i>
                                {{ \Carbon\Carbon::parse($promo->fecha_fin)->format('d/m/Y') }}</span>
                        </div>
                        <div class="promo-actions">
                            <a href="{{ route('barbero.promociones.show', $promo->id) }}" class="action-btn"><i
                                    data-lucide="eye" style="width:14px"></i> Ver</a>
                            <a href="{{ route('barbero.promociones.edit', $promo->id) }}" class="action-btn"><i
                                    data-lucide="pencil" style="width:14px"></i> Editar</a>
                                <form action="{{ route('barbero.promociones.destroy', $promo->id) }}" method="POST"
                                    onsubmit="return confirm('¿Estás seguro de eliminar esta promoción?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete"><i data-lucide="trash-2"
                                            style="width:14px"></i> Eliminar</button>
                        </div>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <i data-lucide="gift"></i>
                    <h3>No tienes promociones registradas</h3>
                    <p style="color:var(--muted)">Crea tu primera campaña para atraer más clientes</p>
                </div>
            @endforelse
        </div>

        @if (isset($promociones) && $promociones->hasPages())
            <div class="pagination">{{ $promociones->withQueryString()->links() }}</div>
        @endif
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons()
        })
    </script>
@endsection
