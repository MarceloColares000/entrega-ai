<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Entrega aí | Serviço de entregas rápidas">
    <meta name="keywords" content="Entrega aí, entregas, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title; ?></title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?= CSS ?>/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?= CSS ?>/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?= CSS ?>/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?= CSS ?>/nice-select.css" type="text/css">
    <link rel="stylesheet" href="<?= CSS ?>/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="<?= CSS ?>/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?= CSS ?>/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?= CSS ?>/style.css" type="text/css">
    <link rel="stylesheet" href="<?= CSS ?>/reset.css" type="text/css">
    <link rel="stylesheet" href="<?= CSS ?>/aos.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <link rel="shortcut icon" href="<?= IMG ?>/icon-entrega-ai.png" />
</head>
<body id="page-top">

    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?= $content; ?>

    <!-- Js Plugins -->
    <script src="<?= JS ?>/jquery-3.3.1.min.js"></script>
    <script src="<?= JS ?>/bootstrap.min.js"></script>
    <script src="<?= JS ?>/jquery.nice-select.min.js"></script>
    <script src="<?= JS ?>/jquery-ui.min.js"></script>
    <script src="<?= JS ?>/jquery.slicknav.js"></script>
    <script src="<?= JS ?>/owl.carousel.min.js"></script>
    <script src="<?= JS ?>/main.js"></script>
    <script src="<?= JS ?>/aos.js"></script>
    <script src="<?= JS ?>/aos-init.js"></script>
    <script src="<?= JS ?>/hideAlert.js"></script>
    <script src="<?= JS ?>/functions.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiaVengxhyQnPmqPQERZmKBK0GVHoVsvE&callback=initMap" async defer></script>
    <!-- Font Awesome -->
    <script src="<?= JS ?>/fontAwesome.js"></script>
    <script src="https://kit.fontawesome.com/c2eaecad4c.js"></script>

</body>
</html>