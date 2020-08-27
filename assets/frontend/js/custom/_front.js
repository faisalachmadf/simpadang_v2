/* global jQuery:false */
// Javascript String constants for translation
var Axiom_MESSAGE_BOOKMARK_ADD   = "Add the bookmark";
var Axiom_MESSAGE_BOOKMARK_ADDED = "Current page has been successfully added to the bookmarks. You can see it in the right panel on the tab \'Bookmarks\'";
var Axiom_MESSAGE_BOOKMARK_TITLE = "Enter bookmark title";
var Axiom_MESSAGE_BOOKMARK_EXISTS= "Current page already exists in the bookmarks list";
var Axiom_MESSAGE_SEARCH_ERROR = "Error occurs in AJAX search! Please, type your query and press search icon for the traditional search way.";
var Axiom_MESSAGE_EMAIL_CONFIRM= "On the e-mail address <b>%s</b> we sent a confirmation email.<br>Please, open it and click on the link.";
var Axiom_MESSAGE_EMAIL_ADDED  = "Your address <b>%s</b> has been successfully added to the subscription list";
var Axiom_REVIEWS_VOTE		  = "Thanks for your vote! New average rating is:";
var Axiom_REVIEWS_ERROR		  = "Error saving your vote! Please, try again later.";
var Axiom_MAGNIFIC_LOADING     = "Loading image #%curr% ...";
var Axiom_MAGNIFIC_ERROR       = "<a href=\"%url%\">The image #%curr%</a> could not be loaded.";
var Axiom_MESSAGE_ERROR_LIKE   = "Error saving your like! Please, try again later.";
var Axiom_GLOBAL_ERROR_TEXT	  = "Global error text";
var Axiom_NAME_EMPTY			  = "The name can\'t be empty";
var Axiom_NAME_LONG 			  = "Too long name";
var Axiom_EMAIL_EMPTY 		  = "Too short (or empty) email address";
var Axiom_EMAIL_LONG			  = "Too long email address";
var Axiom_EMAIL_NOT_VALID 	  = "Invalid email address";
var Axiom_SUBJECT_EMPTY		  = "The subject can\'t be empty";
var Axiom_SUBJECT_LONG 		  = "Too long subject";
var Axiom_PHONE_EMPTY		  = "Phone number too short";
var Axiom_PHONE_LONG 		  = "Phone number too long";
var Axiom_PHONE_NOT_VALID 	  = "Invalid phone";
var Axiom_MESSAGE_EMPTY 		  = "The message text can\'t be empty";
var Axiom_MESSAGE_LONG 		  = "Too long message text";
var Axiom_SEND_COMPLETE 		  = "Send message complete!";
var Axiom_SEND_ERROR 		  = "Transmit failed!";
var Axiom_LOGIN_EMPTY		  = "The Login field can\'t be empty";
var Axiom_LOGIN_LONG			  = "Too long login field";
var Axiom_PASSWORD_EMPTY		  = "The password can\'t be empty and shorter then 5 characters";
var Axiom_PASSWORD_LONG		  = "Too long password";
var Axiom_PASSWORD_NOT_EQUAL   = "The passwords in both fields are not equal";
var Axiom_REGISTRATION_SUCCESS = "Registration success! Please log in!";
var Axiom_REGISTRATION_FAILED  = "Registration failed!";
var Axiom_REGISTRATION_AUTHOR  = "Your account is waiting for the site admin moderation!";
var Axiom_GEOCODE_ERROR 		  = "Geocode was not successful for the following reason:";
var Axiom_GOOGLE_MAP_NOT_AVAIL = "Google map API not available!";



// AJAX parameters
var Axiom_ajax_url = "";
var Axiom_ajax_nonce = "a695bb5b28";

// Site base url
var Axiom_site_url = "/";

// Theme base font
var Axiom_theme_font = "";

// Theme skin
var Axiom_theme_skin = "default";
var Axiom_theme_skin_bg = "#ffffff";

// Slider height
var Axiom_slider_height = 500;

// Css Animation
var Axiom_css_animation      = true;

// Sound Manager
var Axiom_sound_enable    = false;
var Axiom_sound_folder    = '/';
var Axiom_sound_mainmenu  = '/';
var Axiom_sound_othermenu = '/';
var Axiom_sound_buttons   = '/';
var Axiom_sound_links     = '/';
var Axiom_sound_state     = { 
	all: Axiom_sound_enable ? 1 : 0, 
	mainmenu:	0,
	othermenu:	0,
	buttons:	0,
	links: 		0};

// System message
var Axiom_systemMessage = {message:"", status: "", header: ""};

// User logged in
var Axiom_userLoggedIn = false;

// Show table of content for the current page
var Axiom_menu_toc = 'no';
var Axiom_menu_toc_home = Axiom_menu_toc!='no' && true;
var Axiom_menu_toc_top = Axiom_menu_toc!='no' && true;

// Fix main menu
var Axiom_menuFixed = true;

// Use responsive version for main menu
var Axiom_menuResponsive = 1024;
var Axiom_responsive_menu_click = true;

// Right panel demo timer
var Axiom_demo_time = 4000;

// Video and Audio tag wrapper
var Axiom_useMediaElement = true;

// Use AJAX search
var Axiom_useAJAXSearch = true;
var Axiom_AJAXSearch_min_length = 3;
var Axiom_AJAXSearch_delay = 200;

// Popup windows engine
var Axiom_popupEngine  = 'pretty';
var Axiom_popupGallery = true;

// E-mail mask
var Axiom_EMAIL_MASK = '^([a-zA-Z0-9_\\-]+\\.)*[a-zA-Z0-9_\\-]+@[a-z0-9_\\-]+(\\.[a-z0-9_\\-]+)*\\.[a-z]{2,6}$';

// Phone mask
var Axiom_PHONE_MASK = '^[0-9]{5,15}';

// Messages max length
var Axiom_msg_maxlength_contacts = 1000;
var Axiom_msg_maxlength_comments = 1000;

// Remember visitors settings
var Axiom_remember_visitors_settings = true;

// Form validate
var Axiom_validateForm = null;

// VC frontend edit mode
var Axiom_vc_edit_mode = false;

if (Axiom_theme_font=='') Axiom_theme_font = 'Sintony';


if (jQuery('body.toc_show').length > 0) {
	// Show table of content for the current page
	var Axiom_menu_toc = 'fixed';
	var Axiom_menu_toc_home = Axiom_menu_toc!='no' && true;
	var Axiom_menu_toc_top = Axiom_menu_toc!='no' && true;
}

// Max scale factor for the portfolio and other isotope elements before relayout
var Axiom_isotope_resize_delta = 0.3;


// Internal vars - do not change it!
var Axiom_ADMIN_MODE    = false;
var Axiom_error_msg_box = null;
var Axiom_VIEWMORE_BUSY = false;
var Axiom_video_resize_inited = false;
var Axiom_top_height = 0;
var Axiom_top_height_usermenu_area = 0;
var Axiom_use_fixed_wrapper = true;
var Axiom_theme_init_counter = 0;

jQuery(document).ready(function () {
	"use strict";
	Axiom_init_actions();
	custom_menu();
	Axiom_message_init();
});

function Axiom_init_actions() {
	"use strict";

	if (Axiom_vc_edit_mode && jQuery('.vc_empty-placeholder').length==0 && Axiom_theme_init_counter++ < 30) {
		setTimeout(Axiom_init_actions, 200);
		return;
	}

		timelineResponsive();
		ready();
		timelineScrollFix();
		itemPageFull();
		mainMenuResponsive();
		scrollAction();
		calcMenuColumnsWidth();
		resizeVideoBackground();
		REX_parallax();
		InitPopupMenu();
		smLeftPos();
		InfoTopOffset();
		contactform3Width();

	// Resize handlers
	jQuery(window).resize(function () {
		"use strict";
		timelineResponsive();
		fullSlider();
		resizeSliders();
		itemPageFull();
		mainMenuResponsive();
		scrollAction();
		resizeVideoBackground();
		REX_parallax();
		InitPopupMenu();
		smLeftPos();
		maxHeightSidemenuUL();
		initIsotope();
		InfoTopOffset();
		contactform3Width();
	});

	// Scroll handlers
	jQuery(window).scroll(function () {
		"use strict";
		timelineScrollFix();
		scrollAction();
		REX_parallax();
	});
};


function custom_menu() {

	jQuery(window).resize(function () {
		SubMenuLeftOffset();
	});

	var Axiom_custom_menu_placeholder = '';
	var Axiom_custom_menu_holderItem = '';
	jQuery('.menu-panel ul.sub-menu li a').hover(
		function(){
			if (!jQuery(this).parents('.menu-panel').hasClass('columns')) {
				var title = jQuery(this).data('title'),
					href = jQuery(this).data('link'),
					thumb = jQuery(this).data('thumb'),
					author = jQuery(this).data('author'),
					pubdate = jQuery(this).data('pubdate'),
					comments = jQuery(this).data('comments'),
					holderParent = jQuery(this).parents('ul').next();
				if (holderParent) {
					Axiom_custom_menu_placeholder = holderParent.html();
					Axiom_custom_menu_holderItem  = holderParent;
					holderParent.find('img').attr('src', thumb);
					holderParent.find('.item_title a').text(title).attr('href', href);
					holderParent.find('.item_pubdate em').text(pubdate);
					holderParent.find('.item_comments em').text(comments);
					holderParent.find('.item_author em').text(author);
				}
			}
		},
		function() {

		}
	);

	SubMenuLeftOffset();
}

function parentCheck(th, divName) {
	thType = th.get(0).tagName.toLowerCase();
	if (divName != '' && thType == 'li') {
		if (th.find(divName).length > 0) {
			return th.find(divName);
		} else {
			return parentCheck(th.parent().parent(), divName);
		}
	}
}

/* Find sub-menu left offset and move it left on 'offest'px*/
function SubMenuLeftOffset(){
	if (jQuery('#mainmenu').length > 0) {

		if (jQuery('body').hasClass('responsive_menu')) {
			return;
		}

		var th = jQuery('#mainmenu').find('li.custom_view_item');
		if ( th.length == 0 ) return;

		if (th.offset().left == 0) {
			setTimeout(function() {
				SubMenuLeftOffset();
			},500);
			return;
		} else if (th.offset().left != 0) {
			var panel = th.find('.menu-panel');
			var mainW = jQuery('.main').width();
			var contOffset = (jQuery(window).width() - mainW) / 2;
			var submenuOffset;
			var smLeft;
			panel.css('width', mainW + 100);
			panel.find('ul.columns').css('max-width', mainW + 100);
			th.each(function(){
				submenuOffset = jQuery(this).offset().left;
				smLeft = Math.abs(contOffset - submenuOffset - 50);
				panel = jQuery(this).find('.menu-panel');
				panel.css('left', '-' + smLeft.toString() + 'px');
			});

		}
	}
}

