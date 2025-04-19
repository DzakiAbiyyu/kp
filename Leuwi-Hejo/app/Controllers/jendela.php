<?php

namespace App\Controllers;

class Jendela extends BaseController
{
    public function Reguler()
    {
        return view('Jendela/informasiReguler');
    }

    public function trakking()
    {
        return view('Jendela/informasiTrekking');
    }

    public function curug()
    {
        return view('Jendela/informasiCurug');
    }

    public function paketCombo()
    {
        return view('Jendela/informasiPaketCombo');
    }
}
