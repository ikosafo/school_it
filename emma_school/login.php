<?php

include('dbcon.php');


if(isset($_GET['action'])){

	unset($_SESSION['username']);
	unset($_SESSION['name']);
	unset($_SESSION['permission']);
	unset($_SESSION['pass']);

	//header("Location:../");
}
?>
<!DOCTYPE html>
<html lang="en">


<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<title>School Management System | TESHIE ST. JOHN SCHOOLS </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">

	<link rel="stylesheet" href="assets/css/sweetalert.css" />
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('login/images/img-01.jpg');">
			<div class="wrap-login100 p-t-11 p-b-30">

				<form class="login100-form validate-form" role="form" method="post"
					  enctype="multipart/form-data" name="form1" id="form1" action="" autocomplete="off">
					<div class="login100-form-avatar">
						<img src="login/images/logo.png" alt="School Logo"">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						TESHIE ST. JOHN SCHOOLS
					</span>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
						<input class="input100" type="text" name="username" id="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" id="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="admin_check" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1" style="color: #ffffff;font-weight: 600">
							Login as admin
						</label>
					</div>


					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn" id="login_btn">
							Login
						</button>
					</div>


				</form>
			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/bootstrap/js/popper.js"></script>
	<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/select2/select2.min.js"></script>

	<script src="assets/js/sweetalert.js"></script>
<!--===============================================================================================-->
	<script src="login/js/main.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-23581568-13');
	</script>

	<script type="text/javascript">
		$(document).ready(function () {



			$('#login_btn').click(function () {

				var username = $('#username').val();
				var password = $('#password').val();


				var error = '';


				if (username == "") {
					error += 'Please enter username \n';
					document.form1.username.focus();
				}

				if (password == "") {
					error += 'Please enter password \n';
					document.form1.password.focus();
				}


				if (error == "") {


					if ($("#admin_check").is(":checked")) {

						$.ajax({
							type: "POST",
							url: "ajax/loginaction_admin.php",
							data: {
								username: username,
								password: password


							},
							success: function (text) {

							    alert(text);

								if (text == 1) {

									window.location.href="index_ad.php";

								}

								else {
									swal("Wrong username or password", "", "error");
								}


							},
							error: function (xhr, ajaxOptions, thrownError) {
								alert(xhr.status + " " + thrownError);
							},

						});


					}

else{

						$.ajax({
							type: "POST",
							url: "ajax/loginaction.php",
							data: {
								username: username,
								password: password

							},
							success: function (text) {


                                         alert(text);

								if (text == 1) {

									window.location.href="index_ad.php";


								}

								else {
									swal("Wrong username or password", "", "error");
								}


							},
							error: function (xhr, ajaxOptions, thrownError) {
								alert(xhr.status + " " + thrownError);
							},

						});


					}



				}
				else {

					$('#error_loc').notify(error);


				}
				return false;
			});



		});


	</script>
</body>

<!-- Mirrored from colorlib.com/etc/lf/Login_v12/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Apr 2018 07:23:35 GMT -->
</html>
