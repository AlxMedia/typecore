<?php $sidebar = typecore_sidebar_secondary(); ?>

<div class="sidebar s2">
	
	<a class="sidebar-toggle" title="<?php esc_attr_e('Expand Sidebar','typecore'); ?>"><i class="fa icon-sidebar-toggle"></i></a>
	
	<div class="sidebar-content">
			
		<?php if ( get_theme_mod( 'post-nav','s1' ) == 's2') { get_template_part('inc/post-nav'); } ?>
		
		<?php dynamic_sidebar($sidebar); ?>
		
	</div><!--/.sidebar-content-->
	
</div><!--/.sidebar-->