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
                            Data Pinjaman
                            <hr>
                            <div class="btn-group">
                                <div class="btn btn-info active">
                                    <span><i class="fa fa-print"></i></span>
                                </div>
                                <a href="<?= site_url('admin/pinjaman_pdf') ?>" target="_BLANK" type="button" class="btn btn-info">PDF</a>
                            </div>
                        </h3>
                    </div>



                    <div class="card-body pad table-responsive">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anggota</th>
                                        <th>Petugas</th>
                                        <th>Besar Pinjaman</th>
                                        <th>Jangka Waktu</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Pelunasan</th>
                                        <th>Bunga</th>
                                        <th>Total</th>
                                        <th>Perbulan</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($data as $row) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row->nama ?></td>
                                            <td><?= $row->username ?></td>
                                            <td><?= rupiah($row->besar_pinjaman) ?></td>
                                            <td>10 Bulan</td>
                                            <td><?= date('d-M-Y', strtotime($row->tgl_pinjaman)) ?></td>
                                            <td><?= date('d-M-Y', strtotime($row->tgl_pelunasan)) ?></td>
                                            <td>1.5 %</td>
                                            <td><?= rupiah($row->total_pinjaman) ?></td>
                                            <td><?= rupiah($row->total_pinjaman / 10) ?></td>
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