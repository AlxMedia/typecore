<div class="page-title pad group">

	<?php if ( is_home() ) : ?>
		<h2><?php echo typecore_blog_title(); ?></h2>

	<?php elseif ( is_single() ): ?>
		<ul class="meta-single group">
			<li class="category"><?php the_category(' <span>/</span> '); ?></li>
			<?php if ( comments_open() && ( get_theme_mod( 'comment-count','on' ) == 'on' ) ): ?>
			<li class="comments"><a href="<?php comments_link(); ?>"><i class="fas fa-comments"></i><?php comments_number( '0', '1', '%' ); ?></a></li>
			<?php endif; ?>
		</ul>
		
	<?php elseif ( is_page() ): ?>
		<h2><?php the_title(); ?></h2>

	<?php elseif ( is_search() ): ?>
		<h1>
			<?php if ( have_posts() ): ?><i class="fas fa-search"></i><?php endif; ?>
			<?php if ( !have_posts() ): ?><i class="fas fa-exclamation-circle"></i><?php endif; ?>
			<?php $search_results=$wp_query->found_posts;
				if ($search_results==1) {
					echo $search_results.' '.esc_html__('Search result','typecore');
				} else {
					echo $search_results.' '.esc_html__('Search results','typecore');
				}
			?>
		</h1>
		
	<?php elseif ( is_404() ): ?>
		<h1><i class="fas fa-exclamation-circle"></i><?php esc_html_e('Error 404.','typecore'); ?> <span><?php esc_html_e('Page not found!','typecore'); ?></span></h1>
		
	<?php elseif ( is_author() ): ?>
		<?php $author = get_userdata( get_query_var('author') );?>
		<h1><i class="far fa-user"></i><?php esc_html_e('Author:','typecore'); ?> <span><?php echo $author->display_name;?></span></h1>
		
	<?php elseif ( is_category() ): ?>
		<h1><i class="far fa-folder"></i><?php esc_html_e('Category:','typecore'); ?> <span><?php echo single_cat_title('', false); ?></span></h1>

	<?php elseif ( is_tag() ): ?>
		<h1><i class="fas fa-tags"></i><?php esc_html_e('Tagged:','typecore'); ?> <span><?php echo single_tag_title('', false); ?></span></h1>
		
	<?php elseif ( is_day() ): ?>
		<h1><i class="far fa-calendar"></i><?php esc_html_e('Daily Archive:','typecore'); ?> <span><?php echo esc_html( get_the_time('F j, Y') ); ?></span></h1>
		
	<?php elseif ( is_month() ): ?>
		<h1><i class="far fa-calendar"></i><?php esc_html_e('Monthly Archive:','typecore'); ?> <span><?php echo esc_html( get_the_time('F Y') ); ?></span></h1>
			
	<?php elseif ( is_year() ): ?>
		<h1><i class="far fa-calendar"></i><?php esc_html_e('Yearly Archive:','typecore'); ?> <span><?php echo esc_html( get_the_time('Y') ); ?></span></h1>
	
	<?php else: ?>
		<h2><?php the_title(); ?></h2>
	
	<?php endif; ?>

</div><!--/.page-title-->