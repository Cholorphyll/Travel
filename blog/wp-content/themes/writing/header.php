<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php // check if user hasn't identified favicon using original wordpress option (fallback for old versions and users)
		if (!function_exists('get_site_icon_url')) {
			// Custom Favicon
			 if (asalah_option('asalah_fav_icon') != ''): ?>
				<link rel="shortcut icon" href="<?php echo asalah_option("asalah_fav_icon"); ?>" title="Favicon" />
			<?php
			endif;
		}

		if ($gtm_ID = asalah_option('asalah_gtm_code_head')) {
			echo "<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','".$gtm_ID."');</script>
<!-- End Google Tag Manager -->";
		}

		if ($ga_ID = asalah_option('asalah_ga_code_head')) {
			echo "<!-- Google Analytics -->
<script>
window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
ga('create', '".$ga_ID."', 'auto');
ga('send', 'pageview');
</script>
<script async src='https://www.google-analytics.com/analytics.js'></script>
<!-- End Google Analytics -->";
		}

		?>
		<!--[if lt IE 9]>
		<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
		<![endif]-->
		<script>(function(){document.documentElement.className='js'})();</script>

		<?php // check if Yoast Seo plugin is dectivated and asalah_auto_open_graph isn't disabled
		if (!class_exists('WPSEO_Meta') && (asalah_option('asalah_auto_open_graph') != 'no')) {

			// og:type
			$og_page_type = "website";
			if (is_single()) {
				$og_page_type = "article";
			}

			// og:title and og:url
			if (is_single() || is_page() ):
				$og_page_title = get_the_title();
				$og_page_url = get_the_permalink();
			elseif (is_archive() && !is_author()):
				 $og_page_title = get_the_archive_title();
			elseif(is_home() || is_front_page() ):
				$og_page_title = get_bloginfo('name');
				$og_page_url = esc_url( home_url( '/' ) );
			endif;

			// og:image
			// if on single or page and there's post thumbnail, use it as share image
			if( ( is_single() || is_page() ) && has_post_thumbnail() && !is_home() ):
		    $og_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
				$og_image_url = $og_image_url[0];
			else:
				// use asalah_default_share_thumb as share image if set, if not set, use website logo
				if (asalah_option('asalah_default_share_thumb')) {
					$og_image_url = asalah_option('asalah_default_share_thumb');
				} elseif (asalah_option('asalah_default_logo')) {
						$og_image_url = asalah_option('asalah_default_logo');
				}
			endif;

			// og:description
			// by default, get description from blog description
			$og_description = get_bloginfo( 'description' );
			// if single post or page, get description from post excerpt
			if ( is_single() || is_page() ) {
				$og_description = get_post_field('post_excerpt', $post->ID);
			} elseif (is_archive()) {
				// if archive description is set, get description from archive
				if (get_the_archive_description() != '') {
					$og_description = get_the_archive_description();
				}
			} // if asalah_site_description is set, use it
			elseif (asalah_option('asalah_site_description')) {
				$og_description = asalah_option('asalah_site_description');
			}

			if (isset($og_page_type)):?>
				<meta property="og:type" content="<?php echo esc_attr($og_page_type); ?>" />
			<?php endif;
			if (isset($og_page_title)):?>
				<meta property="og:title" content="<?php echo esc_attr($og_page_title); ?>" />
			<?php endif;
			if (isset($og_page_url)):?>
				<meta property="og:url" content="<?php echo esc_url($og_page_url); ?>" />
			<?php endif;
			if (isset($og_image_url)):?>
				<meta property="og:image" content="<?php echo esc_url($og_image_url); ?>" />
			<?php endif;
			if (isset($og_description)):?>
				<meta property="og:description" content="<?php echo esc_attr($og_description); ?>" />
			<?php endif;
		} //end meta tags if yoast plugin isn't used

		// include wordpress head
		 wp_head();

		// include custom header code, asalah_custom_header
		 do_action('asalah_custom_header');
		?>
	</head>
	<?php
	global $asalah_blogpage_id;
	if (is_singular()) {
		$asalah_blogpage_id = get_the_ID();
	}

	// set page conditions
	// sticky menu
	$sticky_menu = asalah_cross_option('asalah_sticky_menu', $asalah_blogpage_id);
	// primary menu exists
	$primary_menu = (has_nav_menu( 'primary' )) ? true : false;

	// sticky logo
	$sticky_logo = asalah_option('asalah_sticky_logo');

	// search hide
	$hide_header_search = asalah_option('asalah_show_search_header');

	// header social list
	$social_list_icons = (asalah_social_icons_list()) ? true : false;
	$sliding_icon = false;
	// sliding sidebar info icon
	if (
			(// sliding sidebar enabled
				is_active_sidebar( 'sidebar-2' ) &&
		 		asalah_cross_option('asalah_enable_sliding_sidebar') !== 'no'
			)
			||
				// default sidebar enabled with low site width
				(
					(asalah_option('asalah_site_width') && intval(asalah_option('asalah_site_width')) < 701)
					&&
					asalah_cross_option('asalah_sidebar_position') != 'none'
				)
			)
			{
		$sliding_icon = true;
	}

	$logo_at_topbar = false;
	if (asalah_option('asalah_logo_position') === 'top_bar') {
		$logo_at_topbar = true;
	}

	// set body additional classes
	$additional_classes = '';

	// add sticky_menu_enabled class to body if sticky menu enabled
	if ($sticky_menu == 'yes') {
		$additional_classes = 'sticky_menu_enabled';
	}

	// add sticky_logo_enabled class to body if sticky logo at mobile enabled
	if ($sticky_logo == 'yes') {
		$additional_classes .= ' sticky_logo_enabled';
	}

	if (asalah_option('asalah_load_system_fonts')) {
		$additional_classes .= ' asalah_system_fonts';
	}

	if (asalah_option('asalah_async_scripts')) {
		$additional_classes .= ' scripts_async_load';
	}

	// start body
	?>
	<body <?php body_class($additional_classes); ?>>

		<?php
		if ($gtm_ID = asalah_option('asalah_gtm_code_head')) {
			echo '<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id='.$gtm_ID.'"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->';
		}

		// add facebook script snippet if not disabled
		if (asalah_option('asalah_disable_auto_fb_scripts') !== 'yes') {
		?>
			<!-- Load facebook SDK -->
			<div id="fb-root"></div>
			<script>
			jQuery(document).ready(function() {
								<?php // if facebook id added
								if (asalah_option('asalah_fb_id') != ''): ?>
								window.fbAsyncInit = function() {
									FB.init({
										appId            : '<?php echo asalah_option('asalah_fb_id'); ?>',
										xfbml            : true,
										version          : 'v2.11'
									});
								};
								<?php
								endif; // end facebook id section
								?>

					(function(d, s, id){
			     var js, fjs = d.getElementsByTagName(s)[0];
			     if (d.getElementById(id)) {return;}
			     js = d.createElement(s); js.id = id; js.async = true;
			     js.src = "//connect.facebook.net/<?php echo get_locale(); ?>/sdk.js#xfbml=1&version=v2.11";
			     fjs.parentNode.insertBefore(js, fjs);
			   }(document, 'script', 'facebook-jssdk'));
			 });
			</script>
		    <!-- End Load facebook SDK -->
		<?php
		} // end facebook script snippet condition

		// Add progress bar div if enabled, with adding progress_sticky_header class if sticky menu enabled
		if ((asalah_option('asalah_reading_progress') == "yes") && (is_single())) :
		?>
			<progress value="0" id="reading_progress" <?php if ($sticky_menu == 'yes') { echo 'class="progress_sticky_header"';}?>></progress>
		<?php
		endif;

		// sticky header section
		// check if menu and search and social icons, sticky header and sticky menu enabled
		if ($sticky_menu == "yes" && ($primary_menu || $social_list_icons || $hide_header_search != 'no')) { ?>

			<!-- top menu area -->
			<div class="sticky_header<?php if ($sticky_logo == "yes") { echo ' sticky_logo_enabled';}?>">
				<?php
				asalah_header_topbar(true, $primary_menu, $social_list_icons, $sliding_icon, $hide_header_search);
				?>
			</div> <!-- end sticky_header -->
		<?php
		} // end condition check if menu and search and social icons, sticky header and sticky menu enabled
		?>
		<div id="page" class="hfeed site">

			<!-- start site main container -->
			<div class="site_main_container<?php /* add container bg-color classes for content bg */ if (asalah_option('asalah_enable_post_background_color')) {echo ' container bg-color'; } ?>">
				<!-- header -->
					<header class="site_header">

						<!-- top menu area -->
						<?php // if sticky menu, add invisible_header div
						if ($sticky_menu == 'yes') { ?>
							<div class="invisible_header"></div>
						<?php // if not sticky menu
						} else {
							asalah_header_topbar(false, $primary_menu, $social_list_icons, $sliding_icon, $hide_header_search);
						} // end condition sticky menu for hidden header
						if (!$logo_at_topbar) {
						?>
						<!-- header logo wrapper -->
						<div class="header_logo_wrapper <?php if (asalah_option('asalah_boxed_header')) { echo 'container';} ?> <?php if ($sticky_logo == "yes") { echo 'sticky_logo';}?>">
							<div class="container">
								<?php // logo wrapper
								asalah_header_logo_wrapper();

								// sliding sidebar icon
								if ( $sliding_icon ) :
									asalah_sliding_sidebar_infoicon();
								endif;

								// Secondary menu
								if ( has_nav_menu( 'asalah-secondary-menu' ) ) : ?>
									<?php // menu button for secondry menu ?>
									<div class="mobile_menu_button secondary_mobile_menu">
										<?php $locations = get_nav_menu_locations();
													$menu_id = $locations[ 'asalah-secondary-menu' ] ;
													$nav_menu = wp_get_nav_menu_object($menu_id); ?>
										<span class="mobile_menu_text"><?php echo $nav_menu->name; ?></span>
										<span>-</span><span>-</span><span>-</span>
									</div><!-- secondary_mobile_menu -->

									<div class="main_menu secondary-menu pull-left">
										<?php wp_nav_menu( array(
																							'theme_location' => 'asalah-secondary-menu',
																							'container' => 'div',
																							'container_class' => 'main_nav',
																							'menu_class' => 'nav navbar-nav',
																							'fallback_cb' => '',
																							'walker' => new wp_bootstrap_navwalker(),
																						) ); ?>
									</div><!-- end main_menu secondary-menu -->
								<?php
								endif; //end condition secondary menu
								?>
							</div><!-- end container -->
						</div><!-- end .header_logo_wrapper -->

						<?php // add invisible_header_logo div if sticky logo in mobile enabled
						if ($sticky_logo == "yes") { ?>
							<div class="invisible_header_logo"></div>
						<?php }
						} ?>
					</header><!-- header -->

				<!-- start stie content -->
				<section id="content" class="site_content">
					<div class="container">
						<div class="row">