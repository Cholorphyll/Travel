<?php
get_header();
global $asalah_blogpage_id;
$asalah_blogpage_id = get_the_ID();
?>

<?php // start main content area ?>
<main class="main_content <?php echo asalah_content_class(); ?>">
	<!-- Start blog single wrapper div -->
	<div class="blog_posts_wrapper blog_single blog_page_single">

	<?php
		get_template_part( 'content', get_post_format() );

		if (asalah_cross_option('show_author_box') != 'no') {
			get_template_part( 'author', 'bio' );
		}

		if (asalah_post_option('asalah_enable_facebook_comments') === 'yes'):
			asalah_post_facebook_comments();
		endif;

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	?>

	</div><!-- .blog_posts_wrapper -->
</main><!-- .main_content -->
<?php // end main content area ?>

<?php // start side content area ?>
<?php // check if sidebar position not set to none
if ((asalah_cross_option('asalah_sidebar_position') != 'none') && is_active_sidebar( 'sidebar-1' )):
?>
	<?php // Show Sidebar only if site width larger than 701
	if (!(asalah_option('asalah_site_width')) || !(asalah_option('asalah_site_width') < 701)) {
	?>
		<aside class="side_content widget_area <?php echo asalah_sidebar_class(); ?>">
			<?php get_sidebar(); ?>
		</aside>
	<?php
} // end condition Show Sidebar only if site width larger than 701
	?>
<?php
endif; // end sidebar position condition
?>
<?php // end side content area ?>
<?php get_footer(); ?>