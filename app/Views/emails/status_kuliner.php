<?php
/**
 * Variabel: $namaKuliner, $status, $statusLabel, $catatan
 */
?>
Halo,

Kami ingin menginformasikan bahwa submission kuliner kamu di aplikasi
Lokasi Kuliner & Review Jajanan telah diperbarui statusnya.

Nama Tempat  : <?= esc($namaKuliner) ?>
Status Baru  : <?= esc($statusLabel) ?>
<?php if (!empty($catatan)): ?>
Catatan Admin: <?= esc($catatan) ?>
<?php endif; ?>

<?php if ($status === 'approved'): ?>
Selamat! Tempat kuliner yang kamu submit sudah tayang dan bisa dilihat
oleh pengunjung lain di halaman utama.
<?php else: ?>
Mohon maaf, submission kamu belum dapat kami setujui saat ini. Kamu
bisa mengirim ulang submission dengan data yang lebih lengkap.
<?php endif; ?>

Terima kasih telah berkontribusi.

Salam,
Tim Lokasi Kuliner & Review Jajanan