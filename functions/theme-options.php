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
          'title'     => esc_html__( 'Documentation', 'option-tree' ),
          'content'   => '
			<h1>Typecore</h1>
			<ul>
				<li><a target="_blank" href="'.get_template_directory_uri().'/functions/documentation/documentation.html">' . esc_html__( 'Theme Documentation', 'option-tree' ) . '</a></li>
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
			'title'		=> esc_html__( 'General', 'option-tree' ),
		),
		array(
			'id'		=> 'blog',
			'title'		=> esc_html__( 'Blog', 'option-tree' ),
		),
		array(
			'id'		=> 'header',
			'title'		=> esc_html__( 'Header', 'option-tree' ),
		),
		array(
			'id'		=> 'footer',
			'title'		=> esc_html__( 'Footer', 'option-tree' ),
		),
		array(
			'id'		=> 'layout',
			'title'		=> esc_html__( 'Layout', 'option-tree' ),
		),
		array(
			'id'		=> 'sidebars',
			'title'		=> esc_html__( 'Sidebars', 'option-tree' ),
		),
		array(
			'id'		=> 'social-links',
			'title'		=> esc_html__( 'Social Links', 'option-tree' ),
		),
		array(
			'id'		=> 'styling',
			'title'		=> esc_html__( 'Styling', 'option-tree' ),
		),
	),
	
