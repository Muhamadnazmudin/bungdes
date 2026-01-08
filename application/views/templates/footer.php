        </div> <!-- End of Content -->
    </div> <!-- End of Content Wrapper -->
</div> <!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded d-sm-none" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Core JS -->
<script src="<?= base_url('assets/sbadmin2/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/sbadmin2/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
<script src="<?= base_url('assets/sbadmin2/js/sb-admin-2.min.js') ?>"></script>
<script>
$(document).ready(function () {

    const theme = localStorage.getItem('theme');

    if (theme === 'dark') {
        $('body').addClass('dark-mode');
        $('#themeToggle i').removeClass('fa-moon').addClass('fa-sun');
    } else {
        $('body').removeClass('dark-mode');
        $('#themeToggle i').removeClass('fa-sun').addClass('fa-moon');
    }

    $('#themeToggle').on('click', function () {
        $('body').toggleClass('dark-mode');

        if ($('body').hasClass('dark-mode')) {
            localStorage.setItem('theme', 'dark');
            $('#themeToggle i').removeClass('fa-moon').addClass('fa-sun');
        } else {
            localStorage.setItem('theme', 'light');
            $('#themeToggle i').removeClass('fa-sun').addClass('fa-moon');
        }
    });

});
</script>
<script>
$(document).ready(function () {

    /* ===============================
       MOBILE: AUTO CLOSE SETELAH KLIK SUBMENU
    ================================ */
    if ($(window).width() < 768) {

        $('.sidebar .collapse-item').on('click', function () {

            // Tutup sidebar
            $('body').removeClass('sidebar-toggled');
            $('.sidebar').removeClass('toggled');

            // Tutup submenu (collapse)
            $(this).closest('.collapse').removeClass('show');

            // Reset parent arrow
            $(this)
                .closest('.nav-item')
                .find('.nav-link[data-toggle="collapse"]')
                .addClass('collapsed');
        });

    }

});
</script>


<style>
/* =====================================================
   DARK THEME (STYLE ONLY, NO LAYOUT)
===================================================== */
body.dark-mode {
    background: linear-gradient(180deg, #1b1f36, #14182a);
    color: #e0e0e0;
}

.dark-mode .sidebar {
    background: linear-gradient(180deg, #1a1d2e, #111424);
}

.dark-mode .sidebar .nav-link {
    color: #cfd3ff;
}

.dark-mode .sidebar .nav-link:hover,
.dark-mode .sidebar .nav-item.active .nav-link {
    background: rgba(255,255,255,0.08);
    color: #ffffff;
}

.dark-mode .topbar {
    background: #1a1d2e !important;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}

/* Card style */
.dark-mode .card {
    background: rgba(255,255,255,0.04);
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.06);
    box-shadow: 0 10px 25px rgba(0,0,0,0.25);
}

.dark-mode .table {
    color: #e0e0e0;
}

/* Theme toggle */
#themeToggle {
    width: 36px;
    height: 36px;
    padding: 0;
}

#themeToggle i {
    font-size: 14px;
    opacity: 0.85;
}

.topbar .btn-link {
    background: transparent !important;
    box-shadow: none !important;
}
/* =====================================================
   DARK MODE – CONTENT AREA
===================================================== */

/* background utama konten */
body.dark-mode #content {
    background: linear-gradient(180deg, #1b1f36, #14182a);
}

/* container halaman */
body.dark-mode .container-fluid {
    background: transparent !important;
}

/* =====================================================
   TEXT GLOBAL
===================================================== */
body.dark-mode,
body.dark-mode p,
body.dark-mode span,
body.dark-mode small,
body.dark-mode label {
    color: #e0e0e0 !important;
}

/* heading */
body.dark-mode h1,
body.dark-mode h2,
body.dark-mode h3,
body.dark-mode h4,
body.dark-mode h5,
body.dark-mode h6 {
    color: #ffffff !important;
}

/* =====================================================
   CARD
===================================================== */
body.dark-mode .card {
    background: rgba(255,255,255,0.04) !important;
    border: 1px solid rgba(255,255,255,0.08) !important;
    color: #e0e0e0;
}

