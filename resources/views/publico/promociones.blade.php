@extends('layouts.public')

@section('title', 'Promociones')

@section('contenidoPublico')

<style>
    /* ================= PROMO SECTION - Usa variables de tu layout público ================= */
    
    .promo-page {
        padding: 4rem 0;
        width: 100%;
    }

    .promo-title {
        text-align: center;
        color: var(--text);
        font-size: clamp(2rem, 4vw, 2.7rem);
        font-weight: 800;
        margin: 0 auto 3rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border);
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        max-width: 1200px;
        padding: 0 1rem 1rem;
    }

    .promo-title::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: var(--gold);
        border-radius: 3px;
    }

    /* ================= GRID 3-2-1 RESPONSIVE ================= */
    .promo-grid {
        display: grid;
        gap: 1.5rem;
        padding: 0 1rem;
        /* Desktop: 3 cards */
        grid-template-columns: repeat(3, 1fr);
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Tablet: 2 cards */
    @media (max-width: 1024px) {
        .promo-grid { grid-template-columns: repeat(2, 1fr); }
    }

    /* Móvil: 1 card */
    @media (max-width: 768px) {
        .promo-grid {
            grid-template-columns: 1fr;
            max-width: 420px;
            margin: 0 auto;
        }
        .promo-page { padding: 2.5rem 0; }
        .promo-title { font-size: 1.8rem; margin-bottom: 2rem; }
    }

    /* ================= PROMO CARD ================= */
    .promo-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
    }

    .promo-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--gold), transparent);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .promo-card:hover {
        transform: translateY(-8px);
        border-color: var(--gold);
        box-shadow: 0 16px 40px var(--gold-glow);
    }

    .promo-card:hover::before {
        transform: scaleX(1);
    }

    /* ================= BADGE ================= */
    .promo-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: var(--gold);
        color: #000;
        padding: 0.5rem 1.1rem;
        border-radius: 50px;
        font-weight: 800;
        font-size: 1rem;
        z-index: 3;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        letter-spacing: 0.5px;
    }

    /* ================= IMAGE ================= */
    .promo-image-wrap {
        position: relative;
        overflow: hidden;
        height: 240px;
    }

    .promo-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .promo-card:hover .promo-image {
        transform: scale(1.08);
    }

    .promo-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
        opacity: 0;
        transition: var(--transition);
        pointer-events: none;
    }

    .promo-card:hover .promo-overlay {
        opacity: 1;
    }

    /* ================= CONTENT ================= */
    .promo-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .promo-card-title {
        color: var(--text);
        font-size: 1.35rem;
        font-weight: 700;
        margin: 0 0 0.75rem;
        line-height: 1.3;
    }

    .promo-card-desc {
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 1.25rem;
        font-size: 0.95rem;
        flex: 1;
    }

    /* ================= INFO BOX ================= */
    .promo-info {
        background: var(--bg-dark);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .promo-barber {
        color: var(--text);
        margin-bottom: 0.6rem;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .promo-barber strong {
        color: var(--gold);
    }

    .promo-date {
        color: var(--text-muted);
        font-size: 0.85rem;
        margin-bottom: 0.4rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .promo-date:last-child { margin-bottom: 0; }

    /* ================= STATUS BADGES ================= */
    .promo-status {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.45rem 0.9rem;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-top: 0.5rem;
        border: 1px solid transparent;
    }

    .status-activa {
        background: rgba(34, 197, 94, 0.15);
        color: var(--success);
        border-color: rgba(34, 197, 94, 0.3);
    }

    .status-inactiva {
        background: rgba(239, 68, 68, 0.15);
        color: var(--danger);
        border-color: rgba(239, 68, 68, 0.3);
    }

    .status-finalizada {
        background: rgba(168, 85, 247, 0.15);
        color: #a855f7;
        border-color: rgba(168, 85, 247, 0.3);
    }

    /* ================= FOOTER & BUTTONS ================= */
    .promo-footer {
        padding: 0 1.5rem 1.5rem;
        margin-top: auto;
    }

    .promo-btn {
        width: 100%;
        border: none;
        border-radius: 14px;
        padding: 0.9rem 1.2rem;
        font-weight: 700;
        text-decoration: none;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition);
        font-size: 0.95rem;
        cursor: pointer;
    }

    .promo-btn-primary {
        background: var(--gold);
        color: #000;
    }

    .promo-btn-primary:hover {
        background: var(--gold-hover);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px var(--gold-glow);
    }

    .promo-btn-disabled {
        background: var(--bg-card);
        color: var(--text-muted);
        border: 1px dashed var(--border);
        cursor: not-allowed;
    }

    .promo-btn-disabled:hover {
        background: var(--bg-card);
        transform: none;
    }

    /* ================= EMPTY STATE ================= */
    .promo-empty {
        grid-column: 1 / -1;
        background: var(--bg-card);
        border: 2px dashed var(--border);
        border-radius: var(--radius);
        padding: 3rem 2rem;
        text-align: center;
        color: var(--text-muted);
        max-width: 500px;
        margin: 0 auto;
    }

    .promo-empty h4 {
        color: var(--text);
        font-size: 1.3rem;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .promo-empty p { margin: 0; font-size: 0.95rem; }

    @media (prefers-reduced-motion: reduce) {
        * { animation: none !important; transition: none !important; }
    }
</style>

<div class="promo-page">
    <div class="container">
        <h1 class="promo-title">🔥 Promociones Especiales</h1>

        <div class="promo-grid">
            @forelse($promociones as $promocion)
            <div class="promo-card">
                
                <!-- BADGE -->
                <div class="promo-badge">-{{ $promocion->descuento }}%</div>

                <!-- IMAGE -->
                <div class="promo-image-wrap">
                    <img 
                        src="{{ $promocion->imagen ? asset('storage/' . $promocion->imagen) : 'https://via.placeholder.com/600x400/111/F5DC5B?text=🔥+PROMO' }}"
                        alt="{{ $promocion->nombre }}"
                        class="promo-image"
                        onerror="this.src='https://via.placeholder.com/600x400/111/F5DC5B?text=🔥+PROMO'"
                    >
                    <div class="promo-overlay"></div>
                </div>

                <!-- CONTENT -->
                <div class="promo-body">
                    <h3 class="promo-card-title">{{ $promocion->nombre }}</h3>
                    <p class="promo-card-desc">{{ $promocion->descripcion }}</p>

                    <div class="promo-info">
                        <p class="promo-barber">
                            💈 <strong>Barbero:</strong>
                            {{ $promocion->barbero->nombre ?? 'No disponible' }}
                        </p>
                        <p class="promo-date">
                            📅 Inicio: {{ \Carbon\Carbon::parse($promocion->fecha_inicio)->format('d/m/Y') }}
                        </p>
                        <p class="promo-date">
                            ⏳ Finaliza: {{ \Carbon\Carbon::parse($promocion->fecha_fin)->format('d/m/Y') }}
                        </p>

                        @if($promocion->estado == 'activa')
                            <span class="promo-status status-activa">✅ Activa</span>
                        @elseif($promocion->estado == 'inactiva')
                            <span class="promo-status status-inactiva">❌ Inactiva</span>
                        @elseif($promocion->estado == 'finalizada')
                            <span class="promo-status status-finalizada">🏁 Finalizada</span>
                        @endif
                    </div>
                </div>

                <!-- BUTTON (TU LÓGICA ORIGINAL) -->
                <div class="promo-footer">
                    @auth
                        @if (auth()->user()->rol == 'cliente')
                            <a href="{{ route('cliente.citas.create', ['servicio' => $promocion->id, 'barbero' => $promocion->barbero_id]) }}" 
                               class="promo-btn promo-btn-primary">
                                🎁 Aprovechar Oferta
                            </a>
                        @elseif(auth()->user()->rol == 'barbero')
                            <button class="promo-btn promo-btn-disabled" onclick="alert('Eres barbero, no puedes reservar citas.')">
                                💈 Solo clientes
                            </button>
                        @elseif(auth()->user()->rol == 'admin')
                            <button class="promo-btn promo-btn-disabled" onclick="alert('Los administradores no pueden reservar citas.')">
                                ⚠️ Acceso restringido
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="promo-btn promo-btn-primary">
                            🔐 Iniciar sesión
                        </a>
                    @endauth
                </div>

            </div>
            @empty
            <div class="promo-empty">
                <h4>⚠️ No hay promociones disponibles</h4>
                <p>Pronto tendremos nuevas promociones para ti. ¡Mantente atento!</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

@endsection