function ready() {
	"use strict";

	// Show system message
	if (Axiom_systemMessage.message) {
		if (Axiom_systemMessage.status == 'success')
			Axiom_message_success(Axiom_systemMessage.message, Axiom_systemMessage.header);
		else if (Axiom_systemMessage.status == 'info')
			Axiom_message_info(Axiom_systemMessage.message, Axiom_systemMessage.header);
		else if (Axiom_systemMessage.status == 'error' || Axiom_systemMessage.status == 'warning')
			Axiom_message_warning(Axiom_systemMessage.message, Axiom_systemMessage.header);
	}
	
	// Top menu height
	Axiom_top_height = jQuery('header .topWrap').height();
	Axiom_top_height_usermenu_area = jQuery('header .topWrap .usermenu_area').height();
	jQuery('.topWrapFixed').css('backgroundColor', jQuery('.topWrap').css('backgroundColor'));
	Axiom_use_fixed_wrapper = jQuery('.topWrapFixed').parents('.fullScreenSlider').length == 0 || !jQuery('.topWrapFixed').parent().next().hasClass('sliderHomeBullets');
	
	// Close all dropdown elements
	jQuery(document).click(function (e) {
		"use strict";
		jQuery('.pageFocusBlock').slideUp();
		jQuery('.inputSubmitAnimation:not(.opened)').removeClass('sFocus rad4').addClass('radCircle', 100);
		jQuery('ul.shareDrop').slideUp().siblings('a.shareDrop').removeClass('selected');
	});

	// Calendar handlers - change months
	jQuery('.widget_calendar').on('click', '.prevMonth a, .nextMonth a', function(e) {
		"use strict";
		var calendar = jQuery(this).parents('.wp-calendar');
		var m = jQuery(this).data('month');
		var y = jQuery(this).data('year');
		var pt = jQuery(this).data('type');
		jQuery.post(Axiom_ajax_url, {
			action: 'calendar_change_month',
			nonce: Axiom_ajax_nonce,
			month: m,
			year: y,
			post_type: pt
		}).done(function(response) {
			var rez = JSON.parse(response);
			if (rez.error === '') {
				calendar.parent().fadeOut(200, function() {
					jQuery(this).empty().append(rez.data).fadeIn(200);
				});
			}
		});
		e.preventDefault();
		return false;
	});

	// Tabs for top widgets
	if (jQuery('.widgetTabs').length > 0) {

		// Collect widget's headers into tabs
		var Axiom_top_tabs = '';
		var Axiom_top_tabs_counter = 0;
		jQuery('.widgetTop .titleHide').each(function () {
			"use strict";
			Axiom_top_tabs_counter++;
			var id = jQuery(this).parents('.widgetTop').attr('id');
			var title = jQuery(this).text();
			if (title=='') title = '#'+Axiom_top_tabs_counter;
			Axiom_top_tabs += '<li><a href="#'+id+'"><span>'+title+'</span></a></li>';
		});
		jQuery('.widgetTabs .tabsButton ul').append(Axiom_top_tabs);
	
		// Break lists in top widgets on two parts
		jQuery('.widgetTop > ul:not(.tabs),.widgetTop > div > ul:not(.tabs)').each(function () {
			"use strict";
			var ul2 = jQuery(this).clone();
			var li = jQuery(this).find('>li');
			var middle = Math.ceil(li.length/2)-1;
			li.eq(middle).nextAll().remove();
			ul2.find('>li').eq(middle+1).prevAll().remove();
			jQuery(this).after(ul2);
		});
		
		// Init tabs
		jQuery('.widgetTabs').tabs({
			show: {
				effect: 'drop',
				direction: 'right',
				duration: 500
			},
			hide: {
				effect: 'drop',
				direction: 'left',
				duration: 500
			},
			activate: function (event, ui) {
				"use strict";
				initShortcodes(ui.newPanel);
			}
		});
	}

	// Add bookmarks
	if (jQuery('#tabsFavorite').length > 0) {
		jQuery('.addBookmark').click(function(e) {
			"use strict";
			var title = window.document.title.split('|')[0];
			var url = window.location.href;
			var list = jQuery.cookie('Axiom_bookmarks');
			var exists = false;
			if (list) {
				list = JSON.parse(list);
				for (var i=0; i<list.length; i++) {
					if (list[i].url == url) {
						exists = true;
						break;
					}
				}
			} else
				list = new Array();
			if (!exists) {
				var Axiom_message_popup = Axiom_message_dialog('<label for="bookmark_title">'+Axiom_MESSAGE_BOOKMARK_TITLE+'</label><br><input type="text" id="bookmark_title" name="bookmark_title" value="'+title+'">', Axiom_MESSAGE_BOOKMARK_ADD, null,
					function(btn, popup) {
						"use strict";
						if (btn != 1) return;
						title = Axiom_message_popup.find('#bookmark_title').val();
						list.push({title: title, url: url});
						jQuery('.listBookmarks').append('<li><a href="'+url+'">'+title+'</a><a href="#" class="delBookmark icon-cancel"></a></li>');
						jQuery.cookie('Axiom_bookmarks', JSON.stringify(list), {expires: 365, path: '/'});
						if (Axiom_Swipers['bookmarks_scroll']!==undefined) Axiom_Swipers['bookmarks_scroll'].reInit();
						setTimeout(function () {Axiom_message_success(Axiom_MESSAGE_BOOKMARK_ADDED, Axiom_MESSAGE_BOOKMARK_ADD);}, Axiom_MESSAGE_TIMEOUT/4);
					});
			} else
				Axiom_message_warning(Axiom_MESSAGE_BOOKMARK_EXISTS, Axiom_MESSAGE_BOOKMARK_ADD);
			e.preventDefault();
			return false;
		});
		// Delete bookmarks
		jQuery('.listBookmarks').on('click', '.delBookmark', function(e) {
			"use strict";
			var idx = jQuery(this).parent().index();
			var list = jQuery.cookie('Axiom_bookmarks');
			if (list) {
				list = JSON.parse(list);
				list.splice(idx, 1);
				jQuery.cookie('Axiom_bookmarks', JSON.stringify(list), {expires: 365, path: '/'});
			}
			jQuery(this).parent().remove();
			e.preventDefault();
			return false;
		});
		// Sort bookmarks
		jQuery('.listBookmarks').sortable({
			items: "li",
			update: function(event, ui) {
				"use strict";
				var list = new Array();
				ui.item.parent().find('li').each(function() {
					var a = jQuery(this).find('a:not(.delBookmark)').eq(0);
					list.push({title: a.text(), url: a.attr('href')});
				});
				jQuery.cookie('Axiom_bookmarks', JSON.stringify(list), {expires: 365, path: '/'});
			}
		}).disableSelection();
	}


	// Scroll to top
	jQuery('.upToScroll .scrollToTop').click(function(e) {
		"use strict";
		jQuery('html,body').animate({
			scrollTop: 0
		}, 'slow');
		e.preventDefault();
		return false;
	});


	// Decorate nested lists in widgets and sidemenu
	jQuery('.widgetWrap ul > li,.panelmenu_area ul > li,.widgetTop ul > li').each(function () {
		if (jQuery(this).find('ul').length > 0) {
			jQuery(this).addClass('dropMenu');
		}
	});
	jQuery('.widgetWrap ul > li.dropMenu,.panelmenu_area ul > li.dropMenu,.widgetTop ul > li.dropMenu').click(function (e) {
		"use strict";
		jQuery(this).toggleClass('dropOpen');
		jQuery(this).find('ul').first().slideToggle(200, function() {
			if (jQuery(this).parents('.sidemenu_area').length > 0) {
				Axiom_Swipers['sidemenu_scroll'].reInit();
			}
			else if (jQuery(this).parents('.panelmenu_area').length > 0)
				Axiom_Swipers['panelmenu_scroll'].reInit();
		});
		e.preventDefault();
		return false;
	});
	jQuery('.widgetWrap ul:not(.tabs) li > a,.sidemenu_area ul:not(.tabs) li > a,.panelmenu_area ul:not(.tabs) li > a,.widgetTop ul:not(.tabs) li > a').click(function (e) {
		"use strict";
		if (jQuery(this).attr('href')!='#') {
			e.stopImmediatePropagation();
			if (jQuery(this).parent().hasClass('menu-item-has-children') && jQuery(this).parents('.sidemenu_area,.panelmenu_area').length > 0) {
				jQuery(this).parent().trigger('click');
				e.preventDefault();
				return false;
			}
		}
	});


	// Archive widget decoration
	jQuery('.widget_archive a').each(function () {
		var val = jQuery(this).html().split(' ');
		if (val.length > 1) {
			val[val.length-1] = '<span>' + val[val.length-1] + '</span>';
			jQuery(this).html(val.join(' '))
		}
	});

	//video bg
	if (jQuery('.videoBackground').length > 0) {
		jQuery('.videoBackground').each(function () {
			var youtube = jQuery(this).data('youtube-code');
			if (youtube) {
				jQuery(this).tubular({videoId: youtube});
			}
		});
	}
	
	//isotope
	if (jQuery('.isotopeNOanim,.isotope').length > 0) {

		initIsotope();

		try {
			jQuery(window).smartresize(resizeIsotope);
		} catch (e) {
			jQuery(window).resize(resizeIsotope);
		}

		//isotope filter
		jQuery('.isotopeFiltr').on('click', 'li a', function (e) {
			"use strict";
			jQuery(this).parents('.isotopeFiltr').find('li').removeClass('active');
			jQuery(this).parent().addClass('active');
	
			var selector = jQuery(this).data('filter');
			jQuery(this).parents('.isotopeFiltr').siblings('.isotope').eq(0).isotope({
				filter: selector
			});
			
			if (selector == '*')
				jQuery('#viewmore_link').fadeIn();
			else
				jQuery('#viewmore_link').fadeOut();

			e.preventDefault();
			return false;
		});

	}

	// main Slider
	if (jQuery('.sliderBullets, .sliderHomeBullets').length > 0) {
		if (jQuery.rsCSS3Easing!=undefined && jQuery.rsCSS3Easing!=null) {
			jQuery.rsCSS3Easing.easeOutBack = 'cubic-bezier(0.175, 0.885, 0.320, 1.275)';
		}
		// Show Slider
		jQuery('.sliderHomeBullets').slideDown(200, function () {
			"use strict";
			REX_parallax();
			fullSlider();
			initShortcodes(jQuery(this));
			// Hack for the Royal Slider
			if (jQuery('body').hasClass('boxed')) { jQuery(this).trigger('resize'); }
		});
	}

	// Page Navigation
	jQuery('.pageFocusBlock').click(function (e) {
		"use strict";
		if (e.target.nodeName.toUpperCase()!='A') {
			e.preventDefault();
			return false;
		}
	});
	jQuery('.navInput').click(function (e) {
		"use strict";
		jQuery('.pageFocusBlock').slideDown(300, function () {
			initShortcodes(jQuery('.pageFocusBlock').eq(0));
		});
		e.preventDefault();
		return false;
	});


	// Responsive Show menu
	jQuery('.openResponsiveMenu').click(function(e){
		"use strict";
		jQuery('.menuTopWrap').slideToggle()
		e.preventDefault();
		return false;
	});


	// Main Menu
	initSfMenu('.menuTopWrap > ul#mainmenu, .usermenu_area ul.usermenu_list');
	// Enable click on root menu items (without submenu) in iOS
	if (isiOS()) {
		jQuery('#mainmenu li:not(.menu-item-has-children) > a').on('click touchend', function (e) {
			"use strict";
			if (jQuery(this).attr('href')!='#') {
				window.location.href = jQuery(this).attr('href');
			}
		});
		jQuery('#mainmenu li.menu-item-has-children > a').hover(
			function (e) {
				"use strict";
				if (jQuery('body').hasClass('responsive_menu')) {
					jQuery(this).trigger('click');
				}
			},
			function () {}
			);
	}
	// Submenu click handler
	jQuery('.menuTopWrap ul li a, .usermenu_area ul.usermenu_list li a').click(function(e) {
		"use strict";
		if ((Axiom_responsive_menu_click || isMobile()) && jQuery('body').hasClass('responsive_menu') && jQuery(this).parent().hasClass('menu-item-has-children')) {
			if (jQuery(this).siblings('ul:visible').length > 0)
				jQuery(this).siblings('ul').slideUp();
			else
				jQuery(this).siblings('ul').slideDown();
		}
		if (jQuery(this).attr('href')=='#' || (jQuery('body').hasClass('responsive_menu') && jQuery(this).parent().hasClass('menu-item-has-children'))) {
			e.preventDefault();
			return false;
		}
	});
	
	// Show table of contents for the current page
	if (Axiom_menu_toc!='no') {
		buildPageTOC();
	}
	// One page mode for menu links (scroll to anchor)
	jQuery('#toc, .menuTopWrap ul li, .usermenu_area ul.usermenu_list li').on('click', 'a', function(e) {
		"use strict";
		var href = jQuery(this).attr('href');
		var pos = href.indexOf('#');
		if (pos < 0 || href.length == 1) return;
		var loc = window.location.href;
		var pos2 = loc.indexOf('#');
		if (pos2 > 0) loc = loc.substring(0, pos2);
		var now = pos==0;
		if (!now) now = loc == href.substring(0, pos);
		if (now) {
			animateTo(href.substr(pos));
			setLocation(pos==0 ? loc + href : href);
			e.preventDefault();
			return false;
		}
	});

	// Open sidemenu
	jQuery('.sidemenu_button, #sidemenu_button').click(function (e) {
		"use strict";
		jQuery('body').addClass('openMenuFix');

		if (jQuery(this).length > 0) Axiom_Swipers['sidemenu_scroll'].reInit();

		setTimeout(function(){},200);

		maxHeightSidemenuUL();

		e.preventDefault();
		return false;
	});

	// Close sidemenu and right panel
	jQuery(document).on('click', '.sidemenu_overflow', function (e) {
		"use strict";
		jQuery('body').removeClass('openMenuFixRight openMenuFix');
		if (!isMobile()) jQuery('.swpRightPosButton').fadeIn(400);
		jQuery('.sidemenu_overflow').fadeOut(400);
	});

	jQuery(document).on('click', '.sidemenu_close', function (e) {
		"use strict";
		jQuery('body').removeClass('openMenuFix');
	});

	// Open right menu
	jQuery('.openRightMenu,.swpRightPosButton').click(function (e) {
		"use strict";
		if (jQuery('body').hasClass('openMenuFixRight')) {
			jQuery('body').removeClass('openMenuFixRight');
			if (!isMobile()) jQuery('.swpRightPosButton').fadeIn(400);
			jQuery('.sidemenu_overflow').fadeOut(400);
		} else {
			jQuery('body').addClass('openMenuFixRight');
			if (jQuery('.sidemenu_overflow').length == 0) {
				jQuery('body').append('<div class="sidemenu_overflow"></div>')
			}
			if (!isMobile()) jQuery('.swpRightPosButton').fadeOut(400);
			jQuery('.sidemenu_overflow').fadeIn(400);
		}
		e.preventDefault();
		return false;
	});

	// Demo right panel
	var showed = false;
	if (!showed && Axiom_demo_time > 0 && jQuery(window).width() > 800 && jQuery('.openRightMenu,.swpRightPosButton').length > 0) {
		showed = jQuery.cookie('Axiom_demo_rightpanel');
		if (!showed) {
			var btn = '';
			if (jQuery('.openRightMenu').length > 0)
				btn = '.openRightMenu';
			else if (jQuery('.swpRightPosButton').length > 0)
				btn = '.swpRightPosButton';
			if (btn) {
				jQuery.cookie('Axiom_demo_rightpanel', "1", {expires: 7, path: '/'});
				setTimeout(function () {
					jQuery(btn).trigger('click');
					setTimeout(function() { jQuery('.sidemenu_overflow').trigger('click'); }, Axiom_demo_time);
				}, Axiom_demo_time);
			}

			jQuery('body').removeClass('openMenuFixRight openMenuFix');
			if (!isMobile()) jQuery('.swpRightPosButton').fadeIn(400);
			jQuery('.sidemenu_overflow').fadeOut(400);
		}
	}


	// search
	jQuery('.topWrap .search').click(function (e) {
		"use strict";
		if (jQuery(this).hasClass('searchOpen')) {
			if (e.target.nodeName.toUpperCase()!='INPUT' && e.target.nodeName.toUpperCase()!='A') {
				jQuery('.topWrap .search .searchForm').animate({'width': 'hide'}, 200);
				jQuery('.topWrap .ajaxSearchResults').fadeOut();
				setTimeout(function() {
					jQuery('header').removeClass('topSearchShow');
				},250);
				jQuery('.topWrap .search').removeClass('searchOpen');
				e.preventDefault();
				return false;
			}
		} else {
			jQuery(this).find('.searchForm').animate({'width': 'show'}, 200);
			jQuery('header').delay(200).addClass('topSearchShow')
			jQuery(this).delay(200).toggleClass('searchOpen');
			e.preventDefault();
			return false;
		}
	});
	jQuery('.topWrap .search').on('click', '.searchSubmit,.post_more', function (e) {
		"use strict";
		if (jQuery('.topWrap .searchField').val() != '')
			jQuery('.topWrap .searchForm form').get(0).submit();
		e.preventDefault();
		return false;
	});
	jQuery('.search-form').on('click', '.search-button a', function (e) {
		"use strict";
		if (jQuery(this).parents('.search-form').find('input[name="s"]').val() != '')
			jQuery(this).parents('.search-form').get(0).submit();
		e.preventDefault();
		return false;
	});
	// AJAX search
	/*if (Axiom_useAJAXSearch) {
		var Axiom_ajax_timer = null;
		jQuery('.topWrap .searchField').keyup(function (e) {
			"use strict";
			var s = jQuery(this).val();
			if (Axiom_ajax_timer) {
				clearTimeout(Axiom_ajax_timer);
				Axiom_ajax_timer = null;
			}
			if (s.length >= Axiom_AJAXSearch_min_length) {
				Axiom_ajax_timer = setTimeout(function () {
					jQuery.post(Axiom_ajax_url, {
						action: 'ajax_search',
						nonce: Axiom_ajax_nonce,
						text: s
					}).done(function(response) {
						clearTimeout(Axiom_ajax_timer);
						Axiom_ajax_timer = null;
						var rez = JSON.parse(response);
						if (rez.error === '') {
							jQuery('.topWrap .ajaxSearchResults').empty().append(rez.data).fadeIn();
						} else {
							Axiom_message_warning(Axiom_MESSAGE_SEARCH_ERROR);
						}
					});
				}, Axiom_AJAXSearch_delay);
			}
		});
	}*/

	// search 404
	jQuery('.inputSubmitAnimation').click(function (e) {
		"use strict";
		e.preventDefault();
		return false;
	});
	jQuery('.inputSubmitAnimation a').click(function (e) {
		"use strict";
		var form = jQuery(this).siblings('form');
		var parent = jQuery(this).parents('.inputSubmitAnimation');
		if (parent.hasClass('sFocus')) {
			if (form.length>0 && form.find('input').val()!='') {
				if (jQuery(this).hasClass('sc_emailer_button')) {
					var group = jQuery(this).data('group');
					var email = form.find('input').val();
					var regexp = new RegExp(Axiom_EMAIL_MASK);
					if (!regexp.test(email)) {
						form.find('input').get(0).focus();
						Axiom_message_warning(Axiom_EMAIL_NOT_VALID);
					} else {
						jQuery.post(Axiom_ajax_url, {
							action: 'emailer_submit',
							nonce: Axiom_ajax_nonce,
							group: group,
							email: email
						}).done(function(response) {
							var rez = JSON.parse(response);
							if (rez.error === '') {
								Axiom_message_info(Axiom_MESSAGE_EMAIL_CONFIRM.replace('%s', email));
								form.find('input').val('');
							} else {
								Axiom_message_warning(rez.error);
							}
						});
					}
				} else
					form.get(0).submit();
			} else
				jQuery(document).trigger('click');
		} else {
			parent.addClass('sFocus rad4').removeClass('radCircle');
		}
		e.preventDefault();
		return false;
	});

	//Portfolio item Description
	if (isMobile()) {	// if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
		jQuery('.toggleButton').show();
		jQuery('.itemDescriptionWrap,.toggleButton').click(function (e) {
			"use strict";
			jQuery(this).toggleClass('descriptionShow');
			jQuery(this).find('.toggleDescription').slideToggle();
			e.preventDefault();
			return false;
		});
	} else {
		jQuery('.itemDescriptionWrap').hover(function () {
			"use strict";
			jQuery(this).toggleClass('descriptionShow');
			jQuery(this).find('.toggleDescription').slideToggle();
		});
	}

	// Save placeholder for input fields
	jQuery('.formList input[type="text"], .formList input[type="password"]')
		.focus(function () {
			"use strict";
			jQuery(this).attr('data-placeholder', jQuery(this).attr('placeholder')).attr('placeholder', '')
			jQuery(this).parent('li').addClass('iconFocus');
		})
		.blur(function () {
			"use strict";
			jQuery(this).attr('placeholder', jQuery(this).attr('data-placeholder'))
			jQuery(this).parent('li').removeClass('iconFocus');
		});

	// Hide empty pagination
	if (jQuery('#nav_pages > ul > li').length < 3) {
		jQuery('#nav_pages').remove();
	} else {
		jQuery('.theme_paginaton a').addClass('theme_button');
	}

	// View More button
	jQuery('#viewmore_link').click(function(e) {
		"use strict";
		if (!Axiom_VIEWMORE_BUSY) {
			jQuery(this).addClass('loading');
			Axiom_VIEWMORE_BUSY = true;
			jQuery.post(Axiom_ajax_url, {
				action: 'view_more_posts',
				nonce: Axiom_ajax_nonce,
				page: Axiom_VIEWMORE_PAGE+1,
				data: Axiom_VIEWMORE_DATA,
				vars: Axiom_VIEWMORE_VARS
			}).done(function(response) {
				"use strict";
				var rez = JSON.parse(response);
				jQuery('#viewmore_link').removeClass('loading');
				Axiom_VIEWMORE_BUSY = false;
				if (rez.error === '') {
					var posts_container = jQuery('.content').eq(0);
					if (posts_container.find('aside#tabBlog').length > 0)		posts_container = posts_container.find('aside#tabBlog').eq(0);
					if (posts_container.find('section.masonry').length > 0)		posts_container = posts_container.find('section.masonry').eq(0);
					if (posts_container.find('section.portfolio').length > 0)	posts_container = posts_container.find('section.portfolio').eq(0);
					if (posts_container.hasClass('masonry') || posts_container.hasClass('portfolio')) {
						posts_container.data('last-width', 0).append(rez.data);
						Axiom_isotopeInitCounter = 0;
						initAppendedIsotope(posts_container, rez.filters);
					} else
						jQuery('#viewmore').before(rez.data);

					timelineResponsive();
					timelineScrollFix();
					itemPageFull();
					initPostFormats();
					initShortcodes(posts_container);
					scrollAction();

					Axiom_VIEWMORE_PAGE++;
					if (rez.no_more_data==1) {
						jQuery('#viewmore').hide();
					}
					if (jQuery('#nav_pages ul li').length >= Axiom_VIEWMORE_PAGE) {
						jQuery('#nav_pages ul li').eq(Axiom_VIEWMORE_PAGE).toggleClass('pager_current', true);
					}
				}
			});
		}
		e.preventDefault();
		return false;
	});

	// Infinite pagination
	if (jQuery('#viewmore.pagination_infinite').length > 0) {
		jQuery(window).scroll(infiniteScroll);
	}


	// WooCommerce handlers
	jQuery('.woocommerce .mode_buttons a,.woocommerce-page .mode_buttons a').click(function(e) {
		"use strict";
		var mode = jQuery(this).hasClass('woocommerce_thumbs') ? 'thumbs' : 'list';
		jQuery.cookie('Axiom_shop_mode', mode, {expires: 365, path: '/'});
		jQuery(this).siblings('input').val(mode).parents('form').get(0).submit();
		e.preventDefault();
		return false;
	});
	// Added to cart
	jQuery('body').bind('added_to_cart', function() {
		// Update amount on the cart button
		var total = jQuery('.usermenu_cart .total .amount').text()
		if (total != undefined) {
			jQuery('.cart_button .cart_total').text(total);
		}
	});
		
	// Sound effects init
	if (Axiom_sound_enable) {
		// Load state
		var snd = jQuery.cookie('Axiom_sounds');
		if (snd != undefined) {
			try {
				snd = JSON.parse(snd);
			} catch (e) {}
			if (typeof snd == 'object') {
				Axiom_sound_state = snd;
			}
		}
		if (!Axiom_sound_state.all)			jQuery('.usermenu_sound > a').removeClass('icon-volume').addClass('icon-volume-off-1');
		if (!Axiom_sound_state.mainmenu)		jQuery('.usermenu_sound > ul > li > a.sound_mainmenu').removeClass('icon-check').addClass('icon-dot');
		if (!Axiom_sound_state.othermenu)	jQuery('.usermenu_sound > ul > li > a.sound_othermenu').removeClass('icon-check').addClass('icon-dot');
		if (!Axiom_sound_state.buttons)		jQuery('.usermenu_sound > ul > li > a.sound_buttons').removeClass('icon-check').addClass('icon-dot');
		if (!Axiom_sound_state.links)		jQuery('.usermenu_sound > ul > li > a.sound_links').removeClass('icon-check').addClass('icon-dot');
		// Init sounds
		var Axiom_sounds = [];
		soundManager.setup({
			// location: path to SWF files, as needed (SWF file name is appended later.)
			url: Axiom_sound_folder,
			
			// optional: version of SM2 flash audio API to use (8 or 9; default is 8 if omitted, OK for most use cases.)
			// flashVersion: 9,
			
			// optional: use Flash for MP3/MP4/AAC formats, even if HTML5 support present. useful if HTML5 is quirky.
			//preferFlash: true,
			
			// use soundmanager2-nodebug-jsmin.js, or disable debug mode (enabled by default) after development/testing
			debugMode: false,
			
			// good to go: the onready() callback
			onready: function() {
				"use strict";
				// SM2 has started - now you can create and play sounds!
				if (Axiom_sound_mainmenu) {
					Axiom_sounds['mainmenu'] = soundManager.createSound({
						id: 'sound_mainmenu', // optional: an id will be generated if not provided.
						url: Axiom_sound_mainmenu
						// onload: function() { console.log('sound loaded!', this); }
						// other options here..
					});
				}
				if (Axiom_sound_othermenu) {
					Axiom_sounds['othermenu'] = soundManager.createSound({
						id: 'sound_othermenu', // optional: an id will be generated if not provided.
						url: Axiom_sound_othermenu
					});
				}
				if (Axiom_sound_buttons) {
					Axiom_sounds['buttons'] = soundManager.createSound({
						id: 'sound_buttons', // optional: an id will be generated if not provided.
						url: Axiom_sound_buttons
					});
				}
				if (Axiom_sound_links) {
					Axiom_sounds['links'] = soundManager.createSound({
						id: 'sound_links', // optional: an id will be generated if not provided.
						url: Axiom_sound_links
					});
				}
			},
			
			// optional: ontimeout() callback for handling start-up failure, flash required but blocked, etc.
			ontimeout: function() {
				"use strict";
				// Hrmm, SM2 could not start. Missing SWF? Flash blocked? Show an error, etc.?
				// See the flashblock demo when you want to start getting fancy.
			}
		});
		var sounded_objects = 'a,button,.sc_accordion_title,.sc_toggles_title,.tabsButton > ul > li,.topWrap .search,.topWrap .openRightMenu';
		var last_time = 0;
		jQuery(sounded_objects).hover(
			function () {
				"use strict";
				if (!Axiom_sound_state.all) return;
				var dt = new Date();
				var tm = dt.getTime();
				if (tm - last_time < 50) return;
				last_time = tm;
				if (jQuery(this).parents('#mainmenu,.tabsButton').length > 0) {
					if (Axiom_sound_state.mainmenu && Axiom_sound_mainmenu && typeof Axiom_sounds['mainmenu'] != 'undefined')
						Axiom_sounds['mainmenu'].play();
				} else if (jQuery(this).parents('#panelmenu,#sidemenu,.usermenu_area').length > 0) {
					if (Axiom_sound_state.othermenu && Axiom_sound_othermenu && typeof Axiom_sounds['othermenu'] != 'undefined')
						Axiom_sounds['othermenu'].play();
				} else if (jQuery(this).parents('.squareButton,.roundButton,.flex-direction-nav,.sc_accordion,.sc_toggles,.tab_names,.topWrap,.tabsMenuHead,#co_bg_pattern_list,#co_bg_images_list,.addBookmarkArea,.socPage,.page-numbers,.upToScroll').length > 0 || jQuery(this).hasClass('button')) {
					if (Axiom_sound_state.buttons && Axiom_sound_buttons && typeof Axiom_sounds['buttons'] != 'undefined')
						Axiom_sounds['buttons'].play();
				} else {
					if (Axiom_sound_state.links && Axiom_sound_links && typeof Axiom_sounds['links'] != 'undefined')
						Axiom_sounds['links'].play();
				}
			},
			function () {}
		);
		// Main sound on/off
		jQuery('.usermenu_sound > a').click(function(e) {
			"use strict";
			Axiom_sound_state.all = 1-Axiom_sound_state.all;
			jQuery.cookie('Axiom_sounds', JSON.stringify(Axiom_sound_state), {expires: 365, path: '/'});
			jQuery(this).removeClass(Axiom_sound_state.all ? 'icon-volume-off-1' : 'icon-volume').addClass(Axiom_sound_state.all ? 'icon-volume' : 'icon-volume-off-1');
			e.preventDefault();
			return false;
		});
		// Sound parts on/off
		jQuery('.usermenu_sound > ul > li > a').click(function(e) {
			"use strict";
			if (jQuery(this).hasClass('sound_mainmenu')) {
				Axiom_sound_state.mainmenu = 1 - Axiom_sound_state.mainmenu;
				jQuery(this).removeClass(Axiom_sound_state.mainmenu ? 'icon-dot' : 'icon-check').addClass(Axiom_sound_state.mainmenu ? 'icon-check' : 'icon-dot');
			} else if (jQuery(this).hasClass('sound_othermenu')) {
				Axiom_sound_state.othermenu = 1 - Axiom_sound_state.othermenu;
				jQuery(this).removeClass(Axiom_sound_state.othermenu ? 'icon-dot' : 'icon-check').addClass(Axiom_sound_state.othermenu ? 'icon-check' : 'icon-dot');
			} else if (jQuery(this).hasClass('sound_buttons')) {
				Axiom_sound_state.buttons = 1 - Axiom_sound_state.buttons;
				jQuery(this).removeClass(Axiom_sound_state.buttons ? 'icon-dot' : 'icon-check').addClass(Axiom_sound_state.buttons ? 'icon-check' : 'icon-dot');
			} else if (jQuery(this).hasClass('sound_links')) {
				Axiom_sound_state.links = 1 - Axiom_sound_state.links;
				jQuery(this).removeClass(Axiom_sound_state.links ? 'icon-dot' : 'icon-check').addClass(Axiom_sound_state.links ? 'icon-check' : 'icon-dot');
			}
			jQuery.cookie('Axiom_sounds', JSON.stringify(Axiom_sound_state), {expires: 365, path: '/'});
			e.preventDefault();
			return false;
		});		
	}

	// Add placeholders to WP booking calendar
	if (jQuery('#slot_reservation').length > 0) {
		var $cont = jQuery('#form_container_all > div');
		var $i = 0;
		$cont.each(function() {
			if ($i < 4)
				jQuery(this).find('input').attr('placeholder', jQuery(this).find('div').text());
			if ($i == 4)
				jQuery(this).find('textarea').attr('placeholder', jQuery(this).find('div').text());
			$i++;
		});


	}

	if ((jQuery('#toc').length > 0) && (jQuery('.upToScroll').length > 0)) {
		jQuery('.upToScroll').css('display','none');
	}

	initPostFormats();
	initShortcodes(jQuery('body').eq(0));
	
} //end ready

