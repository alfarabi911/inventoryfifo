<?php
session_start();
include 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>INVENTORY - PT. INTI KAMPARINDO SEJAHTERA</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon-32x32.png" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->

	<style>
		h3 {
			background: linear-gradient(45deg, #ff0119, #00dcff);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			background-clip: text;
			color: transparent;
		}
	</style>
</head>

<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<span class="login100-form-title p-b-26">
					<img style="margin-top: -50px;" src='images/PT INTI.png' />
				</span>
				<form method="post" action="otentikasi.php">
					<form class="login100-form validate-form">
						<span class="login100-form-title p-b-26">
							<h3>Sistem Informasi Inventory</h3>
						</span>

						<?php if (isset($_GET['error'])) { ?>
							<?php if ($_GET['error'] == 1) { ?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">Mohon Maaf, Username atau Password Anda Salah
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<br>
							<?php } elseif ($_GET['error'] == 2) { ?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">Mohon Maaf, Akun Anda Tidak Ditemukan.
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div><br>
							<?php } elseif ($_GET['error'] == 3) { ?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">USERNAME DAN PASSWORD HARUS DI ISI !!
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div><br>
							<?php } ?>
						<?php } ?>
						<div class="wrap-input100 validate-input" data-validate="Username">
							<input class="input100" type="text" name="username">
							<span class="focus-input100" data-placeholder="Username"></span>
						</div>

						<div class="wrap-input100 validate-input" data-validate="Enter password">
							<span class="btn-show-pass">
								<i class="zmdi zmdi-eye"></i>
							</span>
							<input class="input100" type="password" name="password">
							<span class="focus-input100" data-placeholder="Password"></span>
						</div>

						<div class="container-login100-form-btn">
							<div class="wrap-login100-form-btn">
								<div class="login100-form-bgbtn"></div>
								<button class="login100-form-btn" type="submit" name="btln">Login</button>
							</div>
						</div>
					</form>
				</form>
			</div>
		</div>
	</div>

	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>