<form method="get" class="searchform themeform" action="<?php echo home_url('/'); ?>">
	<div>
		<input type="text" class="search" name="s" onblur="if(this.value=='')this.value='<?php _e('To search type and hit enter','typecore'); ?>';" onfocus="if(this.value=='<?php _e('To search type and hit enter','typecore'); ?>')this.value='';" value="<?php _e('To search type and hit enter','typecore'); ?>" />
	</div>
</form>