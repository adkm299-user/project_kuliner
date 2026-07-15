<?php $this->extend('layout'); ?>
<?php $this->section('content'); ?>

<div class="pagetitle mb-4">
    <h1 class="fw-bold text-dark">Tambah Kuliner Baru</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-muted">Home</a></li>
            <li class="breadcrumb-item"><a href="/kuliner" class="text-muted">Kuliner</a></li>
            <li class="breadcrumb-item active text-success-custom">Tambah</li>
        </ol>
    </nav>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4 p-md-5">
        <form action="/kuliner/simpan" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary">Nama Kuliner</label>
                        <input type="text" name="nama" class="form-control form-control-lg border-2 focus-green" placeholder="Contoh: Soto Ayam Bu Ning" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary">Kategori</label>
                        <select name="kategori_id" class="form-select form-select-lg border-2 focus-green" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategoris as $k): ?>
                                <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary">Foto Kuliner</label>
                        <input type="file" name="foto" id="foto" class="form-control border-2 focus-green" accept="image/*" onchange="previewImage()" required>
                        <div class="mt-3 text-center bg-light rounded-3 p-2 border border-dashed d-flex align-items-center justify-content-center" style="min-height: 150px;">
                            <img id="img-preview" class="img-fluid rounded-3 shadow-sm" style="max-height: 180px; display: none; object-fit: cover;">
                            <div id="preview-placeholder" class="text-muted small">
                                <i class="bi bi-image fs-2 d-block mb-1 text-opacity-50 text-success-custom"></i>
                                Pratinjau foto akan muncul di sini
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary">Deskripsi Singkat</label>
                        <textarea name="deskripsi" class="form-control border-2 focus-green" rows="4" placeholder="Ceritakan keunikan menu, cita rasa, atau sejarah singkat warung ini..."></textarea>
                    </div>
                </div>

                <div class="col-lg-6 border-start-lg">
                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary">Alamat Lengkap</label>
                        <div class="input-group input-group-lg shadow-sm rounded-3 overflow-hidden">
                            <input type="text" name="alamat" id="alamat" class="form-control border-2" placeholder="Nama jalan, nomor, atau daerah umum..." required>
                            <button type="button" class="btn btn-green px-4 fw-medium text-white" onclick="cariKoordinat()">
                                <i class="bi bi-geo-alt"></i> Cari
                            </button>
                        </div>
                        <div class="form-text text-muted mt-2">
                            <i class="bi bi-info-circle text-success-custom"></i> Jika pelacakan otomatis kurang akurat, geser penanda di peta ke titik yang tepat.
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small text-muted">Latitude</label>
                            <input type="text" name="lat" id="lat" class="form-control bg-light border-1 text-secondary" readonly required placeholder="-6.xxxxxx">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small text-muted">Longitude</label>
                            <input type="text" name="lng" id="lng" class="form-control bg-light border-1 text-secondary" readonly required placeholder="110.xxxxxx">
                        </div>
                    </div>
                    
                    <div id="map-preview" class="shadow-sm border" style="height:320px; border-radius:12px; margin-bottom:1.5rem; z-index: 1;"></div>
                </div>
            </div>

            <hr class="my-4 opacity-50">

            <div class="d-flex justify-content-end gap-2">
                <a href="/kuliner" class="btn btn-light btn-lg px-4 rounded-pill">Batal</a>
                <button type="submit" class="btn btn-green btn-lg px-5 rounded-pill shadow-sm fw-medium text-white">Submit Data Kuliner</button>
            </div>
        </form>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
var map, marker;

document.addEventListener("DOMContentLoaded", function() {
    var defaultLat = -6.9904; 
    var defaultLng = 110.4229;

    map = L.map('map-preview').setView([defaultLat, defaultLng], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    
    marker = L.marker([defaultLat, defaultLng], {draggable: true}).addTo(map);
    
    document.getElementById('lat').value = defaultLat.toFixed(6);
    document.getElementById('lng').value = defaultLng.toFixed(6);
    
    marker.on('dragend', function(event) {
        var position = marker.getLatLng();
        document.getElementById('lat').value = position.lat.toFixed(6);
        document.getElementById('lng').value = position.lng.toFixed(6);
    });

    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        document.getElementById('lat').value = e.latlng.lat.toFixed(6);
        document.getElementById('lng').value = e.latlng.lng.toFixed(6);
    });
});

function cariKoordinat() {
    var alamat = document.getElementById('alamat').value;
    if (!alamat) { alert('Isi kolom alamat terlebih dahulu!'); return; }

    var queryAlamat = alamat + ' Semarang';
    var url = 'https://nominatim.openstreetmap.org/search?format=jsonv2&countrycodes=id&limit=1&q=' + encodeURIComponent(queryAlamat);

    fetch(url, { headers: { 'Accept-Language': 'id' } })
    .then(r => r.json())
    .then(data => {
        if (!data || data.length === 0) { 
            alert('Alamat tidak ditemukan otomatis. Silakan geser pin pada peta secara manual.'); 
            return; 
        }
        
        var lat = parseFloat(data[0].lat);
        var lng = parseFloat(data[0].lon);
        
        document.getElementById('lat').value = lat.toFixed(6);
        document.getElementById('lng').value = lng.toFixed(6);

        map.setView([lat, lng], 16);
        marker.setLatLng([lat, lng]);
    })
    .catch(() => {
        alert('Koneksi pelacakan otomatis terganggu. Silakan tentukan lokasi langsung dengan klik/geser pin di peta.');
    });
}

function previewImage() {
    var fileInput = document.getElementById('foto');
    var imgPreview = document.getElementById('img-preview');
    var placeholder = document.getElementById('preview-placeholder');
    
    if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            imgPreview.src = e.target.result;
            imgPreview.style.display = 'block';
            placeholder.style.display = 'none';
        }
        reader.readAsDataURL(fileInput.files[0]);
    }
}
</script>

<style>
/* Kustomisasi skema warna hijau emerald sesuai Landing Page */
.btn-green {
    background-color: #006642 !important;
    border-color: #006642 !important;
}
.btn-green:hover, .btn-green:focus {
    background-color: #004d32 !important;
    border-color: #004d32 !important;
}

.text-success-custom {
    color: #006642 !important;
}

.focus-green:focus {
    border-color: rgba(0, 102, 66, 0.5) !important;
    box-shadow: 0 0 0 0.25rem rgba(0, 102, 66, 0.25) !important;
}

@media (min-width: 992px) {
    .border-start-lg {
        border-start: 1px solid #dee2e6 !important;
        padding-left: 2.5rem !important;
    }
}

.border-dashed {
    border-style: dashed !important;
    border-width: 2px !important;
    border-color: #cbd5e1 !important;
}
</style>

<?php $this->endSection(); ?>