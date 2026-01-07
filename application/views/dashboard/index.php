<div class="container-fluid dashboard-content">

    <!-- Page Heading -->
    <div class="mb-4 text-center">
        <h1 class="h4 font-weight-bold text-white mb-1">
            Selamat Datang, Administrator 👋
        </h1>
        <small class="text-muted">
            Ringkasan Keuangan BUMDes
        </small>
    </div>

    <div class="row">

        <!-- SALDO KAS -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-blue h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-primary mb-1">
                                <i class="fas fa-wallet mr-1"></i> Saldo Kas
                            </h6>
                            <h4 class="font-weight-bold text-white mb-0">
                                Rp <?= number_format($saldo_kas ?? 0, 0, ',', '.') ?>
                            </h4>
                        </div>
                        <i class="fas fa-coins fa-2x text-primary opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- PENDAPATAN -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-green h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-success mb-1">
                                <i class="fas fa-arrow-up mr-1"></i> Pendapatan
                            </h6>
                            <h4 class="font-weight-bold text-white mb-0">
                                Rp <?= number_format($pendapatan ?? 0, 0, ',', '.') ?>
                            </h4>
                        </div>
                        <i class="fas fa-chart-line fa-2x text-success opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- BEBAN -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-red h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-danger mb-1">
                                <i class="fas fa-arrow-down mr-1"></i> Beban
                            </h6>
                            <h4 class="font-weight-bold text-white mb-0">
                                Rp <?= number_format($beban ?? 0, 0, ',', '.') ?>
                            </h4>
                        </div>
                        <i class="fas fa-receipt fa-2x text-danger opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<style>
/* ===============================
   DASHBOARD SPACING
================================ */
.dashboard-content {
    padding-top: 1rem;
}

/* Icon opacity */
.opacity-50 {
    opacity: 0.5;
}
</style>
