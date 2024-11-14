<?php

/**
 * Change the brightness of the passed in color
 *
 * $diff should be negative to go darker, positive to go lighter and
 * is subtracted from the decimal (0-255) value of the color
 *
 * @param string $hex color to be modified
 * @param string $diff amount to change the color
 * @return string hex color
 */
function decrease_brightness($hex, $diff) {

		$hex = substr($hex, 1);

		// convert 3 char codes --> 6, e.g. `E0F` --> `EE00FF`
		// if(strlen($hex) == 3){
		// 		$hex = preg_replace('/(.)/g', '$1$1', $hex);
		// }
		$r = hexdec(substr($hex, 0, 2));
		$g = hexdec(substr($hex,2, 2));
		$b = hexdec(substr($hex,4, 2));
		$luma = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;

		if ($luma > 128) {
			return '#' .
			substr(dechex((0|(1<<8) + $r * (100 - $diff) / 100)), 1) .
			substr(dechex((0|(1<<8) + $g * (100 - $diff) / 100)), 1) .
			substr(dechex((0|(1<<8) + $b * (100 - $diff) / 100)), 1);
		} else {
			return '#' .
			substr(dechex((0|(1<<8) + $r + (256 - $r) * $diff / 100)), 1) .
			substr(dechex((0|(1<<8) + $g + (256 - $g) * $diff / 100)), 1) .
			substr(dechex((0|(1<<8) + $b + (256 - $b) * $diff / 100)), 1);

		}
}

