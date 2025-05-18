<?php

use Myth\Auth\Models\GroupModel;

if (!function_exists('canDeleteUser')) {
    function canDeleteUser($currentUser, $targetUser): bool
    {
        if ($currentUser->id == $targetUser->id) {
            return false; // Tidak boleh hapus diri sendiri
        }

        $groupModel = new GroupModel();
        $currentGroups = array_column($groupModel->getGroupsForUser($currentUser->id), 'name');
        $targetGroups  = array_column($groupModel->getGroupsForUser($targetUser->id), 'name');

        // Level: super_admin = 3, admin = 2, user = 1
        $getLevel = function ($groups) {
            if (in_array('super_admin', $groups)) return 3;
            if (in_array('admin', $groups)) return 2;
            return 1;
        };

        $currentLevel = $getLevel($currentGroups);
        $targetLevel  = $getLevel($targetGroups);

        // Logika hak akses
        if ($currentLevel === 1) return false;
        if ($currentLevel === 2 && $targetLevel === 1) return true;
        if ($currentLevel === 3 && $targetLevel < 3) return true;

        return false;
    }
}
