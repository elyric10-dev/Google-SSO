<?php
//Destroy entire session data.
session_start();

include('config.php');

//Reset OAuth access token
$client->revokeToken();




unset($_SESSION['user_token']);
session_destroy();
header("Location: Roles.html");
