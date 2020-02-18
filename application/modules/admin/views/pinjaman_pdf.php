<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Report Table</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
</head>

<body>
    <h1 class="mt-3 mb-2 text-center">BUMDES PENDEM</h1>
    <h3 class="mt-1 mb-2 text-center">Data Pinjaman Bumdes</h3>
    <div class="table-resposive mt-5">
        <table class="table table-bordered table-sm">
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
                        <td><?= $row->petugas ?></td>
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
</body>
<script>
    window.print();
</script>

</html>