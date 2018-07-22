<?php 
	$sidebar = typecore_sidebar_primary();
	$layout = typecore_layout_class();
	if ( $layout != 'col-1c'):
?>
	
	<div class="sidebar s1 <?php if ( get_theme_mod( 'light', 'off' ) != 'on' ) echo 'dark'; ?>">
		
		<a class="sidebar-toggle" title="<?php esc_attr_e('Expand Sidebar','typecore'); ?>"><i class="fa icon-sidebar-toggle"></i></a>
		
		<div class="sidebar-content">
			
			<?php if ( get_theme_mod( 'post-nav','s1' ) == 's1') { get_template_part('inc/post-nav'); } ?>
			
			<?php if( is_page_template('page-templates/child-menu.php') ): ?>
			<ul class="child-menu group">
				<?php wp_list_pages('title_li=&sort_column=menu_order&depth=3'); ?>
			</ul>
			<?php endif; ?>
			
			<?php dynamic_sidebar($sidebar); ?>
			
		</div><!--/.sidebar-content-->
		
	</div><!--/.sidebar-->

	<?php if (
		( $layout == 'col-3cm' ) ||
		( $layout == 'col-3cl' ) ||
		( $layout == 'col-3cr' ) )
		{ get_template_part('sidebar-2'); } 
	?>
	
<?php endif; ?>