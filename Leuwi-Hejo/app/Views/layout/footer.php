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
               <a href="#" target="_blank">
                   <i class="fa-solid fa-house"><i class="bi bi-facebook"></i></i>
               </a>
               <a href="#" target="_blank"><i class="bi bi-instagram"></i></i></a>
               <a href="#" target="_blank"><i class="bi bi-twitter"></i></a>
           </div>
       </div>
   </footer>
   <!-- Footer End -->