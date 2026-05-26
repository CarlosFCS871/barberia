@extends('layouts.cliente')
@section('title', 'Mi Perfil')
@section('contenidoCliente')
<style>
    /* ================= VARIABLES - SISTEMA ORIGINAL ================= */
    :root{
        --sb-bg:#000000;--sb-card:#0a0a0a;--sb-border:rgba(255,255,255,0.08);
        --sb-text:#ffffff;--sb-muted:#a1a1aa;--sb-accent:#F5DC5B;
        --sb-accent-hover:#e6c94a;--sb-accent-soft:rgba(245,220,91,0.12);
        --sb-red:#ef4444;--sb-green:#22c55e;--sb-radius:16px;
        --sb-transition:all 0.25s cubic-bezier(0.4,0,0.2,1);
        --font:'Plus Jakarta Sans',system-ui,sans-serif
    }
    [data-theme="light"]{
        --sb-bg:#f8f9fa;--sb-card:#ffffff;--sb-border:#e5e7eb;
        --sb-text:#0a0a0a;--sb-muted:#4b5563;--sb-accent:#b89600;
        --sb-accent-hover:#a38500;--sb-accent-soft:rgba(245,220,91,0.18);
        --sb-red:#dc2626;--sb-green:#16a34a
    }

    /* ================= BASE ================= */
    .perfil-container{
        font-family:var(--font);color:var(--sb-text);padding:1.5rem;
        max-width:900px;margin:0 auto;width:100%;box-sizing:border-box;position:relative
    }
    .perfil-container::before{
        content:'';position:fixed;top:0;left:0;right:0;height:1px;
        background:linear-gradient(90deg,transparent,var(--sb-accent),transparent);
        opacity:0.3;pointer-events:none;z-index:0
    }
    .perfil-container *,.perfil-container *::before,.perfil-container *::after{box-sizing:border-box}

    /* ================= HEADER ================= */
    .perfil-header{
        margin-bottom:2.5rem;padding-bottom:1.25rem;
        border-bottom:1px solid var(--sb-border);position:relative
    }
    .perfil-header::after{
        content:'';position:absolute;bottom:-1px;left:0;
        width:120px;height:2px;background:var(--sb-accent);border-radius:2px
    }
    .perfil-header h1{
        font-size:clamp(1.4rem,3vw,2rem);font-weight:800;margin:0;
        color:var(--sb-text);display:flex;align-items:center;gap:0.75rem
    }
    .perfil-header h1::before{content:'👤';font-size:1.5rem}
    .perfil-header p{color:var(--sb-muted);margin:0.5rem 0 0;font-size:0.95rem;line-height:1.5}

    /* ================= CARD ================= */
    .perfil-card{
        background:var(--sb-card);border:1px solid var(--sb-border);
        border-radius:var(--sb-radius);padding:2.5rem;
        box-shadow:0 8px 32px rgba(0,0,0,0.4);transition:var(--sb-transition);
        position:relative;overflow:hidden
    }
    .perfil-card::before{
        content:'';position:absolute;top:0;left:0;right:0;height:3px;
        background:linear-gradient(90deg,var(--sb-accent),transparent 60%)
    }
    .perfil-card:hover{
        border-color:var(--sb-accent-soft);
        box-shadow:0 12px 48px rgba(245,220,91,0.15)
    }

    /* ================= AVATAR ================= */
    .perfil-avatar-section{
        display:flex;flex-direction:column;align-items:center;
        padding-bottom:2rem;border-bottom:1px solid var(--sb-border);
        margin-bottom:2rem;position:relative
    }
    .perfil-avatar-section::after{
        content:'';position:absolute;bottom:-1px;left:50%;
        transform:translateX(-50%);width:80px;height:2px;
        background:var(--sb-accent);border-radius:2px;opacity:0.6
    }
    .perfil-avatar{
        position:relative;width:140px;height:140px;border-radius:50%;
        overflow:hidden;border:4px solid var(--sb-accent);
        background:linear-gradient(135deg,var(--sb-bg),var(--sb-card));
        margin-bottom:1.25rem;transition:var(--sb-transition);
        box-shadow:0 0 0 4px var(--sb-accent-soft),0 8px 24px rgba(0,0,0,0.3);
        cursor:pointer
    }
    .perfil-avatar:hover{
        transform:scale(1.03);
        box-shadow:0 0 0 4px var(--sb-accent-soft),0 12px 32px rgba(245,220,91,0.25)
    }
    .perfil-avatar::after{
        content:'📷';position:absolute;inset:0;
        background:rgba(0,0,0,0.6);display:flex;align-items:center;
        justify-content:center;color:#fff;font-size:1.5rem;
        opacity:0;transition:var(--sb-transition);border-radius:50%
    }
    .perfil-avatar:hover::after{opacity:1}
    .perfil-avatar img{
        width:100%;height:100%;object-fit:cover;
        display:block;transition:var(--sb-transition)
    }
    .perfil-avatar:hover img{transform:scale(1.05)}
    .avatar-label{
        font-size:0.9rem;color:var(--sb-muted);
        text-align:center;margin-bottom:0.75rem;font-weight:500
    }

    /* ================= BADGE ================= */
    .estado-badge{
        display:inline-flex;align-items:center;justify-content:center;
        gap:6px;padding:0.5rem 1.25rem;border-radius:50px;
        font-size:0.8rem;font-weight:700;text-transform:uppercase;
        letter-spacing:0.6px;margin-top:0.5rem;
        transition:var(--sb-transition);border:2px solid
    }
    .estado-activo{
        background:rgba(34,197,94,0.12);color:var(--sb-green);
        border-color:rgba(34,197,94,0.4)
    }
    .estado-inactivo{
        background:rgba(234,179,8,0.12);color:#eab308;
        border-color:rgba(234,179,8,0.4)
    }
    .estado-suspendido{
        background:rgba(239,68,68,0.12);color:var(--sb-red);
        border-color:rgba(239,68,68,0.4)
    }
    .estado-badge::before{
        content:'';width:8px;height:8px;border-radius:50%;
        background:currentColor
    }

    /* ================= FORM ================= */
    .perfil-form{
        display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
        gap:1.5rem
    }
    .form-group{position:relative;display:flex;flex-direction:column;gap:0.4rem}
    .form-label{
        font-size:0.75rem;font-weight:600;color:var(--sb-muted);
        text-transform:uppercase;letter-spacing:0.6px;margin-left:0.25rem
    }
    .form-input{
        padding:1rem 1.1rem;background:var(--sb-bg);
        border:1px solid var(--sb-border);border-radius:12px;
        color:var(--sb-text);font-size:0.95rem;
        transition:var(--sb-transition);width:100%;min-height:52px
    }
    .form-input:focus{
        outline:none;border-color:var(--sb-accent);
        box-shadow:0 0 0 4px var(--sb-accent-soft);transform:translateY(-1px)
    }
    .form-input::placeholder{color:var(--sb-muted);opacity:0.5}
    .form-input[type="file"]{padding:0.6rem 1rem;cursor:pointer;background:var(--sb-bg)}
    .form-input[type="file"]::file-selector-button{
        background:var(--sb-accent);color:#000;border:none;
        border-radius:8px;padding:0.5rem 1rem;font-weight:600;
        cursor:pointer;transition:var(--sb-transition);margin-right:0.75rem
    }
    .form-input[type="file"]::file-selector-button:hover{background:var(--sb-accent-hover)}

    /* ================= ERRORS ================= */
    .error-msg{
        color:var(--sb-red);font-size:0.72rem;margin-top:0.2rem;
        display:block;font-weight:500;animation:shake 0.3s ease
    }
    @keyframes shake{0%,100%{transform:translateX(0)}25%{transform:translateX(-3px)}75%{transform:translateX(3px)}}

    /* ================= ACTIONS ================= */
    .form-actions{
        display:flex;gap:1rem;justify-content:flex-end;
        margin-top:2rem;padding-top:1.5rem;
        border-top:1px solid var(--sb-border);position:relative
    }
    .form-actions::before{
        content:'';position:absolute;top:0;left:0;right:0;height:1px;
        background:linear-gradient(90deg,transparent,var(--sb-accent),transparent);
        opacity:0.3
    }
    .btn-submit{
        padding:0.85rem 2rem;background:var(--sb-accent);color:#000;
        border:none;border-radius:12px;font-weight:700;cursor:pointer;
        transition:var(--sb-transition);font-size:0.95rem;
        display:inline-flex;align-items:center;gap:8px;
        position:relative;overflow:hidden
    }
    .btn-submit::before{
        content:'';position:absolute;top:0;left:-100%;width:100%;height:100%;
        background:linear-gradient(90deg,transparent,rgba(255,255,255,0.4),transparent);
        transition:left 0.5s
    }
    .btn-submit:hover::before{left:100%}
    .btn-submit:hover{
        background:var(--sb-accent-hover);transform:translateY(-2px);
        box-shadow:0 8px 24px rgba(245,220,91,0.3)
    }
    .btn-submit:active{transform:translateY(0)}

    /* ================= DECORATIVE ================= */
    .perfil-card::after{
        content:'✂️';position:absolute;bottom:1rem;right:1.5rem;
        font-size:3rem;color:var(--sb-accent);opacity:0.05;
        pointer-events:none;transform:rotate(-15deg)
    }

    /* ================= TOAST ================= */
    .toast{
        position:fixed;bottom:2rem;right:2rem;
        background:var(--sb-card);border:1px solid var(--sb-green);
        border-left:4px solid var(--sb-green);padding:1rem 1.5rem;
        border-radius:12px;box-shadow:0 8px 32px rgba(0,0,0,0.4);
        display:none;align-items:center;gap:0.75rem;
        color:var(--sb-text);z-index:1000;animation:slideIn 0.3s ease
    }
    @keyframes slideIn{
        from{opacity:0;transform:translateY(20px) scale(0.95)}
        to{opacity:1;transform:translateY(0) scale(1)}
    }
    .toast i{color:var(--sb-green);font-size:1.25rem}

    /* ================= RESPONSIVE ================= */
    @media(max-width:768px){
        .perfil-container{padding:1rem}
        .perfil-card{padding:1.75rem}
        .perfil-form{grid-template-columns:1fr;gap:1.25rem}
        .perfil-avatar{width:120px;height:120px}
        .form-actions{flex-direction:column}
        .btn-submit{width:100%;justify-content:center}
        .perfil-card::after{font-size:2rem;bottom:0.5rem;right:1rem}
    }
    @media(max-width:480px){
        .perfil-container{padding:0.75rem}
        .perfil-card{padding:1.5rem}
        .perfil-avatar{width:100px;height:100px;border-width:3px}
        .estado-badge{padding:0.4rem 1rem;font-size:0.75rem}
    }
    @media(hover:none) and (pointer:coarse){
        .form-input,.btn-submit{min-height:48px}
        input,select{font-size:16px!important}
        .perfil-avatar:hover{transform:none}
    }

    /* ================= ANIMATIONS ================= */
    @keyframes fadeIn{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}
    .perfil-card{animation:fadeIn 0.4s ease forwards}
    .perfil-avatar-section{animation:fadeIn 0.4s ease 0.1s forwards;opacity:0}
    .perfil-form .form-group{animation:fadeIn 0.3s ease forwards;opacity:0}
    .perfil-form .form-group:nth-child(1){animation-delay:0.2s}
    .perfil-form .form-group:nth-child(2){animation-delay:0.25s}
    .perfil-form .form-group:nth-child(3){animation-delay:0.3s}
    .perfil-form .form-group:nth-child(4){animation-delay:0.35s}
    .perfil-form .form-group:nth-child(5){animation-delay:0.4s}
    .perfil-form .form-group:nth-child(6){animation-delay:0.45s}
    .form-actions{animation:fadeIn 0.4s ease 0.5s forwards;opacity:0}
