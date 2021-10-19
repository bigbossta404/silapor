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
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?= ucfirst($ses_akun['nama']) ?> </span>
                        <img class="img-profile rounded-circle" src="<?= ($ses_akun['profile'] == null) ? base_url('assets/img/profile/default.png') : base_url('assets/img/profile/' . $ses_akun['profile'])  ?>">
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
        <div class="container-fluid">
            <div class="wrapper bg-white">
                <div class="d-flex align-items-start py-3 border-bottom"> <img src="<?= base_url('assets/img/profile/default.png') ?>" class="img" alt="">
                    <div class="pl-sm-4 pl-2" id="img-section"> <b>Foto Profile</b>
                        <p>Jenis file wajib .png/jpg/jpeg dan dibawah 1MB</p> <input type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                </div>
                <div class="py-2">
                    <div class="row py-2">
                        <div class="col-md-6">
                            <label for="nama">Nama Depan</label>
                            <input type="text" class="bg-light form-control" placeholder="Bambang" value="<?= $ses_akun['nama'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="email">Email Address</label>
                            <input type="text" class="bg-light form-control" placeholder="namamu_@email.com" value="<?= $ses_akun['email'] ?>">
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-md-6 pt-md-0 pt-3">
                            <label for="phone">Nomor Telp.</label>
                            <input type="number" class="bg-light form-control" placeholder="08123xxxx" value="<?= $ses_akun['notelp'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="email">Jenis Kelamin</label>
                            <select type="text" class="bg-light form-control" placeholder="steve_@email.com">
                                <option value>Jenis Kelamin</option>
                                <option value="Pria" <?php echo ($ses_akun['jk'] == 'Pria' ? 'selected' : '') ?>>Pria</option>
                                <option value="Wanita" <?php echo ($ses_akun['jk'] == 'Wanita' ? 'selected' : '') ?>>Wanita</option>
                            </select>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-md-6 pt-md-0 pt-3">
                            <label for="phone">Alamat.</label>
                            <textarea type="text" class="bg-light form-control" placeholder="jl. indah RT 00 / RW 00"><?= $ses_akun['alamat'] ?></textarea>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-md-6">
                            <label for="ktp">E-KTP (pdf/png/jpg 1mb)</label>
                            <input id="input-ktp" name="input-b2" type="file" class="file input-ktp" data-show-preview="false">
                        </div>
                        <div class="col-md-6 pt-md-0 pt-3" id="lang">
                            <label for="ktp">Kartu Keluarga (pdf/png/jpg 1mb)</label>
                            <input id="input-kk" name="input-b2" type="file" class="file input-kk" data-show-preview="false">
                        </div>
                    </div>
                    <div class="py-3 pb-4 mt-3">
                        <button class="btn btn-success mr-3">Simpan</button> <button class="btn btn-secondary border button">Batal</button>
                    </div>
                    <!-- <div class="d-sm-flex align-items-center pt-3" id="deactivate">
                        <div> <b>Deactivate your account</b>
                            <p>Details about your company account and password</p>
                        </div>
                        <div class="ml-auto"> <button class="btn danger">Deactivate</button> </div>
                    </div> -->
                </div>
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