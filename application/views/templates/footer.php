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
/* =====================================================
   GLOBAL UI HANDLER (AMAN)
===================================================== */
$(document).ready(function () {

    /* Auto close sidebar on mobile */
    if ($(window).width() < 768) {
        $('.sidebar .nav-item a').on('click', function () {
            $('body').removeClass('sidebar-toggled');
            $('.sidebar').removeClass('toggled');
        });
    }

    /* ===============================
       DARK MODE (PERSIST)
    ================================ */
    const theme = localStorage.getItem('theme');

    if (theme === 'dark') {
        $('body').addClass('dark-mode');
        $('#themeToggle i').removeClass('fa-moon').addClass('fa-sun');
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

</style>

</body>
</html>
