<?php

require('db.php');
include("auth.php");
$status = "";
if (isset($_POST['new']) && $_POST['new'] == 1) {

	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$mobilenumber = $_POST['mobile_number'];
	$username = $_POST['username'];
	$submittedby = $_SESSION["username"];

	$insert_query = "insert into new_record
    (name,email,password,mobilenumber,username,submittedby)values
    ('$name','$email','$password','$mobilenumber','$username','$submittedby')";
	mysqli_query($conn, $insert_query) or die();
	$status = "New user inserted successfully.";

	if (isset($_GET["delete"])) {
		$mysqli->query("Delete FROM data WHERE id=$id") or die();
	}
}

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
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
	<script src="goutlog.js" defer></script>

</head>
<style>
	body {
		font-family: Courier new;
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
			<img alt="Logo" src="LoginImg\Logo.png" width="30" height="30">
		</a>

	</div>
	<br>
	<div id="usersTab">
		<div class="tab">
			<button class="tablinks" onclick="openCity(event, 'Users')">Users</button>
			<button class="tablinks" onclick="openCity(event, 'Security')">Security</button>
			<button class="tablinks" onclick="openCity(event, 'Application')">Application</button>
			<button onclick="javascript:closeOnLoad('https://accounts.google.com/logout');">Logout</button>
		</div>

		<div id="Users" class="tabcontent">
			<div class="container">
				<div class="table-responsive">
					<!-- <div class="alertMessage w-96 h-20 bg-green-100 grid place-items-center mb-5 border-l-8 border-green-600">
						<p class="text-green-700 font-bold text-center">
							<?php
							// echo $_SESSION['allowed_message']; 
							?>
						</p>
						<script>
							const alertMessage = document.querySelector('.alertMessage')
							setTimeout(() => {
								alertMessage.style.display = "none"
							}, 2000);
						</script>
					</div> -->
					<div class="table-wrapper">
						<div class="table-title iskawt-color">
							<div class="row">
								<div class="col-xs-6">
									<h2 style="color: black;"> ISKAWT (Users)</h2>
								</div>
								<div class="col-xs-6">
									<a href="#addUserModal" style="background-color:#54ab93;" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add User</span></a>

								</div>
							</div>
						</div>

						<?php
						// connect to the database
						include('connect-db.php');


						// get the records from the database
						if ($result = $mysqli->query("SELECT * FROM user_accounts ORDER BY id")) {
							// display records if there are records to display
							if ($result->num_rows > 0) {
								// display records in a table
								echo "<table class='table table-striped table-hover' border='1' cellpadding='10'>";

								// set table headers
								echo "<tr><th>Username</th><th>Name</th><th>Email</th><th>Mobile number</th><th>Date</th><th></th><th></th></tr>";
								while ($row = $result->fetch_object()) {
									// set up a row for each record
									echo "<tr>";
									echo "<td>" . $row->username  . "</td>";
									echo "<td>" . $row->fullname  . "</td>";
									echo "<td>" . $row->email  . "</td>";
									echo "<td>" . $row->mobilenumber  . "</td>";
									echo "<td>" . $row->date_created  . "</td>";
									echo "<td><a href='admin_edit.php?id=" . $row->id . "'><center><i class='glyphicon glyphicon-pencil'></i></center></a></td>";
									echo "<td><a href='delete.php?id=" . $row->id . "'><center><i class='glyphicon glyphicon-trash'></i></center></a></td>";
									echo "</tr>";
								}
								echo "</table>";
							}
							// if there are no records in the database, display an alert message
							else {
								echo "No users yet.";
							}
						}
						// show an error if there is an issue with the database query
						else {
							echo "Error: " . $mysqli->error;
						}

						// close database connection
						$mysqli->close();

						?>





					</div>
				</div>
			</div>
			<!-- Add Modal HTML -->
			<div id="addUserModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<form name="form" method="post" action="">
							<input type="hidden" name="new" value="1" />
							<div class="modal-header">
								<h4 class="modal-title">Add Employee</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label>Name</label>
									<input id="name" name="name" type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Username</label>
									<input id="username" name="username" type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input id="email" name="email" type="email" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Phone</label>
									<input id="mobile_number" name="mobile_number" type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input id="password" name="password" type="password" class="form-control" required />
								</div>
							</div>
							<div class="modal-footer">
								<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
								<input type="submit" name="submit" class="btn btn-success" value="Submit">
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Edit Modal HTML -->
			<div id="editUserModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<form>
							<div class="modal-header">
								<h4 class="modal-title">Edit User</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label>Name</label>
									<input type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Address</label>
									<textarea class="form-control" required></textarea>
								</div>
								<div class="form-group">
									<label>Phone</label>
									<input type="text" class="form-control" required>
								</div>
							</div>
							<div class="modal-footer">
								<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
								<input type="submit" class="btn btn-info" value="Save">
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Delete Modal HTML 
	<div id="deleteUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete">
					</div>
				</form>
			</div>
		</div>
	</div>
-->
		</div>

		<div id="Security" class="tabcontent">

			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

			<div class="container" style="overflow:Scroll;">
				<div class="row justify-content-center">
					<div class="col-12 col-lg-10 col-xl-8 mx-auto">
						<h2 class="h3 mb-4 page-title">Settings</h2>
						<div class="my-4">
							<ul class="nav nav-tabs mb-4" id="myTab" role="tablist">

							</ul>
							<h1 class="mb-0 mt-5">Security Settings</h1>
							<p>These settings helps you keep your account secure.</p>
							<div class="list-group mb-5 shadow">
								<div class="list-group-item">
									<div class="row align-items-center">
										<div class="col">
											<strong class="mb-2">Enable Activity Logs</strong>
											<p class="text-muted mb-0">Activate to view activity logs.</p>
										</div>
										<div class="col-auto">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" id="activityLog" checked="">
												<span class="custom-control-label"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="list-group-item">
									<div class="row align-items-center">
										<div class="col">
											<strong class="mb-2">2FA Authentication</strong>
											<span class="badge badge-pill badge-success">Enabled</span>
											<p class="text-muted mb-0">Activate 2 Factor Authentication </p>
										</div>
										<div class="col-auto">
											<button class="btn btn-primary btn-sm">Disable</button>
										</div>
									</div>
								</div>
								<div class="list-group-item">
									<div class="row align-items-center">
										<div class="col">
											<strong class="mb-2">Activate Pin Code</strong>
											<p class="text-muted mb-0">Activate to add another security feature </p>
										</div>
										<div class="col-auto">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" id="pinCode">
												<span class="custom-control-label"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<h5 class="mb-0">Recent Activity</h5>
							<p>Last activities with your account.</p>
							<?php
							// connect to the database
							include('connect-db.php');

							// get the records from the database
							if ($result = $mysqli->query("SELECT * FROM loginattempt ORDER BY id")) {
								// display records if there are records to display
								if ($result->num_rows > 0) {
									// display records in a table
									echo "<table class='table table-striped table-hover' border='1' cellpadding='10'>";

									// set table headers
									echo "<tr><th>User type</th><th>timestamp</th></tr>";
									while ($row = $result->fetch_object()) {
										// set up a row for each record
										echo "<tr>";
										echo "<td>";
										if ($row->is_admin  = 1) {
											echo "admin";
										} else {
											echo "User";
										}
										"</td>";
										echo "<td>" . $row->timestamp . "</td>";
										echo "</tr>";
									}
									echo "</table>";
								}
								// if there are no records in the database, display an alert message
								else {
									echo "No users yet.";
								}
							}
							// show an error if there is an issue with the database query
							else {
								echo "Error: " . $mysqli->error;
							}

							// close database connection
							$mysqli->close();

							?>

						</div>
					</div>
				</div>
			</div>


		</div>

		<div id="Application" class="tabcontent">
			<div class="container">
				<div class="table-responsive">
					<div class="table-wrapper">
						<div class="table-title iskawt-color">
							<div class="row">
								<div class="container" style="overflow:Scroll;">
									<h1 style="color:black; font-size:35px;"><b>User Application</h1>

									<hr>
									<div class="">
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
												display: grid;
												align-items: center;
												justify-content: center;
											}

											.apps_container:hover {
												background-color: #BCFAF8;
												border: 1px solid #252525;
											}



											.app_icon {
												width: 80px;
												height: 80px;
												margin: 10px;
												transition: 0.3s;
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

											input[type="checkbox"] {
												display: none;
											}

											input[type="checkbox"]:checked~.apps_container {
												background-color: #BCFAF8;
												border: 1px solid rgba(37, 37, 37, 0.4);
											}

											input[type="checkbox"]:checked:hover~.apps_container {
												border: 1px solid rgba(37, 37, 37, 1);
											}
										</style>
										<!-- USER APPLICATION -->

										<form action="allowedTo.php" method="post" id="form1">
											<div class="apps_master_container">
												<input type="email" name="email" id="email" class="h-10 w-96 absolute mr-5 right-0 top-3 bg-gray-100 border border-black rounded p-2 text-gray-500" placeholder="Email" required onchange="showButton()">
												<label class="app">
													<input type="checkbox" name="app[]" id="app" value="1">

													<div class="apps_container">
														<img src="appLogo/gmail.png" alt="gmail" class="app_icon">

														<div class="app_title">Gmail</div>
													</div>
												</label>
												<label class="app">
													<input type="checkbox" name="app[]" id="app" value="2">
													<div class="apps_container">
														<img src="appLogo/gdrive.png" alt="gmail" class="app_icon">
														<div class="app_title">Drive</div>
													</div>
												</label>

												<label class="app">
													<input type="checkbox" name="app[]" id="app" value="3">
													<div class="apps_container">
														<img src="appLogo/gforms.png" alt="gmail" class="app_icon">
														<div class="app_title">Forms</div>
													</div>
												</label>
												<label class="app">
													<input type="checkbox" name="app[]" id="app" value="4">
													<div class="apps_container">
														<img src="appLogo/ghangouts.png" alt="gmail" class="app_icon">
														<div class="app_title">Hangouts</div>
													</div>
												</label>
												<label class="app">
													<input type="checkbox" name="app[]" id="app" value="5">
													<div class="apps_container">
														<img src="appLogo/gdocs.png" alt="gmail" class="app_icon">
														<div class="app_title">Documents</div>
													</div>
												</label>
												<label class="app">
													<input type="checkbox" name="app[]" id="app" value="6">
													<div class="apps_container">
														<img src="appLogo/gsheets.png" alt="gmail" class="app_icon">
														<div class="app_title">Spreadsheet</div>
													</div>
												</label>
												<label class="app">
													<input type="checkbox" name="app[]" id="app" value="7">
													<div class="apps_container">
														<img src="appLogo/gslides.png" alt="gmail" class="app_icon">
														<div class="app_title">Presentation</div>
													</div>
												</label>
												<label class="app">
													<input type="checkbox" name="app[]" id="app" value="8">
													<div class="apps_container">
														<img src="appLogo/gclassroom.png" alt="gmail" class="app_icon">
														<div class="app_title">Classroom</div>
													</div>
												</label>
												<label class="app">
													<input type="checkbox" name="app[]" id="app" value="9">
													<div class="apps_container">
														<img src="appLogo/gmeet.png" alt="gmail" class="app_icon">
														<div class="app_title">Meet</div>
													</div>
												</label>
												<label class="app">
													<input type="checkbox" name="app[]" id="app" value="10">
													<div class="apps_container">
														<img src="appLogo/gcalendar.png" alt="gmail" class="app_icon">
														<div class="app_title">Calendar</div>
													</div>
												</label>


												<div class="actionButton w-full flex justify-center">
													<button type="submit" name="submit_multiple" class="allowUser bg-blue-400 px-6 py-2 rounded">Allow Apps</button>
												</div>
												<div class=" w-full flex justify-center">
													<button type="submit" name="submit_remove" class="removeUser bg-red-400 px-6 py-2 rounded m-3" onclick="submitForm('removeTo.php')">Remove Apps</button>
												</div>


											</div>
										</form>
									</div>
									<script type="text/javascript">
										const removeUser = document.querySelector('.removeUser')
										const allowUser = document.querySelector('.allowUser')
										allowUser.disabled = true
										removeUser.disabled = true


										// const email = document.querySelector('#email');
										// if (email === '' || email === null) {
										// 	const allowUser = document.querySelector('.allowUser')
										// 	allowUser.style.display = "none"
										// } else {
										function submitForm(action) {
											var form = document.getElementById('form1');
											form.action = action;
											form.submit();
										}
										// 	allowUser.style.display = "none"
										// }

										function showButton() {
											console.log("Email Inserted!")
											removeUser.disabled = false
											allowUser.disabled = false
										}
									</script>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<br>

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

</body>

</html>