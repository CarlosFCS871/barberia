@extends('layouts.admin')
@section('title', 'Mi Perfil')
@section('AdminContenido')
    <style>
        /* ================= VARIABLES - SISTEMA CONSISTENTE ================= */
        :root {
            --sb-bg: #000000;
            --sb-card: #0a0a0a;
            --sb-border: rgba(255, 255, 255, 0.08);
            --sb-text: #ffffff;
            --sb-muted: #a1a1aa;
            --sb-accent: #F5DC5B;
            --sb-accent-hover: #e6c94a;
            --sb-accent-soft: rgba(245, 220, 91, 0.12);
            --sb-red: #ef4444;
            --sb-green: #22c55e;
            --sb-radius: 16px;
            --sb-transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [data-theme="light"] {
            --sb-bg: #f8f9fa;
            --sb-card: #ffffff;
            --sb-border: #e5e7eb;
            --sb-text: #0a0a0a;
            --sb-muted: #4b5563;
            --sb-accent: #b89600;
            --sb-accent-hover: #a38500;
            --sb-accent-soft: rgba(245, 220, 91, 0.18);
            --sb-red: #dc2626;
            --sb-green: #16a34a;
        }

        /* ================= BASE ================= */
        .perfil-container {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: var(--sb-text);
            padding: 1rem;
            max-width: 900px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }

        .perfil-container *,
        .perfil-container *::before,
        .perfil-container *::after {
            box-sizing: border-box;
            max-width: 100%;
        }

        /* ================= HEADER ================= */
        .perfil-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--sb-border);
        }

        .perfil-header h1 {
            font-size: clamp(1.3rem, 3vw, 1.8rem);
            font-weight: 800;
            margin: 0;
            color: var(--sb-text);
        }

        .perfil-header p {
            color: var(--sb-muted);
            margin: 0.4rem 0 0;
            font-size: 0.9rem;
        }

        /* ================= PROFILE CARD ================= */
        .perfil-card {
            background: var(--sb-card);
            border: 1px solid var(--sb-border);
            border-radius: var(--sb-radius);
            padding: 2rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            transition: var(--sb-transition);
        }

        .perfil-card:hover {
            border-color: var(--sb-accent-soft);
        }

        /* ================= AVATAR SECTION ================= */
        .perfil-avatar-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--sb-border);
            margin-bottom: 1.5rem;
        }

        .perfil-avatar {
            position: relative;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid var(--sb-accent);
            background: var(--sb-bg);
            margin-bottom: 1rem;
        }

        .perfil-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .avatar-label {
            font-size: 0.85rem;
            color: var(--sb-muted);
            text-align: center;
        }

        /* ================= FORM GRID ================= */
        .perfil-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.25rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--sb-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-input {
            padding: 0.75rem 1rem;
            background: var(--sb-bg);
            border: 1px solid var(--sb-border);
            border-radius: 10px;
            color: var(--sb-text);
            font-size: 0.95rem;
            transition: var(--sb-transition);
            width: 100%;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--sb-accent);
            box-shadow: 0 0 0 3px var(--sb-accent-soft);
        }

        .form-input::placeholder {
            color: var(--sb-muted);
            opacity: 0.6;
        }

        .form-input[type="file"] {
            padding: 0.5rem;
            cursor: pointer;
        }

        .error-msg {
            color: var(--sb-red);
            font-size: 0.75rem;
            margin-top: 0.15rem;
            display: block;
            font-weight: 500;
        }

        /* ================= FORM ACTIONS ================= */
        .form-actions {
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            border-top: 1px solid var(--sb-border);
        }

        .btn-submit {
            padding: 0.75rem 1.75rem;
            background: var(--sb-accent);
            color: #000;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: var(--sb-transition);
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-submit:hover {
            background: var(--sb-accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(245, 220, 91, 0.25);
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 768px) {
            .perfil-container {
                padding: 0.75rem;
            }

            .perfil-card {
                padding: 1.5rem;
            }

            .perfil-form {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-submit {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .perfil-container {
                padding: 0.5rem;
            }

            .perfil-header h1 {
                font-size: 1.3rem;
            }

            .perfil-card {
                padding: 1.25rem;
            }

            .perfil-avatar {
                width: 100px;
                height: 100px;
            }
        }

        /* ================= TOUCH OPTIMIZATIONS ================= */
        @media (hover: none) and (pointer: coarse) {

            .form-input,
            .btn-submit {
                min-height: 48px !important;
            }

            input {
                font-size: 16px !important;
            }
        }
    </style>

    <div class="perfil-container">
        <header class="perfil-header">
            <h1>👤 Mi Perfil</h1>
            <p>Actualiza tu información personal y configuración de cuenta</p>
        </header>
        <div class="perfil-card">
            {{-- FOTO --}}
            <div class="perfil-avatar-section">
                <div class="perfil-avatar">
                    @if ($user->foto)
                        <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto de perfil"
                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->nombre ?? 'U') }}&background=F5DC5B&color=000&size=240'">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nombre ?? 'U') }}&background=F5DC5B&color=000&size=240"
                            alt="Avatar por defecto">
                    @endif
                </div>
                <span class="avatar-label">Foto de perfil</span>
            </div>

            {{-- FORM EDIT - LOGICA INTACTA --}}
            <form action="{{ route('admin.perfil.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="perfil-form">
                    <div class="form-group">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-input" value="{{ $user->nombre }}"
                            placeholder="Nombre" required>
                        @error('nombre')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Apellido</label>
                        <input type="text" name="apellido" class="form-input" value="{{ $user->apellido }}"
                            placeholder="Apellido" required>
                        @error('apellido')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-input" value="{{ $user->email }}"
                            placeholder="Email" required>
                        @error('email')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-input" value="{{ $user->telefono }}"
                            placeholder="Teléfono">
                        @error('telefono')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nueva Contraseña</label>
                        <input type="password" name="password" class="form-input"
                            placeholder="Dejar vacío para mantener la actual">
                        @error('password')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Cambiar Foto</label>
                        <input type="file" name="foto" class="form-input" accept="image/png, image/jpeg, image/webp">
                        @error('foto')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">💾 Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
@endsection
