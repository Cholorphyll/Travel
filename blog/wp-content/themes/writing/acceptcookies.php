<?php

define('WP_USE_THEMES', false);
$wpdir = explode( "wp-content" , __FILE__ );
require $wpdir[0] . "wp-load.php";
$cookies_text = asalah_option('writing_cookies_description_text') ? asalah_option('writing_cookies_description_text') : __('This site uses cookies so that we can remember you and understand how you use our site.You can change this message and links below in your site.', 'writing');
$cookies_link_text = asalah_option('writing_cookies_links_text') ? asalah_option('writing_cookies_links_text') : __('<span class="cookies_accept_links">Please read our <a href = "#">Cookies </a> &amp; <a href="#">Privacy</a> policies</span>', 'writing');

if (isset($_POST['cookiesnoticestatus']) && $_POST['cookiesnoticestatus'] == "accepted") {
	if (is_user_logged_in()) {
		update_user_meta(get_current_user_id(), 'writing_cookies_accepted', 1);
	}else{
		setcookie('writing_cookies_accepted', 1, time() + ( 365 * 24 * 60 * 60) );
	}
} elseif (isset($_POST['cookiesnoticestatus']) && $_POST['cookiesnoticestatus'] == "shownotice" && !writing_cookies_accepted() && asalah_option('writing_show_cookies_notice') && $cookies_text != '') {

		?>
		<div class="writing_cookies_notice_wrapper">
			<div class="writing_cookies_notice">
				<?php if (asalah_option('writing_show_cookies_icon') !== 0 ): ?>
					<?php
						if (asalah_option('writing_cookies_icon_class')) {
							$cookies_icon_class = '<i class="cookies_bar_icon '.asalah_option('writing_cookies_icon_class').'"></i>';
						}else{
							$cookies_icon_class = '<i class="cookies_bar_icon fa fa-check-square"></i>';
						}
					?>
					<div class="cookies_icons"><?php echo $cookies_icon_class; ?></div>
				<?php endif; ?>

				<?php if (asalah_option('writing_cookies_title') != ''): ?>
					<h3 class="title writing_cookies_title"><?php echo asalah_option('writing_cookies_title'); ?></h3>
				<?php endif; ?>

				<p class="writing_cookis_description"><?php echo $cookies_text; ?></p>
				<div class="writing_cookie_accept_area">

					<?php if ($cookies_link_text != ''): ?>
						<span class="cookies_accept_links"><?php echo do_shortcode(wp_specialchars_decode($cookies_link_text)); ?></span>
					<?php endif; ?>

					<span class="cookies_accept_button"><?php esc_attr_e('I Agree', 'writing'); ?></span>
				</div>
			</div>
		</div>
		<?php
}
?>