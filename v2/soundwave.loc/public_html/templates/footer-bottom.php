<?php

$languages = ["English", "Български", "Český", "Français", "Hrvatski", "Italiano", "Chinese", "Norsk", "Polski", "Português", "Slovenščina", "Srpski"];

if ($page_title === "Login") {
	echo '
	<footer class="footer-bottom footer-bottom--absolute bg-transparent">';
} else {
	echo '
	<footer class="footer-bottom">';
}
	echo '
	<div class="footer-bottom__company">
		<a class="footer-bottom__logo" href="index.php?what=page-home"><i class="icon-logo"></i></a>
		<span class="footer-bottom__copyright">© 2022 SoundWave LLC</span>
	</div>';

	$footer_bottom_links = array('Privacy', 'Terms', 'Accessibility', 'Contact');
	$footer_bottom_links_classes = [];

	foreach ($footer_bottom_links as $link) {
		$footer_bottom_links_classes[] = strtolower($link);
	}

	echo '
		<ul class="footer-bottom__list">';
		foreach ($footer_bottom_links as $link) {
			echo '
			<li><a class="footer__link" href="">'.$link.'</a></li>';
		}
		echo '
		<li>
			<button class="language-picker"><i class="icon-language"></i><span>Language</span>
				<ul class="language-picker__menu">';
				foreach ($languages as $language) {
					echo '<li>'.$language.'</li>';
				}
				echo '
				</ul>
			</button>
		</li>
	</ul>
</footer>';