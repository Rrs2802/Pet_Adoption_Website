<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/account.php");

    $account = new Account($con);


if(isset($_POST["submitButton"])){
	$FirstName = FormSanitizer::sanitizeFormString($_POST["FirstName"]);
	$LastName = FormSanitizer::sanitizeFormString($_POST["LastName"]);
	$username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
	$email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
	$email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);
	$password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
	$password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);

	// echo $FirstName."<br>";
	// echo $LastName."<br>";
	// echo $username."<br>";
	// echo $email."<br>";
	// echo $email2."<br>";
	// echo $password."<br>";
	// echo $password2."<br>";
    $success = $account-> register($FirstName,$LastName,$username,$email,$email2,$password,$password2);
	
	if($success){
		// stores sessions..
		header("location: index.html");
	}
	}

?>




<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Welcome to Mascota</title>
		<link rel="stylesheet" href="assets\style\style.css" />
	</head>

	<body>
		<div class="signInContainer">
			<div class="column">
				<div class="header">

					<img src="assets\style\logo.png" title="Mascota">

					<h3>Sign-Up</h3>
					<span>to continue to Mascota</span>
				</div>

				<form method="POST">

					<input type="text" name="FirstName" placeholder="First Name" required>
					<?php echo $account->getError(Constants:: $FirstNameCharacter); ?>


					<input type="text" name="LastName" placeholder="Last Name" required>
					<?php echo $account->getError(Constants:: $LastNameCharacter); ?>


					<input type="text" name="username" placeholder="Username" required>
					<?php echo $account->getError(Constants:: $usernameCharacter); ?>
					<?php echo $account->getError(Constants:: $usernameTaken); ?>


					<input type="email" name="email" placeholder="Email" required>
					<?php echo $account->getError(Constants:: $emailsDontMatch); ?>
					<?php echo $account->getError(Constants:: $emailInValid); ?>
					<?php echo $account->getError(Constants:: $emailTaken); ?>

					<input type="email" name="email2" placeholder="Confirm-Email" required>


					<input type="password" name="password" placeholder="Password" required>

					<input type="password" name="password2" placeholder="Confirm-Password" required>

					<?php echo $account->getError(Constants:: $passwordLength); ?>
					<?php echo $account->getError(Constants:: $passwordsDontMatch); ?>

					<input type="submit" name="submitButton" value="SUBMIT">
				</form>

				<a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>

			</div>
		</div>
	</body>

</html>