/* =====================================================
   TABLE
===================================================== */
body.dark-mode .table {
    background: transparent !important;
    color: #e0e0e0 !important;
}

body.dark-mode .table thead th {
    background: rgba(255,255,255,0.06) !important;
    color: #ffffff !important;
    border-bottom: 1px solid rgba(255,255,255,0.15);
}

body.dark-mode .table td,
body.dark-mode .table th {
    border-top: 1px solid rgba(255,255,255,0.08);
}

/* hover row */
body.dark-mode .table tbody tr:hover {
    background: rgba(255,255,255,0.05);
}

/* =====================================================
   FORM & INPUT
===================================================== */
body.dark-mode .form-control {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.15);
    color: #ffffff;
}

body.dark-mode .form-control::placeholder {
    color: #aaaaaa;
}

/* =====================================================
   BUTTON LIGHT FIX
===================================================== */
body.dark-mode .btn-primary {
    background-color: #4f7cff;
    border-color: #4f7cff;
}

body.dark-mode .btn-warning {
    color: #111 !important;
}
/* =====================================================
   FINAL SCROLL LAYOUT FIX (STABIL)
===================================================== */

html, body {
    height: 100%;
    margin: 0;
    overflow: hidden; /* body TIDAK scroll */
}

/* Wrapper utama */
#wrapper {
    display: flex;
    height: 100vh;
    width: 100%;
}
#sidebar {
    width: 250px;
    background: #1e293b;
    height: 100vh;

    overflow-y: auto;   /* ✅ sidebar bisa scroll */
    overflow-x: hidden;
}
.sidebar-scroll {
    background: red;
}
/* override text-white khusus judul */
body:not(.dark-mode) h1.text-white,
body:not(.dark-mode) h2.text-white,
body:not(.dark-mode) h3.text-white {
    color: #111827 !important;
}
/* =====================================================
   SIDEBAR SUBMENU – GLASS / OPACITY
===================================================== */

/* container submenu */
.sidebar .collapse .collapse-inner,
.sidebar .collapsing .collapse-inner {
    background: rgba(255,255,255,0.08) !important; /* opacity */
    backdrop-filter: blur(6px);                   /* glass */
    -webkit-backdrop-filter: blur(6px);
    border-radius: 10px;
    padding: 0.5rem 0;
    margin: 0.25rem 0.75rem; /* jarak dari sidebar */
}

/* item submenu */
.sidebar .collapse-item {
    background: transparent !important;
    color: rgba(255,255,255,0.9) !important;
    border-radius: 6px;
    margin: 0.125rem 0.5rem;
}

/* hover */
.sidebar .collapse-item:hover {
    background: rgba(255,255,255,0.12) !important;
    color: #ffffff !important;
}

/* active */
.sidebar .collapse-item.active {
    background: rgba(255,255,255,0.2) !important;
    color: #ffffff !important;
    font-weight: 500;
}
/* =====================================================
   MOBILE SUBMENU – LIGHT MODE TEXT FIX
===================================================== */

/* KHUSUS MOBILE */
@media (max-width: 767px) {

    /* LIGHT MODE */
    body:not(.dark-mode) .sidebar .collapse-item {
        color: #111827 !important; /* hitam */
    }

    body:not(.dark-mode) .sidebar .collapse-item:hover {
        background: rgba(0,0,0,0.06) !important;
        color: #111827 !important;
    }

    body:not(.dark-mode) .sidebar .collapse-item.active {
        background: rgba(0,0,0,0.1) !important;
        color: #111827 !important;
        font-weight: 500;
    }

    /* container submenu */
    body:not(.dark-mode) .sidebar .collapse-inner {
        background: rgba(255,255,255,0.92) !important;
        backdrop-filter: blur(6px);
    }

}
/* =====================================================
   SIDEBAR LOGO
===================================================== */
.sidebar-logo {
    width: 70px;
    height: 60px;
    object-fit: contain;
}

/* mobile sedikit lebih kecil */
@media (max-width: 767px) {
    .sidebar-logo {
        width: 30px;
        height: 30px;
    }
}

</style>

</body>
</html>
