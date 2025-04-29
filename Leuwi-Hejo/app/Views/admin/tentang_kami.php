  <?= $this->extend('layout/template_admin'); ?>
  <?= $this->section('content'); ?>
  <main>
      <div class="container-fluid px-4">
          <h1 class="mt-4">Manajemen Tentang Kami</h1>
          <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item"><a href="<?= base_url('admin/'); ?>"
                      style="text-decoration: none;">Dashboard</a></li>
              <li class="breadcrumb-item active">Tentang Kami</li>
          </ol>
          <div class="card mb-4">
              <div class="card-body">
<<<<<<< HEAD
                  <h2>Kelola Konten Halaman Beranda</h2>
                  <?php if (session()->getFlashdata('success')) : ?>
                      <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
=======
                  <h2>Siapa Kami</h2>
                  <?php if (session()->getFlashdata('success')) : ?>
                  <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
>>>>>>> 2f5f680020df4e91a8ae7f82e79136d0bd0ff7af
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
<<<<<<< HEAD
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
=======
                          <tr>
                              <td class="text-center"><?= esc($k['title']); ?></td>
                              <td class="text-center"><?= esc($k['body']); ?></td>
                              <td class="text-center">
                                  <a href="/admin/tentang_kami/edit/<?= esc($k['slug']); ?>"><i
                                          class="fa-solid fa-pen-to-square fa-xl"></i></a>
                              </td>
                          </tr>
                          <?php endforeach; ?>
                      </tbody>
                  </table>


>>>>>>> 2f5f680020df4e91a8ae7f82e79136d0bd0ff7af
              </div>
          </div>
      </div>
  </main>
  <?= $this->endsection(); ?>