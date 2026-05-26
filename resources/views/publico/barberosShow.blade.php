@extends('layouts.public')

@section('title', $barbero->nombre)

@section('contenidoPublico')

<style>
    /* ================= BARBERO PROFILE - Usa variables de tu layout público ================= */
    
    .barbero-profile {
        padding: 4rem 0;
        width: 100%;
    }

    .barbero-header {
        text-align: center;
        padding: 2rem 1rem 3rem;
        border-bottom: 1px solid var(--border);
        margin-bottom: 3rem;
    }

    .barbero-name {
        color: var(--text);
        font-size: clamp(2rem, 4vw, 2.5rem);
        font-weight: 800;
        margin: 0 0 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .barbero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.4rem 1rem;
        background: rgba(245, 220, 91, 0.15);
        color: var(--gold);
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-top: 0.5rem;
    }

    /* ================= SECTIONS ================= */
    .profile-section {
        margin-bottom: 4rem;
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text);
        font-size: clamp(1.5rem, 3vw, 2rem);
        font-weight: 700;
        margin: 0 0 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border);
    }

    /* ================= GRID 3-2-1 RESPONSIVE ================= */
    .profile-grid {
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
        .profile-grid { grid-template-columns: repeat(2, 1fr); }
    }

    /* Móvil: 1 card */
    @media (max-width: 768px) {
        .profile-grid {
            grid-template-columns: 1fr;
            max-width: 420px;
            margin: 0 auto;
        }
        .barbero-profile { padding: 2.5rem 0; }
        .section-header { font-size: 1.6rem; }
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
        position: relative;
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

    .service-image-wrap {
        position: relative;
        overflow: hidden;
        height: 220px;
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

    .service-body {
        padding: 1.4rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .service-card-title {
        color: var(--text);
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0 0 0.6rem;
        line-height: 1.3;
    }

    .service-card-desc {
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 1rem;
        font-size: 0.95rem;
        flex: 1;
    }

    .service-card-price {
        color: var(--gold);
        font-size: 1.5rem;
        font-weight: 800;
        margin: 0;
        letter-spacing: -0.5px;
    }

    .service-footer {
        padding: 0 1.4rem 1.4rem;
        margin-top: auto;
    }

    .service-btn {
        width: 100%;
        border: none;
        border-radius: 14px;
        padding: 0.9rem 1rem;
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

    .service-btn-login {
        background: transparent;
        color: var(--gold);
        border: 2px solid var(--gold);
    }

    .service-btn-login:hover {
        background: var(--gold);
        color: #000;
    }

    /* ================= PROMO CARD ================= */
    .promo-card {
        background: var(--bg-card);
        border: 2px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        transition: var(--transition);
        height: 100%;
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

    .promo-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: var(--gold);
        color: #000;
        padding: 0.4rem 0.9rem;
        border-radius: 50px;
        font-weight: 800;
        font-size: 0.9rem;
        z-index: 2;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .promo-image-wrap {
        position: relative;
        overflow: hidden;
        height: 200px;
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

    .promo-body {
        padding: 1.4rem;
    }

    .promo-card-title {
        color: var(--text);
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0 0 0.6rem;
        line-height: 1.3;
    }

    .promo-card-desc {
        color: var(--text-muted);
        line-height: 1.6;
        margin: 0;
        font-size: 0.95rem;
    }

    /* ================= EMPTY STATE ================= */
    .profile-empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 2rem;
        color: var(--text-muted);
        font-size: 1rem;
    }

    @media (prefers-reduced-motion: reduce) {
        * { animation: none !important; transition: none !important; }
    }




    .barbero-header{
    background:var(--bg-card);
    border:1px solid var(--border);
    border-radius:24px;
    padding:2rem;
    text-align:center;
    margin-bottom:2rem;
}

.barbero-avatar{
    width:130px;
    height:130px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid var(--gold);
    margin-bottom:1rem;
}

.barbero-name{
    color:var(--text);
    font-size:2rem;
    font-weight:800;
    margin-bottom:.5rem;
}

.barbero-badge{
    display:inline-block;
    background:var(--gold);
    color:#000;
    padding:.5rem 1rem;
    border-radius:999px;
    font-weight:700;
    margin-bottom:1.5rem;
}

.barbero-info{
    display:flex;
    flex-direction:column;
    gap:.7rem;
    color:var(--text-muted);
    font-size:.95rem;
}
</style>

<div class="barbero-profile">
    <div class="container">
        
       <!-- HEADER DEL BARBERO -->
<div class="barbero-header">

    <img
        src="{{ $barbero->foto
            ? asset('storage/' . $barbero->foto)
            : 'https://ui-avatars.com/api/?name=' . urlencode($barbero->nombre) . '&background=111&color=F5DC5B&size=300' }}"
        alt="{{ $barbero->nombre }}"
        class="barbero-avatar"
    >

    <h1 class="barbero-name">
        💈 {{ $barbero->nombre }}
    </h1>

    <span class="barbero-badge">
        ✨ {{ $barbero->rol }}
    </span>

    <div class="barbero-info">

        <p>
            📧 {{ $barbero->email }}
        </p>

        @if($barbero->telefono)
            <p>
                📱 {{ $barbero->telefono }}
            </p>
        @endif

        @if($barbero->direccion)
            <p>
                📍 {{ $barbero->direccion }}
            </p>
        @endif

        <p>
            ✅ Estado:
            {{ ucfirst($barbero->estado) }}
        </p>

        <p>
            📅 Miembro desde:
            {{ $barbero->created_at->format('d/m/Y') }}
        </p>

    </div>

</div>

        <!-- SECCIÓN SERVICIOS -->
        <section class="profile-section">
            <h2 class="section-header">✂️ Servicios</h2>
            
            <div class="profile-grid">
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
                                    <a href="{{ route('cliente.citas.create', ['servicio' => $servicio->id, 'barbero' => $barbero->id]) }}" 
                                       class="service-overlay-btn">
                                        📅 Reservar
                                    </a>
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
                        <h3 class="service-card-title">{{ $servicio->nombre }}</h3>
                        <p class="service-card-desc">{{ $servicio->descripcion }}</p>
                        <h4 class="service-card-price">S/. {{ number_format($servicio->precio, 2) }}</h4>
                    </div>

                    <!-- BUTTON (TU LÓGICA ORIGINAL) -->
                    <div class="service-footer">
                        @auth
                            @if(auth()->user()->rol == 'cliente')
                                <a href="{{ route('cliente.citas.create', ['servicio' => $servicio->id, 'barbero' => $barbero->id]) }}" 
                                   class="service-btn service-btn-primary">
                                    📅 Reservar Cita
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="service-btn service-btn-login">
                                🔐 Iniciar sesión
                            </a>
                        @endauth
                    </div>

                </div>
                @empty
                <p class="profile-empty">No hay servicios disponibles de este barbero.</p>
                @endforelse
            </div>
        </section>

        <!-- SECCIÓN PROMOCIONES -->
        <section class="profile-section" id="promociones">
            <h2 class="section-header">🔥 Promociones</h2>
            
            <div class="profile-grid">
                @forelse($promociones as $promocion)
                <div class="promo-card">
                    
                    <!-- BADGE -->
                    <div class="promo-badge">-{{ $promocion->descuento }}%</div>

                    <!-- IMAGE -->
                    <div class="promo-image-wrap">
                        <img
                            src="{{ $promocion->imagen ? asset('storage/' . $promocion->imagen) : 'https://via.placeholder.com/600x400/111/F5DC5B?text=🔥+PROMO' }}"
                            class="promo-image"
                            alt="{{ $promocion->nombre }}"
                            onerror="this.src='https://via.placeholder.com/600x400/111/F5DC5B?text=🔥+PROMO'"
                        >
                    </div>

                    <!-- CONTENT -->
                    <div class="promo-body">
                        <h3 class="promo-card-title">{{ $promocion->nombre }}</h3>
                        <p class="promo-card-desc">{{ $promocion->descripcion }}</p>
                    </div>

                </div>
                @empty
                <p class="profile-empty">No hay promociones disponibles de este barbero.</p>
                @endforelse
            </div>
        </section>

    </div>
</div>

@endsection