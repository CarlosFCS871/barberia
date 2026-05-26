document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('themeToggle');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarClose = document.getElementById('sidebarClose');
    const logoutBtn = document.getElementById('logoutBtn');
    const dateDisplay = document.getElementById('currentDate');
    const body = document.body;

    // ================= THEME =================
    const savedTheme = localStorage.getItem('snyder-theme') || 'dark';
    body.setAttribute('data-theme', savedTheme);
    themeToggle.addEventListener('click', () => {
        const next = body.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        body.setAttribute('data-theme', next);
        localStorage.setItem('snyder-theme', next);
    });

    // ================= SIDEBAR =================
    const open = () => sidebar.classList.add('active');
    const close = () => sidebar.classList.remove('active');
    sidebarToggle.addEventListener('click', open);
    sidebarClose.addEventListener('click', close);
    document.addEventListener('click', e => {
        if (sidebar.classList.contains('active') && !sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) close();
    });

    // ================= NAV STATE =================
    document.querySelectorAll('.sidebar-nav .nav-item').forEach(item => {
        item.addEventListener('click', e => {
            e.preventDefault();
            document.querySelectorAll('.sidebar-nav .nav-item').forEach(n => n.classList.remove('active'));
            item.classList.add('active');
            close();
        });
    });

    // ================= LOGOUT =================
    logoutBtn.addEventListener('click', e => {
        e.preventDefault();
        if (confirm('¿Seguro que deseas cerrar sesión?')) {
            console.log('Cerrando sesión...');
            // window.location.href = '/login.html';
        }
    });

    // ================= DATE =================
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    dateDisplay.textContent = new Date().toLocaleDateString('es-ES', options);

    // ================= APPOINTMENT ACTIONS (Micro-interactions) =================
    document.querySelectorAll('.btn-action.complete').forEach(btn => {
        btn.addEventListener('click', function () {
            const card = this.closest('.appointment-card');
            card.classList.remove('current');
            card.classList.add('completed');
            this.closest('.actions').innerHTML = '<span class="badge status-completed">Completada</span>';
            // Aquí iría la llamada a tu API para actualizar estado
        });
    });

    document.querySelectorAll('.btn-action.start').forEach(btn => {
        btn.addEventListener('click', function () {
            const card = this.closest('.appointment-card');
            card.classList.remove('upcoming');
            card.classList.add('current');
            this.closest('.actions').innerHTML = '<span class="badge status-active">En curso</span><button class="btn-action complete" title="Completar"><i data-lucide="check"></i></button>';
            lucide.createIcons();
            // Vincular el nuevo botón "complete" al mismo handler
            document.querySelectorAll('.btn-action.complete').forEach(b => b.click()); // Re-attach si es necesario en producción
        });
    });
});