/* Add custom sidebar */
var custom_options  ='<div class="swpRightPosButton">';
custom_options  +=	'<span class="icon-cog animate-spin"></span>';
custom_options  +='</div>';
custom_options  +='<div class="swpRightPos">';
custom_options  +=	'<div class="sc_tabs" data-active="0">';
custom_options  +=		'<ul class="tabsMenuHead">';
custom_options  +=			'<li class="right_tab_custom">';
custom_options  +=				'<a class="tabsCustom" href="#tabsCustom" title="Custom panel"></a>';
custom_options  +=			'</li>';
custom_options  +=			'<li class="right_tab_widgets">';
custom_options  +=				'<a class="tabsWidget" href="#tabsWidget" title="Widgets"></a>';
custom_options  +=			'</li>';
custom_options  +=			'<li class="right_tab_menu">';
custom_options  +=				'<a class="tabsMenu" href="#tabsMenu" title="Custom menu"></a>';
custom_options  +=			'</li>';
custom_options  +=			'<li class="right_tab_favorites">';
custom_options  +=				'<a class="tabsFavorite" href="#tabsFavorite" title="Bookmarks"></a>';
custom_options  +=			'</li>';
custom_options  +=		'</ul>';
custom_options  +=		'<div id="tabsCustom" class="tabsMenuBody">';
custom_options  +=			'<div id="custom_options">';
custom_options  +=				'<div id="custom_options_scroll" class="sc_scroll sc_scroll_vertical swiper-slider-container scroll-container">';
custom_options  +=					'<div class="sc_scroll_wrapper swiper-wrapper">';
custom_options  +=						'<div class="sc_scroll_slide swiper-slide">';
custom_options  +=							'<div class="co_header">';
custom_options  +=								'<h4 class="co_title">Choose Your Style</h4>';
custom_options  +=								'<a href="#" class="co_reset_to_default icon-arrows-cw" title="Reset to default"></a>';
custom_options  +=							'</div>';
custom_options  +=							'<div class="co_options">';
custom_options  +=								'<form name="co_form">';
custom_options  +=									'<input type="hidden" id="co_site_url" name="co_site_url" value="index.html"/>';
custom_options  +=									'<div class="co_form_row">';
custom_options  +=										'<input type="hidden" name="co_body_style" value="fullscreen"/>';
custom_options  +=										'<span class="co_label">Body style:</span>';
custom_options  +=										'<div class="co_switch_box">';
custom_options  +=											'<a href="#" class="co_switch_label wide">Wide</a>';
custom_options  +=											'<div class="switcher">';
custom_options  +=												'<a href="#"></a>';
custom_options  +=											'</div>';
custom_options  +=											'<a href="#" class="co_switch_label boxed">Boxed</a>';
custom_options  +=										'</div>';
custom_options  +=									'</div>';
custom_options  +=									'<div class="co_form_row">';
custom_options  +=										'<span class="co_label">Theme colors:</span>';
custom_options  +=										'<div class="co_form_subrow">';
custom_options  +=											'<input type="hidden" name="co_theme_color" value="#f1c458"/>';
custom_options  +=											'<span class="co_label one_row">Color 1:</span>';
custom_options  +=											'<div id="co_theme_color" class="iColorPicker"></div>';
custom_options  +=											'<br/>';
custom_options  +=											'<input type="hidden" name="co_theme_color1" value="#f8b40e"/>';
custom_options  +=											'<span class="co_label one_row">Color 2:</span>';
custom_options  +=											'<div id="co_theme_color1" class="iColorPicker"></div>';
custom_options  +=											'<br/>';
custom_options  +=											'<input type="hidden" name="co_theme_color2" value="#e77420"/>';
custom_options  +=											'<span class="co_label one_row">Color 3:</span>';
custom_options  +=											'<div id="co_theme_color2" class="iColorPicker"></div>';
custom_options  +=										'</div>';
custom_options  +=									'</div>';
custom_options  +=									'<div class="co_form_row">';
custom_options  +=										'<input type="hidden" name="co_bg_color" value=""/>';
custom_options  +=										'<span class="co_label">Background color:</span>';
custom_options  +=										'<div id="co_bg_color" class="iColorPicker"></div>';
custom_options  +=									'</div>';
custom_options  +=									'<div class="co_form_row">';
custom_options  +=										'<input type="hidden" name="co_bg_pattern" value="0"/>';
custom_options  +=										'<span class="co_label">Background pattern:</span>';
custom_options  +=										'<div id="co_bg_pattern_list">';
custom_options  +=											'<a href="#" id="pattern_0" class="co_pattern_wrapper current">';
custom_options  +=												'<img src="custom_tools/images/bg/pattern_0_thumb2.png" width="22" height="22" alt=""/>';
custom_options  +=											'</a>';
custom_options  +=											'<a href="#" id="pattern_1" class="co_pattern_wrapper">';
custom_options  +=												'<img src="custom_tools/images/bg/pattern_1_thumb2.png" width="22" height="22" alt=""/>';
custom_options  +=											'</a>';
custom_options  +=											'<a href="#" id="pattern_2" class="co_pattern_wrapper">';
custom_options  +=												'<img src="custom_tools/images/bg/pattern_2_thumb2.png" width="22" height="22" alt=""/>';
custom_options  +=											'</a>';
custom_options  +=											'<a href="#" id="pattern_3" class="co_pattern_wrapper">';
custom_options  +=												'<img src="custom_tools/images/bg/pattern_3_thumb2.png" width="22" height="22" alt=""/>';
custom_options  +=											'</a>';
custom_options  +=											'<a href="#" id="pattern_4" class="co_pattern_wrapper">';
custom_options  +=												'<img src="custom_tools/images/bg/pattern_4_thumb2.png" width="22" height="22" alt=""/>';
custom_options  +=											'</a>';
custom_options  +=											'<a href="#" id="pattern_5" class="co_pattern_wrapper">';
custom_options  +=												'<img src="custom_tools/images/bg/pattern_5_thumb2.png" width="22" height="22" alt=""/>';
custom_options  +=											'</a>';
custom_options  +=											'<a href="#" id="pattern_6" class="co_pattern_wrapper">';
custom_options  +=												'<img src="custom_tools/images/bg/pattern_6_thumb2.png" width="22" height="22" alt=""/>';
custom_options  +=											'</a>';
custom_options  +=											'<a href="#" id="pattern_7" class="co_pattern_wrapper">';
custom_options  +=												'<img src="custom_tools/images/bg/pattern_7_thumb2.png" width="22" height="22" alt=""/>';
custom_options  +=											'</a>';
custom_options  +=											'<a href="#" id="pattern_8" class="co_pattern_wrapper">';
custom_options  +=												'<img src="custom_tools/images/bg/pattern_8_thumb2.png" width="22" height="22" alt=""/>';
custom_options  +=											'</a>';
custom_options  +=											'<a href="#" id="pattern_9" class="co_pattern_wrapper">';
custom_options  +=												'<img src="custom_tools/images/bg/pattern_9_thumb2.png" width="22" height="22" alt=""/>';
custom_options  +=											'</a>';
custom_options  +=										'</div>';
custom_options  +=									'</div>';
custom_options  +=									'<div class="co_form_row">';
custom_options  +=										'<input type="hidden" name="co_bg_image" value="0"/>';
custom_options  +=										'<span class="co_label">Background image:</span>';
custom_options  +=										'<div id="co_bg_images_list">';
custom_options  +=											'<a href="#" id="image_1" class="co_image_wrapper">';
custom_options  +=												'<img src="custom_tools/images/bg/image_1_thumb2.jpg" width="48" height="28" alt=""/>';
custom_options  +=											'</a>';
custom_options  +=											'<a href="#" id="image_2" class="co_image_wrapper">';
custom_options  +=												'<img src="custom_tools/images/bg/image_2_thumb2.jpg" width="48" height="28" alt=""/>';
custom_options  +=											'</a>';
custom_options  +=											'<a href="#" id="image_3" class="co_image_wrapper">';
custom_options  +=												'<img src="custom_tools/images/bg/image_3_thumb2.jpg" width="48" height="28" alt=""/>';
custom_options  +=											'</a>';
custom_options  +=											'<a href="#" id="image_4" class="co_image_wrapper">';
custom_options  +=												'<img src="custom_tools/images/bg/image_4_thumb2.jpg" width="48" height="28" alt=""/>';
custom_options  +=											'</a>';
custom_options  +=											'<a href="#" id="image_5" class="co_image_wrapper">';
custom_options  +=												'<img src="custom_tools/images/bg/image_5_thumb2.jpg" width="48" height="28" alt=""/>';
custom_options  +=											'</a>';
custom_options  +=											'<a href="#" id="image_6" class="co_image_wrapper">';
custom_options  +=												'<img src="custom_tools/images/bg/image_6_thumb2.jpg" width="48" height="28" alt=""/>';
custom_options  +=											'</a>';
custom_options  +=										'</div>';
custom_options  +=									'</div>';
custom_options  +=								'</form>';
custom_options  +=							'</div>';
custom_options  +=						'</div>';
custom_options  +=					'</div>';
custom_options  +=					'<div id="custom_options_scroll_bar" class="sc_scroll_bar sc_scroll_bar_vertical custom_options_scroll_bar"></div>';
custom_options  +=				'</div>';
custom_options  +=			'</div>';
custom_options  +=		'</div>';
custom_options  +=		'<div id="tabsWidget" class="tabsMenuBody">';
custom_options  +=			'<div id="sidebar_panel" class="widget_area sidebar_panel sidebar" role="complementary">';
custom_options  +=				'<div id="sidebar_panel_scroll" class="sc_scroll sc_scroll_vertical swiper-slider-container scroll-container">';
custom_options  +=					'<div class="sc_scroll_wrapper swiper-wrapper">';
custom_options  +=						'<div class="sc_scroll_slide swiper-slide">';
custom_options  +=							'<aside class="widgetWrap widget widget_archive">';
custom_options  +=								'<h3 class="title">Archives</h3>';
custom_options  +=								'<ul>';
custom_options  +=									'<li>';
custom_options  +=										'<a href="#">February 2015</a>&nbsp;(15)';
custom_options  +=									'</li>';
custom_options  +=									'<li>';
custom_options  +=										'<a href="#">September 2014</a>&nbsp;(16)';
custom_options  +=									'</li>';
custom_options  +=									'<li>';
custom_options  +=										'<a href="#">August 2014</a>&nbsp;(29)';
custom_options  +=									'</li>';
custom_options  +=									'<li>';
custom_options  +=										'<a href="#">July 2014</a>&nbsp;(14)';
custom_options  +=									'</li>';
custom_options  +=									'<li>';
custom_options  +=										'<a href="#">June 2014</a>&nbsp;(35)';
custom_options  +=									'</li>';
custom_options  +=									'<li>';
custom_options  +=										'<a href="#">May 2014</a>&nbsp;(3)';
custom_options  +=									'</li>';
custom_options  +=									'<li>';
custom_options  +=										'<a href="#">April 2014</a>&nbsp;(2)';
custom_options  +=									'</li>';
custom_options  +=									'<li>';
custom_options  +=										'<a href="#">January 2012</a>&nbsp;(5)';
custom_options  +=									'</li>';
custom_options  +=								'</ul>';
custom_options  +=							'</aside>';
custom_options  +=							'<aside class="widgetWrap widget widget_pages">';
custom_options  +=								'<h3 class="title">Pages</h3>';
custom_options  +=								'<ul>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="projects_1_column.html">1 column</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="projects_2_columns.html">2 columns</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="projects_3_columns.html">3 columns</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="features_pages_about_us.html">About Us</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="appointment.html">Appointments</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="blog_without_sidebar.html">Blog streampage</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="contacts.html">Contact Us</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="features_pages_faq.html">FAQ</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="projects_4_columns.html">Four columns</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="index.html">Home 1 (HR)</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="index2.html">Home 2 (HR)</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="index3.html">Home 3 (HR)</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="features_shop.html">Homepage E-Commerce</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="features_pages_handyman.html">Our Staff Member\'s Page</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="features_pages_page_404.html">Page 404</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="pricing.html">Pricing Tables</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="features_pages_protected_page.html">Protected Page</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="features_pages_service.html">Service / Department Page</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="features_typography.html">Typography</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="page_item">';
custom_options  +=										'<a href="features_pages_under_construction.html">Under Construction</a>';
custom_options  +=									'</li>';
custom_options  +=								'</ul>';
custom_options  +=							'</aside>';
custom_options  +=							'<aside class="widgetWrap widget widget_recent_comments">';
custom_options  +=								'<h3 class="title">Recent comments</h3>';
custom_options  +=								'<ul id="recentcomments">';
custom_options  +=									'<li class="recentcomments">';
custom_options  +=										'<span class="comment-author-link">John Doe</span>';
custom_options  +=										'on';
custom_options  +=										'<a href="#">Kitchen Design Ideas</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="recentcomments">';
custom_options  +=										'<span class="comment-author-link">';
custom_options  +=											'<a href="#" rel="external nofollow" class="url">Team | House Repair</a>';
custom_options  +=										'</span> ';
custom_options  +=										'on ';
custom_options  +=										'<a href="#">Our Staff Member\'s Page</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="recentcomments">';
custom_options  +=										'<span class="comment-author-link">admin</span>';
custom_options  +=										'on';
custom_options  +=										'<a href="#">Luxury Vinyl Tile Installation</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="recentcomments">';
custom_options  +=										'<span class="comment-author-link">admin</span>';
custom_options  +=										'on';
custom_options  +=										'<a href="#">Deck Rescue: Renew Your Deck</a>';
custom_options  +=									'</li>';
custom_options  +=									'<li class="recentcomments">';
custom_options  +=										'<span class="comment-author-link">John Doe</span>';
custom_options  +=										'on';
custom_options  +=										'<a href="#">High Tech Faucet</a>';
custom_options  +=									'</li>';
custom_options  +=								'</ul>';
custom_options  +=							'</aside>';
custom_options  +=						'</div>';
custom_options  +=					'</div>';
custom_options  +=					'<div id="sidebar_panel_scroll_bar" class="sc_scroll_bar sc_scroll_bar_vertical sidebar_panel_scroll_bar"></div>';
custom_options  +=				'</div>';
custom_options  +=			'</div>';
custom_options  +=		'</div>';
custom_options  +=		'<div id="tabsMenu" class="tabsMenuBody">';
custom_options  +=			'<div class="sc_scroll sc_scroll_vertical swiper-slider-container scroll-container" id="panelmenu_scroll">';
custom_options  +=				'<div class="sc_scroll_wrapper swiper-wrapper">';
custom_options  +=					'<div class="sc_scroll_slide swiper-slide">';
custom_options  +=						'<nav role="navigation" class="panelmenu_area widget_area">';
custom_options  +=							'<ul id="panelmenu" class="">';
custom_options  +=								'<li class="menu-item">';
custom_options  +=									'<a href="features_shop.html">E-Commerce</a>';
custom_options  +=								'</li>';
custom_options  +=								'<li class="menu-item">';
custom_options  +=									'<a href="#">Sliders</a>';
custom_options  +=								'</li>';
custom_options  +=							'</ul>';
custom_options  +=						'</nav>';
custom_options  +=						'<div class="searchBlock">';
custom_options  +=							'<form role="search" method="get" class="search-form" action="index.html">';
custom_options  +=								'<button type="submit" class="searchSubmit"></button>';
custom_options  +=								'<input type="text" class="searchField" placeholder="Search &hellip;" value="" name="s" title="Search for:"/>';
custom_options  +=							'</form>';
custom_options  +=						'</div>';
custom_options  +=					'</div>';
custom_options  +=				'</div>';
custom_options  +=				'<div id="panelmenu_scroll_bar" class="sc_scroll_bar sc_scroll_bar_vertical panelmenu_scroll_bar">';
custom_options  +=				'</div>';
custom_options  +=			'</div>';
custom_options  +=		'</div>';
custom_options  +=		'<div id="tabsFavorite" class="tabsMenuBody">';
custom_options  +=			'<div class="addBookmarkArea">';
custom_options  +=				'<a href="#" class="addBookmark">add bookmark</a>';
custom_options  +=			'</div>';
custom_options  +=			'<div class="sc_scroll sc_scroll_vertical swiper-slider-container scroll-container scroll-no-swiping" id="bookmarks_scroll">';
custom_options  +=				'<div class="sc_scroll_wrapper swiper-wrapper">';
custom_options  +=					'<div class="sc_scroll_slide swiper-slide swiper-no-swiping">';
custom_options  +=						'<ol class="listBookmarks"></ol>';
custom_options  +=					'</div>';
custom_options  +=				'</div>';
custom_options  +=				'<div id="bookmarks_scroll_bar" class="sc_scroll_bar sc_scroll_bar_vertical bookmarks_scroll_bar"></div>';
custom_options  +=			'</div>';
custom_options  +=		'</div>';
custom_options  +=	'</div>';
custom_options  +='</div>';

