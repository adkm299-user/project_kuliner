<?php

namespace App\Controllers;

use App\Models\ReviewModel;
use App\Models\KulinerModel;

class ReviewController extends BaseController
{
    protected $reviewModel;
    protected $kulinerModel;

    public function __construct()
    {
        $this->reviewModel  = new ReviewModel();
        $this->kulinerModel = new KulinerModel();
    }

    public function simpan($kuliner_id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $rating   = $this->request->getPost('rating');
        $komentar = $this->request->getPost('komentar');

        // Cek apakah user sudah review kuliner ini
        $existing = $this->reviewModel
                         ->where('kuliner_id', $kuliner_id)
                         ->where('user_id', session()->get('user_id'))
                         ->first();

        if ($existing) {
            session()->setFlashdata('error', 'Kamu sudah pernah mereview kuliner ini!');
            return redirect()->back();
        }

        // Simpan review
        $this->reviewModel->insert([
            'kuliner_id' => $kuliner_id,
            'user_id'    => session()->get('user_id'),
            'rating'     => $rating,
            'komentar'   => $komentar,
        ]);

        // Update rating_avg di tabel kuliner
        $avg = $this->reviewModel
                    ->selectAvg('rating', 'avg_rating')
                    ->where('kuliner_id', $kuliner_id)
                    ->get()->getRowArray();

        $this->kulinerModel->update($kuliner_id, [
            'rating_avg' => round($avg['avg_rating'], 1)
        ]);

        session()->setFlashdata('success', 'Review berhasil ditambahkan!');
        return redirect()->back();
    }
}