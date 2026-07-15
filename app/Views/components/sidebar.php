<aside id="sidebar" class="sidebar custom-sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == '' || uri_string() == 'Dashboard') ? 'active-menu' : 'collapsed' ?>" href="<?= base_url('Dashboard') ?>">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == 'kuliner') ? 'active-menu' : 'collapsed' ?>" href="<?= base_url('kuliner') ?>">
                <i class="bi bi-collection-fill"></i>
                <span>Daftar Kuliner</span>
            </a>
        </li>

        <?php if (session()->get('role') == 'kontributor') : ?>
        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == 'kuliner/tambah') ? 'active-menu' : 'collapsed' ?>" href="<?= base_url('kuliner/tambah') ?>">
                <i class="bi bi-plus-circle-fill"></i>
                <span>Tambah Kuliner</span>
            </a>
        </li>
        <?php endif; ?>

        <?php if (session()->get('role') == 'admin') : ?>
        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == 'admin/kuliner') ? 'active-menu' : 'collapsed' ?>" href="<?= base_url('admin/kuliner') ?>">
                <i class="bi bi-shield-lock-fill"></i>
                <span>Kelola Kuliner</span>
            </a>
        </li>
        <?php endif; ?>

        <li class="nav-heading mt-3 mb-1 px-3 text-uppercase text-muted extra-small font-weight-bold" style="letter-spacing: 1px;">Akun</li>

        <li class="nav-item">
            <a class="nav-link collapsed text-danger-hover" href="<?= base_url('logout') ?>">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </li>

    </ul>

</aside><style>
/* MODIFIKASI TOTAL SIDEBAR PREMIUM */
.custom-sidebar {
    background-color: #ffffff !important;
    border-right: 1px solid #edf2f7 !important;
    box-shadow: none !important;
    padding: 20px 14px !important;
}

/* Mengatur ulang gaya default link item */
.custom-sidebar .sidebar-nav .nav-link {
    font-size: 0.9rem !important;
    font-weight: 500 !important;
    padding: 10px 15px !important;
    border-radius: 8px !important;
    margin-bottom: 4px !important;
    background: transparent !important;
    color: #4b5563 !important; /* Warna teks kalem default */
    transition: all 0.2s ease-in-out !important;
}

/* Efek Icon Default */
.custom-sidebar .sidebar-nav .nav-link i {
    font-size: 1.1rem !important;
    color: #9ca3af !important;
    margin-right: 10px !important;
    transition: color 0.2s ease !important;
}

/* EFEK KETIKA MENU AKTIF/DIKLIK */
.custom-sidebar .sidebar-nav .nav-link.active-menu {
    background-color: rgba(0, 102, 66, 0.08) !important; /* Hijau transparan lembut */
    color: #006642 !important; /* Teks Hijau Emerald */
}
.custom-sidebar .sidebar-nav .nav-link.active-menu i {
    color: #006642 !important; /* Ikon Hijau Emerald */
}

/* EFEK HOVER (KETIKA DISENTUH KURSOR) */
.custom-sidebar .sidebar-nav .nav-link:hover {
    background-color: #f3f4f6 !important;
    color: #111827 !important;
}
.custom-sidebar .sidebar-nav .nav-link:hover i {
    color: #4b5563 !important;
}

/* Efek Hover Khusus Logout (Merah Lembut) */
.custom-sidebar .sidebar-nav .nav-link.text-danger-hover:hover {
    background-color: #fef2f2 !important;
    color: #dc2626 !important;
}
.custom-sidebar .sidebar-nav .nav-link.text-danger-hover:hover i {
    color: #dc2626 !important;
}

.extra-small {
    font-size: 0.7rem !important;
}
</style>