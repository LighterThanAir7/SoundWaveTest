<?php

require_once "config.php";

$page_title = "Music";
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

<main class="page-content">
	<div class="channel">';

		echo '
		<section id="vibe" class="channel__section">
			<h3 class=""><span class="text-primary-100">Vibe:</span> Play how you feel</h3>
			<p class="channel__desc">An infinite, personalized mix of the music you love and new descoveries</p>
			<ul class="vibe__list">';

			$vibe_items = [
				'icon' => ['heartline', 'trending-up', 'coffee-cup', 'heart_outline', 'confetti', 'workout', 'focus', 'book'],
				'name' => ['Vibe', 'Trending', 'Chill', 'Love', 'Dance', 'Workout', 'Focus', 'Study']
			];

			foreach ($vibe_items['icon'] as $index => $icon) {
				echo '
				<li class="vibe__item">
					<i class="vibe__icon icon-'.$icon.'"></i>
					<span class="vibe__name">'.$vibe_items['name'][$index].'</span>
				</li>';
			}
			echo '
			</ul>
		</section>';

		$folderPath = $_SERVER['DOCUMENT_ROOT']."/soundwave.loc/public_html/img/made-for-you";
		$made_for_you = [
			"Ft. Richard Durand, Dash Berlin, Ciaran McAuley, Sue Mclaren",
			"Ft. Susana, JES, Roman Messer, Stine Grove",
			"Ft. Aurosonic, Stoneface & Terminal, Beat Service, Ana Criado",
			"Ft. Susana, JES, Darren Porter, Stine Grove",
			"Ft. Antiloop, Susana, Alex M.O.R.P.H., Roger Shah",
			"Ft. The Rolling Stones, Eagles, Led Zeppelin, Jimi Hendrix",
			"Ft. Alex M.O.R.P.H., Giuseppe Ottaviani, Orjan Nilsen, Allen Watts",
			"Ft. Paul van Dyk, Christina Stürmer, Annett Louisan, Justin Jesso",
			"Ft. Moby Dick, Željko Joksimović, Zdravko Colic, Dino Merlin",
			"Ft. Eric Clapton, Miami Sound Machine, Santana, B.B. King",
			"Ft. The Smiths, Aurosonic, Radion6, Allen & Envy"
		];
		GetSectionCarousel($folderPath,"Made For You", multiple_information: false, description: $made_for_you, play: true);

		$folderPath = $_SERVER['DOCUMENT_ROOT']."/soundwave.loc/public_html/img/recently-played";
		$recently_played_song_names = ["Yearmix 2020", "Crystalize", "Kad Bi Se Moga Rodit", "Big Mouth Strikes Again", "Kiss Me, Kiss Me, Kiss Me", "Female Vocal Trance Anthems", "Every You Every Me", "Lighter Than Air", "Tuvan", "I Would've Stayed"];
		$recently_played_artists = ["Aurosonic", "Stargazes & Fenna Day", "Hari Rončević", "The Smiths", "The Cure", "Various Artists", "Placebo", "Marlo, Feenixpawl", "Gaia", "Aurosonic"];
		$recently_played_released_on = ["25/12/2020", "01/11/2019", "10/04/2011", "06/16/1986", "01/01/1987", "06/29/2015", "10/12/1998", "04/26/2019", "11/02/2009", "07/31/2020"];

		GetSectionCarousel($folderPath, "Recently played",
			multiple_information: true,
			song_name: $recently_played_song_names,
			artist: $recently_played_artists,
			released: $recently_played_released_on
		);



		$folderPath = $_SERVER['DOCUMENT_ROOT']."/soundwave.loc/public_html/img/playlists-you'll-love";
		$playlists_you_ll_love_song_names = ["A State Of Trance Year Mix 2015", "Female Vocal Trance 2022", "Behind The Horizon", "Trance Top 1000 Selection, Vol.41", "Best of Uplifting Vocal Trance 2018", "Female Vocal Trance Anthems", "1 Year Suanda", "Progressive Hits, Vol. 1", "Beautiful Vocal Trance - Chapter 4", "A State Of Trance Episode 807"];
		$playlists_you_ll_love_artists = ["Armin van Buuren", "Various Artists", "Costa", "Various Artists", "Various Artists", "Various Artists", "Various Artists", "Various Artists", "Various Artists", "Armin van Buuren ASOT Radio"];
		$playlists_you_ll_love_released_on = ["12/18/2015", "03/04/2022", "11/19/2021", "07/15/2016", "09/07/2018", "06/29/2015", "05/05/2014", "03/13/2017", "10/18/2019", "03/30/2017"];

		GetSectionCarousel($folderPath, "Playlists You'll Love",
			multiple_information: true,
			song_name: $playlists_you_ll_love_song_names,
			artist: $playlists_you_ll_love_artists,
			released: $playlists_you_ll_love_released_on
		);

		echo '
		<section id="summer-is-here" class="channel__section">
	
			<div class="channel__title">
				<h3>Summer is Here</h3>
				<i class="icon-arrow-right"></i>
			</div>
	
			<p class="channel__desc">Discover your summer soundtrack</p>
			<div id="seasonal-section" class="channel__container g-450">
				<img class="season__img" src="'.SITE_URL.'img/summer-is-here/summer-l.jpg" alt="">
				<img class="season__img" src="'.SITE_URL.'img/summer-is-here/summer-r.jpg" alt="">
			</div>
	
		</section>';

		$folderPath = $_SERVER['DOCUMENT_ROOT']."/soundwave.loc/public_html/img/new-releases-for-you";
		$new_releases_for_you_song_names = ["Starts Right Now", "Don’t You Worry", "Supernova", "Life Is Yours", "The Phoenix", "Data Renaissance", "Scoring The End Of The World", "New Mythology", "C’MON YOU KNOW (Deluxe Edition)", "Warm Chris"];
		$new_releases_for_you_artists = ["Chasner", "The Black Eyed Peas", "Nova Twins", "Foals", "Grey Daze", "The Algorithm", "Motionless In White", "Nick Mulvey", "Liam Gallagher", "Aldous Harding"];
		$new_releases_for_you_released_on = ["17/06/2022", "19/06/2022", "21/06/2022", "14/06/2022", "17/06/2022", "03/06/2022", "10/06/2022", "10/06/2022", "27/05/2022", "01/01/2021"];

		GetSectionCarousel($folderPath, "New Releases For You",
			multiple_information: true,
			song_name: $new_releases_for_you_song_names,
			artist: $new_releases_for_you_artists,
			released: $new_releases_for_you_released_on
		);

		$podcasts_categories_data = getCategoryDataFromClass("PlaylistCategories");
		GetCardWtihTextCarousel($podcasts_categories_data, "Playlist Categories");

		$folderPath = $_SERVER['DOCUMENT_ROOT']."/soundwave.loc/public_html/img/artists";
		$artists_names = ["Nirvana", "Deep Purple", "ATB", "Paul van Dyk", "Dash Berlin", "Above & Beyond", "Iron Maiden", "ABBA", "Guns N’ Roses", "AC/DC"];
		$artists_number_of_fans = ["8,512,857", "1,522,146", "285,558", "426,957", "427,999", "282,796", "3,044,857", "2,211,472", "7,122,211", "8,277,607"];

		GetSectionCarousel($folderPath, "Artists",
			multiple_information: true,
			artist: $artists_names,
			description: $artists_number_of_fans,
			rounded: "border-circle"
		);

		$podcasts_categories_data = getCategoryDataFromClass("Genres");
		GetCardWtihTextCarousel($podcasts_categories_data, "Genres");

		echo '
		<section class="quote">
			<img class="quote__img-left" src="img/decorations/blue-soundbar.svg" alt="">
			<img class="quote__img-right" src="img/decorations/pink-soundbar.svg" alt="">
			<h4 class="quote__text"><span class="text-primary-100">Music</span> is the universal language of mankind - <span class="text-secondary-100">Henry Wadsworth Longfellow</span></h4>
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