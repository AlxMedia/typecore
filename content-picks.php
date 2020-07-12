<article id="post-<?php the_ID(); ?>" <?php post_class('group'); ?>>	
	<div class="post-inner post-hover">
		
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php if ( has_post_thumbnail() ): ?>
					<?php the_post_thumbnail('typecore-small'); ?>
				<?php elseif ( get_theme_mod('placeholder','on') == 'on' ): ?>
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/thumb-small.png" alt="<?php the_title_attribute(); ?>" />
				<?php endif; ?>
				<?php if ( has_post_format('video') && !is_sticky() ) echo'<span class="thumb-icon small"><i class="fas fa-play"></i></span>'; ?>
				<?php if ( has_post_format('audio') && !is_sticky() ) echo'<span class="thumb-icon small"><i class="fas fa-volume-up"></i></span>'; ?>
				<?php if ( is_sticky() ) echo'<span class="thumb-icon small"><i class="fas fa-star"></i></span>'; ?>
			</a>
		</div><!--/.post-thumbnail-->
		
		<h3 class="post-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h3><!--/.post-title-->
		
		<div class="post-meta group">
			<p class="post-date"><?php the_time( get_option('date_format') ); ?></p>
		</div><!--/.post-meta-->
		
	</div><!--/.post-inner-->	
</article><!--/.post-->	