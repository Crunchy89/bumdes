<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="<?= base_url() ?>assets/dist/js/demo.js"></script> -->
    <!-- page script -->
    <script>
        $(function() {
            $('#example1').DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
            });
        });
    </script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Notifications Dropdown Menu -->

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i> <?= $this->session->userdata('username') ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                        <a href="<?= site_url('member/logout') ?>" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= site_url('member') ?>" class="brand-link">
                <img src="<?= base_url() ?>assets/img/user.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?= $this->session->userdata('username') ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <?php if ($this->session->userdata('level') == 3) : ?>
                            <li class="nav-item">
                                <a href="<?= site_url('member') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Profile
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('member/pinjaman') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pinjaman</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('member/angsuran') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Angsuran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('member/simpanan') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Simpanan</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($this->session->userdata('level') == 2 || $this->session->userdata('level') == 1) : ?>
                            <li class="nav-item">
                                <a href="<?= site_url('admin') ?>" class="nav-link">
                                    <i class="fas fa-cog nav-icon"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('admin/anggota') ?>" class="nav-link">
                                    <i class="fas fa-cog nav-icon"></i>
                                    <p>Konfirmasi Anggota</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('admin/pegawai') ?>" class="nav-link">
                                    <i class="fas fa-cog nav-icon"></i>
                                    <p>Pegawai</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('admin/simpanan') ?>" class="nav-link">
                                    <i class="fas fa-cog nav-icon"></i>
                                    <p>Simpanan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('admin/pinjaman') ?>" class="nav-link">
                                    <i class="fas fa-cog nav-icon"></i>
                                    <p>Pinjaman</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('admin/angsuran') ?>" class="nav-link">
                                    <i class="fas fa-cog nav-icon"></i>
                                    <p>Angsuran</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($this->session->userdata('level') == 4 || $this->session->userdata('level') == 1) : ?>
                            <li class="nav-item">
                                <a href="<?= site_url('petugas') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        Simpanan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('petugas/penarikan') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        Penarikan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('petugas/pinjaman') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        Pinjaman
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('petugas/angsuran') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        Angsuran
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>

                        <li class="nav-header">Menu</li>
                        <li class="nav-item">
                            <a href="<?= site_url('member/logout') ?>" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><?= $page ?></h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <?= $view ?>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; Bumdes Pendem
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

</body>

</html>