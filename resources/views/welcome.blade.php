@extends('layouts.public')
@section('title', 'Bienvenido')
@section('contenidoPublico')

    <!-- HERO SECTION -->
    <section class="hero" id="inicio">
        <div class="hero-content">
            <div class="hero-badge">✂️ Barbería Premium</div>
            <h1 class="hero-title">Tu estilo comienza en <span>Snyder Barber</span></h1>
            <p class="hero-subtitle">Experimenta el arte del corte perfecto con nuestros barberos expertos. Donde la
                tradición se encuentra con la modernidad.</p>
            <div class="hero-buttons">

                @auth

                    @if (auth()->user()->rol == 'cliente')
                        <a href="{{ route('cliente.citas.create') }}" class="btn btn-primary">
                            <i data-lucide="calendar"></i>
                            Reservar Cita
                        </a>
                    @elseif(auth()->user()->rol == 'barbero')
                        <button type="button" class="btn btn-primary"
                            onclick="alert('Eres barbero, no puedes reservar citas. Solo disponible para clientes.')">

                            <i data-lucide="calendar"></i>
                            Reservar Cita

                        </button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i data-lucide="calendar"></i>
                        Reservar Cita
                    </a>

                @endauth

                <a href="#servicios" class="btn btn-outline">
                    <i data-lucide="scissors"></i>
                    Ver Servicios
                </a>

            </div>
            <div class="hero-stats">
                <div class="stat-item"><span class="stat-number">+500</span><span class="stat-label">Clientes
                        Felices</span></div>
                <div class="stat-item"><span class="stat-number">+1200</span><span class="stat-label">Cortes
                        Realizados</span></div>
                <div class="stat-item"><span class="stat-number">5★</span><span class="stat-label">Calificación</span>
                </div>
            </div>
        </div>
    </section>

    <!-- SERVICES SECTION -->
    <section class="services" id="servicios">
        <div class="container">
            <div class="section-header reveal">
                <span class="section-tag">Nuestros Servicios</span>
                <h2 class="section-title">Servicios <span>Premium</span></h2>
                <p class="section-subtitle">Ofrecemos una amplia gama de servicios para mantener tu estilo impecable</p>
            </div>

            <div class="grid-compact">
                @php $count = 0; @endphp
                @forelse($servicios->take(3) as $servicio)
                    @php $count++; @endphp
                    <div class="service-card reveal">
                        <img src="{{ $servicio->imagen
                            ? asset('storage/' . $servicio->imagen)
                            : 'https://via.placeholder.com/600x400/111/F5DC5B?text=✂️' }}"
                            alt="{{ $servicio->nombre }}" class="service-image"
                            onerror="this.src='https://via.placeholder.com/600x400/111/F5DC5B?text=✂️'">
                        <div class="service-content">
                            <div class="service-header">
                                <h3 class="service-name">{{ $servicio->nombre }}</h3>
                                <span class="service-price">S/ {{ number_format($servicio->precio, 2) }}</span>
                            </div>
                            <p class="service-desc">{{ Str::limit($servicio->descripcion, 80) }}</p>
                            <div class="service-actions">

                                @auth

                                    @if (auth()->user()->rol == 'cliente')
                                        <a href="{{ route('cliente.citas.create', [
                                            'servicio' => $servicio->id,
                                            'barbero' => $servicio->barbero_id,
                                        ]) }}"
                                            class="service-btn">

                                            📅 Reservar

                                        </a>
                                    @elseif(auth()->user()->rol == 'barbero')
                                        <button class="service-btn service-btn-disabled"
                                            onclick="alert('Eres barbero, no puedes reservar citas.')">

                                            💈 Solo clientes

                                        </button>
                                    @elseif(auth()->user()->rol == 'admin')
                                        <button class="service-btn service-btn-disabled"
                                            onclick="alert('Los administradores no pueden reservar citas.')">

                                            ⚠️ No permitido

                                        </button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="service-btn">

                                        🔐 Iniciar sesión

                                    </a>

                                @endauth

                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>

            @if ($count >= 3 && $servicios->count() > 3)
                <div class="see-more-wrapper">

                    <a href="{{ url('/servicios') }}" class="btn-see-more">
                        <i data-lucide="arrow-right"></i> Ver más servicios
                    </a>

                </div>
            @endif
        </div>
        <style>
            .service-actions {
                margin-top: 1rem;
            }

            .service-btn-disabled {
                background: #555 !important;
                cursor: not-allowed;
                opacity: .8;
            }
        </style>
    </section>

    <!-- PROMOTIONS SECTION -->
    <section class="promotions" id="promociones">

        <div class="container">
            <div class="section-header reveal">
                <span class="section-tag">Promociones Especiales</span>
                <h2 class="section-title">Ofertas <span>Exclusivas</span></h2>
                <p class="section-subtitle">Aprovecha nuestras promociones limitadas y ahorra en tu estilo</p>
            </div>

            <div class="grid-compact">
                @php $count = 0; @endphp
                @forelse($promociones->take(3) as $promocion)
                    @php $count++; @endphp
                    <div class="promo-card reveal">
                        <span class="promo-badge">-{{ $promocion->descuento }}%</span>
                        <img src="{{ $promocion->imagen ? asset('storage/' . $promocion->imagen) : 'https://via.placeholder.com/600x400/111/F5DC5B?text=🎁' }}"
                            alt="{{ $promocion->nombre }}" class="promo-image"
                            onerror="this.src='https://via.placeholder.com/600x400/111/F5DC5B?text=🎁'">
                        <div class="promo-content">
                            <h3 class="promo-title">{{ $promocion->nombre }}</h3>
                            <p class="promo-desc">{{ Str::limit($promocion->descripcion, 70) }}</p>
                            <div class="promo-date">
                                <i data-lucide="calendar" style="width:14px"></i>
                                <span>Vence: {{ \Carbon\Carbon::parse($promocion->fecha_fin)->format('d M') }}</span>
                            </div>


                            <a href="/promociones" class="btn-see-more">
                                🔥 Ver Promoción
                            </a>
                        </div>
                    </div>
                @empty
                    <p style="grid-column:1/-1;text-align:center;color:var(--text-muted)">No hay promociones activas
                        actualmente</p>
                @endforelse
            </div>

            @if ($count >= 3 && $promociones->count() > 3)
                <div class="see-more-wrapper">
                  <a href="/promociones" class="btn-see-more">
    Ver Promociones
