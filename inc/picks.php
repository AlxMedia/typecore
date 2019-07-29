<?php
// Query picks entries
$picks = new WP_Query(
	array(
		'no_found_rows'				=> false,
		'update_post_meta_cache'	=> false,
		'update_post_term_cache'	=> false,
		'ignore_sticky_posts'		=> 1,
		'posts_per_page'			=> 2,
		'cat'						=> get_theme_mod('picks-category','')
	)
);
?>

<?php if ( ( get_theme_mod('picks','on') =='on')&& $picks->have_posts() ): ?>
	
		<div class="picks group">
			<h2><i class="fas fa-bookmark"></i> <?php esc_html_e('Editor Picks','typecore'); ?></h2>
			<div class="picks-row group">
				<?php while ( $picks->have_posts() ): $picks->the_post(); ?>
					<?php get_template_part('content-picks'); ?>
				<?php endwhile; ?>	
			</div>
		</div>

<?php endif; ?>

<?php wp_reset_postdata(); ?>
