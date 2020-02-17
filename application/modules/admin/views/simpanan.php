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
                            Data Simpanan
                            <hr>
                            <div class="btn-group">
                                <div class="btn btn-info active">
                                    <span><i class="fa fa-print"></i></span>
                                </div>
                                <a href="<?= site_url('admin/simpanan_pdf') ?>" target="_BLANK" type="button" class="btn btn-info">PDF</a>
                            </div>
                        </h3>
                    </div>



                    <div class="card-body pad table-responsive">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Anggota</th>
                                        <th>Petugas</th>
                                        <th>Tanggal Simpan</th>
                                        <th>Besar Simpanan</th>
                                        <th>Ket</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($data as $row) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row->nama ?></td>
                                            <td><?= $row->username ?></td>
                                            <td><?= date('d - M - Y', strtotime($row->tanggal_simpanan)) ?></td>
                                            <td><?= rupiah($row->besar_simpanan) ?></td>
                                            <td><?= $row->ket ?></td>
                                        </tr>
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