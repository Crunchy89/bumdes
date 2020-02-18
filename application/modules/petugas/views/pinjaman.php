<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>
<!-- <script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.mn.js') ?>"></script> -->
<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>
<div class="container-fluid">
    <?= $this->session->flashdata('pesan') ?>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Simpanan</h3>
            </div> <!-- /.card-body -->
            <div class="card-body">
                <form action="<?= site_url('petugas/pinjam_simpan') ?>" method="post">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <Label for="nik">NIK</Label>
                                    <input type="hidden" name="id" id="id">
                                    <input type="text" name="nik" id="nik" placeholder="NIK" class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <Label for="nama">Nama</Label>
                                    <input type="text" name="nama" id="nama" placeholder="Nama Anggota" class="autocomplete form-control form-control-sm" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <Label for="jk">JK</Label>
                                    <input type="text" name="jk" id="jk" placeholder="Jenis Kelamin" class="autocomplete form-control form-control-sm" disabled>
                                </div>
                                <div class="form-group">
                                    <Label for="noHp">No Hp</Label>
                                    <input type="text" name="noHp" id="noHp" placeholder="Jenis Kelamin" class="autocomplete form-control form-control-sm" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <Label for="alamat">Alamat</Label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="4" class="form-control" disabled></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="Petugas">Petugas</label>
                                <input type="hidden" name="id_petugas" id="id_petugas" value="<?= $this->session->userdata('id') ?>">
                                <input type="text" disabled class="form-control form-control-sm" value="<?= $this->session->userdata('username') ?>">
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="jumlah">Jumlah Pinjaman</label>
                                    <input type="text" name="jumlah" id="jumlah" class="form-control form-control-sm">
                                    <input type="hidden" id="simpanan" name="simpanan">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        </div>
                        <div class="table-responsive mt-5">
                            <table id="example1" class="table table-bordered table-sm">
                                <thead class="thead-dark">
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
                                        <th>Cetak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($pinjam as $row) : ?>
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
                                            <td><a href="<?= site_url('petugas/pinjaman_pdf/') . $row->id_anggota ?>" target="_BLANK" class="btn btn-info"><i class="fas fa-print"></i></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div><!-- /.card-body -->
        </div>
    </div><!-- /.container-fluid -->
</section>
<script type="text/javascript">
    var rupiah = document.getElementById('jumlah');
    rupiah.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp. ');
        var tes = rupiah.value;
        document.getElementById('simpanan').value = convertToAngka(tes);
    });

    function convertToAngka(rupiah) {
        return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
    }

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
    $(document).ready(function() {

        // Initialize 
        $("#nik").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= site_url('petugas/userList') ?>",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                $('#nik').val(ui.item.label); // display the selected text
                if (ui.item.jk == 'L') {
                    $('#jk').val("Laki - Laki"); // save selected id to input
                } else {
                    $('#jk').val("Perempuan"); // save selected id to input
                }
                $('#nama').val(ui.item.nama); // save selected id to input
                $('#id').val(ui.item.id); // save selected id to input
                $('#noHp').val(ui.item.noHp); // save selected id to input
                $('#alamat').val(ui.item.alamat); // save selected id to input
                $('#tempat').val(ui.item.tempat + ', ' + ui.item.lahir); // save selected id to input
                return false;
            }
        });

    });
</script>