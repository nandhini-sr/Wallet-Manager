<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Wallet Manager</title>
	<link rel="stylesheet" type="text/css" href="css/styleWallet.css">
</head>
<body>
	<header>
		<h1><a href="index.php">Wallet Manager</a></h1>
		<form action="loginAftersignup.inc.php" method="POST">
		<table>
			<tr>
				<td>Username:</td>
				<td>Password:</td>
			</tr>
			<tr>
				<td><input type="text" name="username" required></td>
				<td><input type="password" name="password" required></td>
				<td><button type="submit" name="LogIn">Login</button></td>
			</tr>
		</table>
		</form>
		<?php
            if ( isset($_SESSION["userChecklog"]) ) {
             echo('<p style="color:red;font-size:70%;float:right; margin-top:-17px; margin-right: 300px;"><b>'.$_SESSION["userChecklog"]."</b></p>\n");
             unset($_SESSION["userChecklog"]);
             }
            elseif ( isset($_SESSION["passwordChecklog"]) ) {
             echo('<p style="color:red;font-size:70%;float:right; margin-top:-17px; margin-right: 230px;"><b>'.$_SESSION["passwordChecklog"]."</b></p>\n");
             unset($_SESSION["passwordChecklog"]);
             }
            elseif ( isset($_SESSION["emptyChecklog"]) ) {
             echo('<p style="color:red;font-size:70%;float:right; margin-top:-17px; margin-right: 300px;"><b>'.$_SESSION["emptyChecklog"]."</b></p>\n");
             unset($_SESSION["emptyChecklog"]);
             }
            ?>	
	</header>
	<center>
		<h3>You have Signed Up successfully</h3>
		<?php
            if ( isset($_SESSION["newUser"]) ) {
             echo('<p style="color:#f44336;font-size:200%"><b> Hey '.$_SESSION["newUser"].",</b></p>\n");
             unset($_SESSION["newUser"]);
             }
            ?>
		<h1 style="color:#009688">Welcome to Wallet Manager!</h1>
		<h3 style="color:brown">Please LOG IN to experience the features below...</h3>
		<br>

		<img src="images/logo.png" height="470px" width="600px">
	</center>
	
	
</body>
</html>