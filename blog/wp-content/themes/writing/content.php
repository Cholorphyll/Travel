<?php
// get id of page that loads content
global $asalah_blogpage_id;

// get ajax id if content is loaded via ajax, otherwise get page id
if (isset($ajaxpost_id)) {
	$page_id = $ajaxpost_id;
} else if (isset($asalah_blogpage_id) && $asalah_blogpage_id != '') {
	$page_id = $asalah_blogpage_id;
} else {
	$page_id = get_the_ID();
}

// set blog style
$blog_style = $asalah_setting_blog_style = 'default';
if (asalah_cross_option('asalah_blog_style', $page_id)) {
	$blog_style = $asalah_setting_blog_style = asalah_cross_option('asalah_blog_style', $page_id);
}

/* For Featured post layout, if first page,
set post count $banner_featured_count to 0 to make first post featured,
otherwise set post count $banner_featured_count to 1.
*/
if ($blog_style == 'banner_grid' || $blog_style == 'banner_list') {
	if ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} elseif ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} else {
		$paged = 1;
	}

	if ( $paged == 1) {
		$banner_featured_count = 0;
	} else {
		$banner_featured_count = 1;
	}
}

// set blog thumbnail size
$blog_thumbnail_size = 'full_blog';
if (is_active_sidebar( 'sidebar-1' ) && asalah_option('asalah_banners_devices_size')) {
	if (isset($asalah_blogpage_id) && (asalah_cross_option('asalah_sidebar_position', $page_id) != 'none')) {
		if (is_single() || is_page()) {
			$blog_thumbnail_size = 'single_full_blog_sidebar';
		} else {
			$blog_thumbnail_size = 'full_blog_sidebar';
		}
	} else {
		if (asalah_option('asalah_sidebar_position') != 'none') {
			$blog_thumbnail_size = 'full_blog_sidebar';
		}
	}
}

if ($blog_style == 'masonry' ) {
	$blog_thumbnail_size = 'masonry_blog';
}elseif ($blog_style == 'list') {
	$blog_thumbnail_size = 'list_blog';
}

// uncrop blog banner if set
if (asalah_option('asalah_blog_image_crop') == 'no') {
	if ($blog_style == 'masonry') {
		$blog_thumbnail_size = 'uncrop_masonry_blog';
	} else if ($blog_style == 'list') {
		$blog_thumbnail_size = 'uncrop_list_blog';
	} else {
		$blog_thumbnail_size = '';
	}
}

// uncrop blog gallery if set
if (asalah_option('asalah_blog_gallery_crop') == 'no' && (!get_the_post_thumbnail() && get_post_format() == 'gallery')) {
	if ($blog_style == 'masonry') {
		$blog_thumbnail_size = 'uncrop_masonry_blog';
	} else {
		$blog_thumbnail_size = '';
	}
}

// uncrop single banner if set
if (asalah_option('asalah_single_thumb_crop') == 'no') {
	if ((is_page() && !is_page_template( 'blog' ))) {
		$blog_thumbnail_size = '';
	}
}

// set excerpt limit if not set by user
if ( asalah_cross_option('asalah_post_excerpt_limit') == '') {
	$excerpt_limit = 80;
	if ($blog_style == 'masonry' ) {
			$excerpt_limit = 30;
	} elseif ($blog_style == 'list') {
			$excerpt_limit = 36;
			if ( (asalah_cross_option('asalah_sidebar_position', $page_id) != 'none') ) {
				$excerpt_limit = 25;
			}
	}
}	else {
	// get excerpt limit set by user
	$excerpt_limit = asalah_cross_option('asalah_post_excerpt_limit');
} // end condition excerpt limit


// Set article tag and class
$article_tag = 'article';
$article_class = 'blog_post_container';
if (is_single() || is_page() ) {
	$article_tag = 'div';
}

