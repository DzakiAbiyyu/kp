<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- bootstrapt icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Raleway:wght@700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Playfair+Display:wght@700&display=swap"
        rel="stylesheet">


    <!-- My Style -->
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <?= $this->include('layout/navbar'); ?>

    <?= $this->renderSection('content'); ?>

    <?= $this->include('layout/footer'); ?>

    <!-- Feather Icons -->
    <script>
        feather.replace();
    </script>

    <!-- My Javascript -->
    <script src="/js/script.js"></script>
</body>

</html>