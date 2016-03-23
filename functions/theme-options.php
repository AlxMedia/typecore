<?php

/*  Initialize the options before anything else. 
/* ------------------------------------ */
add_action( 'admin_init', 'custom_theme_options', 1 );


/*  Build the custom settings & update OptionTree.
/* ------------------------------------ */
function custom_theme_options() {
	
	// Get a copy of the saved settings array.
	$saved_settings = get_option( 'option_tree_settings', array() );

	// Custom settings array that will eventually be passed to the OptionTree Settings API Class.
	$custom_settings = array(

/*  Help pages
/* ------------------------------------ */	
	'contextual_help' => array(
      'content'       => array( 
        array(
          'id'        => 'general_help',
          'title'     => esc_html__( 'Documentation', 'typecore' ),
          'content'   => '
			<h1>Typecore</h1>
			<ul>
				<li><a target="_blank" href="'.get_template_directory_uri().'/functions/documentation/documentation.html">' . esc_html__( 'Theme Documentation', 'typecore' ) . '</a></li>
			</ul>
		'
        )
      )
    ),
	
/*  Admin panel sections
/* ------------------------------------ */	
	'sections'        => array(
		array(
			'id'		=> 'general',
			'title'		=> esc_html__( 'General', 'typecore' ),
		),
		array(
			'id'		=> 'blog',
			'title'		=> esc_html__( 'Blog', 'typecore' ),
		),
		array(
			'id'		=> 'header',
			'title'		=> esc_html__( 'Header', 'typecore' ),
		),
		array(
			'id'		=> 'footer',
			'title'		=> esc_html__( 'Footer', 'typecore' ),
		),
		array(
			'id'		=> 'layout',
			'title'		=> esc_html__( 'Layout', 'typecore' ),
		),
		array(
			'id'		=> 'sidebars',
			'title'		=> esc_html__( 'Sidebars', 'typecore' ),
		),
		array(
			'id'		=> 'social-links',
			'title'		=> esc_html__( 'Social Links', 'typecore' ),
		),
		array(
			'id'		=> 'styling',
			'title'		=> esc_html__( 'Styling', 'typecore' ),
		),
	),
	
/*  Theme options
/* ------------------------------------ */
	'settings'        => array(
		
		// General: Custom CSS
		array(
			'id'		=> 'custom',
			'label'		=> esc_html__( 'Custom Stylesheet', 'typecore' ),
			'desc'		=> esc_html__( 'Load custom stylesheet (custom.css)', 'typecore' ),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'general'
		),
		// General: Responsive Layout
		array(
			'id'		=> 'responsive',
			'label'		=> esc_html__( 'Responsive Layout', 'typecore' ),
			'desc'		=> esc_html__( 'Mobile and tablet optimizations (responsive.css)', 'typecore' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'general'
		),
		// General: Mobile Sidebar
		array(
			'id'		=> 'mobile-sidebar-hide',
			'label'		=> esc_html__( 'Mobile Sidebar Content', 'typecore' ),
			'desc'		=> esc_html__( 'Hide sidebar content on low-resolution mobile devices (320px)', 'typecore' ),
			'type'		=> 'radio',
			'std'		=> '1',
			'section'	=> 'general',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => esc_html__( 'Show sidebars', 'typecore' ),
				),
				array( 
					'value' => 's1',
					'label' => esc_html__( 'Hide primary sidebar', 'typecore' ),
				),
				array( 
					'value' => 's2',
					'label' => esc_html__( 'Hide secondary sidebar', 'typecore' ),
				),
				array( 
					'value' => 's1-s2',
					'label' => esc_html__( 'Hide both sidebars', 'typecore' ),
				)
			)
		),
		// General: RSS Feed
		array(
			'id'		=> 'rss-feed',
			'label'		=> esc_html__( 'FeedBurner URL', 'typecore' ),
			'desc'		=> esc_html__( 'Enter your full FeedBurner URL (or any other preferred feed URL) if you wish to use FeedBurner over the standard WordPress feed e.g. http://feeds.feedburner.com/yoururlhere', 'typecore' ),
			'type'		=> 'text',
			'section'	=> 'general'
		),
		// General: Post Comments
		array(
			'id'		=> 'post-comments',
			'label'		=> esc_html__( 'Post Comments', 'typecore' ),
			'desc'		=> esc_html__( 'Comments on posts', 'typecore' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'general'
		),
		// General: Page Comments
		array(
			'id'		=> 'page-comments',
			'label'		=> esc_html__( 'Page Comments', 'typecore' ),
			'desc'		=> esc_html__( 'Comments on pages', 'typecore' ),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'general'
		),
		// General: Recommended Plugins
		array(
			'id'		=> 'recommended-plugins',
			'label'		=> esc_html__( 'Recommended Plugins', 'typecore' ),
			'desc'		=> esc_html__( 'Enable or disable the recommended plugins notice', 'typecore' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'general'
		),
		// Blog: Heading
		array(
			'id'		=> 'blog-heading',
			'label'		=> esc_html__( 'Heading', 'typecore' ),
			'desc'		=> esc_html__( 'Your blog heading', 'typecore' ),
			'type'		=> 'text',
			'section'	=> 'blog'
		),
		// Blog: Subheading
		array(
			'id'		=> 'blog-subheading',
			'label'		=> esc_html__( 'Subheading', 'typecore' ),
			'desc'		=> esc_html__( 'Your blog subheading', 'typecore' ),
			'type'		=> 'text',
			'section'	=> 'blog'
		),
		// Blog: Excerpt Length
		array(
			'id'			=> 'excerpt-length',
			'label'			=> esc_html__( 'Excerpt Length', 'typecore' ),
			'desc'			=> esc_html__( 'Max number of words', 'typecore' ),
			'std'			=> '24',
			'type'			=> 'numeric-slider',
			'section'		=> 'blog',
			'min_max_step'	=> '0,100,1'
		),
		// Blog: Featured Posts
		array(
			'id'		=> 'featured-posts-include',
			'label'		=> esc_html__( 'Featured Posts', 'typecore' ),
			'desc'		=> esc_html__( 'To show featured posts in the slider AND the content below. Usually not recommended.', 'typecore' ),
			'type'		=> 'checkbox',
			'section'	=> 'blog',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => esc_html__( 'Include featured posts in content area', 'typecore' ),
				)
			)
		),
		// Blog: Featured Category
		array(
			'id'		=> 'featured-category',
			'label'		=> esc_html__( 'Featured Category', 'typecore' ),
			'desc'		=> esc_html__( 'By not selecting a category, it will show your latest post(s) from all categories', 'typecore' ),
			'type'		=> 'category-select',
			'section'	=> 'blog'
		),
		// Blog: Featured Category Count
		array(
			'id'			=> 'featured-posts-count',
			'label'			=> esc_html__( 'Featured Post Count', 'typecore' ),
			'desc'			=> esc_html__( 'Max number of featured posts to display. Set to 1 and it will show it without any slider script. Set it to 0 to disable', 'typecore' ),
			'std'			=> '1',
			'type'			=> 'numeric-slider',
			'section'		=> 'blog',
			'min_max_step'	=> '0,10,1'
		),
		// Blog: Highlights
		array(
			'id'		=> 'highlights',
			'label'		=> esc_html__( 'Highlights', 'typecore' ),
			'desc'		=> esc_html__( '3 small items below the slider', 'typecore' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Highlights Category
		array(
			'id'		=> 'highlight-category',
			'label'		=> esc_html__( 'Highlights Category', 'typecore' ),
			'desc'		=> esc_html__( 'The 3 latest posts', 'typecore' ),
			'type'		=> 'category-select',
			'section'	=> 'blog'
		),
		// Blog: Picks
		array(
			'id'		=> 'picks',
			'label'		=> esc_html__( 'Picks', 'typecore' ),
			'desc'		=> esc_html__( '2 small items at the bottom of the page', 'typecore' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Picks Category
		array(
			'id'		=> 'picks-category',
			'label'		=> esc_html__( 'Picks Category', 'typecore' ),
			'desc'		=> esc_html__( 'The 2 latest posts', 'typecore' ),
			'type'		=> 'category-select',
			'section'	=> 'blog'
		),
		// Blog: Frontpage Widgets Top
		array(
			'id'		=> 'frontpage-widgets-top',
			'label'		=> esc_html__( 'Frontpage Widgets Top', 'typecore' ),
			'desc'		=> esc_html__( '2 columns of widgets', 'typecore' ),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Frontpage Widgets Bottom
		array(
			'id'		=> 'frontpage-widgets-bottom',
			'label'		=> esc_html__( 'Frontpage Widgets Bottom', 'typecore' ),
			'desc'		=> esc_html__( '2 columns of widgets', 'typecore' ),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Standard
		array(
			'id'		=> 'blog-standard',
			'label'		=> esc_html__( 'Standard Blog List', 'typecore' ),
			'desc'		=> esc_html__( 'Show one post per row, image beside text', 'typecore' ),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Thumbnail Placeholder
		array(
			'id'		=> 'placeholder',
			'label'		=> esc_html__( 'Thumbnail Placeholder', 'typecore' ),
			'desc'		=> esc_html__( 'Show featured image placeholders if no featured image is set', 'typecore' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Comment Count
		array(
			'id'		=> 'comment-count',
			'label'		=> esc_html__( 'Thumbnail Comment Count', 'typecore' ),
			'desc'		=> esc_html__( 'Comment count on thumbnails', 'typecore' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Single - Sharrre
		array(
			'id'		=> 'sharrre',
			'label'		=> esc_html__( 'Single &mdash; Share Bar', 'typecore' ),
			'desc'		=> esc_html__( 'Social sharing buttons for each article', 'typecore' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Single - Sharrre Sticky
		array(
			'id'		=> 'sharrre-scrollable',
			'label'		=> esc_html__( 'Single &mdash; Scrollable Share Bar', 'typecore' ),
			'desc'		=> esc_html__( 'Make social links stick to browser window when scrolling down', 'typecore' ),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Twitter Username
		array(
			'id'		=> 'twitter-username',
			'label'		=> esc_html__( 'Twitter Username', 'typecore' ),
			'desc'		=> esc_html__( 'Your @username will be added to share-tweets of your posts (optional)', 'typecore' ),
			'type'		=> 'text',
			'section'	=> 'blog'
		),
		// Blog: Single - Authorbox
		array(
			'id'		=> 'author-bio',
			'label'		=> esc_html__( 'Single &mdash; Author Bio', 'typecore' ),
			'desc'		=> esc_html__( 'Shows post author description, if it exists', 'typecore' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Single - Related Posts
		array(
			'id'		=> 'related-posts',
			'label'		=> esc_html__( 'Single &mdash; Related Posts', 'typecore' ),
			'desc'		=> esc_html__( 'Shows randomized related articles below the post', 'typecore' ),
			'std'		=> 'categories',
			'type'		=> 'radio',
			'section'	=> 'blog',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => esc_html__( 'Disable', 'typecore' ),
				),
				array( 
					'value' => 'categories',
					'label' => esc_html__( 'Related by categories', 'typecore' ),
				),
				array( 
					'value' => 'tags',
					'label' => esc_html__( 'Related by tags', 'typecore' ),
				)
			)
		),
		// Blog: Single - Post Navigation Location
		array(
			'id'		=> 'post-nav',
			'label'		=> esc_html__( 'Single &mdash; Post Navigation', 'typecore' ),
			'desc'		=> esc_html__( 'Shows links to the next and previous article', 'typecore' ),
			'std'		=> 's1',
			'type'		=> 'radio',
			'section'	=> 'blog',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => esc_html__( 'Disable', 'typecore' ),
				),
				array( 
					'value' => 's1',
					'label' => esc_html__( 'Sidebar Primary', 'typecore' ),
				),
				array( 
					'value' => 's2',
					'label' => esc_html__( 'Sidebar Secondary', 'typecore' ),
				),
				array( 
					'value' => 'content',
					'label' => esc_html__( 'Below content', 'typecore' ),
				)
			)
		),
		// Header: Ads
		array(
			'id'		=> 'header-ads',
			'label'		=> esc_html__( 'Header Ads', 'typecore' ),
			'desc'		=> esc_html__( 'Header widget ads area', 'typecore' ),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'header'
		),
		// Header: Custom Logo
		array(
			'id'		=> 'custom-logo',
			'label'		=> esc_html__( 'Custom Logo', 'typecore' ),
			'desc'		=> esc_html__( 'Upload your custom logo image. Set logo max-height in styling options.', 'typecore' ),
			'type'		=> 'upload',
			'section'	=> 'header'
		),
		// Header: Site Description
		array(
			'id'		=> 'site-description',
			'label'		=> esc_html__( 'Site Description', 'typecore' ),
			'desc'		=> esc_html__( 'The description that appears next to your logo', 'typecore' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'header'
		),
		// Header: Header Image
		array(
			'id'		=> 'header-image',
			'label'		=> esc_html__( 'Header Image', 'typecore' ),
			'desc'		=> esc_html__( 'Upload a header image. This will disable header title/logo and description.', 'typecore' ),
			'type'		=> 'upload',
			'section'	=> 'header'
		),
		// Footer: Ads
		array(
			'id'		=> 'footer-ads',
			'label'		=> esc_html__( 'Footer Ads', 'typecore' ),
			'desc'		=> esc_html__( 'Footer widget ads area', 'typecore' ),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'footer'
		),
		// Footer: Widget Columns
		array(
			'id'		=> 'footer-widgets',
			'label'		=> esc_html__( 'Footer Widget Columns', 'typecore' ),
			'desc'		=> esc_html__( 'Select columns to enable footer widgets. Recommended number: 3', 'typecore' ),
			'std'		=> '0',
			'type'		=> 'radio-image',
			'section'	=> 'footer',
			'class'		=> '',
			'choices'	=> array(
				array(
					'value'		=> '0',
					'label'		=> esc_html__( 'Disable', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> '1',
					'label'		=> esc_html__( '1 Column', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/footer-widgets-1.png'
				),
				array(
					'value'		=> '2',
					'label'		=> esc_html__( '2 Columns', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/footer-widgets-2.png'
				),
				array(
					'value'		=> '3',
					'label'		=> esc_html__( '3 Columns', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/footer-widgets-3.png'
				),
				array(
					'value'		=> '4',
					'label'		=> esc_html__( '4 Columns', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/footer-widgets-4.png'
				)
			)
		),
		// Footer: Custom Logo
		array(
			'id'		=> 'footer-logo',
			'label'		=> esc_html__( 'Footer Logo', 'typecore' ),
			'desc'		=> esc_html__( 'Upload your custom logo image', 'typecore' ),
			'type'		=> 'upload',
			'section'	=> 'footer'
		),
		// Footer: Copyright
		array(
			'id'		=> 'copyright',
			'label'		=> esc_html__( 'Footer Copyright', 'typecore' ),
			'desc'		=> esc_html__( 'Replace the footer copyright text', 'typecore' ),
			'type'		=> 'text',
			'section'	=> 'footer'
		),
		// Footer: Credit
		array(
			'id'		=> 'credit',
			'label'		=> esc_html__( 'Footer Credit', 'typecore' ),
			'desc'		=> esc_html__( 'Footer credit text', 'typecore' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'footer'
		),
		// Layout : Global
		array(
			'id'		=> 'layout-global',
			'label'		=> esc_html__( 'Global Layout', 'typecore' ),
			'desc'		=> esc_html__( 'Other layouts will override this option if they are set', 'typecore' ),
			'std'		=> 'col-3cm',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'col-1c',
					'label'		=> esc_html__( '1 Column', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> esc_html__( '2 Column Left', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> esc_html__( '2 Column Right', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> esc_html__( '3 Column Middle', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> esc_html__( '3 Column Left', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> esc_html__( '3 Column Right', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Home
		array(
			'id'		=> 'layout-home',
			'label'		=> esc_html__( 'Home', 'typecore' ),
			'desc'		=> esc_html__( '(is_home) Posts homepage layout', 'typecore' ),
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> esc_html__( 'Inherit Global Layout', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> esc_html__( '1 Column', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> esc_html__( '2 Column Left', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> esc_html__( '2 Column Right', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> esc_html__( '3 Column Middle', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> esc_html__( '3 Column Left', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> esc_html__( '3 Column Right', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Single
		array(
			'id'		=> 'layout-single',
			'label'		=> esc_html__( 'Single', 'typecore' ),
			'desc'		=> esc_html__( '(is_single) Single post layout - If a post has a set layout, it will override this.', 'typecore' ),
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> esc_html__( 'Inherit Global Layout', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> esc_html__( '1 Column', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> esc_html__( '2 Column Left', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> esc_html__( '2 Column Right', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> esc_html__( '3 Column Middle', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> esc_html__( '3 Column Left', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> esc_html__( '3 Column Right', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Archive
		array(
			'id'		=> 'layout-archive',
			'label'		=> esc_html__( 'Archive', 'typecore' ),
			'desc'		=> esc_html__( '(is_archive) Category, date, tag and author archive layout', 'typecore' ),
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> esc_html__( 'Inherit Global Layout', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> esc_html__( '1 Column', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> esc_html__( '2 Column Left', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> esc_html__( '2 Column Right', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> esc_html__( '3 Column Middle', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> esc_html__( '3 Column Left', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> esc_html__( '3 Column Right', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Archive - Category
		array(
			'id'		=> 'layout-archive-category',
			'label'		=> esc_html__( 'Archive &mdash; Category', 'typecore' ),
			'desc'		=> esc_html__( '(is_category) Category archive layout', 'typecore' ),
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> esc_html__( 'Inherit Global Layout', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> esc_html__( '1 Column', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> esc_html__( '2 Column Left', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> esc_html__( '2 Column Right', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> esc_html__( '3 Column Middle', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> esc_html__( '3 Column Left', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> esc_html__( '3 Column Right', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Search
		array(
			'id'		=> 'layout-search',
			'label'		=> esc_html__( 'Search', 'typecore' ),
			'desc'		=> esc_html__( '(is_search) Search page layout', 'typecore' ),
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> esc_html__( 'Inherit Global Layout', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> esc_html__( '1 Column', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> esc_html__( '2 Column Left', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> esc_html__( '2 Column Right', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> esc_html__( '3 Column Middle', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> esc_html__( '3 Column Left', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> esc_html__( '3 Column Right', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Error 404
		array(
			'id'		=> 'layout-404',
			'label'		=> esc_html__( 'Error 404', 'typecore' ),
			'desc'		=> esc_html__( '(is_404) Error 404 page layout', 'typecore' ),
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> esc_html__( 'Inherit Global Layout', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> esc_html__( '1 Column', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> esc_html__( '2 Column Left', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> esc_html__( '2 Column Right', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> esc_html__( '3 Column Middle', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> esc_html__( '3 Column Left', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> esc_html__( '3 Column Right', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Default Page
		array(
			'id'		=> 'layout-page',
			'label'		=> esc_html__( 'Default Page', 'typecore' ),
			'desc'		=> esc_html__( '(is_page) Default page layout - If a page has a set layout, it will override this.', 'typecore' ),
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> esc_html__( 'Inherit Global Layout', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> esc_html__( '1 Column', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> esc_html__( '2 Column Left', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> esc_html__( '2 Column Right', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> esc_html__( '3 Column Middle', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> esc_html__( '3 Column Left', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> esc_html__( '3 Column Right', 'typecore' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Sidebars: Create Areas
		array(
			'id'		=> 'sidebar-areas',
			'label'		=> esc_html__( 'Create Sidebars', 'typecore' ),
			'desc'		=> esc_html__( 'You must save changes for the new areas to appear below. Warning: Make sure each area has a unique ID.', 'typecore' ),
			'type'		=> 'list-item',
			'section'	=> 'sidebars',
			'choices'	=> array(),
			'settings'	=> array(
				array(
					'id'		=> 'id',
					'label'		=> esc_html__( 'Sidebar ID', 'typecore' ),
					'desc'		=> esc_html__( 'This ID must be unique, for example "sidebar-about"', 'typecore' ),
					'std'		=> 'sidebar-',
					'type'		=> 'text',
					'choices'	=> array()
				)
			)
		),
		// Sidebar 1 & 2
		array(
			'id'		=> 's1-home',
			'label'		=> esc_html__( 'Home', 'typecore' ),
			'desc'		=> esc_html__( '(is_home) Primary', 'typecore' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-home',
			'label'		=> esc_html__( 'Home', 'typecore' ),
			'desc'		=> esc_html__( '(is_home) Secondary', 'typecore' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-single',
			'label'		=> esc_html__( 'Single', 'typecore' ),
			'desc'		=> esc_html__( '(is_single) Primary - If a single post has a unique sidebar, it will override this.', 'typecore' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-single',
			'label'		=> esc_html__( 'Single', 'typecore' ),
			'desc'		=> esc_html__( '(is_single) Secondary - If a single post has a unique sidebar, it will override this.', 'typecore' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-archive',
			'label'		=> esc_html__( 'Archive', 'typecore' ),
			'desc'		=> esc_html__( '(is_archive) Primary', 'typecore' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-archive',
			'label'		=> esc_html__( 'Archive', 'typecore' ),
			'desc'		=> esc_html__( '(is_archive) Secondary', 'typecore' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-archive-category',
			'label'		=> esc_html__( 'Archive &mdash; Category', 'typecore' ),
			'desc'		=> esc_html__( '(is_category) Primary', 'typecore' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-archive-category',
			'label'		=> esc_html__( 'Archive &mdash; Category', 'typecore' ),
			'desc'		=> esc_html__( '(is_category) Secondary', 'typecore' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-search',
			'label'		=> esc_html__( 'Search', 'typecore' ),
			'desc'		=> esc_html__( '(is_search) Primary', 'typecore' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-search',
			'label'		=> esc_html__( 'Search', 'typecore' ),
			'desc'		=> esc_html__( '(is_search) Secondary', 'typecore' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-404',
			'label'		=> esc_html__( 'Error 404', 'typecore' ),
			'desc'		=> esc_html__( '(is_404) Primary', 'typecore' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-404',
			'label'		=> esc_html__( 'Error 404', 'typecore' ),
			'desc'		=> esc_html__( '(is_404) Secondary', 'typecore' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-page',
			'label'		=> esc_html__( 'Default Page', 'typecore' ),
			'desc'		=> esc_html__( '(is_page) Primary - If a page has a unique sidebar, it will override this.', 'typecore' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-page',
			'label'		=> esc_html__( 'Default Page', 'typecore' ),
			'desc'		=> esc_html__( '(is_page) Secondary - If a page has a unique sidebar, it will override this.', 'typecore' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		// Social Links : List
		array(
			'id'		=> 'social-links',
			'label'		=> esc_html__( 'Social Links', 'typecore' ),
			'desc'		=> esc_html__( 'Create and organize your social links', 'typecore' ),
			'type'		=> 'list-item',
			'section'	=> 'social-links',
			'choices'	=> array(),
			'settings'	=> array(
				array(
					'id'		=> 'social-icon',
					'label'		=> esc_html__( 'Icon Name', 'typecore' ),
					'desc'		=> esc_html__( 'Font Awesome icon names:', 'typecore' ) . ' <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank"><strong>' . esc_html__( 'View All', 'typecore' ) . ' </strong></a>',
					'std'		=> 'fa-',
					'type'		=> 'text',
					'choices'	=> array()
				),
				array(
					'id'		=> 'social-link',
					'label'		=> esc_html__( 'Link', 'typecore' ),
					'desc'		=> esc_html__( 'Enter the full url for your icon button', 'typecore' ),
					'std'		=> 'http://',
					'type'		=> 'text',
					'choices'	=> array()
				),
				array(
					'id'		=> 'social-color',
					'label'		=> esc_html__( 'Icon Color', 'typecore' ),
					'desc'		=> esc_html__( 'Set a unique color for your icon (optional)', 'typecore' ),
					'std'		=> '',
					'type'		=> 'colorpicker',
					'section'	=> 'styling'
				),
				array(
					'id'		=> 'social-target',
					'label'		=> esc_html__( 'Link Options', 'typecore' ),
					'desc'		=> '',
					'std'		=> '',
					'type'		=> 'checkbox',
					'choices'	=> array(
						array( 
							'value' => '_blank',
							'label' => esc_html__( 'Open in new window', 'typecore' ),
						)
					)
				)
			)
		),
		// Styling: Enable
		array(
			'id'		=> 'dynamic-styles',
			'label'		=> esc_html__( 'Dynamic Styles', 'typecore' ),
			'desc'		=> esc_html__( 'Turn on to use the styling options below', 'typecore' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'styling'
		),
		// Styling: Boxed Layout
		array(
			'id'		=> 'boxed',
			'label'		=> esc_html__( 'Boxed Layout', 'typecore' ),
			'desc'		=> esc_html__( 'Use a boxed layout', 'typecore' ),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'styling'
		),
		// Styling: Font
		array(
			'id'		=> 'font',
			'label'		=> esc_html__( 'Font', 'typecore' ),
			'desc'		=> esc_html__( 'Select font for the theme', 'typecore' ),
			'type'		=> 'select',
			'std'		=> 'roboto-condensed',
			'section'	=> 'styling',
			'choices'	=> array(
				array( 
					'value' => 'titillium-web',
					'label' => 'Titillium Web, Latin (Self-hosted)'
				),
				array( 
					'value' => 'titillium-web-ext',
					'label' => 'Titillium Web, Latin-Ext'
				),
				array( 
					'value' => 'droid-serif',
					'label' => 'Droid Serif, Latin'
				),
				array( 
					'value' => 'source-sans-pro',
					'label' => 'Source Sans Pro, Latin-Ext'
				),
				array( 
					'value' => 'lato',
					'label' => 'Lato, Latin'
				),
				array( 
					'value' => 'raleway',
					'label' => 'Raleway, Latin'
				),
				array( 
					'value' => 'ubuntu',
					'label' => 'Ubuntu, Latin-Ext'
				),
				array( 
					'value' => 'ubuntu-cyr',
					'label' => 'Ubuntu, Latin / Cyrillic-Ext'
				),
				array( 
					'value' => 'roboto',
					'label' => 'Roboto, Latin-Ext'
				),
				array( 
					'value' => 'roboto-cyr',
					'label' => 'Roboto, Latin / Cyrillic-Ext'
				),
				array( 
					'value' => 'roboto-condensed',
					'label' => 'Roboto Condensed, Latin-Ext'
				),
				array( 
					'value' => 'roboto-condensed-cyr',
					'label' => 'Roboto Condensed, Latin / Cyrillic-Ext'
				),
				array( 
					'value' => 'roboto-slab',
					'label' => 'Roboto Slab, Latin-Ext'
				),
				array( 
					'value' => 'roboto-slab-cyr',
					'label' => 'Roboto Slab, Latin / Cyrillic-Ext'
				),
				array( 
					'value' => 'playfair-display',
					'label' => 'Playfair Display, Latin-Ext'
				),
				array( 
					'value' => 'playfair-display-cyr',
					'label' => 'Playfair Display, Latin / Cyrillic'
				),
				array( 
					'value' => 'open-sans',
					'label' => 'Open Sans, Latin-Ext'
				),
				array( 
					'value' => 'open-sans-cyr',
					'label' => 'Open Sans, Latin / Cyrillic-Ext'
				),
				array( 
					'value' => 'pt-serif',
					'label' => 'PT Serif, Latin-Ext'
				),
				array( 
					'value' => 'pt-serif-cyr',
					'label' => 'PT Serif, Latin / Cyrillic-Ext'
				),
				array( 
					'value' => 'arial',
					'label' => 'Arial'
				),
				array( 
					'value' => 'georgia',
					'label' => 'Georgia'
				),
				array( 
					'value' => 'verdana',
					'label' => 'Verdana'
				),
				array( 
					'value' => 'tahoma',
					'label' => 'Tahoma'
				)
			)
		),
		// Styling: Container Width
		array(
			'id'			=> 'container-width',
			'label'			=> esc_html__( 'Website Max-width', 'typecore' ),
			'desc'			=> esc_html__( 'Max-width of the container. If you use 2 sidebars, your container should be at least 1280px. Note: For 720px content (default) use 1460px for 2 sidebars and 1200px for 1 sidebar. If you use a combination of both, try something inbetween.', 'typecore' ),
			'std'			=> '1460',
			'type'			=> 'numeric-slider',
			'section'		=> 'styling',
			'min_max_step'	=> '1024,1600,1'
		),
		// Styling: Sidebar Padding
		array(
			'id'		=> 'sidebar-padding',
			'label'		=> esc_html__( 'Sidebar Width', 'typecore' ),
			'type'		=> 'radio',
			'std'		=> '30',
			'section'	=> 'styling',
			'choices'	=> array(
				array( 
					'value' => '30',
					'label' => esc_html__( '280px primary, 200px secondary (30px padding)', 'typecore' ),
				),
				array( 
					'value' => '20',
					'label' => esc_html__( '300px primary, 220px secondary (20px padding)', 'typecore' ),
				)
			)
		),
		// Styling: Primary Color
		array(
			'id'		=> 'color-1',
			'label'		=> esc_html__( 'Primary Color', 'typecore' ),
			'std'		=> '#e64338',
			'type'		=> 'colorpicker',
			'section'	=> 'styling',
			'class'		=> ''
		),
		// Styling: Comments Bubble
		array(
			'id'		=> 'color-bubble',
			'label'		=> esc_html__( 'Comments Bubble', 'typecore' ),
			'std'		=> '#f7e696',
			'type'		=> 'colorpicker',
			'section'	=> 'styling',
			'class'		=> ''
		),
		// Styling: Topbar Background
		array(
			'id'		=> 'color-topbar',
			'label'		=> esc_html__( 'Topbar Background', 'typecore' ),
			'std'		=> '#e64338',
			'type'		=> 'colorpicker',
			'section'	=> 'styling',
			'class'		=> ''
		),
		// Styling: Header Background
		array(
			'id'		=> 'color-header',
			'label'		=> esc_html__( 'Header Background', 'typecore' ),
			'std'		=> '#23282d',
			'type'		=> 'colorpicker',
			'section'	=> 'styling',
			'class'		=> ''
		),
		// Styling: Header Menu Background
		array(
			'id'		=> 'color-header-menu',
			'label'		=> esc_html__( 'Header Menu Background', 'typecore' ),
			'std'		=> '',
			'type'		=> 'colorpicker',
			'section'	=> 'styling',
			'class'		=> ''
		),
		// Styling: Footer Menu Background
		array(
			'id'		=> 'color-footer-menu',
			'label'		=> esc_html__( 'Footer Menu Background', 'typecore' ),
			'std'		=> '#23282d',
			'type'		=> 'colorpicker',
			'section'	=> 'styling',
			'class'		=> ''
		),
		// Styling: Footer Background
		array(
			'id'		=> 'color-footer',
			'label'		=> esc_html__( 'Footer Background', 'typecore' ),
			'std'		=> '#e64338',
			'type'		=> 'colorpicker',
			'section'	=> 'styling',
			'class'		=> ''
		),
		// Styling: Header Logo Max-height
		array(
			'id'			=> 'logo-max-height',
			'label'			=> esc_html__( 'Header Logo Image Max-height', 'typecore' ),
			'desc'			=> esc_html__( 'Your logo image should have the double height of this to be high resolution', 'typecore' ),
			'std'			=> '60',
			'type'			=> 'numeric-slider',
			'section'		=> 'styling',
			'min_max_step'	=> '40,200,1'
		),
		// Styling: Image Border Radius
		array(
			'id'			=> 'image-border-radius',
			'label'			=> esc_html__( 'Image Border Radius', 'typecore' ),
			'desc'			=> esc_html__( 'Give your thumbnails and layout images rounded corners', 'typecore' ),
			'std'			=> '3',
			'type'			=> 'numeric-slider',
			'section'		=> 'styling',
			'min_max_step'	=> '0,15,1'
		),
		// Styling: Body Background
		array(
			'id'		=> 'body-background',
			'label'		=> esc_html__( 'Body Background', 'typecore' ),
			'desc'		=> esc_html__( 'Set background color and/or upload your own background image', 'typecore' ),
			'type'		=> 'background',
			'section'	=> 'styling'
		)
	)
);

/*  Settings are not the same? Update the DB
/* ------------------------------------ */
	if ( $saved_settings !== $custom_settings ) {
		update_option( 'option_tree_settings', $custom_settings ); 
	} 
}
