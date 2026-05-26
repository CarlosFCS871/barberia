@extends('layouts.public')

@section('title', 'Testimonios')

@section('contenidoPublico')

<style>
    /* ================= TESTIMONIOS - Usa variables de tu layout público ================= */
    
    .testimonios-page {
        padding: 4rem 0;
        width: 100%;
    }

    .testimonios-header {
        text-align: center;
        padding: 0 1rem 3rem;
        border-bottom: 1px solid var(--border);
        margin-bottom: 3rem;
    }

    .testimonios-title {
        font-size: clamp(2rem, 4vw, 2.8rem);
        font-weight: 800;
        color: var(--text);
        margin: 0 0 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .testimonios-subtitle {
        color: var(--text-muted);
        font-size: 1.05rem;
        margin: 0;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    /* ================= GRID 3-2-1 RESPONSIVE ================= */
    .testimonios-grid {
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
        .testimonios-grid { grid-template-columns: repeat(2, 1fr); }
    }

    /* Móvil: 1 card */
    @media (max-width: 768px) {
        .testimonios-grid {
            grid-template-columns: 1fr;
            max-width: 420px;
            margin: 0 auto;
        }
        .testimonios-page { padding: 2.5rem 0; }
        .testimonios-title { font-size: 1.8rem; }
    }

    /* ================= TESTIMONIAL CARD ================= */
    .testimonial-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 2rem;
        height: 100%;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        display: flex;
        flex-direction: column;
    }

    .testimonial-card::before {
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

    .testimonial-card:hover {
        transform: translateY(-8px);
        border-color: var(--gold);
        box-shadow: 0 16px 40px var(--gold-glow);
    }

    .testimonial-card:hover::before {
        transform: scaleX(1);
    }

    /* ================= QUOTE ICON ================= */
    .quote-icon {
        position: absolute;
        top: -10px;
        right: 1.5rem;
        font-size: 5rem;
        color: var(--gold);
        opacity: 0.1;
        font-weight: 900;
        font-family: serif;
        line-height: 1;
        pointer-events: none;
    }

    /* ================= CLIENT INFO ================= */
    .client-info {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.25rem;
        border-bottom: 1px solid var(--border);
    }

    .client-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--gold);
        flex-shrink: 0;
        transition: var(--transition);
    }

    .testimonial-card:hover .client-avatar {
        transform: scale(1.05);
        box-shadow: 0 0 0 3px var(--gold-glow);
    }

    .client-details {
        flex: 1;
    }

    .client-name {
        color: var(--text);
        font-size: 1.15rem;
        font-weight: 700;
        margin: 0 0 0.2rem;
        line-height: 1.3;
    }

    .client-role {
        color: var(--gold);
        font-size: 0.85rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    /* ================= MESSAGE ================= */
    .testimonial-message {
        color: var(--text-muted);
        line-height: 1.7;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
        flex: 1;
        position: relative;
        z-index: 1;
    }

    /* ================= STARS ================= */
    .stars {
        color: var(--gold);
        font-size: 1.1rem;
        letter-spacing: 2px;
        margin-bottom: 1rem;
        display: flex;
        gap: 2px;
    }

    .stars i {
        width: 16px;
        height: 16px;
    }

    /* ================= DATE ================= */
    .testimonial-date {
        color: var(--text-muted);
        font-size: 0.85rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        padding-top: 1rem;
        border-top: 1px dashed var(--border);
    }

    /* ================= EMPTY STATE ================= */
    .testimonios-empty {
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

    .testimonios-empty h4 {
        color: var(--text);
        font-size: 1.3rem;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .testimonios-empty p {
        margin: 0;
        font-size: 0.95rem;
    }

    @media (prefers-reduced-motion: reduce) {
        * { animation: none !important; transition: none !important; }
    }
</style>

<div class="testimonios-page">
    <div class="container">
        
        <!-- HEADER -->
        <div class="testimonios-header">
            <h1 class="testimonios-title">⭐ Testimonios de Clientes</h1>
            <p class="testimonios-subtitle">Opiniones reales de nuestros clientes satisfechos</p>
        </div>

        <!-- GRID -->
        <div class="testimonios-grid">
            @forelse($testimonios as $testimonio)
            <div class="testimonial-card">
                
                <!-- QUOTE ICON -->
                <div class="quote-icon">"</div>

                <!-- CLIENT INFO -->
                <div class="client-info">
                    <img
                        src="{{ $testimonio->cliente && $testimonio->cliente->foto 
                            ? asset('storage/' . $testimonio->cliente->foto) 
                            : 'https://ui-avatars.com/api/?name=' . urlencode($testimonio->cliente->nombre ?? 'Cliente') . '&background=F5DC5B&color=000' }}"
                        alt="{{ $testimonio->cliente->nombre ?? 'Cliente' }}"
                        class="client-avatar"
                        onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($testimonio->cliente->nombre ?? 'Cliente') }}&background=F5DC5B&color=000'"
                    >
                    <div class="client-details">
                        <h3 class="client-name">{{ $testimonio->cliente->nombre ?? 'Cliente' }}</h3>
                        <p class="client-role">✨ Cliente verificado</p>
                    </div>
                </div>

                <!-- MESSAGE -->
                <p class="testimonial-message">"{{ $testimonio->comentario }}"</p>

                <!-- STARS (TU LÓGICA ORIGINAL) -->
                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $testimonio->calificacion)
                            ⭐
                        @else
                            ☆
                        @endif
                    @endfor
                </div>

                <!-- DATE -->
                <div class="testimonial-date">
                    📅 {{ $testimonio->created_at->format('d/m/Y') }}
                </div>

            </div>
            @empty
            <div class="testimonios-empty">
                <h4>⚠️ No hay testimonios disponibles</h4>
                <p>Aún no se han publicado testimonios. ¡Sé el primero en compartir tu experiencia!</p>
            </div>
            @endforelse
        </div>

    </div>
</div>

@endsection