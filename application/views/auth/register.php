<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Akun Baru</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/my-login.css') ?>">
	<link rel="shortcut icon" type="image/jpg" href="<?= base_url('assets/img/lambang.png') ?>" />
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="<?= base_url('assets/img/lambang.png') ?>" alt="logo">
					</div>
					<?= $this->session->flashdata('pesan');
					?>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Register</h4>
							<form action="<?= base_url('daftar') ?>" method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="name">Nama</label>
									<input id="nama-reg" type="text" class="form-control" name="nama-reg" value="<?php echo set_value('nama-reg') ?>" required autofocus>
									<?php echo form_error('nama-reg', '<div class="error-reg text-danger"><small>', '</small></div>') ?>
								</div>

								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email-reg" type="text" class="form-control" name="email-reg" value="<?php echo set_value('email-reg') ?>" required>
									<?php echo form_error('email-reg', '<div class="error-reg text-danger"><small>', '</small></div>') ?>
								</div>
								<div class="form-group">
									<label for="jk">Jenis Kelamin</label>
									<select id="jk-reg" type="text" class="form-control" name="jk-reg" required>
										<option selected value>Jenis Kelamin</option>
										<option value="Pria">Pria</option>
										<option value="Wanita">Wanita</option>
									</select>
									<?php echo form_error('jk-reg', '<div class="error-reg text-danger"><small>', '</small></div>') ?>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password-reg" type="password" class="form-control" name="password-reg" required data-eye>
									<?php echo form_error('password-reg', '<div class="error-reg text-danger"><small>', '</small></div>') ?>
								</div>
								<div class="form-group">
									<label for="password">Ulangi Password</label>
									<input id="repassword" type="password" class="form-control" name="repassword" required data-eye>
									<?php echo form_error('repassword', '<div class="error-reg text-danger"><small>', '</small></div>') ?>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block btn-regis">
										Register
									</button>
								</div>
								<div class="mt-4 text-center">
									Sudah punya akun? Masuk <a href="<?= base_url('/') ?>">disini</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2021 &mdash; SPKT Pakualaman
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="<?= base_url('assets/js/my-login.js') ?>"></script>
	<script src=<?= base_url('assets/js/pengguna.js') ?>></script>
</body>

</html>