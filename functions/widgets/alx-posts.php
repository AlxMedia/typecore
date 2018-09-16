<?php
/*
	TypecorePosts Widget

	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html

	Copyright: (c) 2013 Alexander "Alx" Agnarson - http://alxmedia.se

		@package TypecorePosts
		@version 1.0
*/

class TypecorePosts extends WP_Widget {

/*  Constructor
/* ------------------------------------ */
	function __construct() {
		parent::__construct( false, esc_html__( 'Alx Posts', 'typecore' ), array('description' => esc_html__( 'Display posts from a category', 'typecore' ), 'classname' => 'widget_typecore_posts', 'customize_selective_refresh' => true ) );
	}

	public function typecore_get_defaults() {
		return array(
			'title'			=> '',
			// Posts
			'posts_thumb'	=> 1,
			'posts_category'=> 1,
			'posts_date'	=> 1,
			'posts_num'		=> '4',
			'posts_cat_id'	=> '0',
			'posts_orderby'	=> 'date',
			'posts_order'	=> 'dsc',
			'posts_time'	=> '0',
		);
	}

/*  Widget
/* ------------------------------------ */
	public function widget($args, $instance) {
		extract( $args );

		$defaults = $this -> typecore_get_defaults();

		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$output = $before_widget."\n";
		if($title)
			$output .= $before_title.$title.$after_title;
		ob_start();

?>

	<?php
		$posts = new WP_Query( array(
			'post_type'				=> array( 'post' ),
			'showposts'				=> absint( $instance['posts_num'] ),
			'cat'					=> absint( $instance['posts_cat_id'] ),
			'ignore_sticky_posts'	=> true,
			'orderby'				=> esc_attr( $instance['posts_orderby'] ),
			'order'					=> esc_attr( $instance['posts_order'] ),
			'date_query' => array(
				array(
					'after' => esc_attr( $instance['posts_time'] ),
				),
			),
		) );
	?>

	<ul class="alx-posts group <?php if($instance['posts_thumb']) { echo 'thumbs-enabled'; } ?>">
		<?php while ($posts->have_posts()): $posts->the_post(); ?>
		<li>

			<?php if($instance['posts_thumb']) { // Thumbnails enabled? ?>
			<div class="post-item-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php if ( has_post_thumbnail() ): ?>
						<?php the_post_thumbnail('typecore-medium'); ?>
					<?php else: ?>
						<img src="<?php echo get_template_directory_uri(); ?>/img/thumb-medium.png" alt="<?php the_title_attribute(); ?>" />
					<?php endif; ?>
					<?php if ( has_post_format('video') && !is_sticky() ) echo'<span class="thumb-icon small"><i class="fa fa-play"></i></span>'; ?>
					<?php if ( has_post_format('audio') && !is_sticky() ) echo'<span class="thumb-icon small"><i class="fa fa-volume-up"></i></span>'; ?>
					<?php if ( is_sticky() ) echo'<span class="thumb-icon small"><i class="fa fa-star"></i></span>'; ?>
				</a>
			</div>
			<?php } ?>

			<div class="post-item-inner group">
				<?php if($instance['posts_category']) { ?><p class="post-item-category"><?php the_category(' / '); ?></p><?php } ?>
				<p class="post-item-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></p>
				<?php if($instance['posts_date']) { ?><p class="post-item-date"><?php the_time( get_option('date_format') ); ?></p><?php } ?>
			</div>

		</li>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</ul><!--/.alx-posts-->

<?php
		$output .= ob_get_clean();
		$output .= $after_widget."\n";
		echo $output;
	}

/*  Widget update
/* ------------------------------------ */
	public function update($new,$old) {
		$instance = $old;
		$instance['title'] = sanitize_text_field($new['title']);
	// Posts
		$instance['posts_thumb'] = $new['posts_thumb']?1:0;
		$instance['posts_category'] = $new['posts_category']?1:0;
		$instance['posts_date'] = $new['posts_date']?1:0;
		$instance['posts_num'] = absint($new['posts_num']);
		$instance['posts_cat_id'] = absint($new['posts_cat_id']);
		$instance['posts_orderby'] = sanitize_text_field($new['posts_orderby']);
		$instance['posts_order'] = sanitize_text_field($new['posts_order']);
		$instance['posts_time'] = sanitize_text_field($new['posts_time']);
		return $instance;
	}

/*  Widget form
/* ------------------------------------ */
	public function form($instance) {
		// Default widget settings
		$defaults = array(
			'title' 			=> '',
		// Posts
			'posts_thumb' 		=> 1,
			'posts_category'	=> 1,
			'posts_date'		=> 1,
			'posts_num' 		=> '4',
			'posts_cat_id' 		=> '0',
			'posts_orderby' 	=> 'date',
			'posts_order' 	    => 'dsc',
			'posts_time' 		=> '0',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>

	<div class="alx-options-posts">
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e( 'Title:', 'typecore' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance["title"] ); ?>" />
		</p>

		<h4><?php esc_html_e( 'List Posts', 'typecore' ); ?></h4>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('posts_thumb') ); ?>" name="<?php echo esc_attr( $this->get_field_name('posts_thumb') ); ?>" <?php checked( (bool) $instance["posts_thumb"], true ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id('posts_thumb') ); ?>"><?php esc_html_e( 'Show thumbnails', 'typecore' ); ?></label>
		</p>
		<p>
			<label style="width: 55%; display: inline-block;" for="<?php echo esc_attr( $this->get_field_id("posts_num") ); ?>"><?php esc_html_e( 'Items to show', 'typecore' ); ?></label>
			<input style="width:20%;" id="<?php echo esc_attr( $this->get_field_id("posts_num") ); ?>" name="<?php echo esc_attr( $this->get_field_name("posts_num") ); ?>" type="text" value="<?php echo absint($instance["posts_num"]); ?>" size='3' />
		</p>
		<p>
			<label style="width: 100%; display: inline-block;" for="<?php echo esc_attr( $this->get_field_id("posts_cat_id") ); ?>"><?php esc_html_e( 'Category:', 'typecore' ); ?></label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("posts_cat_id"), 'selected' => $instance["posts_cat_id"], 'show_option_all' => esc_html__( 'All', 'typecore' ), 'show_count' => true ) ); ?>
		</p>
		<p style="padding-top: 0.3em;">
			<label style="width: 100%; display: inline-block;" for="<?php echo esc_attr( $this->get_field_id("posts_orderby") ); ?>"><?php esc_html_e( 'Order by:', 'typecore' ); ?></label>
			<select style="width: 100%;" id="<?php echo esc_attr( $this->get_field_id("posts_orderby") ); ?>" name="<?php echo esc_attr( $this->get_field_name("posts_orderby") ); ?>">
			  <option value="date"<?php selected( $instance["posts_orderby"], "date" ); ?>><?php esc_html_e( 'Date', 'typecore' ); ?></option>
			  <option value="comment_count"<?php selected( $instance["posts_orderby"], "comment_count" ); ?>><?php esc_html_e( 'Most commented', 'typecore' ); ?></option>
			  <option value="rand"<?php selected( $instance["posts_orderby"], "rand" ); ?>><?php esc_html_e( 'Random', 'typecore' ); ?></option>
			</select>
		</p>
		<p style="padding-top: 0.3em;">
			<label style="width: 100%; display: inline-block;" for="<?php echo esc_attr( $this->get_field_id("posts_order") ); ?>"><?php esc_html_e( 'Order:', 'typecore' ); ?></label>
			<select style="width: 100%;" id="<?php echo esc_attr( $this->get_field_id("posts_order") ); ?>" name="<?php echo esc_attr( $this->get_field_name("posts_order") ); ?>">
			  <option value="dsc"<?php selected( $instance["posts_order"], "dsc" ); ?>><?php esc_html_e( 'Newest First', 'typecore' ); ?></option>
			  <option value="asc"<?php selected( $instance["posts_order"], "asc" ); ?>><?php esc_html_e( 'Oldest First', 'typecore' ); ?></option>
			</select>
		</p>
		<p style="padding-top: 0.3em;">
			<label style="width: 100%; display: inline-block;" for="<?php echo esc_attr( $this->get_field_id("posts_time") ); ?>"><?php esc_html_e( 'Posts from:', 'typecore' ); ?></label>
			<select style="width: 100%;" id="<?php echo esc_attr( $this->get_field_id("posts_time") ); ?>" name="<?php echo esc_attr( $this->get_field_name("posts_time") ); ?>">
			  <option value="0"<?php selected( $instance["posts_time"], "0" ); ?>><?php esc_html_e( 'All time', 'typecore' ); ?></option>
			  <option value="1 year ago"<?php selected( $instance["posts_time"], "1 year ago" ); ?>><?php esc_html_e( 'This year', 'typecore' ); ?></option>
			  <option value="1 month ago"<?php selected( $instance["posts_time"], "1 month ago" ); ?>><?php esc_html_e( 'This month', 'typecore' ); ?></option>
			  <option value="1 week ago"<?php selected( $instance["posts_time"], "1 week ago" ); ?>><?php esc_html_e( 'This week', 'typecore' ); ?></option>
			  <option value="1 day ago"<?php selected( $instance["posts_time"], "1 day ago" ); ?>><?php esc_html_e( 'Past 24 hours', 'typecore' ); ?></option>
			</select>
		</p>

		<hr>
		<h4><?php esc_html_e( 'Post Info', 'typecore' ); ?></h4>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('posts_category') ); ?>" name="<?php echo esc_attr( $this->get_field_name('posts_category') ); ?>" <?php checked( (bool) $instance["posts_category"], true ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id('posts_category') ); ?>"><?php esc_html_e( 'Show categories', 'typecore' ); ?></label>
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('posts_date') ); ?>" name="<?php echo esc_attr( $this->get_field_name('posts_date') ); ?>" <?php checked( (bool) $instance["posts_date"], true ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id('posts_date') ); ?>"><?php esc_html_e( 'Show dates', 'typecore' ); ?></label>
		</p>

		<hr>

	</div>
<?php

}

}

/*  Register widget
/* ------------------------------------ */
if ( ! function_exists( 'typecore_register_widget_posts' ) ) {

	function typecore_register_widget_posts() {
		register_widget( 'TypecorePosts' );
	}

}
add_action( 'widgets_init', 'typecore_register_widget_posts' );