// set sidemenu_button left pos if main menu is hidden
function smLeftPos() {
	if(jQuery('#sidemenu_button').length > 0) {
		var mainW = jQuery('.main').width();
		var windowW = jQuery(window).width();
		var leftPos = windowW/2 - mainW/2;
		jQuery('#sidemenu_button').css('left',leftPos);
	}
}


// Init Superfish menu
function initSfMenu(selector) {
	jQuery(selector).show().each(function () {
		if (isResponsiveNeed() && jQuery(this).attr('id')=='mainmenu' && (Axiom_responsive_menu_click || isMobile())) return;
		jQuery(this).addClass('inited').superfish({
			delay: 500,
			animation: {
				opacity: 'show',
				height: 'show'
			},
			speed: 'fast',
			autoArrows: false,
			dropShadows: false,
			onBeforeShow: function(ul) {
				if (jQuery(this).parents("ul").length > 1){
					var w = jQuery(window).width();
					var par_offset = jQuery(this).parents("ul").offset().left;
					var par_width  = jQuery(this).parents("ul").outerWidth();
					var ul_width   = jQuery(this).outerWidth();
					if (par_offset+par_width+ul_width > w-20 && par_offset-ul_width > 0)
						jQuery(this).addClass('submenu_left');
					else
						jQuery(this).removeClass('submenu_left');
				}
			}
		});
	});
}



