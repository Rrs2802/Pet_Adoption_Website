<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/account.php");

$account = new Account($con);


if(isset($_POST["submitButton"])){
	
	if(isset($_POST["submitButton"])){
	
		$email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
		
		$password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
	
		//  echo $username."<br>";
		
		//  echo $password."<br>";
		
		$success = $account-> login($email,$password);
		
		if($success){
			// stores sessions..
			header("location: index.php");
		}
		}
}
?>




<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Welcome to Movister</title>
		<link rel="stylesheet" href="assets\style\style.css" />
	</head>

	<body>
		<div class="signInContainer">
			<div class="column">
				<div class="header">

					<img src="assets\style\logo.png" title="Movister" alt="Movister">

					<h3>Sign-In</h3>
					<span>to continue to Mascota</span>
				</div>

				<form method="POST">

					<?php echo $account->getError(Constants:: $emailInValid); ?>
					<input type="email" name="Email" placeholder="Email" required>

					<input type="password" name="password" placeholder="Password" required>

					<input type="submit" name="submitButton" value="SUBMIT">
				</form>

				<a href="register.php" class="signInMessage">Need an account? Sign up here!</a>

			</div>
		</div>
	</body>

</html>