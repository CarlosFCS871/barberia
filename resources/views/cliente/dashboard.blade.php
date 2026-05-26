@extends('layouts.cliente')

@section('title', 'Mi Panel - Snyder Barber')

@section('contenidoCliente')
<style>
/* ================= VARIABLES & THEME ================= */
:root{
    --bg:#0a0a0b;
    --card:rgba(20,20,22,0.85);
    --card-solid:#161618;
    --border:rgba(245,220,91,0.15);
    --border-hover:rgba(245,220,91,0.4);
    --text:#f8fafc;
    --muted:#a1a1aa;
    --accent:#F5DC5B;
    --accent-hover:#e6c94a;
    --accent-glow:rgba(245,220,91,0.2);
    --success:#22c55e;
    --warning:#eab308;
    --danger:#ef4444;
    --info:#3b82f6;
    --radius:16px;
    --transition:all 0.25s cubic-bezier(0.4,0,0.2,1);
    --font:'Plus Jakarta Sans',system-ui,sans-serif;
}
[data-theme="light"]{
    --bg:#f8fafc;
    --card:#ffffff;
    --card-solid:#ffffff;
    --border:#e2e8f0;
    --border-hover:rgba(245,220,91,0.4);
    --text:#111827;
    --muted:#475569;
    --accent:#b89600;
    --accent-hover:#a38500;
    --accent-glow:rgba(245,220,91,0.15);
}

/* ================= BASE ================= */
.content-wrapper{
    font-family:var(--font);
    color:var(--text);
    padding:1.5rem;
    max-width:1400px;
    margin:0 auto;
    opacity:0;
    animation:fadeIn 0.4s ease forwards;
}
@keyframes fadeIn{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}
.content-wrapper *,.content-wrapper *::before,.content-wrapper *::after{box-sizing:border-box}

/* ================= HERO CTA ================= */
.hero-cta{
    background:linear-gradient(135deg,var(--card),var(--card-solid));
    border:1px solid var(--border);
    border-radius:var(--radius);
    padding:2rem;
    margin-bottom:2rem;
    text-align:center;
    position:relative;
    overflow:hidden;
    box-shadow:0 8px 24px rgba(0,0,0,0.3);
}
.hero-cta::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    right:0;
    height:3px;
    background:linear-gradient(90deg,transparent,var(--accent),transparent);
}
.btn-reservar{
    background:var(--accent);
    color:#000;
    border:none;
    border-radius:12px;
    padding:1rem 2rem;
    font-weight:700;
    font-size:1rem;
    cursor:pointer;
    transition:var(--transition);
    display:inline-flex;
    align-items:center;
    gap:0.75rem;
    box-shadow:0 4px 14px rgba(245,220,91,0.3);
    text-decoration:none;
}
.btn-reservar:hover{
    background:var(--accent-hover);
    transform:translateY(-2px);
    box-shadow:0 6px 18px rgba(245,220,91,0.4);
}
.btn-reservar i{width:20px;height:20px}
.pulse{animation:pulse 2s infinite}
@keyframes pulse{0%,100%{box-shadow:0 0 0 0 var(--accent-glow)}50%{box-shadow:0 0 0 12px transparent}}
.cta-note{
    color:var(--muted);
    font-size:0.9rem;
    margin:0.75rem 0 0;
}

/* ================= STATS GRID ================= */
.stats-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:1rem;
    margin-bottom:2rem;
}
.stat-card{
    background:var(--card);
    border:1px solid var(--border);
    border-radius:var(--radius);
    padding:1.25rem;
    text-align:center;
    transition:var(--transition);
}
.stat-card:hover{border-color:var(--border-hover);transform:translateY(-2px)}
.stat-icon{
    width:40px;height:40px;
    background:var(--accent-glow);
    border-radius:10px;
    display:flex;align-items:center;justify-content:center;
    margin:0 auto 0.75rem;
    color:var(--accent);
}
.stat-value{font-size:1.8rem;font-weight:800;display:block;line-height:1}
.stat-label{font-size:0.8rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.5px}

