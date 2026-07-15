<?php

if (!function_exists('kirim_notifikasi_status_kuliner')) {
    /**
     * Kirim email notifikasi ke kontributor saat status kuliner
     * yang mereka submit diperbarui oleh admin (approved/rejected).
     */
    function kirim_notifikasi_status_kuliner(string $emailTujuan, string $namaKuliner, string $status, string $catatan = ''): bool
    {
        if (empty($emailTujuan)) {
            log_message('warning', 'Notifikasi kuliner gagal dikirim: email tujuan kosong.');
            return false;
        }

        $statusLabel = $status === 'approved' ? 'DISETUJUI' : 'DITOLAK';
        $subject     = "Update Status Kuliner: {$namaKuliner} - {$statusLabel}";

        $body = view('emails/status_kuliner', [
            'namaKuliner' => $namaKuliner,
            'status'      => $status,
            'statusLabel' => $statusLabel,
            'catatan'     => $catatan,
        ]);

        $email = service('email');
        $email->setTo($emailTujuan);
        $email->setSubject($subject);
        $email->setMessage($body);

        try {
            $terkirim = $email->send();

            if (!$terkirim) {
                log_message('error', 'Gagal mengirim notifikasi email: ' . $email->printDebugger(['headers']));
            }

            log_message('info', "Notifikasi kuliner '{$namaKuliner}' ({$statusLabel}) dikirim ke {$emailTujuan}: " . ($terkirim ? 'sukses' : 'gagal'));

            return (bool) $terkirim;
        } catch (\Throwable $e) {
            log_message('error', 'Exception saat mengirim notifikasi email: ' . $e->getMessage());
            return false;
        }
    }
}