<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table         = 'notifications';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['user_id', 'judul', 'pesan', 'link', 'is_read'];
    protected $useTimestamps = true;

    public function getForUser($userId, $limit = 10)
    {
        return $this->where('user_id', $userId)->orderBy('created_at', 'DESC')->findAll($limit);
    }

    public function countUnread($userId)
    {
        return $this->where('user_id', $userId)->where('is_read', 0)->countAllResults();
    }

    public function markAllRead($userId)
    {
        return $this->where('user_id', $userId)->where('is_read', 0)->set(['is_read' => 1])->update();
    }
}