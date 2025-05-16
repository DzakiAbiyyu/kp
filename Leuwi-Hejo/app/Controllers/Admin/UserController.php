<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Myth\Auth\Models\GroupModel;
use App\Models\UserModel;

class UserController extends BaseController
{
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
    public function profile()
    {
        $auth = service('authentication');

        if (! $auth->check()) {
            return redirect()->to('/login')->with('error', 'Silakan login.');
        }

        $user = $auth->user();

        $groupModel = new GroupModel();
        $groups = $groupModel->getGroupsForUser($user->id);

        return view('admin/users/profile', [
            'user' => $user,
            'groups' => $groups
        ]);
    }
}
