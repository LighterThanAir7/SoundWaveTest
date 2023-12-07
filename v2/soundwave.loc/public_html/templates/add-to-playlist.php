<?php

$playlist_items = [
	'Trance Favourites',
	'Classic Rock',
	'Driving Mix',
	'Studying',
	'Workout',
	'Runnin in the Rain',
	'Nostalgia Trip',
	'Party Mix',
	'Najljepše Ljubavne',
	'House Mix',
	'Late Night Vibes'
];

echo '
<div class="add-to-playlist">
	<div class="add-to-playlist__header">
		<span class="add-to-playlist__title">Add to playlist</span>
		<i class="icon-plus" onclick="toggleCreateNewPlaylist()"></i>
	</div>
	<ul class="add-to-playlist__list">';
		foreach ($playlist_items as $item) {
			echo '
			<li class="add-to-playlist__item">
				<label class="custom-checkbox">
					<input type="checkbox" class="hidden-checkbox">
					<span class="checkbox-icon mr-400"></span>
					<span>'.$item.'</span>
				</label>
			</li>';
		}
		echo '
	</ul>
	<div class="add-to-playlist__bottom-button">Done</div>
</div>
';

?>