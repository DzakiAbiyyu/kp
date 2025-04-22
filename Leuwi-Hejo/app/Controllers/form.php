<?php

namespace App\Controllers;

class form extends BaseController
{
    public function load($viewName)
    {
        $data = [
            'title' => 'Home | Form Pesan'
        ];
        $allowedViews = ['camping', 'campingNonTenda', 'campingTrakking', 'perlengkapanCamping', 'trekking',]; // sesuaikan view yang kamu izinkan

        if (in_array($viewName, $allowedViews)) {
            return view('form/' . $viewName, $data);
        }

        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
}
