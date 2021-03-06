
<div id="masthead" class="container">
	<div class="row"> 
		<hgroup>
			<?php va_display_logo(); ?>
		</hgroup>
		<?php if ( is_active_sidebar( 'va-header' ) ) : ?>
			<div class="advert">
				<?php dynamic_sidebar( 'va-header' ); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
<div id="main-navigation" class="container">
	<div class="row">
		<div id="rounded-nav-box" class="rounded">
			<div id="rounded-nav-box-overlay">
				<?php va_display_navigation_menu(); ?>
				<?php if ( false !== apply_filters('va_show_search_controls', true ) ) : ?>
                
                <div class="header-search-text"><h1>Find a <span>Local Construction Professional</span></h1>
        <p> Your #1 trusted source for residential,
commercial and industrial contractors.</p> </div>
      
                
				<form method="get" action="<?php echo trailingslashit( home_url() ); ?>">
					<div id="search-box">
						<div class="search-box">
							<label for="search-text">
								
								<?php do_action('va_search_for_above'); ?>
							</label>
							<input type="text" name="ls" id="search-text" placeholder="Type of Profession" class="search-box" value="<?php va_show_search_query_var( 'ls' ); ?>" />
								<input type="text" name="location" id="search-location" placeholder="City" class="search-box" value="<?php // va_show_search_query_var( 'location' ); ?>" />	
									<button type="submit" id="" class="search-btn"><?php _e( 'Search', APP_TD ); ?></button>
						</div>

						<!--<div class="search-location">
							<label for="search-location">
								<span class="search-title"><?php // _e( 'Near ', APP_TD ); ?></span><span class="search-help"><?php // _e( '(city, country)', APP_TD ); ?></span>
							</label>
							<div class="input-cont h39">
								<div class="left h39"></div>
								<div class="mid h39">
									<input type="text" name="location" id="search-location" class="text" value="<?php // va_show_search_query_var( 'location' ); ?>" />
								</div>
								<div class="right h39"></div>
							</div>
						</div>-->

					</div>
					<?php the_search_refinements(); ?>
				</form>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>



