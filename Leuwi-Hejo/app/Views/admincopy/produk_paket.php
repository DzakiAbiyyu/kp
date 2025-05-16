  <?= $this->extend('layout/template_admin'); ?>
  <?= $this->section('content'); ?>
  <main>
      <div class="container-fluid px-4">
          <h1 class="mt-4">Manajemen Produk dan Paket</h1>
          <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item"><a href="<?= base_url('admin/'); ?>"
                      style="text-decoration: none;">Dashboard</a></li>
              <li class="breadcrumb-item active">Produk & Paket</li>
          </ol>
          <div class="card mb-4">
              <div class="card-body">
                  This page is an example of using the light side navigation option. By appending the
                  <code>.sb-sidenav-light</code>
                  class to the
                  <code>.sb-sidenav</code>
                  class, the side navigation will take on a light color scheme. The
                  <code>.sb-sidenav-dark</code>
                  is also available for a darker option.
              </div>
          </div>
      </div>
  </main>
  <?= $this->endsection(); ?>