/* ================= CLIENT GRID ================= */
.client-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
    gap:1.5rem;
}

/* ================= CARDS ================= */
.card{
    background:var(--card);
    border:1px solid var(--border);
    border-radius:var(--radius);
    padding:1.5rem;
    transition:var(--transition);
}
.card:hover{border-color:var(--border-hover)}
.card-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:1.25rem;
    padding-bottom:0.75rem;
    border-bottom:1px solid var(--border);
}
.card-title{font-size:1.1rem;font-weight:700;margin:0}

/* ================= NEXT APPOINTMENT ================= */
.next-appointment{grid-column:1/-1}
.appt-details{display:flex;flex-direction:column;gap:0.75rem;margin-bottom:1.5rem}
.appt-date,.appt-service,.appt-barber{
    display:flex;align-items:center;gap:0.75rem;
    padding:0.75rem;
    background:var(--card-solid);
    border-radius:10px;
    border:1px solid var(--border);
}
.appt-date i,.appt-service i,.appt-barber i{
    width:18px;height:18px;color:var(--accent);flex-shrink:0
}
.appt-date span,.appt-service span,.appt-barber span{font-size:0.95rem}
.appt-actions{display:flex;gap:0.75rem;flex-wrap:wrap}
.btn-secondary{
    padding:0.65rem 1.2rem;
    background:transparent;
    border:1px solid var(--border);
    border-radius:8px;
    color:var(--text);
    font-weight:600;
    cursor:pointer;
    transition:var(--transition);
}
.btn-secondary:hover{border-color:var(--accent);color:var(--accent)}
.btn-outline{
    padding:0.65rem 1.2rem;
    background:transparent;
    border:1px solid var(--danger);
    border-radius:8px;
    color:var(--danger);
    font-weight:600;
    cursor:pointer;
    transition:var(--transition);
}
.btn-outline:hover{background:rgba(239,68,68,0.1)}

/* ================= PROMOTIONS ================= */
.promo-list{display:flex;flex-direction:column;gap:1rem}
.promo-card{
    display:flex;
    align-items:center;
    gap:1rem;
    padding:1rem;
    background:var(--card-solid);
    border:1px solid var(--border);
    border-radius:12px;
    transition:var(--transition);
}
.promo-card:hover{border-color:var(--accent);transform:translateX(3px)}
.promo-badge{
    background:var(--accent);
    color:#000;
    font-weight:800;
    font-size:0.8rem;
    padding:0.3rem 0.7rem;
    border-radius:6px;
    flex-shrink:0;
}
.promo-card h4{margin:0;font-size:0.95rem;font-weight:600}
.promo-card p{margin:0.25rem 0 0;font-size:0.8rem;color:var(--muted)}
.btn-sm-gold{
    margin-top:0.5rem;
    padding:0.4rem 0.8rem;
    background:var(--accent);
    color:#000;
    border:none;
    border-radius:6px;
    font-size:0.75rem;
    font-weight:600;
    cursor:pointer;
    transition:var(--transition);
}
.btn-sm-gold:hover{background:var(--accent-hover)}

/* ================= HISTORY TIMELINE ================= */
.history-timeline{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:1rem}
.history-timeline li{display:flex;gap:1rem;align-items:flex-start}
.history-timeline .dot{
    width:12px;height:12px;border-radius:50%;
    margin-top:6px;flex-shrink:0;position:relative
}
.history-timeline .dot::after{
    content:'';position:absolute;left:5px;top:12px;bottom:-12px;
    width:2px;background:var(--border)
}
.history-timeline li:last-child .dot::after{display:none}
.dot.completed{background:var(--success)}
.dot.cancelled{background:var(--danger)}
.history-info{display:flex;flex-direction:column}
.history-info strong{font-size:0.95rem;margin-bottom:0.2rem}
.history-info span{font-size:0.8rem;color:var(--muted)}

