<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eksplorasi Kuliner Semarang</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .accent-color { color: #2d6a4f; }
        .bg-accent { background-color: #2d6a4f; }
        .bg-accent-light { background-color: #f4f9f4; }
        
        /* CSS Khusus Peta agar dipaksa tampil sempurna oleh Browser */
        #map { 
            height: 250px !important; 
            width: 100% !important; 
            display: block !important;
            border-radius: 12px;
            z-index: 1;
        }
    </style>
</head>
<body class="text-slate-700">
     <nav class="bg-emerald-50/50 border-b border-emerald-100 sticky top-0 z-50 backdrop-blur-md">
      <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="#" class="text-xl font-bold tracking-tight text-emerald-800">
            <i class="fa-solid font-black fa-utensils mr-2"></i>KulinerSemarang
         </a>
          <div class="flex gap-4 items-center">
             <span class="text-sm text-emerald-700/70 hidden sm:inline">Mau kontribusi review?</span>
            <a href="<?= base_url('login') ?>" class="text-sm font-medium bg-emerald-800 text-white px-5 py-2 rounded-full hover:bg-emerald-900 transition shadow-xs">Masuk / Daftar</a>
         </div>
      </div>
   </nav>

    <header class="max-w-7xl mx-auto px-6 pt-12 pb-8 text-center sm:text-left grid md:grid-cols-2 gap-8 items-center">
        <div>
            <span class="text-xs font-semibold bg-accent-light accent-color px-3 py-1.5 rounded-full uppercase tracking-wider">Kota Atlas Penuh Rasa</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-800 mt-4 leading-tight">
                Temukan Kuliner Terbaik <br class="hidden sm:inline"> di Semarang dengan Mudah
            </h1>
            <p class="text-slate-500 mt-3 text-base max-w-lg">
                Jelajahi kelezatan legendaris Kota Semarang, cek rating asli dari sesama pencinta kuliner, dan temukan rute terdekat langsung lewat peta interaktif.
            </p>
        </div>
        <div class="hidden md:block">
            <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=600&q=80" alt="Kuliner" class="rounded-2xl shadow-md grayscale-[10%] object-cover h-64 w-full">
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 pb-24 grid lg:grid-cols-3 gap-8">
        
        <section class="lg:col-span-1 bg-white p-6 rounded-2xl border border-slate-100 shadow-xs h-fit space-y-6">
            <div>
                <label class="block text-sm font-semibold text-slate-800 mb-2">Cari Kuliner</label>
                <div class="relative">
                    <input type="text" placeholder="Masukkan nama tempat atau alamat..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-emerald-700 transition">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3.5 text-slate-400 text-sm"></i>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-800 mb-2">Kategori</label>
                <select class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-emerald-700">
                    <option>Semua Kategori</option>
                    <option>Restoran / Cafe</option>
                    <option>Warung Tradisional</option>
                    <option>Street Food (Kaki Lima)</option>
                    <option>Oleh-oleh</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-800 mb-2">Tag Populer</label>
                <div class="flex flex-wrap gap-2">
                    <button class="text-xs bg-accent-light accent-color px-3 py-1.5 rounded-lg border border-emerald-100 font-medium">#Legendaris</button>
                    <button class="text-xs bg-slate-50 text-slate-500 px-3 py-1.5 rounded-lg border border-slate-100 hover:bg-slate-100">#KhasSemarang</button>
                    <button class="text-xs bg-slate-50 text-slate-500 px-3 py-1.5 rounded-lg border border-slate-100 hover:bg-slate-100">#MurahMeriah</button>
                    <button class="text-xs bg-slate-50 text-slate-500 px-3 py-1.5 rounded-lg border border-slate-100 hover:bg-slate-100">#Halal</button>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-800 mb-1.5">Rating Minimal</label>
                    <select class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none">
                        <option>⭐⭐⭐⭐⭐ (5)</option>
                        <option>⭐⭐⭐⭐ (4+)</option>
                        <option>⭐⭐⭐ (3+)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-800 mb-1.5">Jarak Maksimal</label>
                    <select class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none">
                        <option>&lt; 2 Km</option>
                        <option>&lt; 5 Km</option>
                        <option>&lt; 10 Km</option>
                    </select>
                </div>
            </div>
        </section>

        <section class="lg:col-span-2 space-y-6">
            <div class="bg-white p-3 rounded-2xl border border-slate-100 shadow-xs">
                <div id="map"></div>
                <p class="text-xs text-slate-400 mt-2 px-1 text-center sm:text-left"><i class="fa-solid fa-location-crosshairs mr-1"></i> Menampilkan peta kuliner wilayah Kota Semarang.</p>
            </div>

            <div class="grid sm:grid-cols-2 gap-6">
                
                <div class="bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden group hover:shadow-md transition duration-300">
                    <div class="relative h-40 bg-slate-100 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?auto=format&fit=crop&w=400&q=80" alt="Lunpia" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-xs text-slate-800 text-[11px] font-bold px-2.5 py-1 rounded-md shadow-xs">Warung Tradisional</span>
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-slate-800 group-hover:accent-color transition text-base">Lunpia Gang Lombok</h3>
                            <span class="text-sm font-semibold text-amber-500 flex items-center"><i class="fa-solid fa-star mr-1"></i> 4.9</span>
                        </div>
                        <p class="text-xs text-slate-400 mt-1"><i class="fa-solid fa-location-dot mr-1"></i> Gg. Lombok No. 11, Purwodinatan, Semarang</p>
                        <div class="flex gap-1.5 mt-3">
                            <span class="text-[10px] bg-slate-100 text-slate-500 px-2 py-0.5 rounded">#Legendaris</span>
                            <span class="text-[10px] bg-slate-100 text-slate-500 px-2 py-0.5 rounded">#Halal</span>
                        </div>
                        <div class="border-t border-slate-50 mt-4 pt-3 flex justify-between items-center">
                            <span class="text-xs text-slate-400"><i class="fa-solid fa-route mr-1"></i> 0.8 Km dari lokasi</span>
                            <button onclick="openDetailModal()" class="text-xs font-semibold accent-color hover:underline">Lihat Detail <i class="fa-solid fa-arrow-right ml-0.5"></i></button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden group hover:shadow-md transition duration-300">
                    <div class="relative h-40 bg-slate-100 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1606471191009-63994c53433b?auto=format&fit=crop&w=400&q=80" alt="Tahu Gimbal" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-xs text-slate-800 text-[11px] font-bold px-2.5 py-1 rounded-md shadow-xs">Street Food</span>
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-slate-800 group-hover:accent-color transition text-base">Tahu Gimbal Pak Edi</h3>
                            <span class="text-sm font-semibold text-amber-500 flex items-center"><i class="fa-solid fa-star mr-1"></i> 4.7</span>
                        </div>
                        <p class="text-xs text-slate-400 mt-1"><i class="fa-solid fa-location-dot mr-1"></i> Jl. Menteri Supeno, Mugassari, Semarang</p>
                        <div class="flex gap-1.5 mt-3">
                            <span class="text-[10px] bg-slate-100 text-slate-500 px-2 py-0.5 rounded">#KhasSemarang</span>
                            <span class="text-[10px] bg-slate-100 text-slate-500 px-2 py-0.5 rounded">#MurahMeriah</span>
                        </div>
                        <div class="border-t border-slate-50 mt-4 pt-3 flex justify-between items-center">
                            <span class="text-xs text-slate-400"><i class="fa-solid fa-route mr-1"></i> 2.1 Km dari lokasi</span>
                            <button onclick="openDetailModal()" class="text-xs font-semibold accent-color hover:underline">Lihat Detail <i class="fa-solid fa-arrow-right ml-0.5"></i></button>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <div id="detailModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-50 flex items-center justify-center hidden p-4">
        <div class="bg-white w-full max-w-2xl rounded-2xl shadow-xl max-h-[90vh] overflow-y-auto">
            <div class="relative h-56 sm:h-64 bg-slate-200">
                <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?auto=format&fit=crop&w=700&q=80" alt="Detail" class="w-full h-full object-cover">
                <button onclick="closeDetailModal()" class="absolute top-4 right-4 bg-white/80 hover:bg-white text-slate-700 h-8 w-8 rounded-full flex items-center justify-center shadow-xs transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <div class="flex flex-wrap justify-between items-start gap-2">
                        <h2 class="text-xl font-bold text-slate-800">Lunpia Gang Lombok</h2>
                        <span class="text-base font-bold text-amber-500 flex items-center bg-amber-50 px-2.5 py-1 rounded-lg"><i class="fa-solid fa-star mr-1"></i> 4.9</span>
                    </div>
                    <p class="text-sm text-slate-400 mt-1"><i class="fa-solid fa-location-dot mr-1"></i> Gg. Lombok No. 11, Purwodinatan, Semarang</p>
                </div>
                <div class="border-t border-slate-100 pt-4">
                    <h3 class="text-sm font-bold text-slate-800 mb-3"><i class="fa-solid fa-comments mr-1 text-slate-400"></i> Review Kontributor</h3>
                    <div class="space-y-4">
                        <div class="bg-slate-50 p-3.5 rounded-xl text-xs space-y-2 border border-slate-100">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-slate-700">Andini Putri <span class="text-[10px] font-normal text-slate-400">(Kontributor)</span></span>
                                <span class="text-amber-500">⭐⭐⭐⭐⭐</span>
                            </div>
                            <p class="text-slate-500 leading-relaxed">"Ukurannya padat, rebungnya sama sekali gak bau pesing. Rasa manis gurihnya pas banget, wajib coba kalau ke Semarang!"</p>
                        </div>
                    </div>
                </div>
                <div class="bg-accent-light p-4 rounded-xl border border-emerald-100 flex justify-between items-center flex-wrap gap-3">
                    <p class="text-xs text-slate-500 max-w-xs">Punya pengalaman makan di sini juga? Yuk log in untuk tulis review-mu sendiri!</p>
                    <a href="<?= base_url('login') ?>" class="text-xs bg-accent text-white font-medium px-4 py-2 rounded-lg hover:bg-emerald-800">Tulis Review</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // 1. Inisialisasi Peta Leaflet (Fokus Titik Tengah Kota Semarang)
        var map = L.map('map').setView([-6.9932, 110.4203], 13);
        
        // Load Tile Map dari CartoDB (Warna Soft / Muted)
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OpenStreetMap contributors &copy; CARTO'
        }).addTo(map);

        // Memaksa browser merender peta ulang setelah selesai render komponen HTML
        setTimeout(function () {
            map.invalidateSize();
        }, 300);

        // Tambah Marker Kuliner Semarang beserta Pop-up Penjelasannya
        L.marker([-6.9723, 110.4243]).addTo(map).bindPopup('<b>Lunpia Gang Lombok</b><br>Kategori: Warung Tradisional');
        L.marker([-6.9925, 110.4220]).addTo(map).bindPopup('<b>Tahu Gimbal Pak Edi</b><br>Kategori: Street Food');

        // 2. Fungsi Modal Detail
        function openDetailModal() {
            document.getElementById('detailModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; 
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
            document.body.style.overflow = 'auto'; 
        }
    </script>
</body>
</html>