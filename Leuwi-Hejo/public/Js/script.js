const daftar = document.querySelector('#Daftar-none');

const navbarNav = document.querySelector('.navbar-nav');

const navbar = document.querySelector('.navbar');
window.addEventListener('scroll', function () {
    if (this.window.scrollY > 50) {
        navbar.classList.add('solid')
    } else {
        navbar.classList.remove('solid');
    }
});

document.querySelector('#hamburger-menu').addEventListener('click', function (e) {
    e.preventDefault();
    navbarNav.classList.toggle('active');
});

// slider
// let images = [
//     '/img/satujpg',
//     '/img/dua.jpg',
//     '/img/tiga.jpg'
//   ];

//   let currentIndex = 0;
//   const hero = document.getElementById('hero');

//   // Set image awal
//   hero.style.setProperty('--bg-before', `url('${images[currentIndex]}')`);
//   currentIndex = (currentIndex + 1) % images.length;
//   hero.style.setProperty('--bg-after', `url('${images[currentIndex]}')`);

//   // Tambahkan style agar pseudo-element bisa akses var
//   const style = document.createElement('style');
//   style.innerHTML = `
//   .hero::before {
//     background-image: var(--bg-before);
//   }
//   .hero::after {
//     background-image: var(--bg-after);
//   }
//   `;
//   document.head.appendChild(style);

//   let isBeforeActive = true;

//   function changeBackground() {
//     currentIndex = (currentIndex + 1) % images.length;
//     const nextImage = images[currentIndex];

//     if (isBeforeActive) {
//       hero.style.setProperty('--bg-after', `url('${nextImage}')`);
//       hero.classList.add('fade-to-after');
//       hero.classList.remove('fade-to-before');
//     } else {
//       hero.style.setProperty('--bg-before', `url('${nextImage}')`);
//       hero.classList.add('fade-to-before');
//       hero.classList.remove('fade-to-after');
//     }

//     isBeforeActive = !isBeforeActive;
//   }

//   setInterval(changeBackground, 2000);
// end slider  

// const nomorPemilik = '6282226221535';


function initFormReguler(formId, fieldSettings) {
    const form = document.getElementById(formId);
    if (!form) return;

    const fields = {};
    // const fields = {};
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

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        let nama = fields.nama.value.trim();
        let nomor = fields.nomor.value.trim();
        let jumlahOrang = fields.jumlah.value;
        let namaPaket = fields.namaPaket.value;
        let lahan = fields.lahan.value;
        let textLahan = fields.lahan.options[fields.jenisKendaraan.selectedIndex].text;
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


        let pesan = `Halo, Saya ingin memesan paket\n*Nama Paket*\t\t: ${namaPaket}\n*Nama*\t\t\t: ${nama}\n*Nomor*\t\t\t: ${nomor}\n*Jumlah Orang*\t\t: ${jumlahOrang}\n*Lahan*\t\t\t: ${textLahan}\n*Jenis Kendaraan*\t\t: ${kendaraan}\n*Jumlah Kendaraan*\t: ${jumlahKendaraan}\n*Untuk tanggal*\t\t: ${tanggal}`;
        if (selectedPackages.length > 0) {
            pesan += `\n*Sewa Perlengkapan*\t: ${selectedPackages.join(' - ')}`;
        }

        const nomorPemilik = '6282226221535';

        alert('Pesan berhasil dikirim. Anda akan diarahkan ke WhatsApp.');
        const waLink = `https://wa.me/${nomorPemilik}?text=${encodeURIComponent(pesan)}`;
        window.open(waLink, '_blank');

    });
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
        let namaPaket = fields.namaPaket.value;
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

        // let pesan = `Halo, saya ingin memesan paket Camping Non Trakking:\n*Nama*   : ${nama}\nNomor    : ${nomor}\nJumlah Orang    : ${jumlahOrang}\nJenis Kendaraan   : ${kendaraan}\nJumlah Kendaraan   : ${jumlahKendaraan}\nUntuk tanggal : ${tanggal}`;
        let pesan = `Halo, saya ingin memesan paket :\n*Nama Paket*\t\t: ${namaPaket}\n*Nama*\t\t\t: ${nama}\n*Nomor*\t\t\t: ${nomor}\n*Jumlah Orang*\t\t: ${jumlahOrang}\n*Jenis Kendaraan*\t\t: ${kendaraan}\n*Jumlah Kendaraan*\t: ${jumlahKendaraan}\n*Untuk tanggal*\t\t: ${tanggal}
        `;
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
        let namaPaket = fields.namaPaket.value;
        let paket = fields.paketTenda ? fields.paketTenda.value : '';
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
        let pesan = `Halo, saya ingin memesan paket :\n*Nama Paket*\t\t: ${namaPaket}\n*Nama*\t\t\t: ${nama}\n*Nomor*\t\t\t: ${nomor}\n*kapasitas Tenda*\t\t: ${paket}\n*Jenis Kendaraan*\t\t: ${kendaraan}\n*Jumlah Kendaraan*\t: ${jumlahKendaraan}\n*Tanggal*\t\t\t: ${tanggal}`;

        if (selectedPackages.length > 0) {
            pesan += `\n*Sewa Perlengkapan*\t: ${selectedPackages.join(' - ')}`;
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

        let pesan = `Halo, saya ingin memesan paket :\n*Nama Paket*\t\t: ${namaPaket}\n*Nama*\t\t\t: ${nama}\n*Nomor*\t\t\t: ${nomor}\n*Paket/Pax*\t\t: ${paket}\n*Rute*\t\t\t: ${rute}\n*Tanggal*\t\t\t: ${tanggal}`;
        if (selectedPackages.length > 0) {
            pesan += `\n*Sewa Perlengkapan*\t: ${selectedPackages.join(' - ')}`;
        }


        let nomorPemilik = '6282226221535';

        alert('Pesan berhasil dikirimkan. Anda akan diarahkan ke WhatsApp');
        const waLink = `https://wa.me/${nomorPemilik}?text=${encodeURIComponent(pesan)}`;
        window.open(waLink, '_blank');
    });
}

