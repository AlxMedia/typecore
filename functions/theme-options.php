<?php
if ( ! class_exists( 'Kirki' ) ) {
	return;
}

/*  Add Config
/* ------------------------------------ */
Kirki::add_config( 'typecore', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

/*  Add Links
/* ------------------------------------ */
Kirki::add_section( 'morelink', array(
	'title'       => esc_html__( 'AlxMedia', 'typecore' ),
	'type'        => 'link',
	'button_text' => esc_html__( 'View More Themes', 'typecore' ),
	'button_url'  => 'http://alx.media/themes/',
	'priority'    => 13,
) );
Kirki::add_section( 'reviewlink', array(
	'title'       => esc_html__( 'Like This Theme?', 'typecore' ),
	'panel'       => 'options',
	'type'        => 'link',
	'button_text' => esc_html__( 'Write a Review', 'typecore' ),
	'button_url'  => 'https://wordpress.org/support/theme/typecore/reviews/#new-post',
	'priority'    => 1,
) );

/*  Add Panels
/* ------------------------------------ */
Kirki::add_panel( 'options', array(
    'priority'    => 10,
    'title'       => esc_html__( 'Theme Options', 'typecore' ),
) );

/*  Add Sections
/* ------------------------------------ */
Kirki::add_section( 'general', array(
    'priority'    => 10,
    'title'       => esc_html__( 'General', 'typecore' ),
	'panel'       => 'options',
) );
Kirki::add_section( 'blog', array(
    'priority'    => 20,
    'title'       => esc_html__( 'Blog', 'typecore' ),
	'panel'       => 'options',
) );
Kirki::add_section( 'header', array(
    'priority'    => 30,
    'title'       => esc_html__( 'Header', 'typecore' ),
	'panel'       => 'options',
) );
Kirki::add_section( 'footer', array(
    'priority'    => 40,
    'title'       => esc_html__( 'Footer', 'typecore' ),
	'panel'       => 'options',
) );
Kirki::add_section( 'layout', array(
    'priority'    => 50,
    'title'       => esc_html__( 'Layout', 'typecore' ),
	'panel'       => 'options',
) );
Kirki::add_section( 'sidebars', array(
    'priority'    => 60,
    'title'       => esc_html__( 'Sidebars', 'typecore' ),
	'panel'       => 'options',
) );
Kirki::add_section( 'social', array(
    'priority'    => 70,
    'title'       => esc_html__( 'Social Links', 'typecore' ),
	'panel'       => 'options',
) );
Kirki::add_section( 'styling', array(
    'priority'    => 80,
    'title'       => esc_html__( 'Styling', 'typecore' ),
	'panel'       => 'options',
) );

/*  Add Fields
/* ------------------------------------ */

// General: Mobile Sidebar
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'radio',
	'settings'		=> 'mobile-sidebar-hide',
	'label'			=> esc_html__( 'Mobile Sidebar Content', 'typecore' ),
	'description'	=> esc_html__( 'Hide sidebar content on low-resolution mobile devices (320px)', 'typecore' ),
	'section'		=> 'general',
	'default'		=> '1',
	'choices'		=> array(
		'1'			=> esc_html__( 'Show sidebars', 'typecore' ),
		's1'		=> esc_html__( 'Hide primary sidebar', 'typecore' ),
		's2'		=> esc_html__( 'Hide secondary sidebar', 'typecore' ),
		's1-s2'		=> esc_html__( 'Hide both sidebars', 'typecore' ),
	),
) );
// General: Recommended Plugins
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'switch',
	'settings'		=> 'recommended-plugins',
	'label'			=> esc_html__( 'Recommended Plugins', 'typecore' ),
	'description'	=> esc_html__( 'Enable or disable the recommended plugins notice', 'typecore' ),
	'section'		=> 'general',
	'default'		=> 'on',
) );
// Blog: Heading
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'text',
	'settings'		=> 'blog-heading',
	'label'			=> esc_html__( 'Heading', 'typecore' ),
	'description'	=> esc_html__( 'Your blog heading', 'typecore' ),
	'section'		=> 'blog',
	'default'		=> '',
) );
// Blog: Subheading
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'text',
	'settings'		=> 'blog-subheading',
	'label'			=> esc_html__( 'Subheading', 'typecore' ),
	'description'	=> esc_html__( 'Your blog subheading', 'typecore' ),
	'section'		=> 'blog',
	'default'		=> '',
) );
// Blog: Excerpt Length
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'slider',
	'settings'		=> 'excerpt-length',
	'label'			=> esc_html__( 'Excerpt Length', 'typecore' ),
	'description'	=> esc_html__( 'Max number of words. Set it to 0 to disable.', 'typecore' ),
	'section'		=> 'blog',
	'default'		=> '24',
	'choices'     => array(
		'min'	=> '0',
		'max'	=> '100',
		'step'	=> '1',
	),
) );
// Blog: Featured Posts Include
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'checkbox',
	'settings'		=> 'featured-posts-include',
	'label'			=> esc_html__( 'Featured Posts', 'typecore' ),
	'description'	=> esc_html__( 'To show featured posts in the slider AND the content below. Usually not recommended.', 'typecore' ),
	'section'		=> 'blog',
	'default'		=> false,
) );
// Blog: Featured Category
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'select',
	'settings'		=> 'featured-category',
	'label'			=> esc_html__( 'Featured Category', 'typecore' ),
	'description'	=> esc_html__( 'By not selecting a category, it will show your latest post(s) from all categories', 'typecore' ),
	'section'		=> 'blog',
	'default'		=> '',
	'choices'		=> Kirki_Helper::get_terms( 'category' ),
	'placeholder'	=> esc_html__( 'Select a category', 'typecore' ),
) );
// Blog: Featured Post Count
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'slider',
	'settings'		=> 'featured-posts-count',
	'label'			=> esc_html__( 'Featured Post Count', 'typecore' ),
	'description'	=> esc_html__( 'Max number of featured posts to display. Set to 1 and it will show it without any slider script. Set it to 0 to disable', 'typecore' ),
	'section'		=> 'blog',
	'default'		=> '3',
	'choices'     => array(
		'min'	=> '0',
		'max'	=> '10',
		'step'	=> '1',
	),
) );
// Blog: Highlights
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'switch',
	'settings'		=> 'highlights',
	'label'			=> esc_html__( 'Highlights', 'typecore' ),
	'description'	=> esc_html__( '3 small items below the slider', 'typecore' ),
	'section'		=> 'blog',
	'default'		=> 'on',
) );
// Blog: Highlights Category
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'select',
	'settings'		=> 'highlight-category',
	'label'			=> esc_html__( 'Highlights Category', 'typecore' ),
	'description'	=> esc_html__( 'The 3 latest posts', 'typecore' ),
	'section'		=> 'blog',
	'default'		=> '',
	'choices'		=> Kirki_Helper::get_terms( 'category' ),
	'placeholder'	=> esc_html__( 'Select a category', 'typecore' ),
) );
// Blog: Picks
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'switch',
	'settings'		=> 'picks',
	'label'			=> esc_html__( 'Picks', 'typecore' ),
	'description'	=> esc_html__( '2 small items at the bottom of the page', 'typecore' ),
	'section'		=> 'blog',
	'default'		=> 'on',
) );
// Blog: Picks Category
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'select',
	'settings'		=> 'picks-category',
	'label'			=> esc_html__( 'Picks Category', 'typecore' ),
	'description'	=> esc_html__( 'The 2 latest posts', 'typecore' ),
	'section'		=> 'blog',
	'default'		=> '',
	'choices'		=> Kirki_Helper::get_terms( 'category' ),
	'placeholder'	=> esc_html__( 'Select a category', 'typecore' ),
) );
// Blog: Frontpage Widgets Top
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'switch',
	'settings'		=> 'frontpage-widgets-top',
	'label'			=> esc_html__( 'Frontpage Widgets Top', 'typecore' ),
	'description'	=> esc_html__( '2 columns of widgets', 'typecore' ),
	'section'		=> 'blog',
	'default'		=> 'off',
) );
// Blog: Frontpage Widgets Bottom
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'switch',
	'settings'		=> 'frontpage-widgets-bottom',
	'label'			=> esc_html__( 'Frontpage Widgets Bottom', 'typecore' ),
	'description'	=> esc_html__( '2 columns of widgets', 'typecore' ),
	'section'		=> 'blog',
	'default'		=> 'off',
) );
// Blog: Standard
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'switch',
	'settings'		=> 'blog-standard',
	'label'			=> esc_html__( 'Standard Blog List', 'typecore' ),
	'description'	=> esc_html__( 'Show one post per row, image beside text', 'typecore' ),
	'section'		=> 'blog',
	'default'		=> 'off',
) );
// Blog: Thumbnail Placeholder
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'switch',
	'settings'		=> 'placeholder',
	'label'			=> esc_html__( 'Thumbnail Placeholder', 'typecore' ),
	'description'	=> esc_html__( 'Show featured image placeholders if no featured image is set', 'typecore' ),
	'section'		=> 'blog',
	'default'		=> 'on',
) );
// Blog: Thumbnail Comment Count
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'switch',
	'settings'		=> 'comment-count',
	'label'			=> esc_html__( 'Thumbnail Comment Count', 'typecore' ),
	'description'	=> esc_html__( 'Comment count on thumbnails', 'typecore' ),
	'section'		=> 'blog',
	'default'		=> 'on',
) );
// Blog: Single - Authorbox
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'switch',
	'settings'		=> 'author-bio',
	'label'			=> esc_html__( 'Single - Author Bio', 'typecore' ),
	'description'	=> esc_html__( 'Shows post author description, if it exists', 'typecore' ),
	'section'		=> 'blog',
	'default'		=> 'on',
) );
// Blog: Single - Related Posts
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'radio',
	'settings'		=> 'related-posts',
	'label'			=> esc_html__( 'Single - Related Posts', 'typecore' ),
	'description'	=> esc_html__( 'Shows randomized related articles below the post', 'typecore' ),
	'section'		=> 'blog',
	'default'		=> 'categories',
	'choices'		=> array(
		'disable'	=> esc_html__( 'Disable', 'typecore' ),
		'categories'=> esc_html__( 'Related by categories', 'typecore' ),
		'tags'		=> esc_html__( 'Related by tags', 'typecore' ),
	),
) );
// Blog: Single - Post Navigation
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'radio',
	'settings'		=> 'post-nav',
	'label'			=> esc_html__( 'Single - Post Navigation', 'typecore' ),
	'description'	=> esc_html__( 'Shows links to the next and previous article', 'typecore' ),
	'section'		=> 'blog',
	'default'		=> 's1',
	'choices'		=> array(
		'disable'	=> esc_html__( 'Disable', 'typecore' ),
		's1'		=> esc_html__( 'Sidebar Primary', 'typecore' ),
		's2'		=> esc_html__( 'Sidebar Secondary', 'typecore' ),
		'content'	=> esc_html__( 'Below content', 'typecore' ),
	),
) );
// Header: Ads
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'switch',
	'settings'		=> 'header-ads',
	'label'			=> esc_html__( 'Header Ads', 'typecore' ),
	'description'	=> esc_html__( 'Header widget ads area', 'typecore' ),
	'section'		=> 'header',
	'default'		=> 'off',
) );
// Header: Search
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'switch',
	'settings'		=> 'header-search',
	'label'			=> esc_html__( 'Header Search', 'typecore' ),
	'description'	=> esc_html__( 'Header search button', 'typecore' ),
	'section'		=> 'header',
	'default'		=> 'on',
) );
// Header: Social Links
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'switch',
	'settings'		=> 'header-social',
	'label'			=> esc_html__( 'Header Social Links', 'typecore' ),
	'description'	=> esc_html__( 'Social link icon buttons', 'typecore' ),
	'section'		=> 'header',
	'default'		=> 'on',
) );
// Footer: Ads
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'switch',
	'settings'		=> 'footer-ads',
	'label'			=> esc_html__( 'Footer Ads', 'typecore' ),
	'description'	=> esc_html__( 'Footer widget ads area', 'typecore' ),
	'section'		=> 'footer',
	'default'		=> 'off',
) );
// Footer: Widget Columns
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'radio-image',
	'settings'		=> 'footer-widgets',
	'label'			=> esc_html__( 'Footer Widget Columns', 'typecore' ),
	'description'	=> esc_html__( 'Select columns to enable footer widgets. Recommended number: 3', 'typecore' ),
	'section'		=> 'footer',
	'default'		=> '0',
	'choices'     => array(
		'0'	=> get_template_directory_uri() . '/functions/images/layout-off.png',
		'1'	=> get_template_directory_uri() . '/functions/images/footer-widgets-1.png',
		'2'	=> get_template_directory_uri() . '/functions/images/footer-widgets-2.png',
		'3'	=> get_template_directory_uri() . '/functions/images/footer-widgets-3.png',
		'4'	=> get_template_directory_uri() . '/functions/images/footer-widgets-4.png',
	),
) );
// Footer: Social Links
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'switch',
	'settings'		=> 'footer-social',
	'label'			=> esc_html__( 'Footer Social Links', 'typecore' ),
	'description'	=> esc_html__( 'Social link icon buttons', 'typecore' ),
	'section'		=> 'footer',
	'default'		=> 'on',
) );
// Footer: Custom Logo
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'image',
	'settings'		=> 'footer-logo',
	'label'			=> esc_html__( 'Footer Logo', 'typecore' ),
	'description'	=> esc_html__( 'Upload your custom logo image', 'typecore' ),
	'section'		=> 'footer',
	'default'		=> '',
) );
// Footer: Copyright
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'text',
	'settings'		=> 'copyright',
	'label'			=> esc_html__( 'Footer Copyright', 'typecore' ),
	'description'	=> esc_html__( 'Replace the footer copyright text', 'typecore' ),
	'section'		=> 'footer',
	'default'		=> '',
) );
// Footer: Credit
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'switch',
	'settings'		=> 'credit',
	'label'			=> esc_html__( 'Footer Credit', 'typecore' ),
	'description'	=> esc_html__( 'Footer credit text', 'typecore' ),
	'section'		=> 'footer',
	'default'		=> 'on',
) );
// Layout: Global
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'radio-image',
	'settings'		=> 'layout-global',
	'label'			=> esc_html__( 'Global Layout', 'typecore' ),
	'description'	=> esc_html__( 'Other layouts will override this option if they are set', 'typecore' ),
	'section'		=> 'layout',
	'default'		=> 'col-3cm',
	'choices'     => array(
		'col-1c'	=> get_template_directory_uri() . '/functions/images/col-1c.png',
		'col-2cl'	=> get_template_directory_uri() . '/functions/images/col-2cl.png',
		'col-2cr'	=> get_template_directory_uri() . '/functions/images/col-2cr.png',
		'col-3cm'	=> get_template_directory_uri() . '/functions/images/col-3cm.png',
		'col-3cl'	=> get_template_directory_uri() . '/functions/images/col-3cl.png',
		'col-3cr'	=> get_template_directory_uri() . '/functions/images/col-3cr.png',
	),
) );
// Layout: Home
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'radio-image',
	'settings'		=> 'layout-home',
	'label'			=> esc_html__( 'Home', 'typecore' ),
	'description'	=> esc_html__( '(is_home) Posts homepage layout', 'typecore' ),
	'section'		=> 'layout',
	'default'		=> 'inherit',
	'choices'     => array(
		'inherit'	=> get_template_directory_uri() . '/functions/images/layout-off.png',
		'col-1c'	=> get_template_directory_uri() . '/functions/images/col-1c.png',
		'col-2cl'	=> get_template_directory_uri() . '/functions/images/col-2cl.png',
		'col-2cr'	=> get_template_directory_uri() . '/functions/images/col-2cr.png',
		'col-3cm'	=> get_template_directory_uri() . '/functions/images/col-3cm.png',
		'col-3cl'	=> get_template_directory_uri() . '/functions/images/col-3cl.png',
		'col-3cr'	=> get_template_directory_uri() . '/functions/images/col-3cr.png',
	),
) );
// Layout: Single
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'radio-image',
	'settings'		=> 'layout-single',
	'label'			=> esc_html__( 'Single', 'typecore' ),
	'description'	=> esc_html__( '(is_single) Single post layout - If a post has a set layout, it will override this.', 'typecore' ),
	'section'		=> 'layout',
	'default'		=> 'inherit',
	'choices'     => array(
		'inherit'	=> get_template_directory_uri() . '/functions/images/layout-off.png',
		'col-1c'	=> get_template_directory_uri() . '/functions/images/col-1c.png',
		'col-2cl'	=> get_template_directory_uri() . '/functions/images/col-2cl.png',
		'col-2cr'	=> get_template_directory_uri() . '/functions/images/col-2cr.png',
		'col-3cm'	=> get_template_directory_uri() . '/functions/images/col-3cm.png',
		'col-3cl'	=> get_template_directory_uri() . '/functions/images/col-3cl.png',
		'col-3cr'	=> get_template_directory_uri() . '/functions/images/col-3cr.png',
	),
) );
// Layout: Archive
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'radio-image',
	'settings'		=> 'layout-archive',
	'label'			=> esc_html__( 'Archive', 'typecore' ),
	'description'	=> esc_html__( '(is_archive) Category, date, tag and author archive layout', 'typecore' ),
	'section'		=> 'layout',
	'default'		=> 'inherit',
	'choices'     => array(
		'inherit'	=> get_template_directory_uri() . '/functions/images/layout-off.png',
		'col-1c'	=> get_template_directory_uri() . '/functions/images/col-1c.png',
		'col-2cl'	=> get_template_directory_uri() . '/functions/images/col-2cl.png',
		'col-2cr'	=> get_template_directory_uri() . '/functions/images/col-2cr.png',
		'col-3cm'	=> get_template_directory_uri() . '/functions/images/col-3cm.png',
		'col-3cl'	=> get_template_directory_uri() . '/functions/images/col-3cl.png',
		'col-3cr'	=> get_template_directory_uri() . '/functions/images/col-3cr.png',
	),
) );
// Layout : Archive - Category
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'radio-image',
	'settings'		=> 'layout-archive-category',
	'label'			=> esc_html__( 'Archive - Category', 'typecore' ),
	'description'	=> esc_html__( '(is_category) Category archive layout', 'typecore' ),
	'section'		=> 'layout',
	'default'		=> 'inherit',
	'choices'     => array(
		'inherit'	=> get_template_directory_uri() . '/functions/images/layout-off.png',
		'col-1c'	=> get_template_directory_uri() . '/functions/images/col-1c.png',
		'col-2cl'	=> get_template_directory_uri() . '/functions/images/col-2cl.png',
		'col-2cr'	=> get_template_directory_uri() . '/functions/images/col-2cr.png',
		'col-3cm'	=> get_template_directory_uri() . '/functions/images/col-3cm.png',
		'col-3cl'	=> get_template_directory_uri() . '/functions/images/col-3cl.png',
		'col-3cr'	=> get_template_directory_uri() . '/functions/images/col-3cr.png',
	),
) );
// Layout: Search
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'radio-image',
	'settings'		=> 'layout-search',
	'label'			=> esc_html__( 'Search', 'typecore' ),
	'description'	=> esc_html__( '(is_search) Search page layout', 'typecore' ),
	'section'		=> 'layout',
	'default'		=> 'inherit',
	'choices'     => array(
		'inherit'	=> get_template_directory_uri() . '/functions/images/layout-off.png',
		'col-1c'	=> get_template_directory_uri() . '/functions/images/col-1c.png',
		'col-2cl'	=> get_template_directory_uri() . '/functions/images/col-2cl.png',
		'col-2cr'	=> get_template_directory_uri() . '/functions/images/col-2cr.png',
		'col-3cm'	=> get_template_directory_uri() . '/functions/images/col-3cm.png',
		'col-3cl'	=> get_template_directory_uri() . '/functions/images/col-3cl.png',
		'col-3cr'	=> get_template_directory_uri() . '/functions/images/col-3cr.png',
	),
) );
// Layout: Error 404
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'radio-image',
	'settings'		=> 'layout-404',
	'label'			=> esc_html__( 'Error 404', 'typecore' ),
	'description'	=> esc_html__( '(is_404) Error 404 page layout', 'typecore' ),
	'section'		=> 'layout',
	'default'		=> 'inherit',
	'choices'     => array(
		'inherit'	=> get_template_directory_uri() . '/functions/images/layout-off.png',
		'col-1c'	=> get_template_directory_uri() . '/functions/images/col-1c.png',
		'col-2cl'	=> get_template_directory_uri() . '/functions/images/col-2cl.png',
		'col-2cr'	=> get_template_directory_uri() . '/functions/images/col-2cr.png',
		'col-3cm'	=> get_template_directory_uri() . '/functions/images/col-3cm.png',
		'col-3cl'	=> get_template_directory_uri() . '/functions/images/col-3cl.png',
		'col-3cr'	=> get_template_directory_uri() . '/functions/images/col-3cr.png',
	),
) );
// Layout: Default Page
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'radio-image',
	'settings'		=> 'layout-page',
	'label'			=> esc_html__( 'Default Page', 'typecore' ),
	'description'	=> esc_html__( '(is_page) Default page layout - If a page has a set layout, it will override this.', 'typecore' ),
	'section'		=> 'layout',
	'default'		=> 'inherit',
	'choices'     => array(
		'inherit'	=> get_template_directory_uri() . '/functions/images/layout-off.png',
		'col-1c'	=> get_template_directory_uri() . '/functions/images/col-1c.png',
		'col-2cl'	=> get_template_directory_uri() . '/functions/images/col-2cl.png',
		'col-2cr'	=> get_template_directory_uri() . '/functions/images/col-2cr.png',
		'col-3cm'	=> get_template_directory_uri() . '/functions/images/col-3cm.png',
		'col-3cl'	=> get_template_directory_uri() . '/functions/images/col-3cl.png',
		'col-3cr'	=> get_template_directory_uri() . '/functions/images/col-3cr.png',
	),
) );


