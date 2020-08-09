<?php
session_start();
require_once 'config.php';
$error = "";
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$userId =$_POST['id'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];
	$userType = $_POST['userType'];
	if (empty($name) || empty($email) ||  empty($userType) ||  empty($password) ||  empty($confirmPassword) || empty($userId)){
		$error = "<font color='red'>Required field is empty</font>";
	}else if ($password !=$confirmPassword) {
		$error = "<font color='red'>Two password not matched</font>";
	}else{
		$query = "INSERT INTO users (username, password, name, email, userType) VALUES ('$userId', '$password', '$name', '$email', '$userType')";
		if (mysqli_query($conn, $query)) {
		  $_SESSION['success'] = '<font color="green">Registration success..</font>';
		  header('Location: login.php');
		} else {
		  $error = "<font color='red'>Registration failed!</font>".mysqli_error($conn);
		}

		mysqli_close($conn);

	}
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Rokan Chowdhury Onick</title>
</head>
<body>
	<br><br>
	<center><?php if(!empty($error))echo $error;?></center><br>
	<table border="1" align="center" width="60%">
		<tr height="150px">
			<td colspan="2">
			<fieldset>
			    <legend><b>REGISTRATION</b></legend>
				<form action="" method="post">
					<br/>
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<td>ID</td>
							<td>:</td>
							<td><input name="id" type="text"></td>
							<td></td>
						</tr>		
						<tr><td colspan="4"><hr/></td></tr>
						<tr>
							<td>Password</td>
							<td>:</td>
							<td>
								<input name="password" type="password">
							</td>
							<td></td>
						</tr>		
						<tr><td colspan="4"><hr/></td></tr>
						<tr>
							<td>Confirm Password</td>
							<td>:</td>
							<td><input name="confirmPassword" type="password"></td>
							<td></td>
						</tr>		
						<tr><td colspan="4"><hr/></td></tr>
						<tr>
							<td>Name</td>
							<td>:</td>
							<td><input name="name" type="text"></td>
							<td></td>
						</tr>		
						<tr><td colspan="4"><hr/></td></tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td><input name="email" type="text"></td>
							<td></td>
						</tr>		
						<tr><td colspan="4"><hr/></td></tr>
						<tr>
							<td>User Type</td>
							<td>:</td>
							<td>
								<select name="userType">
									<option value="user">User</option>
									<option value="admin">Admin</option>
								</select>
							</td>
							<td></td>
						</tr>
					</table>
					<hr/>
					<input type="submit" name="submit" value="Submit">
					<input type="reset">
				</form>
			</fieldset>

			</td>
		</tr>
		<tr>
			<td colspan="2">
			<center>Copyright &copy; Rokan Chowdhury Onick</center>
			</td>
		</tr>
	</table>

</body>
</html>
