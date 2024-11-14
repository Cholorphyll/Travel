<?php
get_header(); ?>

	<main class="main_content archive_page_content <?php echo asalah_default_content_class(); ?>">

		<header class="page-header page_main_title clearfix">
			<?php
				the_archive_title( '<h1 class="page-title title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description"><span class="archive_arrow">&#8594;</span>', '</div>' );
			?>
		</header><!-- .page-header -->
		<?php
			$post_format = get_query_var('post_format');
			$args = array('post_type' => 'post');
			$args['post_format'] = $post_format;
			if ( get_query_var('paged') ) {
					$paged = get_query_var('paged');
			} elseif ( get_query_var('page') ) {
					$paged = get_query_var('page');
			} else {
					$paged = 1;
			}

			$args['paged'] = $paged;

			if (asalah_cross_option('asalah_media_template_layout') == 'media_lib') {
				$posts_per_page = get_option('posts_per_page');
			} else {
				$posts_per_page = get_option('posts_per_page');
				if (asalah_cross_option('asalah_blog_style') == 'banner_grid' || asalah_cross_option('asalah_blog_style') == 'banner_list') {
					if ($paged == 1) {
						$posts_per_page = $posts_per_page + 1;
					} else {
						$paged_offset = (1) + ( ($paged - 1) * $posts_per_page );
						$args['offset'] = $paged_offset;
					}
				}
			}
			$args['posts_per_page'] = $posts_per_page;

			$wp_query = new WP_Query($args);

		 if ( have_posts() ) : ?>

			<div class="blog_posts_wrapper blog_posts_list clearfix <?php if (asalah_cross_option('asalah_media_template_layout') == 'media_lib') { echo 'masonry_blog_style'; } else { echo asalah_blog_class(); }?>">
				<?php if ( is_home() && ! is_front_page() ) : ?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
				<?php endif;

				get_template_part( 'content-post-format' );
				if (asalah_cross_option('asalah_pagination_style', $id) == 'ajax') { ?>
					<div class="ajax_content_container"></div>
				<?php }
				?>
			</div> <!-- .blog_posts_wrapper -->

			<?php
			$totalpages = '';
			$totalpages = $wp_query->max_num_pages;
			if (asalah_cross_option('asalah_pagination_style', $id) == 'ajax') {
				$totalpages = $wp_query->max_num_pages;
			}
			asalah_pagination($id,$totalpages);

		else :
			get_template_part( 'content', 'none' );

		endif;

		?>
	</main><!-- .main_content -->

	<?php if ((asalah_option('asalah_sidebar_position') != 'none')):
		if (!(asalah_option('asalah_site_width')) || !(asalah_option('asalah_site_width') < 701)) { ?>
			<aside class="side_content widget_area <?php echo asalah_default_sidebar_class(); ?>">
				<?php get_sidebar(); ?>
			</aside>
		<?php }
	endif;

	get_footer(); ?>