function typecore_kirki_sidebars_select() { 
 	$sidebars = array(); 
 	if ( isset( $GLOBALS['wp_registered_sidebars'] ) ) { 
 		$sidebars = $GLOBALS['wp_registered_sidebars']; 
 	} 
 	$sidebars_choices = array(); 
 	foreach ( $sidebars as $sidebar ) { 
 		$sidebars_choices[ $sidebar['id'] ] = $sidebar['name']; 
 	} 
 	if ( ! class_exists( 'Kirki' ) ) { 
 		return; 
 	}
	// Sidebars: Select
	Kirki::add_field( 'typecore_theme', array(
		'type'			=> 'select',
		'settings'		=> 's1-home',
		'label'			=> esc_html__( 'Home', 'typecore' ),
		'description'	=> esc_html__( '(is_home) Primary', 'typecore' ),
		'section'		=> 'sidebars',
		'choices'		=> $sidebars_choices, 
		'default'		=> '',
		'placeholder'	=> esc_html__( 'Select a sidebar', 'typecore' ),
	) );
	Kirki::add_field( 'typecore_theme', array(
		'type'			=> 'select',
		'settings'		=> 's2-home',
		'label'			=> esc_html__( 'Home', 'typecore' ),
		'description'	=> esc_html__( '(is_home) Secondary', 'typecore' ),
		'section'		=> 'sidebars',
		'choices'		=> $sidebars_choices, 
		'default'		=> '',
		'placeholder'	=> esc_html__( 'Select a sidebar', 'typecore' ),
	) );
	Kirki::add_field( 'typecore_theme', array(
		'type'			=> 'select',
		'settings'		=> 's1-single',
		'label'			=> esc_html__( 'Single', 'typecore' ),
		'description'	=> esc_html__( '(is_single) Primary - If a single post has a unique sidebar, it will override this.', 'typecore' ),
		'section'		=> 'sidebars',
		'choices'		=> $sidebars_choices, 
		'default'		=> '',
		'placeholder'	=> esc_html__( 'Select a sidebar', 'typecore' ),
	) );
	Kirki::add_field( 'typecore_theme', array(
		'type'			=> 'select',
		'settings'		=> 's2-single',
		'label'			=> esc_html__( 'Single', 'typecore' ),
		'description'	=> esc_html__( '(is_single) Secondary - If a single post has a unique sidebar, it will override this.', 'typecore' ),
		'section'		=> 'sidebars',
		'choices'		=> $sidebars_choices, 
		'default'		=> '',
		'placeholder'	=> esc_html__( 'Select a sidebar', 'typecore' ),
	) );
	Kirki::add_field( 'typecore_theme', array(
		'type'			=> 'select',
		'settings'		=> 's1-archive',
		'label'			=> esc_html__( 'Archive', 'typecore' ),
		'description'	=> esc_html__( '(is_archive) Primary', 'typecore' ),
		'section'		=> 'sidebars',
		'choices'		=> $sidebars_choices, 
		'default'		=> '',
		'placeholder'	=> esc_html__( 'Select a sidebar', 'typecore' ),
	) );
	Kirki::add_field( 'typecore_theme', array(
		'type'			=> 'select',
		'settings'		=> 's2-archive',
		'label'			=> esc_html__( 'Archive', 'typecore' ),
		'description'	=> esc_html__( '(is_archive) Secondary', 'typecore' ),
		'section'		=> 'sidebars',
		'choices'		=> $sidebars_choices, 
		'default'		=> '',
		'placeholder'	=> esc_html__( 'Select a sidebar', 'typecore' ),
	) );
	Kirki::add_field( 'typecore_theme', array(
		'type'			=> 'select',
		'settings'		=> 's1-archive-category',
		'label'			=> esc_html__( 'Archive - Category', 'typecore' ),
		'description'	=> esc_html__( '(is_category) Primary', 'typecore' ),
		'section'		=> 'sidebars',
		'choices'		=> $sidebars_choices, 
		'default'		=> '',
		'placeholder'	=> esc_html__( 'Select a sidebar', 'typecore' ),
	) );
	Kirki::add_field( 'typecore_theme', array(
		'type'			=> 'select',
		'settings'		=> 's2-archive-category',
		'label'			=> esc_html__( 'Archive - Category', 'typecore' ),
		'description'	=> esc_html__( '(is_category) Secondary', 'typecore' ),
		'section'		=> 'sidebars',
		'choices'		=> $sidebars_choices, 
		'default'		=> '',
		'placeholder'	=> esc_html__( 'Select a sidebar', 'typecore' ),
	) );
	Kirki::add_field( 'typecore_theme', array(
		'type'			=> 'select',
		'settings'		=> 's1-search',
		'label'			=> esc_html__( 'Search', 'typecore' ),
		'description'	=> esc_html__( '(is_search) Primary', 'typecore' ),
		'section'		=> 'sidebars',
		'choices'		=> $sidebars_choices, 
		'default'		=> '',
		'placeholder'	=> esc_html__( 'Select a sidebar', 'typecore' ),
	) );
	Kirki::add_field( 'typecore_theme', array(
		'type'			=> 'select',
		'settings'		=> 's2-search',
		'label'			=> esc_html__( 'Search', 'typecore' ),
		'description'	=> esc_html__( '(is_search) Secondary', 'typecore' ),
		'section'		=> 'sidebars',
		'choices'		=> $sidebars_choices, 
		'default'		=> '',
		'placeholder'	=> esc_html__( 'Select a sidebar', 'typecore' ),
	) );
	Kirki::add_field( 'typecore_theme', array(
		'type'			=> 'select',
		'settings'		=> 's1-404',
		'label'			=> esc_html__( 'Error 404', 'typecore' ),
		'description'	=> esc_html__( '(is_404) Primary', 'typecore' ),
		'section'		=> 'sidebars',
		'choices'		=> $sidebars_choices, 
		'default'		=> '',
		'placeholder'	=> esc_html__( 'Select a sidebar', 'typecore' ),
	) );
	Kirki::add_field( 'typecore_theme', array(
		'type'			=> 'select',
		'settings'		=> 's2-404',
		'label'			=> esc_html__( 'Error 404', 'typecore' ),
		'description'	=> esc_html__( '(is_404) Secondary', 'typecore' ),
		'section'		=> 'sidebars',
		'choices'		=> $sidebars_choices, 
		'default'		=> '',
		'placeholder'	=> esc_html__( 'Select a sidebar', 'typecore' ),
	) );
	Kirki::add_field( 'typecore_theme', array(
		'type'			=> 'select',
		'settings'		=> 's1-page',
		'label'			=> esc_html__( 'Default Page', 'typecore' ),
		'description'	=> esc_html__( '(is_page) Primary - If a page has a unique sidebar, it will override this.', 'typecore' ),
		'section'		=> 'sidebars',
		'choices'		=> $sidebars_choices, 
		'default'		=> '',
		'placeholder'	=> esc_html__( 'Select a sidebar', 'typecore' ),
	) );
	Kirki::add_field( 'typecore_theme', array(
		'type'			=> 'select',
		'settings'		=> 's2-page',
		'label'			=> esc_html__( 'Default Page', 'typecore' ),
		'description'	=> esc_html__( '(is_page) Secondary - If a page has a unique sidebar, it will override this.', 'typecore' ),
		'section'		=> 'sidebars',
		'choices'		=> $sidebars_choices, 
		'default'		=> '',
		'placeholder'	=> esc_html__( 'Select a sidebar', 'typecore' ),
	) );
	
 } 
