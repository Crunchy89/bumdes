<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> BUMDES DESA PENDEM </title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
    <script src="<?= base_url() ?>assets/vue.min.js"></script>
    <script src="<?= base_url() ?>assets/axios.min.js"></script>
</head>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <a class="navbar-brand" href="#">BUMDES DESA PENDEM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>
                <div class="form-inline my-2 my-lg-0">
                    <ul class="navbar-nav p-1">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tentang</a>
                        </li>
                        <li class="nav-item p-1">
                            <button class="btn btn-success" type="button" name="login" data-toggle="modal" data-target="#login">Login</button>
                        </li>
                        <li class="nav-item p-1">
                            <button class="btn btn-primary" type="button" name="login" data-toggle="modal" data-target=".bd-example-modal-xl">Daftar</button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <!-- modal Login -->
        <div class="modal fade" id="login" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Form Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= site_url('home/login') ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="user">Username</label>
                                <input type="text" name="user" id="user" class="form-control" placeholder="Username" required>
                                <label for="pass">Password</label>
                                <input type="password" name="pass" id="pass" class="form-control" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" required>Tutup</button>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-1">
            <?= $this->session->flashdata('pesan'); ?>
        </div>

        <!-- modal daftar -->
        <div class="modal fade bd-example-modal-xl" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Form Daftar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <section class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary card-outline">
                                    <div class="card-body pad table-responsive">
                                        <form action="<?= site_url('home/daftar') ?>" method="POST" enctype="multipart/form-data">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="nik">NIK</label>
                                                            <input type="text" name="nik" id="nik" class="form-control" placeholder="Nomor Induk Kependudukan" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama">Nama Lengkap</label>
                                                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jk">Jenis Kelamin</label>
                                                            <select name="jk" id="jk" class="form-control" required>
                                                                <option value="L">Laki-laki</option>
                                                                <option value="P">Perempuan</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tempat">Tempat dan Tanggal Lahir</label>
                                                            <div class="form-group row">
                                                                <div class="col-6">
                                                                    <input type="text" name="tempat" id="tempat" class="form-control" placeholder="Tempat" required>
                                                                </div>
                                                                <div class="col-6">
                                                                    <input type="date" name="lahir" id="lahir" class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="agama">Agama</label>
                                                            <input type="text" name="agama" id="agama" class="form-control" placeholder="Agama">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status">Status</label>
                                                            <select name="status" id="status" class="form-control" required>
                                                                <option value="Kawin">Kawin</option>
                                                                <option value="Belum Kawin">Belum Kawin</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="alamat">Alamat</label>
                                                            <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="1" class="form-control" placeholder="Alamat Lengkap" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pekerjaan">Pekerjaan</label>
                                                            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" placeholder="Pekerjaan">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="no_hp">No Hp</label>
                                                            <input type="number" name="no_hp" id="no_id" class="form-control" placeholder="No Handphone" required>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="user">Username</label>
                                                                    <input type="password" name="user" id="user" class="form-control" placeholder="Username" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="pass">Password</label>
                                                                    <input type="text" name="pass" id="pass" class="form-control" placeholder="Username" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="gambar"><img class="img-fluid" src="<?= base_url() ?>assets/img/noimage.png" id="output" width="75px"></label>
                                                        </div>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" accept="image/*" onchange="loadFile(event)" id="gambar" name="gambar">
                                                                <label class="custom-file-label" for="exampleInputFile">Upload KTP</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Daftar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <?= $view ?>


        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <a class="navbar-brand" href="#"><strong>Copyright &copy; BUMDES DESA PENDEM</strong></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>
                <div class="form-inline my-2 my-lg-0">
                    <div class="float-right d-none d-sm-inline-block">
                        <a href="#" class="btn btn-secondary"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-secondary"><i class="fab fa-fw fa-instagram"></i></a>
                        <a href="#" class="btn btn-secondary"><i class="fab fa-fw fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    </div>
</body>

</html>