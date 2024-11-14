<?php
get_header(); ?>

<!-- Title screen-reader-text -->
<h4 class="page-title screen-reader-text"><?php _e( 'Blog Posts', 'writing' ); ?></h4>

<?php // start main content area ?>
<main class="main_content <?php echo asalah_default_content_class(); ?>">

	<?php if ( have_posts() ) : ?>

		<div class="blog_posts_wrapper blog_posts_list clearfix <?php echo asalah_blog_class(); ?>">

			<?php

			get_template_part( 'content', get_post_format() );

			if (asalah_cross_option('asalah_pagination_style', $id) == 'ajax') { ?>
				<div class="ajax_content_container"></div>
			<?php }
			?>

		</div> <!-- .blog_posts_wrapper -->

		<?php
		$totalpages = '';
		if (asalah_cross_option('asalah_pagination_style', $id) == 'ajax') {
			$totalpages = $wp_query->max_num_pages;
		}
		asalah_pagination($id, $totalpages);

	else :
		get_template_part( 'content', 'none' );

	endif;

	?>
</main><!-- .main_content -->
<?php // end main content area ?>

<?php // start side content area ?>
<?php // check if sidebar position not set to none
if ((asalah_option('asalah_sidebar_position') != 'none') ):
?>
	<?php // Show Sidebar only if site width less than 701
	if (!(asalah_option('asalah_site_width')) || !(asalah_option('asalah_site_width') < 701)) {
	?>
		<aside class="side_content widget_area <?php echo asalah_default_sidebar_class(); ?>">
			<?php get_sidebar(); ?>
		</aside>
	<?php
	} // end condition Show Sidebar only if site width less than 701
	?>
<?php
endif; // end sidebar position condition
?>
<?php // end side content area ?>
<?php get_footer(); ?>