jQuery('body').append(custom_options);

// Customization panel
jQuery(document).ready(function() {
	"use strict";

	// Theme & Background color
	jQuery('#co_theme_color').css('backgroundColor', '#f1c458');
	jQuery('#co_theme_color1').css('backgroundColor', '#f8b40e');
	jQuery('#co_theme_color2').css('backgroundColor', '#e77420');
	jQuery('#co_bg_color').css('backgroundColor', '');


	if (jQuery("#custom_options").length===1) {

		// Reset custom settings to default
		jQuery("#custom_options .co_reset_to_default" ).click(function(e) {
			"use strict";
			clearCustomCookies();
			window.location = jQuery("#custom_options #co_site_url").val();
			e.preventDefault();
			return false;
		});

		// Body and Main menu style
		jQuery("#custom_options .switcher a,#custom_options .switcher2 a" ).draggable({
			axis: 'x',
			containment: 'parent',
			stop: function() {
				var left = parseInt(jQuery(this).css('left'), 10);
				var curStyle = left < 25 ? (jQuery(this).parent().hasClass('switcher') ? 'wide' : 'line') : (jQuery(this).parent().hasClass('switcher') ? 'boxed' : 'fon');
				switchBox(jQuery(this).parent(), curStyle, true);
			}
		});
		jQuery("#custom_options .switcher, #custom_options .switcher2" ).click(function(e) {
			"use strict";
			switchBox(jQuery(this));
			e.preventDefault();
			return false;
		});
		jQuery("#custom_options .co_switch_box .co_switch_label").click(function(e) {
			"use strict";
			var state = jQuery(this).hasClass('boxed') ? 'boxed' : (jQuery(this).hasClass('wide') ? 'wide' : (jQuery(this).hasClass('line') ? 'line' : 'fon'));
			switchBox(jQuery(this).siblings('div'), state);
			e.preventDefault();
			return false;
		});

		// Main theme color and Background color
		iColorPicker();
		jQuery('#custom_options .iColorPicker').click(function (e) {
			"use strict";
			iColorShow(null, jQuery(this), changeThemeColor);
		});
		
		// Background patterns
		jQuery('#custom_options #co_bg_pattern_list a').click(function(e) {
			"use strict";
			jQuery("#custom_options .co_switch_box .boxed").trigger('click');
			jQuery('#custom_options #co_bg_pattern_list .co_pattern_wrapper,#custom_options #co_bg_images_list .co_image_wrapper').removeClass('current');
			var obj = jQuery(this).addClass('current');
			var val = obj.attr('id').substr(-1);
			if (Axiom_remember_visitors_settings) {
				jQuery.cookie('bg_color', null, {expires: -1, path: '/'});
				jQuery.cookie('bg_image', null, {expires: -1, path: '/'});
				jQuery.cookie('bg_pattern', val, {expires: 1, path: '/'});
			}
			jQuery(document).find('body').removeClass('bg_pattern_0 bg_pattern_1 bg_pattern_2 bg_pattern_3 bg_pattern_4 bg_pattern_5 bg_pattern_6 bg_pattern_7 bg_pattern_8 bg_pattern_9 bg_image_0 bg_image_1 bg_image_2 bg_image_3 bg_image_4 bg_image_5 bg_image_6').addClass('bg_pattern_' + val);
			e.preventDefault();
			return false;
		});
		// Background images
		jQuery('#custom_options #co_bg_images_list a').click(function(e) {
			"use strict";
			jQuery("#custom_options .co_switch_box .boxed").trigger('click');
			jQuery('#custom_options #co_bg_images_list .co_image_wrapper,#custom_options #co_bg_pattern_list .co_pattern_wrapper').removeClass('current');
			var obj = jQuery(this).addClass('current');
			var val = obj.attr('id').substr(-1);
			if (Axiom_remember_visitors_settings) {
				jQuery.cookie('bg_color', null, {expires: -1, path: '/'});
				jQuery.cookie('bg_pattern', null, {expires: -1, path: '/'});
				jQuery.cookie('bg_image', val, {expires: 1, path: '/'});
			}
			jQuery(document).find('body').removeClass('bg_pattern_0 bg_pattern_1 bg_pattern_2 bg_pattern_3 bg_pattern_4 bg_pattern_5 bg_pattern_6 bg_pattern_7 bg_pattern_8 bg_pattern_9 bg_image_0 bg_image_1 bg_image_2 bg_image_3 bg_image_4 bg_image_5 bg_image_6').addClass('bg_image_' + val);
			e.preventDefault();
			return false;
		});
		jQuery('#custom_options #co_bg_pattern_list a,#custom_options #co_bg_images_list a').hover(
			function() {
				"use strict";
				var pattern = jQuery(this).parent().attr('id')=='co_bg_pattern_list';
				jQuery(this).parent().parent().css({
					'backgroundImage': 'url('+jQuery(this).find('img').attr('src').replace('_thumb2', '_thumb')+')',
					'backgroundRepeat': pattern ? 'repeat' : 'no-repeat'
				});
			},
			function() {
				"use strict";
				jQuery(this).parent().parent().css('backgroundImage', 'none');
			}
		);
	}
});


