<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Myth\Auth\Models\GroupModel;
use App\Models\UserModel;
use Myth\Auth\Entities\User;

class UserController extends BaseController
{
    protected $userModel;
    protected $groupModel;
    protected $db;



    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->groupModel = new GroupModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $userModel = new UserModel();
        $groupModel = new GroupModel();

        // Ambil semua user
        $users = $userModel->findAll();

        // Ambil semua grup untuk setiap user
        foreach ($users as &$user) {
            $userGroups = $groupModel->getGroupsForUser($user->id);
            $user->groups = array_column($userGroups, 'name');
        }

        return view('admin/users/daftar_user', [
            'users' => $users
        ]);
    }

    public function userPanel()
    {
        $users = $this->userModel->findAll();

        $totalUser     = count($users);
        $activeUser    = count(array_filter($users, fn($u) => $u->active));
        $nonActiveUser = $totalUser - $activeUser;

        $adminCount = 0;
        $superAdminCount = 0;
        $regularUserCount = 0;

        foreach ($users as $user) {
            $groups = $this->groupModel->getGroupsForUser($user->id);
            $groupNames = array_column($groups, 'name');

            if (in_array('admin', $groupNames)) {
                $adminCount++;
            }

            if (in_array('super_admin', $groupNames)) {
                $superAdminCount++;
            }

            if (in_array('user', $groupNames)) {
                $regularUserCount++;
            }
        }

        return view('admin/users/users_panel', compact(
            'totalUser',
            'activeUser',
            'nonActiveUser',
            'adminCount',
            'superAdminCount',
            'regularUserCount'
        ));
    }



    public function profile()
    {
        $userModel = new \Myth\Auth\Models\UserModel();
        $user = $userModel->find(user()->id); // BUKAN $auth->user()

        return view('admin/users/profile', ['user' => $user]);
    }



    public function updateImage()
    {
        $userModel = new \Myth\Auth\Models\UserModel();
        $user = $userModel->find(user()->id); // ambil data user paling baru

        $file = $this->request->getFile('image');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Hapus foto lama
            if ($user->image !== 'default.svg' && file_exists(FCPATH . 'uploads/profile/' . $user->image)) {
                unlink(FCPATH . 'uploads/profile/' . $user->image);
            }

            // Upload file
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/profile/', $newName);

            // Update ke database
            $userModel->update($user->id, ['image' => $newName]);

            return redirect()->to('admin/profile')->with('message', 'Foto profil berhasil diperbarui.');
        }

        return redirect()->back()->with('message', 'File tidak valid atau tidak ditemukan.');
    }


    public function removeImage()
    {
        $userModel = new \Myth\Auth\Models\UserModel();
        $auth = service('authentication');
        $user = $auth->user();

        if ($user->image !== 'default.svg' && file_exists(FCPATH . 'uploads/profile/' . $user->image)) {
            unlink(FCPATH . 'uploads/profile/' . $user->image);
        }

        $userModel->update($user->id, ['image' => 'default.svg']);

        return redirect()->back()->with('message', 'Foto profil berhasil dihapus.');
    }

    public function create()
    {
        return view('admin/users/create_user');
    }

    public function save()
    {
        $validationRules = [
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];

        if (! $this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = new User([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'active'   => 1,
        ]);

        $userModel = new UserModel();
        if (! $userModel->save($user)) {
            return redirect()->back()->withInput()->with('errors', $userModel->errors());
        }

        $userId = $userModel->getInsertID();

        // Masukkan ke grup default 'user'
        $groupModel = new GroupModel();
        $group = $groupModel->where('name', 'user')->first();
        $groupModel->addUserToGroup($userId, (int) $group->id);

        // Ambil kembali data user dan admin sekarang
        $newUser = $this->userModel->find($userId);
        $currentUser = user();

        $message = sprintf(
            '<strong>%s</strong> telah menambahkan pengguna baru dengan nama <strong>%s</strong> dan email <strong>%s</strong>',
            esc($currentUser->username),
            esc($newUser->username),
            esc($newUser->email)
        );

        $this->createNotification(
            'Pengguna Baru Ditambahkan',
            $message,
            'success',
            'fas fa-user-plus',
            base_url('admin/daftar_user')
        );


        return redirect()->to('/admin/daftar_user')->with('message', 'Pengguna berhasil ditambahkan!');
    }

    public function manageRoles()
    {
        $allUsers = $this->userModel->findAll();
        $currentId = user()->id;

        $users = [];

        foreach ($allUsers as $user) {
            $userGroups = $this->groupModel->getGroupsForUser($user->id);
            $user->groups = array_column($userGroups, 'name');
            $users[] = $user;
        }

        // Urutkan: user yang sedang login diletakkan di atas tanpa menduplikasi
        usort($users, function ($a, $b) use ($currentId) {
            return ($a->id === $currentId) ? -1 : (($b->id === $currentId) ? 1 : 0);
        });

        $allGroups = $this->groupModel->findAll();

        $currentUser = user();
        $currentUserGroups = $this->groupModel->getGroupsForUser($currentUser->id);
        $currentUser->groups = array_column($currentUserGroups, 'name');


        return view('admin/users/manage_roles', [
            'users' => $users,
            'currentUser' => $currentUser,
            'allGroups' => $allGroups
        ]);
    }





    public function updateRole()
    {
        $userId    = $this->request->getPost('user_id');
        $newRoles  = $this->request->getPost('roles'); // array

        if (! $userId || ! is_array($newRoles)) {
            return redirect()->back()->with('error', 'Data tidak lengkap.');
        }

        $currentUser      = user();
        $targetUser       = $this->userModel->find($userId);
        $targetGroups     = $this->groupModel->getGroupsForUser($userId);
        $targetGroupNames = array_column($targetGroups, 'name');

        if (! $this->canModify($currentUser, $userId, $targetGroupNames, $newRoles)) {
            return redirect()->back()->with('error', 'Anda tidak diizinkan mengubah role ini.');
        }

        $this->groupModel->removeUserFromAllGroups($userId);

        // Catat log perubahan role
        $this->db->table('role_change_logs')->insert([
            'changed_by'   => $currentUser->id,
            'target_user'  => $userId,
            'old_roles'    => json_encode($targetGroupNames),
            'new_roles'    => json_encode($newRoles),
            'changed_at'   => date('Y-m-d H:i:s'),
        ]);

        $targetUser = $this->userModel->find($userId);

        // Format cantik teks perubahan
        $fromRoles = implode(', ', $targetGroupNames);
        $toRoles   = implode(', ', $newRoles);

        $message = sprintf(
            '<strong>%s</strong> telah mengubah role <strong>%s</strong><br>Dari: <span class="text-danger">[%s]</span><br>Menjadi: <span class="text-success">[%s]</span>',
            esc($currentUser->username),
            esc($targetUser->username),
            esc($fromRoles),
            esc($toRoles)
        );

        $this->createNotification(
            'Perubahan Role Pengguna',
            $message,
            'warning',
            'fas fa-user-shield',
            base_url('admin/users/manage-roles')
        );

        foreach ($newRoles as $roleName) {
            $group = $this->groupModel->where('name', $roleName)->first();
            if ($group) {
                $this->groupModel->addUserToGroup($userId, $group->id);
            }
        }

        return redirect()->back()->with('message', 'Role berhasil diperbarui.');
    }



    public function toggleStatus()
    {
        $userId = $this->request->getPost('user_id');
        $targetUser = $this->userModel->find($userId);

        if (! $targetUser) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        $targetGroups = $this->groupModel->getGroupsForUser($userId);
        $targetGroupNames = array_column($targetGroups, 'name');

        $isCurrentSuperAdmin = in_groups('super_admin');
        $isTargetSuperAdmin  = in_array('super_admin', $targetGroupNames);

        // 🚫 Tidak boleh nonaktifkan super_admin siapa pun
        if ($isTargetSuperAdmin) {
            return redirect()->back()->with('error', 'Super admin tidak bisa dinonaktifkan.');
        }

        // 🚫 Admin tidak boleh nonaktifkan admin lain
        if (in_array('admin', $targetGroupNames) && in_groups('admin') && !in_groups('super_admin')) {
            return redirect()->back()->with('error', 'Admin tidak bisa menonaktifkan sesama admin.');
        }

        // ✅ Ubah status
        $newStatus = $targetUser->active ? 0 : 1;
        $this->userModel->update($userId, ['active' => $newStatus]);

        return redirect()->back()->with('message', 'Status user berhasil diubah.');
    }

    public function roleLogs()
    {
        $logs = $this->db->table('role_change_logs')
            ->select('role_change_logs.*, changer.username as changer_name, target.username as target_name')
            ->join('users as changer', 'changer.id = role_change_logs.changed_by')
            ->join('users as target', 'target.id = role_change_logs.target_user')
            ->orderBy('changed_at', 'DESC')
            ->get()
            ->getResult();

        return view('admin/users/role_logs', ['logs' => $logs]);
    }
    public function getNotifications()
    {
        $notifications = $this->db->table('notifications')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get()
            ->getResult();

        $unreadCount = $this->db->table('notifications')->where('is_read', false)->countAllResults();

        return $this->response->setJSON([
            'notifications' => $notifications,
            'unread' => $unreadCount
        ]);
    }


    public function markNotificationsRead()
    {
        $this->db->table('notifications')->where('is_read', false)->update(['is_read' => true]);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function deleteUser($userId)
    {
        $currentUser = user();
        $targetUser = $this->userModel->find($userId);

        if (!$targetUser) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        if (!canDeleteUser($currentUser, $targetUser)) {
            return redirect()->back()->with('error', 'Kamu tidak diizinkan menghapus user ini.');
        }

        $username = $targetUser->username;
        $this->userModel->delete($userId);

        // 🔔 Notifikasi dinamis
        $this->createNotification(
            'Pengguna Dihapus',
            "<strong>{$currentUser->username}</strong> menghapus akun <strong>{$username}</strong>.",
            'danger',
            'fas fa-user-times',
            base_url('admin/daftar_user')
        );

        return redirect()->back()->with('message', 'User berhasil dihapus.');
    }





    // private function

    private function canModify($currentUser, $targetId, $targetGroups, $newRoles)
    {
        if ($currentUser->id == $targetId) return false;

        $isCurrentSuperAdmin = in_groups('super_admin');
        $isCurrentAdmin = in_groups('admin');
        $isTargetSuperAdmin = in_array('super_admin', $targetGroups);
        $isTargetAdmin = in_array('admin', $targetGroups);

        $willHaveSuperAdmin = in_array('super_admin', $newRoles);
        $willHaveAdmin = in_array('admin', $newRoles);
        $willHaveUser = in_array('user', $newRoles);

        // 🚫 Tidak ada yang boleh mengubah super_admin lain
        if ($isTargetSuperAdmin) {
            return false;
        }

        // 🚫 Tidak boleh menambahkan role super_admin jika bukan super_admin
        if ($willHaveSuperAdmin && !$isCurrentSuperAdmin) {
            return false;
        }

        // 🚫 Tidak boleh turunkan admin ke user kalau bukan super_admin
        if ($isTargetAdmin && !$willHaveAdmin && !$isCurrentSuperAdmin) {
            return false;
        }

        // 🚫 Tidak boleh mempromosikan ke admin jika bukan admin/super_admin
        if ($willHaveAdmin && !($isCurrentAdmin || $isCurrentSuperAdmin)) {
            return false;
        }

        return true;
    }

    private function canDelete($currentUser, $targetUser): bool
    {
        if ($currentUser->id == $targetUser->id) {
            return false; // Tidak bisa hapus diri sendiri
        }

        // Ambil grup current dan target
        $groupModel = new \Myth\Auth\Models\GroupModel();
        $currentGroups = array_column($groupModel->getGroupsForUser($currentUser->id), 'name');
        $targetGroups  = array_column($groupModel->getGroupsForUser($targetUser->id), 'name');

        // Fungsi bantu: ambil level tertinggi
        $getLevel = function ($groups) {
            if (in_array('super_admin', $groups)) return 3;
            if (in_array('admin', $groups)) return 2;
            return 1; // user
        };

        $currentLevel = $getLevel($currentGroups);
        $targetLevel  = $getLevel($targetGroups);

        // User biasa tidak bisa hapus siapa pun
        if ($currentLevel === 1) return false;

        // Admin hanya boleh hapus user biasa
        if ($currentLevel === 2 && $targetLevel === 1) return true;

        // Super admin bisa hapus siapa pun kecuali sesama super admin
        if ($currentLevel === 3 && $targetLevel < 3) return true;

        return false;
    }
}