add_action( 'init', 'typecore_kirki_sidebars_select', 999 ); 

// Social Links: List
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'repeater',
	'label'			=> esc_html__( 'Create Social Links', 'typecore' ),
	'description'	=> esc_html__( 'Create and organize your social links', 'typecore' ),
	'section'		=> 'social',
	'tooltip'		=> esc_html__( 'Font Awesome names:', 'typecore' ) . ' <a href="https://fontawesome.com/icons?d=gallery&s=brands&m=free" target="_blank"><strong>' . esc_html__( 'View All', 'typecore' ) . ' </strong></a>',
	'row_label'		=> array(
		'type'	=> 'text',
		'value'	=> esc_html__('social link', 'typecore' ),
	),
	'settings'		=> 'social-links',
	'default'		=> '',
	'fields'		=> array(
		'social-title'	=> array(
			'type'			=> 'text',
			'label'			=> esc_html__( 'Title', 'typecore' ),
			'description'	=> esc_html__( 'Ex: Facebook', 'typecore' ),
			'default'		=> '',
		),
		'social-icon'	=> array(
			'type'			=> 'text',
			'label'			=> esc_html__( 'Icon Name', 'typecore' ),
			'description'	=> esc_html__( 'Font Awesome icons. Ex: fa-facebook ', 'typecore' ) . ' <a href="https://fontawesome.com/icons?d=gallery&s=brands&m=free" target="_blank"><strong>' . esc_html__( 'View All', 'typecore' ) . ' </strong></a>',
			'default'		=> 'fa-',
		),
		'social-link'	=> array(
			'type'			=> 'link',
			'label'			=> esc_html__( 'Link', 'typecore' ),
			'description'	=> esc_html__( 'Enter the full url for your icon button', 'typecore' ),
			'default'		=> 'http://',
		),
		'social-color'	=> array(
			'type'			=> 'color',
			'label'			=> esc_html__( 'Icon Color', 'typecore' ),
			'description'	=> esc_html__( 'Set a unique color for your icon (optional)', 'typecore' ),
			'default'		=> '',
		),
		'social-target'	=> array(
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Open in new window', 'typecore' ),
			'default'		=> false,
		),
	)
) );
// Styling: Enable
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'switch',
	'settings'		=> 'dynamic-styles',
	'label'			=> esc_html__( 'Dynamic Styles', 'typecore' ),
	'description'	=> esc_html__( 'Turn on to use the styling options below', 'typecore' ),
	'section'		=> 'styling',
	'default'		=> 'on',
) );
// Styling: Light Layout
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'switch',
	'settings'		=> 'light',
	'label'			=> esc_html__( 'Light Layout', 'typecore' ),
	'description'	=> esc_html__( 'Light colors', 'typecore' ),
	'section'		=> 'styling',
	'default'		=> 'off',
) );
// Styling: Centered Layout
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'switch',
	'settings'		=> 'center',
	'label'			=> esc_html__( 'Center Layout', 'typecore' ),
	'description'	=> esc_html__( 'Center the layout', 'typecore' ),
	'section'		=> 'styling',
	'default'		=> 'off',
) );
// Styling: Boxed Layout
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'switch',
	'settings'		=> 'boxed',
	'label'			=> esc_html__( 'Boxed Layout', 'typecore' ),
	'description'	=> esc_html__( 'Use a boxed layout', 'typecore' ),
	'section'		=> 'styling',
	'default'		=> 'off',
) );
// Styling: Font
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'select',
	'settings'		=> 'font',
	'label'			=> esc_html__( 'Font', 'typecore' ),
	'description'	=> esc_html__( 'Select font for the theme', 'typecore' ),
	'section'		=> 'styling',
	'default'		=> 'roboto-condensed',
	'choices'     => array(
		'titillium-web'			=> esc_html__( 'Titillium Web, Latin (Self-hosted)', 'typecore' ),
		'titillium-web-ext'		=> esc_html__( 'Titillium Web, Latin-Ext', 'typecore' ),
		'droid-serif'			=> esc_html__( 'Droid Serif, Latin', 'typecore' ),
		'source-sans-pro'		=> esc_html__( 'Source Sans Pro, Latin-Ext', 'typecore' ),
		'lato'					=> esc_html__( 'Lato, Latin', 'typecore' ),
		'raleway'				=> esc_html__( 'Raleway, Latin', 'typecore' ),
		'ubuntu'				=> esc_html__( 'Ubuntu, Latin-Ext', 'typecore' ),
		'ubuntu-cyr'			=> esc_html__( 'Ubuntu, Latin / Cyrillic-Ext', 'typecore' ),
		'roboto'				=> esc_html__( 'Roboto, Latin-Ext', 'typecore' ),
		'roboto-cyr'			=> esc_html__( 'Roboto, Latin / Cyrillic-Ext', 'typecore' ),
		'roboto-condensed'		=> esc_html__( 'Roboto Condensed, Latin-Ext', 'typecore' ),
		'roboto-condensed-cyr'	=> esc_html__( 'Roboto Condensed, Latin / Cyrillic-Ext', 'typecore' ),
		'roboto-slab'			=> esc_html__( 'Roboto Slab, Latin-Ext', 'typecore' ),
		'roboto-slab-cyr'		=> esc_html__( 'Roboto Slab, Latin / Cyrillic-Ext', 'typecore' ),
		'playfair-display'		=> esc_html__( 'Playfair Display, Latin-Ext', 'typecore' ),
		'playfair-display-cyr'	=> esc_html__( 'Playfair Display, Latin / Cyrillic', 'typecore' ),
		'open-sans'				=> esc_html__( 'Open Sans, Latin-Ext', 'typecore' ),
		'open-sans-cyr'			=> esc_html__( 'Open Sans, Latin / Cyrillic-Ext', 'typecore' ),
		'pt-serif'				=> esc_html__( 'PT Serif, Latin-Ext', 'typecore' ),
		'pt-serif-cyr'			=> esc_html__( 'PT Serif, Latin / Cyrillic-Ext', 'typecore' ),
		'arial'					=> esc_html__( 'Arial', 'typecore' ),
		'georgia'				=> esc_html__( 'Georgia', 'typecore' ),
		'verdana'				=> esc_html__( 'Verdana', 'typecore' ),
		'tahoma'				=> esc_html__( 'Tahoma', 'typecore' ),
	),
) );
// Styling: Container Width
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'slider',
	'settings'		=> 'container-width',
	'label'			=> esc_html__( 'Website Max-width', 'typecore' ),
	'description'	=> esc_html__( 'Max-width of the container. If you use 2 sidebars, your container should be at least 1280px. Note: For 720px content (default) use 1460px for 2 sidebars and 1200px for 1 sidebar. If you use a combination of both, try something inbetween.', 'typecore' ),
	'section'		=> 'styling',
	'default'		=> '1460',
	'choices'     => array(
		'min'	=> '1024',
		'max'	=> '1600',
		'step'	=> '1',
	),
) );
// Styling: Sidebar Width
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'radio',
	'settings'		=> 'sidebar-padding',
	'label'			=> esc_html__( 'Sidebar Width', 'typecore' ),
	'section'		=> 'styling',
	'default'		=> '30',
	'choices'		=> array(
		'30'	=> esc_html__( '280px primary (30px padding)', 'typecore' ),
		'20'	=> esc_html__( '300px primary (20px padding)', 'typecore' ),
	),
) );
// Styling: Primary Color
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'color',
	'settings'		=> 'color-1',
	'label'			=> esc_html__( 'Primary Color', 'typecore' ),
	'section'		=> 'styling',
	'default'		=> '#e64338',
) );
// Styling: Comments Bubble
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'color',
	'settings'		=> 'color-bubble',
	'label'			=> esc_html__( 'Comments Bubble', 'typecore' ),
	'section'		=> 'styling',
	'default'		=> '#f7e696',
) );
// Styling: Mobile Menu Background
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'color',
	'settings'		=> 'color-mobile-menu',
	'label'			=> esc_html__( 'Mobile Menu Background', 'typecore' ),
	'section'		=> 'styling',
	'default'		=> '#e64338',
) );
// Styling: Topbar Menu Background
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'color',
	'settings'		=> 'color-topbar-menu',
	'label'			=> esc_html__( 'Topbar Menu Background', 'typecore' ),
	'section'		=> 'styling',
	'default'		=> '#e64338',
) );
// Styling: Header Background
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'color',
	'settings'		=> 'color-header',
	'label'			=> esc_html__( 'Header Background', 'typecore' ),
	'section'		=> 'styling',
	'default'		=> '#23282d',
) );
// Styling: Header Menu Background
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'color',
	'settings'		=> 'color-header-menu',
	'label'			=> esc_html__( 'Header Menu Background', 'typecore' ),
	'section'		=> 'styling',
	'default'		=> '',
) );
// Styling: Footer Menu Background
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'color',
	'settings'		=> 'color-footer-menu',
	'label'			=> esc_html__( 'Footer Menu Background', 'typecore' ),
	'section'		=> 'styling',
	'default'		=> '',
) );
// Styling: Footer Background
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'color',
	'settings'		=> 'color-footer',
	'label'			=> esc_html__( 'Footer Background', 'typecore' ),
	'section'		=> 'styling',
	'default'		=> '#e64338',
) );
// Styling: Header Logo Max-height
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'slider',
	'settings'		=> 'logo-max-height',
	'label'			=> esc_html__( 'Header Logo Image Max-height', 'typecore' ),
	'description'	=> esc_html__( 'Your logo image should have the double height of this to be high resolution', 'typecore' ),
	'section'		=> 'styling',
	'default'		=> '60',
	'choices'     => array(
		'min'	=> '40',
		'max'	=> '200',
		'step'	=> '1',
	),
) );
// Styling: Image Border Radius
Kirki::add_field( 'typecore_theme', array(
	'type'			=> 'slider',
	'settings'		=> 'image-border-radius',
	'label'			=> esc_html__( 'Image Border Radius', 'typecore' ),
	'description'	=> esc_html__( 'Give your thumbnails and layout images rounded corners', 'typecore' ),
	'section'		=> 'styling',
	'default'		=> '3',
	'choices'     => array(
		'min'	=> '0',
		'max'	=> '15',
		'step'	=> '1',
	),
) );