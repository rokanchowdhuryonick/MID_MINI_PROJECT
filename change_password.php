<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['status']) || !isset($_SESSION['userType'])) {
	header('location:login.php');
	exit();
}
$userId = $_SESSION['userId'];
$message = "";
if (isset($_POST['change'])) {
	if (empty($_POST['currentPass']) || empty($_POST['password']) || empty($_POST['password2'])) {
		$message = "<font color='red'>Required field is empty!</font>";
	}else if ($_POST['password']!=$_POST['password2']) {
		$message = "<font color='red'>New Password and Retype Password not matched!</font>";
	}else{
		$query = mysqli_query($conn, "SELECT * FROM users WHERE userId='$userId'");
		$userData = mysqli_fetch_assoc($query);
		if ($_POST['currentPass']==$userData['password']) {
			$newPass = $_POST['password'];
			$query2 = "UPDATE users SET password='$newPass' WHERE userId='$userId'";
			if(mysqli_query($conn, $query2)){
				$message = "<font color='green'>Password Successfully Changed!</font>";
			}
			
		}else{
			$message = "<font color='red'>Current Password does not matched!</font>";
		}
	}
	

}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
</head>
<body>
	<br><br>

	<center>
		<?php if(!empty($message))echo $message; ?><br>
		<table width="30%">
			<tr>
				<td>
					<fieldset>
					    <legend><b>CHANGE PASSWORD</b></legend>
					    <form action="" method="post">
					        <table>
					            <tr>
					                <td><font size="3">Current Password</font></td>
					                <td>:</td>
					                <td><input type="password" name="currentPass" /></td>
					                <td></td>
					            </tr>
					            <tr>
					                <td><font size="3">New Password</font></td>
					                <td>:</td>
					                <td><input type="password" name="password" /></td>
					                <td></td>
					            </tr>
					            <tr>
					                <td><font size="3">Retype New Password</font></td>
					                <td>:</td>
					                <td><input type="password" name="password2" /></td>
					                <td></td>
					            </tr>
					        </table>
					        <hr />
					        <input type="submit" value="Change" name="change" /> <a href="dashboard.php">Home</a>
					    </form>
					</fieldset>
				</td>
			</tr>
		</table>
	</center>
	

</body>
</html>
