<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Myth\Auth\Models\GroupModel;

class UserController extends BaseController
{
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
