<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Snyder Barber - Tu estilo comienza aquí. Barbería premium con los mejores profesionales.">
    <title>Snyder Barber | @yield('title')</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logo.ico') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        /* ================= VARIABLES & RESET ================= */
        :root {
            --gold: #F7F7F7;
            --gold-hover: #e6c94a;
            --gold-glow: rgba(245, 220, 91, 0.3);
            --bg-dark: #0a0a0a;
            --bg-card: rgba(15, 15, 15, 0.85);
            --bg-glass: rgba(15, 15, 15, 0.6);
            --text: #f8fafc;
            --text-muted: #94a3b8;
            --border: rgba(245, 220, 91, 0.2);
            --success: #22c55e;
            --danger: #ef4444;
            --radius: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --font: 'Plus Jakarta Sans', system-ui, sans-serif;
            --card-max-width: 380px
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        html {
            scroll-behavior: smooth
        }

        body {
            font-family: var(--font);
            background: var(--bg-dark);
            color: var(--text);
            line-height: 1.6;
            overflow-x: hidden
        }

        /* ================= LOADER ================= */
        .loader {
            position: fixed;
            inset: 0;
            background: var(--bg-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease
        }

        .loader.hidden {
            opacity: 0;
            pointer-events: none
        }

        .loader-content {
            text-align: center
        }

        .loader-icon {
            width: 60px;
            height: 60px;
            border: 3px solid var(--border);
            border-top-color: var(--gold);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem
        }

        @keyframes spin {
            to {
                transform: rotate(360deg)
            }
        }

        .loader-text {
            color: var(--gold);
            font-weight: 700;
            letter-spacing: 2px
        }

        /* ================= SCROLL TO TOP ================= */
        .scroll-top {
            position: fixed;
            bottom: 100px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: var(--gold);
            color: #000000;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .scroll-top.visible {
            opacity: 1;
            visibility: visible
        }

        .scroll-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px var(--gold-glow)
        }

        /* ================= WHATSAPP FLOAT ================= */
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: #25d366;
            color: #fff;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            animation: pulse 2s infinite
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4)
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1)
            }

            50% {
                transform: scale(1.05)
            }
        }

        /* ================= NAVBAR ================= */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #000000;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            z-index: 1000;
            padding: 1rem 0;
            transition: var(--transition)
        }

        .navbar.scrolled {
            padding: 0.6rem 0;
            background: rgba(0, 0, 0, 0.95)
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--gold);
            text-decoration: none;
            letter-spacing: 1px
        }

        .nav-logo img {
            width: 40px;
            height: 40px;
            object-fit: contain
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none
        }

        .nav-link {
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: var(--transition);
            position: relative
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gold);
            transition: width 0.3s ease
        }

        .nav-link:hover {
            color: var(--gold)
        }

        .nav-link:hover::after {
            width: 100%
        }

        .nav-buttons {
            display: flex;
            gap: 1rem
        }

        .btn {
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            cursor: pointer;
            border: none;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--gold);
            color: var(--gold)
        }

        .btn-outline:hover {
            background: var(--gold);
            color: #000
        }

        .btn-primary {
            background: var(--gold);
            color: #000
        }

        .btn-primary:hover {
            background: var(--gold-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px var(--gold-glow)
        }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 0.5rem
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background: var(--gold);
            transition: var(--transition);
            border-radius: 3px
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px)
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px)
        }

        /* ================= HERO ================= */
        .hero {
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: linear-gradient(135deg, rgba(10, 10, 10, 0.9), rgba(10, 10, 10, 0.7)),
                url("{{ asset('images/portada.jpg') }}");
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            /* Opcional: efecto parallax */
            padding: 8rem 2rem 4rem;
            text-align: center;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at center, transparent 0%, rgba(10, 10, 10, 0.6) 100%);
            pointer-events: none;
            /* Permite clicks a través del overlay */
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 900px;
            width: 100%;
            padding: 0 1rem;
        }

        .hero-badge {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            background: var(--gold-glow);
            color: var(--gold);
            border: 1px solid var(--gold);
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            animation: fadeInDown 0.8s ease
        }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.1;
            animation: fadeInUp 0.8s ease 0.2s backwards
        }

        .hero-title span {
            color: var(--gold)
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: var(--text-muted);
            margin-bottom: 2.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            animation: fadeInUp 0.8s ease 0.4s backwards
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 0.8s ease 0.6s backwards
        }

        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-top: 4rem;
            flex-wrap: wrap;
            animation: fadeInUp 0.8s ease 0.8s backwards
        }

        .stat-item {
            text-align: center
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--gold);
            display: block;
            line-height: 1
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 0.9rem
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        /* ================= SECTIONS ================= */
        section {
            padding: 6rem 2rem
        }

        .container {
            max-width: 1200px;
            margin: 0 auto
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem
        }

        .section-tag {
            display: inline-block;
            padding: 0.4rem 1.2rem;
            background: var(--gold-glow);
            color: var(--gold);
            border: 1px solid var(--gold);
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px
        }

        .section-title {
            font-size: clamp(2rem, 3vw, 2.8rem);
            font-weight: 800;
            margin-bottom: 1rem
        }

        .section-title span {
            color: var(--gold)
        }

        .section-subtitle {
            color: var(--text-muted);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto
        }

        /* ================= GRID COMPACTO ================= */
        .grid-compact {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            justify-content: center
        }

        /* TABLET */
        @media (max-width: 992px) {

            .grid-compact {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        /* CELULAR */
        @media (max-width: 576px) {

            .grid-compact {
                grid-template-columns: 1fr;
            }

        }

        @media(max-width:768px) {
            .grid-compact {
                grid-template-columns: 1fr;
                max-width: 400px;
                margin: 0 auto
            }
        }

        /* ================= SERVICES ================= */
        .services {
            background: var(--bg-dark)
        }

        .service-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            transition: var(--transition);
            position: relative
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
            transition: transform 0.3s ease
        }

        .service-card:hover {
            transform: translateY(-8px);
            border-color: var(--gold);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4)
        }

        .service-card:hover::before {
            transform: scaleX(1)
        }

        .service-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s ease
        }

        .service-card:hover .service-image {
            transform: scale(1.05)
        }

        .service-content {
            padding: 1.25rem
        }

        .service-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.6rem
        }

        .service-name {
            font-size: 1.15rem;
            font-weight: 700
        }

        .service-price {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--gold)
        }

        .service-desc {
            color: var(--text-muted);
            margin-bottom: 1rem;
            font-size: 0.9rem
        }

        .service-btn {
            width: 100%;
            padding: 0.7rem;
            background: transparent;
            border: 1px solid var(--gold);
            color: var(--gold);
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.85rem
        }

        .service-btn:hover {
            background: var(--gold);
            color: #000
        }

        /* ================= PROMOTIONS ================= */
        .promotions {
            background: linear-gradient(180deg, var(--bg-dark), #0f0f0f)
        }

        .promo-card {
            background: var(--bg-card);
            border: 2px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            position: relative;
            transition: var(--transition)
        }

        .promo-card:hover {
            transform: translateY(-5px);
            border-color: var(--gold);
            box-shadow: 0 12px 40px rgba(245, 220, 91, 0.15)
        }

        .promo-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: var(--gold);
            color: #000;
            padding: 0.35rem 0.8rem;
            border-radius: 50px;
            font-weight: 800;
            font-size: 0.85rem;
            z-index: 2
        }

        .promo-image {
            width: 100%;
            height: 180px;
            object-fit: cover
        }

        .promo-content {
            padding: 1.25rem
        }

        .promo-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.4rem
        }

        .promo-desc {
            color: var(--text-muted);
            margin-bottom: 0.8rem;
            font-size: 0.9rem
        }

        .promo-date {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--text-muted);
            font-size: 0.8rem;
            margin-bottom: 1rem
        }

        .promo-btn {
            width: 100%;
            padding: 0.7rem;
            background: var(--gold);
            color: #000;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.85rem
        }

        .promo-btn:hover {
            background: var(--gold-hover);
            transform: translateY(-2px)
        }

        /* ================= BARBERS ================= */
        .barbers {
            background: var(--bg-dark)
        }

        .barber-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            text-align: center;
            transition: var(--transition)
        }

        .barber-card:hover {
            transform: translateY(-8px);
            border-color: var(--gold);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3)
        }

        .barber-image {
            width: 100%;
            height: 280px;
            object-fit: cover;
            object-position: top
        }

        .barber-content {
            padding: 1.25rem
        }

        .barber-name {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.2rem
        }

        .barber-specialty {
            color: var(--gold);
            font-weight: 600;
            margin-bottom: 0.4rem;
            font-size: 0.9rem
        }

        .barber-experience {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-bottom: 0.8rem
        }

        .barber-social {
            display: flex;
            justify-content: center;
            gap: 0.75rem
        }

        .social-link {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--bg-dark);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            transition: var(--transition);
            font-size: 0.8rem
        }

        .social-link:hover {
            background: var(--gold);
            border-color: var(--gold);
            color: #000;
            transform: translateY(-3px)
        }

        /* ================= TESTIMONIALS ================= */
        .testimonials {
            background: linear-gradient(180deg, #0f0f0f, var(--bg-dark))
        }

        .testimonial-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem;
            position: relative;
            transition: var(--transition)
        }

        .testimonial-card:hover {
            border-color: var(--gold);
            transform: translateY(-5px)
        }

        .testimonial-card::before {
            content: '"';
            position: absolute;
            top: 0.8rem;
            left: 1rem;
            font-size: 4rem;
            color: var(--gold);
            opacity: 0.15;
            font-family: serif;
            line-height: 1
        }

        .testimonial-stars {
            color: var(--gold);
            margin-bottom: 0.8rem;
            display: flex;
            gap: 2px
        }

        .testimonial-text {
            color: var(--text-muted);
            font-style: italic;
            margin-bottom: 1.2rem;
            line-height: 1.6;
            position: relative;
            z-index: 1;
            font-size: 0.95rem
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 0.8rem
        }

        .author-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--gold)
        }

        .author-info h4 {
            font-weight: 700;
            margin-bottom: 0.15rem;
            font-size: 0.95rem
        }

        .author-info span {
            color: var(--text-muted);
            font-size: 0.8rem
        }

        /* ================= CONTACT ================= */
        .contact {
            background: var(--bg-dark)
        }

        .contact-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: start
        }

        .contact-info h3 {
            font-size: 1.6rem;
            margin-bottom: 0.8rem
        }

        .contact-info>p {
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            font-size: 0.95rem
        }

        .contact-details {
            margin-bottom: 1.5rem
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 0.8rem;
            margin-bottom: 1.2rem
        }

        .contact-icon {
            width: 44px;
            height: 44px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            flex-shrink: 0
        }

        .contact-text h4 {
            font-weight: 600;
            margin-bottom: 0.2rem;
            font-size: 0.95rem
        }

        .contact-text p {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.5
        }

        .contact-form {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem
        }

        .form-group {
            margin-bottom: 1.2rem
        }

        .form-group label {
            display: block;
            margin-bottom: 0.4rem;
            font-weight: 500;
            font-size: 0.9rem
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem 0.9rem;
            background: var(--bg-dark);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text);
            font-family: var(--font);
            font-size: 0.9rem;
            transition: var(--transition)
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px var(--gold-glow)
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical
        }

        .submit-btn {
            width: 100%;
            padding: 0.9rem;
            background: var(--gold);
            color: #000;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem
        }

        .submit-btn:hover {
            background: var(--gold-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px var(--gold-glow)
        }

        /* ================= MAP ================= */
        .map-container {
            width: 100%;
            height: 350px;
            border-radius: var(--radius);
            overflow: hidden;
            border: 1px solid var(--border);
            margin-top: 3rem
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none
        }

        /* ================= SEE MORE BUTTON ================= */
        .see-more-wrapper {
            text-align: center;
            margin-top: 2.5rem
        }

        .btn-see-more {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.7rem 1.5rem;
            background: transparent;
            border: 2px solid var(--gold);
            color: var(--gold);
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition)
        }

        .btn-see-more:hover {
            background: var(--gold);
            color: #000;
            transform: translateY(-2px)
        }

        /* ================= FOOTER ================= */
        footer {
            background: #050505;
            border-top: 1px solid var(--border);
            padding: 4rem 2rem 2rem
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem
        }

        .footer-brand .nav-logo {
            margin-bottom: 1rem
        }

        .footer-brand p {
            color: var(--text-muted);
            line-height: 1.7
        }

        .footer-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--gold)
        }

        .footer-links {
            list-style: none
        }

        .footer-links li {
            margin-bottom: 0.75rem
        }

        .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            transition: var(--transition)
        }

        .footer-links a:hover {
            color: var(--gold);
            padding-left: 5px
        }

        .footer-social {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid var(--border);
            color: var(--text-muted);
            font-size: 0.9rem
        }

        /* ================= REVEAL ANIMATIONS ================= */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0)
        }

        /* ================= RESPONSIVE ================= */
        @media(max-width:968px) {
            .nav-menu {
                position: fixed;
                top: 70px;
                left: 0;
                right: 0;
                background: var(--bg-card);
                backdrop-filter: blur(12px);
                flex-direction: column;
                padding: 2rem;
                gap: 1.5rem;
                border-bottom: 1px solid var(--border);
                transform: translateY(-150%);
                transition: transform 0.3s ease;
                z-index: 999
            }

            .nav-menu.active {
                transform: translateY(0)
            }

            .hamburger {
                display: flex
            }

           .desktop-buttons {
    display: none;
}

            .hero-stats {
                gap: 2rem
            }

            .contact-wrapper {
                grid-template-columns: 1fr;
                gap: 2.5rem
            }

            .map-container {
                height: 300px
            }
        }

        @media(max-width:640px) {
            .hero {
                padding: 7rem 1.5rem 3rem
            }

            .hero-buttons {
                flex-direction: column;
                width: 100%
            }

            .hero-buttons .btn {
                width: 100%;
                justify-content: center
            }

            .hero-stats {
                flex-direction: column;
                gap: 1.5rem
            }

            section {
                padding: 4rem 1.5rem
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 2rem
            }

            :root {
                --card-max-width: 100%
            }
        }

        .mobile-buttons {
            display: none;
        }

        @media(max-width:968px) {

            .mobile-buttons {
                display: flex;
                flex-direction: column;
                width: 100%;
                gap: 1rem;
                margin-top: 1rem;
            }

            .mobile-buttons .btn {
                width: 100%;
                justify-content: center;
            }

        }
    </style>
