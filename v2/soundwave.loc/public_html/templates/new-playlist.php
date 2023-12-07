<?php

echo '
<div id="new-playlist" class="add-to-playlist new-playlist">
	<div class="add-to-playlist__header">
		<span class="add-to-playlist__title">New Playlist</span>
		<i class="icon-x"></i>
	</div>
	
	<div class="pl-400 pr-400">
		<input id="new-playlist-title" class="text-input mt-400 mb-400" name="new-playlist-title" type="text" placeholder="Title">
		
		<div class="flex justify-between items-center mb-500">
			<ul class="flex flex-col g-350">
				<li class="flex items-center g-300"><i class="icon-language"></i>Public</li>
				<li class="flex items-center g-300"><i class="icon-lock"></i>Private</li>
				<li class="flex items-center g-300"><i class="icon-users"></i>Collaborate</li>
			</ul>
			<div class="browse-picture">
				<i class="browse-picture__inner icon-image-add-line"></i>
			</div>
		</div>
		
		<label class="block mb-200" for="new-playlist-description">Description</label>
		<textarea class="textarea" name="new-playlist-description" id="new-playlist-description" placeholder="Enter playlist description..."></textarea>
	</div>
	
	<div class="add-to-playlist__bottom-button">Create</div>
</div>
';

?>
