<?php
require('db.php');
$id=$_REQUEST['id'];
$query = "DELETE FROM user_accounts WHERE id=$id";
$result = mysqli_query($conn,$query) or die();

$query1 = "DELETE FROM allowed_apps WHERE id=$id";
$result2 = mysqli_query($conn,$query1) or die();
header("Location: admin.php");
