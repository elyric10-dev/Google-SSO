<html>

<head>
	<title>ISKAWT</title>
	<link rel="stylesheet" href="CssLogin.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Averia+Serif+Libre&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&display=swap" rel="stylesheet">
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous" defer></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous" defer></script>
	<title>Login</title>
	<style>
		* {
			margin: 0;
			padding: 0;
			font-family: 'Open Sans', sans-serif;
		}

		.input {
			transition: border 0.2s ease-in-out;
			min-width: 280px
		}

		.input:focus+.label,
		.input:active+.label,
		.input.filled+.label {
			font-size: .75rem;
			transition: all 0.2s ease-out;
			top: -0.9rem;
			background-color: #fff;
			color: #1a73e8;
			padding: 0 5px 0 5px;
			margin: 0 5px 0 5px;
		}

		.label {
			transition: all 0.2s ease-out;
			top: 0.4rem;
			left: 0;
		}

		@import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');

		.signin_master_container {
			width: 100%;
			height: 100%;
			display: grid;
			place-items: center;
		}

		.signin_container {
			width: 250px;
			background-color: #4185F4;
			display: flex;
			align-items: center;
			padding: 2px 2px;
			cursor: pointer;
			border-radius: 5px;
			transition: 0.3s;
			box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.3);
		}

		.signin_container:hover {
			background-color: #4040FF;
		}

		img {
			width: 40px;
			height: 40px;
			border-top-left-radius: 4px;
			border-bottom-left-radius: 4px;
		}

		.link_container {
			width: 100%;
			text-align: center;
		}

		.link_container a {
			font-size: 16px;
			text-decoration: none;
			color: white;
			font-family: 'Open Sans', sans-serif;
		}
	</style>
</head>

<body>
	<?php
	require('db.php');
	session_start();
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
						User Login
					</a>
					<div class="header-right">
						<a href="Roles.html">
							< Back</a>
					</div>

					<?php
					//LOGIN USING USERNAME

					if (isset($_POST['username'])) {
						$username = stripslashes($_POST['username']);
						$username = mysqli_real_escape_string($conn, $username);
						$password = stripslashes($_POST['password']);
						$password = mysqli_real_escape_string($conn, $password);
						$query = "SELECT id FROM `user_accounts` WHERE username='$username'and password='$password'";
						$result = mysqli_query($conn, $query);
						if (mysqli_num_rows($result) > 0) {
							$row = $result->fetch_array();
							$_SESSION['user_id'] = $row['id'];
							$id = $_SESSION['user_id'];

							//FETCH ALL DATA WHERE ID = $ID
							$getEmail = "SELECT * FROM `user_accounts` WHERE id = '$id'";
							$getEmailQuery = mysqli_query($conn, $getEmail);
							$thisEmail = $getEmailQuery->fetch_array();
							$_SESSION['email'] = $thisEmail['email'];
							header('Location: userdash.php');
						} else {
							echo "<div class='relative w-full'>
					  		<div class='form absolute top-0 grid w-full place-items-center' >
								<h3 class='text-lg mt-4 text-red-500'>Username / Password is incorrect.</h3>
					  		</div>
					  		</div>";
						}
					}
					?>
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
							<input name="submit" type="submit" value="Login" style="font-family: 'Fredericka the Great', cursive; margin:2em;" class="btn-hover color-1" />
						</form>

						<!-- GOOGLE AUTHENTICATION -->
						<?php
						require_once 'config.php';

						if (isset($_SESSION['user_token'])) {
							header("Location: welcome.php");
						} else { ?>

							<div class="signin_master_container">
								<div class="signin_container">
									<img src="gsignin.png" alt="google_signin">
									<div class="link_container">
										<?php
										echo "<a href='" . $client->createAuthUrl() . "'>Sign in with Google</a>";
										?>
									</div>
								</div>
							<?php } ?>
							</div>
					</div>
				</div>
			</div>
		</div>


	</div>


	<?php  ?>
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