function clearCustomCookies() {
	jQuery.cookie('theme_color', null, {expires: -1, path: '/'});
	jQuery.cookie('theme_color1', null, {expires: -1, path: '/'});
	jQuery.cookie('theme_color2', null, {expires: -1, path: '/'});
	jQuery.cookie('bg_image', null, {expires: -1, path: '/'});
	jQuery.cookie('bg_pattern', null, {expires: -1, path: '/'});
	jQuery.cookie('bg_color', null, {expires: -1, path: '/'});
	jQuery.cookie('body_style', null, {expires: -1, path: '/'});
}


function switchBox(box) {
	"use strict";
	var toStyle = arguments[1] ? arguments[1] : '';
	var important = arguments[2] ? arguments[2] : false;
	var switcher = box.find('a').eq(0);
	var left = parseInt(switcher.css('left'), 10);
	var newStyle = left < 5 ? (box.hasClass('switcher') ? 'boxed' : 'fon') : (box.hasClass('switcher') ? 'wide' : 'line');
	if (toStyle==='' || important || newStyle === toStyle) {
		if (toStyle==='') {toStyle = newStyle;}
		var right = box.width() - switcher.width() - 7;
		if (toStyle === 'wide' || toStyle === 'line')
			switcher.animate({left: 0}, 200);
		else
			switcher.animate({left: right}, 200);
		if (box.hasClass('switcher')) {
			if (Axiom_remember_visitors_settings) jQuery.cookie('body_style', toStyle, {expires: 1, path: '/'});
			jQuery(document).find('body').removeClass(toStyle==='boxed' ? 'wide' : 'boxed').addClass(toStyle);
			jQuery(document).trigger('resize');
		} else {
			calcMenuColumnsWidth();
		}
	}
	return newStyle;
}


