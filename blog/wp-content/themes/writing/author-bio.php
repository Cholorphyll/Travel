<?php
// Check if avatar is available
$email = get_the_author_meta( 'user_email' );
if (get_avatar( $email, 80 ) != '') {
	$author_avatar = asalah_filter_lazyload_images(get_avatar( $email, 80));
}
$author_profile_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
 ?>
<div class="author_box author-info<?php if (isset($author_avatar)) { echo ' has_avatar';}?>">

	<?php if (isset($author_avatar)) { ?>
		<div class="author-avatar">
			<a class="author-link" href="<?php echo esc_url($author_profile_url); ?>" rel="author">
			<?php
				echo $author_avatar;
			?>
			</a>
		</div><!-- .author-avatar -->
	<?php } ?>

	<div class="author-description author_text">

		<h3 class="author-title">
			<a class="author-link" href="<?php echo esc_url($author_profile_url); ?>" rel="author">
			<?php echo get_the_author(); ?>
			</a>
		</h3>

		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
		</p><!-- .author-bio -->

			<?php
				$social_icons_list = '';

				global $social_networks;

		    foreach ($social_networks as $network => $social ) {
		        $icon = $network;
		        if (get_the_author_meta($network) != "") {
		            $social_url = get_the_author_meta($network);
								if ($network == 'envelope') {
									$social_url = 'mailto:'.antispambot($social_url);
								} else if ($network == 'url') {
									$icon = 'globe';
								} else if ($network == 'facebook') {
									if (!strrpos($social_url, 'facebook.com') && !strrpos($social_url, 'fb.com')) {
										$social_url = "https://facebook.com/". $social_url;
									}
								} else if ($network == 'twitter') {
									if (!strrpos($social_url, 'twitter.com') && !strrpos($social_url, 'twt.com')) {

										if (strpos($social_url, '@')) {
											$social_url = str_replace('@', '', $social_url);
										} else {
											$social_url = $social_url;
										}
										$social_url = 'https://twitter.com/'.$social_url;
									}
								} else {
									$social_url =  esc_url($social_url);
								}
		            $social_icons_list .= '<a rel="nofollow noreferrer" target="_blank" href="'.$social_url.'" title="'.$social.'" class="social_icon social_' . $network . ' social_icon_' . $network . '"><i class="fa fa-' . $icon . '"></i></a>';
		        }
		    }

				// Website
				if ($url_link = get_the_author_meta('url')) {
					$social_icons_list .= '<a rel="nofollow noreferrer" href="'. esc_url($url_link) .'" target="_blank" class="social_icon social_url social_icon_url" ><i class="fa fa-globe"></i></a>';
				}

				// Social Icons List if any exists
				if ($social_icons_list != '') {
					echo '<div class="social_icons_list">'.$social_icons_list.'</div>';
				}
			?>
	</div><!-- .author-description -->
</div><!-- .author-info -->
