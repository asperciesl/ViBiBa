<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= ucfirst($_SB->language_output('login', "ui")); ?> &middot; <?= $_SB->config()['name'] ?></title>

    <!-- Custom fonts for this template-->
    <link href="/assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/assets/sbadmin2/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

<div class="container">


    <?php
    /******
     * CONTENT
     */
    if (!empty($_APP['call'])) {
        require_once($_APP['call']);
    }
    ?>


</div>

<!-- Bootstrap core JavaScript-->
<script src="/assets/jquery/jquery.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/assets/jquery/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="/assets/sbadmin2/js/sb-admin-2.min.js"></script>
<?php
if(file_exists(__DIR__.'/welcome_modal.php') and $_SERVER['REQUEST_URI'] == '/app/login' and empty($_POST)){
    require_once (__DIR__.'/welcome_modal.php');
    ?>
    <script>
        $(document).ready(function () {
            $('#welcomeModal').modal('show')
        });
    </script>
    <?php
}
?>
</body>

</html>
