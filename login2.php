<html>

<head>
	<title>ISKAWT</title>
	<link rel="stylesheet" href="CssLogin.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Averia+Serif+Libre&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&display=swap" rel="stylesheet">

</head>

<body>
	<?php
	require('db.php');
	session_start();
	$client_id = '0oa60kjaagGPGrvOP5d7 ';
	$client_secret = '3vx0kEBfHczZ5j8uP6QtSjVYs0dVvL82EYyOThgK';
	$redirect_url = 'http://localhost:8080/';
	$metadata_url = 'https://dev-34908155.okta.com/oauth2/default/.well-known/oauth-authorization-server';
	$metadata = ($metadata_url);

	if (isset($_POST['username'])) {
		$username = stripslashes($_REQUEST['username']);
		$username = mysqli_real_escape_string($conn, $username);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($conn, $password);
		$query = "SELECT * FROM `admin` WHERE username='$username' and password='$password'";
		$result = mysqli_query($conn, $query) or die();
		$rows = mysqli_num_rows($result);
		if ($rows == 1) {
			$_SESSION['username'] = $username;
			$_SESSION['user_id'] = $row->id;
			$_SESSION['email'] = $row->email;
			$is_admin = true;
			$user_id = $_SESSION['user_id'];
			$insert_query = "insert into loginattempt (user_id,is_admin)values ('$user_id','$is_admin')";
			mysqli_query($conn, $insert_query) or die();
			header("location: admin.php");
		} else {
			echo "<div class='form'>
				<h3>Username/password is incorrect.</h3>
				<br/>Go back to <a href='login2.php'>Login</a></div>";
		}
	} else {
	?>

		<div class="container-flex">
			<div class="row">
				<div class="col">
					<div class="header" style="font-family:Courier new">
						<a style="font-size: 35px;font-family: 'Averia Serif Libre', cursive;" href="#default" class="logo">
							ISKAWT
							<img alt="Logo" src="LoginImg\cctv.png" width="30" height="30">
						</a>
						<a style="font-size: 35px;font-family: 'Averia Serif Libre', cursive;" href="#default" class="logo">
							Admin Login


						</a>
						<div class="header-right">

							<a href="Roles.html">
								< Back</a>
						</div>
					</div>
				</div>
			</div>

			<div class="row ">
				<div class="col">
					<div class="forms">
						<div class="loginDiv">
							<form action="" method="post" name="login">

								<div class="form-control " style="padding:0px; border:none;">
									<input name="username" style="background-color:#78f4f0;" type="text" required />
									<label>Username</label>
								</div>

								<div class="form-control" style="padding: 0px;border: none;">
									<input type="password" name="password" style="background-color:#78f4f0;" type="text" required />
									<label>Password</label>
								</div>
								<input name="submit" type="submit" value="Login" style="font-family: 'Fredericka the Great', cursive;" class="btn-hover color-1" />

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

	<?php } ?>

	<script>
		const inputs = document.querySelectorAll('.form-control input');
		const labels = document.querySelectorAll('.form-control label');

		labels.forEach(label => {
			label.innerHTML = label.innerText
				.split('')
				.map((letter, idx) => `<span style="
						transition-delay: ${idx * 50}ms
					">${letter}</span>`)
				.join('');
		});
	</script>
</body>

</html>