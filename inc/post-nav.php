<?php if ( is_single() ): ?>
	<ul class="post-nav group">
		<li class="next"><?php next_post_link('%link', '<i class="fas fa-chevron-right"></i><strong>'.esc_html__('Next story', 'typecore').'</strong> <span>%title</span>'); ?></li>
		<li class="previous"><?php previous_post_link('%link', '<i class="fas fa-chevron-left"></i><strong>'.esc_html__('Previous story', 'typecore').'</strong> <span>%title</span>'); ?></li>
	</ul>
<?php endif; ?>