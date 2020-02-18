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
    <h3 class="mt-1 mb-2 text-center">Data Penarikan Bumdes</h3>
    <div class="table-resposive mt-5">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama Anggota</th>
                    <th>Petugas</th>
                    <th>Tanggal Tarik</th>
                    <th>Jumlah Penarikan</th>
                    <th>Ket</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $user->nik ?></td>
                        <td><?= $user->nama ?></td>
                        <td><?= $user->petugas ?></td>
                        <td><?= date('d-M-Y', strtotime($user->tanggal_penarikan)) ?></td>
                        <td><?= rupiah($user->besar_penarikan) ?></td>
                        <td><?= $user->ket ?></td>
                    </tr>
                    <?php $no++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    window.print();
</script>

</html>