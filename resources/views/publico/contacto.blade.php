@extends('layouts.public')

@section('title', 'Contacto')

@section('contenidoPublico')

<style>
    /* ================= CONTACTO - Usa variables de tu layout público ================= */
    
    .contact-page {
        padding: 4rem 0;
        width: 100%;
    }

    .contact-header {
        text-align: center;
        padding: 0 1rem 3rem;
        border-bottom: 1px solid var(--border);
        margin-bottom: 3rem;
    }

    .contact-title {
        font-size: clamp(2rem, 4vw, 2.8rem);
        font-weight: 800;
        color: var(--text);
        margin: 0 0 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .contact-title::after {
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

    .contact-subtitle {
        color: var(--text-muted);
        font-size: 1.05rem;
        margin: 0;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    /* ================= ALERT SUCCESS ================= */
    .contact-alert {
        background: rgba(34, 197, 94, 0.15);
        border: 1px solid rgba(34, 197, 94, 0.3);
        border-left: 4px solid var(--success);
        color: var(--success);
        padding: 1rem 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ================= CONTACT WRAPPER - 2 COLUMNS ================= */
    .contact-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        padding: 0 1rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Móvil: 1 columna */
    @media (max-width: 991px) {
        .contact-wrapper { grid-template-columns: 1fr; }
    }

    /* ================= INFO CARD ================= */
    .contact-info-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 2rem;
        height: fit-content;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .contact-info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--gold), transparent);
    }

    .contact-info-card:hover {
        border-color: var(--gold);
        box-shadow: 0 12px 40px var(--gold-glow);
    }

    .contact-info-card h3 {
        color: var(--text);
        font-size: 1.4rem;
        font-weight: 700;
        margin: 0 0 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--border);
    }

    .contact-info-card > p {
        color: var(--text-muted);
        line-height: 1.7;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    /* ================= INFO ITEMS ================= */
    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 1rem;
        background: var(--bg-dark);
        border-radius: 12px;
        margin-bottom: 0.75rem;
        transition: var(--transition);
    }

    .info-item:last-child { margin-bottom: 0; }
    
    .info-item:hover {
        background: rgba(245, 220, 91, 0.05);
        transform: translateX(4px);
    }

    .info-icon {
        width: 36px;
        height: 36px;
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gold);
        flex-shrink: 0;
        font-size: 1.1rem;
    }

    .info-content strong {
        color: var(--gold);
        display: block;
        margin-bottom: 0.25rem;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .info-content p,
    .info-content span {
        color: var(--text-muted);
        margin: 0;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .info-content a {
        color: var(--gold);
        text-decoration: none;
        transition: var(--transition);
    }

    .info-content a:hover {
        color: var(--gold-hover);
    }

    /* ================= SOCIAL LINKS ================= */
    .contact-social {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border);
    }

    .social-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--bg-dark);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        text-decoration: none;
        transition: var(--transition);
        font-size: 1.1rem;
    }

    .social-btn:hover {
        background: var(--gold);
        border-color: var(--gold);
        color: #000;
        transform: translateY(-3px);
    }

    /* ================= FORM CARD ================= */
    .contact-form-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 2rem;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .contact-form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--gold), transparent);
    }

    .contact-form-card:hover {
        border-color: var(--gold);
        box-shadow: 0 12px 40px var(--gold-glow);
    }

    .contact-form-card h3 {
        color: var(--text);
        font-size: 1.4rem;
        font-weight: 700;
        margin: 0 0 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--border);
    }

    /* ================= FORM ================= */
    .contact-form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    @media (max-width: 576px) {
        .form-row { grid-template-columns: 1fr; }
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .form-group label {
        color: var(--text-muted);
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    .form-control {
        width: 100%;
        background: var(--bg-dark);
        border: 1px solid var(--border);
        color: var(--text);
        padding: 0.9rem 1rem;
        border-radius: 10px;
        font-size: 0.95rem;
        font-family: inherit;
        transition: var(--transition);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--gold);
        box-shadow: 0 0 0 4px var(--gold-glow);
        transform: translateY(-1px);
    }

    .form-control::placeholder {
        color: var(--text-muted);
        opacity: 0.6;
    }

    textarea.form-control {
        min-height: 140px;
        resize: vertical;
    }

    /* ================= SUBMIT BUTTON ================= */
    .btn-contact {
        width: 100%;
        border: none;
        background: var(--gold);
        color: #000;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    .btn-contact:hover {
        background: var(--gold-hover);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px var(--gold-glow);
    }

    .btn-contact:active {
        transform: translateY(0);
    }

    /* ================= MAP ================= */
    .map-container {
        margin-top: 3rem;
        border-radius: var(--radius);
        overflow: hidden;
        border: 1px solid var(--border);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
    }

    .map-container iframe {
        width: 100%;
        height: 400px;
        border: none;
        display: block;
    }

    @media (max-width: 768px) {
        .map-container iframe { height: 300px; }
    }

    @media (prefers-reduced-motion: reduce) {
        * { animation: none !important; transition: none !important; }
    }
</style>

<div class="contact-page">
    <div class="container">
        
        <!-- HEADER -->
        <div class="contact-header">
            <h1 class="contact-title">📞 Contáctanos</h1>
            <p class="contact-subtitle">Estamos listos para ayudarte y brindarte la mejor atención.</p>
        </div>

        <!-- ALERT SUCCESS (TU LÓGICA ORIGINAL) -->
        @if (session('success'))
            <div class="contact-alert">
                <span>✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- CONTACT WRAPPER -->
        <div class="contact-wrapper">
            
            {{-- INFORMACIÓN --}}
            <div class="contact-info-card">
                <h3>💈 Información de la Barbería</h3>
                <p>Puedes visitarnos, escribirnos o llamarnos para reservar tus citas y conocer nuestros servicios.</p>

                <div class="info-item">
                    <div class="info-icon">📍</div>
                    <div class="info-content">
                        <strong>Dirección</strong>
                        <span>Jirón Independencia, Coishco</span>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">📞</div>
                    <div class="info-content">
                        <strong>Teléfono</strong>
                        <span><a href="tel:+51925331657">925 331 657</a></span>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">📧</div>
                    <div class="info-content">
                        <strong>Correo</strong>
                        <span><a href="mailto:contacto@barberia.com">contacto@barberia.com</a></span>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">🕒</div>
                    <div class="info-content">
                        <strong>Horario</strong>
                        <span>Lunes a Domingo<br>10:00 AM - 10:00 PM</span>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="contact-social">
                    <a href="#" class="social-btn" title="Facebook">📘</a>
                    <a href="#" class="social-btn" title="Instagram">📷</a>
                    <a href="#" class="social-btn" title="WhatsApp">💬</a>
                    <a href="#" class="social-btn" title="TikTok">🎵</a>
                </div>
            </div>

            {{-- FORMULARIO (TU LÓGICA ORIGINAL) --}}
            <div class="contact-form-card">
                <h3>✉️ Envíanos un Mensaje</h3>

                <form action="/contacto/enviar" method="POST" class="contact-form">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombre">Nombre Completo</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required placeholder="Tu nombre">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" id="telefono" name="telefono" class="form-control" placeholder="987654321">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="correo">Correo Electrónico</label>
                        <input type="email" id="correo" name="correo" class="form-control" required placeholder="tu@email.com">
                    </div>

                    <div class="form-group">
                        <label for="mensaje">Mensaje</label>
                        <textarea id="mensaje" name="mensaje" class="form-control" required placeholder="¿En qué podemos ayudarte?"></textarea>
                    </div>

                    <button type="submit" class="btn-contact">
                        🚀 Enviar Mensaje
                    </button>
                </form>
            </div>

        </div>

        <!-- MAP (TU LÓGICA ORIGINAL) -->
        <div class="map-container">
            <iframe src="https://www.google.com/maps?q=Jiron+Independencia,+Coishco,+Santa,+Ancash,+Peru&output=embed" allowfullscreen loading="lazy"></iframe>
        </div>

    </div>
</div>

@endsection