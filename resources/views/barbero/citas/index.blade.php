@extends('layouts.barbero')
@section('title', 'Mis Citas')

@section('BarberoContenido')

<style>
    /* ================= CITAS MODULE - CSS ESPECÍFICO (SIN :root) ================= */
    
    /* Usa variables del layout principal: --bg-primary, --bg-card, --accent, etc. */
    
    .citas-module {
        font-family: var(--font);
        color: var(--text-primary);
        padding: 1.5rem;
        max-width: 1400px;
        margin: 0 auto;
        opacity: 0;
        animation: cm-fadeIn 0.4s ease forwards;
    }
    
    .citas-module * { box-sizing: border-box; }
    
    @keyframes cm-fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ================= HEADER ================= */
    .cm-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border);
    }
    
    .cm-header h1 {
        font-size: clamp(1.5rem, 2.5vw, 2rem);
        font-weight: 800;
        margin: 0;
        color: var(--text-primary);
    }
    
    .cm-header p {
        color: var(--text-secondary);
        font-size: 0.95rem;
        margin: 0.25rem 0 0;
    }

    /* ================= STATS GRID ================= */
    .cm-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.25rem;
        margin-bottom: 1.5rem;
    }
    
    .cm-stat-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.25rem;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }
    
    .cm-stat-card:hover {
        transform: translateY(-2px);
        border-color: var(--border-hover);
    }
    
    .cm-stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--accent), transparent);
    }
    
    .cm-stat-icon {
        width: 36px; height: 36px;
        background: var(--bg-hover);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        color: var(--accent);
        margin-bottom: 0.75rem;
    }
    
    .cm-stat-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }
    
    .cm-stat-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--text-primary);
    }

    /* ================= FILTERS ================= */
    .cm-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .cm-filt-group { flex: 1; min-width: 160px; }
    
    .cm-filt-input,
    .cm-filt-select {
        width: 100%;
        padding: 0.75rem 1rem;
        background: var(--bg-primary);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        color: var(--text-primary);
        font-size: 0.9rem;
        transition: var(--transition);
        appearance: none;
        min-height: 44px;
    }
    
    .cm-filt-select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 14px;
    }
    
    .cm-filt-input:focus,
    .cm-filt-select:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px var(--accent-glow);
    }
    
    .cm-filt-btn {
        background: var(--accent);
        color: #000;
        padding: 0.75rem 1.2rem;
        border-radius: var(--radius-sm);
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: var(--transition);
        min-height: 44px;
    }
    
    .cm-filt-btn:hover {
        background: var(--accent-hover);
    }

    /* ================= TABLE WRAPPER + SCROLL ================= */
    .cm-table-wrap {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow);
    }
    
    .cm-table-scroll {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scrollbar-color: var(--border) transparent;
    }
    
    .cm-table-scroll::-webkit-scrollbar { height: 4px; }
    .cm-table-scroll::-webkit-scrollbar-thumb {
        background: var(--border);
        border-radius: 10px;
    }
    
    .cm-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
        min-width: 700px; /* ← CLAVE: fuerza scroll horizontal en móvil */
    }
    
    .cm-table th {
        text-align: left;
        padding: 1rem 1.25rem;
        font-weight: 600;
        color: var(--text-muted);
        border-bottom: 1px solid var(--border);
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        background: rgba(255, 255, 255, 0.02);
        white-space: nowrap;
    }
    
    .cm-table td {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--border);
        transition: var(--transition-fast);
        vertical-align: middle;
    }
    
    .cm-table tbody tr:hover { background: var(--bg-hover); }
    .cm-table tbody tr:last-child td { border-bottom: none; }
    
    .cm-client-cell { display: flex; align-items: center; gap: 10px; }
    
    .cm-client-avatar {
        width: 32px; height: 32px;
        border-radius: 50%;
        background: var(--bg-hover);
        color: var(--accent);
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: 0.75rem;
        flex-shrink: 0;
    }
    
    .cm-client-avatar img {
        width: 100%; height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }
    
    .cm-client-name { font-weight: 600; color: var(--text-primary); }
    
    /* Badges */
    .cm-state-pill {
        display: inline-flex;
        padding: 0.3rem 0.7rem;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    
    .cm-state-pendiente {
        background: rgba(234, 179, 8, 0.15);
        color: var(--warning);
        border: 1px solid rgba(234, 179, 8, 0.3);
    }
    
    .cm-state-confirmada {
        background: rgba(59, 130, 246, 0.15);
        color: var(--info);
        border: 1px solid rgba(59, 130, 246, 0.3);
    }
    
    .cm-state-finalizada {
        background: rgba(34, 197, 94, 0.15);
        color: var(--success);
        border: 1px solid rgba(34, 197, 94, 0.3);
    }
    
    .cm-state-cancelada {
        background: rgba(239, 68, 68, 0.15);
        color: var(--danger);
        border: 1px solid rgba(239, 68, 68, 0.3);
    }
    
    /* Actions */
    .cm-action-cell { display: flex; gap: 0.5rem; justify-content: flex-end; }
    
    .cm-action-btn {
        width: 34px; height: 34px;
        border-radius: 8px;
        border: 1px solid var(--border);
        background: transparent;
        color: var(--text-secondary);
        cursor: pointer;
        transition: var(--transition-fast);
        display: flex; align-items: center; justify-content: center;
    }
    
    .cm-action-btn:hover {
        border-color: var(--accent);
        color: var(--accent);
        background: var(--bg-hover);
    }
    
    .cm-action-btn.edit:hover {
        border-color: var(--info);
        color: var(--info);
    }

    /* Pagination */
    .cm-pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        padding: 1.5rem 1rem;
    }
    
    .cm-page-link {
        padding: 0.5rem 0.9rem;
        border-radius: 8px;
        border: 1px solid var(--border);
        color: var(--text-secondary);
        text-decoration: none;
        transition: var(--transition);
    }
    
    .cm-page-link:hover {
        border-color: var(--accent);
        color: var(--accent);
    }
    
    .cm-page-link.active {
        background: var(--accent);
        color: #000;
        border-color: var(--accent);
    }
    
    /* Empty State */
    .cm-empty {
        text-align: center;
        padding: 4rem 1rem;
        color: var(--text-muted);
    }
    
    .cm-empty i {
        font-size: 3rem;
        color: var(--accent);
        opacity: 0.4;
        margin-bottom: 1rem;
    }

    /* ================= RESPONSIVE BREAKPOINTS ================= */
    
    /* Tablet (≤1024px) */
    @media (max-width: 1024px) {
        .citas-module { padding: 1rem; }
        .cm-header { flex-direction: column; align-items: stretch; }
        .cm-filters { flex-direction: column; }
        .cm-filt-group { min-width: 100%; }
        .cm-stats { grid-template-columns: repeat(2, 1fr); }
        .cm-table { min-width: 650px; }
    }
    
    /* Móvil (≤768px) */
    @media (max-width: 768px) {
        .cm-stats { grid-template-columns: 1fr; }
        .cm-stat-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            flex-direction: row;
        }
        .cm-stat-card::before {
            width: 3px; height: 100%;
            top: 0; left: 0; right: auto;
        }
        .cm-stat-icon { margin: 0; width: 40px; height: 40px; }
        .cm-stat-value { font-size: 1.3rem; }
        .cm-table { min-width: 580px; font-size: 0.85rem; }
        .cm-table th, .cm-table td { padding: 0.85rem 1rem; }
        .cm-client-avatar { width: 28px; height: 28px; font-size: 0.7rem; }
        .cm-state-pill { font-size: 0.68rem; padding: 0.25rem 0.6rem; }
        .cm-action-btn { width: 32px; height: 32px; }
    }
    
    /* Móvil pequeño (≤480px) */
    @media (max-width: 480px) {
        .cm-header h1 { font-size: 1.4rem; }
        .cm-table { min-width: 520px; font-size: 0.8rem; }
        .cm-table th, .cm-table td { padding: 0.7rem 0.85rem; font-size: 0.75rem; }
        .cm-state-pill { font-size: 0.65rem; }
        .cm-action-btn { width: 30px; height: 30px; }
        .cm-pagination { flex-wrap: wrap; }
        .cm-page-link { padding: 0.4rem 0.7rem; font-size: 0.75rem; min-width: 30px; }
    }
    
    /* Touch optimizations */
    @media (hover: none) and (pointer: coarse) {
        .cm-filt-input, .cm-filt-select, .cm-filt-btn, .cm-action-btn {
            min-height: 44px !important;
        }
        input, select { font-size: 16px !important; }
        .cm-stat-card:hover, .cm-table tbody tr:hover {
            transform: none !important;
            transition: none !important;
        }
    }
    
    /* Reduce motion */
    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            animation-duration: 0.01ms !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>

