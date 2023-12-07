<?php

require_once "config.php";

$page_title = "Favourites";
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
	<div class="channel">
	
		<section id="favourites" class="flex items-center justify-between mb-700">
			<header class="favourites__header">
				<div class="flex items-center g-700">
					<img class="favourites__profile-img" src="'.SITE_URL.'img/artists/3.jpg" alt="">
					<div>
						<h2 class="favourites__profile-name">Lighter Than Air</h2>
						<p class="favourites__joined-text">Joined: <span>March, 2013</span></p>
						<p class="favourites__followers-text"><span>2147 </span> followers - <span>627</span> following</p>
						<a class="btn btn--base" href="">Play Something</a>
					</div>
				</div>
				<div class="favourites__highlights-container text-right">
					<h3 class="favourites__highlights">Highlights</h3>
					<ul class="favourites__highlights-list">
					<!-- Napraviti funkcionalnost za isčitavanje ukupnog broja itema -->
						<li class="favourites__highlights-item">
							<p>Highlights</p>
						</li>
						<li class="favourites__highlights-item">
							<p>Favourite Tracks </p><span>117</span>
						</li>
						<li class="favourites__highlights-item">
							<p>Playlists </p><span>70</span>
						</li>
						<li class="favourites__highlights-item">
							<p>Albums </p><span>97</span
						</li>
						<li class="favourites__highlights-item">
							<p>Artists </p><span>82</span>
						</li>
						<li class="favourites__highlights-item">
							<p>Podcasts </p><span>43</span>
						</li>
					</ul>
				</div>
			</header>
		</section>
		
		<!----------------------------| #1 - FAVOURITES SECTION |---------------------------------->
		<!----------------------------------------------------------------------------------------->
		
		
		<section class="mb-900">
			<div class="channel__title mb-450">
				<!-- Napraviti funkcionalnost za isčitavanje ukupnog broja itema -->
				<h3><span class="text-primary-100">117</span> Favourite Tracks</h3>
				<i class="icon-arrow-right"></i>
			</div>
			
			<div class="favourite-tracks">
				<div class="favourite-tracks__artwork"><i class="icon-image-add-line"></i></div>
				<div class="favourite-tracks__track-title">Track Title</div>
				<div class="favourite-tracks__artist">Artist</div>
				<div class="favourite-tracks__album">Album</div>
				<div class="favourite-tracks__released-on">Added</div>
				<div class="favourite-tracks__time">Time</div>
				<div class="favourite-tracks__genre">Genre</div>
				<div class="favourite-tracks__select">
					<i class="icon-dots"></i>
				</div>
			</div>';

			// Za Testing svrhe ću za sada samo izvući podatke iz songs tablice...
			// input parametar bi bio >> id_user <<

//			$favourite_tracks_array = getFavouriteTracksForUser();

			require_once "admin/inc/Songs.class.php";
			require_once "admin/inc/MysqlDB.class.php";

			$songs = new Songs();

			$favourite_tracks_array = $songs->List(1, $search = NULL);

			echo '
			<ul class="favourite-tracks__list">';
			foreach ($favourite_tracks_array as $track) {
				echo '
				<div class="favourite-tracks__item">
					<img class="favourite-tracks__artwork" src="'.SITE_URL.'admin/doc/artworks/50x50/'.$track['filename'].'" alt="'.$track['filename'].'">
					<p class="favourite-tracks__track-title">'.$track['title'].'</p>
					<p class="favourite-tracks__artist">'.$track['main_artist'].'</p>
					<p class="favourite-tracks__album">'.$track['album'].'</p>
					<p class="favourite-tracks__released-on">'.(new DateTime($track['released_on']))->format('d/m/Y').'</p>
					<p class="favourite-tracks__time">'.$track['duration'].'</p>
					<p class="favourite-tracks__genre">'.$track['genre_names'].'</p>
					<div class="favourite-tracks__select">
						<label class="custom-checkbox">
							<input type="checkbox" class="hidden-checkbox">
							<span class="checkbox-icon"></span>
						</label>
					</div>
				</div>';
			}
			echo '
			</ul>
		</section>';

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

		$folderPath = $_SERVER['DOCUMENT_ROOT']."/soundwave.loc/public_html/img/artists";
		$artists_names = ["Nirvana", "Deep Purple", "ATB", "Paul van Dyk", "Dash Berlin", "Above & Beyond", "Iron Maiden", "ABBA", "Guns N’ Roses", "AC/DC"];
		$artists_number_of_fans = ["8,512,857", "1,522,146", "285,558", "426,957", "427,999", "282,796", "3,044,857", "2,211,472", "7,122,211", "8,277,607"];

		GetSectionCarousel($folderPath, "Artists",
			multiple_information: true,
			artist: $artists_names,
			description: $artists_number_of_fans,
			rounded: "border-circle"
		);

		$folderPath = $_SERVER['DOCUMENT_ROOT']."/soundwave.loc/public_html/img/podcasts-page/you-might-love";
		GetSectionCarouselWithTitles($folderPath, "You Might Love");

		echo '
		<section class="quote">
			<img class="quote__img-left" src="img/decorations/blue-soundbar.svg" alt="">
			<img class="quote__img-right" src="img/decorations/pink-soundbar.svg" alt="">
			<h4 class="quote__text"><span class="text-primary-100">Music</span> is enough for a <span class="text-primary-100">lifetime</span> but a <span class="text-primary-100">lifetime</span> is not enough for music - <span class="text-secondary-100">Sergei Rachmaninoff</span></h4>
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