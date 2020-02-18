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
                <h3 class="card-title">Angsuran</h3>
            </div> <!-- /.card-body -->
            <div class="card-body">
                <form action="<?= site_url('petugas/angsuran_simpan') ?>" method="post">
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
                                    <Label for="total">Total Pinjaman</Label>
                                    <input type="text" name="total" id="total" placeholder="Total pinjaman" class="autocomplete form-control form-control-sm" disabled>
                                </div>
                                <div class="form-group">
                                    <Label for="sisa">Sisa Angsuran</Label>
                                    <input type="text" name="sisa" id="sisa" placeholder="Sisa Angsuran" class="autocomplete form-control form-control-sm" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <Label for="bulan">Perbulan</Label>
                                    <input type="text" name="bulan" id="bulan" placeholder="Perbulan" class="autocomplete form-control form-control-sm" disabled>
                                </div>
                                <div class="form-group">
                                    <Label for="tgl">Jatuh tempo</Label>
                                    <input type="text" name="tgl" id="tgl" placeholder="Jatuh Tempo" class="autocomplete form-control form-control-sm" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="Petugas">Petugas</label>
                                <input type="hidden" name="id_petugas" id="id_petugas" value="<?= $this->session->userdata('id') ?>">
                                <input type="text" disabled class="form-control form-control-sm" value="<?= $this->session->userdata('username') ?>">
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="jumlah">Jumlah angsuran</label>
                                    <input type="text" name="jumlah" id="jumlah" class="form-control form-control-sm">
                                    <input type="hidden" id="simpanan" name="simpanan">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="ke">Angsuran Ke</label>
                                    <input type="text" name="ke" id="ke" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="ket">Ket</label>
                                    <input type="text" name="ket" id="ket" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <a href="<?= site_url('petugas/angsur_bulan') ?>" target="_BLANK" class="btn btn-info">Cetak Laporan Bulanan</a>
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
                                        <th>Tanggal Setor</th>
                                        <th>Sisa angsuran</th>
                                        <th>Ket</th>
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
                                            <td><?= date('d-M-Y', strtotime($row->tgl_setor)) ?></td>
                                            <?php
                                            $sisa = 0;
                                            $sum = $this->db->get_where('angsuran', ['id_pinjaman' => $row->pinjam])->result();
                                            foreach ($sum as $jum) {
                                                $sisa += $jum->besar_angsuran;
                                            }
                                            $total = $row->total_pinjaman;
                                            $sisa = $total - $sisa;
                                            ?>
                                            <td><?= rupiah((string) $sisa) ?></td>
                                            <td><?= $row->ket ?></td>
                                            <td><a href="<?= site_url('petugas/angsuran_pdf/') . $row->id_pinjaman ?>" target="_BLANK" class="btn btn-info"><i class="fas fa-print"></i></a></td>
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
                    url: "<?= site_url('petugas/userAngsur') ?>",
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
                $('#nama').val(ui.item.nama); // save selected id to input
                $('#id').val(ui.item.id); // save selected id to input
                $('#total').val(formatRupiah(ui.item.total, 'Rp. '));
                $('#bulan').val(formatRupiah(ui.item.bulan, 'Rp. ')); // save selected id to input
                $('#tgl').val(ui.item.tgl); // save selected id to input
                $('#sisa').val(formatRupiah(ui.item.sisa, 'Rp. ')); // save selected id to input
                return false;
            }
        });

    });
</script>