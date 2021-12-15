<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <?= $heading ?>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>


                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?= ucfirst($user['nama']) ?> </span>
                        <img class="img-profile rounded-circle" src="<?= ($user['profile'] == null) ? base_url('assets/img/profile/default.png') : base_url('assets/img/profile/' . $user['profile'])  ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('pengguna/profile') ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>

        <!-- Begin Page Content -->
        <div class="container">
            <div class="wrapper bg-white">
                <form id="submit_p" enctype="multipart/form-data">
                    <div class="d-flex align-items-start py-3 border-bottom">
                        <img src="<?= ($user['profile'] == null) ? base_url('assets/img/profile/default.png') : base_url('assets/img/profile/' . $user['profile'])  ?>" class="img" alt="">
                        <div class="pl-sm-4 pl-2" id="img-section">
                            <label for="">Status akun</label>
                            <div class=" d-flex align-items-center">
                                <select type="text" class="bg-light form-control mr-3" id="status_pelapor" name="status_pelapor" placeholder="steve_@email.com">
                                    <option value="1" <?php echo ($user['active'] == '1' ? 'selected' : '') ?>>Aktif</option>
                                    <option value="0" <?php echo ($user['active'] == '0' ? 'selected' : '') ?>>Pending</option>
                                </select>
                                <button type="button" class="btn btn-success" id="simpanActive">Simpan</button>
                            </div>
                        </div>
                    </div>
                    <div class="py-2">
                        <div class="row py-2">
                            <div class="col-md-6">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="bg-light form-control" id="nama_p" name="nama_p" placeholder="Bambang" value="<?= $user['nama'] ?>" disabled>
                                <span class="error-nama_p error-dialog text-danger mt-2"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email Address</label>
                                <input type="text" class="bg-light form-control" id="email_pelapor" name="email_pelapor" placeholder="namamu_@email.com" value="<?= $user['email'] ?>" disabled>
                                <span class="error-email_p error-dialog text-danger mt-2"></span>
                            </div>

                        </div>
                        <div class="row py-2">
                            <div class="col-md-6 pt-md-0 pt-3">
                                <label for="phone">Nomor Telp.</label>
                                <input type="number" class="bg-light form-control" id="nomor_p" placeholder="08123xxxx" value="<?= $user['notelp'] ?>" disabled>
                                <span class="error-nomor_p error-dialog text-danger mt-2"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="jk">Jenis Kelamin</label>
                                <input type="text" class="bg-light form-control" id="jk_p" value="<?php echo $user['jk'] ?>" disabled>
                                <span class="error-jk_p error-dialog text-danger mt-2"></span>
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-md-6 pt-md-0 pt-3">
                                <label for="phone">Alamat.</label>
                                <textarea type="text" class="bg-light form-control" id="alamat_p" name="alamat_p" rows="5" cols="50" disabled><?= $user['alamat'] ?></textarea>
                                <span class="error-alamat_p error-dialog text-danger mt-2"></span>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col">
                                        <label for="ktp">E-KTP <?php echo ($user['img_ktp'] == null) ? '(kosong)' : '(terunggah) <i class="text-success fas fa-check-circle"></i>' ?></label><br>
                                        <a href="<?php echo ($user['img_kk'] == null) ? '#' : base_url('assets/img/ektp/' . $user['img_ktp']) ?>" class="btn btn-primary mr-2 <?php echo ($user['img_ktp'] == null) ? 'disabled' : '' ?>"><i class="fas fa-external-link-alt"></i> Lihat</a>
                                        <button class="btn btn-danger btn_hapus_ktp" type="button" <?php echo ($user['img_ktp'] == null) ? 'disabled' : 'id="' . $user['id_pelapor'] . '"' ?>><i class="fas fa-trash-alt"></i> Hapus</button>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col">
                                        <label for="ktp">Kartu Keluarga <?php echo ($user['img_kk'] == null) ? '(kosong)' : '(terunggah) <i class="text-success fas fa-check-circle"></i>' ?></label><br>
                                        <a href="<?php echo ($user['img_kk'] == null) ? '#' : base_url('assets/img/kk/' . $user['img_kk']) ?>" class="btn btn-primary mr-2 <?php echo ($user['img_kk'] == null) ? 'disabled' : '' ?>"><i class="fas fa-external-link-alt"></i> Lihat</a>
                                        <button class="btn btn-danger btn_hapus_kk" type="button" <?php echo ($user['img_kk'] == null) ? 'disabled' : 'id="' . $user['id_pelapor'] . '"' ?>><i class="fas fa-trash-alt"></i> Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row py-2">

                        </div>
                        <!-- <div class="py-3 pb-4 mt-3">
                            <button class="btn btn-success mr-3" type="submit" id="saveprofile">Simpan</button>
                            <button class="btn btn-secondary border button">Batal</button>
                        </div> -->

                        <!-- <div class="d-sm-flex align-items-center pt-3" id="deactivate">
                        <div> <b>Deactivate your account</b>
                            <p>Details about your company account and password</p>
                        </div>
                        <div class="ml-auto"> <button class="btn danger">Deactivate</button> </div>
                    </div> -->
                    </div>
                </form>
            </div>
        </div>

        <!-- /.container-fluid -->
        <div class="row justify-content-center">
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; SiLapor - Kalimantan Utara 2021</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>