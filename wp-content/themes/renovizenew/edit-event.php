<?php appthemes_display_checkout(); ?>

<?php if ( is_active_sidebar( 'edit-event' ) ) : ?>
	<div id="sidebar">
		<?php appthemes_before_sidebar_widgets(); ?>

		<?php dynamic_sidebar( 'edit-event' ); ?>

		<?php appthemes_after_sidebar_widgets(); ?>
	</div>
<?php endif;
