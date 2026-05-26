<!DOCTYPE html>
<html lang="es" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snyder Barber | @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
     <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logo.ico') }}">
    <link rel="stylesheet" href="style-cliente.css">
    <link rel="stylesheet" href="{{ asset('css/cliente.css') }}">
</head>

<body>
    <div class="app-container">
        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo"><i data-lucide="scissors"></i><span>Snyder Barber</span></div>
                <button class="sidebar-close" id="sidebarClose" aria-label="Cerrar menú"><i
                        data-lucide="x"></i></button>
            </div>
            <nav class="sidebar-nav">
                <a href="/" class="nav-item active">
                    <i data-lucide="house"></i> Volver al Sitio
                </a>
                <a href="{{ route('cliente.dashboard') }}" class="nav-item active"><i
                        data-lucide="layout-dashboard"></i> Dashboard</a>
                <a href="{{ route('cliente.testimonios.index') }}" class="nav-item"><i data-lucide="user"></i>
                    Testimonios</a>

                <a href="{{ route('cliente.citas.index') }}" class="nav-item"><i data-lucide="calendar-check"></i> Mis
                    Citas</a>
                <a href="{{ route('cliente.perfil.index') }}" class="nav-item"><i data-lucide="user"></i> Perfil</a>

            </nav>
            <div class="sidebar-footer">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-item logout">
                        <i data-lucide="log-out"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN -->
        <main class="main-content">
            <header class="topbar">
                <button class="hamburger" id="sidebarToggle" aria-label="Abrir menú"><i data-lucide="menu"></i></button>
                <div class="topbar-center">
                    <h1 class="welcome-title">
                        Hola, {{ Auth::user()->nombre }} {{ Auth::user()->apellido }} 👋
                    </h1>
                    <p class="welcome-sub">Tu próximo estilo te espera. Reserva en un clic.</p>
                </div>
                <div class="topbar-actions">

                    <button class="theme-toggle" id="themeToggle" aria-label="Cambiar tema">
                        <i data-lucide="sun" class="icon-sun"></i><i data-lucide="moon" class="icon-moon"></i>
                    </button>
                    <div class="profile">
                        @php
                            $user = Auth::user();
                        @endphp

                        @if ($user->foto)
                            <img src="{{ asset('storage/' . $user->foto) }}" alt="Perfil">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nombre . ' ' . $user->apellido) }}&background=F5DC5B&color=000000&size=40"
                                alt="Perfil">
                        @endif

                        <span class="profile-name">
                            {{ $user->nombre }} {{ $user->apellido }}
                        </span>
                    </div>
                </div>
            </header>

            @yield('contenidoCliente')
        </main>
    </div>
    <script src="script-cliente.js"></script>
    <script>
        lucide.createIcons();
    </script>
    <script src="{{ asset('js/cliente.js') }}"></script>
</body>

</html>
