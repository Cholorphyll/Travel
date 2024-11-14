<?php
get_header();
?>
<?php // Check if 404 widget area is available to set main content class
if ( is_active_sidebar( 'sidebar-3' ) ) :
	$main_content_class = 'col-md-6';
else:
	$main_content_class = 'col-md-12';
endif;
?>
<?php // start main content area ?>
<main class="main_content 404_page <?php echo esc_attr($main_content_class); ?>">
	<header class="page-header page_header_404 page_404_main_title clearfix">
		<h1 class="page-title page_title_404 title"><?php _e( '404', 'writing' ); ?></h1>
	</header><!-- .page-header -->

	<div class="content_wrapper_404">
		<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'writing' ); ?></p>
		<?php get_search_form(); ?>
	</div><!-- end content_wrapper_404 -->
</main><!-- .main_content -->
<?php // end main content area ?>

<?php // Start 404 sidebar content if exists
if ( $main_content_class == 'col-md-6' ) :
?>
<aside class="side_content side_content_404 widget_area_404 widget_area col-md-6">
	<h3 class="screen-reader-text"><?php _e('404 Page Sidebar', 'writing') ?></h3>
	<?php dynamic_sidebar( 'sidebar-3' ); ?>
</aside><!-- end site side container .site_side_container -->
<?php
endif; // End 404 sidebar content if exists
?>

<?php get_footer(); ?>