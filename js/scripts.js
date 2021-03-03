/*
	scripts.js
	
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
	
	Copyright: (c) 2013 Alexander "Alx" Agnarson, http://alx.media
*/

"use strict";

jQuery(document).ready(function($) {

/*  Toggle header search
/* ------------------------------------ */
	$('.toggle-search').on('click', function() {
		$('.toggle-search').toggleClass('active');
		$('.search-expand').fadeToggle(250);
            setTimeout(function(){
                $('.search-expand input').focus();
            }, 300);
	});
	
/*  Scroll to top
/* ------------------------------------ */
	$('a#back-to-top').on('click', function() {
		$('html, body').animate({scrollTop:0},'slow');
		return false;
	});
	
/*  Tabs widget
/* ------------------------------------ */	
	(function() {
		var $tabsNav       = $('.alx-tabs-nav'),
			$tabsNavLis    = $tabsNav.children('li'),
			$tabsContainer = $('.alx-tabs-container');

		$tabsNav.each(function() {
			var $this = $(this);
			$this.next().children('.alx-tab').stop(true,true).hide()
			.siblings( $this.find('a').attr('href') ).show();
			$this.children('li').first().addClass('active').stop(true,true).show();
		});

		$tabsNavLis.on('click', function(e) {
			var $this = $(this);

			$this.siblings().removeClass('active').end()
			.addClass('active');
			
			$this.parent().next().children('.alx-tab').stop(true,true).hide()
			.siblings( $this.find('a').attr('href') ).fadeIn();
			e.preventDefault();
		}).children( window.location.hash ? 'a[href="' + window.location.hash + '"]' : 'a:first' ).trigger('click');

	})();
	
/*  Comments / pingbacks tabs
/* ------------------------------------ */	
	$('.comment-tabs li').on('click', function() {
		$('.comment-tabs li').removeClass('active');
		$(this).addClass('active');
		$('.comment-tab').hide();
		var selected_tab = $(this).find('a').attr('href');
		$(selected_tab).fadeIn();
		return false;
	});

/*  Table odd row class
/* ------------------------------------ */
	$('table tr:odd').addClass('alt');

/*  Sidebar collapse
/* ------------------------------------ */
	$('body').addClass('s1-collapse');
	$('body').addClass('s2-collapse');
	
	$('.s1 .sidebar-toggle').on('click', function() {
		$('body').toggleClass('s1-collapse').toggleClass('s1-expand');
		if ($('body').is('.s2-expand')) { 
			$('body').toggleClass('s2-expand').toggleClass('s2-collapse');
		}
	});
	$('.s2 .sidebar-toggle').on('click', function() {
		$('body').toggleClass('s2-collapse').toggleClass('s2-expand');
		if ($('body').is('.s1-expand')) { 
			$('body').toggleClass('s1-expand').toggleClass('s1-collapse');
		}
	});
	
/*  Fitvids
/* ------------------------------------ */
	function responsiveVideo() {
			if ( $().fitVids ) {
				$('#wrapper').fitVids();
			}	
		}
		
	responsiveVideo();

/*  Trap focus
/* ------------------------------------ */	
	// add all the elements inside modal which you want to make focusable
	const  focusableElements =
		'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
	const modal = document.querySelector('.search-trap-focus'); // select the modal by it's id

	if ( modal ) { 
		const firstFocusableElement = modal.querySelectorAll(focusableElements)[0]; // get first element to be focused inside modal
		const focusableContent = modal.querySelectorAll(focusableElements);
		const lastFocusableElement = focusableContent[focusableContent.length - 1]; // get last element to be focused inside modal


		document.addEventListener('keydown', function(e) {
		  let isTabPressed = e.key === 'Tab' || e.keyCode === 9;

		  if (!isTabPressed) {
			return;
		  }

		  if (e.shiftKey) { // if shift key pressed for shift + tab combination
			if (document.activeElement === firstFocusableElement) {
			  lastFocusableElement.focus(); // add focus for the last focusable element
			  e.preventDefault();
			}
		  } else { // if tab key is pressed
			if (document.activeElement === lastFocusableElement) { // if focused has reached to last focusable element then focus first focusable element after pressing tab
			  firstFocusableElement.focus(); // add focus for the first focusable element
			  e.preventDefault();
			}
		  }
		});	
	}	
	
});