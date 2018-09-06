<?php
function typecore_get_meta_box( $meta_boxes ) {

	/* do not show */
	$prefix = '_';

	/* get sidebars */
	$sidebars = array();
 	if ( isset( $GLOBALS['wp_registered_sidebars'] ) ) {
 		$sidebars = $GLOBALS['wp_registered_sidebars'];
 	}
 	$sidebars_choices = array();
 	foreach ( $sidebars as $sidebar ) {
 		$sidebars_choices[ $sidebar['id'] ] = $sidebar['name'];
 	}

/*  Page options
/* ------------------------------------ */
	$meta_boxes[] = array(
		'id' => 'page-options',
		'title' => esc_html__( 'Page Options', 'typecore' ),
		'post_types' => array( 'page' ),
		'context' => 'advanced',
		'priority' => 'high',
		'autosave' => false,
		'fields' => array(
			array(
				'id' => $prefix . 'sidebar_primary',
				'name' => esc_html__( 'Primary Sidebar', 'typecore' ),
				'type' => 'select',
				'placeholder' => esc_html__( 'Select a sidebar', 'typecore' ),
				'options' => $sidebars_choices,
			),
			array(
				'id' => $prefix . 'sidebar_secondary',
				'name' => esc_html__( 'Secondary Sidebar', 'typecore' ),
				'type' => 'select',
				'placeholder' => esc_html__( 'Select a sidebar', 'typecore' ),
				'options' => $sidebars_choices,
			),
			array(
				'id' => $prefix . 'layout',
				'type' => 'image_select',
				'name' => esc_html__( 'Layout', 'typecore' ),
				'std' => 'inherit',
				'force_delete' => false,
				'max_file_uploads' => '4',
				'options' => array(
					'inherit' => get_template_directory_uri() . '/functions/images/layout-off.png',
					'col-1c' => get_template_directory_uri() . '/functions/images/col-1c.png',
					'col-2cl' => get_template_directory_uri() . '/functions/images/col-2cl.png',
					'col-2cr' => get_template_directory_uri() . '/functions/images/col-2cr.png',
					'col-3cm' => get_template_directory_uri() . '/functions/images/col-3cm.png',
					'col-3cl' => get_template_directory_uri() . '/functions/images/col-3cl.png',
					'col-3cr' => get_template_directory_uri() . '/functions/images/col-3cr.png',
				),
			),
		),
	);

/*  Post options
/* ------------------------------------ */
	$meta_boxes[] = array(
		'id' => 'post-options',
		'title' => esc_html__( 'Post Options', 'typecore' ),
		'post_types' => array( 'post' ),
		'context' => 'advanced',
		'priority' => 'high',
		'autosave' => false,
		'fields' => array(
			array(
				'id' => $prefix . 'sidebar_primary',
				'name' => esc_html__( 'Primary Sidebar', 'typecore' ),
				'type' => 'select',
				'placeholder' => esc_html__( 'Select a sidebar', 'typecore' ),
				'options' => $sidebars_choices,
			),
			array(
				'id' => $prefix . 'sidebar_secondary',
				'name' => esc_html__( 'Secondary Sidebar', 'typecore' ),
				'type' => 'select',
				'placeholder' => esc_html__( 'Select a sidebar', 'typecore' ),
				'options' => $sidebars_choices,
			),
			array(
				'id' => $prefix . 'layout',
				'type' => 'image_select',
				'name' => esc_html__( 'Layout', 'typecore' ),
				'std' => 'inherit',
				'force_delete' => false,
				'max_file_uploads' => '4',
				'options' => array(
					'inherit' => get_template_directory_uri() . '/functions/images/layout-off.png',
					'col-1c' => get_template_directory_uri() . '/functions/images/col-1c.png',
					'col-2cl' => get_template_directory_uri() . '/functions/images/col-2cl.png',
					'col-2cr' => get_template_directory_uri() . '/functions/images/col-2cr.png',
					'col-2cr' => get_template_directory_uri() . '/functions/images/col-2cr.png',
					'col-3cm' => get_template_directory_uri() . '/functions/images/col-3cm.png',
					'col-3cl' => get_template_directory_uri() . '/functions/images/col-3cl.png',
					'col-3cr' => get_template_directory_uri() . '/functions/images/col-3cr.png',
				),
			),
		),
	);

	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'typecore_get_meta_box' );