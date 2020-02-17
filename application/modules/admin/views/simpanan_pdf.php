<!DOCTYPE html>
<html>

<head>
    <title>Report Table</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
</head>

<body>
    <h1 class="mt-3 mb-2 text-center">BUMDES PENDEM</h1>
    <h3 class="mt-1 mb-2 text-center">Data Simpanan Bumdes</h3>
    <div class="table-resposive mt-5">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Petugas</th>
                    <th>Tanggal Simpan</th>
                    <th>Jumlah</th>
                    <th>Ket</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $user->nama ?></td>
                        <td><?= $user->petugas ?></td>
                        <td><?= $user->tanggal_simpanan ?></td>
                        <td><?= $user->besar_simpanan ?></td>
                        <td><?= $user->ket ?></td>
                    </tr>
                    <?php $no++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>