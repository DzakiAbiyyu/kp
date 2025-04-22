const daftar = document.querySelector('#Daftar-none');

const navbarNav = document.querySelector('.navbar-nav');

document.querySelector('#hamburger-menu').onclick = () => {
   navbarNav.classList.toggle('active'); 
}

function initFormCampingNonTrekking(formId, fieldSettings) {
    const form = document.getElementById(formId);
    if (!form) return;

    const fields = {};
    for (const fieldName in fieldSettings) {
        fields[fieldName] = document.getElementById(fieldSettings[fieldName]);
    }

    if (fields.jenisKendaraan) {
        fields.jenisKendaraan.addEventListener('change', function () {
            let motor = document.getElementById('Motor');
            let mobil = document.getElementById('Mobil');
            let selectedOption = this.options[this.selectedIndex];
            let text = selectedOption.text;

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
    }

    const validateNomor = (nomor) => {
        const nomorPattern = /^(08\d{8,13}|628\d{8,13})$/;
        return nomorPattern.test(nomor);
    };

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        let nama = fields.nama.value.trim();
        let nomor = fields.nomor.value.trim();
        let jumlahOrang = fields.jumlah.value;

        let kendaraan = fields.jenisKendaraan.options[fields.jenisKendaraan.selectedIndex].text;
        let jumlahKendaraan = '';

        let tanggal = fields.tanggal.value.trim();

        if (fields.jenisKendaraan.value === 'Motor') {
            let motorSelected = document.getElementById('Motor').options[document.getElementById('Motor').selectedIndex];
            jumlahKendaraan = motorSelected.textContent;
        } else if (fields.jenisKendaraan.value === 'Mobil') {
            let mobilSelected = document.getElementById('Mobil').options[document.getElementById('Mobil').selectedIndex];
            jumlahKendaraan = mobilSelected.textContent;
        }

        if (!validateNomor(nomor)) {
            alert('Nomor WhatsApp harus dimulai dengan 08 atau 628 dan hanya angka.');
            return;
        }

        let pesan = `Halo, saya ingin memesan paket Camping Non Trakking:\nNama: ${nama}\nNomor: ${nomor}\nJumlah Orang: ${jumlahOrang}\nJenis Kendaraan: ${kendaraan}\nJumlah Kendaraan: ${jumlahKendaraan}\nUntuk tanggal: ${tanggal}`;
        const nomorPemilik = '6282226221535';
        // const nomorPemilik = '62818109442';


        alert('Pesan berhasil dikirim. Anda akan diarahkan ke WhatsApp.');
        const waLink = `https://wa.me/${nomorPemilik}?text=${encodeURIComponent(pesan)}`;
        window.open(waLink, '_blank');
    });
}

