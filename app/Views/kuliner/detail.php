<?php $this->extend('layout'); ?>
<?php $this->section('content'); ?>

<div class="pagetitle mb-3">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-muted text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="/kuliner" class="text-muted text-decoration-none">Kuliner</a></li>
            <li class="breadcrumb-item active text-green-main fw-semibold"><?= $kuliner['nama'] ?></li>
        </ol>
    </nav>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success border-0 bg-success bg-opacity-10 text-green-main py-2 px-3 rounded-3 small mb-3">
        <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4 bg-white">
    <div class="row g-0">
        <?php if ($kuliner['foto']): ?>
        <div class="col-md-5">
            <img src="/uploads/kuliner/<?= $kuliner['foto'] ?>" class="w-100 h-100" style="object-fit: cover; min-height: 250px; max-height: 280px;" alt="<?= $kuliner['nama'] ?>">
        </div>
        <?php endif; ?>
        
        <div class="<?= $kuliner['foto'] ? 'col-md-7' : 'col-12' ?> p-4 d-flex flex-column justify-content-between">
            <div>
                <span class="text-green-main fw-bold text-uppercase tracking-wider extra-small mb-1 d-block">
                    <?= $kuliner['kategori_nama'] ?>
                </span>
                <h3 class="fw-bold text-dark mb-2" style="letter-spacing: -0.5px;"><?= $kuliner['nama'] ?></h3>
                
                <p class="text-muted small mb-3">
                    <i class="bi bi-geo-alt-fill text-green-main me-1"></i> <?= $kuliner['alamat'] ?>
                </p>

                <div class="d-flex align-items-center mb-3 text-dark small gap-2">
                    <span class="fw-bold px-2 py-0-5 bg-light rounded text-dark border"><?= number_format($kuliner['rating_avg'], 1) ?> / 5.0</span>
                    <div class="text-warning">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="bi bi-star<?= $i <= round($kuliner['layout'] ?? $kuliner['rating_avg']) ? '-fill' : '' ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <span class="text-muted opacity-75">(<?= count($reviews) ?> Ulasan)</span>
                </div>

                <div class="text-secondary small mt-2" style="line-height: 1.6;">
                    <?= nl2br(esc($kuliner['deskripsi'])) ?>
                </div>
            </div>
            
            <?php if ($kuliner['lat'] && $kuliner['lng']): ?>
            <div class="pt-3 border-top mt-3 text-end">
                <a href="https://www.google.com/maps/search/?api=1&query=<?= $kuliner['lat'] ?>,<?= $kuliner['lng'] ?>" target="_blank" class="btn btn-sm btn-outline-green rounded-2">
                    <i class="bi bi-box-arrow-up-right me-1"></i> Petunjuk Rute Maps
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-7">
        <div class="card border-0 shadow-sm rounded-3 bg-white">
            <div class="card-body p-4">
                <h6 class="fw-bold text-dark mb-3 border-bottom pb-2">Semua Ulasan (<?= count($reviews) ?>)</h6>
                
                <?php if (empty($reviews)): ?>
                    <p class="text-muted small my-3">Belum ada ulasan untuk tempat ini.</p>
                <?php else: ?>
                    <div style="max-height: 320px; overflow-y: auto;" class="pe-1">
                        <?php foreach ($reviews as $r): ?>
                        <div class="border-bottom pb-3 mb-3 last-no-border">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark small"><i class="bi bi-person-circle text-secondary me-1"></i> <?= esc($r['username']) ?></span>
                                <span class="text-muted extra-small"><?= date('d M Y', strtotime($r['created_at'])) ?></span>
                            </div>
                            <div class="text-warning extra-small mb-1">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="bi bi-star<?= $i <= $r['rating'] ? '-fill' : '' ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <?php if ($r['komentar']): ?>
                                <p class="text-secondary small mb-0 bg-light p-2 rounded-2 mt-1"><?= esc($r['komentar']) ?></p>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card border-0 shadow-sm rounded-3 bg-white">
            <div class="card-body p-4">
                <h6 class="fw-bold text-dark mb-3 border-bottom pb-2">Tulis Review</h6>
                
                <?php if (session()->get('isLoggedIn')): ?>
                <form action="<?= base_url('review/simpan/'.$kuliner['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-medium mb-1">Pilih Rating</label>
                        <div class="star-rating d-flex flex-row-reverse justify-content-end gap-1 fs-4">
                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                <input type="radio" name="rating" value="<?= $i ?>" id="star-<?= $i ?>" required>
                                <label for="star-<?= $i ?>" class="bi bi-star-fill text-muted pointer"></label>
                            <?php endfor; ?>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <textarea name="komentar" class="form-control form-control-sm border-2 focus-green" rows="3" placeholder="Tulis komentar pendek di sini..." required></textarea>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-sm btn-green text-white fw-medium py-2 rounded-2">Kirim Review</button>
                    </div>
                </form>
                <?php else: ?>
                <div class="text-center py-3">
                    <p class="text-muted small mb-2">Login untuk memberikan review</p>
                    <a href="<?= base_url('login') ?>" class="btn btn-sm btn-outline-green px-3 rounded-2">Sign In</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --green-emerald: #006642;
    --green-dark: #004d32;
}

.text-green-main { color: var(--green-emerald) !important; }
.btn-green { background-color: var(--green-emerald) !important; border: none; }
.btn-green:hover { background-color: var(--green-dark) !important; }
.btn-outline-green { color: var(--green-emerald) !important; border-color: var(--green-emerald) !important; }
.btn-outline-green:hover { background-color: var(--green-emerald) !important; color: #fff !important; }

.focus-green:focus {
    border-color: rgba(0, 102, 66, 0.4) !important;
    box-shadow: 0 0 0 0.2rem rgba(0, 102, 66, 0.1) !important;
}

.extra-small { font-size: 0.75rem; letter-spacing: 0.5px; }
.py-0-5 { padding-top: 1px; padding-bottom: 1px; }
.pointer { cursor: pointer; }

/* RATING BINTANG KETIKA DIKLIK */
.star-rating input { display: none; }
.star-rating label:hover,
.star-rating label:hover ~ label,
.star-rating input:checked ~ label {
    color: #ffc107 !important;
}

.last-no-border:last-child { border-bottom: none !important; margin-bottom: 0 !important; padding-bottom: 0 !important; }
</style>

<?php $this->endSection(); ?>