<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PaketModel;
use App\Models\CategoryModel;
use App\Models\HargaPaketModel;

class ProdukController extends BaseController
{
    protected $paketModel;
    protected $categoryModel;
    protected $hargaModel;

    public function __construct()
    {
        $this->paketModel = new PaketModel();
        $this->categoryModel = new CategoryModel();
        $this->hargaModel = new HargaPaketModel();
    }

    public function index()
    {
        $data['pakets'] = $this->paketModel->withCategories()->findAll();
        return view('admin/produk/index', $data);
    }

    public function create()
    {
        $data['categories'] = $this->categoryModel->findAll();
        return view('admin/produk/create', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();

        // Simpan data paket
        $paketId = $this->paketModel->insert([
            'category_id'    => $data['category_id'],
            'nama_paket'     => $data['nama_paket'],
            'deskripsi'      => $data['deskripsi'],
            'fasilitas'      => $data['fasilitas'],
            'fitur_tambahan' => $data['fitur_tambahan'] ?? null,
            'gambar'         => $data['gambar'] ?? null,
        ], true);

        // Simpan harga berdasarkan kapasitas
        if (isset($data['kapasitas']) && is_array($data['kapasitas'])) {
            foreach ($data['kapasitas'] as $i => $kap) {
                $this->hargaModel->insert([
                    'paket_id'  => $paketId,
                    'kapasitas' => $kap,
                    'harga'     => $data['harga'][$i]
                ]);
            }
        }

        return redirect()->to('/admin/produk')->with('message', 'Paket berhasil ditambahkan!');
    }
}
