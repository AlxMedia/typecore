<?php
/* ------------------------------------------------------------------------- *
 *  Custom functions
/* ------------------------------------------------------------------------- */
	
	// Use a child theme instead of placing custom functions here
	// http://codex.wordpress.org/Child_Themes


/* ------------------------------------------------------------------------- *
 *  Load theme files
/* ------------------------------------------------------------------------- */	

if ( ! function_exists( 'alx_load' ) ) {
	
	function alx_load() {
		// Load theme languages
		load_theme_textdomain( 'typecore', get_template_directory().'/languages' );
		
		// Load theme options and meta boxes
		include( get_template_directory() . '/functions/kirki/kirki.php' );
		include( get_template_directory() . '/functions/theme-options.php' );
		include( get_template_directory() . '/functions/meta-boxes.php' );
		
		// Load custom widgets
		include( get_template_directory() . '/functions/widgets/alx-tabs.php' );
		include( get_template_directory() . '/functions/widgets/alx-posts.php' );

		// Load dynamic styles
		include( get_template_directory() . '/functions/dynamic-styles.php' );
		
		// Load TGM plugin activation
		include( get_template_directory() . '/functions/class-tgm-plugin-activation.php' );
	}
	
}
add_action( 'after_setup_theme', 'alx_load' );	


/* ------------------------------------------------------------------------- *
 *  Base functionality
/* ------------------------------------------------------------------------- */
	
	// Content width
	if ( !isset( $content_width ) ) { $content_width = 720; }