function initFormCampingTrakking(formId, fieldSettings) {
    let form = document.getElementById(formId);
    if (!form) return;

    const fields = {};
    for (let fieldName in fieldSettings) {
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

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        let nama = fields.nama.value.trim();
        let nomor = fields.nomor.value.trim();
        let namaPaket = fields.namaPaket.value;
        let paketTenda = fields.paketTenda.value;
        let kendaraan = fields.jenisKendaraan.options[fields.jenisKendaraan.selectedIndex].text;
        let paket = fields.paket.options[fields.paket.selectedIndex].text;
        let rute = fields.rute.options[fields.rute.selectedIndex].text;
        let tanggal = fields.tanggal.value;
        let jumlahKendaraan = '';

        if (fields.jenisKendaraan.value === 'Motor') {
            let motorSelected = document.getElementById('Motor').options[document.getElementById('Motor').selectedIndex];
            jumlahKendaraan = motorSelected.text;
        } else if (fields.jenisKendaraan.value === 'Mobil') {
            let mobilSelected = document.getElementById('Mobil').options[document.getElementById('Mobil').selectedIndex];
            jumlahKendaraan = mobilSelected.text;
        }


        // cek jika perlengkapan di centang
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
        // let pesan = `Halo, saya ingin memesan paket\n*Nama Paket*\t\t: ${namaPaket}\n*Nama*\t\t: ${nama}\n*Nomor*\t\t: ${nomor}\n*Kapsitas Tenda*\t: ${paketTenda}\n*Jenis Kendaraan *\t:${kendaraan}\n*Jumlah Kendaraan*\t:${jumlahKendaraan}\n*Rute*\t\t:${rute}\n*paket/Pax\t\t:*${paket}\n*tanggal\t\t:*${tanggal}`;
        let pesan = `Halo, saya ingin memesan paket :\n*Nama Paket*\t\t: ${namaPaket}\n*Nama*\t\t\t: ${nama}\n*Nomor*\t\t\t: ${nomor}\n*Kapsitas Tenda*\t\t: ${paketTenda}\n*Jenis Kendaraan*\t\t: ${kendaraan}\n*Jumlah Kendaraan*\t: ${jumlahKendaraan}\n*Rute*\t\t\t: ${rute}\n*paket/Pax*\t\t: ${paket}\n*tanggal*\t\t\t: ${tanggal}`;

        if (selectedPackages.length > 0) {
            pesan += `\n*Sewa Perlengkapan*\t: ${selectedPackages.join(' - ')}`;
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
        namaPaket: 'hiddenInput',
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
        jumlah: 'jumlah',
        namaPaket: 'hiddenInput',
        jenisKendaraan: 'jenisKendaraan',
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

    initFormCampingTrakking('form-camping-trakking', {
        nama: 'name',
        nomor: 'nomor',
        namaPaket: 'hiddenInput',
        paketTenda: 'paketTenda',
        jenisKendaraan: 'jenisKendaraan',
        paket: 'paket',
        rute: 'rute',
        perlengkapanCheckbox: 'perlengkapanCheckbox',
        perlengkapanList: 'perlengkapanList',
        perlengkapanError: 'perlengkapanError',
        tanggal: 'tanggal'
    });

    initFormReguler('form-sewa-lahan', {
        nama: 'name',
        nomor: 'nomor',
        jumlah: 'jumlah',
        namaPaket: 'hiddenInput',
        lahan: 'Lahan',
        jenisKendaraan: 'jenisKendaraan',
        perlengkapanCheckbox: 'perlengkapanCheckbox',
        perlengkapanList: 'perlengkapanList',
        perlengkapanError: 'perlengkapanError',
        tanggal: 'tanggal'
    });


});