// Main Menu responsive
function mainMenuResponsive() {
	if (Axiom_menuResponsive > 0) {
		if (isResponsiveNeed()) {
			if (!jQuery('body').hasClass('responsive_menu')) {
				jQuery('body').addClass('responsive_menu');
				jQuery('header').removeClass('fixedTopMenu').addClass('noFixMenu');
				if ((Axiom_responsive_menu_click || isMobile()) && jQuery('.menuTopWrap > ul#mainmenu').hasClass('inited')) {
					jQuery('.menuTopWrap > ul#mainmenu').removeClass('inited').superfish('destroy');
				}
			}
		} else {
			if (jQuery('body').hasClass('responsive_menu')) {
				jQuery('body').removeClass('responsive_menu');
				jQuery('.menuTopWrap').show();
				if (Axiom_responsive_menu_click || isMobile()) {
					initSfMenu('.menuTopWrap > ul#mainmenu');
				}
				calcMenuColumnsWidth();
			}
		}
	}
}


// Make all columns (in custom menu) equal height
function calcMenuColumnsWidth() {
	"use strict";
	jQuery('#mainmenu li.custom_view_item ul.menu-panel ul.columns').each(function() {
		"use strict";
		if (jQuery('body').hasClass('responsive_menu')) return;
		jQuery(this).parents('.menu-panel').css({display:'block', visibility: 'hidden'});
		var h = 0, w = 0;
		jQuery(this).find('>li').css('height', 'auto').each(function () {
			var li = jQuery(this);
			var mt = parseInt(li.css('marginTop')), mb = parseInt(li.css('marginBottom')), mh = li.height() + (isNaN(mt) ? 0 : mt) + (isNaN(mb) ? 0 : mb);
			if (h < mh) h = mh;
			var bl = parseInt(li.css('borderLeft')), pl = parseInt(li.css('paddingLeft')), br = parseInt(li.css('borderRight')), pr = parseInt(li.css('paddingRight'));
			w += li.width() + (isNaN(bl) ? 0: bl) + (isNaN(pl) ? 0 : pl) + (isNaN(pr) ? 0 : pr) + (isNaN(br) ? 0 : br);
		});
		jQuery(this).parents('.menu-panel').css({display:'none', visibility: 'visible'});
		if (w > jQuery('#mainmenu').width()) jQuery(this).width(w+8);

		jQuery(this).find('>li').height(h);
	});
}

// Check if responsive menu need
function isResponsiveNeed() {
	"use strict";
	var rez = false;
	if (Axiom_menuResponsive > 0) {
		var w = window.innerWidth;
		if (w == undefined) {
			w = jQuery(window).width()+(jQuery(window).height() < jQuery(document).height() || jQuery(window).scrollTop() > 0 ? 16 : 0);
		}
		rez = Axiom_menuResponsive > w;
	}
	return rez;
}


// Infinite Scroll
function infiniteScroll() {
	"use strict";
	var v = jQuery('#viewmore.pagination_infinite').offset();
	if (jQuery(this).scrollTop() + jQuery(this).height() + 100 >= v.top && !Axiom_VIEWMORE_BUSY) {
		jQuery('#viewmore_link').eq(0).trigger('click');
	}
}

