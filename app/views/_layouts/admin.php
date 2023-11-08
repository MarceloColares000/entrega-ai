<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $titulo; ?></title>
    <link rel="stylesheet" type="text/css" href="<?= CSS ?>/sb-admin-2.min.css">
    <link rel="stylesheet" type="text/css" href="<?= CSS ?>/dataTables.bootstrap4.min.css">
</head>
<body>
    <?= $content; ?>
    
    <script src="<?= JS ?>/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!--JS do template-->
    <script src="<?= JS ?>/sb-admin-2.min.js"></script>
    <!-- JS da dataTables -->
    <script src="<?= JS ?>/jquery.dataTables.min.js"></script>
    <script src="<?= JS ?>/dataTables.bootstrap4.min.js"></script>
    <script src="<?= JS ?>/datatables-demo.js"></script>

    <script src="<?= JS ?>/functions.js"></script>
    <script src="<?= JS ?>/searchCep.js"></script>
    <script src="<?= JS ?>/hideAlert.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Font Awesome -->

    <script src="https://kit.fontawesome.com/c2eaecad4c.js"></script>
    <script src="<?= JS ?>/carrinho.js"></script>

</body>
</html>
