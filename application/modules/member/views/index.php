<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Profil Anggota
                        </h3>
                    </div>
                    <div class="card-body pad table-responsive">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>NIK</label>
                                        <input type="text" value="<?= $member->nik ?>" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" value="<?= $member->nama ?>" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <?php if ($member->jk == 'L') : ?>
                                            <input type="text" value="Laki - Laki" class="form-control" disabled>
                                        <?php else : ?>
                                            <input type="text" value="Perempuan" class="form-control" disabled>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Agama</label>
                                        <input type="text" value="<?= $member->agama ?>" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <input type="text" value="<?= $member->status ?>" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Pekerjaan</label>
                                        <input type="text" value="<?= $member->pekerjaan ?>" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <Textarea col="30" rows="5" class="form-control" disabled><?= $member->alamat ?></Textarea>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Tempat dan Tanggal lahir</label>
                                        <input type="text" value="<?= $member->tempat . ', ' . date('d - M - Y', strtotime($member->lahir)) ?>" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Hp</label>
                                        <input type="text" value="<?= $member->no_hp ?>" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <img src="<?= base_url('assets/img/anggota/') . $member->gambar ?>" class="img-thumbnail" alt="ktp" width="200px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>