function initFormCamping(formId, fieldSettings) {
    const form = document.getElementById(formId);
    if (!form) return;  // Pastikan form ada

    // Setiap form bisa punya field yang berbeda. Field settings bisa berupa objek.
    const fields = {};
    for (const fieldName in fieldSettings) {
        fields[fieldName] = document.getElementById(fieldSettings[fieldName]);
    }

    // Event listener saat ada perubahan pada field jenisKendaraan
    if (fields.jenisKendaraan) {
        fields.jenisKendaraan.addEventListener('change', function () {
            let motor = document.getElementById('Motor');
            let mobil = document.getElementById('Mobil');
            let selectedOption = this.options[this.selectedIndex];
            let text = selectedOption.text;

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
    }

    // Fungsi untuk validasi nomor WhatsApp
    const validateNomor = (nomor) => {
        const nomorPattern = /^(08\d{8,13}|628\d{8,13})$/;
        return nomorPattern.test(nomor);
    };

    let perlengkapanCheckbox = fields.perlengkapanCheckbox;
    let perlengkapanList = fields.perlengkapanList;
    let perlengkapanError = fields.perlengkapanError;

    perlengkapanCheckbox.addEventListener('change', () => {
        if (perlengkapanCheckbox.checked) {
            perlengkapanList.style.display = 'block';
        } else {
            perlengkapanList.style.display = 'none';
        }
    });


    // Menangani event submit form
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        let nama = fields.nama.value.trim();
        let nomor = fields.nomor.value.trim();
        let paket = fields.paketTenda ? fields.paketTenda.value : '';  
        // console.log(paket);
        let kendaraan = fields.jenisKendaraan ? fields.jenisKendaraan.options[fields.jenisKendaraan.selectedIndex].text : '';
        let tanggal = fields.tanggal.value.trim();
        

        let jumlahKendaraan = 0; // Default ke 0 jika tidak ada pilihan
        if (fields.jenisKendaraan.value === 'Motor') {
            let motorValue = document.getElementById('Motor').value;
            let motorText = document.getElementById('Motor').options[document.getElementById('Motor').selectedIndex].text;
            jumlahKendaraan = parseInt(motorText, 10); // Mengonversi teks menjadi angka
        } else if (fields.jenisKendaraan.value === 'Mobil') {
            let mobilValue = document.getElementById('Mobil').value;
            let mobilText = document.getElementById('Mobil').options[document.getElementById('Mobil').selectedIndex].text;
            jumlahKendaraan = parseInt(mobilText, 10); // Mengonversi teks menjadi angka
        }

        // Validasi nomor WhatsApp
        if (!validateNomor(nomor)) {
            alert('Nomor WhatsApp harus dimulai dengan 08 atau 628 dan hanya angka.');
            return;
        }

        // cek perlengkapan jika dicentang
        let selectedPackages = [];
        let perlengkapanTerpilihValue = [];
        let perlengkapanTerpilihText = [];

        if (perlengkapanCheckbox.checked) {
            const itemCheckboxes = perlengkapanList.querySelectorAll('input[type="checkbox"]:checked');

            itemCheckboxes.forEach(cb => {
                perlengkapanTerpilihValue.push(cb.value);

                const label = document.querySelector(`label[for="${cb.value}"]`);
                if (label) {
                    perlengkapanTerpilihText.push(label.textContent.trim());
                } else {
                    perlengkapanTerpilihText.push(cb.value);
                }
            });

            if (perlengkapanTerpilihValue.length > 0) {
                perlengkapanError.hidden = true;
                selectedPackages = perlengkapanTerpilihText;
            }
        }
        

        // Menyiapkan pesan untuk WhatsApp
        let pesan = `Halo, saya ingin memesan paket camping\nPaket  : ${paket}\nNama    : ${nama}\nNomor    : ${nomor}\nJenis Kendaraan     : ${kendaraan}\nJumlah Kendaraan    : ${jumlahKendaraan}\nUntuk Tanggal : ${tanggal}`;
        
        if (selectedPackages.length > 0) {
            pesan += `\nSewa Perlengkapan   : ${selectedPackages.join(' - ')}`;
        }

        const nomorPemilik = '6282226221535';
        // const nomorPemilik = '62818109442';

        // Redirect ke WhatsApp
        alert('Pesan berhasil dikirim. Anda akan diarahkan ke WhatsApp.');
        const waLink = `https://wa.me/${nomorPemilik}?text=${encodeURIComponent(pesan)}`;
        window.open(waLink, '_blank');
    });
}

