<?php
session_start();
require_once 'config.php';
if (isset($_SESSION['user']) && isset($_SESSION['status'])) {
	header('location:dashboard.php');
	exit();
}
if (isset($_POST['login'])) {
	$userId = $_POST['userId'];
	$password = $_POST['password'];
	if (empty($userId) || empty($password)) {
		$error = "<font color='red'>Required field is empty</font>";
	}else{
		$query=mysqli_query($conn, "SELECT * FROM users WHERE userId='$userId' AND password='$password'");
		//var_dump($query);
		 if(mysqli_num_rows($query)>=1)
		   {
		   		$user= mysqli_fetch_assoc($query);

			    $_SESSION['userId'] = $user['userId'];
				$_SESSION['name'] = $user['name'];
				$_SESSION['userType'] = $user['userType'];
				$_SESSION['status'] = 1;
				if (isset($_POST['save'])) {
					setcookie('userId', $userName, time() + (86400 * 30), "/");
					setcookie('password', $password, time() + (86400 * 30), "/");
				}else{
					unset($_COOKIE['userId']);
					unset($_COOKIE['password']);
				}
				header('location:dashboard.php');
		   }else{
		   		$error = '<font color="red">User with this id doesn\'t exists!</font>';
		   }
			
			
		
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
	<center><?php if(!empty($error))echo $error; if(isset($_SESSION['success'])) echo $_SESSION['success']; unset($_SESSION['success']); ?></center>
	<br>
	<form action="" method="post">
	<table border="1" align="center" width="60%">
		<tr height="150px">
			<td colspan="2">
				<fieldset>
				    <legend><b>Login</b></legend>
				    User Id: <input type="text" name="userId" value="<?php if (isset($_COOKIE['userId'])) echo $_COOKIE['userId'];?>"><br>
				    Password: <input type="password" name="password" value="<?php if (isset($_COOKIE['password'])) echo $_COOKIE['password'];?>"><br>
				    <input type="checkbox" name="save" <?php if (isset($_COOKIE['save'])) echo "checked";?> > Remember Me <a href="registration.php">Register</a> <br>
				    <hr>
				    <input type="submit" name="login" value="Submit">
				</fieldset>
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<center>Copyright &copy; Rokan Chowdhury Onick</center>
			</td>
		</tr>
	</table>
	</form>
</body>
</html>