// start loop
while ( have_posts() ) : the_post();

	if (!is_single() && !is_page()) {
		// Set Featured post grid layout variables based on posts count
		if ( $asalah_setting_blog_style  == 'banner_grid') {
				// value 0 means first post, if true, set Featured post variables
				if ($banner_featured_count === 0) {
					// Set default  featured post excerpt limit if no excerpt limit set by user
					if ( asalah_cross_option('asalah_post_excerpt_limit') == '') {
						$excerpt_limit = 80;
					}

					$blog_thumbnail_size = 'full_blog';
					$blog_style = 'banners';
					$article_class = 'blog_post_container blog_style_featured_first';

					// Increase post count to skip first post
					$banner_featured_count++;
				} else {
					// Set default  featured post excerpt limit if no excerpt limit set by user
					if ( asalah_cross_option('asalah_post_excerpt_limit') == '') {
						$excerpt_limit = 30;
					}

					$blog_thumbnail_size = 'masonry_blog';
					$blog_style = 'masonry';
					$article_class = 'blog_post_container blog_style_featured_other';
				} // end condition $banner_featured_count

		} // end condition Featured post grid layout variables

		// Set Featured post list layout variables based on posts count
		if ($asalah_setting_blog_style  == 'banner_list') {
			// value 0 means first post, if true, set Featured post variables
			if ($banner_featured_count === 0) {

				// Set default featured post excerpt limit if no excerpt limit set by user
				if ( asalah_cross_option('asalah_post_excerpt_limit') == '') {
					$excerpt_limit = 80;
				}

				$blog_thumbnail_size = 'full_blog';
				$blog_style = 'banners';
				$article_class = 'blog_post_container blog_style_featured_first';

				// Increase post count to skip first post
				$banner_featured_count++;
			} else {
				// Set default featured post excerpt limit if no excerpt limit set by user
				if ( asalah_cross_option('asalah_post_excerpt_limit') == '') {
					$excerpt_limit = 36;
				}

				$blog_thumbnail_size = 'list_blog';
				$blog_style = 'list';
				$article_class = 'blog_post_container blog_style_featured_other';
			} // end condition $banner_featured_count
		} // end condition Featured post list layout variables
	}
	?>
	<<?php echo esc_attr($article_tag); ?> id="post-<?php the_ID(); ?>" <?php post_class($article_class); ?> >

		<?php // show page title on single page if not hidden
		if (is_page() && asalah_cross_option('asalah_show_title') != 'no') {
			if (asalah_cross_option('asalah_plain_page_title') === 'yes') {
				?>
				<div class="blog_post_title">
					<?php the_title( '<h1 class="entry-title title post_title">', '</h1>' ); ?>
				</div>
				<?php
			} else {
				?>
					<header class="page-header page_main_title clearfix">
					<?php the_title( '<h1 class="entry-title title post_title">', '</h1>' ); ?>
					</header><!-- .page-header -->
				<?php

			}
		}


		// Hidden shcema data (date, author) to avoid Google Webmaster errors, data that are hidden  from  users are shown to  bots
		if ((asalah_cross_option('asalah_show_meta') == 'no') ||
				(asalah_cross_option('asalah_show_author') == 'no') ||
				(asalah_cross_option('asalah_show_date') == 'no')
			 ) {
		?>
			<div class="asalah_hidden_schemas" style="display:none;">
				<?php

				// Date hidden data
				if (asalah_cross_option('asalah_show_date') == 'no' || asalah_cross_option('asalah_show_meta') == 'no') {

					$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

					if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
						$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
					}

					$time_string = sprintf( $time_string,
																	esc_attr( get_the_date( 'c' ) ),
																	get_the_date()
																);

					printf( '<span class="blog_meta_item blog_meta_date"><span class="screen-reader-text"></span>%1$s</span>', $time_string );

				} // end date hidden data condition

				// Author hidden data
				if (asalah_cross_option('asalah_show_author') == 'no' || asalah_cross_option('asalah_show_meta') == 'no') {

					printf( '<span class="blog_meta_item blog_meta_author"><span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span></span>',
									esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
									get_the_author()
								);

				} // end author hidden data condition
				?>
			</div><!-- end asalah_hidden_schemas-->
		<?php
		} // end hidden schemas condition

		// start post content
		?>
		<div class="blog_post clearfix<?php if (!get_the_post_thumbnail() && get_post_format() == '') { echo ' post_has_no_thumbnail';} ?>">
		<?php
		/* if blog style is masonry bring post thumbnail before post title */
		if ( !is_single() ) {
			if ($blog_style == 'masonry') {
				asalah_blog_post_banner($blog_thumbnail_size);
			} elseif ( $blog_style == 'list' || $blog_style == 'banners' ) {
				?>
				<div class="posts_list_wrapper clearfix">
					<?php if (get_the_post_thumbnail() || get_post_format() !== '') { ?>
						<div class="post_thumbnail_wrapper">
							<?php // if blog style isn't masonry
							if ($blog_style == "banners")  {
								asalah_blog_post_banner($blog_thumbnail_size);
							}else{
								asalah_post_thumbnail($blog_thumbnail_size);
							}
							?>
						</div><!-- end post_thumbnail_wrapper -->
					<?php } ?>
					<div class="post_info_wrapper"> <!-- use this wrapper in list style only to group all info far from thumbnail wrapper -->
			<?php
			} // end condition blog style for thumbnail
		} // end condition single for thumbnail blog


		// add banner before title at single if asalah_single_title_above_featured is false, default
		if ( ! asalah_cross_option('asalah_single_title_above_featured')) {
			if ( is_single() && (get_post_format() !== false || asalah_option('asalah_show_banner_standard')) ) {
				asalah_blog_post_banner();
			}
		}

		// add title at single if not hidden
		if (!is_page()) : ?>
			<div class="blog_post_title">
				<?php
				if ( is_single() ) :
					if ( asalah_cross_option('asalah_show_title') != 'no' && asalah_cross_option('asalah_show_single_post_title') != 'no'):
						the_title( '<h1 class="entry-title title post_title">', '</h1>' );
					endif;
				else :
					the_title( sprintf( '<h2 class="entry-title title post_title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
				endif;
				?>
			</div><!-- end blog_post_title -->
		<?php endif;

		// add meta after title if not hidden
		if (asalah_cross_option('asalah_show_meta') != 'no'): ?>
			<div class="blog_post_meta clearfix">
				<?php
				asalah_post_meta();
				edit_post_link( __( 'Edit', 'writing' ), '<span class="blog_meta_item edit_link">', '</span>' );
				?>
			</div>
		<?php endif;

		/* if blog style is not masonry put post thumbnail after title and meta */
		if ( !is_single() && $blog_style == 'default' ) {
			asalah_blog_post_banner($blog_thumbnail_size);
		}

		// add banner after title if asalah_single_title_above_featured is true
		if (asalah_cross_option('asalah_single_title_above_featured')) {
			if ( is_single() && (get_post_format() != false || asalah_option('asalah_show_banner_standard')) ) {
				asalah_blog_post_banner('', 'undertitle');
			}
		}

		// share icons state, glabal and page and single options
		$share_icons_visible = true;

		// global share icons state
		if (asalah_cross_option('asalah_show_share') == 'no') {
			$share_icons_visible = false;
		}

		// single page share icons state
		if (is_single()) {

			// global single page share icons state
			if (asalah_cross_option('asalah_single_show_share') == 'no') {
				$share_icons_visible = false;
			} else if (asalah_cross_option('asalah_single_show_share') == 'yes') {
				$share_icons_visible = true;
			}

			// specific single page share icons state
			if (asalah_post_option('asalah_show_share') == 'no') {
				$share_icons_visible = false;
			} else if (asalah_post_option('asalah_show_share') == 'yes') {
				$share_icons_visible = true;
			}
		}

		// check share icons state
		if ($share_icons_visible):

			// check if share icons set to show before content
			if ( is_singular('post') && (((asalah_cross_option('asalah_share_position') == "before_content") || (asalah_cross_option('asalah_share_position') == "after_before_content"))) ):
				$share_class = 'share_above_content';

				// if share icons under featured image
				if (asalah_cross_option('asalah_single_title_above_featured') == true) {
					$share_class .= " thumb_above";
				}
				echo "<div class='".$share_class."'>";
					asalah_post_share();
				echo "</div>";
			endif; // end condition share icons set to show before content
		endif; // end condition share icons state

		// start post content/excerpt
		?>
			<?php
			if (is_single() || is_page()):
				?><!-- Start entry-content div -->
				<div class="entry-content blog_post_text blog_post_description">
				<?php
				/* translators: %s: Name of current post */
				the_content( sprintf(
															__( 'Continue reading %s', 'writing' ),
															the_title( '<span class="screen-reader-text">', '</span>', false )
														)
													);

				wp_link_pages( array(
															'before'      => '<div class="page-links clearfix">',
															'after'       => '</div>',
															'link_before' => '<span>',
															'link_after'  => '</span>',
															'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'writing' ) . ' </span>%',
															'separator'   => '<span class="screen-reader-text">, </span>',
														)
													);
					?>
				</div><!-- end entry-content div -->
					<?php
			else:
			 	// Show Post description
				if (asalah_cross_option('asalah_post_content_show') != 'no') {
					// set content variable
					$asalah_content = '';
					$paragraph_wrapper = false;
						//  If post excerpt not set to disabled, default case
						if (asalah_cross_option('asalah_post_excerpt') != "disabled"):
								// check if post has custom excerpt
								if (asalah_post_option('asalah_custom_description', get_the_ID()) != '') {

									// Get post custom excerpt with formatting and applying shortcodes written
									$asalah_content .= do_shortcode(wp_specialchars_decode(asalah_post_option('asalah_custom_description', get_the_ID())));

									// add continue reading button
									$asalah_content .= asalah_more_link('', '');
									$paragraph_wrapper = true;
								} // post doesn't have custom excerpt, but format excerpt is enabled
								else if (asalah_option('asalah_post_with_formatting') == 'yes') {

									// excecute excerpt html code
									$asalah_content = asalah_excerpt_with_format($excerpt_limit);
								} // post doesn't have custom excerpt nor formating excerpt option asalah_post_with_formatting enabled
								else {

									// get default excerpt without formatting
									$asalah_content = asalah_excerpt($excerpt_limit);
									$paragraph_wrapper = true;
								}

						// If post excerpt disabled
						else:
								// get full post content with formatting if enabled
								if (asalah_option('asalah_post_with_formatting') == 'yes') {

									/* get content with formatting and add it to variable,
									** ob_start & other functions are used to avoid echoing content and
									** enable checking content for <!-- more --> tag */
									ob_start();
										the_content();
										$asalah_content = ob_get_contents();
									ob_end_clean();

									// check if content contains <!-- more --> tag
									if (strpos($asalah_content, '<!--more-->')) {

										// add continue reading button if full content at blog contains <!-- more -->
										$asalah_content .= asalah_more_link('' , '');
									}
								} // get full post content without formatting, Default case
								else {
									$asalah_content = get_the_content();
								} // end checking content format setting
						endif; // end condition checking post excerpt asalah_post_excerpt setting
						if ($asalah_content != '') {
							?>
							<div class="entry-content blog_post_text blog_post_description"><!-- Start entry-content div -->
							<?php
								if ($paragraph_wrapper) {
									echo '<p>' . $asalah_content . '</p>';
								} else {
									echo $asalah_content;
								}
							?>
						</div><!-- end entry-content div -->
							<?php
						}
				} // end post description
			endif;
			?>

		<?php // check if blog style is not masonry, then check if readmore button or share enabled to start blog_post_control div
		if (($blog_style !== 'masonry') && (asalah_cross_option('asalah_cont_read_show') != 'no') || $share_icons_visible) {
		?>
			<div class="blog_post_control clearfix">

				<?php
				if (!is_single() && !is_page()) {
					// check if continue Reading button isn't disabled, default case is enabled
					if (asalah_cross_option('asalah_cont_read_show') != 'no') {

						// check in case content existed it contains more link
						if (!isset($asalah_content) || (isset($asalah_content) && strpos($asalah_content, 'class="more_link more_link_dots"') != false)) { ?>

							<?php // get continue reading text
							$readmore_text = (asalah_cross_option('asalah_cont_read_text')) ? __(asalah_cross_option('asalah_cont_read_text'), 'writing') : __('Continue Reading', 'writing') ; ?>
							<div class="blog_post_control_item blog_post_readmore">
								<?php echo sprintf( '<a href="%1$s" class="read_more_link">%2$s</a>', esc_url( get_permalink() ), $readmore_text ); ?>
							</div><!-- end .blog_post_readmore -->
						<?php
						} // end condition check in case content existed it contains more link
						?>
					<?php
					} // end condition if continue Reading button isn't disabled
				}
				$post_id = get_the_ID();

				// check share icons state
				if ($share_icons_visible && ((asalah_cross_option('asalah_share_position') != "before_content") || ((asalah_cross_option('asalah_share_position') == "before_content") && !is_singular()))):
					if ( is_single() || is_page() || ($blog_style !== 'masonry') ):
						asalah_post_share();
					endif;
				endif; ?>
			</div><!-- end blog_post_control -->
		<?php
		} // end check if readmore button or share enabled to start blog_post_control div

		// if blog style is list or banners first
		if ( !is_single() && ( $blog_style == 'list' || $blog_style == 'banners' ) ) { ?>
			</div> <!-- .post_info_wrapper close post_info_wrapper in cas of list style-->
			</div> <!-- .posts_list_wrapper -->
		<?php
		} // end condition if blog style is list or banners first
		?>

		</div><!-- end blog_post -->
	</<?php echo esc_attr($article_tag); ?>><!-- end #post-## blog_post_container-->
	<?php
endwhile;
?>
