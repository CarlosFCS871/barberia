<!DOCTYPE html>
<html lang="es" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snyder Barber | @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
     <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logo.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

</head>

<body>


    <div class="app-container">


        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i data-lucide="scissors"></i>
                    <span>Snyder Barber</span>
                </div>
                <button class="sidebar-close" id="sidebarClose" aria-label="Cerrar menú">
                    <i data-lucide="x"></i>
                </button>
            </div>






            <nav class="sidebar-nav">
                <a href="/" class="nav-item active">
                    <i data-lucide="house"></i> Volver al Sitio
                </a>
                <a href="{{ route('admin.dashboard') }}" class="nav-item active"><i data-lucide="layout-dashboard"></i>
                    Dashboard</a>
                <a href="{{ route('admin.perfil.index') }}" class="nav-item">
                    <i data-lucide="user"></i> Mi Perfil
                </a>
                <a href="{{ route('admin.usuarios.index') }}" class="nav-item"><i data-lucide="users"></i> Usuarios</a>
                <a href="{{ route('admin.servicios.index') }}" class="nav-item"><i data-lucide="scissors"></i>
                    Servicios</a>
                <a href="{{ route('admin.horarios.index') }}" class="nav-item"><i data-lucide="calendar-clock"></i>
                    Horarios</a>
                <a href="{{ route('admin.citas.index') }}" class="nav-item"><i data-lucide="calendar-check"></i>
                    Citas</a>
                <a href="{{ route('admin.ventas.index') }}" class="nav-item"><i data-lucide="credit-card"></i>
                    Ventas</a>
                <a href="{{ route('admin.promociones.index') }}" class="nav-item"><i data-lucide="badge-percent"></i>
                    Promociones</a>
                <a href="{{ route('admin.testimonios.index') }}" class="nav-item"><i
                        data-lucide="message-square-quote"></i> Testimonios</a>
                <a href="{{ route('admin.contactos.index') }}" class="nav-item"><i data-lucide="phone"></i>
                    Contactos</a>
            </nav>



            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="nav-item logout">
                        <i data-lucide="log-out"></i> Cerrar sesión
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- TOPBAR -->
            <header class="topbar">
                <button class="hamburger" id="sidebarToggle" aria-label="Abrir menú">
                    <i data-lucide="menu"></i>
                </button>
                <div class="topbar-center">
                    <div class="search-box">
                        <i data-lucide="search"></i>
                        <input type="text" placeholder="Buscar citas, clientes, barberos...">
                    </div>
                </div>
                <div class="topbar-actions">

                    <button class="theme-toggle" id="themeToggle" aria-label="Cambiar tema">
                        <i data-lucide="sun" class="icon-sun"></i>
                        <i data-lucide="moon" class="icon-moon"></i>
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
            @yield('AdminContenido')

        </main>
    </div>


    <script src="{{ asset('js/admin.js') }}"></script>



    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
