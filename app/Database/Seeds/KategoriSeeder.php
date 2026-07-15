<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama' => 'Warteg',      'slug' => 'warteg'],
            ['nama' => 'Kafe',        'slug' => 'kafe'],
            ['nama' => 'Street Food', 'slug' => 'street-food'],
            ['nama' => 'Minuman',     'slug' => 'minuman'],
            ['nama' => 'Bakso',       'slug' => 'bakso'],
            ['nama' => 'Mie Ayam',    'slug' => 'mie-ayam'],
            ['nama' => 'Seafood',     'slug' => 'seafood'],
        ];
        $this->db->table('kategori')->insertBatch($data);
    }
}