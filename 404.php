<?php get_header(); ?>

<div class="content">

	<?php get_template_part('inc/page-title'); ?>
	
	<div class="pad group">		
		
		<div class="notebox">
			<?php get_search_form(); ?>
		</div>
		
		<div class="entry">
			<p><?php esc_html_e( 'The page you are trying to reach does not exist, or has been moved. Please use the menus or the search box to find what you are looking for.', 'typecore' ); ?></p>
		</div>
		
	</div><!--/.pad-->
	
</div><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>