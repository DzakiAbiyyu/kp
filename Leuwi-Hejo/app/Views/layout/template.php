<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- jQuery (harus sebelum Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 (versi stabil, hanya 1x) -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&display=swap" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet"> -->

    <!-- My Style -->
    <link rel="stylesheet" href="/css/style.css">

    <title><?= $title; ?></title>
</head>

<body>
    <?= $this->include('layout/navbar'); ?>
    <?= $this->renderSection('content'); ?>
    <?= $this->include('layout/footer'); ?>

    <!-- Feather Init -->
    <script>
        feather.replace();
    </script>

    <!-- My Script -->
    <script src="/js/script.js"></script>

    <!-- SweetAlert2 -->
    <?php if (session()->getFlashdata('popup_error')): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Akses Dibatasi',
                text: '<?= esc(session('popup_error')) ?>',
                confirmButtonText: 'Oke',
                confirmButtonColor: '#d33',
                customClass: {
                    popup: 'swal-compact'
                }
            });
        </script>
        <style>
            .swal-compact {
                width: 300px !important;
                font-size: 14px;
            }
        </style>
    <?php endif ?>




</body>