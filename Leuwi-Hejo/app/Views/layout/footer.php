   <!-- Footer Start -->
   <?php
    $uri = service('uri');
    $path = trim($uri->getPath(), '/'); // hapus / di awal/akhir
    $isHome = $path === '' || $path === 'index.php';
    ?>


   <footer class="footer <?= $isHome ? 'fixed' : '' ?>">
       <div class="footer-content">
           <p>&copy; <?= date('Y'); ?> Leuwi Hejo. Semua hak dilindungi</p>
           <div class="sosial-media">
               <a href="#" target="_blank"><i class="bi bi-facebook" style="font-size: 2rem;"></i></a>
               <a href="#" target="_blank">Instagram</a>
               <a href="#" target="_blank">Twitter</a>
           </div>
       </div>
   </footer>
   <!-- Footer End -->