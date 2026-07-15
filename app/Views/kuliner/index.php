<?php $this->extend('layout'); ?>
<?php $this->section('content'); ?>

<div class="pagetitle mb-4">
    <h1 class="fw-bold text-dark" style="letter-spacing: -0.5px;">Daftar Kuliner Semarang</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-muted text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active text-green-main fw-semibold">Kuliner</li>
        </ol>
    </nav>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success border-0 bg-success bg-opacity-10 text-green-main rounded-3 shadow-sm alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row mb-4">
    <div class="col">
        <?php if (session()->get('isLoggedIn')): ?>
            <a href="/kuliner/tambah" class="btn btn-green px-4 py-2-5 rounded-3 text-white fw-medium shadow-sm transition-all">
                <i class="bi bi-plus-lg me-1"></i> Tambah Kuliner
            </a>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <?php foreach ($kuliners as $k): ?>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 border-0 shadow-sm rounded-4 p-3 bg-white card-minimalist">
            
            <div class="img-wrapper rounded-3 overflow-hidden position-relative">
                <?php if ($k['foto']): ?>
                    <img src="/uploads/kuliner/<?= $k['foto'] ?>" class="card-img-top img-modern" style="height:210px; object-fit:cover;" alt="<?= $k['nama'] ?>">
                <?php else: ?>
                    <div class="card-img-top bg-light d-flex flex-column align-items-center justify-content-center text-muted" style="height:210px;">
                        <i class="bi bi-image fs-1 text-green-main opacity-25 mb-2"></i>
                        <span class="small tracking-wide opacity-50">Belum ada foto</span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="card-body px-1 pt-3 pb-0 d-flex flex-column justify-content-between">
                <div>
                    <div class="text-green-main fw-bold text-uppercase tracking-wider extra-small mb-1">
                        <?= $k['kategori_nama'] ?>
                    </div>
                    
                    <h5 class="fw-bold text-dark mb-2" style="font-size: 1.2rem; line-height: 1.3;"><?= $k['nama'] ?></h5>
                    
                    <p class="text-muted small mb-3 d-flex align-items-start">
                        <i class="bi bi-geo-alt me-1 text-secondary pt-0-5"></i>
                        <span><?= $k['alamat'] ?></span>
                    </p>
                </div>
                
                <div class="d-flex align-items-center justify-content-between pt-3 border-top border-light">
                    <div class="d-flex align-items-center">
                        <div class="me-1">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="bi bi-star<?= $i <= round($k['rating_avg']) ? '-fill text-warning' : ' text-muted opacity-25' ?>" style="font-size: 0.9rem;"></i>
                            <?php endfor; ?>
                        </div>
                        <span class="text-dark small fw-bold ms-1"><?= number_format($k['rating_avg'], 1) ?></span>
                    </div>
                    
                    <a href="/kuliner/<?= $k['slug'] ?>" class="btn-detail-link fw-semibold text-decoration-none transition-all">
                        Lihat Detail <i class="bi bi-arrow-right ms-1 text-arrow"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
    <?php endforeach; ?>
</div>

<style>
/* VARIABEL WARNA HIJUAU EMERALD SESUAI LANDING PAGE */
:root {
    --green-emerald: #006642;
    --green-dark: #004d32;
}

.text-green-main {
    color: var(--green-emerald) !important;
}

/* TOMBOL TAMBAH DATA KULINER */
.btn-green {
    background-color: var(--green-emerald) !important;
    border: none;
    letter-spacing: 0.3px;
}
.btn-green:hover {
    background-color: var(--green-dark) !important;
    transform: translateY(-1px);
}
.py-2-5 {
    padding-top: 0.6rem;
    padding-bottom: 0.6rem;
}

/* KARTU GAYA MINIMALIS */
.card-minimalist {
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}
.card-minimalist:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.06) !important;
}

/* GAMBAR DAN HOVER ANIMASI NYA */
.img-wrapper {
    position: relative;
    background-color: #f8fafc;
}
.img-modern {
    transition: transform 0.5s ease;
}
.card-minimalist:hover .img-modern {
    transform: scale(1.04);
}

/* TYPOGRAPHY KUSTOM */
.extra-small {
    font-size: 0.75rem;
    letter-spacing: 1px;
}
.tracking-wide {
    letter-spacing: 0.5px;
}
.pt-0-5 {
    padding-top: 2px;
}

/* LINK MENU LIHAT DETAIL */
.btn-detail-link {
    color: #475569;
    font-size: 0.9rem;
}
.btn-detail-link .text-arrow {
    transition: transform 0.2s ease;
    display: inline-block;
}
.btn-detail-link:hover {
    color: var(--green-emerald);
}
.btn-detail-link:hover .text-arrow {
    transform: translateX(4px);
    color: var(--green-emerald) !important;
}

/* TRANSISI GLOBAL */
.transition-all {
    transition: all 0.2s ease-in-out;
}
</style>

<?php $this->endSection(); ?>