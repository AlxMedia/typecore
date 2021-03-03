<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * An accessible and mobile-friendly implementation for navigation menus.
 */

namespace Typecore;

/**
 * Object containing all methods and hooks to modify default menus.
 */
class Nav {

	/**
	 * Whether the script has already been enqueued or not.
	 *
	 * @static
	 *
	 * @access protected
	 *
	 * @var bool
	 */
	protected static $enqueued = false;

	/**
	 * Whether we added scripts & styles inline or not.
	 *
	 * @access protected
	 *
	 * @var bool
	 */
	protected $inline = false;

	/**
	 * An array containing URLs for our assets.
	 *
	 * @access protected
	 *
	 * @var array
	 */
	protected $assets = [];

	/**
	 * Prefix for asset handles.
	 *
	 * @access protected
	 *
	 * @var string
	 */
	protected $handle_prefix = 'typecore-nav';

	/**
	 * Init.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function init() {
		if ( apply_filters( 'typecore_disable_nav_mods', false ) ) {
			return;
		}
		add_filter( 'walker_nav_menu_start_el', [ $this, 'add_nav_sub_menu_buttons' ], 10, 4 );
		add_filter( 'nav_menu_item_title', [ $this, 'nav_menu_item_title' ], 10, 4 );
	}

	/**
	 * Enqueue assets.
	 *
	 * @access public
	 *
	 * @param array $args The arguments [script=>URL,style=>URL,inline=>true|false].
	 *
	 * @return void
	 */
	public function enqueue( $args = false ) {
		if ( ! $args ) {
			return;
		}

		// Early exit if we've already enqueued our assets.
		if ( self::$enqueued ) {
			return;
		}

		$args = wp_parse_args(
			$args,
			[
				'script' => false,
				'style'  => false,
				'inline' => false,
			]
		);

		$this->assets['script'] = $args['script'];
		$this->assets['style']  = $args['style'];
		$this->inline           = $args['inline'];

		if ( $this->inline ) {
			add_action( 'wp_footer', [ $this, 'inline_assets' ] );
		} else {
			add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
		}
		self::$enqueued = true;
	}

	/**
	 * Inline assets.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function inline_assets() {
		if ( $this->assets['script'] ) {
			echo '<script>';
			include get_theme_file_path( $this->assets['script'] );
			echo '</script>';
		}

		if ( $this->assets['style'] ) {
			echo '<style>';
			include get_theme_file_path( $this->assets['style'] );
			echo '</style>';
		}
	}

	/**
	 * Enqueue assets.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		if ( $this->assets['style'] ) {
			wp_enqueue_style(
				$this->handle_prefix . '-style',
				get_theme_file_uri( $this->assets['style'] ),
				[],
				filemtime( get_theme_file_path( $this->assets['style'] ) )
			);
		}

		if ( $this->assets['script'] ) {
			wp_enqueue_script(
				$this->handle_prefix . '-script',
				get_theme_file_uri( $this->assets['script'] ),
				[],
				filemtime( get_theme_file_path( $this->assets['script'] ) ),
				true
			);
		}
	}

	/**
	 * A wrapper for the wp_nav_menu function, adding our custom HTML for the expand/collapse button.
	 *
	 * @static
	 *
	 * @access public
	 *
	 * @param array        $args         The arguments to pass to wp_nav_menu().
	 * @param string|false $toggle_label The label for our toggle button.
	 * @param string       $nav_classes  CSS classes to add to the <nav> element.
	 *                                   If left false then the default will be used.
	 * @return void
	 */
	public static function nav_menu( $args, $toggle_label = false, $nav_classes = 'main-navigation nav-menu' ) {
		if ( false === $toggle_label ) {
			$toggle_label = '<span class="screen-reader-text">' . esc_html__( 'Expand Menu', 'typecore' ) . '</span><div class="menu-toggle-icon"><span></span><span></span><span></span></div>';
		}
		?>
		<nav id="<?php echo esc_attr( $args['menu_id'] ); ?>-nav" class="<?php echo esc_attr( $nav_classes ); ?>">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<?php
				/**
				 * Note to code reviewers:
				 * The $toggle_label variable is hardcoded and there is no user input involved.
				 * There is no need to escape hardcoded strings, so we can ignore the PHPCS notices here.
				 */
				echo $toggle_label; // phpcs:ignore WordPress.Security.EscapeOutput
				?>
			</button>
			<?php wp_nav_menu( $args ); ?>
		</nav>
		<?php
	}

