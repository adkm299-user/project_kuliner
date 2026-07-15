<?php $this->extend('layout'); ?>
<?php $this->section('content'); ?>

<div class="pagetitle mb-4">
    <h1 class="fw-bold text-dark" style="letter-spacing: -0.5px;">Kelola Data Kuliner</h1>
    <nav>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/" class="text-muted text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active text-green-main fw-semibold">Kelola Kuliner</li>
        </ol>
    </nav>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success border-0 bg-success bg-opacity-10 text-green-main py-2 px-3 rounded-3 small mb-4 shadow-sm">
        <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 custom-admin-table">
                <thead>
                    <tr>
                        <th class="ps-4 text-center" width="60">#</th>
                        <th>Nama Kuliner</th>
                        <th>Kategori</th>
                        <th>Alamat</th>
                        <th width="100" class="text-center">Rating</th>
                        <th width="120" class="text-center">Status Saat Ini</th>
                        <th width="240" class="pe-4 text-center">Ubah Status / Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($kuliners)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-folder2-open fs-2 d-block opacity-25 mb-2"></i>
                                Belum ada data kuliner masuk.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($kuliners as $i => $k): ?>
                        <tr>
                            <td class="ps-4 text-center text-muted small"><?= $i + 1 ?></td>
                            <td>
                                <span class="fw-bold text-dark d-block mb-0" style="font-size: 0.95rem;">
                                    <?= esc($k['nama']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="text-green-main fw-bold text-uppercase tracking-wider extra-small bg-green-light px-2 py-1 rounded">
                                    <?= esc($k['kategori_nama']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="text-muted small text-truncate d-block" style="max-width: 200px;" title="<?= esc($k['alamat']) ?>">
                                    <?= esc($k['alamat']) ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark border rounded px-2 py-1 small fw-bold">
                                    <i class="bi bi-star-fill text-warning me-1"></i><?= number_format($k['rating_avg'], 1) ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <?php if ($k['status'] == 'approved'): ?>
                                    <span class="badge-status status-approved">Approved</span>
                                <?php elseif ($k['status'] == 'pending'): ?>
                                    <span class="badge-status status-pending">Pending</span>
                                <?php else: ?>
                                    <span class="badge-status status-rejected">Rejected</span>
                                <?php endif; ?>
                            </td>
                            <td class="pe-4">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    
                                    <form action="/admin/kuliner/status/<?= $k['id'] ?>" method="post" class="m-0 d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="status" value="pending">
                                        <button type="submit" class="btn-action btn-action-pending <?= $k['status'] == 'pending' ? 'active-status' : '' ?>" title="Set ke Pending">
                                            <i class="bi bi-dash-circle-fill"></i>
                                        </button>
                                    </form>

                                    <form action="/admin/kuliner/status/<?= $k['id'] ?>" method="post" class="m-0 d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="btn-action btn-action-approve <?= $k['status'] == 'approved' ? 'active-status' : '' ?>" title="Set ke Approve">
                                            <i class="bi bi-check-circle-fill"></i>
                                        </button>
                                    </form>

                                    <form action="/admin/kuliner/status/<?= $k['id'] ?>" method="post" class="m-0 d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn-action btn-action-reject <?= $k['status'] == 'rejected' ? 'active-status' : '' ?>" title="Set ke Reject">
                                            <i class="bi bi-x-circle-fill"></i>
                                        </button>
                                    </form>

                                    <div class="vr mx-2 text-secondary opacity-25" style="height: 20px;"></div>

                                    <a href="/admin/kuliner/hapus/<?= $k['id'] ?>" 
                                       class="btn btn-action btn-action-delete"
                                       onclick="return confirm('Yakin ingin menghapus data kuliner ini?')"
                                       title="Hapus Permanen">
                                        <i class="bi bi-trash3-fill"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
:root {
    --green-emerald: #006642;
    --green-dark: #004d32;
}

.text-green-main { color: var(--green-emerald) !important; }
.bg-green-light { background-color: rgba(0, 102, 66, 0.06) !important; }

/* KUSTOMISASI TABEL */
.custom-admin-table thead th {
    background-color: #f8fafc !important;
    font-size: 0.75rem;
    text-uppercase: uppercase;
    letter-spacing: 0.8px;
    font-weight: 700;
    color: #64748b;
    padding: 16px 12px;
    border-bottom: 1px solid #e2e8f0;
}

.custom-admin-table tbody td {
    padding: 16px 12px;
    border-bottom: 1px solid #f1f5f9;
}

/* BADGE STATUS */
.badge-status {
    display: inline-block;
    padding: 4px 10px;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 6px;
    width: 85px;
}
.status-approved { background-color: #dcfce7; color: #15803d; }
.status-pending { background-color: #fef9c3; color: #a16207; }
.status-rejected { background-color: #fee2e2; color: #b91c1c; }

/* TOMBOL CIRLCE UTAMA */
.btn-action {
    border: none;
    background: transparent;
    padding: 6px;
    font-size: 1.25rem;
    border-radius: 50%;
    line-height: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    opacity: 0.35; /* Status tombol tidak terpilih dibuat samar/kalem */
}

/* Tombol akan menyala penuh jika berstatus aktif saat ini */
.btn-action.active-status {
    opacity: 1 !important;
    transform: scale(1.1);
}

.btn-action-pending { color: #eab308; }
.btn-action-pending:hover { opacity: 1; background-color: #fef9c3; }

.btn-action-approve { color: #22c55e; }
.btn-action-approve:hover { opacity: 1; background-color: #dcfce7; }

.btn-action-reject { color: #ef4444; }
.btn-action-reject:hover { opacity: 1; background-color: #fee2e2; }

.btn-action-delete { color: #94a3b8; opacity: 1; }
.btn-action-delete:hover { color: #ef4444; background-color: #fee2e2; }

.extra-small { font-size: 0.7rem; }
</style>

<?php $this->endSection(); ?>