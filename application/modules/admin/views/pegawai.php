<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Data Pegawai
                            <hr>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">Tambah</button>
                        </h3>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= site_url('admin/pegawai_tambah') ?>" method="post">
                                    <div class="modal-body">
                                        <dif class="form-group">
                                            <label for="user">Username</label>
                                            <input type="text" name="user" id="user" class="form-control" placeholder="Username" required>
                                            <label for="pass">Password</label>
                                            <input type="password" name="pass" id="pass" class="form-control" placeholder="Password" required>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control" required>
                                                    <option value="">Pilih Status</option>
                                                    <?php foreach ($level as $lev) : ?>
                                                        <option value="<?= $lev->id_level ?>"><?= $lev->level ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </dif>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="card-body pad table-responsive">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Status</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($data as $row) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row->username ?></td>
                                            <td><?= $row->password ?></td>
                                            <td><?= $row->level ?></td>
                                            <td>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit<?= $row->id_user ?>"><i class="fas fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $row->id_user ?>"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="hapus<?= $row->id_user ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Pegawai</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= site_url('admin/pegawai_hapus') ?>" method="post">
                                                        <div class="modal-body">

                                                            <input type="hidden" name="id" id="id" value="<?= $row->id_user ?>">
                                                            <h3>Apakah Anda Yakin ?</h3>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary" name="hapus">Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="edit<?= $row->id_user ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Pegawai</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= site_url('admin/pegawai_edit') ?>" method="post">
                                                        <div class="modal-body">
                                                            <dif class="form-group">
                                                                <label for="user">Username</label>
                                                                <input type="hidden" name="id" id="id" value="<?= $row->id_user ?>">
                                                                <input type="text" name="user" id="user" class="form-control" placeholder="Username" value="<?= $row->username ?>" disabled>
                                                                <label for="pass">Password</label>
                                                                <input type="password" name="pass" id="pass" class="form-control" placeholder="Password" value="<?= $row->password ?>" required>
                                                                <div class="form-group">
                                                                    <label for="status">Status</label>
                                                                    <select name="status" id="status" class="form-control" required>
                                                                        <option value="<?= $row->id_level ?>"><?= $row->level ?></option>
                                                                        <?php foreach ($level as $lev) : ?>
                                                                            <option value="<?= $lev->id_level ?>"><?= $lev->level ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                            </dif>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary" name="edit">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>