<?php $this->extend('layout'); ?>
<?php $this->section('content'); ?>

<div class="pagetitle mb-4 mt-2">
    <h1 class="fw-bold text-dark" style="letter-spacing: -1px; font-size: 1.75rem;">Akun Anda</h1>
    <p class="text-muted small">Informasi detail akses sistem kuliner</p>
</div>

<div class="row">
    <div class="col-lg-10 col-xl-8">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="row g-0">
                    
                    <div class="col-md-4 bg-light d-flex flex-column align-items-center justify-content-center p-5 border-end border-light">
                        <div class="position-relative mb-3">
                            <img src="<?= base_url('NiceAdmin/assets/img/profile-img.jpg') ?>" 
                                 alt="Profile" 
                                 class="rounded-circle shadow-sm p-1 bg-white" 
                                 style="width: 130px; height: 130px; object-fit: cover;">
                            <?php if ($aktif == 1): ?>
                                <div class="status-indicator" title="Akun Aktif"></div>
                            <?php endif; ?>
                        </div>
                        <h5 class="fw-bold text-dark mb-1 text-capitalize"><?= esc($role) ?></h5>
                        <p class="text-muted extra-small text-uppercase tracking-widest fw-semibold">Sistem Akses</p>
                    </div>

                    <div class="col-md-8 p-5 bg-white d-flex flex-column justify-content-center">
                        
                        <div class="info-row mb-4">
                            <label class="text-muted extra-small text-uppercase tracking-wider fw-bold">Hak Akses / Jabatan</label>
                            <div class="d-flex align-items-center mt-1">
                                <div class="icon-box me-3"><i class="bi bi-shield-check"></i></div>
                                <span class="fw-bold text-dark fs-5 text-capitalize"><?= esc($role) ?></span>
                            </div>
                        </div>

                        <div class="info-row mb-4">
                            <label class="text-muted extra-small text-uppercase tracking-wider fw-bold">Status Keanggotaan</label>
                            <div class="d-flex align-items-center mt-1">
                                <div class="icon-box me-3"><i class="bi bi-check-all"></i></div>
                                <span class="fw-semibold <?= ($aktif == 1) ? 'text-success' : 'text-danger' ?>">
                                    <?= ($aktif == 1) ? 'Terverifikasi & Aktif' : 'Akun Tidak Aktif' ?>
                                </span>
                            </div>
                        </div>

                        <div class="info-row">
                            <label class="text-muted extra-small text-uppercase tracking-wider fw-bold">Opsi Akun</label>
                            <div class="d-flex gap-2 mt-2">
                                <a href="<?= base_url('logout') ?>" class="btn-minimal-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>Keluar Sistem
                                </a>
                                <a href="<?= base_url('Dashboard') ?>" class="btn-minimal-green">
                                    <i class="bi bi-arrow-left me-2"></i>Dashboard
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Reset & Global Dashboard Background */
#main, .main {
    background-color: #fafbfc !important; /* Abu-abu sangat tipis agar card putih menonjol */
    min-height: 100vh;
}

:root {
    --emerald: #006642;
    --emerald-soft: rgba(0, 102, 66, 0.08);
}

/* Status Dot Hijau Melayang */
.status-indicator {
    position: absolute;
    bottom: 8px;
    right: 12px;
    width: 18px;
    height: 18px;
    background-color: #22c55e;
    border: 3px solid #fff;
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Icon Box Akses */
.icon-box {
    width: 38px;
    height: 38px;
    background-color: var(--emerald-soft);
    color: var(--emerald);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    font-size: 1.2rem;
}

/* Tombol Minimalis ala Desain Modern */
.btn-minimal-danger {
    padding: 8px 18px;
    background: transparent;
    border: 1px solid #fee2e2;
    color: #dc2626;
    text-decoration: none;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 600;
    transition: all 0.2s;
}
.btn-minimal-danger:hover {
    background-color: #ef4444;
    color: #fff;
    border-color: #ef4444;
}

.btn-minimal-green {
    padding: 8px 18px;
    background: var(--emerald-soft);
    border: 1px solid transparent;
    color: var(--emerald);
    text-decoration: none;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 600;
    transition: all 0.2s;
}
.btn-minimal-green:hover {
    background-color: var(--emerald);
    color: #fff;
}

.extra-small {
    font-size: 0.65rem;
    letter-spacing: 1px;
}
</style>

<?php $this->endSection(); ?>