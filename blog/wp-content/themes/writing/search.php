<?php
get_header();

// start main content area ?>
<main class="main_content search_page_content <?php echo asalah_default_content_class(); ?>">

	<header class="page-header page_main_title clearfix">
		<h1 class="page-title title"><?php printf( __( 'Search Results for: %s', 'writing' ), get_search_query() ); ?></h1>
	</header><!-- .page-header -->

	<?php if ( have_posts() ) : ?>

		<div class="blog_posts_wrapper blog_posts_list clearfix <?php echo asalah_blog_class(); ?>">
			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif;

			get_template_part( 'content', get_post_format() );
			if (asalah_option('asalah_pagination_style') == 'ajax') { ?>
				<div class="ajax_content_container"></div>
			<?php }
			?>
		</div> <!-- .blog_posts_wrapper -->

		<?php
		$totalpages = '';
		if (asalah_option('asalah_pagination_style') == 'ajax') {
			$totalpages = $wp_query->max_num_pages;
		}
		asalah_pagination('', $totalpages);

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
// end side content area
get_footer(); ?>