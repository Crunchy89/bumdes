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
                            Data Angsuran
                        </h3>
                    </div>
                    <div class="card-body pad table-responsive">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Setor</th>
                                        <th>Petugas</th>
                                        <th>Angsuran ke</th>
                                        <th>Sisa Angsuran</th>
                                        <th>ket</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($member as $row) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= date('d - M - Y', strtotime($row->tgl_setor)) ?></td>
                                            <td><?= $row->petugas ?></td>
                                            <td><?= $row->angsuran_ke ?></td>
                                            <td><?= rupiah($row->besar_angsuran) ?></td>
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