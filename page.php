<?php get_header(); ?>

<div class="content">
	
	<?php get_template_part('inc/page-title'); ?>
	
	<div class="pad group">
		
		<?php while ( have_posts() ): the_post(); ?>
		
			<article <?php post_class('group'); ?>>
				
				<?php get_template_part('inc/page-image'); ?>
				
				<div class="entry themeform">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div><!--/.entry-->
				
			</article>
			
			<?php if ( comments_open() || get_comments_number() ) :	comments_template( '/comments.php', true ); endif; ?>
			
		<?php endwhile; ?>
		
	</div><!--/.pad-->
	
</div><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>