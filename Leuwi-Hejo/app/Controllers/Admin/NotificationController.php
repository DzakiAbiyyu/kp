<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class NotificationController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * Menampilkan daftar notifikasi (opsional, untuk halaman log)
     */
    public function index()
    {
        $userId = user()->id;

        $notifications = $this->db->table('user_notifications')
            ->select('user_notifications.*, notifications.title, notifications.message, notifications.type, notifications.icon, notifications.link, notifications.created_at, u.image as actor_image')
            ->join('notifications', 'notifications.id = user_notifications.notification_id')
            ->join('users u', 'u.id = notifications.actor_id', 'left')
            ->where('user_notifications.user_id', $userId)
            ->orderBy('notifications.created_at', 'DESC')
            ->get()
            ->getResult();


        return view('admin/notifications/index', ['notifications' => $notifications]);
    }


    /**
     * Menandai satu notifikasi sebagai sudah dibaca dan redirect ke link-nya
     */
    public function read($notifId)
    {
        $userId = user()->id;

        // Tandai notifikasi sebagai dibaca
        $this->db->table('user_notifications')
            ->where('user_id', $userId)
            ->where('notification_id', $notifId)
            ->update([
                'is_read' => 1,
                'read_at' => date('Y-m-d H:i:s'),
            ]);

        // Ambil link tujuan
        $notif = $this->db->table('notifications')
            ->where('id', $notifId)
            ->get()
            ->getRow();

        return redirect()->to($notif->link ?? '/');
    }

    /**
     * Menghapus otomatis notifikasi yang sudah dibaca dan lebih dari 24 jam
     */
    public function cleanup()
    {
        $threshold = date('Y-m-d H:i:s', strtotime('-24 hours'));

        // Dapatkan semua ID dari notifikasi yang bisa dihapus
        $toDelete = $this->db->table('user_notifications')
            ->select('user_notifications.notification_id')
            ->join('notifications', 'notifications.id = user_notifications.notification_id')
            ->where('user_notifications.is_read', true)
            ->where('notifications.created_at <', $threshold)
            ->get()
            ->getResultArray();

        if (!empty($toDelete)) {
            $ids = array_column($toDelete, 'notification_id');

            $this->db->table('user_notifications')->whereIn('notification_id', $ids)->delete();
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Notifikasi lama dibersihkan.']);
    }

    public function getUserNotifications()
    {
        $userId = user()->id;

        $notifications = $this->db->table('user_notifications')
            ->select('user_notifications.is_read, notifications.id AS notif_id, notifications.message, notifications.type, notifications.icon, notifications.link, notifications.created_at')
            ->join('notifications', 'notifications.id = user_notifications.notification_id')
            ->where('user_notifications.user_id', $userId)
            ->orderBy('user_notifications.is_read', 'ASC') // 🔥 Prioritaskan yg belum dibaca
            ->orderBy('notifications.created_at', 'DESC')
            ->limit(5)
            ->get()
            ->getResult();


        $unreadCount = $this->db->table('user_notifications')
            ->where('user_id', $userId)
            ->where('is_read', false)
            ->countAllResults();

        return $this->response->setJSON([
            'notifications' => $notifications,
            'unread' => $unreadCount
        ]);
    }




    /**
     * Dipanggil saat user membuka bell, tandai notifikasi sebagai dibaca
     */
    public function markUserNotifications()
    {
        $userId = user()->id;

        $this->db->table('user_notifications')
            ->where('user_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => 1, 'read_at' => date('Y-m-d H:i:s')]);

        return $this->response->setJSON(['status' => 'success']);
    }

    public function markRead()
    {
        $notifId = $this->request->getPost('id');
        $userId = user()->id;

        $this->db->table('user_notifications')
            ->where('user_id', $userId)
            ->where('notification_id', $notifId)
            ->update([
                'is_read' => 1,
                'read_at' => date('Y-m-d H:i:s'),
            ]);

        return $this->response->setJSON(['success' => true]);
    }
}