function changeThemeColor(fld, clr) {
	"use strict";
	fld.css('backgroundColor', clr);
	fld.siblings('input').attr('value', clr);

	if (fld.attr('id')==='co_bg_color') {
		jQuery("#custom_options .co_switch_box .boxed").trigger('click');
		jQuery('#custom_options #co_bg_pattern_list .co_pattern_wrapper,#custom_options #co_bg_images_list .co_image_wrapper').removeClass('current');
		if (Axiom_remember_visitors_settings) {
			jQuery.cookie('bg_image', null, {expires: -1, path: '/'});
			jQuery.cookie('bg_pattern', null, {expires: -1, path: '/'});
			jQuery.cookie('bg_color', clr, {expires: 1, path: '/'});
		}
		jQuery(document).find('body').removeClass('bg_pattern_1 bg_pattern_2 bg_pattern_3 bg_pattern_4 bg_pattern_5 bg_image_1 bg_image_2 bg_image_3').css('backgroundColor', clr);
		return;
	}

	if (Axiom_remember_visitors_settings) {
		if (fld.attr('id')==='co_theme_color')
			jQuery.cookie('theme_color', clr, {expires: 1, path: '/'});
		else if (fld.attr('id')==='co_theme_color1')
			jQuery.cookie('theme_color1', clr, {expires: 1, path: '/'});
		else if (fld.attr('id')==='co_theme_color2')
			jQuery.cookie('theme_color2', clr, {expires: 1, path: '/'});
	}

	// This way - with page reload
	//window.location = jQuery("#custom_options #co_site_url").val();
	// This way - without reload
	var styles = jQuery('#theme-skin-css').length > 0 ? jQuery('#theme-skin-css').next() : '';
	if (styles.length == 0 || styles.attr('type')!='text/css') styles = jQuery('#packed-styles-css').length > 0 ? jQuery('#packed-styles-css').next() : '';
	if (styles.length == 0 || styles.attr('type')!='text/css') styles = jQuery('#shortcodes-css').length > 0 ? jQuery('#shortcodes-css').next() : '';
	if (styles.length > 0 && styles.attr('type')=='text/css') {
		clr = rgb2hex(jQuery('#co_theme_color').css('backgroundColor'));
		var rgb = hex2rgb(clr);
		var css_text =
'.theme_accent_bgc,.sc_video_player:active .sc_video_play_button:after,input[type="submit"]:active,input[type="button"]:active,.nav_pages_parts > span.page_num,.nav_comments > span.current,	ul > li.likeActive:active > a,.sc_table.sc_table_style_1 table tr:first-child th,.sc_table.sc_table_style_1 table tr:first-child td,	.masonry article .status,.post .postStatus,	.sc_team .sc_team_item .sc_team_item_avatar:after,.itemPageFull .itemDescriptionWrap .toggleButton:active,	.footerWrap .footerWidget .sc_video_player:active .sc_video_play_button:after,.topMenuStyleLine > ul .menu-panel,.userFooterSection.global,	.sliderLogo .elastislide-wrapper nav span:active:before,.sc_skills_counter .sc_skills_item.sc_skills_style_3 .sc_skills_count,	.sc_skills_counter .sc_skills_item.sc_skills_style_4 .sc_skills_count,	.sc_skills_counter .sc_skills_item.sc_skills_style_4 .sc_skills_info,.sc_dropcaps.sc_dropcaps_style_1 .sc_dropcap,.sc_dropcaps.sc_dropcaps_style_2 .sc_dropcap,.sc_tooltip_parent .sc_tooltip,.sc_tooltip_parent .sc_tooltip:before,.sc_title_bg:not(.sc_bg_animated):before,.sc_accordion.sc_accordion_style_3 .sc_accordion_item .sc_accordion_title,	.sc_toggles.sc_toggles_style_3 .sc_toggles_item .sc_toggles_title,.sc_scroll_controls .flex-direction-nav a:active,.sc_testimonials_style_1 .flex-direction-nav a:active,	.sc_testimonials_style_3 .sc_testimonials_items,.sc_testimonials_style_3 .flex-direction-nav li,.sc_testimonials_style_3 .flex-direction-nav a,	.pagination .pageLibrary > li.libPage > .pageFocusBlock .flex-direction-nav a:active,	.sc_popup_light:before,	.user-popUp ul.loginHeadTab li.ui-tabs-active:before,.sc_banner:before,	.global_bg,	.widget_area .tagcloud a:hover,	.widget_area .tagcloud a:active,	.sc_scroll_bar .swiper-scrollbar-drag:before,.widgetTabs .widgetTop .tagcloud a:hover,	.widgetTabs .widgetTop .tagcloud a:active,#custom_options .co_options #co_bg_images_list a.current,#custom_options .co_options #co_bg_pattern_list a.current,	.fullScreenSlider.globalColor .sliderHomeBullets .rsContent:before,	.fullScreenSlider .sliderHomeBullets .rsContent .slide-3 .order p span,	ul.sc_list_style_disk li:before,.sc_slider_pagination_area .flex-control-nav.manual .slide_date,	.sc_tabs.sc_tabs_style_2 .sc_tabs_titles li.ui-state-active a,	.sc_contact_form_custom .bubble label:hover,.sc_contact_form_custom .bubble label.selected,.sc_video_player:hover .sc_video_play_button:after,.footerStyleLight .footerWidget .sc_video_player:hover .sc_video_play_button:after,	.sliderHomeBullets.slider_alias_13 .textPrice,	.sliderHomeBullets.slider_alias_13 .slide-2 .textPrice,	.squareButton > a:after,	.squareButton.active > span,.squareButton.active > a,.squareButton.ui-state-active > a,	.roundButton > a:active,	.squareButton > a:active,.squareButton.global > a,.squareButton.global > button,.squareButton.dark > a:active:after,	.roundButton.border:hover > a,	.sc_pricing_table .sc_pricing_columns .sc_pricing_title,.sc_pricing_table .sc_pricing_columns:hover ul li.sc_pricing_title,	.sc_highlight.sc_highlight_style_1,	.sc_pricing_table .sc_pricing_columns ul:hover,	.sc_accordion .sc_accordion_item.sc_active .sc_accordion_title:before,	.days_container_all .booking_day_container:hover .booking_day_slots,	.woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button,.woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce #content input.button.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page #content input.button.alt,	.ih-item.square.effect6 .info .link-wrapper:hover,	.masonry article .thumb .link-wrapper a:hover,	.sliderHomeBullets.slider_alias_13 .order a, .theme_accent2_bgc,	.sc_title_divider.theme_accent2 .sc_title_divider_before,	.sc_title_divider.theme_accent2 .sc_title_divider_after,	.sliderHomeBullets.slider_alias_15 .order a,	.dark .sc_slider_pagination_area .flex-control-nav.manual li.active .slide_date,	.dark .sc_slider_pagination_area .flex-control-nav.manual li.cs-active-pagination .slide_date,	.dark .sc_slider_pagination_area .flex-control-nav.manual li:hover .slide_date,	.sc_blogger.style_date .sc_blogger_item .sc_blogger_date,	.sc_video_player .sc_video_play_button:after,	.footerStyleLight .footerWidget .sc_video_player .sc_video_play_button:after,	.twitBlock,.twitBlockWrap,	.sliderHomeBullets.slider_alias_13 .order a:hover, .sc_skills_bar .sc_skills_item .sc_skills_count, .tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"], .tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"] > a, #tribe_events_filters_wrapper input[type="submit"], .tribe-events-button, #tribe-events .tribe-events-button, .tribe-events-button.tribe-inactive, #tribe-events .tribe-events-button:hover, .tribe-events-button:hover, .tribe-events-button.tribe-active:hover,.openResponsiveMenu:after, #toc .toc_description'
				+' { background-color: '+clr+'; }'

				+' .woocommerce input#submit:hover, .woocommerce input#submit:active,.woocommerce .button:hover,.woocommerce .button:active,#booking_submit_button,.booking_book_now_custom,.booking_book_now_custom:hover,	.booking_ok_button,.booking_ok_button:hover,	.Axiom_message_dialog .Axiom_message_button:hover,	.post-password-form input[type="submit"]:hover,.sliderHomeBullets.slider_alias_13 .order2 a:hover,'
				+' ::selection,'
				+' ::-moz-selection,'
				+' .woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range, .twitBlock .sc_slider .flex-direction-nav li, .sliderHomeBullets.slider_alias_13 .textPrice > div'
				+' { background-color: '+clr+' !important; }'

				+' .mejs-embed, .mejs-embed body, .mejs-container .mejs-controls,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle, .theme_accent2_bg, #tribe-bar-form .tribe-bar-submit input[type="submit"]'
				+' { background: '+clr+' !important; }'

				+'.ih-item.circle.effect1.colored .info,.ih-item.circle.effect2.colored .info,.ih-item.circle.effect5.colored .info .info-back,	.ih-item.circle.effect19.colored .info,	.ih-item.circle.effect20.colored .info .info-back,.ih-item.square.effect4.colored .mask1,.ih-item.square.effect4.colored .mask2,	.ih-item.square.effect7.colored .info,	.ih-item.square.effect12.colored .info,	.ih-item.square.effect13.colored .info,	.sc_image_shape_round:hover figcaption,.post .sc_image_shape_round:hover figcaption'
				+' { background-color: rgba('+rgb.r+','+rgb.g+','+rgb.b+',0.6) !important; }'

				+'.mejs-controls .mejs-volume-button .mejs-volume-slider'
				+' { background-color: rgba('+rgb.r+','+rgb.g+','+rgb.b+',0.7) !important; }'

				+'.sc_slider_flex .sc_slider_info,.sc_slider_swiper .sc_slider_info,.sc_slider_flex .flex-direction-nav li,.sc_slider_swiper .flex-direction-nav li'
				+' { background-color: rgba('+rgb.r+','+rgb.g+','+rgb.b+',0.8) !important; }'

				+' .sc_table.sc_table_style_1 table tr:first-child th,.sc_table.sc_table_style_1 table tr:first-child td,'
				+' .woocommerce .woocommerce-message, .woocommerce-page .woocommerce-message,				.woocommerce a.button.alt:active, .woocommerce button.button.alt:active, .woocommerce input.button.alt:active, .woocommerce #respond input#submit.alt:active, .woocommerce #content input.button.alt:active, .woocommerce-page a.button.alt:active, .woocommerce-page button.button.alt:active, .woocommerce-page input.button.alt:active, .woocommerce-page #respond input#submit.alt:active, .woocommerce-page #content input.button.alt:active,	.woocommerce a.button:active, .woocommerce button.button:active, .woocommerce input.button:active, .woocommerce #respond input#submit:active, .woocommerce #content input.button:active, .woocommerce-page a.button:active, .woocommerce-page button.button:active, .woocommerce-page input.button:active, .woocommerce-page #respond input#submit:active, .woocommerce-page #content input.button:active'
				+' { border-top-color: '+clr+' !important; }'

				+' .sc_table.sc_table_style_1 table tr:first-child th:first-child,.sc_table.sc_table_style_1 table tr:first-child td:first-child, #toc .toc_description::after'
				+' { border-left-color: '+clr+' !important; }'

				+' .sc_table.sc_table_style_1 table tr:first-child th:last-child,.sc_table.sc_table_style_1 table tr:first-child td:last-child,.ih-item.circle.effect1 .spinner'
				+' { border-right-color: '+clr+' !important; }'

				+' .ih-item.circle.effect1 .spinner, .hover_red .sc_section:hover .sc_title'
				+' { border-bottom-color: '+clr+' !important; }'

				+'.theme_accent_border, .postSharing > ul > li > a:active,	.postSharing > ul > li > span:active, .roundButton > a:active,.roundButton.border > a,.nav_pages_parts > span.page_num,	.nav_comments > span.current,#sc_calendar thead tr th,	.sc_calendar thead tr + tr th,	.sc_skills_bar .sc_skills_item .sc_skills_count,	.itemPageFull .itemDescriptionWrap .toggleButton:active,.footerWidget .sc_video_player:active .sc_video_play_button:after,.topWrap .topMenuStyleLine > ul > li ul,	.topMenuStyleLine > ul#mainmenu ul.menu-panel,.sc_scroll_controls .flex-direction-nav a:active,.sc_testimonials_style_1 .flex-direction-nav a:active,	.pagination .flex-direction-nav a:active,	.sliderLogo .elastislide-wrapper nav span:active:before,	.sc_dropcaps.sc_dropcaps_style_4 .sc_dropcap,	.sc_dropcaps.sc_dropcaps_style_5 .sc_dropcap,	.sc_dropcaps.sc_dropcaps_style_6 .sc_dropcap,	.sc_accordion.sc_accordion_style_3 .sc_accordion_item,	.sc_toggles.sc_toggles_style_3 .sc_toggles_item,	.sc_tooltip_parent,	pre.code,	.widget_area .tagcloud a:hover,	.widget_area .tagcloud a:active,	.sc_accordion .sc_accordion_item.sc_active .sc_accordion_title:before,	.sc_accordion.sc_accordion_style_3 .sc_accordion_item.sc_active .sc_accordion_title:before,	.pagination .squareButton a:hover,	.pagination .squareButton a:active, .pagination .squareButton span'
				+' { border-color: '+clr+'; }'

				+'.ih-item.circle.effect17.colored a:hover .img:before'
				+' { box-shadow: inset 0 0 0 110px '+clr+', inset 0 0 0 16px rgba(255, 255, 255, 0.8), 0 1px 2px rgba(0, 0, 0, 0.1); box-shadow: inset 0 0 0 110px rgba('+rgb.r+','+rgb.g+','+rgb.b+',0.6), inset 0 0 0 16px rgba(255, 255, 255, 0.8), 0 1px 2px rgba(0, 0, 0, 0.1); }';

		if (window.theme_skin_set_theme_color)
			css_text = theme_skin_set_theme_color(css_text, clr);

		// Theme (Accent) color 1
		clr = rgb2hex(jQuery('#co_theme_color1').css('backgroundColor'));
		rgb = hex2rgb(clr);

		css_text +=
			'a:hover, .theme_accent, .topTabsWrap .speedBar a:hover, .topWrap .topMenuStyleLine > ul > li ul li a:hover, .infoPost a:hover, .tabsButton ul li a:hover, .widgetWrap  ul  li:before, .widget_popular_posts article h3:before, .widgetTabs .widget_popular_posts article .post_info .post_date a:hover, .sidebar .widget_popular_posts article .post_info .post_date a:hover, .sidebar .widget_recent_posts article .post_info .post_date a:hover, .main .widgetWrap a:hover, .main .widgetWrap a:hover span, .widgetWrap a:hover span,	.roundButton:hover a, input[type="submit"]:hover, input[type="button"]:hover,.roundButton.border > a,.nav_pages_parts > a:hover, .nav_comments > a:hover,.comments_list a.comment-edit-link:hover,.widget_area ul.tabs > li.squareButtonlite.ui-state-active > a,#sc_calendar tbody td a,#sc_calendar tbody td.today a:hover,.sc_calendar tbody td a,	.sc_calendar tbody td.today a:hover,blockquote cite,blockquote cite a,	.sc_quote_title,.sc_quote_title a,	.postLink a,	.masonry article .masonryInfo a:hover,	.masonry article .masonryInfo span.infoTags a:hover,.relatedPostWrap article .relatedInfo a:hover,	.relatedPostWrap article .relatedInfo span.infoTags a:hover,.infoPost span.infoTags a:hover,	.page404 p a,	.page404 .searchAnimation.sFocus .searchIcon,	.sc_team .sc_team_item .sc_team_item_position,	.copyWrap a,	.comments .commBody li.commItem .replyWrap .posted a:hover,	.comments .commBody li.commItem h4 a:hover,	.ratingItem span:before,	.reviewBlock .totalRating,	.widget_area .contactInfo .fContact:before,	.widget_area .widgetWrap a:hover,	.widget_area .widgetWrap a:hover span,	.widget_area .widgetWrap ul > li > a:hover,	.widget_area .widgetWrap ul > li > a:hover span,	.footerStyleLight .widget_area article .post_title:before,	.footerStyleLight .widget_area article .post_info a:hover,	.footerStyleLight .widget_area article .post_info .post_date a:hover,.sc_list_style_arrows li:before,.sc_list_style_arrows li a:hover,.sc_list_style_iconed li a:hover,.sc_accordion.sc_accordion_style_1 .sc_accordion_item .sc_accordion_title,.sc_accordion.sc_accordion_style_2 .sc_accordion_item.sc_active .sc_accordion_title,.sc_accordion.sc_accordion_style_3 .sc_accordion_item.sc_active .sc_accordion_title,.sc_toggles.sc_toggles_style_1 .sc_toggles_item .sc_toggles_title,.sc_toggles.sc_toggles_style_1 .sc_toggles_item .sc_toggles_title:before,.sc_toggles.sc_toggles_style_2 .sc_toggles_item.sc_active .sc_toggles_title,.sc_toggles.sc_toggles_style_2 .sc_toggles_item.sc_active .sc_toggles_title:before,.sc_toggles.sc_toggles_style_3 .sc_toggles_item.sc_active .sc_toggles_title,.sc_tabs .sc_tabs_titles li a:hover,.sc_dropcaps.sc_dropcaps_style_3 .sc_dropcap,.sc_dropcaps.sc_dropcaps_style_4 .sc_dropcap,.sc_dropcaps.sc_dropcaps_style_5 .sc_dropcap,.sc_dropcaps.sc_dropcaps_style_6 .sc_dropcap,.sc_highlight.sc_highlight_style_2,.sc_tooltip_parent,	.sc_title_icon_animated:hover .sc_title_icon.sc_bg_animated:hover:before,	a > .sc_title_icon.sc_bg_animated:hover:before,	.sc_scroll_controls .flex-direction-nav a:hover:before,.sc_testimonials_style_1 .flex-direction-nav a:hover:before,.sc_testimonials_style_3 .flex-direction-nav a:hover:before,.sc_testimonials_style_3 .flex-direction-nav a:active:before,.pagination .pageLibrary > li.libPage > .pageFocusBlock .flex-direction-nav a:hover:before, .topWrap .usermenu_area ul.usermenu_list li.usermenu_currency > a:hover,.topWrap .usermenu_area ul.usermenu_list li.usermenu_currency > a,.topWrap .usermenu_area ul.usermenu_list li.usermenu_currency.sfHover > a,.topWrap .usermenu_area ul.usermenu_list li ul li a:hover,.topWrap .usermenu_area ul.usermenu_list li.usermenu_cart .widget_area ul li a:hover,.sidemenu_wrap .usermenu_area ul.usermenu_list li.usermenu_currency > a:hover,.sidemenu_wrap .usermenu_area ul.usermenu_list li.usermenu_currency > a,.sidemenu_wrap .usermenu_area ul.usermenu_list li.usermenu_currency.sfHover > a,.sidemenu_wrap .usermenu_area ul.usermenu_list li ul li a:hover,	.sidemenu_wrap .usermenu_area ul.usermenu_list li.usermenu_cart .widget_area ul li a:hover, .sc_blogger a:hover,.sc_blogger.style_date .load_more:before,.sc_blogger.style_date .sc_blogger_item .sc_blogger_date .day_month,	.sc_blogger.style_date .sc_blogger_item .sc_blogger_info .comments_number,	.sc_blogger.style_accordion .sc_blogger_info .comments_number,	.widgetTabs .widgetTop ul > li:not(.tabs):before,	.widgetTabs .widgetTop ul > li:not(.tabs) > a:hover,.widgetTabs .widgetTop ul > li:not(.tabs) > a:hover span,	.widgetTabs .widgetTop.widget_popular_posts article .post_title:before,	.swpRightPos .tabsMenuBody a:hover,	.swpRightPos .tabsMenuBody a:hover:before,.openRightMenu:hover:before,.topWrap .search:not(.searchOpen):hover:before,	.user-popUp .formItems.loginFormBody .remember .forgotPwd,.user-popUp .formItems.loginFormBody .loginProblem,.user-popUp .formItems.registerFormBody .i-agree a,	.sc_slider_pagination_area .flex-control-nav.manual .slide_info .slide_title,		h1 > a, h2 > a, h4 > a, h5 > a, h6 > a,	.h1 > a, .h2 > a, .h4 > a, .h5 > a, .h6 > a,.relatedPostWrap article .relatedInfo a,.sc_list_style_iconed li:before,.sc_list_style_arrows li:before,.sc_team .sc_team_item .sc_team_item_title,.sc_team .sc_team_item .sc_team_item_title a,.footerStyleLight .footerWidget .widgetWrap .title,#sc_calendar thead th span,	.sc_calendar thead th span,#footerStyleLight .footerWidget .sc_calendar thead th,.footerStyleLight .footerWidget .sc_calendar thead th,#sc_calendar thead tr th,	.sc_calendar thead tr + tr th,.page404 .h2,.usermenu_area .sidemenu_button i,	.relatedPostWrap article .relatedInfo .separator,	.relatedPostWrap article .relatedInfo span.infoTags a,	.openResponsiveMenu:hover,	.sidemenu_wrap .sidemenu_area ul li ul li ul li a:hover,.sidebar > .widget > ul > li a:hover,.booking_weekdays_custom,.woocommerce div.product span.price, .woocommerce div.product p.price, .woocommerce #content div.product span.price, .woocommerce #content div.product p.price, .woocommerce-page div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page #content div.product p.price,	.topWrap .usermenu_area .phone_number,	.portfolioWrap .isotopeFiltr ul a:hover,.portfolioWrap .isotopeFiltr ul .active a,	.masonryWrap .isotopeFiltr ul a:hover,	.masonryWrap .isotopeFiltr ul .active a,h4 > a:hover,.portfolio .isotopeElement .folioShowBlock .folioContentAfter h4 a:hover, .topWrap .topMenuStyleLine > ul > li > a:hover, .topWrap .topMenuStyleLine > ul > li.highlight > a, .copyWrap a,.hover_red .sc_section:hover .sc_title_icon:before,'
			+ '.woocommerce input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page #content input.button:hover,	.woocommerce .quantity input[type="button"]:hover, .woocommerce #content input[type="button"]:hover, .woocommerce-page .quantity input[type="button"]:hover, .woocommerce-page #content .quantity input[type="button"]:hover,	.woocommerce a:hover h3, .woocommerce-page a:hover h3,.woocommerce .cart-collaterals .order-total strong, .woocommerce-page .cart-collaterals .order-total strong,.woocommerce .star-rating, .woocommerce-page .star-rating, .woocommerce .star-rating:before, .woocommerce-page .star-rating:before,.widget_area .widgetWrap ul > li .star-rating span, .woocommerce #review_form #respond .stars a, .woocommerce-page #review_form #respond .stars a,'
			+'.theme_accent2,.sc_team .sc_team_item .sc_team_item_position,	h3 > a, .h3 > a,.sc_blogger h3 > a, .sc_blogger .h3 > a,.openRightMenu:hover:before,.topWrap .search:not(.searchOpen):hover:before,.sliderHomeBullets.slider_alias_15 .order a:hover,.sc_blogger.style_date .sc_blogger_item .sc_blogger_info .post_author,	.sc_blogger.style_date .sc_blogger_item .sc_blogger_info .comments_number,#sc_calendar tbody td.today, #sc_calendar tbody td.today a,.sc_calendar tbody td.today,.sc_calendar tbody td.today a,ul > li.share > ul.shareDrop > li > a:hover, .footerStyleDark .footerWidget #sc_calendar thead th,	.footerStyleDark .footerWidget .sc_calendar thead th'
			+' { color: '+clr+'; }'

			+'#booking_slot_form > div > a:hover, a:hover > .sc_title_iconed,.topWrap .topMenuStyleLine > ul > li ul li a:hover,.footerStyleDark .widget_area a.button:hover,.flip-clock-wrapper ul li a div div.inn,.tabsButton ul li.ui-tabs-active a,.Axiom_message_info,.Axiom_message_info .Axiom_message_close,	.Axiom_message_info .Axiom_message_icon,.Axiom_message_info .Axiom_message_header,.woocommerce div.product span.price, .woocommerce div.product p.price, .woocommerce #content div.product span.price, .woocommerce #content div.product p.price, .woocommerce-page div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page #content div.product p.price,.booking_name_days_container .booking_day_name'
			+' { color: '+clr+' !important; }'

			+'.topWrap .topMenuStyleLine > ul > li.highlight > a:hover:after, .footerStyleDark .footerWidget #sc_calendar tbody td.today, .footerStyleDark .footerWidget .sc_calendar tbody td.today,#toc .toc_item,#toc .toc_item.current, #toc .toc_item:hover'
			+' { background-color: '+clr+'; }'

			+'.topWrap .topMenuStyleLine > ul > li.highlight > a'
			+' { border-color: '+clr+'; }';

		if (window.theme_skin_set_theme_color1)
			css_text = theme_skin_set_theme_color1(css_text, clr);

		// Theme (Accent) color 2
		clr = rgb2hex(jQuery('#co_theme_color2').css('backgroundColor'));
		rgb = hex2rgb(clr);

		css_text +=
			'.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .woocommerce-page .footerStyleDark ul.product_list_widget li > .amount,.woocommerce .footerStyleDark ul.product_list_widget li > .amount,.woocommerce ul.products li.product.product-category h3:hover,.woocommerce-page ul.products li.product.product-category h3:hover'
			+' { color: '+clr+' !important; }'

			+' .woocommerce .checkout #order_review .order-total .amount, .woocommerce-page .checkout #order_review .order-total .amount, .woocommerce ul.cart_list li > .amount, .woocommerce ul.product_list_widget li > .amount, .woocommerce-page ul.cart_list li > .amount, .woocommerce-page ul.product_list_widget li > .amount, .woocommerce ul.cart_list li span .amount, .woocommerce ul.product_list_widget li span .amount, .woocommerce-page ul.cart_list li span .amount, .woocommerce-page ul.product_list_widget li span .amount, .woocommerce ul.cart_list li ins .amount, .woocommerce ul.product_list_widget li ins .amount, .woocommerce-page ul.cart_list li ins .amount, .woocommerce-page ul.product_list_widget li ins .amount, .woocommerce.widget_shopping_cart .total .amount, .woocommerce .widget_shopping_cart .total .amount, .woocommerce-page.widget_shopping_cart .total .amount, .woocommerce-page .widget_shopping_cart .total .amount, .topWrap .topMenuStyleLine > ul > li.current-menu-ancestor > a'
			+' { color: '+clr+'; }'

			+'.topWrap .topMenuStyleLine > ul > li.highlight > a:hover:after'
			+' { background-color: '+clr+'; }';

		if (window.theme_skin_set_theme_color2)
			css_text = theme_skin_set_theme_color2(css_text, clr);


		// Apply styles
		styles.html(css_text);
	}
}


