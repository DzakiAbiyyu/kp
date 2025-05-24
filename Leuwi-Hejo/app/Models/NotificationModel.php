<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'actor_id',
        'title',
        'message',
        'icon',
        'type',
        'link',
        'is_read',
        'created_at'
    ];

    protected $useTimestamps = false; // Karena kolom created_at tidak otomatis diisi oleh CI

    // Hapus notifikasi lebih dari 24 jam
    public function deleteExpired()
    {
        $this->where('created_at <', date('Y-m-d H:i:s', strtotime('-1 day')))
            ->delete();
    }
}
