<?php
require('db.php');
session_start();


$email_S = $_SESSION['email'];
//FETCH GOOGLE ACCOUNT

$getEmail = "SELECT * FROM user_accounts WHERE email = '$email_S'";
$getEmailQuery = mysqli_query($conn, $getEmail);
$thisEmail = $getEmailQuery->fetch_array();



?>

<html>

<head>
	<title>ISKAWT</title>
	<link rel="stylesheet" href="CssAdmin.css">
	<link rel="stylesheet" href="CssAdmin1.css">
	<link rel="stylesheet" href="Security.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<style>
	body {
		font-family: Courier new;
	}

	.header {
		display: flex;
	}

	.profile_container {
		width: 100%;
		height: 100%;
		display: flex;
		justify-content: flex-end;
	}

	.profile_container img {
		width: 60px;
		height: 60px;
		margin: 1em;
		border-radius: 50%;
		border: 1px solid rgba(0, 0, 0, 0.5);
		box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
	}

	.iskawt-color {
		background-color: #78f4f0;
	}

	td {
		text-align: center;
		vertical-align: middle;
	}
</style>

<body onload="openCity(event, 'Users')">


	<div class="header">
		<a style="font-size:35px;" href="index.html" class="logo">
			ISKAWT
			<img alt="Logo" src="LoginImg\cctv.png" width="30" height="30">
		</a>

		<div class="profile_container">
			<img src="<?= $thisEmail['picture'] ?>" alt="" width="90px" height="90px">
		</div>
	</div>
	<br>
	<div id="usersTab">
		<div class="tab">
			<a href="userdash.php"><button class="tablinks" onclick="openCity(event, 'Users')">Profile information</button></a>
			<a href="user_application.php"><button>Application</button></a>
			<button onclick="javascript:closeOnLoad('https://accounts.google.com/logout');">Logout</button>
		</div>

		<div id="Users" class="tabcontent">
			<div class="container">
				<div class="table-responsive">
					<div class="table-wrapper">
						<div class="table-title iskawt-color">
							<div class="row">
								<div class="container" style="overflow:Scroll;">
									<h1 style="color:black; font-size:35px;"><b>User Application</h1>
									<hr>
									<div id='apps'>
										<style>
											.apps_master_container {
												/* background-color: rgba(150, 255, 150); */
												display: flex;
												flex-wrap: wrap;
												justify-content: start;
												width: 100%;
											}



											.apps_container {
												text-align: center;
												margin: 20px;
												background-color: #ffffff;
												border: 1px solid #f0f0f0;
												border-radius: 10px;
												cursor: pointer;
												transition: 0.2s;
												width: 150px;
												height: 150px;
												text-decoration: none;
											}

											.apps_container:hover {
												background-color: #BCFAF8;
												border: 1px solid #252525;
											}

											.app_icon {
												width: 100px;
												height: 100px;
												margin: 10px;
											}

											.app_title {
												color: #252525;
												font-size: 14px;
												transition: 0.2s;
											}

											.apps_container:hover>.app_title {
												color: black;
												font-size: 16px;
											}
										</style>
										<!-- USER APPLICATION -->
										<div class="apps_master_container">
											<!-- ALLOWED USER APPS BY ADMIN -->

										</div>
										<script onload="apps();">
											function apps() {
												const xhttp = new XMLHttpRequest();
												xhttp.onload = function() {
													document.getElementById('apps').innerHTML = this.responseText;
												}
												xhttp.open("GET", "applications.php");
												xhttp.send();
											}

											setInterval(function() {
												apps();
											}, 1000);
										</script>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<br>

</body>



<script src="goutlog.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
		// Activate tooltip
		$('[data-toggle="tooltip"]').tooltip();

		// Select/Deselect checkboxes
		var checkbox = $('table tbody input[type="checkbox"]');
		$("#selectAll").click(function() {
			if (this.checked) {
				checkbox.each(function() {
					this.checked = true;
				});
			} else {
				checkbox.each(function() {
					this.checked = false;
				});
			}
		});
		checkbox.click(function() {
			if (!this.checked) {
				$("#selectAll").prop("checked", false);
			}
		});
	});
</script>
<script>
	function openCity(evt, cityName) {
		// Declare all variables
		var i, tabcontent, tablinks;

		// Get all elements with class="tabcontent" and hide them
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}

		// Get all elements with class="tablinks" and remove the class "active"
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		}

		// Show the current tab, and add an "active" class to the link that opened the tab
		document.getElementById(cityName).style.display = "block";
		evt.currentTarget.className += " active";
	}
</script>

</html>