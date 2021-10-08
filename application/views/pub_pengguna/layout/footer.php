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
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DIALOG -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="padding-right:0;">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Buat Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row px-4">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama" value="<?= $session['nama'] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="jenis">Jenis Aduan</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>Pilih Aduan</option>
                                <?php foreach ($jenisaduan as $jd) : ?>
                                    <option value="<?= $jd['id_berkas']; ?>"> <?= $jd['nama_berkas'] ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row px-4">
                    <div class="col-xl">
                        <div class="form-group">
                            <label for="subjek">Judul (Subjek)</label>
                            <input type="text" class="form-control" id="judul" placeholder="Judul Surat">
                        </div>
                    </div>
                </div>
                <div class="row px-4">
                    <div class="col-xl">
                        <div class="form-group">
                            <textarea class="form-control" id="exampleFormControlTextarea1" onkeyup="countChar(this)" rows="8" placeholder="Isi Surat"></textarea>
                            <div class="col mt-2">
                                <small class="float-right infotype"><span id="counttype"></span>/500</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row px-4">
                    <div class="col-xl">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Tambahkan bukti (Opsional)</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Kirim Surat</button>
            </div>
        </div>
    </div>
</div>


<script src=<?= base_url('assets/vendor/jquery/jquery.min.js') ?>></script>
<script src=<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>></script>
<script src=<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>></script>
<script src=<?= base_url('assets/js/sb-admin-2.min.js') ?>></script>
<script src=<?= base_url('assets/vendor/chart.js/Chart.min.js') ?>></script>

<script src=<?= base_url('assets/js/demo/chart-area-demo.js') ?>></script>
<script src=<?= base_url('assets/js/demo/chart-pie-demo.js') ?>></script>
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