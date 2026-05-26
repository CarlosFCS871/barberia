@extends('layouts.public')
@section('title', 'Servicios')

@section('contenidoPublico')

<style>
    /* ================= SERVICIOS - Usa variables de tu layout público ================= */
    
    .services-page {
        padding: 4rem 0;
        width: 100%;
    }

    .services-title {
        font-size: clamp(2rem, 4vw, 2.4rem);
        font-weight: 800;
        color: var(--text);
        margin: 0 auto 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border);
        text-align: center;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        max-width: 1200px;
        padding: 0 1rem 1rem;
    }

    .services-title::after {
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
    .services-grid {
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
        .services-grid { grid-template-columns: repeat(2, 1fr); }
    }

    /* Móvil: 1 card */
    @media (max-width: 768px) {
        .services-grid {
            grid-template-columns: 1fr;
            max-width: 420px;
            margin: 0 auto;
        }
        .services-page { padding: 2.5rem 0; }
        .services-title { font-size: 1.8rem; margin-bottom: 1.5rem; }
    }

    /* ================= SERVICE CARD ================= */
    .service-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
    }

    .service-card::before {
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

    .service-card:hover {
        transform: translateY(-8px);
        border-color: var(--gold);
        box-shadow: 0 16px 40px var(--gold-glow);
    }

    .service-card:hover::before {
        transform: scaleX(1);
    }

    /* ================= IMAGE ================= */
    .service-image-wrap {
        position: relative;
        overflow: hidden;
        height: 250px;
    }

    .service-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .service-card:hover .service-image {
        transform: scale(1.08);
    }

    .service-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);
        opacity: 0;
        transition: var(--transition);
        pointer-events: none;
    }

    .service-card:hover .service-overlay {
        opacity: 1;
    }

    .service-overlay-btn {
        position: absolute;
        bottom: 1rem;
        left: 50%;
        transform: translateX(-50%);
        padding: 0.6rem 1.2rem;
        background: var(--gold);
        color: #000;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        transition: var(--transition);
    }

    .service-overlay-btn:hover {
        background: var(--gold-hover);
        transform: translateX(-50%) translateY(-2px);
    }

    /* ================= CONTENT ================= */
    .service-body {
        padding: 1.4rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .service-card-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--text);
        margin: 0 0 0.7rem;
        line-height: 1.3;
    }

    .service-card-desc {
        color: var(--text-muted);
        line-height: 1.6;
        flex: 1;
        margin-bottom: 1rem;
        font-size: 0.95rem;
    }

    /* ================= INFO BOX ================= */
    .service-info {
        background: var(--bg-dark);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 0.9rem 1rem;
        margin-bottom: 1rem;
    }

    .service-barber {
        color: var(--text);
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .service-barber strong {
        color: var(--gold);
    }

    .service-card-price {
        color: var(--gold);
        font-size: 1.6rem;
        font-weight: 800;
        margin: 0;
        letter-spacing: -0.5px;
    }

    /* ================= FOOTER & BUTTONS ================= */
    .service-footer {
        padding: 0 1.4rem 1.4rem;
        margin-top: auto;
    }

    .service-btn {
        width: 100%;
        border: none;
        border-radius: 14px;
        padding: 0.95rem 1rem;
        font-weight: 700;
        transition: var(--transition);
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 0.95rem;
        cursor: pointer;
    }

    .service-btn-primary {
        background: var(--gold);
        color: #000;
    }

    .service-btn-primary:hover {
        background: var(--gold-hover);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px var(--gold-glow);
    }

    .service-btn-disabled {
        background: var(--bg-card);
        color: var(--text-muted);
        border: 1px dashed var(--border);
        cursor: not-allowed;
    }

    .service-btn-disabled:hover {
        background: var(--bg-card);
        transform: none;
    }

    /* ================= EMPTY STATE ================= */
    .services-empty {
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

    .services-empty h4 {
        color: var(--text);
        font-size: 1.3rem;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .services-empty p {
        margin: 0;
        font-size: 0.95rem;
    }

    @media (prefers-reduced-motion: reduce) {
        * { animation: none !important; transition: none !important; }
    }
</style>

<div class="services-page">
    <div class="container">
        <h1 class="services-title">✂️ Servicios Disponibles</h1>

        <div class="services-grid">
            @forelse($servicios as $servicio)
            <div class="service-card">
                
                <!-- IMAGE -->
                <div class="service-image-wrap">
                    <img 
                        src="{{ $servicio->imagen ? asset('storage/' . $servicio->imagen) : 'https://via.placeholder.com/600x400/111/F5DC5B?text=✂️' }}"
                        class="service-image"
                        alt="{{ $servicio->nombre }}"
                        onerror="this.src='https://via.placeholder.com/600x400/111/F5DC5B?text=✂️'"
                    >
                    <div class="service-overlay">
                        @auth
                            @if(auth()->user()->rol == 'cliente')
                                <a href="{{ route('cliente.citas.create', ['servicio' => $servicio->id, 'barbero' => $servicio->barbero_id]) }}" 
                                   class="service-overlay-btn">
                                    📅 Reservar
                                </a>
                            @else
                                <span class="service-overlay-btn" style="background:var(--text-muted);cursor:not-allowed">
                                    🔐 Solo clientes
                                </span>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="service-overlay-btn">
                                🔐 Iniciar sesión
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- CONTENT -->
                <div class="service-body">
                    <h5 class="service-card-title">{{ $servicio->nombre }}</h5>
                    <p class="service-card-desc">{{ $servicio->descripcion }}</p>

                    <div class="service-info">
                        <p class="service-barber">
                            💈 <strong>Barbero:</strong>
                            {{ $servicio->barbero->nombre ?? 'No disponible' }}
                        </p>
                        <h4 class="service-card-price">
                            S/. {{ number_format($servicio->precio, 2) }}
                        </h4>
                    </div>
                </div>

                <!-- BUTTON (TU LÓGICA ORIGINAL) -->
                <div class="service-footer">
                    @auth
                        @if (auth()->user()->rol == 'cliente')
                            <a href="{{ route('cliente.citas.create', ['servicio' => $servicio->id, 'barbero' => $servicio->barbero_id]) }}" 
                               class="service-btn service-btn-primary">
                                📅 Reservar Cita
                            </a>
                        @elseif(auth()->user()->rol == 'barbero')
                            <button class="service-btn service-btn-disabled" onclick="alert('Eres barbero, no puedes reservar citas.')">
                                💈 Solo clientes pueden reservar
                            </button>
                        @elseif(auth()->user()->rol == 'admin')
                            <button class="service-btn service-btn-disabled" onclick="alert('Los administradores no pueden reservar citas.')">
                                ⚠️ Acceso no permitido
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="service-btn service-btn-primary">
                            🔐 Iniciar sesión para reservar
                        </a>
                    @endauth
                </div>

            </div>
            @empty
            <div class="services-empty">
                <h4>⚠️ No hay servicios disponibles</h4>
                <p>Pronto agregaremos nuevos servicios.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

@endsection