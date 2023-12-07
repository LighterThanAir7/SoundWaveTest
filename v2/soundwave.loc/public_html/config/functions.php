<?php
// Custom functions goes here...

/**
 * @param $key
 * @return string
 */
function GetHorizontalScrollMessage($key): string {
	$messages = array('Stream your favourite music', 'Brand values', 'Discover more');
	$message = $messages[$key];

	$output =
	'<div class="auto__scroll">
		<p class="auto__scroll__text">'.$message.'&nbsp&nbsp'.$message.'&nbsp&nbsp'.$message.'&nbsp&nbsp'.$message.'</p>
	</div>';

	return $output;
}

function sortByNumericValue($a, $b) {
	$aValue = (int)basename($a, '.jpg');
	$bValue = (int)basename($b, '.jpg');
	return $aValue - $bValue;
}

function GetSectionCarouselWithTitles($folder_path, $title): void
{
	$basePath = 'C:/xampp/htdocs/soundwave.loc/public_html/';
	$trimmedPath = str_replace($basePath, '', $folder_path);

	$files = scandir($folder_path);
	$files = array_diff($files, array('.', '..'));
	$files = array_values($files);

	usort($files, 'sortByNumericValue');
	$img_folder = str_replace(" ", "-", strtolower($title));

	echo '
	<section class="channel__section carousel-section">
		<div class="channel__container">
			<div class="channel__title">
				<h3>'.$title.'</h3>
				<i class="icon-arrow-right"></i>
			</div>
			<div class="channel__section-arrows">
				<i class="icon-arrow-left" @click="scrollCarousel(-1)"></i>
				<i class="icon-arrow-right" @click="scrollCarousel(1)"></i>
			</div>
		</div>
		<div class="wrapper">
			<ul class="carousel">';

			foreach ($files as $key => $path) {
				echo '
				<li class="carousel__card">
					<div class="carousel__img">
						<img class="" src="'.SITE_URL.$trimmedPath.'/'.$path.'" alt="" draggable="false">
					</div>
					<p class="carousel__p">'.pathinfo($path, PATHINFO_FILENAME).'</p>
				</li>';
			}
			echo '
			</ul>
		</div>
	</section>';
}


function GetSectionCarousel($folder_path, $title, $multiple_information, $song_name = null, $artist = null, $released = null, $description = null, $play = null, $text_over_img_centered = null, $rounded = null): void
{
//	echo '<pre>';
//	print_r($folder_path);
//	echo '</pre>';
	$files = scandir($folder_path);
	$files = array_diff($files, array('.', '..'));
	$files = array_values($files);

	usort($files, 'sortByNumericValue');
	
	$img_folder = str_replace(" ", "-", strtolower($title));

	echo '
	<section class="channel__section carousel-section">
		<div class="channel__container">
			<div class="channel__title">
				<h3>'.$title.'</h3>
				<i class="icon-arrow-right"></i>
			</div>
			<div class="channel__section-arrows">
				<i class="icon-arrow-left"></i>
				<i class="icon-arrow-right"></i>
			</div>
		</div>
		<div class="wrapper">
			<carousel></carousel>
			<ul class="carousel">';

			foreach ($files as $key => $path) {
				echo '
				<li class="carousel__card">
					<div class="carousel__img">
						<img class="'.$rounded.'" src="'.SITE_URL.'img/'.$img_folder.'/'.$path.'" alt="" draggable="false">';

						if(!$multiple_information) {
							if($play !== null) {
								echo '
								<i class="icon-play icon-centered"></i>';
							}

							if($text_over_img_centered) {
								echo '
								<p class="carousel__p carousel__p--centered">'.$description[$key].'</p>
								</div>';
							} else {
								echo '
								</div>
								<p class="carousel__p">'.$description[$key].'</p>';
							}
						} else {
								echo '
								<!--<i class="icon-play"></i>-->
							</div>';
							if ($song_name == null) {
								echo '
								<p class="carousel__artist text-center text-300">'.$artist[$key].'</p>
								<p class="carousel__released-on text-center">'.$description[$key].' fans</p>';
							} else {
								echo '
							<p class="carousel__song-name">'.$song_name[$key].'</p>
							<p class="carousel__artist">by '.$artist[$key].'</p>
							<p class="carousel__released-on">Released On '.$released[$key].'</p>';
							}
						}
				echo '
				</li>';
			}
			echo '
			</ul>
		</div>
	</section>';
}

function NewGetSectionCarousel($array, $title): void
{
//	echo '<pre>';
//	print_r($array);
//	echo '</pre>';

	echo '
	<section class="channel__section carousel-section">
		<div class="channel__container">
			<div class="channel__title">
				<h3>'.$title.'</h3>
				<i class="icon-arrow-right"></i>
			</div>
			<div class="channel__section-arrows">
				<i class="icon-arrow-left"></i>
				<i class="icon-arrow-right"></i>
			</div>
		</div>
		<div class="wrapper">
			<ul class="carousel">';
	
				for ($counter = 0; $counter <= 19; $counter++) {
					echo '
					<li class="carousel__card">
						<div class="carousel__img">
							<img src="'.$array["artwork_img"][$counter].'" alt="" draggable="false">
						</div>
						<p class="carousel__song-name">'.$array["song_name"][$counter].'</p>
						<p class="carousel__artist">by '.$array["artist"][$counter].'</p>
						<p class="carousel__released-on">Released On '.$array["released_on"][$counter].'</p>';
					echo '
					</li>';
				}
			echo '
			</ul>
		</div>
	</section>';
}

function GetNewReleasedForYouData(): array
{
	require_once 'admin/inc/MysqlDB.class.php';
	require_once 'admin/inc/Songs.class.php';

	$songs = new Songs();
	$songs_array = $songs->List();

	$artwork_img = [];
	$song_name   = [];
	$artist_name = [];
	$released_on = [];

	foreach ($songs_array as $song) {
		$artwork_img[] 	= $song["artwork_img"];
		$song_name[] 	= $song["title"];
		$artist_name[] 	= $song["artist"];
		$released_on[] 	= $song["released_on"];
	}

	return [
		"artwork_img" => $artwork_img,
		"song_name"   => $song_name,
		"artist" => $artist_name,
		"released_on"  => $released_on
	];
}

function getCategoryDataFromClass($className): array
{
	require_once 'admin/inc/MysqlDB.class.php';
	require_once 'admin/inc/'.$className.'.class.php';

	$data = new $className();
	$array = $data->List();

	$name  = [];
	$img   = [];

	foreach ($array as $item) {
		$name[]= $item["name"];
		$img[] = $item["img"];
	}

	return [
		"name" 	=> $name,
		"img" => $img,
	];
}

function GetCardWtihTextCarousel($array, $title): void
{
	echo '
	<section class="channel__section carousel-section">
		<div class="channel__container">
			<div class="channel__title">
				<h3>' . $title . '</h3>
				<i class="icon-arrow-right"></i>
			</div>
			<div class="channel__section-arrows">
				<i class="icon-arrow-left"></i>
				<i class="icon-arrow-right"></i>
			</div>
		</div>
		<div class="wrapper">
			<ul class="carousel">';

			foreach ($array["name"] as $index => $category) {
				$categoryImg = $array["img"][$index];
				echo '
				<li class="carousel__card">
					<div class="carousel__img">
						<img class="" src="'.SITE_URL.'/admin/'.$categoryImg.'" alt="" draggable="false">
						<p class="carousel__p carousel__p--centered">'.$category.'</p>
					</div>
				</li>';
			}
		echo '
		</ul>
		
	</section>';
}
?>