//itemPageFull
function itemPageFull() {
	"use strict";
	var bodyHeight = jQuery(window).height();
	var st = jQuery(window).scrollTop();
	if (st > jQuery('.noFixMenu .topWrap').height()+jQuery('.topTabsWrap').height()) st = 0;
	var thumbHeight = Math.min(jQuery('.itemPageFull').width()/16*9, bodyHeight - jQuery('#wpadminbar').height() - jQuery('.noFixMenu .topWrap').height() - jQuery('.topTabsWrap').height() + st);
	jQuery('.itemPageFull').height(thumbHeight);
	var padd1 = parseInt(jQuery('.sidemenu_wrap').css('paddingTop'));
	if (isNaN(padd1)) padd1 = parseInt(jQuery('.swpRightPos').css('paddingTop'));
	if (isNaN(padd1)) padd1 = 0;
	var padd2 = parseInt(jQuery('.swpRightPos .sc_tabs .tabsMenuBody').css('paddingTop'))*2;
	if (isNaN(padd2)) padd2 = 0;
	var tabs_h = jQuery('.swpRightPos .sc_tabs .tabsMenuHead').height();
	if (isNaN(tabs_h)) tabs_h = 0;
	var butt_h = jQuery('.swpRightPos .sc_tabs .tabsMenuBody .addBookmarkArea').height();
	if (isNaN(butt_h)) butt_h = 0;
	jQuery('#sidemenu_scroll').height(bodyHeight - padd1);
	jQuery('.swpRightPos .sc_tabs .tabsMenuBody').height(bodyHeight -  - padd1 - padd2 - tabs_h);
	jQuery('#custom_options_scroll').height(bodyHeight - padd1 - padd2 - tabs_h);
	jQuery('#sidebar_panel_scroll').height(bodyHeight - padd1 - padd2 - tabs_h);
	jQuery('#panelmenu_scroll').height(bodyHeight - padd1 - padd2 - tabs_h);
	jQuery('#bookmarks_scroll').height(bodyHeight - padd1 - padd2 - tabs_h - butt_h);
}

//scroll Action
function scrollAction() {
	"use strict";

	var buttonScrollTop = jQuery('.upToScroll');
	var scrollPositions = jQuery(window).scrollTop();
	var topMenuHeight   = jQuery('header').height();
	var adminbarHeight  = jQuery('#wpadminbar').height();

	if (scrollPositions > topMenuHeight) {
		buttonScrollTop.addClass('buttonShow');
	} else {
		buttonScrollTop.removeClass('buttonShow');
	}
	
	if (!jQuery('body').hasClass('responsive_menu') && Axiom_menuFixed) {
		var slider_height = 0;
		if (jQuery('.top_panel_below .sliderHomeBullets').length > 0) {
			slider_height = jQuery('.top_panel_below .sliderHomeBullets').height();
			if (slider_height < 10) {
				slider_height = jQuery('.sliderHomeBullets').parents('.fullScreenSlider').length > 0 ? jQuery(window).height() : Axiom_slider_height;
			}
		}
		var topFixedHeight = Math.max(0, jQuery('.fixedTopMenu .topWrap').height());
		if (scrollPositions <= Axiom_top_height - topFixedHeight - 20 + slider_height)  {
			if (jQuery('header').hasClass('fixedTopMenu')) {
				jQuery('header').removeClass('fixedTopMenu').addClass('noFixMenu');
				if (Axiom_use_fixed_wrapper) jQuery('.topWrapFixed').hide();
			}
		} else if (scrollPositions > Axiom_top_height + slider_height) {
			if (!jQuery('header').hasClass('fixedTopMenu')) {
				if (Axiom_use_fixed_wrapper) jQuery('.topWrapFixed').height(Axiom_top_height).show();
				jQuery('header').addClass('fixedTopMenu').removeClass('noFixMenu');
			}
		}
	}
	// window.width < 1024 - > height = 0;
	jQuery(window).on('resize',function(){
		if(jQuery(window).width() < 1024)
		if (!jQuery('header').hasClass('fixedTopMenu')) {
			if (Axiom_use_fixed_wrapper) jQuery('.topWrapFixed').height('0');
		}
	});

	// TOC current items
	jQuery('#toc .toc_item').each(function () {
		"use strict";
		var id = jQuery(this).find('a').attr('href');
		var pos = id.indexOf('#');
		if (pos < 0 || id.length == 1) return;
		var loc = window.location.href;
		var pos2 = loc.indexOf('#');
		if (pos2 > 0) loc = loc.substring(0, pos2);
		var now = pos==0;
		if (!now) now = loc == href.substring(0, pos);
		if (!now) return;
		var off = jQuery(id).offset().top;
		var id_next  = jQuery(this).next().find('a').attr('href');
		var off_next = id_next ? jQuery(id_next).offset().top : 1000000;
		if (off < scrollPositions + jQuery(window).height()*0.8 && scrollPositions + topMenuHeight < off_next)
			jQuery(this).addClass('current');
		else
			jQuery(this).removeClass('current');
	});
}


// Build page TOC from the tag's id
function buildPageTOC() {
	"use strict";
	var toc = '', toc_count = 0;
	jQuery('[id^="toc_"],.sc_anchor').each(function(idx) {
		"use strict";
		var obj = jQuery(this);
		var id = obj.attr('id');
		var url = obj.data('url');
		var icon = obj.data('icon');
		if (!icon) icon = 'icon-record';
		var title = obj.attr('title');
		var description = obj.data('description');
		var separator = obj.data('separator');
		toc_count++;
		toc += '<div class="toc_item'+(separator=='yes' ? ' toc_separator' : '')+'">'
			+(description ? '<div class="toc_description">'+description+'</div>' : '')
			+'<a href="'+(url ? url : '#'+id)+'" class="toc_icon'+(title ? ' with_title' : '')+' '+icon+'">'+(title ? '<span class="toc_title">'+title+'</span>' : '')+'</a>'
			+'</div>';
	});
	if (toc_count > (Axiom_menu_toc_home ? 1 : 0) + (Axiom_menu_toc_top ? 1 : 0)) {
		if (jQuery('#toc').length > 0)
			jQuery('#toc .toc_inner').html(toc);
		else
			jQuery('body').append('<div id="toc" class="toc_'+Axiom_menu_toc+'"><div class="toc_inner">'+toc+'</div></div>');
	}
}

// Fullscreen slider
function fullSlider() {
	"use strict";
	var fullSlider = jQuery('.fullScreenSlider');
	if (fullSlider.length > 0) {
		var h = jQuery(window).height() - jQuery('#wpadminbar').height() - (jQuery('.top_panel_above .fullScreenSlider header').css('position')=='static' ? jQuery('.topWrap').height() : 0);
		// Slider Container
		fullSlider.find('.sliderHomeBullets').css('height', h);
		// Revolution slider
		fullSlider.find('.sliderHomeBullets.slider_engine_revo .rev_slider_wrapper,.sliderHomeBullets.slider_engine_revo .rev_slider').css({'height': h+'px', 'maxHeight': h+'px'});
		fullSlider.find('.sliderHomeBullets.slider_engine_revo .rev_slider > ul').css({'maxHeight': h+'px'});
		fullSlider.find('.sliderHomeBullets.slider_engine_revo .rev_slider .defaultimg').css({'height': h+'px', 'maxWidth': 'none'});
	} else {
		var slider = jQuery('.sliderHomeBullets.slider_engine_revo');
		if (slider.length > 0) {
			var h = slider.find('.rev_slider').height();
			if (slider.height() != h) slider.css('height', h);
		}
	}
}


// Resize sliders
function resizeSliders() {
	if (jQuery('.sc_slider_flex,.sc_slider_chop,.sc_slider_swiper').length > 0) {
		jQuery('.sc_slider_flex,.sc_slider_chop,.sc_slider_swiper').each(function () {
			if (jQuery(this).parents('.isotope, .isotopeNOanim').length == 0) calcSliderDimensions(jQuery(this));
		});
	}
}

//Time Line
function timelineResponsive() {
	"use strict";
	var tl = jQuery('#timeline_slider:not(.fixed)').eq(0);
	if (tl.length > 0) {
		if (jQuery(window).width() <= 1023) {
			tl.addClass('fixed');
		} else {
			var bodyHeight = jQuery(window).height();
			var tlHeight = jQuery(window).height() - tl.find('h2').height() - 150;
			tl.find('.sc_blogger').css('height', tlHeight).find('.sc_scroll').css('height', tlHeight);
		}
	}
}


//time line Scroll
function timelineScrollFix() {
	"use strict";
	var tl = jQuery('#timeline_slider:not(.fixed)').eq(0);
	if (tl.length > 0) {
		var scrollWind = jQuery(window).scrollTop();
		var headerHeight = jQuery('header').height() + jQuery('.topTabsWrap').height() - 20;
		var footerHeight = jQuery('.footerContentWrap').height();
		var footerVisible = jQuery(document).height() - footerHeight <= scrollWind + jQuery(window).height();

		if (jQuery(window).scrollTop() <= headerHeight) {
			if (parseFloat(tl.css('marginTop')) > 0) {
				tl.animate({
					marginTop: 0
				}, {
					queue: false,
					duration: 350
				});
			}
		} else {
			if (headerHeight <= scrollWind - 10 && !footerVisible) {
				tl.animate({
					marginTop: (scrollWind - headerHeight) + "px"
				}, {
					queue: false,
					duration: 350
				});
			}
		}
	}
}

// Init isotope
var Axiom_isotopeInitCounter = 0;
function initIsotope() {
	if (jQuery('.isotopeNOanim,.isotope').length > 0) {

		jQuery('.isotopeNOanim,.isotope').each(function () {
			"use strict";
			if (!isotopeImagesComplete(jQuery(this)) && Axiom_isotopeInitCounter++ < 30) {
				setTimeout(initIsotope, 200);
				return;
			}
			jQuery(this).addClass('inited').find('.isotopeElement').animate({opacity: 1}, 200, function () { jQuery(this).addClass('isotopeElementShow'); });
			var w = calcSizeIsotope(jQuery(this));
			var gutter = 50; //if changing - change on line 1275 too var gutter = (columns - 1) * 50;
			if (jQuery(window).width() < 800) gutter = 0;
			jQuery(this).isotope({
				resizable: jQuery(this).parents('.fullscreen,.sc_gap').length > 0 && !jQuery(this).hasClass('folio1col'),
				masonry: {
					columnWidth: w,
					gutter: gutter
				},
				itemSelector: '.isotopeElement',
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: false
				}
			});
			// Init shortcodes in isotope
			initShortcodes(jQuery(this));
		});		
	}
}

function initAppendedIsotope(posts_container, filters) {
	"use strict";
	if (!isotopeImagesComplete(posts_container) && Axiom_isotopeInitCounter++ < 30) {
		setTimeout(function() { initAppendedIsotope(posts_container, filters); }, 200);
		return;
	}
	calcSizeIsotope(posts_container);
	var flt = posts_container.siblings('.isotopeFiltr');
	var elems = posts_container.find('.isotopeElement:not(.isotopeElementShow)').animate({opacity: 1}, 200, function () { jQuery(this).addClass('isotopeElementShow'); });
	posts_container.isotope('appended', elems);
	for (var i in filters) {
		if (flt.find('a[data-filter=".flt_'+i+'"]').length == 0) {
			flt.find('ul').append('<li class="squareButton"><a href="#" data-filter=".flt_'+i+'">'+filters[i]+'</a></li>');
		}
	}
}

function isotopeImagesComplete(cont) {
	var complete = true;
	cont.find('img').each(function() {
		if (!complete) return;
		if (!jQuery(this).get(0).complete) complete = false;
	});
	return complete;
}

