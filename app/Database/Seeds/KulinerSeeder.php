<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KulinerSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama' => 'Warteg Bu Sari',       'slug' => 'warteg-bu-sari',       'alamat' => 'Jl. Imam Bonjol No.1, Semarang',      'kategori_id' => 1, 'user_id' => 1, 'lat' => -6.9934, 'lng' => 110.4203, 'status' => 'approved', 'rating_avg' => 4.5, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Kafe Udinus',           'slug' => 'kafe-udinus',           'alamat' => 'Jl. Nakula I No.5, Semarang',          'kategori_id' => 2, 'user_id' => 1, 'lat' => -6.9921, 'lng' => 110.4175, 'status' => 'approved', 'rating_avg' => 4.2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Bakso Pak Kumis',       'slug' => 'bakso-pak-kumis',       'alamat' => 'Jl. Tlogosari Raya No.12, Semarang',   'kategori_id' => 5, 'user_id' => 2, 'lat' => -7.0012, 'lng' => 110.4401, 'status' => 'approved', 'rating_avg' => 4.7, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Mie Ayam Pak Bejo',     'slug' => 'mie-ayam-pak-bejo',     'alamat' => 'Jl. Pemuda No.30, Semarang',           'kategori_id' => 6, 'user_id' => 2, 'lat' => -6.9857, 'lng' => 110.4100, 'status' => 'approved', 'rating_avg' => 4.3, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Es Teh Jumbo',          'slug' => 'es-teh-jumbo',          'alamat' => 'Jl. Simpang Lima No.3, Semarang',      'kategori_id' => 4, 'user_id' => 2, 'lat' => -6.9930, 'lng' => 110.4123, 'status' => 'approved', 'rating_avg' => 4.0, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Seafood Pak Joko',      'slug' => 'seafood-pak-joko',      'alamat' => 'Jl. Kaligarang No.8, Semarang',        'kategori_id' => 7, 'user_id' => 2, 'lat' => -7.0100, 'lng' => 110.4050, 'status' => 'approved', 'rating_avg' => 4.6, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Angkringan Mas Joko',   'slug' => 'angkringan-mas-joko',   'alamat' => 'Jl. Gajah Mada No.45, Semarang',      'kategori_id' => 3, 'user_id' => 2, 'lat' => -6.9875, 'lng' => 110.4088, 'status' => 'approved', 'rating_avg' => 4.1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Nasi Goreng Bang Ali',  'slug' => 'nasi-goreng-bang-ali',  'alamat' => 'Jl. MT Haryono No.22, Semarang',      'kategori_id' => 3, 'user_id' => 2, 'lat' => -6.9945, 'lng' => 110.4210, 'status' => 'approved', 'rating_avg' => 4.4, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Soto Ayam Bu Ning',     'slug' => 'soto-ayam-bu-ning',     'alamat' => 'Jl. Pahlawan No.10, Semarang',         'kategori_id' => 1, 'user_id' => 2, 'lat' => -6.9867, 'lng' => 110.4155, 'status' => 'approved', 'rating_avg' => 4.8, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Kopi Teman Kampus',     'slug' => 'kopi-teman-kampus',     'alamat' => 'Jl. Nakula II No.7, Semarang',         'kategori_id' => 2, 'user_id' => 2, 'lat' => -6.9925, 'lng' => 110.4180, 'status' => 'approved', 'rating_avg' => 4.2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Pecel Lele Lamongan',   'slug' => 'pecel-lele-lamongan',   'alamat' => 'Jl. Brigjen Katamso No.5, Semarang',  'kategori_id' => 3, 'user_id' => 2, 'lat' => -6.9990, 'lng' => 110.4300, 'status' => 'approved', 'rating_avg' => 4.3, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Gudeg Yu Sri',          'slug' => 'gudeg-yu-sri',          'alamat' => 'Jl. Veteran No.18, Semarang',          'kategori_id' => 1, 'user_id' => 2, 'lat' => -6.9880, 'lng' => 110.4070, 'status' => 'approved', 'rating_avg' => 4.6, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Burger Kilat',          'slug' => 'burger-kilat',          'alamat' => 'Jl. Pandanaran No.20, Semarang',       'kategori_id' => 3, 'user_id' => 2, 'lat' => -6.9910, 'lng' => 110.4135, 'status' => 'approved', 'rating_avg' => 3.9, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Warung Padang Minang',  'slug' => 'warung-padang-minang',  'alamat' => 'Jl. Cendrawasih No.3, Semarang',      'kategori_id' => 1, 'user_id' => 2, 'lat' => -7.0020, 'lng' => 110.4190, 'status' => 'approved', 'rating_avg' => 4.5, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Pisang Goreng Madu',    'slug' => 'pisang-goreng-madu',    'alamat' => 'Jl. Setiabudi No.11, Semarang',       'kategori_id' => 3, 'user_id' => 2, 'lat' => -7.0055, 'lng' => 110.4250, 'status' => 'approved', 'rating_avg' => 4.1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Rawon Setan Semarang',  'slug' => 'rawon-setan-semarang',  'alamat' => 'Jl. Mataram No.7, Semarang',          'kategori_id' => 1, 'user_id' => 2, 'lat' => -6.9895, 'lng' => 110.4115, 'status' => 'approved', 'rating_avg' => 4.7, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Tahu Gimbal Pak Wardi', 'slug' => 'tahu-gimbal-pak-wardi', 'alamat' => 'Jl. Gajahmungkur No.2, Semarang',    'kategori_id' => 3, 'user_id' => 2, 'lat' => -7.0030, 'lng' => 110.4160, 'status' => 'approved', 'rating_avg' => 4.4, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Lumpia Semarang Asli',  'slug' => 'lumpia-semarang-asli',  'alamat' => 'Jl. Pemuda No.11, Semarang',          'kategori_id' => 3, 'user_id' => 2, 'lat' => -6.9860, 'lng' => 110.4095, 'status' => 'approved', 'rating_avg' => 4.9, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Warung Kopi Semawis',   'slug' => 'warung-kopi-semawis',   'alamat' => 'Jl. Wotgandul Timur No.5, Semarang',  'kategori_id' => 2, 'user_id' => 2, 'lat' => -6.9840, 'lng' => 110.4230, 'status' => 'approved', 'rating_avg' => 4.3, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Ayam Geprek Bu Endah',  'slug' => 'ayam-geprek-bu-endah',  'alamat' => 'Jl. Rinjani No.9, Semarang',          'kategori_id' => 1, 'user_id' => 2, 'lat' => -7.0075, 'lng' => 110.4320, 'status' => 'approved', 'rating_avg' => 4.5, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ];
        $this->db->table('kuliner')->insertBatch($data);
    }
}