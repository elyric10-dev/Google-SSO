<?php
session_start();
require_once 'config.php';


// authenticate code from Google OAuth Flow

if (isset($_GET['code'])) {
	$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
	$client->setAccessToken($token['access_token']);

	// get profile info
	$google_oauth = new Google_Service_Oauth2($client);
	$google_account_info = $google_oauth->userinfo->get();
	$userinfo = [
		'email' => $google_account_info['email'],
		'first_name' => $google_account_info['givenName'],
		'last_name' => $google_account_info['familyName'],
		'full_name' => $google_account_info['name'],
		'picture' => $google_account_info['picture'],
		'verifiedEmail' => $google_account_info['verifiedEmail'],
		'token' => $google_account_info['id'],
	];



	$_SESSION['profile'] = $userinfo['picture'];
	$_SESSION['user_token'] = $token;
	$_SESSION['email'] = $userinfo['email'];
	$_SESSION['first_name'] = $userinfo['first_name'];
	$_SESSION['last_name'] = $userinfo['last_name'];
	$_SESSION['full_name'] = $userinfo['full_name'];
	$_SESSION['verified_email'] = $userinfo['verifiedEmail'];
	$_SESSION['gtoken'] = $userinfo['token'];



	// checking if user is already exists in database
	$sql = "SELECT * FROM user_accounts WHERE email ='{$userinfo['email']}'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		// user is EXISTED
		$userinfo = mysqli_fetch_all($result);
		$_SESSION['user_token'] = $token;
		$_SESSION['user_id'] = $userinfo['id'];


		//CHECK EMAIL IF NEW
		$check_new_email = "SELECT check_new_account FROM user_accounts WHERE email = '{$_SESSION['email']}'";
		$check_new_email_query = mysqli_query($conn, $check_new_email);
		if (mysqli_num_rows($check_new_email_query) > 0) {
			$get_check_account = $check_new_email_query->fetch_array();
			if ($get_check_account['check_new_account'] === '0') {
				header('Location: new_user.php');
			} else if ($get_check_account['check_new_account'] === '1') {
				header("Location: userdash.php");
			}
		}
	} else {
		// user is not exists
		$token = $userinfo['token'];

		header('Location: new_user.php');
	}

	// save user data into session
	$_SESSION['user_token'] = $token;
} else {
	//IF NOT SET
	if (!isset($_SESSION['user_token'])) {
		header("Location: index.html");
		die();
	}
}
