<?php
/*
	TypecoreTabs Widget

	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html

	Copyright: (c) 2013 Alexander "Alx" Agnarson - http://alxmedia.se

		@package TypecoreTabs
		@version 1.0
*/

class TypecoreTabs extends WP_Widget {

/*  Constructor
/* ------------------------------------ */
	function __construct() {
		parent::__construct( false, esc_html__( 'Alx Tabs', 'typecore' ), array('description' => esc_html__('List posts, comments, and/or tags with or without tabs.', 'typecore' ), 'classname' => 'widget_typecore_tabs', 'customize_selective_refresh' => true ) );
	}

	public function typecore_get_defaults() {
		return array(
			'title'				=> '',
			'tabs_category'		=> 1,
			'tabs_date'			=> 1,
		// Recent posts
			'recent_enable'		=> 1,
			'recent_thumbs'		=> 1,
			'recent_cat_id'		=> '0',
			'recent_num'		=> '5',
		// Popular posts
			'popular_enable'	=> 1,
			'popular_thumbs'	=> 1,
			'popular_cat_id'	=> '0',
			'popular_time'		=> '0',
			'popular_num'		=> '5',
		// Recent comments
			'comments_enable'	=> 1,
			'comments_avatars'	=> 1,
			'comments_num'		=> '5',
		// Tags
			'tags_enable'		=> 1,
		// Order
			'order_recent'		=> '1',
			'order_popular'		=> '2',
			'order_comments'	=> '3',
			'order_tags'		=> '4',
		);
	}

/*  Create tabs-nav
/* ------------------------------------ */
	private function _create_tabs($tabs,$count) {
		// Borrowed from Jermaine Maree, thanks mate!
		$titles = array(
			'recent'	=> esc_html__('Recent Posts','typecore'),
			'popular'	=> esc_html__('Popular Posts','typecore'),
			'comments'	=> esc_html__('Recent Comments','typecore'),
			'tags'		=> esc_html__('Tags','typecore')
		);
		$icons = array(
			'recent'   => 'fa fa-clock-o',
			'popular'  => 'fa fa-star',
			'comments' => 'fa fa-comments-o',
			'tags'     => 'fa fa-tags'
		);
		$output = sprintf('<ul class="alx-tabs-nav group tab-count-%s">', $count);
		foreach ( $tabs as $tab ) {
			$output .= sprintf('<li class="alx-tab tab-%1$s"><a href="#tab-%2$s" title="%4$s"><i class="%3$s"></i><span>%4$s</span></a></li>',$tab, $tab . '-' . $this -> number, $icons[$tab], $titles[$tab]);
		}
		$output .= '</ul>';
		return $output;
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

/*  Set tabs-nav order & output it
/* ------------------------------------ */
	$tabs = array();
	$count = 0;
	$order = array(
		'recent'	=> $instance['order_recent'],
		'popular'	=> $instance['order_popular'],
		'comments'	=> $instance['order_comments'],
		'tags'		=> $instance['order_tags']
	);
	asort($order);
	foreach ( $order as $key => $value ) {
		if ( $instance[$key.'_enable'] ) {
			$tabs[] = $key;
			$count++;
		}
	}
	if ( $tabs && ($count > 1) ) { $output .= $this->_create_tabs($tabs,$count); }
?>

	<div class="alx-tabs-container">


		<?php if($instance['recent_enable']) { // Recent posts enabled? ?>

			<?php $recent=new WP_Query(); ?>
			<?php $recent->query('showposts='.absint($instance["recent_num"]).'&cat='.absint($instance["recent_cat_id"]).'&ignore_sticky_posts=1');?>

			<ul id="tab-recent-<?php echo $this -> number ?>" class="alx-tab group <?php if($instance['recent_thumbs']) { echo 'thumbs-enabled'; } ?>">
				<?php while ($recent->have_posts()): $recent->the_post(); ?>
				<li>

					<?php if($instance['recent_thumbs']) { // Thumbnails enabled? ?>
					<div class="tab-item-thumbnail">
						<a href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ): ?>
								<?php the_post_thumbnail('typecore-small'); ?>
							<?php else: ?>
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/thumb-small.png" alt="<?php the_title_attribute(); ?>" />
							<?php endif; ?>
							<?php if ( has_post_format('video') && !is_sticky() ) echo'<span class="thumb-icon small"><i class="fa fa-play"></i></span>'; ?>
							<?php if ( has_post_format('audio') && !is_sticky() ) echo'<span class="thumb-icon small"><i class="fa fa-volume-up"></i></span>'; ?>
							<?php if ( is_sticky() ) echo'<span class="thumb-icon small"><i class="fa fa-star"></i></span>'; ?>
						</a>
					</div>
					<?php } ?>

					<div class="tab-item-inner group">
						<?php if($instance['tabs_category']) { ?><p class="tab-item-category"><?php the_category(' / '); ?></p><?php } ?>
						<p class="tab-item-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></p>
						<?php if($instance['tabs_date']) { ?><p class="tab-item-date"><?php the_time( get_option('date_format') ); ?></p><?php } ?>
					</div>

				</li>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</ul><!--/.alx-tab-->

		<?php } ?>


