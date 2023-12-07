<?php

$nav = [
	[
		'category' => 'About',
		'items' => ['Explore', 'Pricing']
	],
	[
		'category' => 'Support',
		'items' => ['Download', 'Import', 'Devices', 'Help']
	]
];

echo '
<header>
	<nav class="nav">
		<a class="nav__logo" href="index.php?what=page-home"><i class="icon-logo"></i><span>SoundWave</span></a>
		<ul class="nav__list">';
		foreach ($nav as $categoryItem) {
			echo '
			<li class="nav__item">
				<a class="nav__link" href="index.php?what=page-about">'.$categoryItem['category'].'</a>
				<ul class="dropdown">';
				foreach ($categoryItem['items'] as $menuItem) {
					echo '
					<li class="dropdown__item">
						<a class="dropdown__link" href="#">'.$menuItem.'</a>
					</li>';
					}
					echo '
				</ul>
			</li>';
			}
			echo '
			<li class="nav__item">';
			if ($page_title === "About" || $page_title === "Login") {
				echo '<a class="nav__link nav__link--button" href="index.php?what=page-home">Home</a>';
			} else {
				echo '<a class="nav__link nav__link--button" href="index.php?what=page-login">Join Now</a>';
			}
			echo '
			</li>
		</ul>
	</nav>
</header>';

?>