/*  Theme setup
/* ------------------------------------ */
if ( ! function_exists( 'alx_setup' ) ) {
	
	function alx_setup() {		
		// Enable title tag
		add_theme_support( 'title-tag' );
		
		// Enable automatic feed links
		add_theme_support( 'automatic-feed-links' );

		// Enable featured image
		add_theme_support( 'post-thumbnails' );
		
		// Enable post format support
		add_theme_support( 'post-formats', array( 'audio', 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
		
		// Declare WooCommerce support
		add_theme_support( 'woocommerce' );
		
		// Thumbnail sizes
		add_image_size( 'typecore-small', 160, 160, true );
		add_image_size( 'typecore-standard', 320, 320, true );
		add_image_size( 'typecore-medium', 520, 245, true );
		add_image_size( 'typecore-large', 720, 340, true );

		// Custom menu areas
		register_nav_menus( array(
			'mobile' => 'Mobile',
			'topbar' => 'Topbar',
			'header' => 'Header',
			'footer' => 'Footer',
		) );
	}
	
}
add_action( 'after_setup_theme', 'alx_setup' );


/*  Deregister
/* ------------------------------------ */
if ( ! function_exists( 'alx_deregister' ) ) {
	
	function alx_deregister() {
		wp_deregister_style( 'wp-pagenavi' );
	}
	
}
add_action( 'wp_print_styles', 'alx_deregister', 100 );


/*  Register sidebars
/* ------------------------------------ */	
if ( ! function_exists( 'alx_sidebars' ) ) {

	function alx_sidebars()	{
		register_sidebar(array( 'name' => 'Primary','id' => 'primary','description' => "Normal full width sidebar", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
		register_sidebar(array( 'name' => 'Secondary','id' => 'secondary','description' => "Normal full width sidebar", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
		
		if ( get_theme_mod('header-ads') == 'on' ) { register_sidebar(array( 'name' => 'Header Ads','id' => 'header-ads', 'description' => "Header ads area", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		if ( get_theme_mod('footer-ads') == 'on' ) { register_sidebar(array( 'name' => 'Footer Ads','id' => 'footer-ads', 'description' => "Footer ads area", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		
		if ( get_theme_mod('frontpage-widgets-top') == 'on' ) { register_sidebar(array( 'name' => 'Frontpage Top 1','id' => 'frontpage-top-1', 'description' => "Frontpage area", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		if ( get_theme_mod('frontpage-widgets-top') == 'on' ) { register_sidebar(array( 'name' => 'Frontpage Top 2','id' => 'frontpage-top-2', 'description' => "Frontpage area", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		if ( get_theme_mod('frontpage-widgets-bottom') == 'on' ) { register_sidebar(array( 'name' => 'Frontpage Bottom 1','id' => 'frontpage-bottom-1', 'description' => "Frontpage area", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		if ( get_theme_mod('frontpage-widgets-bottom') == 'on' ) { register_sidebar(array( 'name' => 'Frontpage Bottom 2','id' => 'frontpage-bottom-2', 'description' => "Frontpage area", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }

		if ( get_theme_mod('footer-widgets') >= '1' ) { register_sidebar(array( 'name' => 'Footer 1','id' => 'footer-1', 'description' => "Widgetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		if ( get_theme_mod('footer-widgets') >= '2' ) { register_sidebar(array( 'name' => 'Footer 2','id' => 'footer-2', 'description' => "Widgetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		if ( get_theme_mod('footer-widgets') >= '3' ) { register_sidebar(array( 'name' => 'Footer 3','id' => 'footer-3', 'description' => "Widgetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		if ( get_theme_mod('footer-widgets') >= '4' ) { register_sidebar(array( 'name' => 'Footer 4','id' => 'footer-4', 'description' => "Widgetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
	}
	
}
add_action( 'widgets_init', 'alx_sidebars' );


/*  Enqueue javascript
/* ------------------------------------ */	
if ( ! function_exists( 'alx_scripts' ) ) {
	
	function alx_scripts() {
		wp_enqueue_script( 'typecore-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.min.js', array( 'jquery' ),'', false );
		wp_enqueue_script( 'typecore-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ),'', true );
		wp_enqueue_script( 'typecore-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ),'', true );
		if ( is_singular() && get_option( 'thread_comments' ) )	{ wp_enqueue_script( 'comment-reply' ); }
	}  
	
}
add_action( 'wp_enqueue_scripts', 'alx_scripts' ); 


/*  Enqueue css
/* ------------------------------------ */	
if ( ! function_exists( 'alx_styles' ) ) {
	
	function alx_styles() {
		wp_enqueue_style( 'typecore-style', get_stylesheet_uri() );
		if ( get_theme_mod('responsive','on') =='on' ) { wp_enqueue_style( 'typecore-responsive', get_template_directory_uri().'/responsive.css' ); }
		if ( get_theme_mod('custom','off') == 'on' ) { wp_enqueue_style( 'typecore-custom', get_template_directory_uri().'/custom.css' ); }
		wp_enqueue_style( 'typecore-font-awesome', get_template_directory_uri().'/fonts/font-awesome.min.css' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'alx_styles' );


/*  Register custom sidebars
/* ------------------------------------ */
if ( ! function_exists( 'alx_custom_sidebars' ) ) {

	function alx_custom_sidebars() {
		if ( !get_theme_mod('sidebar-areas') =='' ) {
			
			$sidebars = get_theme_mod('sidebar-areas', array());
			
			if ( !empty( $sidebars ) ) {
				foreach( $sidebars as $sidebar ) {
					if ( isset($sidebar['title']) && !empty($sidebar['title']) && isset($sidebar['id']) && !empty($sidebar['id']) && ($sidebar['id'] !='sidebar-') ) {
						register_sidebar(array('name' => ''.esc_attr( $sidebar['title'] ).'','id' => ''.esc_attr( strtolower($sidebar['id']) ).'','before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
					}
				}
			}
		}
	}
	
}
add_action( 'widgets_init', 'alx_custom_sidebars' );


/* ------------------------------------------------------------------------- *
 *  Template functions
/* ------------------------------------------------------------------------- */	

/*  Layout class
/* ------------------------------------ */
if ( ! function_exists( 'alx_layout_class' ) ) {
	
	function alx_layout_class() {
		// Default layout
		$layout = 'col-3cm';
		$default = 'col-3cm';

		// Check for page/post specific layout
		if ( is_page() || is_single() ) {
			// Reset post data
			wp_reset_postdata();
			global $post;
			// Get meta
			$meta = get_post_meta($post->ID,'_layout',true);
			// Get if set and not set to inherit
			if ( isset($meta) && !empty($meta) && $meta != 'inherit' ) { $layout = $meta; }
			// Else check for page-global / single-global
			elseif ( is_single() && ( get_theme_mod('layout-single') !='inherit' ) ) $layout = get_theme_mod('layout-single',''.$default.'');
			elseif ( is_page() && ( get_theme_mod('layout-page') !='inherit' ) ) $layout = get_theme_mod('layout-page',''.$default.'');
			// Else get global option
			else $layout = get_theme_mod('layout-global',''.$default.'');
		}
		
		// Set layout based on page
		elseif ( is_home() && ( get_theme_mod('layout-home') !='inherit' ) ) $layout = get_theme_mod('layout-home',''.$default.'');
		elseif ( is_category() && ( get_theme_mod('layout-archive-category') !='inherit' ) ) $layout = get_theme_mod('layout-archive-category',''.$default.'');
		elseif ( is_archive() && ( get_theme_mod('layout-archive') !='inherit' ) ) $layout = get_theme_mod('layout-archive',''.$default.'');
		elseif ( is_search() && ( get_theme_mod('layout-search') !='inherit' ) ) $layout = get_theme_mod('layout-search',''.$default.'');
		elseif ( is_404() && ( get_theme_mod('layout-404') !='inherit' ) ) $layout = get_theme_mod('layout-404',''.$default.'');
		
		// Global option
		else $layout = get_theme_mod('layout-global',''.$default.'');
		
		// Return layout class
		return $layout;
	}
	
}


/*  Dynamic sidebar primary
/* ------------------------------------ */
if ( ! function_exists( 'alx_sidebar_primary' ) ) {
	
	function alx_sidebar_primary() {
		// Default sidebar
		$sidebar = 'primary';

		// Set sidebar based on page
		if ( is_home() && get_theme_mod('s1-home') ) $sidebar = get_theme_mod('s1-home');
		if ( is_single() && get_theme_mod('s1-single') ) $sidebar = get_theme_mod('s1-single');
		if ( is_archive() && get_theme_mod('s1-archive') ) $sidebar = get_theme_mod('s1-archive');
		if ( is_category() && get_theme_mod('s1-archive-category') ) $sidebar = get_theme_mod('s1-archive-category');
		if ( is_search() && get_theme_mod('s1-search') ) $sidebar = get_theme_mod('s1-search');
		if ( is_404() && get_theme_mod('s1-404') ) $sidebar = get_theme_mod('s1-404');
		if ( is_page() && get_theme_mod('s1-page') ) $sidebar = get_theme_mod('s1-page');

		// Check for page/post specific sidebar
		if ( is_page() || is_single() ) {
			// Reset post data
			wp_reset_postdata();
			global $post;
			// Get meta
			$meta = get_post_meta($post->ID,'_sidebar_primary',true);
			if ( $meta ) { $sidebar = $meta; }
		}

		// Return sidebar
		return $sidebar;
	}
	
}


/*  Dynamic sidebar secondary
/* ------------------------------------ */
if ( ! function_exists( 'alx_sidebar_secondary' ) ) {

	function alx_sidebar_secondary() {
		// Default sidebar
		$sidebar = 'secondary';

		// Set sidebar based on page
		if ( is_home() && get_theme_mod('s2-home') ) $sidebar = get_theme_mod('s2-home');
		if ( is_single() && get_theme_mod('s2-single') ) $sidebar = get_theme_mod('s2-single');
		if ( is_archive() && get_theme_mod('s2-archive') ) $sidebar = get_theme_mod('s2-archive');
		if ( is_category() && get_theme_mod('s2-archive-category') ) $sidebar = get_theme_mod('s2-archive-category');
		if ( is_search() && get_theme_mod('s2-search') ) $sidebar = get_theme_mod('s2-search');
		if ( is_404() && get_theme_mod('s2-404') ) $sidebar = get_theme_mod('s2-404');
		if ( is_page() && get_theme_mod('s2-page') ) $sidebar = get_theme_mod('s2-page');

		// Check for page/post specific sidebar
		if ( is_page() || is_single() ) {
			// Reset post data
			wp_reset_postdata();
			global $post;
			// Get meta
			$meta = get_post_meta($post->ID,'_sidebar_secondary',true);
			if ( $meta ) { $sidebar = $meta; }
		}

		// Return sidebar
		return $sidebar;
	}
	
}


/*  Social links
/* ------------------------------------ */
if ( ! function_exists( 'alx_social_links' ) ) {

	function alx_social_links() {
		if ( !get_theme_mod('social-links') =='' ) {
			$links = get_theme_mod('social-links', array());
			if ( !empty( $links ) ) {
				echo '<ul class="social-links">';	
				foreach( $links as $item ) {
					
					// Build each separate html-section only if set
					if ( isset($item['social-title']) && !empty($item['social-title']) ) 
						{ $title = 'title="' .esc_attr( $item['social-title'] ). '"'; } else $title = '';
					if ( isset($item['social-link']) && !empty($item['social-link']) ) 
						{ $link = 'href="' .esc_url( $item['social-link'] ). '"'; } else $link = '';
					if ( isset($item['social-target']) && !empty($item['social-target']) ) 
						{ $target = 'target="_blank"'; } else $target = '';
					if ( isset($item['social-icon']) && !empty($item['social-icon']) ) 
						{ $icon = 'class="fa ' .esc_attr( $item['social-icon'] ). '"'; } else $icon = '';
					if ( isset($item['social-color']) && !empty($item['social-color']) ) 
						{ $color = 'style="color: ' .esc_attr( $item['social-color'] ). ';"'; } else $color = '';
					
					// Put them together
					if ( isset($item['social-title']) && !empty($item['social-title']) && isset($item['social-icon']) && !empty($item['social-icon']) && ($item['social-icon'] !='fa-') ) {
						echo '<li><a rel="nofollow" class="social-tooltip" '.$title.' '.$link.' '.$target.'><i '.$icon.' '.$color.'></i></a></li>';
					}
				}
				echo '</ul>';
			}
		}
	}
	
}


/*  Site name/logo
/* ------------------------------------ */
if ( ! function_exists( 'alx_site_title' ) ) {

	function alx_site_title() {
	
		// Text or image?
		if ( get_theme_mod('custom-logo') ) {
			$logo = '<img src="'.esc_url( get_theme_mod('custom-logo') ).'" alt="'.get_bloginfo('name').'">';
		} else {
			$logo = get_bloginfo('name');
		}
		
		$link = '<a href="'.esc_url( home_url('/') ).'" rel="home">'.$logo.'</a>';
		
		if ( is_front_page() || is_home() ) {
			$sitename = '<h1 class="site-title">'.$link.'</h1>'."\n";
		} else {
			$sitename = '<p class="site-title">'.$link.'</p>'."\n";
		}
		
		return $sitename;
	}
	
}


/*  Page title
/* ------------------------------------ */
if ( ! function_exists( 'alx_page_title' ) ) {

	function alx_page_title() {
		global $post;

		$heading = esc_attr( get_post_meta($post->ID,'_heading',true) );
		$subheading = esc_attr( get_post_meta($post->ID,'_subheading',true) );
		$title = $heading?$heading:the_title();
		if($subheading) {
			$title = $title.' <span>'.$subheading.'</span>';
		}

		return $title;
	}
	
}


/*  Blog title
/* ------------------------------------ */
if ( ! function_exists( 'alx_blog_title' ) ) {

	function alx_blog_title() {
		global $post;
		$heading = esc_attr( get_theme_mod('blog-heading') );
		$subheading = esc_attr( get_theme_mod('blog-subheading') );
		if($heading) { 
			$title = $heading;
		} else {
			$title = get_bloginfo('name');
		}
		if($subheading) {
			$title = $title.' <span>'.$subheading.'</span>';
		}

		return $title;
	}
	
}


/*  Related posts
/* ------------------------------------ */
if ( ! function_exists( 'alx_related_posts' ) ) {

	function alx_related_posts() {
		wp_reset_postdata();
		global $post;

		// Define shared post arguments
		$args = array(
			'no_found_rows'				=> true,
			'update_post_meta_cache'	=> false,
			'update_post_term_cache'	=> false,
			'ignore_sticky_posts'		=> 1,
			'orderby'					=> 'rand',
			'post__not_in'				=> array($post->ID),
			'posts_per_page'			=> 3
		);
		// Related by categories
		if ( get_theme_mod('related-posts') == 'categories' ) {
			
			$cats = get_post_meta($post->ID, 'related-cat', true);
			
			if ( !$cats ) {
				$cats = wp_get_post_categories($post->ID, array('fields'=>'ids'));
				$args['category__in'] = $cats;
			} else {
				$args['cat'] = $cats;
			}
		}
		// Related by tags
		if ( get_theme_mod('related-posts') == 'tags' ) {
		
			$tags = get_post_meta($post->ID, 'related-tag', true);
			
			if ( !$tags ) {
				$tags = wp_get_post_tags($post->ID, array('fields'=>'ids'));
				$args['tag__in'] = $tags;
			} else {
				$args['tag_slug__in'] = explode(',', $tags);
			}
			if ( !$tags ) { $break = true; }
		}
		
		$query = !isset($break)?new WP_Query($args):new WP_Query;
		return $query;
	}
	
}


/*  Get images attached to post
/* ------------------------------------ */
if ( ! function_exists( 'alx_post_images' ) ) {

	function alx_post_images( $args=array() ) {
		global $post;

		$defaults = array(
			'numberposts'		=> -1,
			'order'				=> 'ASC',
			'orderby'			=> 'menu_order',
			'post_mime_type'	=> 'image',
			'post_parent'		=>  $post->ID,
			'post_type'			=> 'attachment',
		);

		$args = wp_parse_args( $args, $defaults );

		return get_posts( $args );
	}
	
}


/*  Get featured post ids
/* ------------------------------------ */
if ( ! function_exists( 'alx_get_featured_post_ids' ) ) {

	function alx_get_featured_post_ids() {
		$args = array(
			'category'		=> get_theme_mod('featured-category',''),
			'numberposts'	=> get_theme_mod('featured-posts-count','3')
		);
		$posts = get_posts($args);
		if ( !$posts ) return false;
		foreach ( $posts as $post )
			$ids[] = $post->ID;
		return $ids;
	}
	
}


/* ------------------------------------------------------------------------- *
 *  Admin panel functions
/* ------------------------------------------------------------------------- */		

/*  Post formats script
/* ------------------------------------ */
if ( ! function_exists( 'alx_post_formats_script' ) ) {

	function alx_post_formats_script( $hook ) {
		// Only load on posts, pages
		if ( !in_array($hook, array('post.php','post-new.php')) )
			return;
		wp_enqueue_script('post-formats', get_template_directory_uri() . '/functions/js/post-formats.js', array( 'jquery' ));
	}
	
}
add_action( 'admin_enqueue_scripts', 'alx_post_formats_script');


/* ------------------------------------------------------------------------- *
 *  Filters
/* ------------------------------------------------------------------------- */

/*  Body class
/* ------------------------------------ */
if ( ! function_exists( 'alx_body_class' ) ) {

	function alx_body_class( $classes ) {
		$classes[] = alx_layout_class();
		if ( get_theme_mod( 'boxed','off' ) != 'on' ) { $classes[] = 'full-width'; }
		if ( get_theme_mod( 'boxed','off' ) == 'on' ) { $classes[] = 'boxed'; }
		if ( has_nav_menu( 'topbar' ) ) { $classes[] = 'topbar-enabled'; }
		if ( has_nav_menu( 'mobile' ) ) { $classes[] = 'mobile-menu'; }
		if ( get_theme_mod( 'mobile-sidebar-hide','1' ) == 's1' ) { $classes[] = 'mobile-sidebar-hide-s1'; }
		if ( get_theme_mod( 'mobile-sidebar-hide','1' ) == 's2' ) { $classes[] = 'mobile-sidebar-hide-s2'; }
		if ( get_theme_mod( 'mobile-sidebar-hide','1' ) == 's1-s2' ) { $classes[] = 'mobile-sidebar-hide'; }
		if ( get_theme_mod( 'header-social','on' ) != 'on' ) { $classes[] = 'header-social-hide'; }
		return $classes;
	}
	
}
add_filter( 'body_class', 'alx_body_class' );


/*  Custom rss feed
/* ------------------------------------ */
if ( ! function_exists( 'alx_feed_link' ) ) {

	function alx_feed_link( $output, $feed ) {
		// Do not redirect comments feed
		if ( strpos( $output, 'comments' ) )
			return $output;
		// Return feed url
		return esc_attr( get_theme_mod('rss-feed',$output) );
	}
	
}
add_filter( 'feed_link', 'alx_feed_link', 10, 2 );


/*  Excerpt ending
/* ------------------------------------ */
if ( ! function_exists( 'alx_excerpt_more' ) ) {

	function alx_excerpt_more( $more ) {
		return '&#46;&#46;&#46;';
	}
	
}
add_filter( 'excerpt_more', 'alx_excerpt_more' );


/*  Excerpt length
/* ------------------------------------ */
if ( ! function_exists( 'alx_excerpt_length' ) ) {

	function alx_excerpt_length( $length ) {
		return get_theme_mod('excerpt-length','24',$length);
	}
	
}
add_filter( 'excerpt_length', 'alx_excerpt_length', 999 );


/*  Add responsive container to embeds
/* ------------------------------------ */	
if ( ! function_exists( 'alx_embed_html' ) ) {

	function alx_embed_html( $html, $url ) {
		
		$pattern    = '/^https?:\/\/(www\.)?twitter\.com/';
		$is_twitter = preg_match( $pattern, $url );
		
		if ( 1 === $is_twitter ) {
			return $html;
		}
	
		return '<div class="video-container">' . $html . '</div>';
	}

}
add_filter( 'embed_oembed_html', 'alx_embed_html', 10, 3 );


/*  Add responsive container to jetpack embeds
/* ------------------------------------ */	
if ( ! function_exists( 'alx_embed_html_jp' ) ) {

	function alx_embed_html_jp( $html ) {
		return '<div class="video-container">' . $html . '</div>';
	}

}
add_filter( 'video_embed_html', 'alx_embed_html_jp' );


/*  Upscale cropped thumbnails
/* ------------------------------------ */
if ( ! function_exists( 'alx_thumbnail_upscale' ) ) {

	function alx_thumbnail_upscale( $default, $orig_w, $orig_h, $new_w, $new_h, $crop ){
		if ( !$crop ) return null; // let the wordpress default function handle this

		$aspect_ratio = $orig_w / $orig_h;
		$size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

		$crop_w = round($new_w / $size_ratio);
		$crop_h = round($new_h / $size_ratio);

		$s_x = floor( ($orig_w - $crop_w) / 2 );
		$s_y = floor( ($orig_h - $crop_h) / 2 );

		return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
	}
	
}
add_filter( 'image_resize_dimensions', 'alx_thumbnail_upscale', 10, 6 );


/* ------------------------------------------------------------------------- *
 *  Actions
/* ------------------------------------------------------------------------- */	

/*  Include or exclude featured articles in loop
/* ------------------------------------ */
if ( ! function_exists( 'alx_pre_get_posts' ) ) {

	function alx_pre_get_posts( $query ) {
		// Are we on main query ?
		if ( !$query->is_main_query() ) return;
		if ( $query->is_home() ) {

			// Featured posts enabled
			if ( get_theme_mod('featured-posts-count','3') != '0' ) {
				// Get featured post ids
				$featured_post_ids = alx_get_featured_post_ids();
				// Exclude posts
				if ( $featured_post_ids && !get_theme_mod('featured-posts-include') )
					$query->set('post__not_in', $featured_post_ids);
			}
		}
	}
	
}
add_action( 'pre_get_posts', 'alx_pre_get_posts' );


/*  Script for no-js / js class
/* ------------------------------------ */
if ( ! function_exists( 'alx_html_js_class' ) ) {

	function alx_html_js_class () {
		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
	}
	
}
add_action( 'wp_head', 'alx_html_js_class', 1 );


/*  IE js header
/* ------------------------------------ */
if ( ! function_exists( 'alx_ie_js_header' ) ) {

	function alx_ie_js_header () {
		echo '<!--[if lt IE 9]>'. "\n";
		echo '<script src="' . esc_url( get_template_directory_uri() . '/js/ie/html5.js' ) . '"></script>'. "\n";
		echo '<script src="' . esc_url( get_template_directory_uri() . '/js/ie/selectivizr.js' ) . '"></script>'. "\n";
		echo '<![endif]-->'. "\n";
	}
	
}
add_action( 'wp_head', 'alx_ie_js_header' );


/*  IE js footer
/* ------------------------------------ */
if ( ! function_exists( 'alx_ie_js_footer' ) ) {

	function alx_ie_js_footer () {
		echo '<!--[if lt IE 9]>'. "\n";
		echo '<script src="' . esc_url( get_template_directory_uri() . '/js/ie/respond.js' ) . '"></script>'. "\n";
		echo '<![endif]-->'. "\n";
	}
	
}
add_action( 'wp_footer', 'alx_ie_js_footer', 20 );	


/*  TGM plugin activation
/* ------------------------------------ */
if ( ! function_exists( 'alx_plugins' ) ) {
	
	function alx_plugins() {
		if ( get_theme_mod('recommended-plugins','on') =='on' ) { 	
			// Add the following plugins
			$plugins = array(
				array(
					'name' 				=> 'Alx Extensions',
					'slug' 				=> 'alx-extensions',
					'required'			=> false,
					'force_activation' 	=> false,
					'force_deactivation'=> false,
				),
				array(
					'name' 				=> 'Meta Box',
					'slug' 				=> 'meta-box',
					'required'			=> false,
					'force_activation' 	=> false,
					'force_deactivation'=> false,
				),
				array(
					'name' 				=> 'Regenerate Thumbnails',
					'slug' 				=> 'regenerate-thumbnails',
					'required'			=> false,
					'force_activation' 	=> false,
					'force_deactivation'=> false,
				),
				array(
					'name' 				=> 'WP-PageNavi',
					'slug' 				=> 'wp-pagenavi',
					'required'			=> false,
					'force_activation' 	=> false,
					'force_deactivation'=> false,
				),
				array(
					'name' 				=> 'Responsive Lightbox',
					'slug' 				=> 'responsive-lightbox',
					'required'			=> false,
					'force_activation' 	=> false,
					'force_deactivation'=> false,
				)
			);	
			tgmpa( $plugins );
		}
	}
	
}
add_action( 'tgmpa_register', 'alx_plugins' );


/*  WooCommerce basic support
/* ------------------------------------ */
function alx_wc_wrapper_start() {
	echo '<div class="content">';
	echo '<div class="pad">';
}
function alx_wc_wrapper_end() {
	echo '</div>';
	echo '</div>';
}
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'alx_wc_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'alx_wc_wrapper_end', 10);


/*  Admin panel css
/* ------------------------------------ */
function alx_admin_panel_css() {
	echo '<style>
.rwmb-image-select { width: auto!important; height: auto!important; }
.rwmb-text { width: 100%; }
	</style>';
}
add_action('admin_head', 'alx_admin_panel_css');


/* ------------------------------------------------------------------------- *
 *  Frontend scripts
/* ------------------------------------------------------------------------- */	

/*  Flexslider featured
/* ------------------------------------ */
if ( ! function_exists( 'alx_flexslider_featured' ) ) {
	
	function alx_flexslider_featured() {

		if( is_home() && !is_paged() && ( get_theme_mod('featured-posts-count','3') !='0') ) {
			
			$script = '
			jQuery(document).ready(function(){
				var firstImage = jQuery("#flexslider-featured").find("img").filter(":first"),
				   checkforloaded = setInterval(function() {
					   var image = firstImage.get(0);
					   if (image.complete || image.readyState == "complete" || image.readyState == 4) {
						   clearInterval(checkforloaded);
						   jQuery("#flexslider-featured").flexslider({
							   animation: "slide",
								useCSS: false, // Fix iPad flickering issue
								directionNav: true,
								controlNav: true,
								pauseOnHover: true,
								animationSpeed: 400,
								smoothHeight: true,
								touch: false,
								slideshow: true,
								slideshowSpeed: 7000,
						   });
					   }
				   }, 20);
			   });
			';

			wp_add_inline_script( 'typecore-scripts', $script );
			
		}
	}
	
}
add_action( 'wp_enqueue_scripts', 'alx_flexslider_featured' );


/*  Flexslider gallery post format
/* ------------------------------------ */
if ( ! function_exists( 'alx_flexslider_gallery' ) ) {

	function alx_flexslider_gallery() {

		if( is_single() && has_post_format( 'gallery' ) ) {

			$script = '
			jQuery(document).ready(function(){
				var firstImage = jQuery("#flexslider-' . get_the_ID() . '").find("img").filter(":first"),
				   checkforloaded = setInterval(function() {
					   var image = firstImage.get(0);
					   if (image.complete || image.readyState == "complete" || image.readyState == 4) {
						   clearInterval(checkforloaded);
						   jQuery("#flexslider-' . get_the_ID() . '").flexslider({
							   animation: "fade",
							   slideshow: false,
							   directionNav: true,
							   controlNav: false,
							   pauseOnHover: true,
							   slideshowSpeed: 7000,
							   animationSpeed: 600,
							   smoothHeight: true,
							   touch: false
						   });
					   }
				   }, 20);
			   });
			';

			wp_add_inline_script( 'typecore-scripts', $script );
			
		}
	}
	
}
add_action( 'wp_enqueue_scripts', 'alx_flexslider_gallery' );

