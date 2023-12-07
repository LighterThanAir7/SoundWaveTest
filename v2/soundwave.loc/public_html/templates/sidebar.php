<?php

$sidebar_menu = [
	['icon'  => 'music-note',
	 'title' => 'Music'],
	['icon'  => 'podcasts',
	 'title' => 'Podcasts'],
	['icon'  => 'explore',
	 'title' => 'Explore'],
	['icon'  => 'heart_outline',
	 'title' => 'Favourites'],
];

echo '
<aside class="sidebar">
	<div>
		<a class="sidebar__logo" href="index.php?what=page-home">
			<i class="icon-logo"></i>
			<span>SoundWave</span>
		</a>

		<nav class="sidebar__list">';

		foreach ($sidebar_menu as $item) {
			$isActive = ($page_title === $item['title']);

			echo '<a href="index.php?what=page-'.strtolower($item['title']).'" class="sidebar__item ' . ($isActive ? 'sidebar__item--active' : '') . '"><i class="z-100 icon-' . $item['icon'] . '"></i><span class="z-100">' . $item['title'] . '</span></a>';
		}
		echo '
		</nav>
	</div>
	
	<div class="player">
		<div class="player__heading">
			<span class="player__playing">Now Playing</span>
			<div class="player__top-icons">
				<i class="icon-share mr-150"></i>
				<i class="icon-plus" onclick="toggleAddToPlaylist()"></i>
			</div>';
			include "add-to-playlist.php";
			include "new-playlist.php";
			echo '
		</div>
		
		<div class="player__artwork">
			<img src="'.SITE_URL.'img/artworks/Test.png" alt="">
			<div class="player__lyrics"></div>
		</div>
		
		<div class="flex items-center justify-between g-150 mb-500">
			<div class="player__song-info">
				<p class="player__song-title">All I Need</p>
				<p class="player__artist">Aurosonic & Frainbreeze</p>
			</div>
			<div class="player__more-info">
				<i class="icon-info_outline"></i>';
				include 'more-info.php';
				echo '
				<i id="player__add-to-favourite" class="icon-heart_outline"></i>
			</div>
		</div>

		<div class="player__progress-area">
			<div class="player__progress-bar"></div>
		</div>
		
		<div class="player__time">
			<span class="player__time-current">0:00</span>
			<span class="player__time-duration">0:00</span>
		</div>
		
		<audio id="main-audio" src=""></audio>
		
		
		<div class="player__primary-controls">';
			include 'shuffle.php';
			echo '
			<i class="icon-shuffle"></i>
			<div class="player__primary-controls-middle">
				<i id="previousBtn" class="icon-previous"></i>';
				include 'previous-song.php';
				echo '
				<i id="playPauseBtn" class="icon-play"></i>
				<i id="nextBtn" class="icon-next"></i>';
				include 'next-song.php';
				echo '
			</div>';
			include "repeat.php";
			echo '
			<i class="icon-repeat"></i>
		</div>
		
		<div class="player__bottom-controls">
			<i class="icon-queue_music"></i>';
			include "queue.php";
			echo '
			<i class="icon-lyrics"></i>';
			include "lyrics.php";
			echo '
			<i class="icon-download"></i>
			<i class="icon-volume-medium"></i>';
			include "volume.php";
			echo '
		</div>
	</div>
</aside>
';