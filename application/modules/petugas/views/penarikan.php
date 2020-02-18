<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>
<!-- <script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.mn.js') ?>"></script> -->
<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Penarikan</h3>
            </div> <!-- /.card-body -->
            <div class="card-body">
                <form action="<?= site_url('petugas/tarik') ?>" method="post">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <Label class="col-4" for="nik">NIK</Label>
                                    <div class="col-8">
                                        <input type="hidden" name="id" id="id">
                                        <input type="text" name="nik" id="nik" placeholder="NIK" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <Label class="col-4" for="nama">Nama</Label>
                                    <div class="col-8">
                                        <input type="text" name="nama" id="nama" placeholder="Nama Anggota" class="autocomplete form-control form-control-sm" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <Label class="col-4" for="saldo">Saldo</Label>
                                    <div class="col-8">
                                        <input type="text" name="saldo" id="saldo" placeholder="Saldo" class="autocomplete form-control form-control-sm" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <Label for="noHp" class="col-4">No Hp</Label>
                                    <div class="col-8">
                                        <input type="text" name="noHp" id="noHp" placeholder="No Handphone" class="autocomplete form-control form-control-sm" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="jumlah">Jumlah Penarikan</label>
                                    <input type="text" name="jumlah" id="jumlah" class="form-control form-control-sm">
                                    <input type="hidden" id="simpanan" name="simpanan">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="Petugas">Petugas</label>
                                    <input type="text" disabled class="form-control form-control-sm" value="<?= $this->session->userdata('username') ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group row">
                                    <label for="ket">Keterangan</label>
                                    <input type="text" class="form-control form-control-sm" name="ket" id="ket">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <a href="" class="btn btn-info">Cetak Laporan Bulanan</a>
                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        </div>
                        <div class="table-responsive mt-5">
                            <table id="example1" class="table table-bordered table-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Tanggal Tarik</th>
                                        <th>Total Penarikan</th>
                                        <th>Saldo</th>
                                        <th>Ket</th>
                                        <th>Cetak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($simpan as $row) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $row->nik ?></td>
                                            <td><?= $row->nama ?></td>
                                            <td><?= date('d-M-Y', strtotime($row->tanggal_penarikan)) ?></td>
                                            <?php $data = $this->db->get_where('simpanan', ['id_anggota' => $row->id])->result();
                                            $tarik = $this->db->get_where('penarikan', ['id_anggota' => $row->id])->result();
                                            $total = 0;
                                            $saldo = 0;
                                            foreach ($data as $sum) {
                                                $total += $sum->besar_simpanan;
                                            }
                                            foreach ($tarik as $sum) {
                                                $saldo += $sum->besar_penarikan;
                                            }
                                            $hasil = $total - (int) $saldo; ?>
                                            <td><?= rupiah($saldo) ?></td>
                                            <td><?= rupiah($hasil) ?></td>
                                            <td class="text-center"><?= $row->ket ?></td>
                                            <td><a href="<?= site_url('petugas/tarik_pdf/') . $row->id ?>" target="_BLANK" class="btn btn-info"><i class="fas fa-print"></i></a></td>
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
                    url: "<?= site_url('petugas/userTarik') ?>",
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
                $('#noHp').val(ui.item.noHp); // save selected id to input
                $('#saldo').val(formatRupiah(ui.item.saldo, 'Rp. ')); // save selected id to input
                return false;
            }
        });

    });
</script>