		<?php if($instance['popular_enable']) { // Popular posts enabled? ?>

			<?php
				$popular = new WP_Query( array(
					'post_type'				=> array( 'post' ),
					'showposts'				=> absint( $instance['popular_num'] ),
					'cat'					=> absint( $instance['popular_cat_id'] ),
					'ignore_sticky_posts'	=> true,
					'orderby'				=> 'comment_count',
					'order'					=> 'dsc',
					'date_query' => array(
						array(
							'after' => esc_attr( $instance['popular_time'] ),
						),
					),
				) );
			?>
			<ul id="tab-popular-<?php echo $this -> number ?>" class="alx-tab group <?php if($instance['popular_thumbs']) { echo 'thumbs-enabled'; } ?>">

				<?php while ( $popular->have_posts() ): $popular->the_post(); ?>
				<li>

					<?php if($instance['popular_thumbs']) { // Thumbnails enabled? ?>
					<div class="tab-item-thumbnail">
						<a href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ): ?>
								<?php the_post_thumbnail('typecore-small'); ?>
							<?php else: ?>
								<img src="<?php echo get_template_directory_uri(); ?>/img/thumb-small.png" alt="<?php the_title_attribute(); ?>" />
							<?php endif; ?>
							<?php if ( has_post_format('video') && !is_sticky() ) echo'<span class="thumb-icon small"><i class="fa fa-play"></i></span>'; ?>
							<?php if ( has_post_format('audio') && !is_sticky() ) echo'<span class="thumb-icon small"><i class="fa fa-volume-up"></i></span>'; ?>
							<?php if ( is_sticky() ) echo'<span class="thumb-icon small"><i class="fa fa-star"></i></span>'; ?>
						</a>
					</div>
					<?php } ?>

					<div class="tab-item-inner group">
						<?php if($instance['tabs_category']) { ?><p class="tab-item-category"><?php the_category(' / '); ?></p><?php } ?>
						<p class="tab-item-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></p>
						<?php if($instance['tabs_date']) { ?><p class="tab-item-date"><?php the_time( get_option('date_format') ); ?></p><?php } ?>
					</div>

				</li>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</ul><!--/.alx-tab-->

