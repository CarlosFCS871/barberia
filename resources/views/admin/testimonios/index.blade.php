@extends('layouts.admin')
@section('title', 'Gestión de Testimonios')
@section('AdminContenido')
<style>
:root { --sb-bg:#000000; --sb-card:#0a0a0a; --sb-border:rgba(255,255,255,0.08); --sb-text:#ffffff; --sb-muted:#a1a1aa; --sb-accent:#F5DC5B; --sb-accent-hover:#e6c94a; --sb-accent-soft:rgba(245,220,91,0.12); --sb-yellow:#eab308; --sb-green:#22c55e; --sb-red:#ef4444; --sb-radius:14px; --sb-transition:all 0.25s cubic-bezier(0.4,0,0.2,1); }
[data-theme="light"] { --sb-bg:#f8f9fa; --sb-card:#ffffff; --sb-border:#e5e7eb; --sb-text:#0a0a0a; --sb-muted:#4b5563; --sb-accent:#b89600; --sb-accent-hover:#a38500; --sb-accent-soft:rgba(245,220,91,0.18); --sb-yellow:#ca8a04; --sb-green:#16a34a; --sb-red:#dc2626; }

.testimonios-index { font-family:'Plus Jakarta Sans',system-ui,sans-serif; color:var(--sb-text); padding:1rem; width:100%; max-width:100vw; overflow-x:hidden; box-sizing:border-box; }
.testimonios-index *, .testimonios-index *::before, .testimonios-index *::after { box-sizing:border-box; max-width:100%; overflow-wrap:break-word; }

.page-header { display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:0.75rem; margin-bottom:1.5rem; padding-bottom:1rem; }
.page-header h1 { font-size:clamp(1.25rem,4vw,1.75rem); font-weight:800; margin:0; }
.page-header p { color:var(--sb-muted); font-size:0.9rem; margin:0.25rem 0 0; width:100%; }

.filters-section { margin-bottom:1.25rem; }
.filters-form { display:flex; flex-wrap:wrap; gap:0.6rem; background:var(--sb-card); border:1px solid var(--sb-border); border-radius:var(--sb-radius); padding:0.85rem; }
.filter-group { flex:1; min-width:140px; }
.filter-group select { width:100%; padding:0.65rem 0.9rem; padding-right:2rem; border-radius:8px; border:1px solid var(--sb-border); background:var(--sb-bg); color:var(--sb-text); font-size:0.875rem; transition:var(--sb-transition); appearance:none; min-height:42px; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%23a1a1aa' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 10px center; background-size:14px; }
.filter-group select:focus { outline:none; border-color:var(--sb-accent); box-shadow:0 0 0 2px var(--sb-accent-soft); }
.btn-apply, .btn-reset { padding:0.65rem 1rem; border-radius:8px; font-weight:600; font-size:0.875rem; cursor:pointer; transition:var(--sb-transition); text-decoration:none; display:inline-flex; align-items:center; justify-content:center; min-height:42px; white-space:nowrap; }
.btn-apply { background:var(--sb-accent); color:#000; border:none; }
.btn-apply:hover { background:var(--sb-accent-hover); }
.btn-reset { background:transparent; border:1px solid var(--sb-border); color:var(--sb-muted); }
.btn-reset:hover { border-color:var(--sb-red); color:var(--sb-red); }

.table-wrapper { background:var(--sb-card); border:1px solid var(--sb-border); border-radius:var(--sb-radius); overflow-x:auto; -webkit-overflow-scrolling:touch; scrollbar-width:thin; scrollbar-color:var(--sb-accent-soft) transparent; margin-bottom:1rem; }
.table-wrapper::-webkit-scrollbar { height:4px; }
.table-wrapper::-webkit-scrollbar-thumb { background:var(--sb-accent-soft); border-radius:10px; }

.testimonios-table { width:100%; border-collapse:collapse; font-size:0.85rem; min-width:700px; }
.testimonios-table th { text-align:left; padding:0.85rem 1rem; font-weight:600; color:var(--sb-muted); border-bottom:1px solid var(--sb-border); background:rgba(255,255,255,0.02); white-space:nowrap; text-transform:uppercase; font-size:0.7rem; letter-spacing:0.4px; }
.testimonios-table td { padding:0.85rem 1rem; border-bottom:1px solid var(--sb-border); vertical-align:middle; transition:var(--sb-transition); }
.testimonios-table tbody tr:hover { background:var(--sb-accent-soft); }
.testimonios-table tbody tr:last-child td { border-bottom:none; }

.stars { color:var(--sb-accent); font-size:1.1rem; letter-spacing:2px; line-height:1; }
.comment-preview { max-width:250px; font-style:italic; color:var(--sb-muted); overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }

.badge { padding:4px 10px; border-radius:50px; font-size:0.68rem; font-weight:700; text-transform:uppercase; letter-spacing:0.3px; display:inline-flex; align-items:center; justify-content:center; min-width:75px; text-align:center; }
.badge-pendiente { background:rgba(234,179,8,0.15); color:var(--sb-yellow); border:1px solid rgba(234,179,8,0.3); }
.badge-aprobado { background:rgba(34,197,94,0.15); color:var(--sb-green); border:1px solid rgba(34,197,94,0.3); }
.badge-rechazado { background:rgba(239,68,68,0.15); color:var(--sb-red); border:1px solid rgba(239,68,68,0.3); }

.actions-cell { display:flex; gap:6px; justify-content:flex-end; flex-wrap:nowrap; }
.btn-view, .btn-edit { padding:0.45rem 0.85rem; background:transparent; border:1px solid var(--sb-border); border-radius:8px; color:var(--sb-text); font-size:0.78rem; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:4px; transition:var(--sb-transition); }
.btn-view:hover { border-color:var(--sb-accent); color:var(--sb-accent); background:var(--sb-accent-soft); }
.btn-edit:hover { border-color:#60a5fa; color:#60a5fa; background:rgba(96,165,250,0.1); }

.pagination-wrapper { display:flex; justify-content:center; padding:0.85rem; border-top:1px solid var(--sb-border); background:var(--sb-card); }
.pagination-wrapper .pagination { display:flex; gap:4px; margin:0; padding:0; list-style:none; }
.pagination-wrapper .page-item { display:inline-block; }
.pagination-wrapper .page-link, .pagination-wrapper .page-item span { padding:6px 12px; border-radius:6px; border:1px solid var(--sb-border); color:var(--sb-text); text-decoration:none; font-weight:500; transition:var(--sb-transition); display:inline-flex; align-items:center; justify-content:center; min-width:34px; min-height:34px; font-size:0.8rem; }
.pagination-wrapper .page-link:hover { border-color:var(--sb-accent); color:var(--sb-accent); }
.pagination-wrapper .active .page-link, .pagination-wrapper .page-item.active span { background:var(--sb-accent); color:#000; border-color:var(--sb-accent); font-weight:700; }
.pagination-wrapper .disabled span { opacity:0.5; cursor:not-allowed; }

.empty-state { text-align:center; padding:2.5rem 1rem; color:var(--sb-muted); }
.empty-state p:first-child { font-size:1.1rem; font-weight:600; color:var(--sb-text); margin-bottom:0.5rem; }

@media (max-width:1024px) { .testimonios-index{padding:0.85rem;} .filters-form{padding:0.75rem;gap:0.55rem;} .filter-group{min-width:calc(50% - 0.35rem);flex:none;} .btn-apply,.btn-reset{padding:0.6rem 0.9rem;min-height:40px;} }
@media (max-width:768px) { .testimonios-index{padding:0.6rem;} .page-header{flex-direction:column !important;align-items:flex-start !important;gap:0.5rem !important;} .filters-section{margin-bottom:1rem !important;} .filters-form{flex-direction:column !important;align-items:stretch !important;padding:0.8rem !important;gap:0.6rem !important;} .filter-group{min-width:100% !important;} .btn-apply,.btn-reset{width:100% !important;min-height:46px !important;} .table-wrapper{margin:0 -0.6rem;padding:0 0.6rem;} .testimonios-table{min-width:600px;} .testimonios-table th,.testimonios-table td{padding:0.7rem 0.85rem;} .comment-preview{max-width:180px;} }
@media (max-width:480px) { .testimonios-index{padding:0.4rem !important;} .page-header h1{font-size:1.1rem !important;} .table-wrapper{margin:0 -0.4rem;padding:0 0.4rem;} .testimonios-table{min-width:540px;font-size:0.78rem;} .testimonios-table th,.testimonios-table td{padding:0.65rem 0.75rem;} .stars{font-size:0.95rem;} .badge{padding:2px 6px;font-size:0.6rem;min-width:70px;} }
@media (hover:none) and (pointer:coarse) { .btn-apply,.btn-reset,.btn-view,.btn-edit,select,input { min-height:44px !important; } input,select { font-size:16px !important; } }
</style>

<div class="testimonios-index">
    <header class="page-header">
        <div>
            <h1>🌟 Testimonios de Clientes</h1>
            <p>Modera y aprueba las reseñas enviadas por tus clientes</p>
        </div>
    </header>

    <section class="filters-section">
        <form class="filters-form" method="GET" action="{{ route('admin.testimonios.index') }}">
            <div class="filter-group">
                <select name="estado">
                    <option value="">Todos los estados</option>
                    <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>⏳ Pendiente</option>
                    <option value="aprobado" {{ request('estado') == 'aprobado' ? 'selected' : '' }}>✅ Aprobado</option>
                    <option value="rechazado" {{ request('estado') == 'rechazado' ? 'selected' : '' }}>❌ Rechazado</option>
                </select>
            </div>
            <div class="filter-group">
                <select name="calificacion">
                    <option value="">Todas las calificaciones</option>
                    @for($i=5; $i>=1; $i--)
                        <option value="{{ $i }}" {{ request('calificacion') == $i ? 'selected' : '' }}>{{ $i }} Estrellas</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn-apply">Filtrar</button>
            <a href="{{ route('admin.testimonios.index') }}" class="btn-reset">Limpiar</a>
        </form>
    </section>

    <section class="table-wrapper">
        <table class="testimonios-table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Cliente</th>
                    <th>Calificación</th>
                    <th>Comentario</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonios ?? [] as $testimonio)
                <tr>
                    <td><strong>#{{ str_pad($testimonio->id, 3, '0', STR_PAD_LEFT) }}</strong></td>
                    <td style="font-weight:600;">{{ $testimonio->cliente->nombre ?? 'Visitante' }} {{ $testimonio->cliente->apellido ?? '' }}</td>
                    <td>
                        <span class="stars">
                            @for($i=1; $i<=$testimonio->calificacion; $i++)★@endfor
                            @for($i=$testimonio->calificacion+1; $i<=5; $i++)☆@endfor
                        </span>
                    </td>
                    <td><span class="comment-preview">“{{ Str::limit($testimonio->comentario, 45) }}”</span></td>
                    <td><span class="badge badge-{{ $testimonio->estado }}">{{ ucfirst($testimonio->estado) }}</span></td>
                    <td>{{ $testimonio->created_at->format('d/m/Y') }}</td>
                    <td class="actions-cell">
                        <a href="{{ route('admin.testimonios.show', $testimonio->id) }}" class="btn-view">👁️ Ver</a>
                        <a href="{{ route('admin.testimonios.edit', $testimonio->id) }}" class="btn-edit">✏️ Estado</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7"><div class="empty-state"><p>📝 No hay testimonios registrados</p><p style="font-size:0.85rem">Los clientes podrán enviar reseñas desde la web.</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </section>

    @if(isset($testimonios) && $testimonios->hasPages())
    <div class="pagination-wrapper">
        {{ $testimonios->withQueryString()->links() }}
    </div>
    @endif
</div>
@endsection