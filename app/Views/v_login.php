<?= $this->extend('layout_clear') ?>
<?= $this->section('main') ?>

<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
    .accent-color { color: #2d6a4f; }
    .bg-accent { background-color: #2d6a4f; }
    /* Override class form-control bawaan input helper agar matching dengan style landing page */
    .form-control {
        width: 100% !important;
        padding-left: 2.5rem !important;
        padding-right: 1rem !important;
        padding-top: 0.625rem !important;
        padding-bottom: 0.625rem !important;
        background-color: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 0.75rem !important;
        font-size: 0.875rem !important;
        color: #334155 !important;
        transition: all 0.2s;
    }
    .form-control:focus {
        border-color: #2d6a4f !important;
        outline: none !important;
        box-shadow: 0 0 0 1px #2d6a4f !important;
    }
</style>

<?php
// Tetap mempertahankan array helper bawaan codinganmu agar backend tidak error
$username = [
    'name' => 'username',
    'id' => 'username',
    'class' => 'form-control',
    'placeholder' => 'Masukkan username anda...'
];

$password = [
    'name' => 'password',
    'id' => 'password',
    'class' => 'form-control',
    'placeholder' => 'Masukkan password anda...'
];
?>

<nav class="bg-white border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="<?= base_url('/') ?>" class="text-xl font-bold tracking-tight accent-color">
            <i class="fa-solid font-black fa-utensils mr-2"></i>KulinerSemarang
        </a>
        <a href="<?= base_url('/') ?>" class="text-sm font-medium text-slate-500 hover:text-slate-800 transition">
            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Beranda
        </a>
    </div>
</nav>

<div class="min-h-[80vh] flex flex-col justify-center items-center px-6 py-12">
    <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-xs w-full max-w-md space-y-6">
        
        <div class="text-center">
            <h1 class="text-2xl font-bold text-slate-800">Selamat Datang Kembali</h1>
            <p class="text-sm text-slate-400 mt-1">Masuk untuk melihat detail tempat dan review kuliner</p>
        </div>

        <?php if (session()->getFlashData('failed')) : ?>
            <div class="bg-red-50 text-red-600 border border-red-100 p-4 rounded-xl text-xs flex items-center gap-2" role="alert">
                <i class="fa-solid fa-circle-exclamation text-base"></i>
                <span><?= session()->getFlashData('failed') ?></span>
            </div>
        <?php endif; ?>

        <?= form_open('login', 'class="space-y-4"') ?>

            <div>
                <label for="username" class="block text-sm font-semibold text-slate-800 mb-2">Username</label>
                <div class="relative">
                    <?= form_input($username) ?>
                    <i class="fa-solid fa-user absolute left-3.5 top-3.5 text-slate-400 text-sm"></i>
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-slate-800 mb-2">Password</label>
                <div class="relative">
                    <?= form_password($password) ?>
                    <i class="fa-solid fa-lock absolute left-3.5 top-3.5 text-slate-400 text-sm"></i>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" name="submit" class="w-full bg-accent text-white font-medium py-2.5 rounded-xl hover:bg-emerald-800 transition shadow-xs text-sm cursor-pointer">
                    Masuk Sekarang
                </button>
            </div>

        <?= form_close() ?>

        <div class="text-center text-sm text-slate-400 pt-2 border-t border-slate-100">
            Belum punya akun? <a href="<?= base_url('register') ?>" class="accent-color font-semibold hover:underline">Daftar di sini</a>
        </div>
    </div>
</div>

<footer class="py-4 border-t border-slate-100 text-center text-xs text-slate-400 bg-white w-full">
    &copy; 2026 KulinerSemarang. Project PWL.
</footer>

<?= $this->endSection() ?>