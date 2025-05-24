<?php

namespace App\Models;

use Myth\Auth\Models\UserModel;

class UserNoSoftDeleteModel extends UserModel
{
    protected $useSoftDeletes = false;
}
