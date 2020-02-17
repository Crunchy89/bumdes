<!DOCTYPE html>
<html>

<head>
    <title>Report Table</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
</head>

<body>
    <h1 class="mt-3 mb-2 text-center">BUMDES PENDEM</h1>
    <h3 class="mt-1 mb-2 text-center">Data Anggota Bumdes</h3>
    <div class="table-resposive mt-5">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>JK</th>
                    <th>Agama</th>
                    <th>Status</th>
                    <th>Pekerjaan</th>
                    <th>Alamat</th>
                    <th>No Hp</th>
                    <th>TTL</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $user->nik; ?></td>
                        <td><?= $user->nama; ?></td>
                        <td><?= $user->jk; ?></td>
                        <td><?= $user->agama; ?></td>
                        <td><?= $user->status; ?></td>
                        <td><?= $user->pekerjaan; ?></td>
                        <td><?= $user->alamat; ?></td>
                        <td><?= $user->no_hp; ?></td>
                        <td><?= $user->tempat . ', ' . date('d M Y', strtotime($user->lahir)) ?></td>
                    </tr>
                    <?php $no++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>