// Add skin custom colors in custom styles
function theme_skin_set_theme_color(custom_style, clr) {
	custom_style += 'h1, h2, h4, h5, h6,.h1, .h2, .h4, .h5, .h6,h1 > a, h2 > a, h4 > a, h5 > a, h6 > a,.h1 > a, .h2 > a, .h4 > a, .h5 > a, .h6 > a,.sc_blogger a,.relatedPostWrap article .relatedInfo a,.sc_list_style_iconed li:before,.sc_list_style_arrows li:before,.sc_team .sc_team_item .sc_team_item_title,.footerStyleLight .footerWidget .widgetWrap .title,.sc_calendar thead th span,.footerStyleLight .footerWidget .sc_calendar thead th,.sc_calendar thead tr + tr th'
+'{ color:'+clr+'; }'
+'.tabsButton ul li.ui-tabs-active a'
+'{ color:'+clr+' !important; }'
+'.sc_video_player:hover .sc_video_play_button:after,.footerStyleLight .footerWidget .sc_video_player:hover .sc_video_play_button:after,.copyWrap,.sliderHomeBullets.slider_alias_13 .textPrice,.sliderHomeBullets.slider_alias_13 .slide-2 .textPrice,.videoBackgroundOverlay .copyWrap'
+'{ background-color:'+clr+'; }';
	return custom_style;
}

