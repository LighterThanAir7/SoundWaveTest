<?php

require_once "config.php";

$page_title = "Explore";
$footer = "medium";
$footer_soundbars = "";

include "includes/head_inc.php";

include 'templates/sidebar.php';
include 'templates/searchbar.php';

echo '

<div class="soundwave__gif-container">
    <img class="soundwave__gif soundwave__gif--left" src="'.SITE_URL.'img/music-player/SkyBlue.gif" alt="">
    <img class="soundwave__gif soundwave__gif--right" src="'.SITE_URL. 'img/music-player/SkyBlue.gif" alt="">
</div>

<div class="page-content">
	<div class="channel">
	
		<section id="podcasts" class="page-header__container">
			<header class="page-header">
				<h1>Explore</h1>
				<h3 class="mb-400">Be <span class="text-primary-100">fearless</span> in the pursuit of what sets your <span class="text-secondary-100">soul</span> on <span class="text-secondary-100">fire</span></h3>
				<p class="page-header__description">Too often we underestimate the power of a touch, a smile, a kind word, a listening ear, an honest compliment or the smallest act of caring, all of which have the potential to turn a life around.</p>
				<div class="flex items-center g-400">
					<a class="btn btn--base" href="">Learn More</a>
					<i class="icon-shuffle"></i>
					<span class="text-primary-100">Play Random</span>
				</div>
			</header>
			<img src="' .SITE_URL.'img/decorations/man-with-a-microphone.jpg" alt="">
		</section>';

		$podcasts_categories_data = getCategoryDataFromClass("Genres");
		GetCardWtihTextCarousel($podcasts_categories_data, "Genres");

		$podcasts_categories_data = getCategoryDataFromClass("PlaylistCategories");
		GetCardWtihTextCarousel($podcasts_categories_data, "Playlist Categories");

		$podcasts_categories_data = getCategoryDataFromClass("PodcastCategories");
		GetCardWtihTextCarousel($podcasts_categories_data, "Podcasts by Categories");

		echo '
		<section class="quote">
			<img class="quote__img-left" src="img/decorations/blue-soundbar.svg" alt="">
			<img class="quote__img-right" src="img/decorations/pink-soundbar.svg" alt="">
			<h4 class="quote__text"><span class="text-primary-100">Not all</span> those who wander are lost - <span class="text-secondary-100">J.R.R. Tolkien</span></h4>
			<!--<i class="arrow__top icon-arrow-up"></i>-->
			<scroll-to-top></scroll-to-top>
		</section>';

		include "templates/footer.php";
//		include "templates/footer-bottom.php";

		echo '
		<footer-bottom></footer-bottom>
	</div>
</main>
</div> <!-- closing div tag for vue app -->
<script src="js/music-list.js"></script>
<script>
	var phpArray = '.$phpArrayJson.';
    initializeMusicList(phpArray);
</script>
';

include "includes/footer_inc.php";