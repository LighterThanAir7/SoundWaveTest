<?php

################################################################################
# ime   : interface.PHP                                                             
# opis  : Script for login
# autor : Benjamin Babić
# datum : 06/06/2023
################################################################################

require_once 'sw-config/env.php';

echo '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Soundwave Admin :: Login</title>

    <link rel="shortcut icon" href="'.SITE_URL.'favicon.ico" type="image/x-icon">
    <link rel="icon" href="'.SITE_URL.'favicon.ico" type="image/x-icon">

	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link rel="stylesheet" href="css/signin.css">
</head>
<body class="bg-custom">

    <img class="mb-5" src="img/logo-white.svg" alt="" width="400">
    <h1 class="h4 mb-5 font-weight-bold">Administration panel</h1>

	<form class="form-signin" method="POST" action="./index.php">
		
		<label for="username" class="form__label sr-only">Username</label>
		<input type="text" id="username" name="vis_username" class="form__input" placeholder="Type here..." required autofocus>

		<label for="password" class="form__label sr-only">Password</label>
		<input type="password" id="password" name="vis_password" class="form__input" placeholder="Type here..." required>

		<div class="checkbox mb-3">
			<label><input type="checkbox" value="remember-me"> Remember me</label>
		</div>
		<button class="btn btn-secondary btn-lg btn-block" type="submit">Login</button>
	</form>';

//include 'templates/admin-footer-bottom.php';

echo '
</body>
</html>';

 ?>
