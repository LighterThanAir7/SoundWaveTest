<?php

echo '
<footer class="footer '.$footer_soundbars.'">
	<div class="footer__row mb-900">
		<div class="footer__links">';

		$footer__links = [
			['Get Started', 'Download App', 'Pricing & Plans', 'Playlist Import', 'Supported Devices'],
			['Discover More', 'About Us', 'Explore The App', 'Culture', 'Originals'],
			['Account', 'Sign Up', 'Redeem Giftcard', 'Store', 'Support'],
			['Company', 'About us', 'Partners', 'Carrers', 'Press']
		];

		foreach ($footer__links as $links_column) {
			echo '
			<ul class="footer__list">';
			foreach ($links_column as $link) {
				echo '
				<li><a class="footer__link" href="">'.$link.'</a></li>';
			}
			echo '</ul>';
		}
		echo '
		</div>
		<div class="footer-quote">
			<div class="footer-quote__decoration"></div>
			<p class="footer-quote__text">Music is everybodys possession. It\'s only publishers who think that people own it.</p>
			<p class="footer-quote__author">- John Lennon</p>
			<a class="btn btn--base btn--block" href="index.php?what=page-login">Join Now</a>
		</div>
	</div>
	<div class="footer__row items-center mb-850">
		<p class="footer__terms-of-use">SoundWave Eget senectus volutpat nibh ut vitae ullamcorper. Etiam sit arcu
			facilisis porta. Pellentesque fringilla gravida urna in adipiscing quam nisl massa. Id donec
			habitasse aliquet tortor in. Vulputate facilisi aliquet senectus tincidunt</p>
		<div class="socials">
			<i class="icon-facebook"></i>
			<i class="icon-twitter"></i>
			<i class="icon-instagram"></i>
			<i class="icon-youtube"></i>
			<i class="icon-tiktok"></i>
		</div>
	</div>
</footer>';