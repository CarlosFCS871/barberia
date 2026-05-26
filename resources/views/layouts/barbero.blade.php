<!DOCTYPE html>
<html lang="es" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Snyder Barber | @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logo.ico') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* ================= VARIABLES & THEMES ================= */
        :root {
            /* Dark Mode (Default) */
            --bg-primary: #000000;
            --bg-sidebar: #000000;
            --bg-card: #111111;
            --bg-hover: rgba(245, 220, 91, 0.08);
            --border: rgba(255, 255, 255, 0.06);
            --border-hover: rgba(245, 220, 91, 0.25);
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
            --accent: #f5dc5b;
            --accent-hover: #e6c94a;
            --accent-glow: rgba(245, 220, 91, 0.3);
            --success: #22c55e;
            --warning: #eab308;
            --danger: #ef4444;
            --info: #3b82f6;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.2);
            --shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            --shadow-lg: 0 16px 48px rgba(0, 0, 0, 0.4);
            --shadow-glow: 0 0 20px rgba(245, 220, 91, 0.15);
            --radius: 16px;
            --radius-sm: 10px;
            --radius-lg: 24px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-fast: all 0.15s ease;
            --font: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            --sidebar-width: 260px;
            --topbar-height: 72px;
            --z-sidebar: 50;
            --z-topbar: 40;
            --z-overlay: 45;
            --z-dropdown: 60;
        }

        .main-content {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: var(--bg-primary);
            width: 100%;
            overflow: hidden;
        }

        .topbar {
            position: sticky;
            top: 0;
            width: 100%;
            height: var(--topbar-height);
            background: var(--bg-primary);
            border-bottom: 1px solid var(--border);
            z-index: 999;
        }

        /* Light Mode */
        [data-theme="light"] {
            --bg-primary: #f8fafc;
            --bg-sidebar: #ffffff;
            --bg-card: #ffffff;
            --bg-hover: rgba(245, 220, 91, 0.12);
            --border: #e2e8f0;
            --border-hover: rgba(245, 220, 91, 0.4);
            --text-primary: #111827;
            --text-secondary: #475569;
            --text-muted: #64748b;
            --accent: #b89600;
            --accent-hover: #a38500;
            --accent-glow: rgba(245, 220, 91, 0.2);
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.06);
            --shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 16px 48px rgba(0, 0, 0, 0.12);
            --shadow-glow: 0 0 20px rgba(245, 220, 91, 0.1);
        }

        /* ================= RESET & BASE ================= */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            font-size: 16px;
            scroll-behavior: smooth;
            -webkit-text-size-adjust: 100%;
        }

        body {
            font-family: var(--font);
            background: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
            transition: background var(--transition), color var(--transition);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: var(--transition-fast);
        }

        button {
            cursor: pointer;
            border: none;
            background: none;
            font-family: inherit;
            color: inherit;
            transition: var(--transition-fast);
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }

        :focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 2px;
        }

        /* ================= LAYOUT GRID ================= */
        .app-container {
            display: grid;
            grid-template-columns: var(--sidebar-width) 1fr;
            min-height: 100vh;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            position: sticky;
            top: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            z-index: var(--z-sidebar);
            transition: var(--transition);
            will-change: transform;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            flex-shrink: 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 800;
            font-size: 1.2rem;
            letter-spacing: 0.3px;
            color: var(--text-primary);
        }

        .logo i {
            color: var(--accent);
            width: 24px;
            height: 24px;
        }

        .sidebar-close {
            display: none;
            padding: 0.5rem;
            border-radius: var(--radius-sm);
            color: var(--text-muted);
            transition: var(--transition-fast);
        }

        .sidebar-close:hover {
            background: var(--bg-hover);
            color: var(--accent);
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            scrollbar-width: thin;
            scrollbar-color: var(--border) transparent;
        }

        .sidebar-nav::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-nav::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 10px;
            transition: var(--transition-fast);
        }

        .sidebar-nav::-webkit-scrollbar-thumb:hover {
            background: var(--accent);
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.75rem 1rem;
            border-radius: var(--radius-sm);
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 0.925rem;
            position: relative;
            transition: var(--transition);
            white-space: nowrap;
        }

        .nav-item i {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            opacity: 0.9;
        }

        .nav-item:hover {
            background: var(--bg-hover);
            color: var(--accent);
            transform: translateX(3px);
        }

        .nav-item:hover i {
            opacity: 1;
        }

        .nav-item.active {
            background: var(--bg-hover);
            color: var(--text-primary);
            font-weight: 600;
            border-left: 3px solid var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        .nav-item.active i {
            opacity: 1;
            color: var(--accent);
        }

        .sidebar-footer {
            padding: 0.75rem 1rem;
            border-top: 1px solid var(--border);
            background: var(--bg-sidebar);
            flex-shrink: 0;
        }

        .logout {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 0.75rem;
            border-radius: var(--radius-sm);
            color: var(--danger);
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .logout:hover {
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            transform: none;
        }

        .logout i {
            width: 18px;
            height: 18px;
        }

        /* ================= TOPBAR ================= */
        .topbar {
            position: sticky;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--topbar-height);
            background: var(--bg-primary);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            z-index: var(--z-topbar);
            backdrop-filter: blur(12px);
            transition: left var(--transition);
        }

        .hamburger {
            display: none;
            padding: 0.6rem;
            border-radius: var(--radius-sm);
            color: var(--text-primary);
            transition: var(--transition-fast);
        }

        .hamburger:hover {
            background: var(--bg-hover);
            color: var(--accent);
        }

        .hamburger i {
            width: 22px;
            height: 22px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .breadcrumb span {
            color: var(--text-primary);
            font-weight: 600;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }

        .icon-btn {
            position: relative;
            padding: 0.6rem;
            border-radius: var(--radius-sm);
            color: var(--text-secondary);
            transition: var(--transition-fast);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-btn i {
            width: 20px;
            height: 20px;
        }

        .icon-btn:hover {
            background: var(--bg-hover);
            color: var(--accent);
        }

        .icon-btn .notification-badge {
            position: absolute;
            top: 2px;
            right: 2px;
            background: var(--accent);
            color: #000;
            font-size: 0.65rem;
            font-weight: 700;
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            line-height: 1;
        }

        .theme-toggle {
            position: relative;
            width: 48px;
            height: 28px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 3px;
            display: flex;
            align-items: center;
            transition: var(--transition);
        }

        .theme-toggle i {
            position: absolute;
            width: 18px;
            height: 18px;
            color: var(--text-muted);
            transition: var(--transition);
        }

        .icon-sun {
            left: 6px;
            opacity: 1;
        }

        .icon-moon {
            right: 6px;
            opacity: 0;
        }

        [data-theme="light"] .icon-sun {
            opacity: 0;
        }

        [data-theme="light"] .icon-moon {
            opacity: 1;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.35rem 0.5rem 0.35rem 0.35rem;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
        }

        .profile:hover {
            border-color: var(--border-hover);
            background: var(--bg-hover);
        }

        .profile img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 2px solid var(--accent);
            object-fit: cover;
        }

        .profile-name {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        /* ================= MAIN CONTENT ================= */
        .main-content {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: var(--bg-primary);
        }

        .content-wrapper {
            flex: 1;
            padding: 2rem;
            width: 100%;
            max-width: 100%;
        }

        .page-title {
            font-size: clamp(1.5rem, 2.5vw, 2rem);
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 0.95rem;
            margin-bottom: 2rem;
        }

        /* ================= STATS GRID ================= */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.25rem;
            position: relative;
            overflow: hidden;
            transition: var(--transition);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--accent), transparent);
        }

        .stat-card:hover {
            transform: translateY(-3px);
            border-color: var(--border-hover);
            box-shadow: var(--shadow);
        }

        .stat-card .stat-icon {
            width: 44px;
            height: 44px;
            background: var(--bg-hover);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.85rem;
            color: var(--accent);
        }

        .stat-card .stat-icon i {
            width: 22px;
            height: 22px;
        }

        .stat-card .stat-label {
            display: block;
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 0.25rem;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .stat-card .stat-value {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            display: block;
            line-height: 1.1;
        }

        .stat-card .stat-trend {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.2rem 0.5rem;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        .stat-trend.up {
            background: rgba(34, 197, 94, 0.15);
            color: var(--success);
        }

        .stat-trend.down {
            background: rgba(239, 68, 68, 0.15);
            color: var(--danger);
        }

        .stat-trend.neutral {
            background: var(--bg-hover);
            color: var(--accent);
        }

        /* ================= DASHBOARD GRID ================= */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
        }

        .main-column,
        .side-column {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* ================= CARDS ================= */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem;
            transition: var(--transition);
        }

        .card:hover {
            border-color: var(--border-hover);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--border);
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* ================= TABLES ================= */
        .table-wrapper {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .data-table th {
            text-align: left;
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.02);
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            white-space: nowrap;
        }

        .data-table td {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
            transition: var(--transition-fast);
        }

        .data-table tbody tr:hover {
            background: var(--bg-hover);
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* ================= BADGES ================= */
        .badge {
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-pendiente {
            background: rgba(234, 179, 8, 0.15);
            color: var(--warning);
            border: 1px solid rgba(234, 179, 8, 0.3);
        }

        .badge-confirmado {
            background: rgba(34, 197, 94, 0.15);
            color: var(--success);
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .badge-cancelado {
            background: rgba(239, 68, 68, 0.15);
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .badge-finalizado {
            background: rgba(59, 130, 246, 0.15);
            color: var(--info);
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .badge-activo {
            background: rgba(34, 197, 94, 0.15);
            color: var(--success);
        }

        .badge-inactivo {
            background: rgba(107, 114, 128, 0.15);
            color: var(--text-muted);
        }

        /* ================= ACTION BUTTONS ================= */
        .btn-action {
            width: 32px;
            height: 32px;
            min-width: 32px;
            min-height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: transparent;
            color: var(--text-muted);
            font-size: 0.9rem;
            transition: var(--transition-fast);
        }

        .btn-action:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--bg-hover);
            transform: scale(1.05);
        }

        /* ================= TIMELINE ================= */
        .timeline {
            position: relative;
            padding-left: 1.5rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 6px;
            top: 8px;
            bottom: 8px;
            width: 2px;
            background: var(--border);
        }

        .timeline-item {
            position: relative;
            padding-left: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -1.5rem;
            top: 4px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--accent);
            border: 2px solid var(--bg-card);
        }

        .timeline-icon {
            position: absolute;
            left: -1.75rem;
            top: 2px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--bg-hover);
            color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
        }

        .timeline-content h4 {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .timeline-content p {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .timeline-time {
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-top: 0.25rem;
        }

        /* ================= PROMO CARDS ================= */
        .promo-card {
            display: flex;
            gap: 1rem;
            padding: 1rem;
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            transition: var(--transition);
        }

        .promo-card:hover {
            border-color: var(--border-hover);
            transform: translateX(3px);
        }

        .promo-img {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
            background: var(--bg-hover);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .promo-content {
            flex: 1;
            min-width: 0;
        }

        .promo-name {
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .promo-discount {
            color: var(--accent);
            font-weight: 700;
            font-size: 0.85rem;
        }

        .promo-date {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        /* ================= TESTIMONIAL CARDS ================= */
        .testimonial-card {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 1rem;
            transition: var(--transition);
            position: relative;
        }

        .testimonial-card::before {
            content: '"';
            position: absolute;
            top: 8px;
            left: 12px;
            font-size: 2rem;
            color: var(--accent);
            opacity: 0.2;
            font-family: serif;
            line-height: 1;
        }

        .testimonial-text {
            font-size: 0.9rem;
            line-height: 1.5;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
            padding-left: 1rem;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .testimonial-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--bg-hover);
            color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.7rem;
            flex-shrink: 0;
        }

        .stars {
            color: var(--accent);
            font-size: 0.85rem;
            letter-spacing: 1px;
        }

        /* ================= SCHEDULE CARDS ================= */
        .schedule-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            transition: var(--transition);
        }

        .schedule-card:hover {
            border-color: var(--border-hover);
        }

        .schedule-time {
            font-weight: 600;
            color: var(--text-primary);
        }

        .schedule-range {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .schedule-status {
            font-size: 0.75rem;
            padding: 3px 8px;
            border-radius: 4px;
        }

        /* ================= PAGINATION ================= */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
            border-top: 1px solid var(--border);
            background: var(--bg-card);
        }

        .pagination {
            display: flex;
            gap: 4px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .pagination .page-item {
            display: inline-block;
        }

        .pagination .page-link,
        .pagination .page-item span {
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid var(--border);
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition-fast);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            min-height: 34px;
            font-size: 0.8rem;
        }

        .pagination .page-link:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .pagination .active .page-link,
        .pagination .page-item.active span {
            background: var(--accent);
            color: #000;
            border-color: var(--accent);
            font-weight: 700;
        }

        .pagination .disabled span {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* ================= EMPTY STATES ================= */
        .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--text-muted);
        }

        .empty-state p:first-child {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        /* ================= ANIMATIONS ================= */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fade {
            animation: fadeIn 0.4s ease forwards;
            opacity: 0;
        }

        .animate-slide {
            animation: slideIn 0.3s ease forwards;
            opacity: 0;
        }

        .stat-card:nth-child(1) {
            animation-delay: 0.05s;
        }

        .stat-card:nth-child(2) {
            animation-delay: 0.1s;
        }

        .stat-card:nth-child(3) {
            animation-delay: 0.15s;
        }

        .stat-card:nth-child(4) {
            animation-delay: 0.2s;
        }

        .stat-card:nth-child(5) {
            animation-delay: 0.25s;
        }

        .stat-card:nth-child(6) {
            animation-delay: 0.3s;
        }

        .card {
            animation: fadeIn 0.4s ease forwards;
            opacity: 0;
            animation-delay: 0.35s;
        }

        /* ================= RESPONSIVE BREAKPOINTS ================= */

        /* Tablet & Below (≤1024px) */
        @media (max-width: 1024px) {
            .app-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                height: 100vh;
                width: var(--sidebar-width);
                transform: translateX(-100%);
                box-shadow: var(--shadow-lg);
                z-index: var(--z-sidebar);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .sidebar-close {
                display: flex;
            }

            .hamburger {
                display: flex;
            }

            .topbar {
                left: 0;
                padding: 0 1rem;
            }

            .profile-name {
                display: none;
            }

            .content-wrapper {
                padding: 1.5rem;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-card .stat-value {
                font-size: 1.35rem;
            }
        }

        /* Mobile (≤768px) */
        @media (max-width: 768px) {
            :root {
                --topbar-height: 64px;
            }

            .topbar {
                padding: 0 0.75rem;
                height: var(--topbar-height);
            }

            .breadcrumb {
                display: none;
            }

            .topbar-actions {
                gap: 0.5rem;
            }

            .icon-btn {
                padding: 0.5rem;
            }

            .theme-toggle {
                width: 44px;
                height: 26px;
            }

            .profile img {
                width: 32px;
                height: 32px;
            }

            .content-wrapper {
                padding: 1rem;
            }

            .page-title {
                font-size: 1.4rem;
            }

            .page-subtitle {
                font-size: 0.9rem;
                margin-bottom: 1.5rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 0.85rem;
            }

            .stat-card {
                display: flex;
                align-items: center;
                gap: 1rem;
                padding: 0.9rem;
                flex-direction: row;
                min-height: auto;
            }

            .stat-card::before {
                width: 3px;
                height: 100%;
                top: 0;
                left: 0;
                right: auto;
            }

            .stat-card .stat-icon {
                margin: 0;
                width: 40px;
                height: 40px;
            }

            .stat-card .stat-label {
                margin: 0;
            }

            .stat-card .stat-value {
                font-size: 1.25rem;
            }

            .stat-card .stat-trend {
                position: static;
                margin-left: auto;
            }

            .card {
                padding: 1.25rem;
            }

            .card-title {
                font-size: 1rem;
                margin-bottom: 1rem;
            }

            .data-table {
                min-width: 550px;
                font-size: 0.85rem;
            }



            .data-table th,
            .data-table td {
                padding: 0.85rem 1rem;
            }

            .table-wrapper {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: thin;
                border-radius: var(--radius-sm);
            }

            .table-wrapper::-webkit-scrollbar {
                height: 4px;
            }

            .table-wrapper::-webkit-scrollbar-thumb {
                background: var(--bg-hover);
                border-radius: 10px;
            }

            .pagination-wrapper {
                flex-direction: column;
                gap: 0.6rem;
                padding: 0.85rem;
            }

            .pagination {
                flex-wrap: wrap;
                justify-content: center;
            }

            .promo-card {
                flex-direction: column;
                text-align: center;
            }

            .promo-img {
                margin: 0 auto 0.5rem;
            }

            .schedule-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }

        /* Small Mobile (≤480px) */
        @media (max-width: 480px) {
            :root {
                --font-size-base: 15px;
            }

            .content-wrapper {
                padding: 0.75rem;
            }

            .page-title {
                font-size: 1.3rem;
            }

            .stats-grid {
                gap: 0.7rem;
            }

            .stat-card {
                padding: 0.8rem;
                gap: 0.8rem;
            }

            .stat-card .stat-value {
                font-size: 1.15rem;
            }

            .card {
                padding: 1rem;
            }

            .data-table {
                min-width: 480px;
                font-size: 0.8rem;
            }

            .data-table th,
            .data-table td {
                padding: 0.7rem 0.85rem;
            }

            .badge {
                padding: 3px 8px;
                font-size: 0.65rem;
            }

            .btn-action {
                width: 30px;
                height: 30px;
                font-size: 0.85rem;
            }

            .pagination .page-link,
            .pagination .page-item span {
                padding: 5px 10px;
                font-size: 0.75rem;
                min-width: 30px;
                min-height: 30px;
            }

            .sidebar {
                width: 260px;
            }

            .logo span {
                font-size: 1.1rem;
            }

            .nav-item {
                font-size: 0.9rem;
                padding: 0.7rem 0.9rem;
            }

            .topbar {
                padding: 0 0.5rem;
            }
        }

        /* Landscape Mobile */
        @media (max-height: 500px) and (orientation: landscape) {
            .sidebar {
                overflow-y: auto;
            }

            .sidebar-nav {
                padding: 0.5rem;
            }

            .nav-item {
                padding: 0.6rem 0.9rem;
                font-size: 0.875rem;
            }
        }

        /* ================= TOUCH OPTIMIZATIONS ================= */
        @media (hover: none) and (pointer: coarse) {

            .nav-item,
            .icon-btn,
            .btn-action,
            .theme-toggle,
            .profile,
            .filter-group input,
            .filter-group select {
                min-height: 44px;
            }

            input,
            select,
            textarea {
                font-size: 16px !important;
            }

            .stat-card:hover,
            .card:hover,
            .promo-card:hover,
            .schedule-card:hover,
            .testimonial-card:hover {
                transform: none !important;
                transition: none !important;
            }

            .btn-action:active,
            .nav-item:active {
                opacity: 0.9;
            }
        }

        /* ================= PRINT STYLES ================= */
        @media print {

            .sidebar,
            .topbar,
            .hamburger,
            .theme-toggle,
            .btn-action {
                display: none !important;
            }

            .app-container {
                grid-template-columns: 1fr !important;
            }

            .main-content {
                padding: 0;
            }

            .content-wrapper {
                padding: 0;
            }

            .card,
            .stat-card,
            .table-wrapper {
                break-inside: avoid;
                box-shadow: none !important;
                border: 1px solid #ccc !important;
            }

            body {
                background: #fff !important;
                color: #000 !important;
            }
        }

        /* ================= ACCESSIBILITY ================= */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }

        @media (prefers-contrast: high) {
            :root {
                --border: rgba(255, 255, 255, 0.3);
                --border-hover: var(--accent);
            }

            .nav-item.active {
                border-left-width: 4px;
            }
        }

        /* ================= SIDEBAR OVERLAY ================= */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: var(--z-overlay);
            opacity: 0;
            transition: opacity var(--transition);
        }

        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        @media (max-width: 1024px) {
            .sidebar-overlay {
                display: none;
            }

            .sidebar.active+.sidebar-overlay,
            .sidebar-overlay.active {
                display: block;
            }
        }
    </style>
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
                <a href="{{ route('barbero.dashboard') }}" class="nav-item active">
                    <i data-lucide="layout-dashboard"></i> Dashboard
                </a>
                <a href="{{ route('barbero.citas.index') }}" class="nav-item">
                    <i data-lucide="calendar-check"></i> Mis Citas
                </a>
                <a href="{{ route('barbero.horarios.index') }}" class="nav-item">
                    <i data-lucide="clock"></i> Mis Horarios
                </a>
                <a href="{{ route('barbero.servicios.index') }}" class="nav-item">
                    <i data-lucide="scissors"></i> Mis Servicios
                </a>
                <a href="{{ route('barbero.ventas.index') }}" class="nav-item">
                    <i data-lucide="wallet"></i> Mis Ventas
                </a>
                <a href="{{ route('barbero.promociones.index') }}" class="nav-item">
                    <i data-lucide="badge-percent"></i> Mis Promociones
                </a>
                <a href="{{ route('barbero.perfil.index') }}" class="nav-item">
                    <i data-lucide="user"></i> Mi Perfil
                </a>
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

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <!-- TOPBAR -->
            <header class="topbar">
                <button class="hamburger" id="sidebarToggle" aria-label="Abrir menú">
                    <i data-lucide="menu"></i>
                </button>
                <div class="breadcrumb">
                    <span>Dashboard</span> / <span>Barbero</span>
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

            @yield('BarberoContenido')

        </main>

        <!-- SIDEBAR OVERLAY -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // ================= THEME MANAGEMENT =================
            const themeToggle = document.getElementById('themeToggle');
            const html = document.documentElement;

            const savedTheme = localStorage.getItem('snyder-theme') || 'dark';

            html.setAttribute('data-theme', savedTheme);

            themeToggle.addEventListener('click', () => {

                const current = html.getAttribute('data-theme');

                const next = current === 'dark' ?
                    'light' :
                    'dark';

                html.setAttribute('data-theme', next);

                localStorage.setItem('snyder-theme', next);

            });

            // ================= SIDEBAR TOGGLE =================
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarClose = document.getElementById('sidebarClose');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            const openSidebar = () => {
                sidebar.classList.add('active');
                sidebarOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            };

            const closeSidebar = () => {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            };

            sidebarToggle.addEventListener('click', openSidebar);
            sidebarClose.addEventListener('click', closeSidebar);
            sidebarOverlay.addEventListener('click', closeSidebar);

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                    closeSidebar();
                }
            });

            // ================= NAV ACTIVE STATE =================
            document.querySelectorAll('.sidebar-nav .nav-item').forEach(item => {

                item.addEventListener('click', () => {

                    document.querySelectorAll('.sidebar-nav .nav-item')
                        .forEach(n => n.classList.remove('active'));

                    item.classList.add('active');

                    if (window.innerWidth <= 1024) {
                        closeSidebar();
                    }

                });

            });

            // ================= TABLE DRAG SCROLL =================
            document.querySelectorAll('.table-wrapper').forEach(wrapper => {

                let isDown = false;
                let startX;
                let scrollLeft;

                wrapper.addEventListener('mousedown', (e) => {
                    isDown = true;
                    startX = e.pageX - wrapper.offsetLeft;
                    scrollLeft = wrapper.scrollLeft;
                });

                wrapper.addEventListener('mouseleave', () => {
                    isDown = false;
                });

                wrapper.addEventListener('mouseup', () => {
                    isDown = false;
                });

                wrapper.addEventListener('mousemove', (e) => {

                    if (!isDown) return;

                    e.preventDefault();

                    const x = e.pageX - wrapper.offsetLeft;

                    const walk = (x - startX) * 2;

                    wrapper.scrollLeft = scrollLeft - walk;

                });

            });

            // ================= LUCIDE ICONS =================
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

        });
    </script>
</body>

</html>
