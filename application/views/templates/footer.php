</div> <!-- End of Content Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded d-sm-none" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Core JS -->
<script src="<?= base_url('assets/sbadmin2/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<scriptिशत src="<?= base_url('assets/sbadmin2/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
<script src="<?= base_url('assets/sbadmin2/js/sb-admin-2.min.js') ?>"></script>

<script>
/* =====================================================
   GLOBAL UI HANDLER
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

/* Sidebar resize */
$(window).on('resize', function () {
    if ($(window).width() < 768) {
        $('.sidebar').addClass('toggled');
    }
});
</script>

<style>
/* =====================================================
   GLOBAL LAYOUT
===================================================== */
.content-wrapper {
    padding-top: 3rem;
    padding-bottom: 2rem;
}

.page-content {
    margin-top: 4rem;
}

@media (max-width: 767px) {
    .content-wrapper {
        padding-top: 1.5rem;
    }

    .page-content {
        margin-top: 2rem;
    }
}

/* =====================================================
   DARK THEME
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
    color: #fff;
}

.dark-mode .topbar {
    background: #1a1d2e !important;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}

/* =====================================================
   CARD & TABLE
===================================================== */
.dark-mode .card {
    background: rgba(255,255,255,0.04);
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.06);
    box-shadow: 0 10px 25px rgba(0,0,0,0.25);
}

.dark-mode .table {
    color: #e0e0e0;
}

/* =====================================================
   TOPBAR BUTTON (THEME TOGGLE)
===================================================== */
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
</style>

</body>
</html>