</style>

<div class="perfil-container">
    <header class="perfil-header">
        <h1>👤 Mi Perfil de Cliente</h1>
        <p>Administra tu información personal y preferencias de reserva</p>
    </header>

    <div class="perfil-card">
        {{-- AVATAR --}}
        <div class="perfil-avatar-section">
            <div class="perfil-avatar">
                @if ($user->foto)
                    <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Perfil"
                        onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->nombre ?? 'C') }}&background=F5DC5B&color=000&size=240'">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nombre ?? 'C') }}&background=F5DC5B&color=000&size=240" alt="Avatar">
                @endif
            </div>
            <span class="avatar-label">Foto de perfil</span>
            <span class="estado-badge estado-{{ $user->estado ?? 'activo' }}">{{ ucfirst($user->estado ?? 'activo') }}</span>
        </div>

        {{-- FORMULARIO - LÓGICA 100% INTACTA --}}
        <form action="{{ route('cliente.perfil.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="perfil-form">
                <div class="form-group">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-input" value="{{ old('nombre', $user->nombre) }}" placeholder="Nombre" required>
                    @error('nombre')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-input" value="{{ old('apellido', $user->apellido) }}" placeholder="Apellido" required>
                    @error('apellido')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" placeholder="Correo" required>
                    @error('email')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-input" value="{{ old('telefono', $user->telefono) }}" placeholder="Teléfono">
                    @error('telefono')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Nueva Contraseña</label>
                    <input type="password" name="password" class="form-input" placeholder="Dejar vacío para mantener la actual">
                    @error('password')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Cambiar Foto</label>
                    <input type="file" name="foto" class="form-input" accept="image/png, image/jpeg, image/webp">
                    @error('foto')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-submit">💾 Guardar cambios</button>
            </div>
        </form>
    </div>
</div>

{{-- Toast Notification --}}
@if(session('success'))
<div class="toast" id="toast" style="display:flex"><i>✓</i><span>{{ session('success') }}</span></div>
<script>setTimeout(()=>{const t=document.getElementById('toast');if(t)t.style.display='none'},4000)</script>
@endif
@endsection