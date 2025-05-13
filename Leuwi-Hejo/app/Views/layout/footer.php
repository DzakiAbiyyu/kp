   <!-- Footer Start -->
   <?php
    $uri = service('uri');
    $path = trim($uri->getPath(), '/'); // hapus / di awal/akhir
    $isHome = $path === '' || $path === 'index.php';
    ?>


   <footer class="footer <?= $isHome ? 'fixed' : '' ?>">
       <div class="footer-content">
           <p>&copy; <?= date('Y'); ?> Leuwi Hejo. Semua hak dilindungi</p>
           <div class="social-media">
               <?php foreach ($media as $m) : ?>
               <a href="<?= esc($m['link']) ?>" target="_blank"><i class="fa-brands fa-<?= esc($m['icon']) ?>"></i></a>
               <?php endforeach; ?>


           </div>
       </div>
   </footer>
   <!-- Footer End -->