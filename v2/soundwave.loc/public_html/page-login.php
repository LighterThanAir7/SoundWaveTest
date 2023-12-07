<?php

require_once "config.php";
$page_title = "Login";

include "includes/head_inc.php";

echo '
<div class="bg-dots-gradient">';

	// include "templates/nav.php";
	// Vue Component
	echo '
	<nav-component></nav-component>
	<div class="container items-center">
		<h1 class="text-center mt-500"><span class="text-primary-100">Life</span> and <span class="text-primary-100">Love</span> go on, let the <span class="text-secondary-100">Music</span> play.</h1>
		<h3 class="mb-800">Sing Up or Log In</h3>
		
		<form class="form" action="index.php?what=page-music" method="post">
		
			<label class="form__label" for="username">Email or Username</label>
			<input class="form__input" id="username" type="text" placeholder="Type here...">
			
			<label class="form__label" for="password">Password</label>
			<input class="form__input" id="password" type="password" name="pass" placeholder="Type here...">
			
			<button type="submit" class="btn btn--base mb-500">Continue</button>
			
			<label class="form__label mb-500" for="">
				<input type="checkbox"> Remember me
			</label>
			
			<p class="text-center mb-600">or</p>
		
			<div class="socials">
				<i class="icon-facebook"></i>
				<i class="icon-twitter"></i>
				<i class="icon-instagram"></i>
				<i class="icon-apple"></i>
			</div>
		</form>
	</div>
	<footer-bottom></footer-bottom>
</div>';

//		include "templates/footer-bottom.php";


include "includes/footer_inc.php";