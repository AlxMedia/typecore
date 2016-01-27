<?php if ( is_home() && !is_paged() && ot_get_option('frontpage-widgets-top') == 'on' ): ?>
	<div class="front-widgets group">

		<div class="front-widget-col">
			<div class="front-widget-inner">
				<?php dynamic_sidebar( 'frontpage-top-1' ); ?>
			</div>
		</div>
		
		<div class="front-widget-col">
			<div class="front-widget-inner">
				<?php dynamic_sidebar( 'frontpage-top-2' ); ?>
			</div>
		</div>

	</div>
<?php endif; ?>