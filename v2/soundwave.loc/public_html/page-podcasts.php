<?php

require_once "config.php";

$page_title = "Podcasts";
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
				<h1>Podcasts</h1>
				<h3 class="mb-400">Listen with <span class="text-primary-100">curiosity</span> speak with <span class="text-secondary-100">honesty</span>, act with <span class="text-secondary-100">integrity</span></h3>
				<p class="page-header__description">The greatest problem with communication is we don’t listen to understand. We listen to reply. When we listen with curiosity, we don’t listen with the intent to reply. We listen for what’s behind the words.</p>
				<div class="flex items-center g-400">
					<a class="btn btn--base" href="">Learn More</a>
					<i class="icon-shuffle"></i>
					<span class="text-primary-100">Play Random</span>
				</div>
			</header>
			<img src="' .SITE_URL.'img/decorations/man-with-a-microphone.jpg" alt="">
		</section>';

		$podcasts_categories_data = getCategoryDataFromClass("PodcastCategories");
		GetCardWtihTextCarousel($podcasts_categories_data, "Categories");

		$folderPath = $_SERVER['DOCUMENT_ROOT']."/soundwave.loc/public_html/img/podcasts-page/you-might-love";
		GetSectionCarouselWithTitles($folderPath, "You Might Love");

		$folderPath = $_SERVER['DOCUMENT_ROOT']."/soundwave.loc/public_html/img/podcasts-by-duration";
		$playlist_categories_names = ["< 10 min>", "≈ 20 min", "≈ 30 min", "≈ 60 min", "> 2 h"];

		GetSectionCarousel($folderPath, "Podcasts by Duration",
			multiple_information: false,
			description: $playlist_categories_names,
			text_over_img_centered: true
		);

		echo '
		<section class="quote">
			<img class="quote__img-left" src="img/decorations/blue-soundbar.svg" alt="">
			<img class="quote__img-right" src="img/decorations/pink-soundbar.svg" alt="">
			<h4 class="quote__text">When people<span class="text-primary-100"> talk, listen </span> completely. Most people never listen - <span class="text-secondary-100">Ernest Hemingway</span></h4>
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