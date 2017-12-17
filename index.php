<?php get_header(); ?>

<div class="content">

	<?php get_template_part('inc/page-title'); ?>
	
	<div class="pad group">
		
		<?php get_template_part('inc/featured'); ?>
		<?php get_template_part('inc/front-widgets-top'); ?>
		
		<?php if ( have_posts() ) : ?>
		
			<?php if ( get_theme_mod('blog-standard','off') == 'on' ): ?>
				<?php while ( have_posts() ): the_post(); ?>
					<?php get_template_part('content-standard'); ?>
				<?php endwhile; ?>
			<?php else: ?>
			<div class="post-list group">
				<?php $i = 1; echo '<div class="post-row">'; while ( have_posts() ): the_post(); ?>
					<?php get_template_part('content'); ?>
				<?php if($i % 2 == 0) { echo '</div><div class="post-row">'; } $i++; endwhile; echo '</div>'; ?>
			</div><!--/.post-list-->
			<?php endif; ?>
			
			<?php get_template_part('inc/front-widgets-bottom'); ?>
			<?php get_template_part('inc/pagination'); ?>
			<?php get_template_part('inc/picks'); ?>
			
		<?php endif; ?>
		
	</div><!--/.pad-->
	
</div><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>