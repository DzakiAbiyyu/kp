<?php

namespace App\Controllers;

class Jendela extends BaseController
{
    public function load($viewName)
    {
        $data = [
            'title' => 'Home | Form Pesan'
        ];
        $allowedViews = ['informasiCamping', 'informasiCampingNonTenda', 'campingTrakking', 'informasiPerlengkapan', 'informasiTrakking']; // sesuaikan view yang kamu izinkan

        if (in_array($viewName, $allowedViews)) {
            return view('Jendela/' . $viewName, $data);
        }

        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
}