<div class="citas-module">
    <header class="cm-header">
        <div>
            <h1>📅 Mis Citas</h1>
            <p>Gestiona y actualiza el estado de las citas asignadas a tu servicio</p>
        </div>
    </header>

    <!-- STATS -->
    <section class="cm-stats">
        <article class="cm-stat-card">
            <div class="cm-stat-icon"><i data-lucide="clock"></i></div>
            <div class="cm-stat-label">Pendientes</div>
            <div class="cm-stat-value">{{ $pendientes ?? 0 }}</div>
        </article>
        <article class="cm-stat-card">
            <div class="cm-stat-icon" style="color:var(--info);background:rgba(59,130,246,.1)">
                <i data-lucide="calendar-check"></i>
            </div>
            <div class="cm-stat-label">Confirmadas</div>
            <div class="cm-stat-value">{{ $confirmadas ?? 0 }}</div>
        </article>
        <article class="cm-stat-card">
            <div class="cm-stat-icon" style="color:var(--success);background:rgba(34,197,94,.1)">
                <i data-lucide="check-circle-2"></i>
            </div>
            <div class="cm-stat-label">Finalizadas</div>
            <div class="cm-stat-value">{{ $finalizadas ?? 0 }}</div>
        </article>
        <article class="cm-stat-card">
            <div class="cm-stat-icon" style="color:var(--danger);background:rgba(239,68,68,.1)">
                <i data-lucide="x-circle"></i>
            </div>
            <div class="cm-stat-label">Canceladas</div>
            <div class="cm-stat-value">{{ $canceladas ?? 0 }}</div>
        </article>
    </section>

    <!-- FILTERS (TU LÓGICA ORIGINAL) -->
    <form class="cm-filters" method="GET" action="{{ route('barbero.citas.index') }}">
        <div class="cm-filt-group">
            <select name="estado" class="cm-filt-select">
                <option value="">Todos los estados</option>
                <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="confirmada" {{ request('estado') == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                <option value="finalizada" {{ request('estado') == 'finalizada' ? 'selected' : '' }}>Finalizada</option>
                <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
            </select>
        </div>
        <div class="cm-filt-group">
            <input type="date" name="fecha" value="{{ request('fecha') }}" class="cm-filt-input" placeholder="Filtrar por fecha">
        </div>
        <button type="submit" class="cm-filt-btn">Aplicar Filtros</button>
    </form>

    <!-- TABLE CON SCROLL HORIZONTAL -->
    <div class="cm-table-wrap">
        <div class="cm-table-scroll">
            <table class="cm-table">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Servicio</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($citas ?? [] as $cita)
                    <tr>
                        <td>
                            <div class="cm-client-cell">
                                <div class="cm-client-avatar">
                                    @if ($cita->cliente && $cita->cliente->foto)
                                        <img src="{{ asset('storage/' . $cita->cliente->foto) }}" alt="Cliente">
                                    @else
                                        {{ substr($cita->cliente->nombre ?? 'C', 0, 1) }}
                                    @endif
                                </div>
                                <span class="cm-client-name">{{ $cita->cliente->nombre ?? 'Desconocido' }}</span>
                            </div>
                        </td>
                        <td>{{ $cita->servicio->nombre ?? 'Sin servicio' }}</td>
                        <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d M Y') }}</td>
                        <td><span style="font-family:monospace;font-weight:600">{{ $cita->hora }}</span></td>
                        <td>
                            <span class="cm-state-pill cm-state-{{ $cita->estado }}">
                                {{ ucfirst($cita->estado) }}
                            </span>
                        </td>
                        <td>{{ $cita->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="cm-action-cell">
                                <a href="{{ route('barbero.citas.show', $cita->id) }}" class="cm-action-btn" title="Ver detalle">
                                    <i data-lucide="eye" style="width:16px"></i>
                                </a>
                                <a href="{{ route('barbero.citas.edit', $cita->id) }}" class="cm-action-btn edit" title="Cambiar estado">
                                    <i data-lucide="pencil" style="width:16px"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="cm-empty">
                                <i data-lucide="calendar-off"></i>
                                <h3 style="color:var(--text-primary);margin:0.5rem 0">No hay citas registradas</h3>
                                <p style="color:var(--text-muted);margin:0">Ajusta los filtros o espera nuevas reservas de clientes</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- PAGINATION (TU LÓGICA ORIGINAL) -->
    @if (isset($citas) && $citas->hasPages())
        <div class="cm-pagination">
            {{ $citas->withQueryString()->links() }}
        </div>
    @endif
</div>

<script>
// Re-inicializar iconos para esta sección
document.addEventListener('DOMContentLoaded', () => {
    if (typeof lucide !== 'undefined') {
        const module = document.querySelector('.citas-module');
        if (module) lucide.createIcons({ root: module });
    }
});
</script>

@endsection