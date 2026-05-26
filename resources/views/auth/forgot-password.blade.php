<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Recuperar Contraseña') }} - Snyder Barber</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg-dark: #0a0a0a;
            --bg-card: rgba(15, 15, 15, 0.95);
            --bg-input: #111111;
            --border: rgba(245, 220, 91, 0.2);
            --border-focus: rgba(245, 220, 91, 0.6);
            --text: #f8fafc;
            --text-muted: #94a3b8;
            --gold: #F5DC5B;
            --gold-hover: #e6c94a;
            --gold-glow: rgba(245, 220, 91, 0.3);
            --danger: #ef4444;
            --success: #22c55e;
            --radius: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background: var(--bg-dark);
            background-image:
                radial-gradient(ellipse at top, rgba(245, 220, 91, 0.1) 0%, transparent 50%),
                radial-gradient(ellipse at bottom, rgba(245, 220, 91, 0.05) 0%, transparent 50%),
                repeating-linear-gradient(45deg, transparent 0, transparent 40px, rgba(255, 255, 255, 0.02) 40px, rgba(255, 255, 255, 0.02) 80px);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '✂️';
            position: fixed;
            top: 2rem;
            right: 3rem;
            font-size: 5rem;
            color: var(--gold);
            opacity: 0.04;
            pointer-events: none;
            transform: rotate(-15deg);
            z-index: 0;
        }

        body::after {
            content: '💈';
            position: fixed;
            bottom: 2rem;
            left: 3rem;
            font-size: 4rem;
            color: var(--gold);
            opacity: 0.04;
            pointer-events: none;
            transform: rotate(15deg);
            z-index: 0;
        }

        .auth-container {
            width: 100%;
            max-width: 460px;
            position: relative;
            z-index: 1;
            animation: slideUp 0.5s ease forwards;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-card {
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 2.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(245, 220, 91, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.05);
            position: relative;
            overflow: hidden;
        }

        .auth-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-logo {
            margin-bottom: 1.2rem;
            display: flex;
            justify-content: center;
            animation: float 3s ease-in-out infinite;
        }

        .logo-img {
            width: 100px;
            height: auto;
            max-height: 100px;
            object-fit: contain;
            filter: drop-shadow(0 0 12px rgba(245, 220, 91, 0.4));
            transition: transform 0.3s ease;
        }

        .auth-logo:hover .logo-img {
            transform: scale(1.05);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .auth-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--gold);
            margin-bottom: 0.4rem;
            letter-spacing: 1px;
        }

        .auth-subtitle {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .description-text {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.6;
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .status-message {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            border-left: 4px solid var(--success);
            color: var(--text);
            padding: 0.85rem 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 0.4rem;
            transition: var(--transition);
        }

        .form-input {
            width: 100%;
            padding: 0.95rem 1.1rem;
            background: var(--bg-input);
            border: 1px solid var(--border);
            border-radius: 12px;
            color: var(--text);
            font-size: 0.95rem;
            transition: var(--transition);
            min-height: 52px;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 4px var(--gold-glow);
            transform: translateY(-1px);
        }

        .form-input::placeholder {
            color: var(--text-muted);
            opacity: 0.5;
        }

        .form-error {
            color: var(--danger);
            font-size: 0.75rem;
            margin-top: 0.35rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            animation: shake 0.3s ease;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-4px);
            }

            75% {
                transform: translateX(4px);
            }
        }

        .btn-submit {
            width: 100%;
            padding: 1rem 1.5rem;
            background: var(--gold);
            color: #000;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
            min-height: 52px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s;
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:hover {
            background: var(--gold-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(245, 220, 91, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: var(--gold);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: var(--transition);
        }

        .back-link:hover {
            color: var(--gold-hover);
            transform: translateX(-3px);
        }

        .decorative-line {
            position: absolute;
            bottom: 1.2rem;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 2px;
            background: var(--border);
            border-radius: 2px;
        }

        @media (max-width: 480px) {
            body {
                padding: 1rem;
            }

            .auth-card {
                padding: 2rem 1.5rem;
            }

            .auth-title {
                font-size: 1.4rem;
            }

            .form-input {
                font-size: 1rem;
            }

            .logo-img {
                width: 85px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            * {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-logo">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Snyder Barber Logo" class="logo-img">
                </div>
                <h1 class="auth-title">¿Olvidaste tu contraseña?</h1>
                <p class="auth-subtitle">No te preocupes, te ayudamos a recuperarla</p>
            </div>

            <p class="description-text">
                {{ __('Ingresa tu correo electrónico y te enviaremos un enlace seguro para restablecer tu contraseña y elegir una nueva.') }}
            </p>

            <!-- Session Status -->
            @if (session('status'))
                <div class="status-message">
                    <span>✓</span>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="form-input" placeholder="tu@email.com">
                    @error('email')
                        <span class="form-error">⚠️ {{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">
                    <span>📧</span>
                    <span>{{ __('Email Password Reset Link') }}</span>
                </button>
            </form>

            <a href="{{ route('login') }}" class="back-link">← Volver al inicio de sesión</a>

            <div class="decorative-line"></div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('.form-label').style.color = 'var(--gold)';
            });
            input.addEventListener('blur', function() {
                this.parentElement.querySelector('.form-label').style.color = '';
            });
        });
    </script>
</body>

</html>
