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
	<link href=<?= base_url('assets/css/fileinput.min.css') ?> rel="stylesheet">
	<link href=<?= base_url('assets/css/sweetalert2.min.css') ?> rel="stylesheet">
	<link href=<?= base_url('assets/css/styles.css') ?> rel="stylesheet">
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-center h-100">
				<div class="col-md-8">
					<div class="brand">
						<img src="<?= base_url('assets/img/lambang.png') ?>" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Register</h4>
							<form id="submit_regis" enctype="multipart/form-data">
								<div class="row">
									<div class="col">
										<div class="row">
											<div class="col">
												<div class="form-group">
													<label for="name">Nama</label>
													<input id="nama-reg" type="text" class="form-control" name="nama-reg" value="<?php echo set_value('nama-reg') ?>" required autofocus>
													<span class="error-nama-reg error-dialog text-danger mt-2"></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<div class="form-group">
													<label for="email">E-Mail Address</label>
													<input id="email-reg" type="text" class="form-control" name="email-reg" value="<?php echo set_value('email-reg') ?>" required>
													<span class="error-email-reg error-dialog text-danger mt-2"></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<div class="form-group">
													<label for="jk">Jenis Kelamin</label>
													<select id="jk-reg" type="text" class="form-control" name="jk-reg" required>
														<option selected value>Jenis Kelamin</option>
														<option value="Pria">Pria</option>
														<option value="Wanita">Wanita</option>
													</select>
													<span class="error-jk-reg error-dialog text-danger mt-2"></span>
												</div>
											</div>
										</div>

									</div>
									<div class="col">
										<div class="row">
											<div class="col">
												<div class="form-group">
													<label for="password">Password</label>
													<input id="password-reg" type="password" class="form-control" name="password-reg" required>
													<span class="error-password-reg error-dialog text-danger mt-2"></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<div class="form-group">
													<label for="password">Ulangi Password</label>
													<input id="repassword" type="password" class="form-control" name="repassword" required>
													<span class="error-repassword error-dialog text-danger mt-2"></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<div class="form-group">
													<label for="ktp">E-KTP (pdf/png/jpg 1mb)</label>
													<input id="input-ktp" name="input-ktp" type="file" class="file input-ktp" data-show-preview="false">
													<span class="error-input-ktp error-dialog text-danger mt-2"></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<div class="form-group">
													<label for="ktp">Kartu Keluarga (pdf/png/jpg 1mb)</label>
													<input id="input-kk" name="input-kk" type="file" class="file input-kk" data-show-preview="false">
													<span class="error-input-kk error-dialog text-danger mt-2"></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group mt-3">
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

	<script src=<?= base_url('assets/vendor/jquery/jquery.min.js') ?>></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="<?= base_url('assets/js/my-login.js') ?>"></script>
	<script src=<?= base_url('assets/js/fileinput.min.js') ?>></script>
	<script src=<?= base_url('assets/js/sweetalert2.min.js') ?>></script>
	<script src=<?= base_url('assets/js/auth.js') ?>></script>
	<script>
		$('#input-kk').fileinput({
			"showRemove": false,
			"showUpload": false,
		})
		$('#input-ktp').fileinput({
			"showRemove": false,
			"showUpload": false,
		})
	</script>

</body>

</html>