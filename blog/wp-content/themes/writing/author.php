<?php
get_header();
?>
<?php // start main content area ?>
<main class="main_content archive_page_content <?php echo asalah_default_content_class(); ?>">

	<header class="page-header page_main_title clearfix">
		<?php
			the_archive_title( '<h1 class="page-title title">', '</h1>' );
			if (asalah_option('asalah_show_author_info_page') != 'yes') {
				the_archive_description( '<div class="taxonomy-description"><span class="archive_arrow">&#8594;</span>', '</div>' );
			}
		?>
	</header><!-- .page-header -->
	<?php
		// Show Author Bio if set
		if (asalah_option('asalah_show_author_info_page') == 'yes') {
			get_template_part( 'author', 'bio' );
		}

	if ( have_posts() ) : ?>

		<div class="blog_posts_wrapper blog_posts_list clearfix <?php echo asalah_blog_class(); ?>">
			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<p class="page-title screen-reader-text"><?php single_post_title(); ?></p>
				</header>
			<?php endif;

			get_template_part( 'content', get_post_format() );

			// Add Ajax div load if pagination style is ajax
			if (asalah_option('asalah_pagination_style') == 'ajax') { ?>
				<div class="ajax_content_container"></div>
			<?php }
			?>
		</div> <!-- .blog_posts_wrapper -->

		<?php
		// get totalpages count if ajax pagination is used
		$totalpages = '';
		if (asalah_option('asalah_pagination_style') == 'ajax') {
			$totalpages = $wp_query->max_num_pages;
		}
		asalah_pagination('',$totalpages);

	else :
		get_template_part( 'content', 'none' );
	endif;

	?>
</main><!-- .main_content -->
<?php // end main content area

// start side content area
// check if sidebar position not set to none
if ((asalah_option('asalah_sidebar_position') != 'none') ):

	// Show Sidebar only if site width less than 701
	if (!(asalah_option('asalah_site_width')) || !(asalah_option('asalah_site_width') < 701)) {
	?>
		<aside class="side_content widget_area <?php echo asalah_default_sidebar_class(); ?>">
			<?php get_sidebar(); ?>
		</aside>
	<?php
	} // end condition Show Sidebar only if site width less than 701


endif; // end sidebar position condition
?>
<?php // end side content area ?>
<?php get_footer(); ?>