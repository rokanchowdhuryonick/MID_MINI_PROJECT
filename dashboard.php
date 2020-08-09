<?php
session_start();

if (!isset($_SESSION['status']) || !isset($_SESSION['userType'])) {
	header('location:login.php');
	exit();
}

?>


<table width="60%" border="1" align="center">
	<tr><td align="center">
		<h1>Welcome, <?=$_SESSION['name']?></h1>
		<a href="profile.php">Profile</a><br>
		<a href="change_password.php">Change Password</a><br>
		<?php if ($_SESSION['userType']=='admin') {
		?>
		<a href="view_users.php">View Users</a><br>
		<?php } ?>
		<a href="logout.php">Logout</a>
	</td></tr>
</table>