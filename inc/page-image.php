<?php if ( has_post_thumbnail() ): ?>
<div class="page-image">
	<div class="image-container">
		<?php the_post_thumbnail('typecore-large'); ?>
		<?php 
			$caption = get_post(get_post_thumbnail_id())->post_excerpt;
			$description = get_post(get_post_thumbnail_id())->post_content;
			echo '<div class="page-image-text">';
			if ( isset($caption) && $caption ) echo '<div class="caption">'.esc_html( $caption ).'</div>';
			if ( isset($description) && $description ) echo '<div class="description"><i>'.esc_html( $description ).'</i></div>';
			echo '</div>';
		?>
	</div>
</div><!--/.page-image-->
<?php endif; ?>	