/* ================= FAVORITE SERVICES ================= */
.services-grid{display:flex;flex-wrap:wrap;gap:0.75rem}
.service-tag{
    display:inline-flex;align-items:center;gap:0.4rem;
    padding:0.5rem 0.9rem;
    background:var(--card-solid);
    border:1px solid var(--border);
    border-radius:50px;
    font-size:0.85rem;
    transition:var(--transition);
    cursor:pointer;
}
.service-tag:hover{border-color:var(--accent);color:var(--accent)}
.service-tag i{width:14px;height:14px;color:var(--accent)}

/* ================= FEATURED BARBERS ================= */
.featured-barbers{grid-column:1/-1}
.barbers-scroll{
    display:flex;
    gap:1rem;
    overflow-x:auto;
    padding-bottom:0.5rem;
    scrollbar-width:thin;
    scrollbar-color:var(--border) transparent;
}
.barbers-scroll::-webkit-scrollbar{height:4px}
.barbers-scroll::-webkit-scrollbar-thumb{background:var(--border);border-radius:10px}
.barber-card{
    min-width:180px;
    background:var(--card-solid);
    border:1px solid var(--border);
    border-radius:12px;
    padding:1.25rem;
    text-align:center;
    transition:var(--transition);
}
.barber-card:hover{border-color:var(--accent);transform:translateY(-3px)}
.barber-card img{
    width:70px;height:70px;border-radius:50%;
    margin:0 auto 0.75rem;border:2px solid var(--accent);
    object-fit:cover;
}
.barber-card h4{margin:0 0 0.25rem;font-size:1rem;font-weight:600}
.rating{display:flex;align-items:center;justify-content:center;gap:0.25rem;margin-bottom:0.5rem}
.rating i{width:14px;height:14px;color:var(--accent);fill:var(--accent)}
.rating span{font-size:0.8rem;font-weight:600}
.specialty{font-size:0.8rem;color:var(--muted);margin-bottom:0.75rem}
.btn-book-sm{
    width:100%;
    padding:0.5rem;
    background:transparent;
    border:1px solid var(--accent);
    border-radius:8px;
    color:var(--accent);
    font-size:0.8rem;
    font-weight:600;
    cursor:pointer;
    transition:var(--transition);
}
.btn-book-sm:hover{background:var(--accent);color:#000}

/* ================= STATUS BADGES ================= */
.status-badge{
    padding:0.35rem 0.8rem;
    border-radius:50px;
    font-size:0.75rem;
    font-weight:700;
    text-transform:uppercase;
}
.status-badge.active{
    background:rgba(34,197,94,0.15);
    color:var(--success);
    border:1px solid rgba(34,197,94,0.3);
}

/* ================= RESPONSIVE ================= */
@media(max-width:1024px){
    .client-grid{grid-template-columns:1fr}
    .next-appointment,.featured-barbers{grid-column:1}
}
@media(max-width:768px){
    .content-wrapper{padding:1rem}
    .hero-cta{padding:1.5rem}
    .stats-grid{grid-template-columns:repeat(2,1fr)}
    .appt-actions{flex-direction:column}
    .btn-secondary,.btn-outline{width:100%;justify-content:center}
    .barbers-scroll{padding:0.5rem 0}
}
@media(max-width:480px){
    .stats-grid{grid-template-columns:1fr}
    .card{padding:1.25rem}
}
@media(hover:none) and (pointer:coarse){
    .btn-reservar,.btn-secondary,.btn-outline,.btn-sm-gold,.btn-book-sm,.service-tag{min-height:44px}
    button,input,select{font-size:16px!important}
}
</style>

<div class="content-wrapper">
    <!-- CTA DESTACADO -->
    <section class="hero-cta">
        <a href="{{ route('cliente.citas.create') }}" class="btn-reservar pulse">
            <i data-lucide="calendar-plus"></i>
            <span>Reservar Nueva Cita</span>
        </a>
        <p class="cta-note">Disponibilidad en tiempo real • Confirmación inmediata</p>
    </section>

    <!-- ESTADÍSTICAS -->
    <section class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i data-lucide="calendar"></i></div>
            <span class="stat-value">{{ $totalCitas ?? 0 }}</span>
            <span class="stat-label">Total Citas</span>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="color:var(--warning);background:rgba(234,179,8,0.1)"><i data-lucide="clock"></i></div>
            <span class="stat-value">{{ $citasPendientes ?? 0 }}</span>
            <span class="stat-label">Pendientes</span>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="color:var(--success);background:rgba(34,197,94,0.1)"><i data-lucide="check-circle"></i></div>
            <span class="stat-value">{{ $citasFinalizadas ?? 0 }}</span>
            <span class="stat-label">Finalizadas</span>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="color:var(--accent);background:var(--accent-glow)"><i data-lucide="wallet"></i></div>
            <span class="stat-value">S/ {{ number_format($totalGastado ?? 0, 2) }}</span>
            <span class="stat-label">Total Gastado</span>
        </div>
    </section>

    <!-- GRID PRINCIPAL -->
    <div class="client-grid">
        <!-- PRÓXIMA CITA (Dinámico con $proximasCitas) -->
        <div class="card next-appointment">
            <div class="card-header">
                <h3 class="card-title">Próximas Citas</h3>
                @if($proximasCitas->count() > 0)
                    <span class="status-badge active">{{ $proximasCitas->count() }} activas</span>
                @endif
            </div>
            
            @forelse($proximasCitas->take(1) as $cita)
            <div class="appt-details">
                <div class="appt-date">
                    <i data-lucide="calendar"></i>
                    <span>{{ \Carbon\Carbon::parse($cita->fecha)->format('l d M') }} • {{ $cita->hora }}</span>
                </div>
                <div class="appt-service">
                    <i data-lucide="scissors"></i>
                    <span>{{ $cita->servicio->nombre ?? 'Servicio' }}</span>
                </div>
                <div class="appt-barber">
                    <i data-lucide="user-check"></i>
                    <span>Con: {{ $cita->barbero->nombre ?? 'Barbero' }} {{ $cita->barbero->apellido ?? '' }}</span>
                </div>
            </div>
            
            @empty
            <p style="color:var(--muted);text-align:center;padding:1rem">No tienes citas próximas programadas</p>
           
            @endforelse

            @if($proximasCitas->count() > 1)
            <div style="margin-top:1rem;padding-top:1rem;border-top:1px solid var(--border)">
                <p style="font-size:0.85rem;color:var(--muted);margin-bottom:0.75rem">Otras citas próximas:</p>
                @foreach($proximasCitas->skip(1)->take(2) as $cita)
                <div style="display:flex;justify-content:space-between;align-items:center;padding:0.6rem 0;border-bottom:1px dashed var(--border);font-size:0.9rem">
                    <span>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m') }} • {{ $cita->hora }}</span>
                    <span style="color:var(--accent);font-weight:600">{{ $cita->servicio->nombre ?? 'Servicio' }}</span>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        
    </div>
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    lucide.createIcons();
    
    // Animación de entrada para las cards
    document.querySelectorAll('.card').forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.style.animation = 'fadeIn 0.4s ease forwards';
    });
    
    // Botones de reservar en promociones
    document.querySelectorAll('.btn-sm-gold').forEach(btn => {
        btn.addEventListener('click', function() {
            window.location.href = "{{ route('cliente.citas.create') }}";
        });
    });
    
    // Botones de reservar barberos
    document.querySelectorAll('.btn-book-sm').forEach(btn => {
        btn.addEventListener('click', function() {
            const barberName = this.closest('.barber-card').querySelector('h4').textContent;
            alert(`Reservando con ${barberName}...\n\n(Redirigiendo al formulario de reserva)`);
            // window.location.href = "{{ route('cliente.citas.create') }}";
        });
    });
});
</script>
@endsection