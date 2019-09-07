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
		<form action="login.inc.php" method="POST">
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
	<br><br>
	<img src="images/logo.png" height="470px" width="600px" style="margin-left:70px;">
	<section>
		<h5>Manage your wallet for FREE!</h5>
		<form action="signup.inc.php" method="POST">
			<?php
            if ( isset($_SESSION["emptyCheck"]) ) {
             echo('<p style="color:red;font-size:70%;">'.$_SESSION["emptyCheck"]."</p>\n");
             unset($_SESSION["emptyCheck"]);
             }
            ?>
			Your Name: <input type="text" name="name" required><br>
			<?php
            if ( isset($_SESSION["nameCheck"]) ) {
             echo('<p style="color:red;font-size:70%;">'.$_SESSION["nameCheck"]."</p>\n");
             unset($_SESSION["nameCheck"]);
             }
            ?><br>
			Email Id:  <input type="email" name="email" required><br>
			<?php
            if ( isset($_SESSION["emailCheck"]) ) {
             echo('<p style="color:red;font-size:70%;">'.$_SESSION["emailCheck"]."</p>\n");
             unset($_SESSION["emailCheck"]);
             }
            ?><br>
			Username:  <input type="text" name="username" required><br>
			<?php
            if ( isset($_SESSION["usertaken"]) ) {
             echo('<p style="color:red;font-size:70%;">'.$_SESSION["usertaken"]."</p>\n");
             unset($_SESSION["usertaken"]);
             }
            ?><br>
			Password:  <input type="password" name="password" required><br><br>
			Current Balance: Rs<input type="number" name="balance" required><br>
			<?php
            if ( isset($_SESSION["balanceCheck"]) ) {
             echo('<p style="color:red;font-size:70%;">'.$_SESSION["balanceCheck"]."</p>\n");
             unset($_SESSION["balanceCheck"]);
             }
            ?><br>
			<button type="submit" name="SignUp">Sign Up</button>
		</form>
	</section>

</body>
</html>