/* --------
custom style
------------------------------------------- */
function asalah_style_customizer_css() {

	// start output variable
	$output = '';

	// Add jetpack gallery style if exists
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'carousel' )) {
		$output .= ".gallery {";
		$output .=  "margin-bottom: 1.6em;";
		$output .= "}";
		$output .= ".gallery-item {";
		$output .= "display: inline-block;";
		$output .= "padding: 1.79104477%;";
		$output .= "text-align: center;";
		$output .= "vertical-align: top;";
		$output .= "width: 100%;";
		$output .= "}";
		$output .= ".gallery-columns-2 .gallery-item {";
		$output .= "max-width: 50%;";
		$output .= "}";
		$output .= ".gallery-columns-3 .gallery-item {";
		$output .= "max-width: 33.33%;";
		$output .= "}";
		$output .= ".gallery-columns-4 .gallery-item {";
		$output .= "max-width: 25%;";
		$output .= "}";
		$output .= ".gallery-columns-5 .gallery-item {";
		$output .= "max-width: 20%;";
		$output .= "}";
		$output .= ".gallery-columns-6 .gallery-item {";
		$output .= "max-width: 16.66%;";
		$output .= "}";
		$output .= ".gallery-columns-7 .gallery-item {";
		$output .= "max-width: 14.28%;";
		$output .= "}";
		$output .= ".gallery-columns-8 .gallery-item {";
		$output .= "max-width: 12.5%;";
		$output .= "}";
		$output .= ".gallery-columns-9 .gallery-item {";
		$output .= "max-width: 11.11%;";
		$output .= "}";
		$output .= ".gallery-icon img {";
		$output .= "margin: 0 auto;";
		$output .= "}";
		$output .= ".gallery-caption {";
		$output .= "color: #707070;";
		$output .= "color: rgba(51, 51, 51, 0.7);";
		$output .= "display: block;";
		$output .= "font-family: 'Lora', sans-serif;";
		$output .= "font-size: 12px;";
		$output .= "font-size: 1.2rem;";
		$output .= "line-height: 1.5;";
		$output .= "padding: 0.5em 0;";
		$output .= "}";
		$output .= ".gallery-columns-6 .gallery-caption,";
		$output .= ".gallery-columns-7 .gallery-caption,";
		$output .= ".gallery-columns-8 .gallery-caption,";
		$output .= ".gallery-columns-9 .gallery-caption {";
		$output .= "display: none;";
		$output .= "}";
	}

	$main_site_width = intval(asalah_option('asalah_site_width'));
	/* Fix old Site Width issue */
	if (asalah_option('asalah_after_the_kartha') != 'true') {
		if (!isset($main_site_width) || ($main_site_width > 989)) {
			set_theme_mod( 'asalah_site_width', 910 );
			set_theme_mod( 'asalah_after_the_kartha', 'true' );
		}
	}

	/* set custom Site Width */
	if (isset($main_site_width) && ($main_site_width > 499) ) {
		$output .= "@media screen and (min-width: ". $main_site_width ."px) {";
		$output .= '.container { width:'. $main_site_width .'px; }';
		$output .= "}";

		$output .= "@media screen and (min-width: ". ($main_site_width + 171) ."px) {";
			$output .= ".wp-block-image.alignwide {";
				$output .= "margin-left: -85px;";
				$output .= "margin-right: -85px;";
			$output .= "}";
		$output .= "}";
		$wide_margin_range = array(
																($main_site_width + 170) => '-45',
																($main_site_width + 100) => "-25",
																($main_site_width + 60) => "0",
																$main_site_width => "-45",
																// "868" => "-25",
																// "818" => "-15",
																"798" => "0",
															);
		foreach ($wide_margin_range as $max => $margin) {
			$output .= "@media screen and (max-width: ".$max."px) {";
				$output .= ".wp-block-image.alignwide,
									  .wp-block-embed.alignwide,
									  .wp-block-cover-image.alignwide,
									  .wp-block-cover.alignwide {";
				  $output .= "margin-left: ".$margin."px;";
				  $output .= "margin-right: ".$margin."px;";
				$output .= "}";
			$output .= "}";
		}

	}

	// if custom site width not set or more than 992
	if (!isset($main_site_width) || (isset($main_site_width) && $main_site_width == 910)) {
		$output .= "@media screen and (min-width: 992px) {";
			$output .= ".container {";
			$output .= "width: 910px;";
			$output .= "}";

			$output .= ".main_content.col-md-9.pull-right {";
				$output .= "padding-right: 15px;";
				$output .= "padding-left: 30px;";
			$output .= "}";

			$output .= ".side_content.col-md-3 {";
				$output .= "padding-left: 0;";
				$output .= "width: 295px;";
			$output .= "}";

			$output .= ".side_content.col-md-3.pull-left {";
				$output .= "padding-left: 15px;";
				$output .= "padding-right: 0;";
			$output .= "}";
		$output .= "}";

		set_theme_mod( 'asalah_banners_devices_size', 'true' );
	}

	// Text Logo Font size
	if (intval(asalah_option('asalah_logo_font_size')) > 0) {
		$output .= ".site_logo a { font-size: ".asalah_option('asalah_logo_font_size')."px;}";
	}

	// Text Logo Font family
	if (get_theme_mod('asalah_logo_font_type') && get_theme_mod('asalah_logo_font_type') != 'writing_font') {
		$logo_font_type = customizer_library_get_font_stack(get_theme_mod('asalah_logo_font_type'));
		$output .= ".site_logo, .site_logo a { font-family:".$logo_font_type."; letter-spacing: normal;}";
	}

	/* Main Site Style */
	$body_style = '';

	// Main bg color
	if (asalah_option('asalah_enable_body_background_color') && asalah_option('asalah_body_background_color') != '') {
		$post_bg_color = $top_menu_wrapper_color = asalah_option('asalah_body_background_color');
		$body_style .= "background-color:".$post_bg_color.";";
	}

	// main font family
	if (get_theme_mod('asalah_main_font_type') && get_theme_mod('asalah_main_font_type') != 'writing_font') {
		$body_font_type = customizer_library_get_font_stack(get_theme_mod('asalah_main_font_type'));

		$body_style .= "font-family:".$body_font_type.";";
	}

	// main font color
	if (asalah_option('asalah_enable_main_text_color') && asalah_option('asalah_main_text_color') !== '') {
		$body_font_color = asalah_option('asalah_main_text_color');

		// classes derives from main text color
		$output .= ".site_content a, .dropdown-menu .current-menu-ancestor, .dropdown-menu .current-menu-ancestor > a, .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus, .dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .title, .nav > li > a, h3.comment-reply-title, h1, h2, h3, h4, h5, h6, .header_social_icons a, .main_nav .current-menu-item, .main_nav .current-menu-item > a, .main_nav .current-menu-ancestor, .main_nav .current-menu-ancestor > a, #wp-calendar thead th, .mobile_menu_button {color:".$body_font_color.";}";
		// add to main style
		$body_style .= "color:".$body_font_color.";";
	}

	// main font size
	if (intval(asalah_option('asalah_main_font_size')) > 0) {
		$body_style .= "font-size:".asalah_option('asalah_main_font_size')."px;";
	}

	// main line height
	if (intval(asalah_option('asalah_main_line_height')) > 0) {
		$body_style .= "line-height:".asalah_option('asalah_main_line_height')."px;";
	}

	// add main style
	if ($body_style != '') {
		$output .= 'body {'.$body_style."}";
	}

	/* End Main Site Style */

	// set link hover color
	if (asalah_option('asalah_enable_text_hover_color') && asalah_option('asalah_text_hover_color') !== '') {
		$title_hover_color = asalah_option('asalah_text_hover_color');

		$output .= ".title a:hover, .title a:focus , .post_navigation_item .post_info_wrapper .post_title a:hover, .post_navigation_item .post_info_wrapper .post_title a:focus {color:".$title_hover_color.";}";
	}

	/* content bg color */
	if (asalah_option('asalah_enable_post_background_color') && asalah_option('asalah_post_background_color') != '') {
		$post_bg_color = asalah_option('asalah_post_background_color');
		if (asalah_cross_option('asalah_sticky_menu') != 'yes') {
			$top_menu_wrapper_color = $post_bg_color;
		}
		$output .= '.bg-color {';
			$output .= "background-color:".$post_bg_color.";";
		$output .= '}';
	}

	if (isset($post_bg_color)) {
		$change_border_color = decrease_brightness($post_bg_color, 13);
		$change_lighter_border_color = decrease_brightness($post_bg_color, 7);
		$change_darker_color = decrease_brightness($post_bg_color, 18);
		$change_meta_color = decrease_brightness($post_bg_color, 60);
		$change_light_bg = decrease_brightness($post_bg_color, 5);

		$output .= '.site_side_container, .side_content.widget_area .widget_container .widget_title > span, .asalah_select_container, .uneditable-input, #wp-calendar tbody td:hover, #wp-calendar tbody td:focus, .reading-progress-bar, .site form.search-form input {';
			$output .= "background-color:" . $post_bg_color . ";";
		$output .= "}";

		$output .= ".page-links, .post_navigation, .media.the_comment, #wp-calendar thead th, .post_related, table tr, .post_content table, .author_box.author-info, .blog_posts_wrapper .blog_post, .blog_posts_wrapper.masonry_blog_style .blog_post_meta, .blog_post_meta .blog_meta_item a {";
			$output .= 'border-bottom-color:' . $change_border_color . ';';
		$output .= '}';

		$output .= ".page-links, table, .post_content table th, .post_content table td, .second_footer.has_first_footer .second_footer_content_wrapper, .blog_posts_wrapper.masonry_blog_style .blog_post_meta {";
			$output .= 'border-top-color:' . $change_border_color . ';';
		$output .= "}";

		$output .= '.navigation.pagination .nav-links .page-numbers, .navigation_links a, input[type="submit"], .blog_post_control_item .share_item.share_sign {';
			$output .= 'border-color:' . $change_border_color . ';';
		$output .= '}';

		$output .= 'table th:last-child, table td:last-child {';

				$output .= 'border-left-color:' . $change_border_color . ';';

				$output .= 'border-right-color:' . $change_border_color . ';';

		$output .= '}';

		$output .= 'table th, table td {border-right-color:' . $change_border_color . 'border-left-color:' . $change_border_color . ';';

		$output .= '}';

		$output .= ".widget_container ul li {";
			$output .= 'border-bottom-color:' . $change_lighter_border_color . ';';
		$output .= '}';

		$output .= '.site_side_container {';
			$output .= 'border-left-color:' . $change_lighter_border_color . ';';
		$output .= '};';


		$output .= '.blog_meta_item.blog_meta_format a {';
			$output .= 'color:' . $change_darker_color . ';';
		$output .= '}';

		$output .= '.widget_container, .asalah_post_list_widget .post_info_wrapper .post_meta_item, select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input, blockquote cite, .mobile_menu_button, .blog_post_meta .blog_meta_item a, .blog_post_readmore.blog_post_control_item a:hover, .blog_post_readmore.blog_post_control_item a:focus, .blog_post_meta .blog_meta_item, .site form.search-form i.search_submit_icon, .widget_container caption  {';
			$output .= 'color:' . $change_meta_color . ';';
		$output .= '}';

		$output .= ".blog_post_readmore.blog_post_control_item a:hover, .blog_post_readmore.blog_post_control_item a:focus {";
			$output .= 'border-bottom-color:' . $change_meta_color . ';';
		$output .= '}';

		$output .= '#wp-calendar thead th {';
			$output .= 'background-color:' . $change_lighter_border_color . ';';
			$output .= 'border-right-color:' . $post_bg_color . ';';
			$output .= 'border-left-color:' . $post_bg_color . ';';
		$output .= '}';

		$output .= '.page_main_title .title, .page-links > span, .navigation.comment-navigation .comment-nav a, .side_content.widget_area .widget_container .widget_title:after, .widget_container.asalah-social-widget .widget_social_icon, .tagcloud a, input[type="submit"]:hover, input[type="submit"]:focus, .widget_container caption {';
			$output .= 'background-color:' . $change_light_bg . ';';
		$output .= '}';


		$output .= '.comment_content_wrapper , dd {';
			$output .= 'border-right-color:' . $change_light_bg . ';';
			$output .= 'border-left-color:' . $change_light_bg . ';';
		$output .= '}';

		$output .= ".page_404_main_title {";
			$output .= 'border-bottom-color:' . $change_light_bg . ';';
		$output .= '}';

		$output .= '.page-links > span {';
			$output .= 'border-color:' . $change_light_bg . ';';
		$output .= '}';

		$output .= '.user_info_button, .widget_container caption, .footer_wrapper, .user_info_button {';
			$output .= 'border-color:' . decrease_brightness($post_bg_color, 6) . ';';
		$output .= '}';

		$output .= '.site form.search-form i.search_submit_icon {';
			$output .= 'background-color:' . decrease_brightness($post_bg_color, 6) . ';';
		$output .= '}';

		$output .= '#wp-calendar tbody tr:first-child td.pad {';
			$output .= 'border-right-color:' . $post_bg_color . ';';
			$output .= 'border-left-color:' . $post_bg_color . ';';
		$output .= '}';

		$output .= '#wp-calendar tbody td {';
			$output .= 'background-color:' . decrease_brightness($post_bg_color, 4) . ';';
			$output .= 'color:' . decrease_brightness($post_bg_color, 53) . ';';
			$output .= 'border-right-color:' . $post_bg_color . ';';
			$output .= 'border-left-color:' . $post_bg_color . ';';
		$output .= '}';

		$output .= 'blockquote:before, .bypostauthor .commenter_name:after, .sticky.blog_post_container:before {';
			$output .= 'color:' . $change_lighter_border_color . ';';
		$output .= '}';
	}

	/* Start Header Style */
	// set header style variable
	$header_style = '';

	// header height
	if ( asalah_option('asalah_header_height') != 0) {
		$header_height = strval(asalah_option('asalah_header_height'));

		$header_style .= "height:".$header_height."px;";
	}

	// header custom bg image
	if ( asalah_option('asalah_header_background')) {
    $header_background = asalah_option('asalah_header_background');

		$header_style .= "background: url('".$header_background."');";

		/* in case that height height not set, set padding for style */
		if (!isset($header_height)) {
			$header_style .= "padding: 10px 0;";
		}

		// header bg style
		if (asalah_option('asalah_header_background_style') == 'tiled') {
			$header_style .= "background-repeat: repeat;";
		} else if (asalah_option('asalah_header_background_style') == 'cover') {
			$header_style .= "background-size: cover; background-repeat: no-repeat;";
		} else {
			$header_style .= "background-repeat: no-repeat;";
		}
  }

	// header bg color
	if (asalah_option('asalah_enable_header_color') && asalah_option('asalah_header_color') !== '') {
		$header_bg_color = asalah_option('asalah_header_color');

		$header_style .= "background-color:".$header_bg_color.";";

		/* in case that height height not set, set padding for style */
		if (!isset($header_height)) {
			$header_style .= "padding: 10px 0;";
		}
	}

	// header text color
	if (asalah_option('asalah_enable_header_text_color') && asalah_option('asalah_header_text_color') !== '') {
		$header_font_color = asalah_option('asalah_header_text_color');

		/* classes depends on header text color settings */
		$output .= ".header_logo_wrapper a, .header_logo_wrapper .nav > li > a, .logo_tagline {color:".$header_font_color.";}";
		// add to header style
		$header_style .= "color:".$header_font_color.";";
	}

	if ($header_style != '') {
		$output .= ".header_logo_wrapper {".$header_style."}";
	}

	// header links hover color
	if (asalah_option('asalah_enable_header_hover_color') && asalah_option('asalah_header_hover_color') !== '') {
		$header_hover_color = asalah_option('asalah_header_hover_color');

		$output .= ".header_logo_wrapper a:hover, .header_logo_wrapper a:focus {color:".$header_hover_color." !important;}";
	}

	/* End Header Style */

		/* Start Logo Style */

		// remove logo dot if enabled
	  if ( true == asalah_option('asalah_remove_logo_dot')){
			$output .= ".logo_dot, .top_header_items_holder .logo_dot {";
				$output .= "display: none;";
			$output .= "}";
	  }

		// center logo
		if ( true == asalah_option('asalah_center_logo')) {
			$output .= ".title_tagline_below { float: unset; display: table; margin: auto;}";
			$output .= ".header_logo_wrapper .container {";
				$output .= "text-align: center;";
				$output .= "position: relative;";
				$output .= "}";
			$output .= ".header_logo_wrapper .logo_wrapper {";
				$output .= "display: inline-block;";
				$output .= "float: unset;";
				$output .= "width: auto;";
			$output .= "}";
			$output .= ".header_logo_wrapper .header_info_wrapper {";
				$output .= "position: absolute;";
				$output .= "width: 40px;";
				$output .= "height: 40px;";
				$output .= "margin: auto;";
				$output .= "top: 0;";
				$output .= "bottom: 0;";
				if (is_rtl()) {
					$output .= "left: 15px;";
				} else {
					$output .= "right: 15px;";
				}
			$output .= "}";
			$output .= "@media (max-width: 768px) { .site_logo, .site_logo a {
				float: unset !important;
			}}";
			$output .= "@media (max-width: 500px) {
				.logo_type_image_text .asalah_logo {
			    float: unset;
			    margin: auto;
			    display: inline-block !important;
			} .header_logo_wrapper {
				padding-bottom: 42px;
			}

			.header_logo_wrapper .header_info_wrapper {
			    position: absolute;
			    width: 40px;
			    height: 40px;
			    margin: -40px auto;
			    top: auto;
			    bottom: 0;
			    right: 15px;
					left: 15px;
			}
		}";
		} // end center logo

		// start tagline style
		$tagline_style = '';

		// tagline font family
		if (get_theme_mod('asalah_tagline_font_type') && get_theme_mod('asalah_tagline_font_type') != 'writing_font') {
			$headline_font_type = customizer_library_get_font_stack(get_theme_mod('asalah_tagline_font_type'));

			$tagline_style .= "font-family:". $headline_font_type ." !important;";
		}

		// tagline font size
		if (intval(asalah_option('asalah_tagline_font_size')) > 0) {
			$tagline_style .= 'font-size:	'.asalah_option('asalah_tagline_font_size').'px;';
		}

		// tagline line height
		if (intval(asalah_option('asalah_tagline_line_height')) > 0) {
			$line_height = asalah_option('asalah_tagline_line_height');

			$tagline_style .= "line-height:". $line_height ."px;";
		}

		if ($tagline_style != '') {
			$output .= ".logo_tagline.site_tagline {".$tagline_style."}";
		}

		// end tagline style
		/* End Logo Style */

		/* Start Top Menu Style */

		// set top menu color
		if (asalah_option('asalah_enable_top_menu_color') && asalah_option('asalah_top_menu_color')) {
			$top_bg_color = $top_menu_wrapper_color = asalah_option('asalah_top_menu_color');
			$output .= ".dropdown-menu { background-color: ".$top_bg_color.";}";
		} else if (isset($post_bg_color)) {
			$top_bg_color = $post_bg_color;
		}

		if (isset($top_bg_color)) {
			$output .= ".header_search, .sticky_header .header_info_wrapper { border-color:". $top_bg_color .";}";
			$output .= ".top_menu_wrapper, .header_search > form.search .search_text, .sticky_header .top_menu_wrapper, .mobile_menu_button {";
				$output .= "background-color:". $top_bg_color .";";
			$output .= "}";
		}

		if (isset($top_menu_wrapper_color)) {
			$change_border_color = decrease_brightness($top_menu_wrapper_color, 13);
			$change_lighter_border_color = decrease_brightness($top_menu_wrapper_color, 7);
			$change_darker_color = decrease_brightness($top_menu_wrapper_color, 18);
			$change_meta_color = decrease_brightness($top_menu_wrapper_color, 60);
			$change_light_bg = decrease_brightness($top_menu_wrapper_color, 5);


			$output .= '.dropdown-menu, .header_search > form.search .search_text {';
				$output .= 'background-color:' . $top_menu_wrapper_color . ';';
			$output .= '}';
			$output .= ".widget_container ul li, .site input.search-field, .top_menu_wrapper, .header_search > form.search .search_text {";
				$output .= 'border-bottom-color:' . $change_lighter_border_color . ';';
			$output .= '}';

			$output .= '.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus, .dropdown-menu .current-menu-ancestor, .dropdown-menu .current-menu-ancestor > a {';
			$output .= 'background-color:' . $change_light_bg . ';';
			$output .= '}';

			$output .= '.navbar-nav > li > .dropdown-menu {';
				$output .= 'border-right-color:' . $change_light_bg . ';';
				$output .= 'border-left-color:' . $change_light_bg . ';';
			$output .= '}';

			$output .= '.mobile_menu_button, .navbar-nav > li > .dropdown-menu, .dropdown-submenu > .dropdown-menu {';
				$output .= 'border-color:' . $change_light_bg . ';';
			$output .= '}';

			$output .= '.header_search > form.search .search_text { color:' . $change_meta_color . ';}';

			$output .= '.header_search ::-webkit-input-placeholder { /* WebKit, Blink, Edge */color:' . $change_meta_color . ';}';

			$output .= ".header_search, .sticky_header .header_info_wrapper { border-left-color: " . $change_lighter_border_color . "; border-right-color:" . $change_lighter_border_color . "; }";
		}

		// top menu hover color
		if (asalah_option('asalah_enable_top_menu_hover_color') && asalah_option('asalah_top_menu_hover_color') !== '') {
			$top_hover_color = asalah_option('asalah_top_menu_hover_color');

			$output .= ".top_menu_wrapper a:hover, .top_menu_wrapper a:hover, .header_search:hover, .top_menu_wrapper .nav > li > a:hover, .header_search input:hover[type='text'], .dropdown-menu > li > a:hover, .top_menu_wrapper a:focus, .top_menu_wrapper a:focus, .header_search:focus, .top_menu_wrapper .nav > li > a:focus, .header_search input:focus[type='text'], .dropdown-menu > li > a:focus, .top_menu_wrapper a:focus, .top_menu_wrapper a:focus, .header_search:focus, .top_menu_wrapper .nav > li > a:focus, .header_search input:focus[type='text'], .dropdown-menu > li > a:focus {color:".$top_hover_color." !important;}";
		}

		// top menu text color
		if (asalah_option('asalah_enable_top_menu_text_color') && asalah_option('asalah_top_menu_text_color') !== '') {
			$top_text_color = asalah_option('asalah_top_menu_text_color');

			$output .= ".top_menu_wrapper a, .header_search, .top_menu_wrapper .nav > li > a, .header_search input[type='text'], .dropdown-menu > li > a, .mobile_menu_button { color:".$top_text_color.";}";
			$output .= ".header_search ::-webkit-input-placeholder { /* WebKit, Blink, Edge */color:".$top_text_color.";}";
		}

		/* End Top Menu Style */

		/* Start Headlines Style */

		/* General Headline */
		if (get_theme_mod('asalah_head_font_type') && get_theme_mod('asalah_head_font_type') != 'writing_font') {
			$output .= "h1,h2,h3,h4,h5,h6 {";
					$headline_font_type = customizer_library_get_font_stack(get_theme_mod('asalah_head_font_type'));

					$output .= "font-family:". $headline_font_type ."!important;";
			$output .= "}";
		}

		/* Headlines font size */

		if (intval(asalah_option('asalah_h1_font_size')) > 0) {
			$h1_size = asalah_option('asalah_h1_font_size');

			$output .= "h1, .entry-content h1, .page_main_title .title, .blog_single .blog_post_title .title, .main_content.col-md-12 .blog_single .blog_post_title .title {font-size:". $h1_size ."px;}";
		}

			if (intval(asalah_option('asalah_h2_font_size')) > 0) {
				$h2_size = asalah_option('asalah_h2_font_size');

				$output .= "h2, .entry-content h2, .blog_posts_wrapper.masonry_blog_style .blog_post_title .title, .main_content.col-md-9 .blog_posts_wrapper.list_blog_style .blog_post_title .title, .blog_post_title .title {font-size:". $h2_size ."px;}";
			}

				if (intval(asalah_option('asalah_h3_font_size')) > 0) {
					$h3_size = asalah_option('asalah_h3_font_size');

					$output .= "h3, .entry-content h3 {font-size:". $h3_size ."px;}";
				}

					if (intval(asalah_option('asalah_h4_font_size')) > 0) {
						$h4_size = asalah_option('asalah_h4_font_size');

						$output .= "h4, .entry-content h4 {font-size:". $h4_size ."px;}";
					}

						if (intval(asalah_option('asalah_h5_font_size')) > 0) {
							$h5_size = asalah_option('asalah_h5_font_size');

							$output .= "h5, .entry-content h5 {font-size:". $h5_size ."px;}";
						}

							if (intval(asalah_option('asalah_h6_font_size')) > 0) {
								$h6_size = asalah_option('asalah_h6_font_size');

								$output .= "h6, .entry-content h6 {font-size:". $h6_size ."px;}";
							}

		/* End Headline font size */

		/* Headlines line height */

		if (intval(asalah_option('asalah_h1_line_height')) > 0) {
			$h1_size = asalah_option('asalah_h1_line_height');

			$output .= "h1 {line-height:". $h1_size ."px;}";
		}

			if (intval(asalah_option('asalah_h2_line_height')) > 0) {
				$h2_size = asalah_option('asalah_h2_line_height');

				$output .= "h2, .blog_posts_wrapper.masonry_blog_style .blog_post_title .title, .main_content.col-md-9 .blog_posts_wrapper.list_blog_style .blog_post_title .title, .blog_post_title .title {line-height:". $h2_size ."px;}";
			}

				if (intval(asalah_option('asalah_h3_line_height')) > 0) {
					$h3_size = asalah_option('asalah_h3_line_height');

					$output .= "h3 {line-height:". $h3_size ."px;}";
				}

					if (intval(asalah_option('asalah_h4_line_height')) > 0) {
						$h4_size = asalah_option('asalah_h4_line_height');

						$output .= "h4 {line-height:". $h4_size ."px;}";
					}

						if (intval(asalah_option('asalah_h5_line_height')) > 0) {
							$h5_size = asalah_option('asalah_h5_line_height');

							$output .= "h5 {line-height:". $h5_size ."px;}";
						}

							if (intval(asalah_option('asalah_h6_line_height')) > 0) {
								$h6_size = asalah_option('asalah_h6_line_height');

								$output .= "h6 {line-height:". $h6_size ."px;}";
							}

		/* End Headline line height */


		/* Start Blog Style */
		if ((get_theme_mod('asalah_blog_font_type')) || (asalah_option('asalah_blog_font_size')) || (asalah_option('asalah_blog_line_height'))) {
			$output .= ".main_content.col-md-12 .blog_single .blog_post_text, .main_content.col-md-9 .blog_single .blog_post_text {";

				if ( get_theme_mod('asalah_blog_font_type') && (get_theme_mod('asalah_blog_font_type') != 'writing_font')) {
					$blog_font_type = customizer_library_get_font_stack(get_theme_mod('asalah_blog_font_type'));

					$output .= "font-family:". $blog_font_type .";";
				}

				if ((asalah_option('asalah_blog_font_size')) && (asalah_option('asalah_blog_font_size') != 'false')) {
					$blog_font_size = asalah_option('asalah_blog_font_size');

					$output .= "font-size:". $blog_font_size ."px;";
				}

				if ((asalah_option('asalah_blog_line_height')) && (asalah_option('asalah_blog_line_height') != 'false')) {
					$blog_line_height = asalah_option('asalah_blog_line_height');

					$output .= "line-height:". $blog_line_height ."px;";
				}

			$output .= "}";
		}

		/* Start Blog Description Style */
		if ((get_theme_mod('asalah_blog_font_type')) || (asalah_option('asalah_blog_description_font_size')) || (asalah_option('asalah_blog_description_line_height'))) {
			$output .= ".main_content.col-md-12 .blog_posts_list .blog_post_text, .blog_post_description, .blog_posts_wrapper.masonry_blog_style .blog_post_description, .main_content.col-md-12 .blog_posts_wrapper.list_blog_style.blog_posts_list .blog_post_text, .blog_posts_wrapper.list_blog_style .blog_post_description p, .blog_posts_wrapper.masonry_blog_style .blog_post_description, .blog_posts_wrapper.banner_grid_blog_style .blog_style_featured_other .blog_post_description, .blog_posts_wrapper.list_blog_style .blog_post_description p, .blog_posts_wrapper.banner_list_blog_style .blog_style_featured_other .blog_post_description p {";

				if ( get_theme_mod('asalah_blog_font_type') && ( get_theme_mod('asalah_blog_font_type') != 'writing_font')) {
					$blog_font_type = customizer_library_get_font_stack(get_theme_mod('asalah_blog_font_type'));

					$output .= "font-family:". $blog_font_type .";";
				}

				if ((asalah_option('asalah_blog_description_font_size')) && (asalah_option('asalah_blog_description_font_size') != 'false')) {
					$blog_font_size = asalah_option('asalah_blog_description_font_size');

					$output .= "font-size:". $blog_font_size ."px;";
				}

				if ((asalah_option('asalah_blog_description_line_height')) && (asalah_option('asalah_blog_description_line_height') != 'false')) {
					$blog_line_height = asalah_option('asalah_blog_description_line_height');

					$output .= "line-height:". $blog_line_height ."px;";
				}

			$output .= "}";
		}

		/* Start Menu Font Style */
		if ((get_theme_mod('asalah_menu_font_type')) || (asalah_option('asalah_menu_font_size')) || (asalah_option('asalah_menu_line_height'))) {
			$output .= ".nav > li > a, .dropdown-menu > li > a {";

				if ( get_theme_mod('asalah_menu_font_type') && get_theme_mod('asalah_menu_font_type') != 'writing_font') {
					$blog_font_type = customizer_library_get_font_stack(get_theme_mod('asalah_menu_font_type'));

					$output .= "font-family:". $blog_font_type .";";
				}

				if ((asalah_option('asalah_menu_font_size')) && (asalah_option('asalah_menu_font_size') != 'false')) {
					$blog_font_size = asalah_option('asalah_menu_font_size');

					$output .= "font-size:". $blog_font_size ."px;";
				}

				if ((asalah_option('asalah_menu_line_height')) && (asalah_option('asalah_menu_line_height') != 'false')) {
					$blog_line_height = asalah_option('asalah_menu_line_height');

					$output .= "line-height:". $blog_line_height ."px;";
				}

			$output .= "}";
		}

		/* Start Menu Font Style */
		$typography_classes = array(
			'bloglist_title' => '.main_content .blog_posts_wrapper.blog_posts_list .blog_post_title .title, .main_content.col-md-9 .blog_posts_wrapper.blog_posts_list .blog_post_title .title',
			'blogsingle_title' => '.main_content .blog_single > .blog_post_container .blog_post_title .title',
			'metainfo' => '.blog_post_meta .blog_meta_item',
			'widgettitle' => '.widget_container .widget_title'
		);

		foreach ($typography_classes as $class => $class_css) {

			if ((get_theme_mod('asalah_'.$class.'_font_type') && get_theme_mod('asalah_'.$class.'_font_type') != 'writing_font') || (asalah_option('asalah_'.$class.'_font_size')) || (asalah_option('asalah_'.$class.'_line_height'))) {
				$output .= $class_css." {";

					if (get_theme_mod('asalah_'.$class.'_font_type') && get_theme_mod('asalah_'.$class.'_font_type') != 'writing_font') {
						$blog_font_type = customizer_library_get_font_stack(get_theme_mod('asalah_'.$class.'_font_type'));

						$output .= "font-family:". $blog_font_type .";";
					}

					if ((asalah_option('asalah_'.$class.'_font_size')) && (asalah_option('asalah_'.$class.'_font_size') != 'false')) {
						$blog_font_size = asalah_option('asalah_'.$class.'_font_size');

						$output .= "font-size:". $blog_font_size ."px;";
					}

					if ((asalah_option('asalah_'.$class.'_line_height')) && (asalah_option('asalah_'.$class.'_line_height') != 'false')) {
						$blog_line_height = asalah_option('asalah_'.$class.'_line_height');

						$output .= "line-height:". $blog_line_height ."px;";
					}

				$output .= "}";
			}
		}

		/* End Blog Style */

		/* Start Main Color Styles */

		if (asalah_option( 'asalah_main_color' )) {
	    $color = asalah_option( 'asalah_main_color' );

			// start color
    	$output .='.skin_color, .skin_color_hover:hover, a, .user_info_button:hover, .header_social_icons a:hover, .blog_post_meta .blog_meta_item a:hover, .widget_container ul li a:hover, .asalah_post_gallery_nav_container ul.flex-direction-nav > li a:hover:before, .post_navigation_item:hover a.post_navigation_arrow, .comment_body p a:hover, .author_text .social_icons_list a:hover, .skin_color_hover:focus, a, .user_info_button:focus, .header_social_icons a:focus, .blog_post_meta .blog_meta_item a:focus, .widget_container ul li a:focus, .asalah_post_gallery_nav_container ul.flex-direction-nav > li a:focus:before, .post_navigation_item:focus a.post_navigation_arrow, .comment_body p a:focus, .author_text .social_icons_list a:focus, .author_text .social_icons_list a:active {';
        $output .="color: " . $color . ";";
      $output .="}";

    	// start background color
			$output .='.skin_bg, .skin_bg_hover:hover, .blog_post_control_item a:hover, .widget_container.asalah-social-widget .widget_social_icon:hover, .tagcloud a:hover, .cookies_accept_button:hover, .skin_bg, .skin_bg_hover:focus, .blog_post_control_item a:focus, .widget_container.asalah-social-widget .widget_social_icon:focus, .tagcloud a:focus, .cookies_accept_button:focus {';
	      $output .="background-color: " . $color . ";";
	    $output .="}";

      // start border color
			$output .='.skin_border, .blog_post_control_item a, .navigation.pagination .nav-links .page-numbers:hover, .navigation.pagination .nav-links .page-numbers:focus, .navigation.pagination .nav-links .page-numbers.current, .navigation_links a:hover, .navigation_links a:focus, .cookies_accept_button {';
		  $output .="border-color: " . $color . ";";
	    $output .="}";

      // start border left color
			$output .='.skin_border_left {';
        $output .="border-left-color: " . $color . ";";
      $output .="}";

      // start border right color
			$output .='.skin_border_right {';
        $output .="border-right-color: " . $color . ";";
      $output .="}";

      // start border top color
			$output .='.skin_border_top {';
      	$output .="border-top-color: " . $color . ";";
      $output .="}";

			// start reading progress bar color
			$output .= "progress[value]::-webkit-progress-value {";
				$output .= "background-color:". $color .";";
			$output .= "}";

			$output .= "progress[value]::-moz-progress-bar {";
				$output .= "background-color:". $color .";";
			$output .= "}";

      // start border top color
			$output .= '.skin_border_bottom,.comment_body p a:hover, .comment_body p a:focus {';
        $output .= "border-bottom-color: " . $color . ";";
      $output .= "}";

		}
		/* End Main Color Styles */

		// loading placeholder
		if (asalah_option('asalah_lazyload_image_banner') && (asalah_option('asalah_lazload_placeholder_image') == 'yes')) {
			$output .= ".lazyloading:not(.author) {
										opacity: 1;
										transition: opacity 300ms;
										background: url(".get_template_directory_uri()."/images/loader.gif) no-repeat center;
									}";
		}

		if (asalah_option('asalah_lazyload_effect') == 'lazyblur-up') {
			$output .= '
				.blog_post_banner.blog_post_image,
				.blog_post_banner.blog_post_video,
				.blog_meta_author img,
				.asalah_post_gallery img,
				.post_navigation_item .post_thumbnail_wrapper,
				.asalah_about_me .author_image_wrapper,
				.asalah_about_me .author_image_wrapper.circle,
				.asalah_post_list_widget .post_thumbnail_wrapper .post_text_thumbnail,
				.post_navigation_item .post_thumbnail_wrapper .post_text_thumbnail,
				.widget_container.asalah-tweets-widget ul li.tweet-item, li.tweet-item img,
				.commenter img ,
				.author_box.author-info .author-avatar,
				.top_menu_wrapper .top_header_items_holder .header_info_wrapper .user_info_avatar_image.user_info_button img,
				.asalah_post_list_widget .post_thumbnail_wrapper,
				.jr-insta-thumb ul.thumbnails li {
					-webkit-backface-visibility: hidden;
					-moz-backface-visibility: hidden;
					backface-visibility: hidden;
					-webkit-transform: translate3d(0, 0, 0);
					-moz-transform: translate3d(0, 0, 0);
					transform: translate3d(0, 0, 0);
					will-change:transform;
					-webkit-mask-image: -webkit-radial-gradient(white, black);
				}
';
		}

		/* Start Custom CSS */
		if (asalah_option('asalah_enable_custom_css') && asalah_option('asalah_custom_css_code') !== '') {
			$custom_css = asalah_option('asalah_custom_css_code');

			$output .= $custom_css;
		}
		/* End Custom CSS */

		/* Start Custom CSS */
		if (asalah_option('asalah_disable_featured_rnd_crnr')) {
			$custom_css = ".blog_post_banner.blog_post_image,.blog_post_banner.blog_post_image img {border-radius: 0}";

			$output .= $custom_css;
		}

		// post with formatting
		if ((asalah_option('asalah_post_with_formatting') == 'yes') && (asalah_option('asalah_post_excerpt') != "disabled")) {
			$output .= '.blog_posts_list .blog_post .entry-content p:last-of-type { display: inline;}';
		}
		return $output;
	}
	function asalah_style_customizer_css_header() {
		/* End Customizer Styles */
		$output = asalah_style_customizer_css();
		if ($output != '') {
			echo '<style type="text/css" id="asalah_custom_style_code">'.$output.'</style>';
		}
}
add_action( 'wp_head', 'asalah_style_customizer_css_header' );