		<?php } ?>


		<?php if($instance['comments_enable']) { // Recent comments enabled? ?>

			<?php $comments = get_comments(array('number'=>absint( $instance["comments_num"] ),'status'=>'approve','post_status'=>'publish')); ?>

			<ul id="tab-comments-<?php echo $this -> number ?>" class="alx-tab group <?php if($instance['comments_avatars']) { echo 'avatars-enabled'; } ?>">
				<?php foreach ($comments as $comment): ?>
				<li>

						<?php if($instance['comments_avatars']) { // Avatars enabled? ?>
						<div class="tab-item-avatar">
							<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
								<?php echo get_avatar($comment->comment_author_email,$size='96'); ?>
							</a>
						</div>
						<?php } ?>

						<div class="tab-item-inner group">
							<?php $str=explode(' ',get_comment_excerpt($comment->comment_ID)); $comment_excerpt=implode(' ',array_slice($str,0,11)); if(count($str) > 11 && substr($comment_excerpt,-1)!='.') $comment_excerpt.='...' ?>
							<div class="tab-item-name"><?php echo esc_attr( $comment->comment_author ); ?> <?php esc_html_e('says:','typecore'); ?></div>
							<div class="tab-item-comment"><a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>"><?php echo esc_attr( $comment_excerpt ); ?></a></div>

						</div>

				</li>
				<?php endforeach; ?>
			</ul><!--/.alx-tab-->

		<?php } ?>

		<?php if($instance['tags_enable']) { // Tags enabled? ?>

			<ul id="tab-tags-<?php echo $this -> number ?>" class="alx-tab group">
				<li>
					<?php wp_tag_cloud(); ?>
				</li>
			</ul><!--/.alx-tab-->

		<?php } ?>
	</div>

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
		$instance['tabs_category'] = $new['tabs_category']?1:0;
		$instance['tabs_date'] = $new['tabs_date']?1:0;
	// Recent posts
		$instance['recent_enable'] = $new['recent_enable']?1:0;
		$instance['recent_thumbs'] = $new['recent_thumbs']?1:0;
		$instance['recent_cat_id'] = absint($new['recent_cat_id']);
		$instance['recent_num'] = absint($new['recent_num']);
	// Popular posts
		$instance['popular_enable'] = $new['popular_enable']?1:0;
		$instance['popular_thumbs'] = $new['popular_thumbs']?1:0;
		$instance['popular_cat_id'] = absint($new['popular_cat_id']);
		$instance['popular_time'] = sanitize_text_field($new['popular_time']);
		$instance['popular_num'] = absint($new['popular_num']);
	// Recent comments
		$instance['comments_enable'] = $new['comments_enable']?1:0;
		$instance['comments_avatars'] = $new['comments_avatars']?1:0;
		$instance['comments_num'] = absint($new['comments_num']);
	// Tags
		$instance['tags_enable'] = $new['tags_enable']?1:0;
	// Order
		$instance['order_recent'] = absint($new['order_recent']);
		$instance['order_popular'] = absint($new['order_popular']);
		$instance['order_comments'] = absint($new['order_comments']);
		$instance['order_tags'] = absint($new['order_tags']);
		return $instance;
	}

