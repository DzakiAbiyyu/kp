// document.querySelector('#hamburger-menu').addEventListener('click', function() {
    // document.querySelector('.navbar-nav').classList.toggle('active');
// });

const daftar = document.querySelector('#Daftar-none');

const navbarNav = document.querySelector('.navbar-nav');

document.querySelector('#hamburger-menu').onclick = () => {
   navbarNav.classList.toggle('active'); 
}



    function showPopup(url) {
        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('popupBodyInformasi').innerHTML = data;
                // document.getElementById('popupBodyForm').innerHTML = data;
                document.getElementById('infoModalInformasi').style.display = 'flex';
                // document.getElementById('infoModalForm').style.display = 'block';


            })
            .catch(error => console.error('Error:', error));
    }

    function closePopup() {
        document.getElementById('infoModalInformasi').style.display = 'none';
        // document.getElementById('infoModalForm').style.display = 'none';
    }

document.addEventListener('DOMContentLoaded', function () {
    const infoButtons = document.querySelectorAll('.Informasi');

    const form = document.getElementById('form-pesan');
    if (!form) return;

    infoButtons.forEach(button => {
        button.addEventListener('click', function() {
            const url = this.getAttribute('data-url');
            showPopup(url);
        });
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();
      
        const nama = document.getElementById('name').value.trim();
        const nomor = document.getElementById('nomor').value.trim();
        const jumlah = document.getElementById('jumlah').value.trim();
        const paket = document.getElementById('paket').value;
        const subPaket = document.getElementById('subPaket');
      
        
        // validasi nomor wa (08xxx atau 62xxx)
        const nomorPatern = /^(08\d{8,13}|628\d{8,13})$/;
        if (!nomorPatern.test(nomor)) {
          alert('Nomor WhatsApp harus dimulai dengan 08 atau 628 dan hanya angka.');
          return;
        }
      
        // Validasi Jumlah 
        const jumlahOrang = parseInt(jumlah);
        if(jumlahOrang < 1 || jumlahOrang >= 20 ) {
          alert('Jumlah orang harus antara 1 sampai 20.');
          return;
        }
      
        // 
      
      
        // Buat pesan dan redirect ke wa 
        const pesan = `Halo, saya ingin memesan paket wisata :%0A
      Nama : ${nama}%0A
      Nomor : ${nomor}%0A
      Jumlah Orang : ${jumlahOrang}%0A
      paket : ${paket}`;


      
        // nomor WhatsApp pemilik bisnis
        const nomorPemilik = '+6282226221535';
      
      
        const waLink = `https://wa.me/${nomorPemilik}?text=${pesan}`;
        window.open(waLink, '_blank');
      });
      
});



