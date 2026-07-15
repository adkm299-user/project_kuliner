<?php

namespace App\Models;

use CodeIgniter\Model;

class KulinerModel extends Model
{
    protected $table         = 'kuliner';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'nama', 'slug', 'alamat', 'deskripsi',
        'kategori_id', 'user_id', 'lat', 'lng',
        'foto', 'status', 'rating_avg'
    ];
    protected $useTimestamps = true;

    public function getKulinerWithKategori($status = 'approved')
    {
        return $this->select('kuliner.*, kategori.nama as kategori_nama')
                    ->join('kategori', 'kategori.id = kuliner.kategori_id')
                    ->where('kuliner.status', $status)
                    ->orderBy('kuliner.rating_avg', 'DESC')
                    ->findAll();
    }

    public function getBySlug($slug)
    {
        return $this->select('kuliner.*, kategori.nama as kategori_nama')
                    ->join('kategori', 'kategori.id = kuliner.kategori_id')
                    ->where('kuliner.slug', $slug)
                    ->first();
    }
    // Fungsi untuk mencari data kuliner berdasarkan keyword
    public function searchKuliner($keyword)
    {
        return $this->select('kuliner.*, kategori.nama as kategori_nama')
                    ->join('kategori', 'kategori.id = kuliner.kategori_id', 'left')
                    ->where('kuliner.status', 'approved') // Hanya memunculkan kuliner yang sudah disetujui admin
                    ->groupStart()
                        ->like('kuliner.nama', $keyword)
                        ->orLike('kuliner.alamat', $keyword)
                        ->orLike('kategori.nama', $keyword)
                    ->groupEnd()
                    ->orderBy('kuliner.created_at', 'DESC')
                    ->findAll();
    }
}