/*  Widget form
/* ------------------------------------ */
	public function form($instance) {
		// Default widget settings
		$defaults = array(
			'title' 			=> '',
			'tabs_category' 	=> 1,
			'tabs_date' 		=> 1,
		// Recent posts
			'recent_enable' 	=> 1,
			'recent_thumbs' 	=> 1,
			'recent_cat_id' 	=> '0',
			'recent_num' 		=> '5',
		// Popular posts
			'popular_enable' 	=> 1,
			'popular_thumbs' 	=> 1,
			'popular_cat_id' 	=> '0',
			'popular_time' 		=> '0',
			'popular_num' 		=> '5',
		// Recent comments
			'comments_enable' 	=> 1,
			'comments_avatars' 	=> 1,
			'comments_num' 		=> '5',
		// Tags
			'tags_enable' 		=> 1,
		// Order
			'order_recent' 		=> '1',
			'order_popular' 	=> '2',
			'order_comments' 	=> '3',
			'order_tags' 		=> '4',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>

	<div class="alx-options-tabs">
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e( 'Title:', 'typecore' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
		</p>

		<h4><?php esc_html_e( 'Recent Posts', 'typecore' ); ?></h4>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('recent_enable') ); ?>" name="<?php echo esc_attr( $this->get_field_name('recent_enable') ); ?>" <?php checked( (bool) $instance["recent_enable"], true ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id('recent_enable') ); ?>"><?php esc_html_e( 'Enable recent posts', 'typecore' ); ?></label>
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('recent_thumbs') ); ?>" name="<?php echo esc_attr( $this->get_field_name('recent_thumbs') ); ?>" <?php checked( (bool) $instance["recent_thumbs"], true ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id('recent_thumbs') ); ?>"><?php esc_html_e( 'Show thumbnails', 'typecore' ); ?></label>
		</p>
		<p>
			<label style="width: 55%; display: inline-block;" for="<?php echo esc_attr( $this->get_field_id("recent_num") ); ?>"><?php esc_html_e( 'Items to show', 'typecore' ); ?></label>
			<input style="width:20%;" id="<?php echo esc_attr( $this->get_field_id("recent_num") ); ?>" name="<?php echo esc_attr( $this->get_field_name("recent_num") ); ?>" type="text" value="<?php echo absint($instance["recent_num"]); ?>" size='3' />
		</p>
		<p>
			<label style="width: 100%; display: inline-block;" for="<?php echo esc_attr( $this->get_field_id("recent_cat_id") ); ?>"><?php esc_html_e( 'Category:', 'typecore' ); ?></label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("recent_cat_id"), 'selected' => $instance["recent_cat_id"], 'show_option_all' => esc_html__('All','typecore'), 'show_count' => true ) ); ?>
		</p>

		<hr>
		<h4><?php esc_html_e( 'Most Popular', 'typecore' ); ?></h4>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('popular_enable') ); ?>" name="<?php echo esc_attr( $this->get_field_name('popular_enable') ); ?>" <?php checked( (bool) $instance["popular_enable"], true ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id('popular_enable') ); ?>"><?php esc_html_e( 'Enable most popular posts', 'typecore' ); ?></label>
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('popular_thumbs') ); ?>" name="<?php echo esc_attr( $this->get_field_name('popular_thumbs') ); ?>" <?php checked( (bool) $instance["popular_thumbs"], true ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id('popular_thumbs') ); ?>"><?php esc_html_e( 'Show thumbnails', 'typecore' ); ?></label>
		</p>
		<p>
			<label style="width: 55%; display: inline-block;" for="<?php echo esc_attr( $this->get_field_id("popular_num") ); ?>"><?php esc_html_e( 'Items to show', 'typecore' ); ?></label>
			<input style="width:20%;" id="<?php echo esc_attr( $this->get_field_id("popular_num") ); ?>" name="<?php echo esc_attr( $this->get_field_name("popular_num") ); ?>" type="text" value="<?php echo absint($instance["popular_num"]); ?>" size='3' />
		</p>
		<p>
			<label style="width: 100%; display: inline-block;" for="<?php echo esc_attr( $this->get_field_id("popular_cat_id") ); ?>"><?php esc_html_e( 'Category:', 'typecore' ); ?></label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("popular_cat_id"), 'selected' => $instance["popular_cat_id"], 'show_option_all' => esc_html__('All','typecore'), 'show_count' => true ) ); ?>
		</p>
		<p style="padding-top: 0.3em;">
			<label style="width: 100%; display: inline-block;" for="<?php echo esc_attr( $this->get_field_id("popular_time") ); ?>"><?php esc_html_e( 'Post with most comments from:', 'typecore' ); ?></label>
			<select style="width: 100%;" id="<?php echo esc_attr( $this->get_field_id("popular_time") ); ?>" name="<?php echo esc_attr( $this->get_field_name("popular_time") ); ?>">
			  <option value="0"<?php selected( $instance["popular_time"], "0" ); ?>><?php esc_html_e( 'All time', 'typecore' ); ?></option>
			  <option value="1 year ago"<?php selected( $instance["popular_time"], "1 year ago" ); ?>><?php esc_html_e( 'This year', 'typecore' ); ?></option>
			  <option value="1 month ago"<?php selected( $instance["popular_time"], "1 month ago" ); ?>><?php esc_html_e( 'This month', 'typecore' ); ?></option>
			  <option value="1 week ago"<?php selected( $instance["popular_time"], "1 week ago" ); ?>><?php esc_html_e( 'This week', 'typecore' ); ?></option>
			  <option value="1 day ago"<?php selected( $instance["popular_time"], "1 day ago" ); ?>><?php esc_html_e( 'Past 24 hours', 'typecore' ); ?></option>
			</select>
		</p>

		<hr>
		<h4><?php esc_html_e( 'Recent Comments', 'typecore' ); ?></h4>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('comments_enable') ); ?>" name="<?php echo esc_attr( $this->get_field_name('comments_enable') ); ?>" <?php checked( (bool) $instance["comments_enable"], true ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id('comments_enable') ); ?>"><?php esc_html_e( 'Enable recent comments', 'typecore' ); ?></label>
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('comments_avatars') ); ?>" name="<?php echo esc_attr( $this->get_field_name('comments_avatars') ); ?>" <?php checked( (bool) $instance["comments_avatars"], true ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id('comments_avatars') ); ?>"><?php esc_html_e( 'Show avatars', 'typecore' ); ?></label>
		</p>
		<p>
			<label style="width: 55%; display: inline-block;" for="<?php echo esc_attr( $this->get_field_id("comments_num") ); ?>"><?php esc_html_e( 'Items to show', 'typecore' ); ?></label>
			<input style="width:20%;" id="<?php echo esc_attr( $this->get_field_id("comments_num") ); ?>" name="<?php echo esc_attr( $this->get_field_name("comments_num") ); ?>" type="text" value="<?php echo absint($instance["comments_num"]); ?>" size='3' />
		</p>

		<hr>
		<h4><?php esc_html_e( 'Tags', 'typecore' ); ?></h4>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('tags_enable') ); ?>" name="<?php echo esc_attr( $this->get_field_name('tags_enable') ); ?>" <?php checked( (bool) $instance["tags_enable"], true ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id('tags_enable') ); ?>"><?php esc_html_e( 'Enable tags', 'typecore' ); ?></label>
		</p>

		<hr>
		<h4><?php esc_html_e( 'Tab Order', 'typecore' ); ?></h4>

		<p>
			<label style="width: 55%; display: inline-block;" for="<?php echo esc_attr( $this->get_field_id("order_recent") ); ?>"><?php esc_html_e( 'Recent posts', 'typecore' ); ?></label>
			<input class="widefat" style="width:20%;" type="text" id="<?php echo esc_attr( $this->get_field_id("order_recent") ); ?>" name="<?php echo esc_attr( $this->get_field_name("order_recent") ); ?>" value="<?php echo esc_attr( $instance["order_recent"] ); ?>" />
		</p>
		<p>
			<label style="width: 55%; display: inline-block;" for="<?php echo esc_attr( $this->get_field_id("order_popular") ); ?>"><?php esc_html_e( 'Most popular', 'typecore' ); ?></label>
			<input class="widefat" style="width:20%;" type="text" id="<?php echo esc_attr( $this->get_field_id("order_popular") ); ?>" name="<?php echo esc_attr( $this->get_field_name("order_popular") ); ?>" value="<?php echo esc_attr( $instance["order_popular"] ); ?>" />
		</p>
		<p>
			<label style="width: 55%; display: inline-block;" for="<?php echo esc_attr( $this->get_field_id("order_comments") ); ?>"><?php esc_html_e( 'Recent comments', 'typecore' ); ?></label>
			<input class="widefat" style="width:20%;" type="text" id="<?php echo esc_attr( $this->get_field_id("order_comments") ); ?>" name="<?php echo esc_attr( $this->get_field_name("order_comments") ); ?>" value="<?php echo esc_attr( $instance["order_comments"] ); ?>" />
		</p>
		<p>
			<label style="width: 55%; display: inline-block;" for="<?php echo esc_attr( $this->get_field_id("order_tags") ); ?>"><?php esc_html_e( 'Tags', 'typecore' ); ?></label>
			<input class="widefat" style="width:20%;" type="text" id="<?php echo esc_attr( $this->get_field_id("order_tags") ); ?>" name="<?php echo esc_attr( $this->get_field_name("order_tags") ); ?>" value="<?php echo esc_attr( $instance["order_tags"] ); ?>" />
		</p>

		<hr>
		<h4><?php esc_html_e( 'Tab Info', 'typecore' ); ?></h4>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('tabs_category') ); ?>" name="<?php echo esc_attr( $this->get_field_name('tabs_category') ); ?>" <?php checked( (bool) $instance["tabs_category"], true ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id('tabs_category') ); ?>"><?php esc_html_e( 'Show categories', 'typecore' ); ?></label>
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('tabs_date') ); ?>" name="<?php echo esc_attr( $this->get_field_name('tabs_date') ); ?>" <?php checked( (bool) $instance["tabs_date"], true ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id('tabs_date') ); ?>"><?php esc_html_e( 'Show dates', 'typecore' ); ?></label>
		</p>

		<hr>

	</div>
<?php

}

}

/*  Register widget
/* ------------------------------------ */
if ( ! function_exists( 'typecore_register_widget_tabs' ) ) {

	function typecore_register_widget_tabs() {
		register_widget( 'TypecoreTabs' );
	}

}
add_action( 'widgets_init', 'typecore_register_widget_tabs' );
