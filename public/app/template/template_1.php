<?php
require_once(__DIR__ . '/../../lib/autoload.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/assets/img/favicon.ico">
    <title><?= $_SB->config()['name'] ?></title>
    <link href="/assets/custom/style.css" rel="stylesheet">
    <link href="/assets/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="/assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <link href="/assets/sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/app/dashboard">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-vial"></i>
            </div>
            <div class="sidebar-brand-text mx-3">ViBiBa <sup><?= $_SB->config()['version'] ?></sup></div>
        </a>

        <?php
        if (!empty($_APP)) {
            foreach ($_APP['navigation'] as $heading) {
                ?>
                <hr class="sidebar-divider my-0">
                <?php
                if (!empty($heading['name'])) {
                    ?>
                    <div class="sidebar-heading">
                        <?= $heading['name'] ?>
                    </div>
                    <?php
                }
                foreach ($heading['entries'] as $entry) {
                    if ($_SERVER['REQUEST_URI'] == $entry['uri']) {
                        $active = 'active';
                    } else {
                        $active = '';
                    }
                    ?>
                    <li class="nav-item <?= $active ?>">
                        <a class="nav-link" href="<?= $entry['uri'] ?>">
                            <i class="<?= $entry['icon'] ?>"></i>
                            <span><?= $entry['name'] ?></span></a>
                    </li>
                    <?php
                }
            }
        }
        ?>
        <?php if (empty($_SB->config()['jwt']['issuer']) or empty($_SB->config()['jwt']['aud']) or $_SB->config()['jwt']['logout'] != false){
            ?>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt"></i>
                    <span><?= ucwords($_SB->language_output('logout', "ui")) ?></span></a>
            </li>
            <?
        } ?>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                <?= $_SB->user->user_current()["user_salutation"] ?> <?= $_SB->user->user_current()["user_lastname"] ?>
                            </span>
                            <!--<img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">-->
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <?php
                display_alerts($_SB);
                /******
                 * CONTENT
                 */
                if (!empty($_APP['call'])) {
                    require_once($_APP['call']);
                }
                ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span><?= $_SB->config()['name'] ?> V. <?= $_SB->config()['version'] ?></span>
                    <br/>
                    <span><?= ucfirst($_SB->language_output('footer', "ui")) ?></span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="exampleModalLabel"><?= ucwords($_SB->language_output('logout', "ui")) ?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"><?= $_SB->language_output('logout_message', "ui") ?></div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button"
                        data-dismiss="modal"><?= ucwords($_SB->language_output('cancel', "ui")) ?></button>
                <a class="btn btn-primary"
                   href="<?= $_SB->config()['jwt']['logout'] ?? '/app/logout' ?>"><?= ucwords($_SB->language_output('logout', "ui")) ?></a>
            </div>
        </div>
    </div>
</div>
<script src="/assets/jquery/jquery.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/jquery/jquery.easing.min.js"></script>
<script src="/assets/sbadmin2/js/sb-admin-2.min.js"></script>
<script src="/assets/datatables/jquery.dataTables.js"></script>
<script src="/assets/datatables/dataTables.bootstrap4.js"></script>
<script>
    function sample_table_init(table, url) {
        table = $("#sample_table").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": url,
                "type": "POST"
            },
            "scrollX": true,
            "scrollY": "50vh",
            "initComplete": function () {
                table.columns.adjust().draw();
            },
            "deferRender": true,
            <?= $_SB->language_output("parameter_language", "sample_table") ?>
        });
        return (table);
    }
</script>
<?php
if (!empty($_FOOTER)) {
    foreach ($_FOOTER as $entry) {
        if ($entry['type'] == 'preset') {
            if ($entry['value'] == 'sample_table') {
                require_once(__DIR__ . '/footer_presets/sample_table.php');
            } elseif ($entry['value'] == 'button_bar') {
                require_once(__DIR__ . '/footer_presets/button_bar.php');
            } elseif ($entry['value'] == 'callback') {
                $_CALLBACK = $entry['args'];
                require_once(__DIR__ . '/footer_presets/callback.php');
            }
        }
    }
}
?>
</body>
</html>