<?php
$this->username = !empty($_SESSION['profile']) ? $_SESSION['profile']['prenom'] : 'anonymous';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='description' content='vtc transport site'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>VTC TRANSPORT</title>
    <link rel='icon' href='<?= asset('Assets/img/logo.svg') ?>' type='image/x-icon'>
    <script type='text/javascript' src='<?= asset('Assets/lib/jquery-3.6.0.js') ?>'></script>
    <link rel="stylesheet" href="<?= asset('Assets/css/out/styles.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <!-- <link rel='stylesheet' href='<?= asset('Assets/css/styles_tailwind.css') ?>' type='text/css'> -->
    <!-- <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.12.1/css/all.css' crossorigin='anonymous'> -->
    <script>
    let jq = jQuery.noConflict();
    jq(document).ready(function() {
        profile_state();
    });

    function profile_state() {
        var username = '<?= $this->username ?>';
        if (username !== 'anonymous') {
            jq('header button#inscription').hide();
            jq('header button#connexion').hide();
            jq('header button#profile').show();
            jq('header button#deconnecter').show();
            jq('header').append('<h5>Bonjour ' + username + ' !</h5>');
        }
    }
    </script>
</head>

<body>