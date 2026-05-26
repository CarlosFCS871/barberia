@extends('layouts.public')
@section('title', 'Iniciar Sesión')

@section('contenidoPublico')
<style>
    /* ================= LOGIN STYLES - SOLO PARA ESTA VISTA ================= */
    :root {
        --login-bg-card: rgba(15, 15, 15, 0.95);
        --login-bg-input: #111111;
        --login-border: rgba(245, 220, 91, 0.2);
        --login-border-focus: rgba(245, 220, 91, 0.6);
        --login-gold-glow: rgba(245, 220, 91, 0.3);
        --login-danger: #ef4444;
        --login-success: #22c55e;
        --login-radius: 16px;
        --login-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .login-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: calc(100vh - 300px); /* Ajusta según altura de navbar+footer */
        padding: 2rem 1rem;
        position: relative;
        z-index: 1;
    }

    .login-container {
        width: 100%;
        max-width: 450px;
        animation: slideUp 0.5s ease forwards;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .login-card {
        background: var(--login-bg-card);
        backdrop-filter: blur(20px);
        border: 1px solid var(--login-border);
        border-radius: var(--login-radius);
        padding: 3rem 2.5rem;
        box-shadow: 0 8px 32px rgba(0,0,0,0.5), 0 0 0 1px rgba(245,220,91,0.1);
        position: relative;
        overflow: hidden;
    }

    .login-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }

    .login-header { text-align: center; margin-bottom: 2.5rem; }
    
    .login-logo {
        margin-bottom: 1.5rem;
        display: flex;
        justify-content: center;
        animation: float 3s ease-in-out infinite;
    }
    
    .logo-img {
        width: 110px;
        height: auto;
        max-height: 110px;
        object-fit: contain;
        filter: drop-shadow(0 0 12px rgba(245, 220, 91, 0.4));
        transition: transform 0.3s ease;
    }
    
    .login-logo:hover .logo-img { transform: scale(1.05); }
    
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }

    .login-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--gold);
        margin-bottom: 0.5rem;
        letter-spacing: 1px;
    }

    .login-subtitle { color: var(--text-muted); font-size: 0.9rem; }

    .form-group { margin-bottom: 1.5rem; position: relative; }
    
    .form-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 0.5rem;
        transition: var(--login-transition);
    }

    .form-input {
        width: 100%;
        padding: 1rem 1.2rem;
        background: var(--login-bg-input);
        border: 1px solid var(--login-border);
        border-radius: 12px;
        color: var(--text);
        font-size: 0.95rem;
        transition: var(--login-transition);
        min-height: 52px;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--gold);
        box-shadow: 0 0 0 4px var(--login-gold-glow);
        transform: translateY(-1px);
    }

    .form-input::placeholder { color: var(--text-muted); opacity: 0.5; }

    .form-error {
        color: var(--login-danger);
        font-size: 0.75rem;
        margin-top: 0.4rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
        animation: shake 0.3s ease;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-4px); }
        75% { transform: translateX(4px); }
    }

    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        cursor: pointer;
    }

    .remember-me input[type="checkbox"] {
        width: 18px;
        height: 18px;
        border-radius: 4px;
        border: 1px solid var(--login-border);
        background: var(--login-bg-input);
        accent-color: var(--gold);
        cursor: pointer;
        transition: var(--login-transition);
    }

    .remember-me span {
        color: var(--text-muted);
        font-size: 0.85rem;
        cursor: pointer;
        user-select: none;
    }

    .forgot-link {
        color: var(--gold);
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: var(--login-transition);
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .forgot-link:hover {
        color: var(--gold-hover);
        transform: translateX(2px);
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
        transition: var(--login-transition);
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
        top: 0; left: -100%; width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.5s;
    }

    .btn-submit:hover::before { left: 100%; }
    .btn-submit:hover {
        background: var(--gold-hover);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(245, 220, 91, 0.4);
    }
    .btn-submit:active { transform: translateY(0); }

    .status-message {
        background: rgba(34, 197, 94, 0.1);
        border: 1px solid rgba(34, 197, 94, 0.3);
        border-left: 4px solid var(--login-success);
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
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .decorative-line {
        position: absolute;
        bottom: 1.5rem;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 2px;
        background: var(--login-border);
        border-radius: 2px;
    }

    @media (max-width: 480px) {
        .login-card { padding: 2rem 1.5rem; }
        .login-title { font-size: 1.5rem; }
        .form-input { font-size: 1rem; }
        .logo-img { width: 90px; }
    }

    @media (prefers-reduced-motion: reduce) {
        * { animation: none !important; transition: none !important; }
    }
</style>

<div class="login-wrapper">
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Snyder Barber Logo" class="logo-img">
                </div>
                <h1 class="login-title">Snyder Barber</h1>
                <p class="login-subtitle">Inicia sesión en tu cuenta</p>
            </div>

            @if (session('status'))
                <div class="status-message">
                    <span>✓</span>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="form-input" placeholder="tu@email.com">
                    @error('email')<span class="form-error">⚠️ {{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password" class="form-input" placeholder="••••••••">
                    @error('password')<span class="form-error">⚠️ {{ $message }}</span>@enderror
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" id="remember_me" name="remember">
                        <span>Recordarme</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                    @endif
                </div>

                <button type="submit" class="btn-submit">
                    <span>💈</span><span>Iniciar Sesión</span>
                </button>
            </form>

            <div class="decorative-line"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Animación suave para los inputs
    document.querySelectorAll('.form-input').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.querySelector('.form-label').style.color = 'var(--gold)';
        });
        input.addEventListener('blur', function() {
            this.parentElement.querySelector('.form-label').style.color = '';
        });
    });
});
</script>
@endsection