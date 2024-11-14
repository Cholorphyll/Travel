<?php
/*
 * Template Name: Blog Page
 */
get_header();

// add option to classes to avoid the need of resetting the query in after query
global $asalah_blogpage_id;
global $banner_grid_first_post_id;
$asalah_blogpage_id = (!isset($asalah_blogpage_id)) ? get_the_ID() : $asalah_blogpage_id;
$sidebar_postition = asalah_cross_option('asalah_sidebar_position', $asalah_blogpage_id);
$sidebar_class = asalah_sidebar_class($asalah_blogpage_id);
?>
    <h4 class="page-title screen-reader-text"><?php _e( 'Blog Posts', 'writing' ); ?></h4>
    <main class="main_content <?php echo asalah_content_class($asalah_blogpage_id); ?>">

        <!-- For Page Pagination -->
        <?php
        $args = array('post_type' => 'post');
        if ( get_query_var('paged') ) {
            $paged = get_query_var('paged');
        } elseif ( get_query_var('page') ) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        $args['paged'] = $paged;

        // Assign Category to show
        if (asalah_post_option('asalah_blog_page_cat') != '') {
          $args['cat'] = asalah_post_option('asalah_blog_page_cat');
        }

        // Assign Number of Posts to show
        if (asalah_post_option('asalah_blog_page_posts_number') != '') {
            $posts_per_page = asalah_post_option('asalah_blog_page_posts_number');
        } else {
          $posts_per_page = get_option('posts_per_page');
        }

        // Adjust Posts to show number if Featured Post layout is used
        if (asalah_cross_option('asalah_blog_style', $asalah_blogpage_id) == 'banner_grid' || asalah_cross_option('asalah_blog_style', $asalah_blogpage_id) == 'banner_list') {
          if ($paged == 1) {
            $posts_per_page = $posts_per_page + 1;
          } else {
    				$paged_offset = (1) + ( ($paged - 1) * $posts_per_page );
    				$args['offset'] = $paged_offset;
    			}
        }
        $args['posts_per_page'] = $posts_per_page;

        $wp_query = new WP_Query($args);

        if ( have_posts() ) :
            $current_page_id = $post->ID;
            ?>

            <div class="blog_posts_wrapper blog_posts_list clearfix <?php echo asalah_blog_class($asalah_blogpage_id); ?>">
                <?php
                get_template_part( 'content', get_post_format() );

                // Add Ajax div load if pagination style is ajax
                if (asalah_cross_option('asalah_pagination_style', $asalah_blogpage_id) == 'ajax') { ?>
                  <div class="ajax_content_container"></div>
                <?php } ?>
            </div> <!-- .blog_posts_wrapper -->

            <?php
            // get totalpages count if ajax pagination is used
            $totalpages = '';
            if (asalah_cross_option('asalah_pagination_style', $asalah_blogpage_id) == 'ajax') {
              $totalpages = $wp_query->max_num_pages;
            }

            // Add Page Pagination
            asalah_pagination($current_page_id, $totalpages);

        else :
            get_template_part( 'content', 'none' );
        endif;
				wp_reset_query();
        ?>
    </main><!-- .main_content -->
    <?php if ($sidebar_postition != 'none' ): ?>
      <?php // Show Sidebar only if site width less than 701
      if (!(asalah_option('asalah_site_width')) || !(asalah_option('asalah_site_width') < 701)) { ?>
        <aside class="side_content widget_area <?php echo esc_attr($sidebar_class); ?>">
            <?php get_sidebar(); ?>
        </aside>
      <?php } ?>
    <?php endif; ?>

<?php get_footer(); ?>