function initFormTrakking(formId, fieldSettings) {
    let form = document.getElementById(formId);
    if (!form) return;

    const fields = {};
    for (const fieldName in fieldSettings) {
        fields[fieldName] = document.getElementById(fieldSettings[fieldName]);
    }

    const validateNomor = (nomor) => {
        const nomorPattern = /^(08\d{8,13}|628\d{8,13})$/;
        return nomorPattern.test(nomor);
    }

    let perlengkapanCheckbox = fields.perlengkapanCheckbox;
    let perlengkapanList = fields.perlengkapanList;
    let perlengkapanError = fields.perlengkapanError;

    perlengkapanCheckbox.addEventListener('change', () => {
        if (perlengkapanCheckbox.checked) {
            perlengkapanList.style.display = 'block';
        } else {
            perlengkapanList.style.display = 'none';
        }
    });

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        let nama = fields.nama.value.trim();
        let nomor = fields.nomor.value.trim();
        let namaPaket = fields.namaPaket.value;
        let paket = fields.paket.options[fields.paket.selectedIndex].text;
        let rute = fields.rute.options[fields.rute.selectedIndex].text;
        let tanggal = fields.tanggal.value;

        if (!validateNomor(nomor)) {
            const errorMessage = "Nomor WhatsApp tidak valid. Masukkan format yang benar, contoh: 08xxxx atau 628xxx";
            alert(errorMessage);
            return;
        }

        // cek perlengkapan jika dicentang
        let selectedPackages = [];
        let perlengkapanTerpilihValue = [];
        let perlengkapanTerpilihText = [];

        if (perlengkapanCheckbox.checked) {
            const itemCheckboxes = perlengkapanList.querySelectorAll('input[type="checkbox"]:checked');

            itemCheckboxes.forEach(cb => {
                perlengkapanTerpilihValue.push(cb.value);

                const label = document.querySelector(`label[for="${cb.value}"]`);
                if (label) {
                    perlengkapanTerpilihText.push(label.textContent.trim());
                } else {
                    perlengkapanTerpilihText.push(cb.value);
                }
            });

            if (perlengkapanTerpilihValue.length > 0) {
                perlengkapanError.hidden = true;
                selectedPackages = perlengkapanTerpilihText;
            }
        }

        let pesan = `Halo, saya ingin memesan paket ${namaPaket}\nNama  : ${nama}\nNomor    : ${nomor}\nPaket/Pax   : ${paket}\nRute    : ${rute}\nTanggal  : ${tanggal}`;
        if (selectedPackages.length > 0) {
            pesan += `\nSewa Perlengkapan: ${selectedPackages.join(' - ')}`;  
        }


        let nomorPemilik = '6282226221535';

        alert('Pesan berhasil dikirimkan. Anda akan diarahkan ke WhatsApp');
        const waLink = `https://wa.me/${nomorPemilik}?text=${encodeURIComponent(pesan)}`;
        window.open(waLink, '_blank');
    });
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


// Inisialisasi form handling untuk form yang berbeda
document.addEventListener('DOMContentLoaded', function () {
    const infoButtons = document.querySelectorAll('.Informasi');
    infoButtons.forEach(button => {
        button.addEventListener('click', function () {
            const url = button.getAttribute('data-url');
            showPopup(url);
        });
    });

    // Panggil initFormHandling untuk form pertama
    initFormCamping('form-camping', {
        nama: 'name',
        nomor: 'nomor',
        paketTenda: 'paketTenda',  
        jenisKendaraan: 'jenisKendaraan',
        perlengkapanCheckbox: 'perlengkapanCheckbox',
        perlengkapanList: 'perlengkapanList',
        perlengkapanError: 'perlengkapanError',
        tanggal: 'tanggal'
    });

    initFormCampingNonTrekking('form-campinNonTenda', {
        nama: 'name',
        nomor: 'nomor',
        jenisKendaraan: 'jenisKendaraan',
        jumlah: 'jumlah',
        tanggal: 'tanggal'
    });

    initFormTrakking('form-trakking', {
        nama: 'name',
        nomor: 'nomor',
        namaPaket: 'hiddenInput',
        paket: 'paket',
        rute: 'rute',
        perlengkapanCheckbox: 'perlengkapanCheckbox',
        perlengkapanList: 'perlengkapanList',
        perlengkapanError: 'perlengkapanError',
        tanggal: 'tanggal'
    });


});
