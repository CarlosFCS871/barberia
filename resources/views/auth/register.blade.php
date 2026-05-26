@extends('layouts.public')
@section('title', 'Crear Cuenta')

@section('contenidoPublico')
<style>
    /* ================= REGISTER STYLES - SOLO PARA ESTA VISTA ================= */
    :root {
        --reg-bg-card: rgba(15, 15, 15, 0.95);
        --reg-bg-input: #111111;
        --reg-border: rgba(245, 220, 91, 0.2);
        --reg-border-focus: rgba(245, 220, 91, 0.6);
        --reg-gold-glow: rgba(245, 220, 91, 0.3);
        --reg-danger: #ef4444;
        --reg-radius: 16px;
        --reg-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .register-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: calc(100vh - 300px);
        padding: 2rem 1rem;
        position: relative;
        z-index: 1;
    }

    .register-container {
        width: 100%;
        max-width: 480px;
        animation: slideUp 0.5s ease forwards;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .register-card {
        background: var(--reg-bg-card);
        backdrop-filter: blur(20px);
        border: 1px solid var(--reg-border);
        border-radius: var(--reg-radius);
        padding: 2.5rem;
        box-shadow: 0 8px 32px rgba(0,0,0,0.5), 0 0 0 1px rgba(245,220,91,0.1);
        position: relative;
        overflow: hidden;
    }

    .register-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }

    .register-header { text-align: center; margin-bottom: 2rem; }
    
    .register-logo {
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
    
    .register-logo:hover .logo-img { transform: scale(1.05); }
    
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }

    .register-title {
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--gold);
        margin-bottom: 0.4rem;
        letter-spacing: 1px;
    }

    .register-subtitle { color: var(--text-muted); font-size: 0.9rem; }

    .form-group { margin-bottom: 1.25rem; position: relative; }
    
    .form-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 0.4rem;
        transition: var(--reg-transition);
    }

    .form-input {
        width: 100%;
        padding: 0.9rem 1.1rem;
        background: var(--reg-bg-input);
        border: 1px solid var(--reg-border);
        border-radius: 12px;
        color: var(--text);
        font-size: 0.95rem;
        transition: var(--reg-transition);
        min-height: 50px;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--gold);
        box-shadow: 0 0 0 4px var(--reg-gold-glow);
        transform: translateY(-1px);
    }

    .form-input::placeholder { color: var(--text-muted); opacity: 0.5; }

    .form-error {
        color: var(--reg-danger);
        font-size: 0.75rem;
        margin-top: 0.35rem;
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

    .register-footer {
        display: flex;
        justify-content: center;
        margin-bottom: 1.5rem;
    }

    .register-link {
        color: var(--gold);
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: var(--reg-transition);
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .register-link:hover {
        color: var(--gold-hover);
        transform: translateX(2px);
    }

    .btn-register {
        width: 100%;
        padding: 1rem 1.5rem;
        background: var(--gold);
        color: #000;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.95rem;
        cursor: pointer;
        transition: var(--reg-transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        position: relative;
        overflow: hidden;
        min-height: 50px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-register::before {
        content: '';
        position: absolute;
        top: 0; left: -100%; width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.5s;
    }

    .btn-register:hover::before { left: 100%; }
    .btn-register:hover {
        background: var(--gold-hover);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(245, 220, 91, 0.4);
    }
    .btn-register:active { transform: translateY(0); }

    .decorative-line {
        position: absolute;
        bottom: 1.2rem;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 2px;
        background: var(--reg-border);
        border-radius: 2px;
    }

    @media (max-width: 480px) {
        .register-card { padding: 2rem 1.5rem; }
        .register-title { font-size: 1.4rem; }
        .form-input { font-size: 1rem; }
        .logo-img { width: 85px; }
    }

    @media (prefers-reduced-motion: reduce) {
        * { animation: none !important; transition: none !important; }
    }
</style>

<div class="register-wrapper">
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <div class="register-logo">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Snyder Barber Logo" class="logo-img">
                </div>
                <h1 class="register-title">Snyder Barber</h1>
                <p class="register-subtitle">Crea tu cuenta profesional</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name" class="form-label">Nombre Completo</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="form-input" placeholder="Ej: Carlos Méndez">
                    @error('name') <span class="form-error">⚠️ {{ $message }}</span> @enderror
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="form-input" placeholder="tu@email.com">
                    @error('email') <span class="form-error">⚠️ {{ $message }}</span> @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" id="password" name="password" required autocomplete="new-password" class="form-input" placeholder="••••••••">
                    @error('password') <span class="form-error">⚠️ {{ $message }}</span> @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" class="form-input" placeholder="••••••••">
                    @error('password_confirmation') <span class="form-error">⚠️ {{ $message }}</span> @enderror
                </div>

                <div class="register-footer">
                    <a class="register-link" href="{{ route('login') }}">
                        ← ¿Ya tienes cuenta? Inicia sesión
                    </a>
                </div>

                <button type="submit" class="btn-register">
                    <span>✂️</span>
                    <span>Crear Cuenta</span>
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