<?php
/**
 * Handles sections created via the Kirki API.
 *
 * @package     Kirki
 * @category    Modules
 * @author      Ari Stathopoulos (@aristath)
 * @copyright   Copyright (c) 2019, Ari Stathopoulos (@aristath)
 * @license    https://opensource.org/licenses/MIT
 * @since       3.0.0
 */

/**
 * Handle selective refreshes introduced in WordPress 4.5.
 */
class Kirki_Modules_Selective_Refresh {

	/**
	 * The object instance.
	 *
	 * @static
	 * @access private
	 * @since 3.0.0
	 * @var object
	 */
	private static $instance;

	/**
	 * Adds any necessary actions & filters.
	 *
	 * @access protected
	 */
	protected function __construct() {
		add_action( 'customize_register', array( $this, 'register_partials' ), 99 );
	}

	/**
	 * Gets an instance of this object.
	 * Prevents duplicate instances which avoid artefacts and improves performance.
	 *
	 * @static
	 * @access public
	 * @since 3.0.0
	 * @return object
	 */
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Parses all fields and searches for the "partial_refresh" argument inside them.
	 * If that argument is found, then it starts parsing the array of arguments.
	 * Registers a selective_refresh in the customizer for each one of them.
	 *
	 * @param object $wp_customize WP_Customize_Manager.
	 */
	public function register_partials( $wp_customize ) {

		// Abort if selective refresh is not available.
		if ( ! isset( $wp_customize->selective_refresh ) ) {
			return;
		}

		// Get an array of all fields.
		$fields = Kirki::$fields;

		// Start parsing the fields.
		foreach ( $fields as $field ) {
			if ( isset( $field['partial_refresh'] ) && ! empty( $field['partial_refresh'] ) ) {
				// Start going through each item in the array of partial refreshes.
				foreach ( $field['partial_refresh'] as $partial_refresh => $partial_refresh_args ) {
					// If we have all we need, create the selective refresh call.
					if ( isset( $partial_refresh_args['render_callback'] ) && isset( $partial_refresh_args['selector'] ) ) {
						$partial_refresh_args = wp_parse_args(
							$partial_refresh_args,
							array(
								'settings' => $field['settings'],
							)
						);
						$wp_customize->selective_refresh->add_partial( $partial_refresh, $partial_refresh_args );
					}
				}
			}
		}
	}
}
