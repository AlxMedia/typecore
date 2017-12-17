<?php
/* ------------------------------------------------------------------------- *
 *  Dynamic styles
/* ------------------------------------------------------------------------- */

/*  Convert hexadecimal to rgb
/* ------------------------------------ */
if ( ! function_exists( 'alx_hex2rgb' ) ) {

	function alx_hex2rgb( $hex, $array=false ) {
		$hex = str_replace("#", "", $hex);

		if ( strlen($hex) == 3 ) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}

		$rgb = array( $r, $g, $b );
		if ( !$array ) { $rgb = implode(",", $rgb); }
		return $rgb;
	}
	
}	


/*  Google fonts
/* ------------------------------------ */
if ( ! function_exists( 'alx_google_fonts' ) ) {

	function alx_google_fonts () {
		if ( get_theme_mod('dynamic-styles', 'on') == 'on' ) {
			if ( get_theme_mod( 'font' ) == 'titillium-web-ext' ) { echo '<link href="//fonts.googleapis.com/css?family=Titillium+Web:400,400italic,300italic,300,600&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( get_theme_mod( 'font' ) == 'droid-serif' ) { echo '<link href="//fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700" rel="stylesheet" type="text/css">'. "\n"; }
			if ( get_theme_mod( 'font' ) == 'source-sans-pro' ) { echo '<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300italic,300,400italic,600&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( get_theme_mod( 'font' ) == 'lato' ) { echo '<link href="//fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700" rel="stylesheet" type="text/css">'. "\n"; }
			if ( get_theme_mod( 'font' ) == 'raleway' ) { echo '<link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">'. "\n"; }
			if ( get_theme_mod( 'font' ) == 'ubuntu' ) { echo '<link href="//fonts.googleapis.com/css?family=Ubuntu:400,400italic,300italic,300,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( get_theme_mod( 'font' ) == 'ubuntu-cyr' ) { echo '<link href="//fonts.googleapis.com/css?family=Ubuntu:400,400italic,300italic,300,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( get_theme_mod( 'font' ) == 'roboto' ) { echo '<link href="//fonts.googleapis.com/css?family=Roboto:400,300italic,300,400italic,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( get_theme_mod( 'font' ) == 'roboto-cyr' ) { echo '<link href="//fonts.googleapis.com/css?family=Roboto:400,300italic,300,400italic,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
			/*default*/ if ( ( get_theme_mod( 'font' ) == '' ) || ( get_theme_mod( 'font' ) == 'roboto-condensed' ) ) { echo '<link href="//fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,300,400italic,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( get_theme_mod( 'font' ) == 'roboto-condensed-cyr' ) { echo '<link href="//fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,300,400italic,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( get_theme_mod( 'font' ) == 'roboto-slab' ) { echo '<link href="//fonts.googleapis.com/css?family=Roboto+Slab:400,300italic,300,400italic,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( get_theme_mod( 'font' ) == 'roboto-slab-cyr' ) { echo '<link href="//fonts.googleapis.com/css?family=Roboto+Slab:400,300italic,300,400italic,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( get_theme_mod( 'font' ) == 'playfair-display' ) { echo '<link href="//fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( get_theme_mod( 'font' ) == 'playfair-display-cyr' ) { echo '<link href="//fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700&subset=latin,cyrillic" rel="stylesheet" type="text/css">'. "\n"; }
			if ( get_theme_mod( 'font' ) == 'open-sans' ) { echo '<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400italic,300italic,300,600&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( get_theme_mod( 'font' ) == 'open-sans-cyr' ) { echo '<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400italic,300italic,300,600&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( get_theme_mod( 'font' ) == 'pt-serif' ) { echo '<link href="//fonts.googleapis.com/css?family=PT+Serif:400,700,400italic&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( get_theme_mod( 'font' ) == 'pt-serif-cyr' ) { echo '<link href="//fonts.googleapis.com/css?family=PT+Serif:400,700,400italic&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
		}
	}	
	
}
add_action( 'wp_head', 'alx_google_fonts', 2 );	


/*  Dynamic css output
/* ------------------------------------ */
if ( ! function_exists( 'alx_dynamic_css' ) ) {

	function alx_dynamic_css() {
		if ( get_theme_mod('dynamic-styles', 'on') == 'on' ) {
		
			// rgb values
			$color_1 = get_theme_mod('color-1');
			$color_1_rgb = alx_hex2rgb($color_1);
			
			// start output
			$styles = '<style type="text/css">'."\n";
			$styles .= '/* Dynamic CSS: For no styles in head, copy and put the css below in your custom.css or child theme\'s style.css, disable dynamic styles */'."\n";		
			
			// google fonts
			if ( get_theme_mod( 'font' ) == 'titillium-web-ext' ) { $styles .= 'body { font-family: "Titillium Web", Arial, sans-serif; }'."\n"; }
			if ( get_theme_mod( 'font' ) == 'droid-serif' ) { $styles .= 'body { font-family: "Droid Serif", serif; }'."\n"; }
			if ( get_theme_mod( 'font' ) == 'source-sans-pro' ) { $styles .= 'body { font-family: "Source Sans Pro", Arial, sans-serif; }'."\n"; }
			if ( get_theme_mod( 'font' ) == 'lato' ) { $styles .= 'body { font-family: "Lato", Arial, sans-serif; }'."\n"; }
			if ( get_theme_mod( 'font' ) == 'raleway' ) { $styles .= 'body { font-family: "Raleway", Arial, sans-serif; }'."\n"; }
			if ( ( get_theme_mod( 'font' ) == 'ubuntu' ) || ( get_theme_mod( 'font' ) == 'ubuntu-cyr' ) ) { $styles .= 'body { font-family: "Ubuntu", Arial, sans-serif; }'."\n"; }	
			if ( ( get_theme_mod( 'font' ) == 'roboto' ) || ( get_theme_mod( 'font' ) == 'roboto-cyr' ) ) { $styles .= 'body { font-family: "Roboto", Arial, sans-serif; }'."\n"; }
			/*default*/ if ( ( get_theme_mod( 'font' ) == '' ) || ( get_theme_mod( 'font' ) == 'roboto-condensed' ) || ( get_theme_mod( 'font' ) == 'roboto-condensed-cyr' ) ) { $styles .= 'body { font-family: "Roboto Condensed", Arial, sans-serif; }'."\n"; }
			if ( ( get_theme_mod( 'font' ) == 'roboto-slab' ) || ( get_theme_mod( 'font' ) == 'roboto-slab-cyr' ) ) { $styles .= 'body { font-family: "Roboto Slab", Arial, sans-serif; }'."\n"; }			
			if ( ( get_theme_mod( 'font' ) == 'playfair-display' ) || ( get_theme_mod( 'font' ) == 'playfair-display-cyr' ) ) { $styles .= 'body { font-family: "Playfair Display", Arial, sans-serif; }'."\n"; }
			if ( ( get_theme_mod( 'font' ) == 'open-sans' ) || ( get_theme_mod( 'font' ) == 'open-sans-cyr' ) )	{ $styles .= 'body { font-family: "Open Sans", Arial, sans-serif; }'."\n"; }
			if ( ( get_theme_mod( 'font' ) == 'pt-serif' ) || ( get_theme_mod( 'font' ) == 'pt-serif-cyr' ) ) { $styles .= 'body { font-family: "PT Serif", serif; }'."\n"; }	
			if ( get_theme_mod( 'font' ) == 'arial' ) { $styles .= 'body { font-family: Arial, sans-serif; }'."\n"; }
			if ( get_theme_mod( 'font' ) == 'georgia' ) { $styles .= 'body { font-family: Georgia, serif; }'."\n"; }
			if ( get_theme_mod( 'font' ) == 'verdana' ) { $styles .= 'body { font-family: Verdana, sans-serif; }'."\n"; }
			if ( get_theme_mod( 'font' ) == 'tahoma' ) { $styles .= 'body { font-family: Tahoma, sans-serif; }'."\n"; }
			
			// container width
			if ( get_theme_mod('container-width','1460') != '1460' ) {			
				if ( get_theme_mod( 'boxed' ) ) { 
					$styles .= '.boxed #wrapper, .container-inner { max-width: '.get_theme_mod('container-width').'px; }'."\n";
				}
				else {
					$styles .= '.container-inner { max-width: '.get_theme_mod('container-width').'px; }'."\n";
				}
			}
			// sidebar padding
			if ( get_theme_mod('sidebar-padding','30') != '30' ) {
				$styles .= '.sidebar .widget { padding-left: '.get_theme_mod('sidebar-padding').'px; padding-right: '.get_theme_mod('sidebar-padding').'px; }'."\n";
			}
			// primary color
			if ( get_theme_mod('color-1','#e64338') != '#e64338' ) {
				$styles .= '
::selection { background-color: '.get_theme_mod('color-1').'; }
::-moz-selection { background-color: '.get_theme_mod('color-1').'; }

a,
.themeform label .required,
#flexslider-featured .flex-direction-nav .flex-next:hover,
#flexslider-featured .flex-direction-nav .flex-prev:hover,
.post-hover:hover .post-title a,
.post-title a:hover,
.post-nav li a:hover i,
.post-nav li a:hover span,
.sidebar .post-nav li a:hover i,
.sidebar .post-nav li a:hover span,
.content .post-nav li a:hover i,
.content .post-nav li a:hover span,
.widget_rss ul li a,
.widget_calendar a,
.alx-tab .tab-item-category a,
.alx-posts .post-item-category a,
.alx-tab li:hover .tab-item-title a,
.alx-tab li:hover .tab-item-comment a,
.alx-posts li:hover .post-item-title a,
.dark .widget a:hover,
.dark .widget_rss ul li a,
.dark .widget_calendar a,
.dark .alx-tab .tab-item-category a,
.dark .alx-posts .post-item-category a,
.dark .alx-tab li:hover .tab-item-title a,
.dark .alx-tab li:hover .tab-item-comment a,
.dark .alx-posts li:hover .post-item-title a,
.comment-tabs li.active a,
.comment-awaiting-moderation,
.child-menu a:hover,
.child-menu .current_page_item > a,
.wp-pagenavi a { color: '.get_theme_mod('color-1').'; }

.themeform input[type="submit"],
.themeform button[type="submit"],
.s1 .sidebar-top,
.s1 .sidebar-toggle,
.s2 .sidebar-top,
.s2 .sidebar-toggle,
#flexslider-featured .flex-control-nav li a.flex-active,
.post-tags a:hover,
.author-bio .bio-avatar:after,
.jp-play-bar, 
.jp-volume-bar-value,
.widget_calendar caption,
.dark .widget_calendar caption,
.commentlist li.bypostauthor > .comment-body:after,
.commentlist li.comment-author-admin > .comment-body:after { background-color: '.get_theme_mod('color-1').'; }

.s3 .social-links li a:hover,
.post-format .format-container,
.dark .alx-tabs-nav li.active a { border-color: '.get_theme_mod('color-1').'; }

.alx-tabs-nav li.active a,
.comment-tabs li.active a,
.wp-pagenavi a:hover,
.wp-pagenavi a:active,
.wp-pagenavi span.current { border-bottom-color: '.get_theme_mod('color-1').'!important; }					
				'."\n";
			}
			// comments bubble color
			if ( get_theme_mod('color-bubble','#f7e696') != '#f7e696' ) {
				$styles .= '
.post-comments,
.page-title .meta-single li.comments a  { background-color: '.get_theme_mod('color-bubble').'; color: #fff; }
.post-comments:hover { color: #fff; }
.post-comments span:before,
.page-title .meta-single li.comments a:before { border-right-color: '.get_theme_mod('color-bubble').'; border-top-color: '.get_theme_mod('color-bubble').'; }				
				'."\n";
			}	
			// topbar color
			if ( get_theme_mod('color-topbar','#e64338') != '#e64338' ) {
				$styles .= '
.search-expand,
#nav-topbar.nav-container { background-color: '.get_theme_mod('color-topbar').'; }
@media only screen and (min-width: 720px) {
	#nav-topbar .nav ul { background-color: '.get_theme_mod('color-topbar').'; }
}			
				'."\n";
			}			
			// header color
			if ( get_theme_mod('color-header','#23282d') != '#23282d' ) {
				$styles .= '
#header,
.s3 { background-color: '.get_theme_mod('color-header','').'; }
@media only screen and (min-width: 720px) {
	#nav-header .nav ul { background-color: '.get_theme_mod('color-header').'; }
}			
				'."\n";
			}
			// header menu color
			if ( get_theme_mod('color-header-menu','') != '' ) {
				$styles .= '
#nav-header.nav-container { background-color: '.get_theme_mod('color-header-menu').'; }
@media only screen and (min-width: 720px) {
	#nav-header .nav ul { background-color: '.get_theme_mod('color-header-menu').'; }
}			
				'."\n";
			}		
			// footer menu color
			if ( get_theme_mod('color-footer-menu','#23282d') != '#23282d' ) {
				$styles .= '
#nav-footer.nav-container,
#footer-bottom #back-to-top { background-color: '.get_theme_mod('color-footer-menu').'; }
@media only screen and (min-width: 720px) {
	#nav-footer .nav ul { background-color: '.get_theme_mod('color-footer-menu').'; }
}			
				'."\n";
			}		
			// footer color
			if ( get_theme_mod('color-footer','#e64338') != '#e64338' ) {
				$styles .= '#footer-bottom { background-color: '.get_theme_mod('color-footer').'; }'."\n";
			}			
			// header logo max-height
			if ( get_theme_mod('logo-max-height','60') != '60' ) {
				$styles .= '.site-title a img { max-height: '.get_theme_mod('logo-max-height').'px; }'."\n";
			}
			// image border radius
			if ( get_theme_mod('image-border-radius') != '0' ) {
				$styles .= 'img { -webkit-border-radius: '.get_theme_mod('image-border-radius').'px; border-radius: '.get_theme_mod('image-border-radius').'px; }'."\n";
			}
			// body background
			if ( get_theme_mod('body-background','') != '' ) {
				
				$body_background = get_theme_mod('body-background');
				$body_color = $body_background['background-color'];
				$body_image = $body_background['background-image'];
				$body_position = $body_background['background-position'];
				$body_attachment = $body_background['background-attachment'];
				$body_repeat = $body_background['background-repeat'];
				$body_size = $body_background['background-size'];
				
				if ( $body_image && $body_size == "" ) {
					$styles .= 'body { background: '.$body_color.' url('.$body_image.') '.$body_attachment.' '.$body_position.' '.$body_repeat.'; }'."\n";
				} elseif ( $body_image && $body_size != "" ) {
					$styles .= 'body { background: '.$body_color.' url('.$body_image.') '.$body_attachment.' '.$body_position.' '.$body_repeat.'; background-size: '.$body_size.'; }'."\n";
				} elseif ( $body_background['background-color'] ) {
					$styles .= 'body { background-color: '.$body_color.'; }'."\n";
				} else {
					$styles .= '';
				}
			}
			
			$styles .= '</style>'."\n";
			// end output
			
			echo $styles;		
		}
	}
	
}
add_action( 'wp_head', 'alx_dynamic_css', 100 );
