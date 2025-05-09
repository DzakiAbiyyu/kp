  <?= $this->extend('layout/template_admin'); ?>
  <?= $this->section('content'); ?>
  <main>
      <div class="container-fluid px-4">
          <h1 class="mt-4">Manajemen Beranda</h1>
          <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item"><a href="<?= base_url('admin/'); ?>"
                      style="text-decoration: none;">Dashboard</a></li>
              <li class="breadcrumb-item active">Beranda</li>
          </ol>
          <div class="card mb-4">
              <div class="card-body">
                  <h2>Kelola Konten Halaman Beranda</h2>
                  <?php if (session()->getFlashdata('success')) : ?>
                      <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                  <?php endif; ?>
                  <table class="table table-bordered mt-3">
                      <thead class="bg-primary">
                          <tr>
                              <th class="text-center">Judul</th>
                              <th class="text-center">Deskripsi</th>
                              <th class="text-center">Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php foreach ($konten as $k) : ?>
                              <tr>
                                  <td class="text-center"><?= esc($k['title']); ?></td>
                                  <td class="text-center"><?= esc($k['body']); ?></td>
                                  <td class="text-center">
                                      <a href="/admin/beranda/edit/<?= esc($k['slug']); ?>"><i class="fa-solid fa-pen-to-square fa-xl"></i></a>
                                  </td>
                              </tr>
                          <?php endforeach; ?>
                      </tbody>
                  </table>
              </div>
          </div>

          <div class="card mb-4">
              <div class="card-body">
                  <h2 class="mb-4">Kelola Background Halaman Beranda</h2>
                  <?php if (session()->getFlashdata('success')) : ?>
                      <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                  <?php endif; ?>
                  <div class="row">
                      <?php foreach ($gambar as $g) : ?>
                          <div class="col-md-4 mb-3">
                              <img src="<?= base_url($g['gambar']) ?>" alt="Background" class="img-fluid rounded" style="width: 100%; max-height:200px; object-fit:containt;">
                              <div class="card-body text-center">
                                  <a href="<?= base_url('admin/beranda/edit-gambar/' . $g['slug']) ?>">
                                      <i class="fa-solid fa-pen-to-square fa-xl"></i>
                                  </a>
                                  <form action="<?= base_url('admin/beranda/hapus-gambar/' . $g['slug']) ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus gambar ini?');" style="display:inline;">
                                      <?= csrf_field() ?>
                                      <button type="submit" class="btn  btn-sm"><i class="fa-solid fa-trash fa-xl " style="color: red;"></i></button>
                                  </form>
                              </div>
                          </div>
                      <?php endforeach; ?>
                  </div>
              </div>

          </div>


      </div>
  </main>
  <?= $this->endsection(); ?>