</a>
                </div>  
            @endif
        </div>
    </section>

    <!-- BARBERS SECTION -->

    <style>
        /* ================= BARBERS ================= */

        .barbers {
            background: var(--bg-dark);
        }

        /* GRID RESPONSIVE */
        .barbers-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        /* TABLET */
        @media (max-width: 1024px) {
            .barbers-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* MOBILE */
        @media (max-width: 768px) {
            .barbers-grid {
                grid-template-columns: 1fr;
            }
        }

        .barber-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            transition: var(--transition);
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
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
            transition: transform .3s ease;
            z-index: 5;
        }

        .barber-card:hover {
            transform: translateY(-8px);
            border-color: var(--gold);
            box-shadow: 0 12px 40px rgba(0, 0, 0, .45);
        }

        .barber-card:hover::before {
            transform: scaleX(1);
        }

        /* IMAGE */
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
            transition: transform .5s ease;
        }

        .barber-card:hover .barber-image {
            transform: scale(1.08);
        }

        /* OVERLAY */
        .barber-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, .75), transparent);
            opacity: 0;
            transition: .3s ease;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding: 1.2rem;
        }

        .barber-card:hover .barber-overlay {
            opacity: 1;
        }

        .barber-overlay-btn {
            background: var(--gold);
            color: #000;
            text-decoration: none;
            padding: .8rem 1.2rem;
            border-radius: 12px;
            font-weight: 700;
            transition: .3s ease;
        }

        .barber-overlay-btn:hover {
            background: var(--gold-hover);
            transform: translateY(-2px);
        }

        /* CONTENT */
        .barber-content {
            padding: 1.4rem;
            flex: 1;
        }

        .barber-name {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--text);
            margin-bottom: .5rem;
        }

        .barber-specialty {
            color: var(--gold);
            font-weight: 600;
            margin-bottom: .5rem;
        }

        .barber-experience {
            color: var(--text-muted);
            font-size: .92rem;
            line-height: 1.6;
        }

        /* FOOTER */
        .barber-footer {
            padding: 0 1.4rem 1.4rem;
        }

        .barber-btn {
            width: 100%;
            padding: .9rem 1rem;
            border-radius: 12px;
            background: transparent;
            border: 1px solid var(--gold);
            color: var(--gold);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            font-weight: 700;
            transition: .3s ease;
        }

        .barber-btn:hover {
            background: var(--gold);
            color: #000;
        }

        /* EMPTY */
        .barbers-empty {
            grid-column: 1/-1;
            background: var(--bg-card);
            border: 2px dashed var(--border);
            border-radius: var(--radius);
            padding: 3rem 2rem;
            text-align: center;
            color: var(--text-muted);
        }

        .barbers-empty h4 {
            color: var(--text);
            margin-bottom: .7rem;
        }

        /* SEE MORE */
        .see-more-wrapper {
            margin-top: 2.5rem;
            display: flex;
            justify-content: center;
        }

        .btn-see-more {
            display: inline-flex;
            align-items: center;
            gap: .6rem;
            padding: 1rem 1.4rem;
            border-radius: 14px;
            background: var(--gold);
            color: #000;
            font-weight: 700;
            text-decoration: none;
            transition: .3s ease;
        }

        .btn-see-more:hover {
            background: var(--gold-hover);
            transform: translateY(-3px);
        }
    </style>
    <section class="barbers" id="barberos">
        <div class="container">

            <div class="section-header reveal">
                <span class="section-tag">Nuestro Equipo</span>

                <h2 class="section-title">
                    Barberos <span>Expertos</span>
                </h2>

                <p class="section-subtitle">
                    Profesionales dedicados a perfeccionar tu estilo
                </p>
            </div>

            <!-- GRID RESPONSIVE -->
            <div class="barbers-grid">

                @php $count = 0; @endphp

                @forelse($barberos->take(3) as $barbero)
                    @php $count++; @endphp

                    <div class="barber-card reveal">

                        <!-- IMAGE -->
                        <div class="barber-image-wrap">

                            <img src="{{ $barbero->foto
                                ? asset('storage/' . $barbero->foto)
                                : 'https://ui-avatars.com/api/?name=' .
                                    urlencode($barbero->nombre ?? ($barbero->name ?? 'B')) .
                                    '&background=111&color=F5DC5B&size=500' }}"
                                alt="{{ $barbero->nombre ?? ($barbero->name ?? 'Barbero') }}" class="barber-image"
                                onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($barbero->nombre ?? ($barbero->name ?? 'B')) }}&background=111&color=F5DC5B&size=500'">

                            <div class="barber-overlay">

                                <a href="{{ route('barberosShow', $barbero->id) }}" class="barber-overlay-btn">

                                    ✂️ Ver Perfil

                                </a>

                            </div>

                        </div>

                        <!-- CONTENT -->
                        <div class="barber-content">

                            <h3 class="barber-name">
                                {{ $barbero->nombre ?? ($barbero->name ?? 'Barbero') }}
                            </h3>

                            <p class="barber-specialty">
                                💈 Barbero Profesional
                            </p>

                            <p class="barber-experience">
                                <i data-lucide="award" style="width:14px;display:inline"></i>
                                Experto en cortes modernos y clásicos
                            </p>

                        </div>

                        <!-- BUTTON -->
                        <div class="barber-footer">

                            <a href="{{ route('barberosShow', $barbero->id) }}" class="barber-btn">

                                ✂️ Ver Servicios y Promociones

                            </a>

                        </div>

                    </div>

                @empty

                    <div class="barbers-empty">

                        <h4>
                            ⚠️ No hay barberos disponibles
                        </h4>

                        <p>
                            Próximamente nuestro equipo estará disponible.
                        </p>

                    </div>
                @endforelse

            </div>

            <!-- VER MÁS -->
            @if ($count >= 3 && $barberos->count() > 3)
                <div class="see-more-wrapper">

                    <a href="/barberos" class="btn-see-more">

                        <i data-lucide="arrow-right"></i>
                        Ver más barberos

                    </a>

                </div>
            @endif

        </div>
    </section>

    <!-- TESTIMONIALS SECTION -->
    <section class="testimonials" id="testimonios">
        <div class="container">
            <div class="section-header reveal">
                <span class="section-tag">Testimonios</span>
                <h2 class="section-title">Lo que dicen nuestros <span>Clientes</span></h2>
                <p class="section-subtitle">Experiencias reales de quienes confían en nosotros</p>
            </div>

            <div class="grid-compact">
                @php $count = 0; @endphp
                @forelse($testimonios->take(3) as $testimonio)
                    @php $count++; @endphp
                    <div class="testimonial-card reveal">
                        <div class="testimonial-stars">
                            @for ($i = 1; $i <= 5; $i++)
                                @if (isset($testimonio->calificacion) && $i <= $testimonio->calificacion)
                                    <i data-lucide="star" fill="currentColor"></i>
                                @else
                                    <i data-lucide="star"></i>
                                @endif
                            @endfor
                        </div>
                        <p class="testimonial-text">
                            "{{ Str::limit($testimonio->comentario ?? ($testimonio->mensaje ?? 'Excelente servicio'), 100) }}"
                        </p>
                        <div class="testimonial-author">
                            <img src="{{ isset($testimonio->cliente) && $testimonio->cliente->foto ? asset('storage/' . $testimonio->cliente->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($testimonio->cliente->nombre ?? ($testimonio->nombre ?? 'C')) . '&background=F5DC5B&color=000' }}"
                                alt="{{ $testimonio->cliente->nombre ?? ($testimonio->nombre ?? 'Cliente') }}"
                                class="author-avatar"
                                onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($testimonio->cliente->nombre ?? ($testimonio->nombre ?? 'C')) }}&background=F5DC5B&color=000'">
                            <div class="author-info">
                                <h4>{{ $testimonio->cliente->nombre ?? ($testimonio->nombre ?? 'Cliente') }}</h4>
                                <span>Cliente Verificado</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p style="grid-column:1/-1;text-align:center;color:var(--text-muted)">Próximamente testimonios de
                        clientes</p>
                @endforelse
            </div>

            @if ($count >= 3 && $testimonios->count() > 3)
                <div class="see-more-wrapper">
                    <a href="#testimonios" class="btn-see-more"
                        onclick="event.preventDefault(); alert('Próximamente: Más opiniones de clientes');">
                        <i data-lucide="arrow-down"></i> Ver más testimonios
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section class="contact" id="contacto">
        <div class="container">
            <div class="section-header reveal">
                <span class="section-tag">Contacto</span>
                <h2 class="section-title">Visítanos o <span>Escríbenos</span></h2>
                <p class="section-subtitle">Estamos aquí para ayudarte a lucir tu mejor estilo</p>
            </div>

            <div class="contact-wrapper">
                <!-- INFO -->
                <div class="contact-info reveal">
                    <h3>Información de Contacto</h3>
                    <p>Visítanos en nuestra barbería o contáctanos para reservar tu cita.</p>

                    <div class="contact-details">
                        <div class="contact-item">
                            <div class="contact-icon"><i data-lucide="map-pin"></i></div>
                            <div class="contact-text">
                                <h4>Dirección</h4>
                                <p>Jirón Independencia, Coishco</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon"><i data-lucide="phone"></i></div>
                            <div class="contact-text">
                                <h4>Teléfono</h4>
                                <p>925 331 657</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon"><i data-lucide="clock"></i></div>
                            <div class="contact-text">
                                <h4>Horario</h4>
                                <p>Lun a Dom<br>10:00 AM - 10:00 PM</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon"><i data-lucide="mail"></i></div>
                            <div class="contact-text">
                                <h4>Email</h4>
                                <p>contacto@barberia.com</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FORMULARIO -->
                <div class="contact-form reveal">
                    <form action="{{ route('contactos.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <input type="text" name="nombre" required placeholder="Tu nombre completo">
                        </div>
                        <div class="form-group">
                            <label>Correo Electrónico</label>
                            <input type="email" name="correo" required placeholder="correo@gmail.com">
                        </div>
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="text" name="telefono" placeholder="987654321">
                        </div>
                        <div class="form-group">
                            <label>Mensaje</label>
                            <textarea name="mensaje" required placeholder="Escribe tu mensaje"></textarea>
                        </div>
                        <button type="submit" class="submit-btn">
                            <i data-lucide="send"></i> Enviar Mensaje
                        </button>
                    </form>
                </div>
            </div>

            <div class="map-container reveal">
                <iframe src="https://www.google.com/maps?q=Jiron+Independencia,+Coishco,+Santa,+Ancash,+Peru&output=embed"
                    allowfullscreen loading="lazy">
                </iframe>
            </div>
        </div>
    </section>

@endsection
