<!DOCTYPE html>
<html>

<head>
    <title>Report Table</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
</head>

<body>
    <h1 class="mt-3 mb-2 text-center">BUMDES PENDEM</h1>
    <h3 class="mt-1 mb-2 text-center">Data Angsuran Bumdes</h3>
    <div class="table-resposive mt-5">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Setor</th>
                    <th>Nama Anggota</th>
                    <th>Petugas</th>
                    <th>Angsuran ke</th>
                    <th>Sisa Angsuran</th>
                    <th>ket</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($data as $row) : ?>
                    <tr>
                        <td><?= date('d - M - Y', $row->tgl_setor) ?></td>
                        <td><?= $row->nama ?></td>
                        <td><?= $row->username ?></td>
                        <td><?= $row->angsuran_ke ?></td>
                        <td><?= rupiah($row->sisa_angsuran) ?></td>
                        <td><?= $row->ket ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>