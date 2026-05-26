document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('themeToggle');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarClose = document.getElementById('sidebarClose');
    const logoutBtn = document.getElementById('logoutBtn');
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
        item.addEventListener('click', () => {
          
            document.querySelectorAll('.sidebar-nav .nav-item').forEach(n => n.classList.remove('active'));
            item.classList.add('active');
            close();
        });
    });

    // ================= LOGOUT =================
    logoutBtn.addEventListener('click', () => {
        
        if (confirm('¿Seguro que deseas cerrar sesión?')) {
            console.log('Cerrando sesión cliente...');
            // window.location.href = '/login.html';
        }
    });

    // ================= CTA RESERVAR =================
    const btnReservar = document.querySelector('.btn-reservar');
    if (btnReservar) {
        btnReservar.addEventListener('click', () => {
            // Aquí redirigirías al flujo de reserva real
            alert('Abriendo calendario de reservas...');
            // window.location.href = '/reservar.html';
        });
    }

    // ================= BARBER BOOK BUTTONS =================
    document.querySelectorAll('.btn-book-sm').forEach(btn => {
        btn.addEventListener('click', function () {
            const barber = this.closest('.barber-card').querySelector('h4').textContent;
            alert(`Reserva iniciada con ${barber}`);
            // window.location.href = `/reservar?barber=${encodeURIComponent(barber)}`;
        });
    });
});