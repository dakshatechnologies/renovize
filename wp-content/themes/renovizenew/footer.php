<div id="footer" class="container">
	<div class="row">
		<?php dynamic_sidebar( 'va-footer' ); ?>
	</div>
</div>
<div id="post-footer" class="container">
	<div class="row">
		<?php wp_nav_menu( array(
			'container' => false,
			'theme_location' => 'footer',
			'fallback_cb' => false
		) ); ?>

		<div id="theme-info">
© Copyright 2014, Renovize. All Rights Reserved. <a href="http://renovize.dakshahost.com/terms-and-conditions/">Terms of Use</a> |<a href="#">Privacy Policy</a></div>
	</div>
</div>
