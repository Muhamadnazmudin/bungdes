<div class="container-fluid dashboard-content">

    <!-- PAGE HEADING -->
    <div class="mb-5 text-center">
        <h1 class="h4 font-weight-bold text-white mb-1">
            Selamat Datang, Administrator 👋
        </h1>
        <small class="text-muted">
            Ringkasan Keuangan BUMDes
        </small>
    </div>

    <!-- DASHBOARD CARDS -->
    <div class="row">

        <!-- SALDO KAS -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card dashboard-card border-left-blue h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-label text-primary">
                            <i class="fas fa-wallet mr-1"></i> Saldo Kas
                        </div>
                        <div class="card-value">
                            Rp <?= number_format($saldo_kas ?? 0, 0, ',', '.') ?>
                        </div>
                    </div>
                    <i class="fas fa-coins card-icon text-primary"></i>
                </div>
            </div>
        </div>

        <!-- PENDAPATAN -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card dashboard-card border-left-green h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-label text-success">
                            <i class="fas fa-arrow-up mr-1"></i> Pendapatan
                        </div>
                        <div class="card-value">
                            Rp <?= number_format($pendapatan ?? 0, 0, ',', '.') ?>
                        </div>
                    </div>
                    <i class="fas fa-chart-line card-icon text-success"></i>
                </div>
            </div>
        </div>

        <!-- BEBAN -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card dashboard-card border-left-red h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-label text-danger">
                            <i class="fas fa-arrow-down mr-1"></i> Beban
                        </div>
                        <div class="card-value">
                            Rp <?= number_format($beban ?? 0, 0, ',', '.') ?>
                        </div>
                    </div>
                    <i class="fas fa-receipt card-icon text-danger"></i>
                </div>
            </div>
        </div>

    </div>

</div>

<style>
/* ===============================
   DASHBOARD FIX – LEFT ALIGNED
================================ */
.dashboard-content {
    padding-top: 2rem;
    padding-bottom: 2rem;
}

/* CARD STYLE */
.dashboard-card {
    background: rgba(255,255,255,0.04);
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.06);
    box-shadow: 0 12px 30px rgba(0,0,0,0.25);
}

.card-label {
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.card-value {
    font-size: 1.4rem;
    font-weight: 700;
    color: #ffffff;
}

.card-icon {
    font-size: 2.2rem;
    opacity: 0.35;
}

/* BORDER */
.border-left-blue  { border-left: 4px solid #4f7cff !important; }
.border-left-green { border-left: 4px solid #2ecc71 !important; }
.border-left-red   { border-left: 4px solid #e74c3c !important; }
</style>
