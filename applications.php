<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Trial2</title>
</head>
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

<body>
	<div id="apps">
		<!-- USER APPLICATION -->
		<div class="apps_master_container">
			<!-- ALLOWED USER APPS BY ADMIN -->
			<?php
			include('db.php');
			$myApp = "SELECT * FROM allowed_apps";
			$myApp_query = mysqli_query($conn, $myApp);
			$allowed_apps = $myApp_query->fetch_array();
			?>


			<a href="https://gmail.com" target=”_blank” <?php echo ($allowed_apps['ggmail'] === '0') ? 'hidden' : 'flex'; ?>>
				<div class="apps_container">
					<img src="appLogo/gmail.png" alt="gmail" class="app_icon">

					<div class="app_title">Gmail</div>
				</div>
			</a>
			<a href="https://drive.google.com/" target=”_blank” <?php echo ($allowed_apps['gdrive'] === '0') ? 'hidden' : 'flex' ?>>
				<div class="apps_container">
					<img src="appLogo/gdrive.png" alt="gmail" class="app_icon">
					<div class="app_title">Drive</div>
				</div>
			</a>

			<a href="https://docs.google.com/forms" target=”_blank” <?php echo ($allowed_apps['gform'] === '0') ? 'hidden' : 'flex' ?>>
				<div class="apps_container">
					<img src="appLogo/gforms.png" alt="gmail" class="app_icon">
					<div class="app_title">Forms</div>
				</div>
			</a>
			<a href="https://hangouts.google.com/" target=”_blank” <?php echo ($allowed_apps['ghangout'] === '0') ? 'hidden' : 'flex' ?>>
				<div class="apps_container">
					<img src="appLogo/ghangouts.png" alt="gmail" class="app_icon">
					<div class="app_title">Hangouts</div>
				</div>
			</a>
			<a href="https://docs.google.com/document" target=”_blank” <?php echo ($allowed_apps['gdocument'] === '0') ? 'hidden' : 'flex' ?>>
				<div class="apps_container">
					<img src="appLogo/gdocs.png" alt="gmail" class="app_icon">
					<div class="app_title">Documents</div>
				</div>
			</a>
			<a href="https://docs.google.com/spreadsheets" target=”_blank” <?php echo ($allowed_apps['gspreadsheet'] === '0') ? 'hidden' : 'flex' ?>>
				<div class="apps_container">
					<img src="appLogo/gsheets.png" alt="gmail" class="app_icon">
					<div class="app_title">Spreadsheet</div>
				</div>
			</a>
			<a href="https://docs.google.com/presentation" target=”_blank” <?php echo ($allowed_apps['gpresentation'] === '0') ? 'hidden' : 'flex' ?>>
				<div class="apps_container">
					<img src="appLogo/gslides.png" alt="gmail" class="app_icon">
					<div class="app_title">Presentation</div>
				</div>
			</a>
			<a href="https://classroom.google.com/" target=”_blank” <?php echo ($allowed_apps['gclassroom'] === '0') ? 'hidden' : 'flex' ?>>
				<div class="apps_container">
					<img src="appLogo/gclassroom.png" alt="gmail" class="app_icon">
					<div class="app_title">Classroom</div>
				</div>
			</a>
			<a href="https://meet.google.com/" target=”_blank” <?php echo ($allowed_apps['gmeet'] === '0') ? 'hidden' : 'flex' ?>>
				<div class="apps_container">
					<img src="appLogo/gmeet.png" alt="gmail" class="app_icon">
					<div class="app_title">Meet</div>
				</div>
			</a>
			<a href="https://calendar.google.com/" target=”_blank” <?php echo ($allowed_apps['gcalendar'] === '0') ? 'hidden' : 'flex' ?>>
				<div class="apps_container">
					<img src="appLogo/gcalendar.png" alt="gmail" class="app_icon">
					<div class="app_title">Calendar</div>
				</div>
			</a>

		</div>


	</div>
</body>

</html>