</head>

<body>


    <!-- SCROLL TO TOP -->
    <button class="scroll-top" id="scrollTop" aria-label="Volver arriba">
        <i data-lucide="chevron-up"></i>
    </button>

    <!-- WHATSAPP FLOAT -->
    <a href="https://wa.link/12hcgw" class="whatsapp-float" target="_blank" rel="noopener"
        aria-label="Contactar por WhatsApp">
        <i data-lucide="message-circle"></i>
    </a>

    <!-- NAVBAR -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="" class="nav-logo">
                <img src="{{ asset('images/logo.jpg') }}" alt="Snyder Barber" onerror="this.style.display='none'">
                <span>Snyder Barber</span>
            </a>

            <ul class="nav-menu" id="navMenu">
                <li><a href="{{ route('welcome') }}" class="nav-link">Inicio</a></li>
                <li><a href="/servicios" class="nav-link">Servicios</a></li>
                <li><a href="/promociones" class="nav-link">Promociones</a></li>
                <li><a href="/barberos" class="nav-link">Barberos</a></li>
                <li><a href="/testimonios" class="nav-link">Testimonios</a></li>
                <li><a href="/contacto" class="nav-link">Contacto</a></li>

                @if (Route::has('login'))
                    <div class="nav-buttons">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                                <i data-lucide="layout-dashboard"></i> Mi panel
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline">
                                <i data-lucide="log-in"></i> Iniciar Sesión
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">
                                    <i data-lucide="user-plus"></i> Registrarse
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </ul>
           



            <div class="hamburger" id="hamburger" aria-label="Menú">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <section>
        @yield('contenidoPublico')
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="" class="nav-logo">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Snyder Barber"
                            onerror="this.style.display='none'">
                        <span>✂️ Snyder Barber</span>
                    </a>
                    <p>Tu estilo, nuestra pasión. Barbería premium comprometida con tu mejor versión desde 2016.</p>
                    <div class="footer-social">
                        <a href="#" class="social-link" aria-label="Facebook"><i data-lucide="facebook"></i></a>
                        <a href="#" class="social-link" aria-label="Instagram"><i data-lucide="instagram"></i></a>
                        <a href="#" class="social-link" aria-label="Twitter"><i data-lucide="twitter"></i></a>
                        <a href="#" class="social-link" aria-label="YouTube"><i data-lucide="youtube"></i></a>
                    </div>
                </div>
                <div class="footer-links-section">
                    <h4 class="footer-title">Links Rápidos</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('welcome') }}">Inicio</a></li>
                        <li><a href="/servicios">Servicios</a></li>
                        <li><a href="/promociones">Promociones</a></li>
                        <li><a href="/barberos">Barberos</a></li>
                        <li><a href="/testimonios">Testimonios</a></li>
                        <li><a href="/contacto">Contacto</a></li>
                    </ul>
                </div>
                <div class="footer-links-section">
                    <h4 class="footer-title">Servicios</h4>
                    <ul class="footer-links">
                        <li><a href="#">Corte Clásico</a></li>
                        <li><a href="#">Degradado</a></li>
                        <li><a href="#">Barba</a></li>
                        <li><a href="#">Corte + Barba</a></li>
                        <li><a href="#">Tratamientos</a></li>
                    </ul>
                </div>
                <div class="footer-links-section">
                    <h4 class="footer-title">Horarios</h4>
                    <ul class="footer-links">
                        <li>Lunes - Viernes: 9am - 8pm</li>
                        <li>Sábado: 10am - 7pm</li>
                        <li>Domingo: 10am - 6pm</li>
                        <li>Feriados: 10am - 4pm</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Snyder Barber. Todos los derechos reservados. | Diseñado con ✂️ y pasión
                </p>
            </div>
        </div>
    </footer>

    <!-- JAVASCRIPT -->
    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Loader
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('loader').classList.add('hidden');
            }, 1000);
        });

        // Navbar Scroll Effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });

        // Mobile Menu Toggle
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        hamburger?.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
        });
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                hamburger?.classList.remove('active');
                navMenu?.classList.remove('active');
            });
        });

        // Scroll to Top
        const scrollTopBtn = document.getElementById('scrollTop');
        window.addEventListener('scroll', () => {
            scrollTopBtn.classList.toggle('visible', window.scrollY > 500);
        });
        scrollTopBtn?.addEventListener('click', () => window.scrollTo({
            top: 0,
            behavior: 'smooth'
        }));

        // Scroll Reveal Animation
        const reveals = document.querySelectorAll('.reveal');
        const revealOnScroll = () => {
            reveals.forEach(el => {
                if (el.getBoundingClientRect().top < window.innerHeight - 150) {
                    el.classList.add('active');
                }
            });
        };
        window.addEventListener('scroll', revealOnScroll);
        revealOnScroll();

        // Smooth Scroll for Anchors
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const navHeight = navbar?.offsetHeight || 0;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset -
                        navHeight;
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Contact Form Handler (si no hay ruta real)
        document.querySelector('.contact-form form')?.addEventListener('submit', function(e) {
            // Si la ruta no existe, prevenir y mostrar mensaje
            if (!this.action || this.action.includes('#')) {
                e.preventDefault();
                const btn = this.querySelector('.submit-btn');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i data-lucide="check"></i> Mensaje Enviado';
                btn.style.background = 'var(--success)';
                lucide.createIcons();
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.style.background = '';
                    this.reset();
                    lucide.createIcons();
                }, 3000);
            }
        });

        // Service/Promo Buttons
        document.querySelectorAll('.service-btn, .promo-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('contacto')?.scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>