// Add skin's main menu (top panel) back color in the custom styles
function theme_skin_set_menu_bgcolor(custom_style, clr) {
	rgb = hex2rgb(clr);
	custom_style += 'h3, .h3, h3 > a, .h3 > a,.sc_blogger h3 > a, .sc_blogger .h3 > a,.openRightMenu:hover:before,.topWrap .search:not(.searchOpen):hover:before,.sliderHomeBullets.slider_alias_15 .order a:hover,.sc_blogger.style_date .sc_blogger_item .sc_blogger_info .post_author,.sc_blogger.style_date .sc_blogger_item .sc_blogger_info .comments_number,.sc_calendar tbody td.today,.sc_calendar tbody td.today a'
+'{ color:'+clr+'; }'
+'.topWrap .topMenuStyleLine > ul > li ul li a:hover,.topWrap .topMenuStyleLine > ul > li ul li a:hover .menu_item_description'
+'{ color:'+clr+' !important; }'
+'.topWrap,.topWrap .topMenuStyleLine > ul > li ul,.sliderHomeBullets.slider_alias_15 .order a,.dark .sc_slider_pagination_area .flex-control-nav.manual li.active .slide_date,.dark .sc_slider_pagination_area .flex-control-nav.manual li.cs-active-pagination .slide_date,.dark .sc_slider_pagination_area .flex-control-nav.manual li:hover .slide_date,.sc_blogger.style_date .sc_blogger_item .sc_blogger_date,.sc_video_player .sc_video_play_button:after,.footerStyleLight .footerWidget .sc_video_player .sc_video_play_button:after,.twitBlock,.twitBlockWrap,.sliderHomeBullets.slider_alias_13 .order a:hover, .sc_skills_bar .sc_skills_item .sc_skills_count'
+'{ background-color:'+clr+'; }'
+'.twitBlock .sc_slider .flex-direction-nav li'
+'{ background-color:'+clr+' !important; }'
+'.topWrap .topMenuStyleLine > ul > li ul,.sliderHomeBullets.slider_alias_13 .order a:hover'
+'{ border-color:'+clr+'; }'
+'.topWrap .openRightMenu:hover,.topWrap .search:not(.searchOpen):hover'
+'{ border-color: rgba('+rgb.r+','+rgb.g+','+rgb.b+',0.4);}';
+'.top_panel_above .fullScreenSlider .topWrap,.top_panel_above .fullScreenSlider .topWrap .topMenuStyleLine > ul > li ul,.top_panel_above .fullScreenSlider .topWrap .topMenuStyleLine > ul > li .menu-panel'
+'{ background-color: rgba('+rgb.r+','+rgb.g+','+rgb.b+',0.8);}';
	return custom_style;
}

// Add skin's main menu (top panel) fore colors in the custom styles
function theme_skin_set_menu_color(custom_style, clr) {
	custom_style += '.openRightMenu,.topWrap .search'
+' { border-color:transparent; }';
	return custom_style;
}

// Add skin's user menu (user panel) back color in the custom styles
function theme_skin_set_user_menu_bgcolor(custom_style, clr) {
	return custom_style;
}

// Add skin's user menu (user panel) fore colors in the custom styles
function theme_skin_set_user_menu_color(custom_style, clr) {
	return custom_style;
}
	
