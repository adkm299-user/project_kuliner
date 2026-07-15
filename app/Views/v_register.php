<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Register - Kuliner Semarang</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .accent-color { color: #2d6a4f; }
        .bg-accent { background-color: #2d6a4f; }
        .focus-ring:focus { border-color: #2d6a4f; outline: none; box-shadow: 0 0 0 1px #2d6a4f; }
    </style>
</head>

<body class="text-slate-700 min-h-screen flex flex-col justify-between">

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

    <main class="flex-grow flex items-center justify-center px-4 py-8 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden max-w-4xl w-full grid md:grid-cols-12 min-h-[550px]">
            
            <div class="hidden md:flex md:col-span-5 relative bg-slate-900 items-center justify-center p-8 text-center text-white overflow-hidden">
                <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=600&q=80" alt="Kuliner Semarang" class="absolute inset-0 w-full h-full object-cover opacity-35 mix-blend-multiply scale-105">
                <div class="absolute inset-0 bg-gradient-to-b from-emerald-900/40 to-emerald-950/80 z-0"></div>
                
                <div class="relative z-10 space-y-3">
                    <i class="fa-solid fa-pizza-slice text-3xl opacity-80"></i>
                    <h3 class="text-xl font-bold tracking-tight">Mulai Petualangan Kulinermu</h3>
                    <p class="text-xs text-emerald-100/80 leading-relaxed max-w-[200px] mx-auto">
                        Daftar akun hari ini untuk membagikan review tempat makan legendaris di Kota Semarang.
                    </p>
                </div>
            </div>

            <div class="col-span-12 md:col-span-7 p-8 sm:p-10 flex flex-col justify-center space-y-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">Buat Akun Baru</h2>
                    <p class="text-sm text-slate-400 mt-1">Gabung bersama komunitas kontributor Kuliner Semarang</p>
                </div>

                <?php if (session()->getFlashdata('failed')): ?>
                    <div class="bg-red-50 text-red-600 border border-red-100 p-3.5 rounded-xl text-xs flex items-center gap-2">
                        <i class="fa-solid fa-circle-exclamation text-base"></i>
                        <span><?= session()->getFlashdata('failed') ?></span>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="bg-emerald-50 text-emerald-600 border border-emerald-100 p-3.5 rounded-xl text-xs flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-base"></i>
                        <span><?= session()->getFlashdata('success') ?></span>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('register') ?>" method="post" class="space-y-4">
                    <?= csrf_field() ?>

                    <div>
                        <label class="block text-sm font-semibold text-slate-800 mb-2">Username</label>
                        <div class="relative">
                            <input type="text" name="username" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus-ring transition" placeholder="Buat nama pengguna unik..." required>
                            <i class="fa-solid fa-user absolute left-3.5 top-3.5 text-slate-400 text-sm"></i>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-800 mb-2">Email</label>
                        <div class="relative">
                            <input type="email" name="email" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus-ring transition" placeholder="Contoh: rasa@semarang.com" required>
                            <i class="fa-solid fa-envelope absolute left-3.5 top-3.5 text-slate-400 text-sm"></i>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-800 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" name="password" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus-ring transition" placeholder="Minimal 6 karakter..." required minlength="6">
                            <i class="fa-solid fa-lock absolute left-3.5 top-3.5 text-slate-400 text-sm"></i>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-accent text-white font-medium py-2.5 rounded-xl hover:bg-emerald-800 transition shadow-xs text-sm cursor-pointer">
                            Daftar Sekarang
                        </button>
                    </div>
                </form>

                <div class="text-center text-sm text-slate-400 pt-2 border-t border-slate-50">
                    Sudah punya akun? <a href="<?= base_url('login') ?>" class="accent-color font-semibold hover:underline">Login di sini</a>
                </div>
            </div>

        </div>
    </main>

    <footer class="py-4 border-t border-slate-100 text-center text-xs text-slate-400 bg-white">
        &copy; 2026 KulinerSemarang. Project PWL.
    </footer>

</body>
</html>