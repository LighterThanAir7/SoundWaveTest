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
<style>
	.js-fillcolor {
    	padding: 3em;
    	margin: 1em;
	}
	.js-fillcolor img {
		width: 250px;
		height: 250px;
	}
</style>
<main class="page-content">
	<div class="channel">
	
		<section id="new_releases_for_you">';
			//$new_releases_for_you_data = GetNewReleasedForYouData();
			//NewGetSectionCarousel($new_releases_for_you_data, "New Releases For You");
		echo '
		</section>
		
		<div class="example js-fillcolor">
		  <img width="200" height="200" src="https://unsplash.it/200/200/?image=10">
		</div>
		<div class="example js-fillcolor">
		  <img width="200" height="200" src="https://unsplash.it/200/200/?image=20">
		</div>
		<div class="example js-fillcolor">
		  <img width="200" height="200" src="https://unsplash.it/200/200/?image=100">
		</div>
		<div class="example js-fillcolor">
		  <img width="200" height="200" src="https://unsplash.it/200/200/?image=99">
		</div>
		<div class="example js-fillcolor">
		  <img width="200" height="200" src="https://unsplash.it/200/200/?image=113">
		</div>
		<div class="example js-fillcolor">
		  <img width="200" height="200" src="https://unsplash.it/200/200/?image=155">
		</div>
	</div>
</main>
<script >
	$(function () {
	  $(\'.js-fillcolor\').fillColor();
	});
</script>
';

include "includes/footer_inc.php";