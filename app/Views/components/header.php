<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="<?= base_url() ?>" class="logo d-flex align-items-center text-decoration-none">
      <span class="d-none d-lg-block text-green-main fw-bold" style="letter-spacing: 0.5px;">KULINER</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  <div class="search-bar">
  <form class="search-form d-flex align-items-center" method="GET" action="<?= base_url('kuliner') ?>">
    <input type="text" name="keyword" placeholder="Cari kuliner favoritmu..." title="Masukkan kata kunci pencarian" value="<?= esc(request()->getGet('keyword')) ?>">
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
  </form>
</div>
  </div><nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center mb-0 list-unstyled">

      <li class="nav-item d-block d-lg-none me-2">
        <a class="nav-link nav-icon search-bar-toggle" href="#">
          <i class="bi bi-search"></i>
        </a>
      </li>

      <?php if (session()->get('isLoggedIn')): ?>
      <?php
        // Ambil notifikasi in-app untuk user yang sedang login
        $notifModel   = new \App\Models\NotificationModel();
        $daftarNotif  = $notifModel->getForUser(session()->get('user_id'), 8);
        $jumlahBelum  = $notifModel->countUnread(session()->get('user_id'));
      ?>
      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell"></i>
          <?php if ($jumlahBelum > 0): ?>
            <span class="badge bg-danger badge-number"><?= $jumlahBelum ?></span>
          <?php endif; ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications border-0 shadow-sm rounded-3 mt-3" style="min-width: 320px;">
          <li class="dropdown-header d-flex justify-content-between align-items-center bg-light rounded-top p-3">
            <span class="fw-bold text-dark">Notifikasi <?php if ($jumlahBelum > 0): ?><span class="badge bg-danger rounded-pill ms-1"><?= $jumlahBelum ?> baru</span><?php endif; ?></span>
          </li>
          <li><hr class="dropdown-divider my-0"></li>

          <?php if (empty($daftarNotif)): ?>
            <li class="text-center text-muted small py-4">Belum ada notifikasi</li>
          <?php else: ?>
            <?php foreach ($daftarNotif as $n): ?>
              <li>
                <a class="dropdown-item d-flex align-items-start py-2 <?= $n['is_read'] ? '' : 'bg-light' ?>" href="<?= base_url($n['link'] ?? '#') ?>">
                  <i class="bi bi-info-circle text-green-main me-2 mt-1"></i>
                  <span>
                    <span class="d-block small fw-semibold text-dark"><?= esc($n['judul']) ?></span>
                    <span class="d-block extra-small text-muted"><?= esc($n['pesan']) ?></span>
                    <span class="d-block extra-small text-muted opacity-75"><?= esc(date('d M Y H:i', strtotime($n['created_at']))) ?></span>
                  </span>
                </a>
              </li>
              <li><hr class="dropdown-divider my-0"></li>
            <?php endforeach; ?>
          <?php endif; ?>

          <?php if ($jumlahBelum > 0): ?>
          <li class="p-2 text-center">
            <form action="<?= base_url('notifikasi/baca-semua') ?>" method="post" class="m-0">
              <?= csrf_field() ?>
              <button type="submit" class="btn btn-sm btn-outline-success">Tandai semua sudah dibaca</button>
            </form>
          </li>
          <?php endif; ?>
        </ul>
      </li>
      <?php endif; ?>

      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="<?= base_url('NiceAdmin/assets/img/profile-img.jpg') ?>" alt="Profile" class="rounded-circle border">
          <span class="d-none d-md-block dropdown-toggle ps-2 fw-medium text-dark">
            <?= esc(session()->get('username')) ?> 
            <small class="text-muted text-capitalize">(<?= esc(session()->get('role')) ?>)</small>
          </span>
        </a><ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile border-0 shadow-sm rounded-3 mt-3">
          <li class="dropdown-header text-start bg-light rounded-top p-3">
            <h6 class="fw-bold text-dark mb-0"><?= esc(session()->get('username')) ?></h6>
            <span class="text-muted small text-capitalize"><?= esc(session()->get('role')) ?> Account</span>
          </li>
          <li>
            <hr class="dropdown-divider my-0">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center py-2" href="<?= base_url('profile') ?>">
              <i class="bi bi-person text-secondary me-2"></i>
              <span>Profil Saya</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider my-0">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center py-2 text-danger" href="<?= base_url('logout') ?>">
              <i class="bi bi-box-arrow-right me-2"></i>
              <span class="fw-medium">Sign Out</span>
            </a>
          </li>

        </ul></li></ul>
  </nav></header><style>
/* Integrasi warna hijau utama agar matching dengan navbar */
.text-green-main {
  color: #006642 !important;
}
.header-nav .nav-profile:hover, .header-nav .nav-profile:focus {
  color: #006642 !important;
}
.dropdown-item:hover {
  background-color: rgba(0, 102, 66, 0.05) !important;
}
.badge-number {
  position: absolute;
  top: 8px;
  right: 12px;
  font-size: 0.6rem;
  padding: 2px 5px;
  border-radius: 50%;
}
.extra-small {
  font-size: 0.72rem;
}
</style>