function calcSizeIsotope(cont) {
	"use strict";
	var columns = Math.max(1, Number(cont.data('columns')));
	var element = cont.find('.isotopeElement:not(.isotope-item)');
	var elementWidth=0, elementWidthNew=0, elementHeight=0, elementHeightNew=0;

	var gutter = (columns - 1) * 50; //line 1222 - gutter = 50
	if (jQuery(window).width() < 800) gutter = 0;
	var contW = cont.width() - gutter;

	if (cont.data('last-width') == contW) return elementWidthNew;
	var changeHeight = cont.hasClass('portfolio');
	var m1 = parseInt(cont.css('marginRight'));
	if (isNaN(m1)) m1 = 0;
	var m2 = parseInt(element.find('.isotopePadding').css('marginRight'));
	if (isNaN(m2)) m2 = 0;
	var lastWidth = contW + (changeHeight ? 0 : m1+m2);
	cont.data('last-width', lastWidth);
	elementWidth = changeHeight ? element.width() : Math.max(240, Math.floor(lastWidth/columns - m2));
	cont.data('element-width', elementWidth);
	elementWidthNew = Math.floor(lastWidth / columns);
	var dir = elementWidthNew > elementWidth ? 1 : -1;
	while (dir*(elementWidthNew-elementWidth)/elementWidth > Axiom_isotope_resize_delta) {
		columns += dir;
		if (columns==0) break;
		elementWidthNew = Math.floor(lastWidth / columns);
	}
	element.css({
		width: elementWidthNew
	});
	if (changeHeight) {
		elementHeight = element.height();
		cont.data('element-height', elementHeight);
		elementHeightNew = Math.floor(elementWidthNew/elementWidth*elementHeight);
		element.css({
			height: elementHeightNew
		});
	}

	return elementWidthNew;
}

// Resize new Isotope elements
function resizeIsotope() {
	jQuery('.isotope, .isotopeNOanim').each(function() {
		"use strict";
		var cont = jQuery(this);
		var columns = Math.max(1, Number(cont.data('columns')));

		var gutter = (columns - 1) * 50; //line 1222 - gutter = 50
		if (jQuery(window).width() < 800) gutter = 0;
		var contW = cont.width() - gutter;

		if (columns == 1 || cont.data('last-width') == contW) return;
		var changeHeight = cont.hasClass('portfolio');
		var element = cont.find('.isotopeElement');
		var m1 = parseInt(cont.css('marginRight'));
		if (isNaN(m1)) m1 = 0;
		var m2 = parseInt(element.find('.isotopePadding').css('marginRight'));
		if (isNaN(m2)) m2 = 0;
		var lastWidth = contW + (changeHeight ? 0 : m1+m2);
		cont.data('last-width', lastWidth);
		var elementWidth = parseFloat(cont.data('element-width'));
		var elementWidthNew = Math.floor(lastWidth / columns);
		var dir = elementWidthNew > elementWidth ? 1 : -1;
		while (dir*(elementWidthNew-elementWidth)/elementWidth > Axiom_isotope_resize_delta) {
			columns += dir;
			if (columns == 0) break;
			//jQuery(this).data('columns', columns);
			elementWidthNew = Math.floor(lastWidth / columns);
		}
		element.css({
			width: elementWidthNew
		});
		if (changeHeight) {
			var elementHeight = parseFloat(cont.data('element-height'));
			var elementHeightNew = Math.floor(elementWidthNew/elementWidth*elementHeight);
			element.css({
				height: elementHeightNew
			});
		}
		jQuery(this).isotope({
			masonry: {
				columnWidth: elementWidthNew
			}
		});
		cont.find('.sc_slider_flex,.sc_slider_chop,.sc_slider_swiper').each(function () {
			calcSliderDimensions(jQuery(this));
		});
	});
}

function initPostFormats() {
	"use strict";

	// MediaElement init
	initMediaElements(jQuery('body'));

	//hoverZoom img effect
	if (jQuery('.hoverIncrease:not(.inited)').length > 0) {
		jQuery('.hoverIncrease:not(.inited)')
			.addClass('inited')
			.each(function () {
				"use strict";
				var img = jQuery(this).data('image');
				var title = jQuery(this).data('title');
				if (img) {
					jQuery(this).append('<span class="hoverShadow"></span><a href="'+img+'" title="'+title+'"><span class="hoverIcon"></span></a>');
				}
			});
	}

	// Popup init
	if (Axiom_popupEngine == 'pretty' && typeof jQuery.prettyPhoto != 'undefined') {
		jQuery("a[href$='jpg'],a[href$='jpeg'],a[href$='png'],a[href$='gif']").attr('rel', 'prettyPhoto'+(Axiom_popupGallery ? '[slideshow]' : ''));
		jQuery("a[rel*='prettyPhoto']:not(.inited):not([rel*='magnific']):not([data-rel*='magnific'])")
			.addClass('inited')
			.prettyPhoto({
				social_tools: '',
				theme: 'facebook',
				deeplinking: false
			})
			.click(function(e) {
				"use strict";
				if (jQuery(window).width()<280)	{
					e.stopImmediatePropagation();
					window.location = jQuery(this).attr('href');
				}
				e.preventDefault();
				return false;
			});
	} else if (typeof jQuery.magnificPopup != 'undefined') {
		jQuery("a[href$='jpg'],a[href$='jpeg'],a[href$='png'],a[href$='gif']").attr('rel', 'magnific');	//.toggleClass('magnific', true);
		jQuery("a[rel*='magnific']:not(.inited):not(.prettyphoto):not([rel*='pretty']):not([data-rel*='pretty'])")
			.addClass('inited')
			.magnificPopup({
				type: 'image',
				mainClass: 'mfp-img-mobile',
				closeOnContentClick: true,
				closeBtnInside: true,
				fixedContentPos: true,
				midClick: true,
				//removalDelay: 500, 
				preloader: true,
				tLoading: Axiom_MAGNIFIC_LOADING,
				gallery:{
					enabled:Axiom_popupGallery
				},
				image: {
					tError: Axiom_MAGNIFIC_ERROR,
					verticalFit: true
				}
			});
	}

	// Popup windows with any html content
	if (typeof jQuery.magnificPopup != 'undefined') {
		jQuery('.user-popup-link:not(.inited),a[href="#openLogin"]:not(.inited)')
			.addClass('inited')
			.magnificPopup({
				type: 'inline',
				removalDelay: 500,
				callbacks: {
					beforeOpen: function () {
						this.st.mainClass = 'mfp-zoom-in';
					},
					open: function () {
						jQuery('html').css({
							overflow: 'visible',
							margin: 0
						});
					},
					close: function () {
					}
				},
				midClick: true
			});
	}
	//textarea Autosize
	if (jQuery('textarea.textAreaSize:not(.inited)').length > 0) {
		jQuery('textarea.textAreaSize:not(.inited)')
			.addClass('inited')
			.autosize({
				append: "\n"
			});
	}

	// Share button
	if (jQuery('ul.shareDrop:not(.inited)').length > 0) {
		jQuery('ul.shareDrop:not(.inited)')
			.addClass('inited')
			.siblings('a').click(function (e) {
				"use strict";
				if (jQuery(this).hasClass('selected')) {
					jQuery(this).removeClass('selected').siblings('ul.shareDrop').slideUp();
				} else {
					jQuery(this).addClass('selected').siblings('ul.shareDrop').slideDown();
				}
				e.preventDefault();
				return false;
			}).end()
			.find('li a').click(function (e) {
				jQuery(this).parents('ul.shareDrop').slideUp().siblings('a.shareDrop').removeClass('selected');
				e.preventDefault();
				return false;
			});
	}

	// Like button
	if (jQuery('.postSharing:not(.inited),.masonryMore:not(.inited)').length > 0) {
		jQuery('.postSharing:not(.inited),.masonryMore:not(.inited)')
			.addClass('inited')
			.find('.likeButton a')
			.click(function(e) {
				var button = jQuery(this).parent();
				var inc = button.hasClass('like') ? 1 : -1;
				var post_id = button.data('postid');
				var likes = Number(button.data('likes'))+inc;
				var cookie_likes = jQuery.cookie('Axiom_likes');
				if (cookie_likes === undefined) cookie_likes = '';
				jQuery.post(Axiom_ajax_url, {
					action: 'post_counter',
					nonce: Axiom_ajax_nonce,
					post_id: post_id,
					likes: likes
				}).done(function(response) {
					var rez = JSON.parse(response);
					if (rez.error === '') {
						if (inc == 1) {
							var title = button.data('title-dislike');
							button.removeClass('like').addClass('likeActive');
							cookie_likes += (cookie_likes.substr(-1)!=',' ? ',' : '') + post_id + ',';
						} else {
							var title = button.data('title-like');
							button.removeClass('likeActive').addClass('like');
							cookie_likes = cookie_likes.replace(','+post_id+',', ',');
						}
						button.data('likes', likes).find('a').attr('title', title).find('.likePost').html(likes);
						jQuery.cookie('Axiom_likes', cookie_likes, {expires: 365, path: '/'});
					} else {
						Axiom_message_warning(Axiom_MESSAGE_ERROR_LIKE);
					}
				});
				e.preventDefault();
				return false;
			});
	}

	//Hover DIR
	if (jQuery('.portfolio > .isotopeElement:not(.inited)').length > 0) {
		jQuery('.portfolio > .isotopeElement:not(.inited)')
			.addClass('inited')
			.find('> .hoverDirShow').each(function () {
				"use strict";
				jQuery(this).hoverdir();
			});
	}

	// Add video on thumb click
	if (jQuery('.sc_video_play_button:not(.inited)').length > 0) {
		jQuery('.sc_video_play_button:not(.inited)').each(function() {
			"use strict";
			var video = jQuery(this).data('video');
			var pos = video.indexOf('height=');
			if (pos > 0) {
				pos += 8;
				var pos2 = video.indexOf('"', pos);
				var h = parseInt(video.substring(pos, pos2));
				if (!isNaN(h))
					jQuery(this).find('img').height(h);
			}
			jQuery(this)
				.addClass('inited')
				.animate({opacity: 1}, 1000)
				.click(function (e) {
					"use strict";
					if (!jQuery(this).hasClass('sc_video_play_button')) return;
					var video = jQuery(this).removeClass('sc_video_play_button').data('video');
					if (video!=='') {
						jQuery(this).empty().html(video);
						videoDimensions();
						var video_tag = jQuery(this).find('video');
						var w = video_tag.width();
						var h = video_tag.height();
						initMediaElements(jQuery(this));
						// Restore WxH attributes, because Chrome broke it!
						jQuery(this).find('video').css({'width':w, 'height': h}).attr({'width':w, 'height': h});
					}
					e.preventDefault();
					return false;
				});
		});
	}

	// IFRAME width and height constrain proportions 
	if (jQuery('iframe,.sc_video_player,video.sc_video,video.sc_video_bg').length > 0) {
		if (!Axiom_video_resize_inited) {
			Axiom_video_resize_inited = true;
			jQuery(window).resize(function() {
				"use strict";
				videoDimensions();
			});
		}
		videoDimensions();
	}
	
	// Tribe Events buttons
	jQuery('.tribe-events-nav-previous,.tribe-events-nav-next,.tribe-events-widget-link,.tribe-events-viewmore').addClass('squareButton');
	jQuery('a.tribe-events-read-more').wrap('<span class="squareButton"></span>');
}


