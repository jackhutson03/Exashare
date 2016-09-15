<div id="footer" class="container">
	<div class="row">
		<?php appthemes_before_sidebar_widgets( 'va-footer' ); ?>

		<?php dynamic_sidebar( 'va-footer' ); ?>

		<?php appthemes_after_sidebar_widgets( 'va-footer' ); ?>
	</div>
</div>
<div id="post-footer" class="container">
	<div class="row">
		<?php wp_nav_menu( array(
			'container' => false,
			'theme_location' => 'footer',
			'fallback_cb' => false
		) ); ?>

		<div id="theme-info"><a href="http://webappsample.com/demo/exashare/" target="_blank" rel="nofollow">Exashare</a> &ndash; Design & Developed by <a href="http://www.opulenceinfotech.com/" target="_blank" rel="nofollow">Opulence InfoTech Pvt Ltd</a>.</div>
	</div>
</div>