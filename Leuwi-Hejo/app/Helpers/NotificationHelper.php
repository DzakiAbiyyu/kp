<?php

use CodeIgniter\Database\BaseConnection;

if (!function_exists('sendNotification')) {
    function sendNotification(BaseConnection $db, array $data, array $userIds)
    {
        // Insert ke tabel notifications
        $db->table('notifications')->insert([
            'actor_id'   => $data['actor_id'] ?? null,
            'title'      => $data['title'],
            'message'    => $data['message'],
            'type'       => $data['type'] ?? 'info',
            'icon'       => $data['icon'] ?? 'fas fa-info-circle',
            'link'       => $data['link'] ?? null,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $notifId = $db->insertID();

        // Insert ke user_notifications (multi-user)
        foreach ($userIds as $uid) {
            $db->table('user_notifications')->insert([
                'user_id' => $uid,
                'notification_id' => $notifId,
                'is_read' => 0,
                'read_at' => null
            ]);
        }
    }
}
