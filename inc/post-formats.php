<?php $format = get_post_format(); ?>
<?php $meta = get_post_custom($post->ID); ?>

<?php if ( has_post_format( 'audio' ) ): // Audio ?>
	
	<div class="post-format">	
		<?php 
			if ( isset($meta['_audio_url'][0]) && !empty($meta['_audio_url'][0]) ) {
				global $wp_embed;
				$audio = $wp_embed->run_shortcode('[embed]'.$meta['_audio_url'][0].'[/embed]');
				echo $audio;
			}
		?>
	</div>
	
<?php endif; ?>

<?php if ( has_post_format( 'gallery' ) ): // Gallery ?>
	
	<div class="post-format">
		<?php $images = alx_post_images(); if ( !empty($images) ): ?>
		<script type="text/javascript">
			// Check if first slider image is loaded, and load flexslider on document ready
			jQuery(document).ready(function(){
			 var firstImage = jQuery('#flexslider-<?php echo the_ID(); ?>').find('img').filter(':first'),
				checkforloaded = setInterval(function() {
					var image = firstImage.get(0);
					if (image.complete || image.readyState == 'complete' || image.readyState == 4) {
						clearInterval(checkforloaded);
						jQuery('#flexslider-<?php echo the_ID(); ?>').flexslider({
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
		</script>
		<div class="flex-container">
			<div class="flexslider" id="flexslider-<?php the_ID(); ?>">
				<ul class="slides">
					<?php foreach ( $images as $image ): ?>
						<li>
							<?php $imageid = wp_get_attachment_image_src($image->ID,'large'); ?>
							<img src="<?php echo esc_attr( $imageid[0] ); ?>" alt="<?php echo esc_attr( $image->post_title ); ?>">
							
							<?php if ( $image->post_excerpt ): ?>
								<div class="image-caption"><?php echo $image->post_excerpt; ?></div>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<?php endif; ?>
	</div>
	
<?php endif; ?>

<?php if ( has_post_format( 'image' ) ): // Image ?>

	<div class="post-format">
			<?php if ( has_post_thumbnail() ) {	
				the_post_thumbnail('thumb-large'); 
				$caption = get_post(get_post_thumbnail_id())->post_excerpt;
				if ( isset($caption) && $caption ) echo '<div class="image-caption">'.$caption.'</div>';
			} ?>
	</div>
	
<?php endif; ?>

<?php if ( has_post_format( 'video' ) ): // Video ?>

	<div class="post-format">	
		<?php 
			if ( isset($meta['_video_url'][0]) && !empty($meta['_video_url'][0]) ) {
				global $wp_embed;
				$video = $wp_embed->run_shortcode('[embed]'.$meta['_video_url'][0].'[/embed]');
				echo $video;
			}
		?>
	</div>
	
<?php endif; ?>

<?php if ( has_post_format( 'quote' ) ): // Quote ?>
	
<?php endif; ?>

<?php if ( has_post_format( 'chat' ) ): // Chat ?>

<?php endif; ?>

<?php if ( has_post_format( 'link' ) ): // Link ?>

<?php endif; ?>