/*  Theme options
/* ------------------------------------ */
	'settings'        => array(
		
		// General: Custom CSS
		array(
			'id'		=> 'custom',
			'label'		=> esc_html__( 'Custom Stylesheet', 'option-tree' ),
			'desc'		=> esc_html__( 'Load custom stylesheet (custom.css)', 'option-tree' ),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'general'
		),
		// General: Responsive Layout
		array(
			'id'		=> 'responsive',
			'label'		=> esc_html__( 'Responsive Layout', 'option-tree' ),
			'desc'		=> esc_html__( 'Mobile and tablet optimizations (responsive.css)', 'option-tree' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'general'
		),
		// General: Mobile Sidebar
		array(
			'id'		=> 'mobile-sidebar-hide',
			'label'		=> esc_html__( 'Mobile Sidebar Content', 'option-tree' ),
			'desc'		=> esc_html__( 'Hide sidebar content on low-resolution mobile devices (320px)', 'option-tree' ),
			'type'		=> 'radio',
			'std'		=> '1',
			'section'	=> 'general',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => esc_html__( 'Show sidebars', 'option-tree' ),
				),
				array( 
					'value' => 's1',
					'label' => esc_html__( 'Hide primary sidebar', 'option-tree' ),
				),
				array( 
					'value' => 's2',
					'label' => esc_html__( 'Hide secondary sidebar', 'option-tree' ),
				),
				array( 
					'value' => 's1-s2',
					'label' => esc_html__( 'Hide both sidebars', 'option-tree' ),
				)
			)
		),
		// General: RSS Feed
		array(
			'id'		=> 'rss-feed',
			'label'		=> esc_html__( 'FeedBurner URL', 'option-tree' ),
			'desc'		=> esc_html__( 'Enter your full FeedBurner URL (or any other preferred feed URL) if you wish to use FeedBurner over the standard WordPress feed e.g. http://feeds.feedburner.com/yoururlhere', 'option-tree' ),
			'type'		=> 'text',
			'section'	=> 'general'
		),
		// General: Post Comments
		array(
			'id'		=> 'post-comments',
			'label'		=> esc_html__( 'Post Comments', 'option-tree' ),
			'desc'		=> esc_html__( 'Comments on posts', 'option-tree' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'general'
		),
		// General: Page Comments
		array(
			'id'		=> 'page-comments',
			'label'		=> esc_html__( 'Page Comments', 'option-tree' ),
			'desc'		=> esc_html__( 'Comments on pages', 'option-tree' ),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'general'
		),
		// General: Recommended Plugins
		array(
			'id'		=> 'recommended-plugins',
			'label'		=> esc_html__( 'Recommended Plugins', 'option-tree' ),
			'desc'		=> esc_html__( 'Enable or disable the recommended plugins notice', 'option-tree' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'general'
		),
		// Blog: Heading
		array(
			'id'		=> 'blog-heading',
			'label'		=> esc_html__( 'Heading', 'option-tree' ),
			'desc'		=> esc_html__( 'Your blog heading', 'option-tree' ),
			'type'		=> 'text',
			'section'	=> 'blog'
		),
		// Blog: Subheading
		array(
			'id'		=> 'blog-subheading',
			'label'		=> esc_html__( 'Subheading', 'option-tree' ),
			'desc'		=> esc_html__( 'Your blog subheading', 'option-tree' ),
			'type'		=> 'text',
			'section'	=> 'blog'
		),
		// Blog: Excerpt Length
		array(
			'id'			=> 'excerpt-length',
			'label'			=> esc_html__( 'Excerpt Length', 'option-tree' ),
			'desc'			=> esc_html__( 'Max number of words', 'option-tree' ),
			'std'			=> '24',
			'type'			=> 'numeric-slider',
			'section'		=> 'blog',
			'min_max_step'	=> '0,100,1'
		),
		// Blog: Featured Posts
		array(
			'id'		=> 'featured-posts-include',
			'label'		=> esc_html__( 'Featured Posts', 'option-tree' ),
			'desc'		=> esc_html__( 'To show featured posts in the slider AND the content below. Usually not recommended.', 'option-tree' ),
			'type'		=> 'checkbox',
			'section'	=> 'blog',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => esc_html__( 'Include featured posts in content area', 'option-tree' ),
				)
			)
		),
		// Blog: Featured Category
		array(
			'id'		=> 'featured-category',
			'label'		=> esc_html__( 'Featured Category', 'option-tree' ),
			'desc'		=> esc_html__( 'By not selecting a category, it will show your latest post(s) from all categories', 'option-tree' ),
			'type'		=> 'category-select',
			'section'	=> 'blog'
		),
		// Blog: Featured Category Count
		array(
			'id'			=> 'featured-posts-count',
			'label'			=> esc_html__( 'Featured Post Count', 'option-tree' ),
			'desc'			=> esc_html__( 'Max number of featured posts to display. Set to 1 and it will show it without any slider script. Set it to 0 to disable', 'option-tree' ),
			'std'			=> '1',
			'type'			=> 'numeric-slider',
			'section'		=> 'blog',
			'min_max_step'	=> '0,10,1'
		),
		// Blog: Highlights
		array(
			'id'		=> 'highlights',
			'label'		=> esc_html__( 'Highlights', 'option-tree' ),
			'desc'		=> esc_html__( '3 small items below the slider', 'option-tree' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Highlights Category
		array(
			'id'		=> 'highlight-category',
			'label'		=> esc_html__( 'Highlights Category', 'option-tree' ),
			'desc'		=> esc_html__( 'The 3 latest posts', 'option-tree' ),
			'type'		=> 'category-select',
			'section'	=> 'blog'
		),
		// Blog: Picks
		array(
			'id'		=> 'picks',
			'label'		=> esc_html__( 'Picks', 'option-tree' ),
			'desc'		=> esc_html__( '2 small items at the bottom of the page', 'option-tree' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Picks Category
		array(
			'id'		=> 'picks-category',
			'label'		=> esc_html__( 'Picks Category', 'option-tree' ),
			'desc'		=> esc_html__( 'The 2 latest posts', 'option-tree' ),
			'type'		=> 'category-select',
			'section'	=> 'blog'
		),
		// Blog: Frontpage Widgets Top
		array(
			'id'		=> 'frontpage-widgets-top',
			'label'		=> esc_html__( 'Frontpage Widgets Top', 'option-tree' ),
			'desc'		=> esc_html__( '2 columns of widgets', 'option-tree' ),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Frontpage Widgets Bottom
		array(
			'id'		=> 'frontpage-widgets-bottom',
			'label'		=> esc_html__( 'Frontpage Widgets Bottom', 'option-tree' ),
			'desc'		=> esc_html__( '2 columns of widgets', 'option-tree' ),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Standard
		array(
			'id'		=> 'blog-standard',
			'label'		=> esc_html__( 'Standard Blog List', 'option-tree' ),
			'desc'		=> esc_html__( 'Show one post per row, image beside text', 'option-tree' ),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Thumbnail Placeholder
		array(
			'id'		=> 'placeholder',
			'label'		=> esc_html__( 'Thumbnail Placeholder', 'option-tree' ),
			'desc'		=> esc_html__( 'Show featured image placeholders if no featured image is set', 'option-tree' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Comment Count
		array(
			'id'		=> 'comment-count',
			'label'		=> esc_html__( 'Thumbnail Comment Count', 'option-tree' ),
			'desc'		=> esc_html__( 'Comment count on thumbnails', 'option-tree' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Single - Sharrre
		array(
			'id'		=> 'sharrre',
			'label'		=> esc_html__( 'Single &mdash; Share Bar', 'option-tree' ),
			'desc'		=> esc_html__( 'Social sharing buttons for each article', 'option-tree' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Single - Sharrre Sticky
		array(
			'id'		=> 'sharrre-scrollable',
			'label'		=> esc_html__( 'Single &mdash; Scrollable Share Bar', 'option-tree' ),
			'desc'		=> esc_html__( 'Make social links stick to browser window when scrolling down', 'option-tree' ),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Twitter Username
		array(
			'id'		=> 'twitter-username',
			'label'		=> esc_html__( 'Twitter Username', 'option-tree' ),
			'desc'		=> esc_html__( 'Your @username will be added to share-tweets of your posts (optional)', 'option-tree' ),
			'type'		=> 'text',
			'section'	=> 'blog'
		),
		// Blog: Single - Authorbox
		array(
			'id'		=> 'author-bio',
			'label'		=> esc_html__( 'Single &mdash; Author Bio', 'option-tree' ),
			'desc'		=> esc_html__( 'Shows post author description, if it exists', 'option-tree' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Single - Related Posts
		array(
			'id'		=> 'related-posts',
			'label'		=> esc_html__( 'Single &mdash; Related Posts', 'option-tree' ),
			'desc'		=> esc_html__( 'Shows randomized related articles below the post', 'option-tree' ),
			'std'		=> 'categories',
			'type'		=> 'radio',
			'section'	=> 'blog',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => esc_html__( 'Disable', 'option-tree' ),
				),
				array( 
					'value' => 'categories',
					'label' => esc_html__( 'Related by categories', 'option-tree' ),
				),
				array( 
					'value' => 'tags',
					'label' => esc_html__( 'Related by tags', 'option-tree' ),
				)
			)
		),
		// Blog: Single - Post Navigation Location
		array(
			'id'		=> 'post-nav',
			'label'		=> esc_html__( 'Single &mdash; Post Navigation', 'option-tree' ),
			'desc'		=> esc_html__( 'Shows links to the next and previous article', 'option-tree' ),
			'std'		=> 's1',
			'type'		=> 'radio',
			'section'	=> 'blog',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => esc_html__( 'Disable', 'option-tree' ),
				),
				array( 
					'value' => 's1',
					'label' => esc_html__( 'Sidebar Primary', 'option-tree' ),
				),
				array( 
					'value' => 's2',
					'label' => esc_html__( 'Sidebar Secondary', 'option-tree' ),
				),
				array( 
					'value' => 'content',
					'label' => esc_html__( 'Below content', 'option-tree' ),
				)
			)
		),
		// Header: Ads
		array(
			'id'		=> 'header-ads',
			'label'		=> esc_html__( 'Header Ads', 'option-tree' ),
			'desc'		=> esc_html__( 'Header widget ads area', 'option-tree' ),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'header'
		),
		// Header: Custom Logo
		array(
			'id'		=> 'custom-logo',
			'label'		=> esc_html__( 'Custom Logo', 'option-tree' ),
			'desc'		=> esc_html__( 'Upload your custom logo image. Set logo max-height in styling options.', 'option-tree' ),
			'type'		=> 'upload',
			'section'	=> 'header'
		),
		// Header: Site Description
		array(
			'id'		=> 'site-description',
			'label'		=> esc_html__( 'Site Description', 'option-tree' ),
			'desc'		=> esc_html__( 'The description that appears next to your logo', 'option-tree' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'header'
		),
		// Header: Header Image
		array(
			'id'		=> 'header-image',
			'label'		=> esc_html__( 'Header Image', 'option-tree' ),
			'desc'		=> esc_html__( 'Upload a header image. This will disable header title/logo and description.', 'option-tree' ),
			'type'		=> 'upload',
			'section'	=> 'header'
		),
		// Footer: Ads
		array(
			'id'		=> 'footer-ads',
			'label'		=> esc_html__( 'Footer Ads', 'option-tree' ),
			'desc'		=> esc_html__( 'Footer widget ads area', 'option-tree' ),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'footer'
		),
		// Footer: Widget Columns
		array(
			'id'		=> 'footer-widgets',
			'label'		=> esc_html__( 'Footer Widget Columns', 'option-tree' ),
			'desc'		=> esc_html__( 'Select columns to enable footer widgets. Recommended number: 3', 'option-tree' ),
			'std'		=> '0',
			'type'		=> 'radio-image',
			'section'	=> 'footer',
			'class'		=> '',
			'choices'	=> array(
				array(
					'value'		=> '0',
					'label'		=> esc_html__( 'Disable', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> '1',
					'label'		=> esc_html__( '1 Column', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/footer-widgets-1.png'
				),
				array(
					'value'		=> '2',
					'label'		=> esc_html__( '2 Columns', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/footer-widgets-2.png'
				),
				array(
					'value'		=> '3',
					'label'		=> esc_html__( '3 Columns', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/footer-widgets-3.png'
				),
				array(
					'value'		=> '4',
					'label'		=> esc_html__( '4 Columns', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/footer-widgets-4.png'
				)
			)
		),
		// Footer: Custom Logo
		array(
			'id'		=> 'footer-logo',
			'label'		=> esc_html__( 'Footer Logo', 'option-tree' ),
			'desc'		=> esc_html__( 'Upload your custom logo image', 'option-tree' ),
			'type'		=> 'upload',
			'section'	=> 'footer'
		),
		// Footer: Copyright
		array(
			'id'		=> 'copyright',
			'label'		=> esc_html__( 'Footer Copyright', 'option-tree' ),
			'desc'		=> esc_html__( 'Replace the footer copyright text', 'option-tree' ),
			'type'		=> 'text',
			'section'	=> 'footer'
		),
		// Footer: Credit
		array(
			'id'		=> 'credit',
			'label'		=> esc_html__( 'Footer Credit', 'option-tree' ),
			'desc'		=> esc_html__( 'Footer credit text', 'option-tree' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'footer'
		),
		// Layout : Global
		array(
			'id'		=> 'layout-global',
			'label'		=> esc_html__( 'Global Layout', 'option-tree' ),
			'desc'		=> esc_html__( 'Other layouts will override this option if they are set', 'option-tree' ),
			'std'		=> 'col-3cm',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'col-1c',
					'label'		=> esc_html__( '1 Column', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> esc_html__( '2 Column Left', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> esc_html__( '2 Column Right', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> esc_html__( '3 Column Middle', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> esc_html__( '3 Column Left', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> esc_html__( '3 Column Right', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Home
		array(
			'id'		=> 'layout-home',
			'label'		=> esc_html__( 'Home', 'option-tree' ),
			'desc'		=> esc_html__( '(is_home) Posts homepage layout', 'option-tree' ),
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> esc_html__( 'Inherit Global Layout', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> esc_html__( '1 Column', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> esc_html__( '2 Column Left', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> esc_html__( '2 Column Right', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> esc_html__( '3 Column Middle', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> esc_html__( '3 Column Left', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> esc_html__( '3 Column Right', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Single
		array(
			'id'		=> 'layout-single',
			'label'		=> esc_html__( 'Single', 'option-tree' ),
			'desc'		=> esc_html__( '(is_single) Single post layout - If a post has a set layout, it will override this.', 'option-tree' ),
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> esc_html__( 'Inherit Global Layout', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> esc_html__( '1 Column', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> esc_html__( '2 Column Left', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> esc_html__( '2 Column Right', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> esc_html__( '3 Column Middle', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> esc_html__( '3 Column Left', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> esc_html__( '3 Column Right', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Archive
		array(
			'id'		=> 'layout-archive',
			'label'		=> esc_html__( 'Archive', 'option-tree' ),
			'desc'		=> esc_html__( '(is_archive) Category, date, tag and author archive layout', 'option-tree' ),
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> esc_html__( 'Inherit Global Layout', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> esc_html__( '1 Column', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> esc_html__( '2 Column Left', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> esc_html__( '2 Column Right', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> esc_html__( '3 Column Middle', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> esc_html__( '3 Column Left', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> esc_html__( '3 Column Right', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Archive - Category
		array(
			'id'		=> 'layout-archive-category',
			'label'		=> esc_html__( 'Archive &mdash; Category', 'option-tree' ),
			'desc'		=> esc_html__( '(is_category) Category archive layout', 'option-tree' ),
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> esc_html__( 'Inherit Global Layout', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> esc_html__( '1 Column', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> esc_html__( '2 Column Left', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> esc_html__( '2 Column Right', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> esc_html__( '3 Column Middle', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> esc_html__( '3 Column Left', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> esc_html__( '3 Column Right', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Search
		array(
			'id'		=> 'layout-search',
			'label'		=> esc_html__( 'Search', 'option-tree' ),
			'desc'		=> esc_html__( '(is_search) Search page layout', 'option-tree' ),
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> esc_html__( 'Inherit Global Layout', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> esc_html__( '1 Column', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> esc_html__( '2 Column Left', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> esc_html__( '2 Column Right', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> esc_html__( '3 Column Middle', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> esc_html__( '3 Column Left', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> esc_html__( '3 Column Right', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Error 404
		array(
			'id'		=> 'layout-404',
			'label'		=> esc_html__( 'Error 404', 'option-tree' ),
			'desc'		=> esc_html__( '(is_404) Error 404 page layout', 'option-tree' ),
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> esc_html__( 'Inherit Global Layout', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> esc_html__( '1 Column', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> esc_html__( '2 Column Left', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> esc_html__( '2 Column Right', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> esc_html__( '3 Column Middle', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> esc_html__( '3 Column Left', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> esc_html__( '3 Column Right', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Default Page
		array(
			'id'		=> 'layout-page',
			'label'		=> esc_html__( 'Default Page', 'option-tree' ),
			'desc'		=> esc_html__( '(is_page) Default page layout - If a page has a set layout, it will override this.', 'option-tree' ),
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> esc_html__( 'Inherit Global Layout', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> esc_html__( '1 Column', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> esc_html__( '2 Column Left', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> esc_html__( '2 Column Right', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> esc_html__( '3 Column Middle', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> esc_html__( '3 Column Left', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> esc_html__( '3 Column Right', 'option-tree' ),
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Sidebars: Create Areas
		array(
			'id'		=> 'sidebar-areas',
			'label'		=> esc_html__( 'Create Sidebars', 'option-tree' ),
			'desc'		=> esc_html__( 'You must save changes for the new areas to appear below. Warning: Make sure each area has a unique ID.', 'option-tree' ),
			'type'		=> 'list-item',
			'section'	=> 'sidebars',
			'choices'	=> array(),
			'settings'	=> array(
				array(
					'id'		=> 'id',
					'label'		=> esc_html__( 'Sidebar ID', 'option-tree' ),
					'desc'		=> esc_html__( 'This ID must be unique, for example "sidebar-about"', 'option-tree' ),
					'std'		=> 'sidebar-',
					'type'		=> 'text',
					'choices'	=> array()
				)
			)
		),
		// Sidebar 1 & 2
		array(
			'id'		=> 's1-home',
			'label'		=> esc_html__( 'Home', 'option-tree' ),
			'desc'		=> esc_html__( '(is_home) Primary', 'option-tree' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-home',
			'label'		=> esc_html__( 'Home', 'option-tree' ),
			'desc'		=> esc_html__( '(is_home) Secondary', 'option-tree' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-single',
			'label'		=> esc_html__( 'Single', 'option-tree' ),
			'desc'		=> esc_html__( '(is_single) Primary - If a single post has a unique sidebar, it will override this.', 'option-tree' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-single',
			'label'		=> esc_html__( 'Single', 'option-tree' ),
			'desc'		=> esc_html__( '(is_single) Secondary - If a single post has a unique sidebar, it will override this.', 'option-tree' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-archive',
			'label'		=> esc_html__( 'Archive', 'option-tree' ),
			'desc'		=> esc_html__( '(is_archive) Primary', 'option-tree' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-archive',
			'label'		=> esc_html__( 'Archive', 'option-tree' ),
			'desc'		=> esc_html__( '(is_archive) Secondary', 'option-tree' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-archive-category',
			'label'		=> esc_html__( 'Archive &mdash; Category', 'option-tree' ),
			'desc'		=> esc_html__( '(is_category) Primary', 'option-tree' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-archive-category',
			'label'		=> esc_html__( 'Archive &mdash; Category', 'option-tree' ),
			'desc'		=> esc_html__( '(is_category) Secondary', 'option-tree' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-search',
			'label'		=> esc_html__( 'Search', 'option-tree' ),
			'desc'		=> esc_html__( '(is_search) Primary', 'option-tree' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-search',
			'label'		=> esc_html__( 'Search', 'option-tree' ),
			'desc'		=> esc_html__( '(is_search) Secondary', 'option-tree' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-404',
			'label'		=> esc_html__( 'Error 404', 'option-tree' ),
			'desc'		=> esc_html__( '(is_404) Primary', 'option-tree' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-404',
			'label'		=> esc_html__( 'Error 404', 'option-tree' ),
			'desc'		=> esc_html__( '(is_404) Secondary', 'option-tree' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-page',
			'label'		=> esc_html__( 'Default Page', 'option-tree' ),
			'desc'		=> esc_html__( '(is_page) Primary - If a page has a unique sidebar, it will override this.', 'option-tree' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-page',
			'label'		=> esc_html__( 'Default Page', 'option-tree' ),
			'desc'		=> esc_html__( '(is_page) Secondary - If a page has a unique sidebar, it will override this.', 'option-tree' ),
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		// Social Links : List
		array(
			'id'		=> 'social-links',
			'label'		=> esc_html__( 'Social Links', 'option-tree' ),
			'desc'		=> esc_html__( 'Create and organize your social links', 'option-tree' ),
			'type'		=> 'list-item',
			'section'	=> 'social-links',
			'choices'	=> array(),
			'settings'	=> array(
				array(
					'id'		=> 'social-icon',
					'label'		=> esc_html__( 'Icon Name', 'option-tree' ),
					'desc'		=> esc_html__( 'Font Awesome icon names:', 'option-tree' ) . ' <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank"><strong>' . esc_html__( 'View All', 'option-tree' ) . ' </strong></a>',
					'std'		=> 'fa-',
					'type'		=> 'text',
					'choices'	=> array()
				),
				array(
					'id'		=> 'social-link',
					'label'		=> esc_html__( 'Link', 'option-tree' ),
					'desc'		=> esc_html__( 'Enter the full url for your icon button', 'option-tree' ),
					'std'		=> 'http://',
					'type'		=> 'text',
					'choices'	=> array()
				),
				array(
					'id'		=> 'social-color',
					'label'		=> esc_html__( 'Icon Color', 'option-tree' ),
					'desc'		=> esc_html__( 'Set a unique color for your icon (optional)', 'option-tree' ),
					'std'		=> '',
					'type'		=> 'colorpicker',
					'section'	=> 'styling'
				),
				array(
					'id'		=> 'social-target',
					'label'		=> esc_html__( 'Link Options', 'option-tree' ),
					'desc'		=> '',
					'std'		=> '',
					'type'		=> 'checkbox',
					'choices'	=> array(
						array( 
							'value' => '_blank',
							'label' => esc_html__( 'Open in new window', 'option-tree' ),
						)
					)
				)
			)
		),
		// Styling: Enable
		array(
			'id'		=> 'dynamic-styles',
			'label'		=> esc_html__( 'Dynamic Styles', 'option-tree' ),
			'desc'		=> esc_html__( 'Turn on to use the styling options below', 'option-tree' ),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'styling'
		),
		// Styling: Boxed Layout
		array(
			'id'		=> 'boxed',
			'label'		=> esc_html__( 'Boxed Layout', 'option-tree' ),
			'desc'		=> esc_html__( 'Use a boxed layout', 'option-tree' ),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'styling'
		),
		// Styling: Font
		array(
			'id'		=> 'font',
			'label'		=> esc_html__( 'Font', 'option-tree' ),
			'desc'		=> esc_html__( 'Select font for the theme', 'option-tree' ),
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
			'label'			=> esc_html__( 'Website Max-width', 'option-tree' ),
			'desc'			=> esc_html__( 'Max-width of the container. If you use 2 sidebars, your container should be at least 1280px. Note: For 720px content (default) use 1460px for 2 sidebars and 1200px for 1 sidebar. If you use a combination of both, try something inbetween.', 'option-tree' ),
			'std'			=> '1460',
			'type'			=> 'numeric-slider',
			'section'		=> 'styling',
			'min_max_step'	=> '1024,1600,1'
		),
		// Styling: Sidebar Padding
		array(
			'id'		=> 'sidebar-padding',
			'label'		=> esc_html__( 'Sidebar Width', 'option-tree' ),
			'type'		=> 'radio',
			'std'		=> '30',
			'section'	=> 'styling',
			'choices'	=> array(
				array( 
					'value' => '30',
					'label' => esc_html__( '280px primary, 200px secondary (30px padding)', 'option-tree' ),
				),
				array( 
					'value' => '20',
					'label' => esc_html__( '300px primary, 220px secondary (20px padding)', 'option-tree' ),
				)
			)
		),
		// Styling: Primary Color
		array(
			'id'		=> 'color-1',
			'label'		=> esc_html__( 'Primary Color', 'option-tree' ),
			'std'		=> '#e64338',
			'type'		=> 'colorpicker',
			'section'	=> 'styling',
			'class'		=> ''
		),
		// Styling: Comments Bubble
		array(
			'id'		=> 'color-bubble',
			'label'		=> esc_html__( 'Comments Bubble', 'option-tree' ),
			'std'		=> '#f7e696',
			'type'		=> 'colorpicker',
			'section'	=> 'styling',
			'class'		=> ''
		),
		// Styling: Topbar Background
		array(
			'id'		=> 'color-topbar',
			'label'		=> esc_html__( 'Topbar Background', 'option-tree' ),
			'std'		=> '#e64338',
			'type'		=> 'colorpicker',
			'section'	=> 'styling',
			'class'		=> ''
		),
		// Styling: Header Background
		array(
			'id'		=> 'color-header',
			'label'		=> esc_html__( 'Header Background', 'option-tree' ),
			'std'		=> '#23282d',
			'type'		=> 'colorpicker',
			'section'	=> 'styling',
			'class'		=> ''
		),
		// Styling: Header Menu Background
		array(
			'id'		=> 'color-header-menu',
			'label'		=> esc_html__( 'Header Menu Background', 'option-tree' ),
			'std'		=> '',
			'type'		=> 'colorpicker',
			'section'	=> 'styling',
			'class'		=> ''
		),
		// Styling: Footer Menu Background
		array(
			'id'		=> 'color-footer-menu',
			'label'		=> esc_html__( 'Footer Menu Background', 'option-tree' ),
			'std'		=> '#23282d',
			'type'		=> 'colorpicker',
			'section'	=> 'styling',
			'class'		=> ''
		),
		// Styling: Footer Background
		array(
			'id'		=> 'color-footer',
			'label'		=> esc_html__( 'Footer Background', 'option-tree' ),
			'std'		=> '#e64338',
			'type'		=> 'colorpicker',
			'section'	=> 'styling',
			'class'		=> ''
		),
		// Styling: Header Logo Max-height
		array(
			'id'			=> 'logo-max-height',
			'label'			=> esc_html__( 'Header Logo Image Max-height', 'option-tree' ),
			'desc'			=> esc_html__( 'Your logo image should have the double height of this to be high resolution', 'option-tree' ),
			'std'			=> '60',
			'type'			=> 'numeric-slider',
			'section'		=> 'styling',
			'min_max_step'	=> '40,200,1'
		),
		// Styling: Image Border Radius
		array(
			'id'			=> 'image-border-radius',
			'label'			=> esc_html__( 'Image Border Radius', 'option-tree' ),
			'desc'			=> esc_html__( 'Give your thumbnails and layout images rounded corners', 'option-tree' ),
			'std'			=> '3',
			'type'			=> 'numeric-slider',
			'section'		=> 'styling',
			'min_max_step'	=> '0,15,1'
		),
		// Styling: Body Background
		array(
			'id'		=> 'body-background',
			'label'		=> esc_html__( 'Body Background', 'option-tree' ),
			'desc'		=> esc_html__( 'Set background color and/or upload your own background image', 'option-tree' ),
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
