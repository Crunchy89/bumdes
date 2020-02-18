<!DOCTYPE html>
<html>

<head>
    <title>Report Table</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
</head>

<body>
    <div class="form-group row mt-2 p-3">
        <div class="col-2">
            <img src="<?= base_url('assets/img/bumdes.png') ?>" alt="logo" width="200px">
        </div>
        <div class="col-8">
            <div class="form-group">
                <h1 class="text-center">BUMDES PENDEM</h1>
            </div>
            <div class="form-group">
                <h3 class="mt-1 mb-2 text-center">Struk Simpanan Anggota</h3>
            </div>
        </div>
        <div class="col-2">
        </div>
    </div>
    <hr>
    <?php
    function rupiah($angka)
    {

        $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }
    ?>
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Petugas</th>
                <th>Besar Pinjaman</th>
                <th>Jangka Waktu</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Pelunasan</th>
                <th>Bunga</th>
                <th>Total Pinjaman</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($data as $row) : ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $row->nik ?></td>
                    <td><?= $row->nama ?></td>
                    <td><?= $row->petugas ?></td>
                    <td><?= rupiah($row->besar_pinjaman) ?></td>
                    <td>10 Bulan</td>
                    <td><?= date('d-M-Y', strtotime($row->tgl_pinjaman)) ?></td>
                    <td><?= date('d-M-Y', strtotime($row->tgl_pelunasan)) ?></td>
                    <td>1.5 %</td>
                    <td><?= rupiah($row->total_pinjaman) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
<script>
    window.print();
</script>

</html>