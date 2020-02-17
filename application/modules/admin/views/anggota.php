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
                            Data Anggota
                            <hr>
                            <div class="btn-group">
                                <div class="btn btn-info active">
                                    <span><i class="fa fa-print"></i></span>
                                </div>
                                <a href="<?= site_url('admin/anggota_pdf') ?>" target="_BLANK" type="button" class="btn btn-info">PDF</a>
                            </div>
                        </h3>
                    </div>
                    <div class="card-body pad table-responsive">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>JK</th>
                                        <th>Agama</th>
                                        <th>Status</th>
                                        <th>Pekerjaan</th>
                                        <th>Alamat</th>
                                        <th>No Hp</th>
                                        <th>Tempat & Tanggal lahir</th>
                                        <th>Foto KTP</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($data as $row) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row->nik ?></td>
                                            <td><?= $row->nama ?></td>
                                            <td><?= $row->jk ?></td>
                                            <td><?= $row->agama ?></td>
                                            <td><?= $row->status ?></td>
                                            <td><?= $row->pekerjaan ?></td>
                                            <td><?= $row->alamat ?></td>
                                            <td><?= $row->no_hp ?></td>
                                            <td><?= $row->tempat . ', ' . date('d - M - Y', strtotime($row->lahir)) ?></td>
                                            <td><a href="" data-toggle="modal" data-target="#foto"><img src="<?= base_url('assets/img/anggota/') . $row->gambar ?>" class="img-thumbnail" alt="" width="50px"></a></td>
                                            <?php if ($row->confirm == 0) : ?>
                                                <td><a href="<?= site_url('admin/confirm/') . $row->id_anggota ?>" class="btn btn-primary">Konfirmasi</a></td>
                                            <?php else : ?>
                                                <td>Anggota</td>
                                            <?php endif; ?>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="foto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">KTP</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="<?= base_url('assets/img/anggota/') . $row->gambar ?>" class="img-fluid" alt="">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    </div>
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