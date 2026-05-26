@extends('layouts.public')

@section('title', 'Barberos')

@section('contenidoPublico')

    <style>
        /* ================= BARBEROS - Usa variables de tu layout público ================= */

        .barberos-page {
            padding: 4rem 0;
            width: 100%;
        }

        .barberos-title {
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 800;
            color: var(--text);
            margin: 0 auto 3rem;
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

        .barberos-title::after {
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
        .barberos-grid {
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
            .barberos-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Móvil: 1 card */
        @media (max-width: 768px) {
            .barberos-grid {
                grid-template-columns: 1fr;
                max-width: 420px;
                margin: 0 auto;
            }

            .barberos-page {
                padding: 2.5rem 0;
            }

            .barberos-title {
                font-size: 1.8rem;
                margin-bottom: 2rem;
            }
        }

        /* ================= BARBER CARD ================= */
        .barber-card {
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

        .barber-card::before {
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

        .barber-card:hover {
            transform: translateY(-8px);
            border-color: var(--gold);
            box-shadow: 0 16px 40px var(--gold-glow);
        }

        .barber-card:hover::before {
            transform: scaleX(1);
        }

        /* ================= IMAGE ================= */
        .barber-image-wrap {
            position: relative;
            overflow: hidden;
            height: 320px;
        }

        .barber-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top;
            transition: transform 0.5s ease;
        }

        .barber-card:hover .barber-image {
            transform: scale(1.08);
        }

        .barber-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
            opacity: 0;
            transition: var(--transition);
            pointer-events: none;
        }

        .barber-card:hover .barber-overlay {
            opacity: 1;
        }

        .barber-overlay-btn {
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

        .barber-overlay-btn:hover {
            background: var(--gold-hover);
            transform: translateX(-50%) translateY(-2px);
        }

        /* ================= CONTENT ================= */
        .barber-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .barber-card-name {
            color: var(--text);
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0 0 0.4rem;
            line-height: 1.3;
        }

        .barber-email {
            color: var(--text-muted);
            margin-bottom: 1rem;
            font-size: 0.9rem;
            word-break: break-all;
        }

        .barber-specialty {
            color: var(--gold);
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0.3rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .barber-experience {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
        }

        /* ================= SOCIAL LINKS ================= */
        .barber-social {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid var(--border);
        }

        .social-link {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--bg-dark);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .social-link:hover {
            background: var(--gold);
            border-color: var(--gold);
            color: #000;
            transform: translateY(-3px);
        }

        /* ================= FOOTER & BUTTONS ================= */
        .barber-footer {
            padding: 0 1.5rem 1.5rem;
            margin-top: auto;
        }

        .barber-btn {
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

        .barber-btn-primary {
            background: var(--gold);
            color: #000;
        }

        .barber-btn-primary:hover {
            background: var(--gold-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px var(--gold-glow);
        }

        .barber-btn-secondary {
            background: var(--bg-card);
            color: var(--text-muted);
            border: 1px solid var(--border);
        }

        .barber-btn-secondary:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        /* ================= EMPTY STATE ================= */
        .barberos-empty {
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

        .barberos-empty h4 {
            color: var(--text);
            font-size: 1.3rem;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .barberos-empty p {
            margin: 0;
            font-size: 0.95rem;
        }

        @media (prefers-reduced-motion: reduce) {
            * {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>

    <div class="barberos-page">
        <div class="container">
            <h1 class="barberos-title">💈 Nuestros Barberos</h1>

            <div class="barberos-grid">
                @forelse($barberos as $barbero)
                    <div class="barber-card">

                        <!-- IMAGE -->
                        <div class="barber-image-wrap">
                            <img src="{{ $barbero->foto ? asset('storage/' . $barbero->foto) : 'https://via.placeholder.com/600x700/111/F5DC5B?text=💈+BARBERO' }}"
                                alt="{{ $barbero->nombre }}" class="barber-image"
                                onerror="this.src='https://via.placeholder.com/600x700/111/F5DC5B?text=💈+BARBERO'">

                        </div>

                        <!-- CONTENT -->
                        <div class="barber-body">
                            <h3 class="barber-card-name">{{ $barbero->nombre }}</h3>
                            <p class="barber-email">📧 {{ $barbero->email }}</p>

                            <p class="barber-specialty">✂️ Barbero Profesional</p>
                            <p class="barber-experience">💼 Experto en cortes modernos y clásicos</p>

                            <!-- Social Links (placeholders - puedes agregar tus redes) -->
                            <div class="barber-social">
                                <a href="#" class="social-link" title="Instagram">📷</a>
                                <a href="#" class="social-link" title="Facebook">📘</a>
                                <a href="#" class="social-link" title="WhatsApp">💬</a>
                            </div>
                        </div>

                        <!-- BUTTON (TU LÓGICA ORIGINAL) -->
                        <div class="barber-footer">
                            <a href="{{ route('barberosShow', $barbero->id) }}" class="barber-btn barber-btn-primary">
                                ✂️ Ver Servicios Y promociones
                            </a>
                        </div>

                    </div>
                @empty
                    <div class="barberos-empty">
                        <h4>⚠️ No hay barberos disponibles</h4>
                        <p>Pronto tendremos un equipo de profesionales para atenderte.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection
