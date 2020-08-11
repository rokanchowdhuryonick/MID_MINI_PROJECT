<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['status']) || !isset($_SESSION['userType']) || ($_SESSION['userType']!='admin')) {
	header('location:login.php');
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
</head>
<body>
	<br><br>
	<center>
		<table width="60%" border="1">
			<tr>
				<td colspan="4" height="35" align="center">
					<font size="5"><b>Users</b></font>
				</td>
			</tr>
			<tr>
				<th>
					ID
				</th>
				<th>
					Name
				</th>
				<th>
					Email
				</th>
				<th>
					User Type
				</th>
			</tr>
		<?php
			$query = mysqli_query($conn, "SELECT * FROM users");
			while ($userData = mysqli_fetch_assoc($query)) {
		?>
			<tr>
				<td>
					<?=$userData['userId']?>
				</td>
				<td>
					<?=$userData['name']?>
				</td>
				<td>
					<?=$userData['email']?>
				</td>
				<td>
					<?=($userData['userType']=='admin')?'Admin':'User'?>
				</td>
			</tr>
		<?php } ?>
			<tr>
				<td colspan="4" align="right" height="30">
					<a href="dashboard.php">Go Home</a>
				</td>
			</tr>
		</table>
	</center>
</body>
</html>