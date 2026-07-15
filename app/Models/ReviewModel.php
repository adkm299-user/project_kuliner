<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table         = 'reviews';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'kuliner_id', 'user_id', 'rating', 'komentar'
    ];
    protected $useTimestamps = true;

    public function getReviewsByKuliner($kuliner_id)
    {
        return $this->select('reviews.*, users.username')
                    ->join('users', 'users.id = reviews.user_id')
                    ->where('reviews.kuliner_id', $kuliner_id)
                    ->orderBy('reviews.created_at', 'DESC')
                    ->findAll();
    }
}