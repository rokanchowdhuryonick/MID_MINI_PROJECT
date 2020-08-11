<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['status']) || !isset($_SESSION['userType'])) {
	header('location:login.php');
	exit();
}
$userId = $_SESSION['userId'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE userId='$userId'");
$userData = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile View</title>
</head>
<body>
	<br><br>
	<center>
		<table width="60%" border="1">
			<tr>
				<td colspan="2" height="35" align="center">
					<font size="5"><b>Profile</b></font>
				</td>
			</tr>
			<tr>
				<td>
					ID
				</td>
				<td>
					<?=$userData['userId']?>
				</td>
			</tr>
			<tr>
				<td>
					Name
				</td>
				<td>
					<?=$userData['name']?>
				</td>
			</tr>
			<tr>
				<td>
					E-mail
				</td>
				<td>
					<?=$userData['email']?>
				</td>
			</tr>
			<tr>
				<td>
					User Type
				</td>
				<td>
					<?=($userData['userType']=='admin')?'Admin':'User'?>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="right" height="30">
					<a href="dashboard.php">Go Home</a>
				</td>
			</tr>
		</table>
	</center>
</body>
</html>