	/**
	 * Filter the HTML output of a nav menu item to add the dropdown button that reveal the sub-menu.
	 *
	 * @access public
	 *
	 * @param string   $item_output The menu item's starting HTML output.
	 * @param WP_Post  $item        Menu item data object.
	 * @param int      $depth       Depth of menu item. Used for padding.
	 * @param stdClass $args        An object of wp_nav_menu() arguments.
	 *
	 * @return string Modified nav menu item HTML.
	 */
	public function add_nav_sub_menu_buttons( $item_output, $item, $depth, $args ) {

		if ( ! $args->theme_location ) {
			return $item_output;
		}

		$html = '<span class="menu-item-wrapper">';

		// Skip when the item has no sub-menu.
		if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
			$html         = '<span class="menu-item-wrapper has-arrow">';
			$item_output .= '<button onClick="alxMediaMenu.toggleItem(this)"><span class="screen-reader-text">' . esc_html__( 'Toggle Child Menu', 'typecore' ) . '</span><svg class="svg-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" width="14" height="8" viewBox="0 0 20 12"><polygon fill="" fill-rule="evenodd" points="1319.899 365.778 1327.678 358 1329.799 360.121 1319.899 370.021 1310 360.121 1312.121 358" transform="translate(-1310 -358)"></polygon></svg></button>';
		}

		$html .= $item_output;
		$html .= '</span>';

		return $html;
	}

	/**
	 * Filters a menu item's title.
	 *
	 * This is an accessibility improvement.
	 * Verbally highlights the current item for screen-readers.
	 *
	 * @access public
	 *
	 * @param string   $title The menu item's title.
	 * @param WP_Post  $item  The current menu item.
	 * @param stdClass $args  An object of wp_nav_menu() arguments.
	 * @param int      $depth Depth of menu item. Used for padding.
	 *
	 * @return string
	 */
	public function nav_menu_item_title( $title, $item, $args, $depth ) {

		if ( ! $args->theme_location ) {
			return $title;
		}

		// Classes that can be used to indicate the currently active menu item.
		$is_current_classes = [
			'current-menu-item',
			'current_page_item',
		];

		// Classes that can be used to indicate the parent of a currently active menu item.
		$is_current_parent_classes = [
			'current-page-ancestor',
			'current-menu-ancestor',
			'current-menu-parent',
			'current-page-parent',
			'current_page_parent',
			'current_page_ancestor',
		];

		// Figure out if this menu-item is the current one.
		$is_current = false;
		foreach ( $is_current_classes as $class ) {
			if ( in_array( $class, $item->classes, true ) ) {
				$is_current = true;
				break;
			}
		}

		// Figure out if this menu-item is a parent of the current one.
		$is_current_parent = false;
		if ( ! $is_current ) {
			foreach ( $is_current_parent_classes as $class ) {
				if ( in_array( $class, $item->classes, true ) ) {
					$is_current_parent = true;
					break;
				}
			}
		}

		// Change the title text for current items.
		if ( $is_current ) {
			/**
			 * Use sprintf() to allow LTR languages to reverse the order
			 * and put the title before the prefix.
			 */
			return sprintf(
				/* Translators: %1$s: "Current Page:". %2$s: The menu-item title. */
				__( '<span class="screen-reader-text">%1$s </span>%2$s', 'typecore' ),
				esc_html__( 'Current Page:', 'typecore' ),
				$title
			);
		}

		// Change the title text for current item parents.
		if ( $is_current_parent ) {
			/**
			 * Use sprintf() to allow LTR languages to reverse the order
			 * and put the title before the prefix.
			 */
			return sprintf(
				/* Translators: %1$s: "Current Page Parent:". %2$s: The menu-item title. */
				__( '<span class="screen-reader-text">%1$s </span>%2$s', 'typecore' ),
				esc_html__( 'Current Page Parent', 'typecore' ),
				$title
			);
		}

		return $title;
	}
}