function initMediaElements(cont) {
	if (Axiom_useMediaElement && cont.find('audio,video').length > 0) {
		if (window.mejs) {
			window.mejs.MepDefaults.enableAutosize = false;
			window.mejs.MediaElementDefaults.enableAutosize = false;
			cont.find('audio:not(.wp-audio-shortcode),video:not(.wp-video-shortcode)').each(function() {
				if (jQuery(this).parents('.mejs-mediaelement').length == 0) {
					var settings = {
						enableAutosize: false,
						videoWidth: -1,		// if set, overrides <video width>
						videoHeight: -1,	// if set, overrides <video height>
						audioWidth: '100%',	// width of audio player
						audioHeight: 30		// height of audio player
					};
				
					settings.success = function (mejs) {
						var autoplay, loop;
	
						if ( 'flash' === mejs.pluginType ) {
	
							autoplay = mejs.attributes.autoplay && 'false' !== mejs.attributes.autoplay;
							loop = mejs.attributes.loop && 'false' !== mejs.attributes.loop;
	
							autoplay && mejs.addEventListener( 'canplay', function () {
								mejs.play();
							}, false );
			
							loop && mejs.addEventListener( 'ended', function () {
								mejs.play();
							}, false );
						}
					}

					jQuery(this).mediaelementplayer(settings);
				}
			});
		} else
			setTimeout(function() { initMediaElements(cont); }, 400);
	}
}



// Fit video frames to document width
function videoDimensions() {
	jQuery('.sc_video_player').each(function() {
		"use strict";
		var player = jQuery(this).eq(0);
		var ratio = (player.data('ratio') ? player.data('ratio').split(':') : (player.find('[data-ratio]').length>0 ? player.find('[data-ratio]').data('ratio').split(':') : [16,9]));
		ratio = ratio.length!=2 || ratio[0]==0 || ratio[1]==0 ? 16/9 : ratio[0]/ratio[1];
		var cover = jQuery(this).find('.sc_video_play_button img');
		var ht = player.find('.sc_video_player_title').height();
		var w_attr = player.data('width');
		var h_attr = player.data('height');
		if (!w_attr || !h_attr) {
			return;
		}
		var percent = (''+w_attr).substr(-1)=='%';
		w_attr = parseInt(w_attr);
		h_attr = parseInt(h_attr);
		var w_real = Math.min(percent ? 10000 : w_attr, player.parents('div,article').width()), //player.width();
			h_real = Math.round(percent ? w_real/ratio : w_real/w_attr*h_attr);
		if (parseInt(player.attr('data-last-width'))==w_real) return;
		if (percent) {
			player.height(h_real + (isNaN(ht) ? 0 : ht));
			if (cover.length > 0) cover.height(h_real);
		} else {
			player.css({'width': w_real+'px', 'height': h_real + (isNaN(ht) ? 0 : ht)+'px'});
			if (cover.length > 0) cover.height(h_real);
		}
		player.attr('data-last-width', w_real);
	});
	jQuery('video.sc_video').each(function() {
		"use strict";
		var video = jQuery(this).eq(0);
		var ratio = (video.data('ratio')!=undefined ? video.data('ratio').split(':') : [16,9]);
		ratio = ratio.length!=2 || ratio[0]==0 || ratio[1]==0 ? 16/9 : ratio[0]/ratio[1];
		var mejs_cont = video.parents('.mejs-video');
		var player = video.parents('.sc_video_player');
		var w_attr = player.length>0 ? player.data('width') : video.data('width');
		var h_attr = player.length>0 ? player.data('height') : video.data('height');
		if (!w_attr || !h_attr) {
			return;
		}
		var percent = (''+w_attr).substr(-1)=='%';
		w_attr = parseInt(w_attr);
		h_attr = parseInt(h_attr);
		var w_real = Math.round(mejs_cont.length > 0 ? Math.min(percent ? 10000 : w_attr, mejs_cont.parents('div,article').width()) : video.width()),
			h_real = Math.round(percent ? w_real/ratio : w_real/w_attr*h_attr);
		if (parseInt(video.attr('data-last-width'))==w_real) return;
		if (mejs_cont.length > 0 && mejs) {
			setMejsPlayerDimensions(video, w_real, h_real);
		}
		if (percent) {
			video.height(h_real);
		} else {
			video.attr({'width': w_real, 'height': h_real}).css({'width': w_real+'px', 'height': h_real+'px'});
		}
		video.attr('data-last-width', w_real);
	});
	jQuery('video.sc_video_bg').each(function() {
		"use strict";
		var video = jQuery(this).eq(0);
		var ratio = (video.data('ratio')!=undefined ? video.data('ratio').split(':') : [16,9]);
		ratio = ratio.length!=2 || ratio[0]==0 || ratio[1]==0 ? 16/9 : ratio[0]/ratio[1];
		var mejs_cont = video.parents('.mejs-video');
		var container = mejs_cont.length>0 ? mejs_cont.parent() : video.parent();
		var w = container.width();
		var h = container.height();
		var w1 = Math.ceil(h*ratio);
		var h1 = Math.ceil(w/ratio);
		if (video.parents('.sc_parallax').length > 0) {
			var windowHeight = jQuery(window).height();
			var speed = Number(video.parents('.sc_parallax').data('parallax-speed'));
			var h_add = Math.ceil(Math.abs((windowHeight-h)*speed));
			if (h1 < h + h_add) {
				h1 = h + h_add;
				w1 = Math.ceil(h1 * ratio);
			}
		}
		if (h1 < h) {
			h1 = h;
			w1 = Math.ceil(h1 * ratio);
		}
		if (w1 < w) { 
			w1 = w;
			h1 = Math.ceil(w1 / ratio);
		}
		var l = Math.round((w1-w)/2);
		var t = Math.round((h1-h)/2);
		if (parseInt(video.attr('data-last-width'))==w1) return;
		if (mejs_cont.length > 0) {
			setMejsPlayerDimensions(video, w1, h1);
			mejs_cont.css({'left': -l+'px', 'top': -t+'px'});
		} else
			video.css({'left': -l+'px', 'top': -t+'px'});
		video.attr({'width': w1, 'height': h1, 'data-last-width':w1}).css({'width':w1+'px', 'height':h1+'px'});
		if (video.css('opacity')==0) video.animate({'opacity': 1}, 3000);
	});
	jQuery('iframe').each(function() {
		"use strict";
		var iframe = jQuery(this).eq(0);
		var ratio = (iframe.data('ratio')!=undefined ? iframe.data('ratio').split(':') : (iframe.find('[data-ratio]').length>0 ? iframe.find('[data-ratio]').data('ratio').split(':') : [16,9]));
		ratio = ratio.length!=2 || ratio[0]==0 || ratio[1]==0 ? 16/9 : ratio[0]/ratio[1];
		var w_attr = iframe.attr('width');
		var h_attr = iframe.attr('height');
		var player = iframe.parents('.sc_video_player');
		if (player.length > 0) {
			w_attr = player.data('width');
			h_attr = player.data('height');
		}
		if (!w_attr || !h_attr) {
			return;
		}
		var percent = (''+w_attr).substr(-1)=='%';
		w_attr = parseInt(w_attr);
		h_attr = parseInt(h_attr);
		var w_real = player.length > 0 ? player.width() : iframe.width(),
			h_real = Math.round(percent ? w_real/ratio : w_real/w_attr*h_attr);
		if (parseInt(iframe.attr('data-last-width'))==w_real) return;
		iframe.css({'width': w_real+'px', 'height': h_real+'px'});
	});
}

// Resize fullscreen video background
function resizeVideoBackground() {
	var bg = jQuery('.videoBackgroundFullscreen');
	if (bg.length < 1) 
		return;
	if (Axiom_useMediaElement && bg.find('.mejs-video').length == 0)  {
		setTimeout(resizeVideoBackground, 100);
		return;
	}
	if (!bg.hasClass('inited')) {
		bg.addClass('inited');
	}
	var video = bg.find('video');
	var ratio = (video.data('ratio')!=undefined ? video.data('ratio').split(':') : [16,9]);
	ratio = ratio.length!=2 || ratio[0]==0 || ratio[1]==0 ? 16/9 : ratio[0]/ratio[1];
	var w = bg.width();
	var h = bg.height();
	var w1 = Math.ceil(h*ratio);
	var h1 = Math.ceil(w/ratio);
	if (h1 < h) {
		h1 = h;
		w1 = Math.ceil(h1 * ratio);
	}
	if (w1 < w) { 
		w1 = w;
		h1 = Math.ceil(w1 / ratio);
	}
	var l = Math.round((w1-w)/2);
	var t = Math.round((h1-h)/2);
	if (bg.find('.mejs-container').length > 0) {
		setMejsPlayerDimensions(bg.find('video'), w1, h1);
		bg.find('.mejs-container').css({'left': -l+'px', 'top': -t+'px'});
	} else
		bg.find('video').css({'left': -l+'px', 'top': -t+'px'});
	bg.find('video').attr({'width': w1, 'height': h1}).css({'width':w1+'px', 'height':h1+'px'});
}

// Set Media Elements player dimensions
function setMejsPlayerDimensions(video, w, h) {
	if (mejs) {
		for (var pl in mejs.players) {
			if (mejs.players[pl].media.src == video.attr('src')) {
				if (mejs.players[pl].media.setVideoSize) {
					mejs.players[pl].media.setVideoSize(w, h);
				}
				mejs.players[pl].setPlayerSize(w, h);
				mejs.players[pl].setControlsSize();
			}
		}
	}
}

// Parallax scroll
function REX_parallax(){
	jQuery('.sc_parallax').each(function(){
		var windowHeight = jQuery(window).height();
		var scrollTops = jQuery(window).scrollTop();
		var offsetPrx = Math.max(jQuery(this).offset().top, windowHeight);
		if ( offsetPrx <= scrollTops + windowHeight ) {
			var speed  = Number(jQuery(this).data('parallax-speed'));
			var xpos   = jQuery(this).data('parallax-x-pos');  
			var ypos   = Math.round((offsetPrx - scrollTops - windowHeight) * speed + (speed < 0 ? windowHeight*speed : 0));
			jQuery(this).find('.sc_parallax_content').css('backgroundPosition', xpos+' '+ypos+'px');
			// Uncomment next line if you want parallax video (else - video position is static)
			jQuery(this).find('div.sc_video_bg').css('top', ypos+'px');
		}
	});
}

// Init Popup Menu
function InitPopupMenu(){
	var padd1 = parseInt(jQuery('.sidemenu_wrap').css('paddingTop'));
	var bodyHeight = jQuery(window).height();
	jQuery('#popup_menu').width(jQuery('.main').width());
	jQuery('#sidemnu_scroll .sc_scroll_wrapper.swiper-wrapper').width(jQuery(window).width());

	var menu = jQuery('.sidemenu_wrap .sidemenu_area ul.sub-menu > li > ul.sub-menu');
	var topmenu = menu.parent().parent();
	var maxH = 0;
	var menuCounter = 0;
	menu.each(function() {
		var elemH = 0;
		jQuery(this).find('a').each(function() {
			elemH = elemH + jQuery(this).height();
		});

		maxH = maxH >= elemH ? maxH : elemH;
		menuCounter++;
	});

	if(jQuery(window).width() < 800) maxH = maxH * menuCounter / jQuery('#sidemenu > li').length;
	topmenu.height(maxH);
}


// set max ul height to all ".sub-menu .sub-menu"s
function maxHeightSidemenuUL() {
	if (jQuery('.sidemenu_wrap').length > 0) {
		var menu = jQuery("#sidemenu .sub-menu .sub-menu");
		if (jQuery(window).width() > 768) {
			var maxH = Math.max.apply(null, menu.map(function ()
			{
				return jQuery(this).height();
			}).get());

			menu.height(maxH);
		} else {
			menu.css('height','');
		}
	}
}

// portfolio isotope square effect6 - get info top offset
function InfoTopOffset() {
	var article = jQuery('.isotopeElement.isotopeElement > .ih-item.square.effect6');
	if (article.length < 1) return;
	var infoH = 0;
	var infoElemsH = 0;
	article.each(function(){
		infoH = article.find(".info").outerHeight();
		infoElemsH = article.find(".info-back > h4").outerHeight(true) + article.find(".info-back > div ").height();
		article.find(".info").css('padding-top', infoH/2 - infoElemsH/2);
	});
}

