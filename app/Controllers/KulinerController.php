<?php

namespace App\Controllers;

use App\Models\KulinerModel;
use App\Models\KategoriModel;

class KulinerController extends BaseController
{
    protected $kulinerModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->kulinerModel  = new KulinerModel();
        $this->kategoriModel = new KategoriModel();
    }

    public function userIndex()
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $data = [
                'title'    => 'Hasil Pencarian: ' . $keyword,
                'kuliners' => $this->kulinerModel->searchKuliner($keyword),
                'keyword'  => $keyword
            ];
        } else {
            $data = [
                'title'    => 'Daftar Kuliner',
                'kuliners' => $this->kulinerModel->getKulinerWithKategori(),
                'keyword'  => ''
            ];
        }

        return view('kuliner/index', $data);
    }

    // Halaman daftar kuliner (publik)
    public function index()
    {
        $data = [
            'title'    => 'Daftar Kuliner',
            'kuliners' => $this->kulinerModel->getKulinerWithKategori(),
        ];
        return view('kuliner/index', $data);
    }

    // Halaman detail kuliner
    public function detail($slug)
    {
        $kuliner = $this->kulinerModel->getBySlug($slug);
        if (!$kuliner) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $reviewModel = new \App\Models\ReviewModel();
        $data = [
            'title'   => $kuliner['nama'],
            'kuliner' => $kuliner,
            'reviews' => $reviewModel->getReviewsByKuliner($kuliner['id']),
        ];
        return view('kuliner/detail', $data);
    }

    // Form tambah kuliner (kontributor)
    public function tambah()
    {
        $data = [
            'title'      => 'Tambah Kuliner',
            'kategoris'  => $this->kategoriModel->findAll(),
        ];
        return view('kuliner/tambah', $data);
    }

    // Proses simpan kuliner baru
    public function simpan()
    {
        $slug = url_title($this->request->getPost('nama'), '-', true);

        $fileFoto = $this->request->getFile('foto');
        $namaFoto = '';

        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move(FCPATH . 'uploads/kuliner', $namaFoto);
        }

        $this->kulinerModel->insert([
            'nama'        => $this->request->getPost('nama'),
            'slug'        => $slug,
            'alamat'      => $this->request->getPost('alamat'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'user_id'     => session()->get('user_id'),
            'lat'         => $this->request->getPost('lat'),
            'lng'         => $this->request->getPost('lng'),
            'foto'        => $namaFoto,
            'status'      => 'pending',
        ]);

        session()->setFlashdata('success', 'Kuliner berhasil disubmit, menunggu persetujuan admin!');
        return redirect()->to('/kuliner');
    }

    // Admin: lihat semua kuliner
    public function adminIndex()
    {
        $data = [
            'title'    => 'Kelola Kuliner',
            'kuliners' => $this->kulinerModel
                               ->select('kuliner.*, kategori.nama as kategori_nama')
                               ->join('kategori', 'kategori.id = kuliner.kategori_id')
                               ->orderBy('kuliner.created_at', 'DESC')
                               ->findAll(),
        ];
        return view('kuliner/admin_index', $data);
    }

    // Admin: approve/reject kuliner
    public function updateStatus($id)
    {
        helper('notifikasi');

        $status  = $this->request->getPost('status');
        $catatan = $this->request->getPost('catatan') ?? '';

        $kuliner = $this->kulinerModel->find($id);
        $this->kulinerModel->update($id, ['status' => $status]);

        if ($kuliner && in_array($status, ['approved', 'rejected'], true)) {
            $statusLabel = $status === 'approved' ? 'disetujui' : 'ditolak';

            // 1) Notifikasi in-app
            $notificationModel = new \App\Models\NotificationModel();
            $notificationModel->insert([
                'user_id' => $kuliner['user_id'],
                'judul'   => 'Status Kuliner Diperbarui',
                'pesan'   => "Kuliner \"{$kuliner['nama']}\" kamu telah {$statusLabel}." . ($catatan ? " Catatan admin: {$catatan}" : ''),
                'link'    => '/kuliner/' . $kuliner['slug'],
                'is_read' => 0,
            ]);

            // 2) Notifikasi email
            $userModel = new \App\Models\UserModel();
            $pemilik   = $userModel->find($kuliner['user_id']);

            if ($pemilik && !empty($pemilik['email'])) {
                kirim_notifikasi_status_kuliner(
                    $pemilik['email'],
                    $kuliner['nama'],
                    $status,
                    $catatan
                );
            }
        }

        session()->setFlashdata('success', 'Status kuliner diperbarui & notifikasi telah dikirim ke kontributor!');
        return redirect()->to('/admin/kuliner');
    }

    // Admin: hapus kuliner
    public function hapus($id)
    {
        $this->kulinerModel->delete($id);
        session()->setFlashdata('success', 'Kuliner berhasil dihapus!');
        return redirect()->to('/admin/kuliner');
    }

    // Halaman Profil Pengguna
    public function profile()
    {
        $data = [
            'title' => 'Profil Saya',
            'role'  => session()->get('role'),
            'aktif' => session()->get('aktif'),
        ];

        return view('kuliner/profile', $data);
    }
}