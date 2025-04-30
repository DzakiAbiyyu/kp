<?php

namespace App\Controllers;

use App\Models\ContentModel;

class Login extends BaseController
{
    public function index(): string
    {

        return view('auth/login');
    }
}