// calculate contact form 3 textarea width
function contactform3Width() {
	/*var textarea = jQuery('.sc_contact_form_contact_3 textarea');
	textarea.css('width','');
	if ((jQuery(window).width() < 480 ) || (textarea.length < 1)) return;
	var contW = jQuery('.sc_contact_form_contact_3 .sc_column_item_3').width();
	var buttonW = jQuery('.sc_contact_form_contact_3 .sc_contact_form_button .squareButton > a').outerWidth();
	var margin = jQuery('.sc_contact_form_contact_3 .columns1_4').css("marginRight").replace('px', '');

	textarea.css('width', (contW - buttonW - margin - 5) + 'px');*/
}


// Form contact
function userSubmitForm(form, url, nonce){
	"use strict";
	var error = false;
	var form_custom = form.data('formtype');
	if ( form_custom == 'contact_1' ) {
		error = formValidate(form, {
			error_message_show: true,
			error_message_time: 5000,
			error_message_class: "sc_infobox sc_infobox_style_error",
			error_fields_class: "error_fields_class",
			exit_after_first_error: false,
			rules: [
				{
					field: "username",
					min_length: { value: 1,	 message: Axiom_NAME_EMPTY },
					max_length: { value: 60, message: Axiom_NAME_LONG}
				},
				{
					field: "email",
					min_length: { value: 7,	 message: Axiom_EMAIL_EMPTY },
					max_length: { value: 60, message: Axiom_EMAIL_LONG},
					mask: { value: Axiom_EMAIL_MASK, message: Axiom_EMAIL_NOT_VALID}
				},
				{
					field: "subject",
					min_length: { value: 1,	 message: Axiom_SUBJECT_EMPTY },
					max_length: { value: 100, message: Axiom_SUBJECT_LONG}
				},
				{
					field: "message",
					min_length: { value: 1,  message: Axiom_MESSAGE_EMPTY },
					max_length: { value: Axiom_msg_maxlength_contacts, message: Axiom_MESSAGE_LONG}
				}
			]
		});
	}
	if ( form_custom == 'contact_2' ) {
		error = formValidate(form, {
			error_message_show: true,
			error_message_time: 5000,
			error_message_class: "sc_infobox sc_infobox_style_error",
			error_fields_class: "error_fields_class",
			exit_after_first_error: false,
			rules: [
				{
					field: "username",
					min_length: { value: 1,	 message: Axiom_NAME_EMPTY },
					max_length: { value: 60, message: Axiom_NAME_LONG}
				},
				{
					field: "email",
					min_length: { value: 7,	 message: Axiom_EMAIL_EMPTY },
					max_length: { value: 60, message: Axiom_EMAIL_LONG},
					mask: { value: Axiom_EMAIL_MASK, message: Axiom_EMAIL_NOT_VALID}
				},
				{
					field: "phone",
					min_length: { value: 5,	 message: Axiom_PHONE_EMPTY },
					mask: { value: Axiom_PHONE_MASK, message: Axiom_PHONE_NOT_VALID}
				},
				{
					field: "message",
					min_length: { value: 1,  message: Axiom_MESSAGE_EMPTY },
					max_length: { value: Axiom_msg_maxlength_contacts, message: Axiom_MESSAGE_LONG}
				}
			]
		});
	}
	if ( form_custom == 'contact_3' ) {
		error = formValidate(form, {
			error_message_show: true,
			error_message_time: 5000,
			error_message_class: "sc_infobox sc_infobox_style_error",
			error_fields_class: "error_fields_class",
			exit_after_first_error: false,
			rules: [
				{
					field: "username",
					min_length: { value: 1,	 message: Axiom_NAME_EMPTY },
					max_length: { value: 60, message: Axiom_NAME_LONG}
				},
				{
					field: "email",
					min_length: { value: 7,	 message: Axiom_EMAIL_EMPTY },
					max_length: { value: 60, message: Axiom_EMAIL_LONG},
					mask: { value: Axiom_EMAIL_MASK, message: Axiom_EMAIL_NOT_VALID}
				},
				{
					field: "phone",
					min_length: { value: 5,	 message: Axiom_PHONE_EMPTY },
					mask: { value: Axiom_PHONE_MASK, message: Axiom_PHONE_NOT_VALID}
				},
				{
					field: "subject",
					min_length: { value: 1,	 message: Axiom_SUBJECT_EMPTY },
					max_length: { value: 100, message: Axiom_SUBJECT_LONG}
				},
				{
					field: "message",
					min_length: { value: 1,  message: Axiom_MESSAGE_EMPTY },
					max_length: { value: Axiom_msg_maxlength_contacts, message: Axiom_MESSAGE_LONG}
				}
			]
		});
	}
	if (!error && url!='#') {
	/*	Axiom_validateForm = form;
		var data = {
			action: "send_contact_form",
			nonce: nonce,
			type: form_custom ? 'custom' : 'contact',
			data: form.serialize()
		};
		jQuery.post(url, data, userSubmitFormResponse, "text");*/
	}
}
	
function userSubmitFormResponse(response) {
/*	"use strict";
	var rez = JSON.parse(response);
	var result = Axiom_validateForm.find(".result")
		.toggleClass("sc_infobox_style_error", false)
		.toggleClass("sc_infobox_style_success", false);
	if (rez.error == "") {
		result.addClass("sc_infobox_style_success").html(Axiom_SEND_COMPLETE);
		setTimeout(function () {
			result.fadeOut();
			Axiom_validateForm.get(0).reset();
			}, 3000);
	} else {
		result.addClass("sc_infobox_style_error").html(Axiom_SEND_ERROR + ' ' + rez.error);
	}
	result.fadeIn();*/
}

// Popup messages
//-----------------------------------------------------------------
function Axiom_message_init() {
	"use strict";
	jQuery('body').on('click', '#Axiom_modal_bg,.Axiom_message .Axiom_message_close', function (e) {
		"use strict";
		Axiom_message_destroy();
		if (Axiom_MESSAGE_CALLBACK) {
			Axiom_MESSAGE_CALLBACK(0);
			Axiom_MESSAGE_CALLBACK = null;
		}
		e.preventDefault();
		return false;
	});
}

var Axiom_MESSAGE_CALLBACK = null;
var Axiom_MESSAGE_TIMEOUT = 5000;

// Warning
function Axiom_message_warning(msg) {
	"use strict";
	var hdr  = arguments[1] ? arguments[1] : '';
	var icon = arguments[2] ? arguments[2] : 'cancel';
	var delay = arguments[3] ? arguments[3] : Axiom_MESSAGE_TIMEOUT;
	return Axiom_message({
		msg: msg,
		hdr: hdr,
		icon: icon,
		type: 'warning',
		delay: delay,
		buttons: [],
		callback: null
	});
}

// Success
function Axiom_message_success(msg) {
	"use strict";
	var hdr  = arguments[1] ? arguments[1] : '';
	var icon = arguments[2] ? arguments[2] : 'check';
	var delay = arguments[3] ? arguments[3] : Axiom_MESSAGE_TIMEOUT;
	return Axiom_message({
		msg: msg,
		hdr: hdr,
		icon: icon,
		type: 'success',
		delay: delay,
		buttons: [],
		callback: null
	});
}

// Info
function Axiom_message_info(msg) {
	"use strict";
	var hdr  = arguments[1] ? arguments[1] : '';
	var icon = arguments[2] ? arguments[2] : 'info';
	var delay = arguments[3] ? arguments[3] : Axiom_MESSAGE_TIMEOUT;
	return Axiom_message({
		msg: msg,
		hdr: hdr,
		icon: icon,
		type: 'info',
		delay: delay,
		buttons: [],
		callback: null
	});
}

// Regular
function Axiom_message_regular(msg) {
	"use strict";
	var hdr  = arguments[1] ? arguments[1] : '';
	var icon = arguments[2] ? arguments[2] : 'quote';
	var delay = arguments[3] ? arguments[3] : Axiom_MESSAGE_TIMEOUT;
	return Axiom_message({
		msg: msg,
		hdr: hdr,
		icon: icon,
		type: 'regular',
		delay: delay,
		buttons: [],
		callback: null
	});
}

// Confirm dialog
function Axiom_message_confirm(msg) {
	"use strict";
	var hdr  = arguments[1] ? arguments[1] : '';
	var callback = arguments[2] ? arguments[2] : null;
	return Axiom_message({
		msg: msg,
		hdr: hdr,
		icon: 'help',
		type: 'regular',
		delay: 0,
		buttons: ['Yes', 'No'],
		callback: callback
	});
}

// Modal dialog
function Axiom_message_dialog(content) {
	"use strict";
	var hdr  = arguments[1] ? arguments[1] : '';
	var init = arguments[2] ? arguments[2] : null;
	var callback = arguments[3] ? arguments[3] : null;
	return Axiom_message({
		msg: content,
		hdr: hdr,
		icon: '',
		type: 'regular',
		delay: 0,
		buttons: ['Apply', 'Cancel'],
		init: init,
		callback: callback
	});
}

// General message window
function Axiom_message(opt) {
	"use strict";
	var msg = opt.msg != undefined ? opt.msg : '';
	var hdr  = opt.hdr != undefined ? opt.hdr : '';
	var icon = opt.icon != undefined ? opt.icon : '';
	var type = opt.type != undefined ? opt.type : 'regular';
	var delay = opt.delay != undefined ? opt.delay : Axiom_MESSAGE_TIMEOUT;
	var buttons = opt.buttons != undefined ? opt.buttons : [];
	var init = opt.init != undefined ? opt.init : null;
	var callback = opt.callback != undefined ? opt.callback : null;
	// Modal bg
	jQuery('#Axiom_modal_bg').remove();
	jQuery('body').append('<div id="Axiom_modal_bg"></div>');
	jQuery('#Axiom_modal_bg').fadeIn();
	// Popup window
	jQuery('.Axiom_message').remove();
	var html = '<div class="Axiom_message Axiom_message_' + type + (buttons.length > 0 ? ' Axiom_message_dialog' : '') + '">'
		+ '<span class="Axiom_message_close iconadmin-cancel icon-cancel"></span>'
		+ (icon ? '<span class="Axiom_message_icon iconadmin-'+icon+' icon-'+icon+'"></span>' : '')
		+ (hdr ? '<h2 class="Axiom_message_header">'+hdr+'</h2>' : '');
	html += '<div class="Axiom_message_body">' + msg + '</div>';
	if (buttons.length > 0) {
		html += '<div class="Axiom_message_buttons">';
		for (var i=0; i<buttons.length; i++) {
			html += '<span class="Axiom_message_button">'+buttons[i]+'</span>';
		}
		html += '</div>';
	}
	html += '</div>';
	// Add popup to body
	jQuery('body').append(html);
	var popup = jQuery('body .Axiom_message').eq(0);
	// Prepare callback on buttons click
	if (callback != null) {
		Axiom_MESSAGE_CALLBACK = callback;
		jQuery('.Axiom_message_button').click(function(e) {
			"use strict";
			var btn = jQuery(this).index();
			callback(btn+1, popup);
			Axiom_MESSAGE_CALLBACK = null;
			Axiom_message_destroy();
		});
	}
	// Call init function
	if (init != null) init(popup);
	// Show (animate) popup
	var top = jQuery(window).scrollTop();
	jQuery('body .Axiom_message').animate({top: top+Math.round((jQuery(window).height()-jQuery('.Axiom_message').height())/2), opacity: 1}, {complete: function () {
		// Call init function
		//if (init != null) init(popup);
	}});
	// Delayed destroy (if need)
	if (delay > 0) {
		setTimeout(function() { Axiom_message_destroy(); }, delay);
	}
	return popup;
}

// Destroy message window
function Axiom_message_destroy() {
	"use strict";
	var top = jQuery(window).scrollTop();
	jQuery('#Axiom_modal_bg').fadeOut();
	jQuery('.Axiom_message').animate({top: top-jQuery('.Axiom_message').height(), opacity: 0});
	setTimeout(function() { jQuery('#Axiom_modal_bg').remove(); jQuery('.Axiom_message').remove(); }, 500);
}
