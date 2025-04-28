<?php
$this->username = !empty($_SESSION['profile']) ? $_SESSION['profile']['prenom'] : 'anonymous';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='description' content='vtc transport site'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>TAWSSIL-DZ</title>
    <link rel='icon' href='<?= asset('Assets/img/logo.svg') ?>' type='image/x-icon'>
    <link rel="stylesheet" href="<?= asset('Assets/css/out/styles.css') ?>">
    <script type='text/javascript' src='<?= asset('Assets/lib/jquery-3.6.0.js') ?>'></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Dynamically include page-specific scripts -->
    <?php if (!empty($pageScripts)): ?>
        <?php foreach ($pageScripts as $script): ?>
            <script type="text/javascript" src="<?= asset($script) ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</head>

<body>