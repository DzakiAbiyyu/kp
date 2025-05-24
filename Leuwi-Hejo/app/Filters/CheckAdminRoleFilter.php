<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Myth\Auth\Models\GroupModel;

class CheckAdminRoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!logged_in()) {
            return redirect()->to('/login');
        }

        $userId = user_id();
        $groupModel = new \Myth\Auth\Models\GroupModel();
        $groups = $groupModel->getGroupsForUser($userId);
        $groupNames = array_column($groups, 'name');

        // Jika tidak punya hak akses admin
        if (!in_array('admin', $groupNames) && !in_array('super_admin', $groupNames)) {
            log_message('notice', 'Akses admin ditolak untuk user ID ' . $userId);

            // Selalu redirect ke / dengan popup
            return redirect()
                ->to('/')
                ->with('popup_error', 'Anda Bukan Admin');
        }

        // Lanjut jika punya akses
    }




    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu dipakai
    }
}
