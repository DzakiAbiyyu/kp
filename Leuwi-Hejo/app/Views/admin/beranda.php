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
          <!-- <div class="card mb-4">
              <div class="card-body">
                  Page ini berisi tentang manajemne konten untuk beranda mulai dari mengganti backgroundnya, mengganti
                  gambar ataupun harga harga yang tertera dalam konten eranda
              </div>
          </div> -->

      </div>
  </main>
  <?= $this->endsection(); ?>