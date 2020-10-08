<?php 
	session_start();
?>

<!DOCTYPE html>

<html>

	<head>
		<title>Login</title>

		<meta charset="utf-8">
		<meta name="description" content="Login PHP">
		<meta name="keywords" content="HTML,CSS,XML,JavaScript,PHP">
		<meta name="author" content="Breno Lucas">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link rel="stylesheet" type="text/css" href="css/headerpage.css">
		<link rel="stylesheet" type="text/css" href="css/content.css">	

	</head>

	<body>

		<header>
			<nav class="nav-header">
				 <a href="#" class="icon-nave-header">
				 	<img src="img/circle.png">
				 </a>

				 <ul class="">
				 	<li> <a href="index.php">Home</a> </li>
				 	<li> <a href="index.php">Portfolio</a> </li>
				 	<li> <a href="index.php">About me</a> </li>
				 	<li> <a href="index.php">Contact us</a> </li>
				 </ul>				 
			</nav>			
			<div class="header-login">

				<?php
					if (isset($_SESSION['user_id']))
					{
						echo '
						<form action="includes/logout.inc.php" method="post" class="form-loggout-header">
						<button type="submit" name="logout_submit">Logout</button> 
						</form>';
					}

					else{
						echo '
						<form action="includes/login.inc.php" method="post" class="form-login-header">
							<input type="text" name="user_email" placeholder="Username or E-Mail...">
							<input type="password" name="user_pass" placeholder="Password...">
							<button type="submit" name="login_submit">Login</button>	
				 		</form>
				 		<a href="signup.php">Sign-Up</a>';
					}
				?> 
			</div>
		</header>