<?php

require_once "config.php";
$page_title = "About";
$footer_soundbars = "footer--soundbars";

include "includes/head_inc.php";

echo '
<div class="bg-warm">';

	// include "templates/nav.php";
	// Vue Component
	echo '
	<div id="app">
	  <nav-component></nav-component>
	</div>';

	echo '
	<div class="container">
		<div class="row col">
			<h1 class="text-center">What is <span class="text-primary-100">SoundWave</span></h1>
			<h4 class="text-center mb-700"><span class="accent-blue">SoundWave</span> is a global music streaming platform bringing fans closer to artists through unique experiences and the highest sound quality</h4>
			<a class="btn mb-800" href="index.php?what=page-login">Join Now</a>
			<img src="'.SITE_URL.'img/decorations/soundwave.png" alt="">
		</div>
	</div>';
	echo GetHorizontalScrollMessage(0);
	echo '
</div>
	
<div class="bg-">

	<section class="artwork">
		<h2 class="artwork__text">Get the ultimate music experience with a library of over 100 million songs and 450,000 podcasts.</h2>
		<div class="artwork__carousel">';
			for ($i = 1; $i <= 24; $i++) {
				echo '<img src="'.SITE_URL.'img/artworks/'.$i.'.png" alt="">';
			}
		echo '</div>
	</section>
</div>

<section class="bg-dots mb-4xl">';

	echo GetHorizontalScrollMessage(1);

	echo '
	<div class="brand-values-container">';
		$brand_values_array = [
			[
			 'title' 	=> 'Superior Sound Quality',
			 'desc'  	=> 'We deliver the art in its highest quality exactly as the fans want and as the artist intended.',
			 'btn-text' => 'Sound Quality'
			],
			[
			 'title' 	=> 'Deeper Connection with Fans',
			 'desc'  	=> 'Through unique collaborations with the giant artist community, we create deeper connections for fans to experience music like never before',
			 'btn-text' => 'Soundwave originals'
			],
			[
			 'title' 	=> 'Commitment to the Art',
			 'desc'  	=> 'We empower artists to create and deliver their art exactly as they intended.',
			 'btn-text' => 'Credits & Contributors'
			],
		];

		foreach ($brand_values_array as $key => $brand_value) {
			echo '
			<div class="brand-values__row">';
				if (($key+1) % 2 === 0) {
					echo ' <div class="brand-values order-1">';
				} else {
					echo '<div class="brand-values">';
				}
				echo '
					<span class="brand-values__number">'.($key+1).'</span>
					<h2 class="brand-values__title">'.$brand_value['title'].'</h2>
					<p class="brand-values__desc">'.$brand_value['desc'].'</p>
					<a class="btn btn--base" href="#">'.$brand_value['btn-text'].'</a>
				</div>
				<div class="brand-values">
					<img class="brand-values__img" src="'.SITE_URL.'img/brand-values/'.$brand_value['title'].'.png" alt="'.$brand_value['title'].'">
				</div>
			</div>';
		}
		echo '
	</div>';
	echo GetHorizontalScrollMessage(2);

	$discover_more_cards = [
		[
		 'title' => 'SoundWave MASTERS',
		 'desc'  => 'Transform your music experience by listening to your favorite songs in recording-studio quality HiFi.'],
		[
		 'title' => 'Magazine',
		 'desc'  => 'Read the latest from award-winning journalists and music experts who share news, trends, and interview top artists.'],
		[
		 'title' => 'Events',
		 'desc'  => 'Immerse yourself in seductive music events, where fans, artists, and performances unite, igniting desires with shared euphoria.'],
		[
		 'title' => 'Rising',
		 'desc'  => 'Discover the new and next wave of RISING artists from around the world across a variety of genres.'],
	];

	echo '
	<div class="horizontal-scroller">
		<div class="cards">';
		foreach ($discover_more_cards as $card) {
			echo '
			<div class="card">
				<img class="card__img" src="'.SITE_URL.'img/cards/about/'.$card['title'].'.png" alt="">
				<div class="card__info">
					<h3 class="card__title">'.$card['title'].'</h3>
					<p class="card__text">'.$card['desc'].'</p>
					<a class="btn btn--base" href="#">Learn More</a>
				</div>
			</div>';
		}
		echo '
	</div>';

	include "templates/footer.php";
	// include "templates/footer-bottom.php";
	echo '
	<footer-bottom></footer-bottom>
</section>';

include "includes/footer_inc.php";