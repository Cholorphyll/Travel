						</div> <!-- .row -->
					</div> <!-- .container -->
				</section> <!-- #content .site_content -->
				<?php // set global page id for cross options
				global $asalah_blogpage_id; ?>
				<footer class="site-footer">

					<!-- screen-reader-text for site footer section -->
					<h3 class="screen-reader-text"><?php _e('Site Footer', 'writing') ?></h3>

					<div class="footer_wrapper">
						<div class="container">

							<?php // set second footer class as no_first_footer in case there're no footer widgets
							$first_footer = "no_first_footer";

							// if there're footer widgets
							if (  is_active_sidebar( 'footer-1'  )
										|| is_active_sidebar( 'footer-2' )
										|| is_active_sidebar( 'footer-3'  )
							):

								// set second footer class as has_first_footer
								$first_footer = "has_first_footer";
								?>
								<div class="first_footer widgets_footer row">
									<?php get_sidebar('footer'); ?>
								</div><!-- end first_footer -->
							<?php
							endif; // end condition footer widgets
							?>

							<?php // Check footer credits
							if (asalah_option('asalah_footer_credits')):
							?>
								<div class="second_footer <?php echo esc_attr($first_footer); ?> row">
									<div class="col-md-12">
										<div class="second_footer_content_wrapper footer_credits">
											<?php // execute footer credits html code
											echo do_shortcode(wp_specialchars_decode((asalah_option('asalah_footer_credits')))); ?>
										</div><!-- end second_footer_content_wrapper -->
									</div><!-- end col-md-12 -->
								</div><!-- end second_footer -->
							<?php
							endif; // end condition footer credits
							?>
						</div><!-- end footer .container -->
					</div><!-- end footer_wrapper -->
				</footer><!-- .site-footer -->
			</div><!-- .site_main_container -->

			<!-- start site side container -->
			<?php
			// Set slidebars vars to false
			$slidesidbar = $resizedsidebar = false;

			// Check if Sliding sidebar enabled and active, set $slidesidbar true
			if (is_active_sidebar( 'sidebar-2' )  && asalah_cross_option('asalah_enable_sliding_sidebar', $asalah_blogpage_id) != 'no' ) {
				$slidesidbar = true;
			}

			// Check if site width is less than 701 px and default sidebar is active, set $resizedsidebar to join slide sidebar
			if (is_active_sidebar( 'sidebar-1' ) && (intval(asalah_option('asalah_site_width')) < 701) && (asalah_cross_option('asalah_sidebar_position', $asalah_blogpage_id) != 'none')) {
				$resizedsidebar = true;
			}

			// Based on prev sidebar conditions
			if ( $slidesidbar || $resizedsidebar ) :
			?>
				<!-- Body overlay when slide sidebar is open -->
				<div class="sliding_close_helper_overlay"></div>
				<div class="site_side_container <?php if (asalah_cross_option('asalah_sticky_menu', $asalah_blogpage_id) == 'yes') { echo 'sticky_sidebar';}?>">
					<!-- screen-reader-text for sliding sidebar section -->
					<h3 class="screen-reader-text"><?php _e('Sliding Sidebar', 'writing') ?></h3>
					<!-- Start slide sidebar wrapper .info_sidebar -->
					<div class="info_sidebar">
						<?php if ($slidesidbar) dynamic_sidebar( 'sidebar-2' ); ?>
						<?php if ($resizedsidebar) dynamic_sidebar( 'sidebar-1' ); ?>
					</div><!-- end .info_sidebar -->

				</div> <!-- end site side container .site_side_container -->
			<?php endif; ?>
		</div><!-- #page .site -->

		<!-- show cookies notice -->
		<?php if (asalah_option('writing_show_cookies_notice')): ?>
		<div class="writing_cookies_notice_jquery_container">
			<?php if (is_customize_preview()) {
				$cookies_text = asalah_option('writing_cookies_description_text') ? asalah_option('writing_cookies_description_text') : __('This site uses cookies so that we can remember you and understand how you use our site.You can change this message and links below in your site.', 'writing');
				$cookies_link_text = asalah_option('writing_cookies_links_text') ? asalah_option('writing_cookies_links_text') : __('<span class="cookies_accept_links">Please read our <a href = "#">Cookies </a> &amp; <a href="#">Privacy</a> policies</span>', 'writing');
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
								<span class="cookies_accept_links"><?php echo $cookies_link_text;; ?></span>
							<?php endif; ?>

							<span class="cookies_accept_button"><?php esc_attr_e('I Agree', 'writing'); ?></span>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php endif; ?>

		<?php wp_footer();
		// Get Custom Footer Code
		if (asalah_option('asalah_custom_footer_code')) {
			echo asalah_option('asalah_custom_footer_code');
		} ?>
	</body>
</html>