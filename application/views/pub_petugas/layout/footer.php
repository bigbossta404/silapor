</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin keluar akun?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Klik tombol keluar jika yakin.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Keluar</a>
            </div>
        </div>
    </div>
</div>

<!-- Berkas -->
<div class="modal fade" id="berkasModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Berkas</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row p-3 align-items-center">
                    <div class="col">
                        <table class="table w-100">
                            <tr class="table-info">
                                <th>Berkas</th>
                                <th>Jumlah</th>
                            </tr>
                            <tr>
                                <td>Penganiayaan</td>
                                <td><?= $jumberkas['aniaya'] ?></td>
                            </tr>
                            <tr>
                                <td>Izin</td>
                                <td><?= $jumberkas['izin'] ?></td>
                            </tr>
                            <tr>
                                <td>Kehilangan</td>
                                <td><?= $jumberkas['kehilangan'] ?></td>
                            </tr>
                            <tr>
                                <td>Ganti Kerugian</td>
                                <td><?= $jumberkas['rugi'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Keluar</button>
                <!-- <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Keluar</a> -->
            </div>
        </div>
    </div>
</div>

<!-- MODAL DIALOG -->

<div class="modal fade balaslaporan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="padding-right:0;">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update & Balas STTLP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="submit_balas" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row px-4">
                        <div class="col-md">
                            <div class="form-group">
                                <input type="text" name="id" value="<?= $dl['idsttlp'] ?>" id="idsttlp_req" hidden>
                                <select class="form-control" name="berkas" id="berkas">
                                    <option value disabled hidden selected>-- Pilih Berkas --</option>
                                    <?php foreach ($berkas as $br) : ?>
                                        <option value="<?= $br['id_berkas'] ?>" <?= ($dl['nberkas'] == $br['nama_berkas']) ? 'selected' : '' ?>><?= $br['nama_berkas']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="error-berkas error-dialog text-danger mt-2"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row px-4">
                        <div class="col-md">
                            <div class="form-group">
                                <select class="form-control" name="statusProses" id="statusProses">
                                    <option value disabled hidden selected>-- Pilih Proses STTLP --</option>
                                    <option value="ditolak" <?= ($dl['proses'] == 'ditolak') ? 'selected' : '' ?>>Tolak</option>
                                    <!-- <option value="terkirim" <?= ($dl['proses'] == 'terkirim') ? 'selected' : '' ?>><?= $br['nama_berkas']; ?></option> -->
                                    <option value="diterima" <?= ($dl['proses'] == 'diterima') ? 'selected' : '' ?>>Terima</option>
                                    <option value="proses" <?= ($dl['proses'] == 'proses') ? 'selected' : '' ?>>Proses Aduan</option>
                                    <option value="selesai" <?= ($dl['proses'] == 'selesai') ? 'selected' : '' ?>>Selesai</option>
                                </select>
                                <span class="error-statusProses error-dialog text-danger mt-2"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row px-4 upload-selesai" style="display: <?php echo ($dl['proses'] == 'selesai') ? 'block' : 'none;' ?> ">
                        <div class="col">
                            <div class="form-group">
                                <label for="uploaporan" class="d-flex align-items-center">Unggah Laporan Selesai (pdf) <?php echo ($cekfile) ?  '<i class="ml-1 text-success fas fa-check-circle"></i>' : '' ?></label>
                                <div class="d-flex">
                                    <a href="<?php echo ($cekfile) ?  base_url('assets/img/laporan/' . $dl['idsttlp'] . '.pdf') : '#' ?>" class="btn btn-success mr-3 btnLihatlap <?php echo ($cekfile) ?  '' : 'disabled' ?>">Lihat</a>
                                    <div dir=rtl>
                                        <input type="file" class="file is-valid" id="uploadlaporan" name="uploadlaporan" data-show-preview="false" title="<?php echo $dl['proses'] ?>" />
                                    </div>
                                </div>
                                <span class="error-uploadlap error-dialog text-danger mt-2"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row px-4">
                        <div class="col-xl">
                            <div class="form-group">
                                <textarea class="form-control" name="isibalasan" id="isibalasan" onkeyup="countChar(this)" rows="8" placeholder="Keterangan"><?= $dl['ket'] ?></textarea>
                                <div class="mt-2">
                                    <span class="error-isilap error-dialog text-danger"></span>
                                    <span><small class="float-right infotype"><span id="counttype"></span>/500</small></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="submitbalasan">Submit</button>
                    <!-- <button type="button" class="btn btn-primary" id="submitbalasan">Submit</button> -->
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade noticelap" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="padding-right:0;">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload E-KTP & KK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalkk">
                <div class="img-ktp d-flex justify-content-center">
                    <img src="<?php echo ($ses_akun['jk'] == 'Pria') ?  base_url('/assets/img/m-ktp.jpg') : base_url('/assets/img/f-ktp.jpg') ?>" width="300" alt="">
                </div>
                <div class="modal-text mt-4 d-flex justify-content-center">
                    <p>Anda belum melengkapi unggah <span class="bg-warning font-weight-bold text-dark pl-2 pr-2">E-KTP dan KK</span>, silahkan lengkapi dengan mengunjungi laman Profile atau klik <a href="<?= base_url('pengguna/profile') ?>">disini</a></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div> -->


<script src=<?= base_url('assets/js/jquery-3.5.1.min.js') ?>></script>
<script src=<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>></script>
<script src=<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src=<?= base_url('assets/js/sb-admin-2.min.js') ?>></script>
<script src=<?= base_url('assets/js/sweetalert2.min.js') ?>></script>
<script src=<?= base_url('assets/js/petugas.js') ?>></script>
<script src=<?= base_url('assets/js/fileinput.min.js') ?>></script>
<!-- <script src=<?= base_url('assets/vendor/chart.js/Chart.min.js') ?>></script> -->
<script src="<?= base_url('assets/datatables/js/jquery.dataTables.min.js') ?>"></script>
<script src=<?= base_url('assets/datatables/js/dataTables.bootstrap4.min.js') ?>></script>
<!-- <script src=<?= base_url('assets/js/demo/chart-area-demo.js') ?>></script>
<script src=<?= base_url('assets/js/demo/chart-pie-demo.js') ?>></script> -->
<script>
    $('#counttype').text(0)

    function countChar(val) {
        var len = val.value.length;
        if (len > 500) {
            val.value = val.value.substring(0, 500);
            $('.infotype').css('color', 'red');
        } else {
            $('.infotype').css('color', '#000');
            $('#counttype').text(len);
        }
    };
</script>
</body>

</html>