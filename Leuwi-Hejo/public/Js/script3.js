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

function initCampingFormHandler() {
    const form = document.getElementById('form-pesan');
    if (!form) return;

    const kendaraanSelect = document.getElementById('jenisKendaraan');
    const motorSelect = document.getElementById('Motor');
    const mobilSelect = document.getElementById('Mobil');

    // Tampilkan pilihan motor/mobil sesuai jenis kendaraan
    kendaraanSelect.addEventListener('change', function () {
        if (this.value === 'Motor') {
            motorSelect.hidden = false;
            motorSelect.disabled = false;
            mobilSelect.hidden = true;
            mobilSelect.disabled = true;
        } else if (this.value === 'Mobil') {
            mobilSelect.hidden = false;
            mobilSelect.disabled = false;
            motorSelect.hidden = true;
            motorSelect.disabled = true;
        }
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const nama = document.getElementById('name').value.trim();
        const nomor = document.getElementById('nomor').value.trim();
        const namaPaket = document.getElementById('hiddenInput').value;
        const tenda = document.getElementById('paketTenda');
        const jenisKendaraan = kendaraanSelect.value;
        const kendaraanJumlah = jenisKendaraan === 'Motor'
            ? motorSelect.options[motorSelect.selectedIndex].text
            : mobilSelect.options[mobilSelect.selectedIndex].text;

        const nomorPatern = /^(08\d{8,13}|628\d{8,13})$/;
        if (!nomorPatern.test(nomor)) {
            alert('Nomor WhatsApp tidak valid.');
            return;
        }

        if (!tenda.value || !jenisKendaraan || kendaraanJumlah === '') {
            alert('Mohon lengkapi semua pilihan.');
            return;
        }

        const pesan = `Halo, saya ingin memesan paket wisata: 
${namaPaket}
Nama: ${nama}
Nomor: ${nomor}
Tenda: ${tenda.options[tenda.selectedIndex].text}
Kendaraan: ${jenisKendaraan} sebanyak ${kendaraanJumlah}`;

        const nomorPemilik = '6282226221535';
        const waLink = `https://wa.me/${nomorPemilik}?text=${encodeURIComponent(pesan)}`;
        window.open(waLink, '_blank');
    });
}


function initCampingNonTenda() {
    const form = document.getElementById('form-pesan');
    if (!form) return;

    let paket = document.getElementById('paket'); 
    let motor = document.getElementById('Motor');
    let mobil = document.getElementById('Mobil');



    // Event listener untuk ubah sub-paket saat paket dipilih 
    paket.addEventListener('change', function () {
        let selectedOption = this.options[this.selectedIndex];
        let value = selectedOption.value;
        let text = selectedOption.text;
        let motor = document.getElementById('Motor');
        let mobil = document.getElementById('Mobil');

        // Jika memilih motor/mobil
        if (text === 'Motor') {
            motor.hidden = false;
            motor.disabled = false;
            mobil.hidden = true;
            mobil.disabled = true;
        } else if (text === 'Mobil') {
            mobil.hidden = false;
            mobil.disabled = false;
            motor.hidden = true;
            motor.disabled = true;
        }
    });
    

    form.addEventListener('submit', function (event) {
        // event.preventDefault();

        let nama = document.getElementById('name').value.trim();
        let nomor = document.getElementById('nomor').value.trim();
        let jumlah = document.getElementById('jumlah').value.trim();
        let paket = document.getElementById('paket'); // ini elemen <select>
        let nilaiPaket = paket.value; // ini value dari option
        let textPaket = paket.options[paket.selectedIndex].text; // ini text dari option
        let namaPaket = document.getElementById('hiddenInput').value;
        // const subPaket = document.getElementById('subPaket');        

        // Validasi nomor WA (08xxx atau 628xxx)
        const nomorPatern = /^(08\d{8,13}|628\d{8,13})$/;
        if (!nomorPatern.test(nomor)) {
            alert('Nomor WhatsApp harus dimulai dengan 08 atau 628 dan hanya angka.');
            return;
        }

        // Validasi jumlah orang
        const jumlahOrang = parseInt(jumlah);
        if (jumlahOrang < 1 || jumlahOrang >= 20) {
            alert('Jumlah orang harus antara 1 sampai 20.');
            return;
        }

        // Menyiapkan wadah untuk paket yang di pilih
        let selectedPackages = [];

        // Cek pilihan untuk motor
        let motorSelect = document.getElementById('Motor');
        if (motorSelect.selectedIndex > 0) {  // pastikan ada yang dipilih selain default
            let motorText = motorSelect.options[motorSelect.selectedIndex].text;
            selectedPackages.push('Motor: ' + motorText);
        }

        // Cek pilihan untuk mobil
        let mobilSelect = document.getElementById('Mobil');
        if (mobilSelect.selectedIndex > 0) {  // pastikan ada yang dipilih selain default
            let mobilText = mobilSelect.options[mobilSelect.selectedIndex].text;
            selectedPackages.push('Mobil: ' + mobilText);
        }

        // Menyaipkan pesan wa
        let pesan = `Halo, saya ingin memsan paket wisata : \n${namaPaket}\nNama : ${nama}\nNomor : ${nomor}\nJumlah Orang : ${jumlah}\nPaket : ${textPaket}`;

        if (selectedPackages.length > 0 ) {
            pesan += '\nPaket yang dipilih :\n' + selectedPackages.join('\n');   
        }
        
        // Nomor WhatsApp pemilik bisnis (tanpa +)
        let nomorPemilik = '6282226221535';

        // Pesan berhasil
        alert('Pesan berhasil dikirim. anda akan di arahkan ke WhatsApp.');

        // Redirect ke WA
        // const waLink = `https://wa.me/${nomorPemilik}?text=${pesan}`;
        // window.open(waLink, '_blank');
        const waLink = `https://wa.me/${nomorPemilik}?text=${encodeURIComponent(pesan)}`;
        window.open(waLink, '_blank');      
    });   
};
    

document.addEventListener('DOMContentLoaded', function () {
    const infoButtons = document.querySelectorAll('.Informasi');
    initCampingNonTenda();
    initCamping();
    // const form = document.getElementById('form-pesan');
    // if (!form) return;

    infoButtons.forEach(button => {
        button.addEventListener('click', function() {
            const url = this.getAttribute('data-url');
            showPopup(url);
        });
    });
});



