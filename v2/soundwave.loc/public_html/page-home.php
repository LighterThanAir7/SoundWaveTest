<?php

require_once "config.php";
$page_title = "Home";

include "includes/head_inc.php";

echo '
<div class="bg-main">';

	// include "templates/nav.php";
	// Vue Component

	echo '
	<nav-component></nav-component>
	<div class="container">
		<div class="welcome-wrapper">
			<div class="welcome">
				<img src="'.SITE_URL. 'img/decorations/blue-soundbar.svg" alt="">
				<h1 class="tracking-xxl"><span class="text-primary-100">MUSIC</span> IS THE<br>SOUNDTRACK OF YOUR LIFE</h1>
				<p class="welcome__description">Discover, stream, and share a constantly expanding mix of music from emerging and major artists around the world.</p>
				<div class="welcome__cta">
					<p class="welcome__cta-text">What are you waiting for ?</p>
					<a class="btn" href="index.php?what=page-login">Join Now</a>
				</div>
			</div>
			<div class="mt-850">
				<img class="welcome__music-player welcome__music-player--small rounded-200" src="' .SITE_URL.'img/decorations/music-player-white.png" alt="music-player-white">
				<img class="welcome__music-player rounded-200" src="'.SITE_URL.'img/decorations/music-player-green.png" alt="music-player-green">
				<img class="welcome__music-player welcome__music-player--small rounded-200" src="'.SITE_URL.'img/decorations/music-player-blue.png" alt="music-player-blue">
			</div>
		</div>
		<div class="one-liner-container">
			<img class="soundwave" src="'.SITE_URL.'img/decorations/soundwave.png" alt="">
			<p class="one-liner">Elevate your sound</p>
		</div>
	</div>
	<footer-bottom></footer-bottom>
</div>';

include "includes/footer_inc.php";