<?php

/********
Custom Controls
*********/
if ( class_exists( 'WP_Customize_Control' ) ) {
	class Customize_Control_Multiple_Select extends WP_Customize_Control {

		/**
		 * The type of customize control being rendered.
		 */
		public $type = 'multiple-select';

		/**
		 * Displays the multiple select on the customize screen.
		 */
		public function render_content() {

			if ( empty( $this->choices ) ) {
				return;
			}
			if (!is_array($this->value())) {
				$subset = explode(",", $this->value());
			} else {
				$subset = $this->value();
			}
			?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
					<?php
					foreach ( $this->choices as $value => $label ) {
						$selected = (in_array($value, $subset)) ? 'selected="selected"' : '';
						echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
					}
					?>
                </select>
            </label>
		<?php }
	}

	function multiselect_sanitize( $input ) {
		$valid = array(
			"all",
			"latin",
			"latin-ext",
			"vietnamese",
			"cyrillic",
			"cyrillic-ext",
			"devanagari",
			"greek",
			"greek-ext",
			"korean",
			"thai",
			"khmer",
			"arabic",
			"telugu",
			"hebrew",
			"chinese-simplified",
			"gujarati",
			"tamil",
			"japanese",
			"bengali",
			"malayalam",
			"chinese-traditional",
			"gurmukhi",
			"chinese-hongkong",
			"kannada",
			"myanmar",
			"oriya",
			"sinhala",
			"tibetan"
		);
		$output = "";
		foreach ( $input as $value ) {
			if ( in_array( $value, $valid ) ) {
				$output .= $value.",";
			} else {
				return false;
			}
		}

		return $output;
	}

	/**
	 * Text Radio Button Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
		class asalah_Text_Radio_Button_Custom_Control extends WP_Customize_Control {
	 		/**
	 		 * The type of control being rendered
	 		 */
			public $type = 'text_radio_button';
	 		/**
	 		 * Enqueue our scripts and styles
	 		 */
			public function enqueue() {
				wp_enqueue_style( 'asalah-custom-controls-css', trailingslashit( get_template_directory_uri() ) . 'css/customizer.css', array(), '1.0', 'all' );
			}
	 		/**
			 * Render the control in the customizer
			 */
			public function render_content() {
	  		?>
	 			<div class="text_radio_button_control">
	 				<?php if( !empty( $this->label ) ) { ?>
	 					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	 				<?php } ?>
	 				<?php if( !empty( $this->description ) ) { ?>
	 					<span class="customize-control-description"><?php echo wp_specialchars_decode( $this->description ); ?></span>
	 				<?php } ?>

					<div class="radio-buttons">
						<?php
						$class = 'radio-button-label';
						if (count($this->choices) > 2) {
							$class .= ' full_width_label';
						}
						foreach ( $this->choices as $key => $value ) { ?>
		 					<label class="<?php echo esc_attr($class); ?>">
		 						<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
		 						<span for="_customize-input-<?php echo esc_attr( $this->id ); ?>-radio-<?php echo esc_attr( $value ); ?>" ><?php echo esc_attr( $value ); ?></span>
		 					</label>
		 				<?php	} ?>
					</div>
					<?php if (esc_attr( $this->id ) == 'asalah_blog_style' || esc_attr( $this->id ) == 'asalah_pagination_style') { ?>
						<a class="focus_shake" href="#"> </a>
					<?php } ?>
	 			</div>
	  		<?php
  		}
  	}

		/**
		 * Slider Custom Control
		 *
		 * @author Anthony Hortin <http://maddisondesigns.com>
		 * @license http://www.gnu.org/licenses/gpl-2.0.html
		 * @link https://github.com/maddisondesigns
		*/
		class asalah_Slider_Custom_Control extends WP_Customize_Control {
			/**
			 * The type of control being rendered
			 */
			public $type = 'slider_control';
			/**
			 * Enqueue our scripts and styles
			 */
			public function enqueue() {
				wp_enqueue_script( 'skyrocket-custom-controls-js', trailingslashit( get_template_directory_uri() ) . 'js/custom-controls.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-slider' ), '1.0', true );
				wp_enqueue_style( 'skyrocket-custom-controls-css', trailingslashit( get_template_directory_uri() ) . 'css/customizer.css', array(), '1.0', 'all' );
			}
			/**
			 * Render the control in the customizer
			 */
			public function render_content() {
			?>
				<div class="slider-custom-control">
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-slider-value" <?php $this->link(); ?> />
					<div id="slider" class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"></div><span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"></span>
				</div>
			<?php
			}
		}

		/**
		 * Toggle Switch Custom Control
		 *
		 * @author Anthony Hortin <http://maddisondesigns.com>
		 * @license http://www.gnu.org/licenses/gpl-2.0.html
		 * @link https://github.com/maddisondesigns
		 */
		class asalah_Toggle_Switch_Custom_control extends WP_Customize_Control {
			/**
			 * The type of control being rendered
			 */
			public $type = 'toogle_switch';
			/**
			 * Enqueue our scripts and styles
			 */
			public function enqueue(){
				wp_enqueue_style( 'skyrocket-custom-controls-css', trailingslashit( get_template_directory_uri() ) . 'css/customizer.css', array(), '1.0', 'all' );
			}
			/**
			 * Render the control in the customizer
			 */
			public function render_content(){
			?>
				<div class="toggle-switch-control">
					<div class="toggle-switch">
						<input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?>>
						<label class="toggle-switch-label" for="<?php echo esc_attr( $this->id ); ?>">
							<span class="toggle-switch-inner"></span>
							<span class="toggle-switch-switch"></span>
						</label>
					</div>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php if( !empty( $this->description ) ) { ?>
						<span class="customize-control-description"><?php echo wp_specialchars_decode( $this->description ); ?></span>
					<?php } ?>
				</div>
			<?php
			}
		}
}
/********
Selective refresh functions
*********/

// blog name function for blog name feild
function asalah_customize_partial_blogname() {
	bloginfo( 'name' );
}

// Social icons section
function asalah_customize_partial_social_icons() {
	return asalah_social_icons_list('header_social_icons pull-left');
}

// logo wrapper section
function asalah_customize_partial_logo_wrapper() {
	ob_start();
	asalah_header_logo_wrapper();
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

// Share icons section
function asalah_customize_partial_header_avatar() {
	ob_start();
	asalah_sliding_sidebar_infoicon();
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

// Pagination section
function asalah_customize_partial_pagination() {
	ob_start();
	global $wp_query;
	// get totalpages count if ajax pagination is used
	$totalpages = '';
	if (asalah_cross_option('asalah_pagination_style') == 'ajax') {
		$totalpages = $wp_query->max_num_pages;
	}
	asalah_pagination('',$totalpages);
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

// Archive Title & Description section
function asalah_customize_partial_archive_header() {
	ob_start();
	global $wp_query;
	the_archive_title( '<h1 class="page-title title">', '</h1>' );
	if ( !(is_category() && asalah_option('asalah_cat_desc') == 'no') && !(is_tag() && asalah_option('asalah_tag_desc') == 'no')) {
		the_archive_description( '<div class="taxonomy-description"><span class="archive_arrow">&#8594;</span>', '</div>' );
	}
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

// Meta tags section
function asalah_customize_partial_meta_tags() {
	ob_start();
	asalah_post_meta();
	edit_post_link( __( 'Edit', 'writing' ), '<span class="blog_meta_item edit_link">', '</span>' );
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

// Single Page Title section
function asalah_customize_partial_single_title() {
	ob_start();
	the_title( '<h1 class="entry-title title post_title">', '</h1>' );
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

// Author Box section
function asalah_customize_partial_author() {
	ob_start();
	get_template_part( 'author', 'bio' );
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

// Posts Nav section
function asalah_customize_partial_posts_relation() {
	ob_start();
	// start related posts
	if (asalah_cross_option('asalah_show_related') != 'no') {
		asalah_single_related_posts();
	}
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

// Content for blog pages
function asalah_customize_partial_blog_style() {
	ob_start();
	?><div class="blog_posts_wrapper blog_posts_list clearfix <?php echo asalah_blog_class(); ?>"><?php
			get_template_part( 'content', get_post_format() );

			if (asalah_cross_option('asalah_pagination_style') == 'ajax') { ?>
				<div class="ajax_content_container"></div>
			<?php } ?>
		</div><?php
	$output = ob_get_contents();
	ob_end_clean();
	wp_enqueue_script('asalah-imagesloaded-script');
	wp_enqueue_script( 'asalah-gallery-script');
	return $output;
}

// Custom CSS Code
function asalah_customize_partial_custom_css_code() {
	echo asalah_style_customizer_css();
}

// Top bar partial content
function asalah_customize_partial_topbar() {

	// sticky menu
	$sticky_topbar = false;
	if (asalah_cross_option('asalah_sticky_menu') === 'yes') {
		$sticky_topbar = true;
	}
	// primary menu exists
	$primary_menu = (has_nav_menu( 'primary' )) ? true : false;

	// search hide
	$hide_header_search = asalah_cross_option('asalah_show_search_header');

	// header social list
	$social_list_icons = (asalah_social_icons_list()) ? true : false;

	// sliding sidebar info icon
	if (	// sliding sidebar enabled
				is_active_sidebar( 'sidebar-2' ) &&
		 		(asalah_cross_option('asalah_enable_sliding_sidebar') != 'no') ||
				// default sidebar enabled with low site width
				(
					(intval(asalah_option('asalah_site_width')) < 701) &&
					(asalah_option('asalah_sidebar_position') != 'none')
				)
			) {
		$sliding_icon = true;
	} else {
		$sliding_icon = false;
	}
	ob_start();
	asalah_header_topbar($sticky_topbar, $primary_menu, $social_list_icons, $sliding_icon, $hide_header_search);
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

// content for both blog and single pages
function asalah_customize_partial_blog_single_content() {
	ob_start();
	get_template_part( 'content', get_post_format() );
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
// Content for single pages
function asalah_customize_partial_single_content() {
	global $post;
	ob_start();
	?>
	<div class="blog_posts_wrapper blog_single blog_posts_single<?php if (asalah_cross_option('asalah_content_width_layout') == 'narrow') { echo ' narrow_content_width'; } ?>">
	<?php
		get_template_part( 'content', get_post_format() );

		if (asalah_cross_option('show_author_box') != 'no') {
			get_template_part( 'author', 'bio' );
		}

		$asalah_posts_not_in = array($post->ID);

		if ( asalah_option('asalah_show_posts_navigation') != 'no') {
			asalah_single_posts_navigation();
		}

		// start related posts
		if (asalah_cross_option('asalah_show_related') != 'no') {
			asalah_single_related_posts();
		}

		wp_reset_postdata();

		if (asalah_cross_option('asalah_enable_facebook_comments')):
			asalah_post_facebook_comments();
		endif;

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	?>
	</div><!-- .blog_posts_wrapper -->
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

/***
Start registering customizer controls
***/
function asalah_register_theme_customizer( $wp_customize ) {

	// Helper for rtl
	$style_direction = (is_rtl()) ? 'right' : 'left';

	// Helper functions for fonts.
	$font_choices = customizer_library_get_font_choices();
	$font_sizes = array("false"=>'Default', '10'=>'10', '12'=>'12', '14'=>'14', '16'=>'16', '18'=>'18', '20'=>'20', '22'=>'22', '24'=>'24', '26'=>'26', '28'=>'28', '30'=>'30', '32'=>'32', '34'=>'34','36'=>'36','38'=>'38','40'=>'40','45'=>'45','50'=>'50','55'=>'55','60'=>'60','65'=>'65','70'=>'70');

	// Social Share icons
	$share_buttons = array('facebook' => 'Facebook', 'twitter' => 'Twitter', 'gplus' => 'Google+', 'pinterest' => 'Pinterest', 'linkedin' => 'Linkedin', 'vk' => 'VK', 'tumblr' => 'Tumblr', 'reddit' => 'Reddit', 'pocket' => 'Pocket', 'stumbleupon' => 'Stumbleupon', 'whatsapp' => 'Whatsapp', 'telegram' => 'Telegram', 'mail' => 'Mail', 'print' => 'Print');

	// Social links
	global $social_networks;
	/* --------
	add selective refresh
	------------------------------------------- */

	/* --------
start title and tagline section title_tagline
------------------------------------------- */
function writing_sanitize_minimal_decoration( $input ) {
			$allowed_html = array(
			'a' => array(
					'href' => array(),
					'title' => array()
			),
			'br' => array(),
			'em' => array(),
			'strong' => array(),
			'img' => array(),
			'i' => array(),

	);

			return wp_kses( $input, $allowed_html );
	}

/* --------
end title and tagline section title_tagline
------------------------------------------- */

	// header social icons
	// Partial refresh
	$social_links = array();
	foreach ($social_networks as $network=>$social) {
    array_push($social_links, 'asalah_'.$network.'_url');
	}
	$wp_customize->selective_refresh->add_partial( 'asalah_facebook_url', array(
		'selector' => '.header_social_icons',
		'settings' => $social_links,
		'container_inclusive' => true,
		'render_callback' => 'asalah_customize_partial_social_icons'
	) );

	// blog name section
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.logo_wrapper .site_logo a',
		'render_callback' => 'asalah_customize_partial_blogname'
	) );

	// header avatar
	$wp_customize->selective_refresh->add_partial( 'asalah_header_avatar', array(
		'selector' => '.header_info_wrapper',
		'render_callback' => 'asalah_customize_partial_header_avatar',
		'container_inclusive' => true,
	) );

	// Logo Wrapper section
	$wp_customize->selective_refresh->add_partial( 'asalah_default_logo', array(
		'selector' => '.logo_wrapper',
		'settings' => array(
												'asalah_default_logo',
												'asalah_logo_type',
												'asalah_show_tagline',
												'asalah_default_logo_retina',
												'asalah_logo_font_type',
												'asalah_logo_font_size',
												'asalah_logo_width',
												'asalah_logo_height',
												'asalah_logo_text_t_margin',
												'asalah_logo_image_t_margin',
												'asalah_tagline_font_type',
												'asalah_tagline_font_size',
												'asalah_tagline_line_height',
												'asalah_show_tagline_under_imagelogo',
												),
		'container_inclusive' => true,
		'fallback_refresh' => true,
		'render_callback' => 'asalah_customize_partial_logo_wrapper'
	) );

	// Blog list content partial
	// blog list content only partial
	$wp_customize->selective_refresh->add_partial( 'asalah_blog_style', array(
		'selector' => '.blog .main_content .blog_posts_wrapper,
									 .archive_page_content .blog_posts_wrapper,
									 .search_page_content .blog_posts_wrapper',
		'settings' => array(
												'asalah_blog_style',
												'asalah_post_content_show',
												'asalah_post_with_formatting',
												'asalah_post_excerpt',
												'asalah_post_excerpt_limit',
												'asalah_post_excerpt_text',
												'asalah_cont_read_show',
												'posts_per_page'
											),
		'container_inclusive' => true,
		'render_callback' => 'asalah_customize_partial_blog_style',
		'fallback_refresh' => false
	) );
	//blog list options array
	$blog_list_options = array(
											'asalah_show_meta',
											'asalah_media_template_layout',
											'asalah_show_share',
											'asalah_show_categories',
											'asalah_show_tags',
											'asalah_show_date',
											'asalah_show_update_date',
											'asalah_update_date_word',
											'asalah_show_comments_number',
											'asalah_show_author',
											'asalah_hits_counter',
											'asalah_image_optimization',
											'asalah_show_banner_standard',
											'asalah_banner_blog_caption',
											'asalah_blog_image_crop',
											'asalah_blog_gallery_crop',
										);

	foreach ($share_buttons as $network=>$social) {
    array_push($blog_list_options, 'asalah_'.$network.'_share');
	}

	$wp_customize->selective_refresh->add_partial( 'asalah_show_meta', array(
		'selector' => '.blog .main_content .blog_posts_wrapper,
									 .archive_page_content .blog_posts_wrapper,
									 .search_page_content .blog_posts_wrapper,
									 .blog_posts_single > .blog_post_container',
		'settings' => $blog_list_options,
		'container_inclusive' => false,
		'render_callback' => 'asalah_customize_partial_blog_single_content',
		'fallback_refresh' => false
	) );

	// Single content partial
	$wp_customize->selective_refresh->add_partial( 'asalah_share_position', array(
		'selector' => '.single .blog_posts_single',
		'settings' => array(
													'asalah_share_position',
													'asalah_single_thumb_crop',
													'asalah_enable_custom_single_image_size',
													'asalah_single_title_above_featured',
													'show_author_box',
													'asalah_show_posts_navigation',
													'asalah_show_share_effect',
													'asalah_single_show_share',
													'asalah_show_related',
													'asalah_banner_single_caption',
													'asalah_show_single_post_title',
												),
		'container_inclusive' => true,
		'render_callback' => 'asalah_customize_partial_single_content',
		'fallback_refresh' => false
	) );

	// blog description section
	$wp_customize->selective_refresh->add_partial( 'asalah_custom_cat_start', array(
		'selector' => '.category .archive_page_content .page_main_title',
		'settings' => array(
													'asalah_custom_cat_start',
													'asalah_cat_desc',
												),
		'render_callback' => 'asalah_customize_partial_archive_header',
		'fallback_refresh' => false
	) );

	// Top bar section
	$wp_customize->selective_refresh->add_partial( 'asalah_show_search_header', array(
		'selector' => '.top_menu_wrapper',
		'settings' => array(
												'asalah_show_search_header',
												'asalah_menu_button_text',

												),
		'container_inclusive' => true,
		'render_callback' => 'asalah_customize_partial_topbar'
	) );

	$wp_customize->selective_refresh->add_partial( 'asalah_custom_tag_start', array(
		'selector' => '.tag .archive_page_content .page_main_title',
		'settings' => array(
													'asalah_custom_tag_start',
													'asalah_tag_desc',
												),
		'render_callback' => 'asalah_customize_partial_archive_header',
		'fallback_refresh' => false
	) );

	// blog description section
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.logo_tagline',
		'render_callback' => function() {
															        return get_theme_mod('blogdescription');
															       }
	) );

	// blog pagination section
	$wp_customize->selective_refresh->add_partial( 'asalah_pagination_style', array(
		'selector' => '.navigation_links, .navigation.pagination',
		'container_inclusive' => true,
		'render_callback' => 'asalah_customize_partial_pagination',
		'fallback_refresh' => false
	) );

	// footer credits
	$wp_customize->selective_refresh->add_partial( 'asalah_footer_credits', array(
		'selector' => '.second_footer_content_wrapper.footer_credits',
		'render_callback' =>function() {
															        return get_theme_mod('asalah_footer_credits');
															      } ,
	) );

	// Single Page Settings Partial Refresh

	// Posts Nav
	$wp_customize->selective_refresh->add_partial( 'asalah_relation_posts', array(
		'selector' => '.single .post_related',
		'container_inclusive' => true,
		'settings' => array(
													'asalah_relation_posts'
												),
		'render_callback' => 'asalah_single_related_posts',
		'fallback_refresh' => false
	) );

	/* --------
	add new panels and sections
	------------------------------------------- */
	/* Layout Panel */
	$wp_customize->add_panel( 'asalah_layout_panel' , array(
	    'title'      => __('Layout','writing'),
	    'priority'   => 30,
	) );

	$wp_customize->add_section( 'asalah_layout_general' , array(
	    'title'      => __('General Settings','writing'),
	    'priority'   => 20,
			'panel'			 => 'asalah_layout_panel',
	) );

	$wp_customize->add_section( 'asalah_layout_banner' , array(
	    'title'      => __('Banner/Featured Image Settings','writing'),
	    'priority'   => 20,
			'panel'			 => 'asalah_layout_panel',
	) );

	$wp_customize->add_section( 'asalah_layout_meta_tags' , array(
	    'title'      => __('Meta Tags Settings','writing'),
	    'priority'   => 20,
			'panel'			 => 'asalah_layout_panel',
	) );

	$wp_customize->add_section( 'asalah_layout_post_content' , array(
	    'title'      => __('Content Settings','writing'),
	    'priority'   => 20,
			'panel'			 => 'asalah_layout_panel',
	) );

	$wp_customize->add_section( 'asalah_layout_control_post' , array(
	    'title'      => __('Share and Continue Reading Settings','writing'),
	    'priority'   => 20,
			'panel'			 => 'asalah_layout_panel',
	) );

	$wp_customize->add_section( 'asalah_layout_single' , array(
	    'title'      => __('General Page/Post Settings','writing'),
			'description' => __('These options affects all single posts/pages, to edit one single post, you will need to edit post options.', 'writing'),
	    'priority'   => 20,
			'panel'			 => 'asalah_layout_panel',
	) );

	$wp_customize->add_section( 'asalah_layout_privacy_notice' , array(
	    'title'      => __('Privacy Notice','writing'),
	    'priority'   => 20,
			'panel'			 => 'asalah_layout_panel',
	) );

	$wp_customize->add_section( 'asalah_lazyload' , array(
			'title'      => __('Lazy Load','writing'),
			'priority'   => 20,
			'panel'			 => 'asalah_layout_panel',
	) );
	/* End Layout Panel */

	/* Start Header Panel */
	$wp_customize->add_panel( 'asalah_header_panel' , array(
	    'title'      => __('Top Bar and Header Style','writing'),
	    'priority'   => 30,
	) );

	$wp_customize->add_section( 'asalah_header_topbar' , array(
	    'title'      => __('Top Bar Style','writing'),
	    'priority'   => 20,
			'panel'			 => 'asalah_header_panel'
	) );

	$wp_customize->add_section( 'asalah_header_area' , array(
	    'title'      => __('Header Style','writing'),
	    'priority'   => 20,
			'panel'			 => 'asalah_header_panel'
	) );
	/* End Header Panel */

	/* Logo Panel */
	$wp_customize->add_panel( 'asalah_logo_panel' , array(
	    'title'      => __('Logo Style','writing'),
	    'priority'   => 30,
	) );

	$wp_customize->add_section( 'asalah_logo_general' , array(
	    'title'      => __('General Logo Settings','writing'),
	    'priority'   => 20,
			'panel'			 => 'asalah_logo_panel'
	) );

	$wp_customize->add_section( 'asalah_logo_text' , array(
	    'title'      => __('Text Logo','writing'),
			'description' => __('You can edit the <a data-control="blogname" href="#" class="asalah-custom-refresh-partial">Logo Text</a>.', 'writing'),
	    'priority'   => 20,
			'panel'			 => 'asalah_logo_panel'
	) );

	$wp_customize->add_section( 'asalah_logo_image' , array(
	    'title'      => __('Image Logo','writing'),
	    'priority'   => 20,
			'panel'			 => 'asalah_logo_panel'
	) );

	$wp_customize->add_section( 'asalah_logo_tagline' , array(
	    'title'      => __('Tagline Settings','writing'),
			'description' => __('You can customize tagline text from <a data-control="blogdescription" href="#" class="asalah-custom-refresh-partial">Site Identity</a>.', 'writing'),
	    'priority'   => 20,
			'panel'			 => 'asalah_logo_panel'
	) );
	/* End Logo Panel */

	/* Taxonomies Panel */
	$wp_customize->add_panel( 'asalah_taxonomies' , array(
		'title'      => __('Categories/Tags Settings','writing'),
		'priority'   => 30,
	) );

	$wp_customize->add_section( 'asalah_taxonomies_cat' , array(
		'title'      => __('Categories Settings','writing'),
		'priority'   => 20,
		'panel'			 => 'asalah_taxonomies',
	) );

	$wp_customize->add_section( 'asalah_taxonomies_tag' , array(
		'title'      => __('Tags Settings','writing'),
		'priority'   => 20,
		'panel'			 => 'asalah_taxonomies',
	) );

	$wp_customize->add_section( 'asalah_site_style' , array(
	    'title'      => __('General Style','writing'),
	    'priority'   => 30,
	) );

	$wp_customize->add_section( 'asalah_performance' , array(
	    'title'      => __('Performance Settings (BETA)','writing'),
	    'priority'   => 30,
	) );

	/* Typography Panel */
	$wp_customize->add_panel( 'asalah_typography_panel' , array(
	    'title'      => __('Typography','writing'),
	    'priority'   => 30,
	) );

	$wp_customize->add_section( 'asalah_typography_general' , array(
	    'title'      => __('General Typography Settings','writing'),
	    'priority'   => 20,
			'panel' 		 => 'asalah_typography_panel'
	) );

	$wp_customize->add_section( 'asalah_typography_main' , array(
	    'title'      => __('Main Typography','writing'),
	    'priority'   => 20,
			'panel' 		 => 'asalah_typography_panel'
	) );

	$wp_customize->add_section( 'asalah_typography_menu' , array(
	    'title'      => __('Menu Typography','writing'),
	    'priority'   => 20,
			'panel' 		 => 'asalah_typography_panel'
	) );

	$wp_customize->add_section( 'asalah_typography_blog_title' , array(
	    'title'      => __('Blog Title Typography','writing'),
	    'priority'   => 20,
			'panel' 		 => 'asalah_typography_panel'
	) );

	$wp_customize->add_section( 'asalah_typography_single_title' , array(
	    'title'      => __('Single Title Typography','writing'),
	    'priority'   => 20,
			'panel' 		 => 'asalah_typography_panel'
	) );

	$wp_customize->add_section( 'asalah_typography_meta' , array(
	    'title'      => __('Meta Info Typography','writing'),
	    'priority'   => 20,
			'panel' 		 => 'asalah_typography_panel'
	) );

	$wp_customize->add_section( 'asalah_typography_widgettitle' , array(
	    'title'      => __('Widgets Titles Typography','writing'),
	    'priority'   => 20,
			'panel' 		 => 'asalah_typography_panel'
	) );

	$wp_customize->add_section( 'asalah_typography_blog_content' , array(
	    'title'      => __('Blog Single Post Content Typography','writing'),
	    'priority'   => 20,
			'panel' 		 => 'asalah_typography_panel'
	) );
	$wp_customize->add_section( 'asalah_typography_blog_description' , array(
	    'title'      => __('Blog Posts Description Typography','writing'),
	    'priority'   => 20,
			'panel' 		 => 'asalah_typography_panel'
	) );

	$wp_customize->add_section( 'asalah_typography_headlines' , array(
	    'title'      => __('Headlines Typography','writing'),
	    'priority'   => 20,
			'panel' 		 => 'asalah_typography_panel'
	) );
	/* End Typography Panel */

	/* Social Panel */
  $wp_customize->add_panel( 'asalah_social_banner' , array(
      'title'      => __('Social Settings','writing'),
      'priority'   => 30,
  ) );

  $wp_customize->add_section( 'asalah_social_general' , array(
      'title'      => __('General Settings and Social API Keys','writing'),
      'priority'   => 20,
			'panel'			 => 'asalah_social_banner',
  ) );

  $wp_customize->add_section( 'asalah_social_share_list' , array(
      'title'      => __('Share Icons List','writing'),
      'priority'   => 20,
			'panel'			 => 'asalah_social_banner',
  ) );

  $wp_customize->add_section( 'asalah_social_link_list' , array(
      'title'      => __('Social Links List','writing'),
      'priority'   => 20,
			'panel'			 => 'asalah_social_banner',
  ) );

  $wp_customize->add_section( 'asalah_facebook_comments' , array(
      'title'      => __('Facebook Comments','writing'),
      'priority'   => 20,
			'panel'			 => 'asalah_social_banner',
  ) );
	/* End Social Panel */

  $wp_customize->add_section( 'asalah_custom_code' , array(
      'title'      => __('Add Header/Footer Content','writing'),
      'priority'   => 30,
  ) );

  $wp_customize->add_section( 'background_image', array(
          'title'          => __( 'Background Image', 'writing' ),
          'theme_supports' => 'custom-background',
          'priority'       => 30,
      ) );

	$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'colors' );

	/***
	Start Site Identity Section
	***/
	// Fav Icon if Wordpress Site Icon not Available
	if (!function_exists('get_site_icon_url')) {
    $wp_customize->add_setting(
	      'asalah_fav_icon',
	      array(
	          'default'     => false,
						'transport' => 'refresh',
	          'sanitize_callback' => 'esc_url',
	      )
	  );

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'asalah_fav_icon', array(
        'label'      => __('Fav Icon', 'writing'),
        'section'    => 'title_tagline',
        'settings'   => 'asalah_fav_icon',
    )));
	}

	// Footer Credits
  $wp_customize->add_setting(
      'asalah_footer_credits',
      array(
          'sanitize_callback' => 'wp_kses_post',
					'default' => '',
					'transport' => 'postMessage',
      )
  );

  $wp_customize->add_control('asalah_footer_credits', array(
      'label'      => __('Footer Credits Text', 'writing'),
      'section'    => 'title_tagline',
      'settings'   => 'asalah_footer_credits',
			'type'			 => 'textarea'
  ));
	/***
	End Site Identity Section
	***/

	/***
	Start Social Panel
	***/
  /* Default Share Thumbnail */
	$wp_customize->add_setting(
      'asalah_default_share_thumb',
      array(
          'default'     => '',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_url',
      )
  );

  $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'asalah_default_share_thumb', array(
      'label'      => __('Site Default Image for Share', 'writing'),
			'description' => ('Image to be used when sharing on social media instead of logo image (should be more than 200×200px)'),
      'section'    => 'asalah_social_general',
      'settings'   => 'asalah_default_share_thumb',
  )));

  /* Site Description for Social */
  $wp_customize->add_setting(
      'asalah_site_description',
      array(
          'sanitize_callback' => 'esc_attr',
					'transport' => 'postMessage',
      )
  );

  $wp_customize->add_control('asalah_site_description', array(
      'label'      => __('Site Description', 'writing'),
			'description'=> __('Few words about your blog to introducte it to search engines and social networks', 'writing'),
      'section'    => 'asalah_social_general',
      'settings'   => 'asalah_site_description',
			'type'			 => 'textarea'
  ));

  /* Google Tag Manager Code */
  $wp_customize->add_setting(
      'asalah_gtm_code_head',
      array(
          'sanitize_callback' => 'esc_attr',
					'transport' => 'postMessage',
      )
  );

  $wp_customize->add_control('asalah_gtm_code_head', array(
      'label'      => __('Google Tag Manager Container ID (GTM-XXXX)', 'writing'),
			'description'=> __('GTM code to insert in the website head', 'writing'),
      'section'    => 'asalah_social_general',
      'settings'   => 'asalah_gtm_code_head',
			'type'			 => 'text'
  ));

  /* Google Analytics Code */
  $wp_customize->add_setting(
      'asalah_ga_code_head',
      array(
          'sanitize_callback' => 'esc_attr',
					'transport' => 'postMessage',
      )
  );

  $wp_customize->add_control('asalah_ga_code_head', array(
      'label'      => __('Google Analytics properly ID (UA-XXXXX-Y)', 'writing'),
			'description'=> __('GTM code to insert in the website head', 'writing'),
      'section'    => 'asalah_social_general',
      'settings'   => 'asalah_ga_code_head',
			'type'			 => 'text'
  ));

	// Open Graph Meta Info
	$wp_customize->add_setting(
			'asalah_auto_open_graph',
			array(
					'default' => 'yes',
					'transport' => 'postMessage',
					'sanitize_callback' => 'esc_attr',
			)
	);

	$wp_customize->add_control(new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_auto_open_graph', array(
				'label'      => __('Generate Open Graph Data', 'writing'),
				'section'    => 'asalah_social_general',
				'settings'   => 'asalah_auto_open_graph',
				'choices'    => array(
						'yes' => __('Yes', 'writing'),
						'no' => __('No', 'writing'),
				),
		)
	));

	// Disable FB Snippet
	$wp_customize->add_setting(
			'asalah_disable_auto_fb_scripts',
			array(
					'default' => 'no',
					'transport' => 'refresh',
					'sanitize_callback' => 'esc_attr',
			)
	);

	$wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_disable_auto_fb_scripts', array(
				'label'      => __('Disable Theme\'s Facebook Scripts', 'writing'),
				'section'    => 'asalah_social_general',
				'settings'   => 'asalah_disable_auto_fb_scripts',
				'choices'    => array(
						'yes' => __('Yes', 'writing'),
						'no' => __('No', 'writing'),
				),
		)
	));

	// FB ID
	$wp_customize->add_setting(
      'asalah_fb_id',
      array(
          'sanitize_callback' => 'esc_attr',
					'transport' => 'postMessage',
      )
  );

  $wp_customize->add_control('asalah_fb_id', array(
      'label'      => __('Facebook App ID', 'writing'),
      'section'    => 'asalah_social_general',
      'settings'   => 'asalah_fb_id',
  ));

  /* twitter security keys */
	// Twitter Consumer Key
  $wp_customize->add_setting(
      'asalah_conk_id',
      array(
          'sanitize_callback' => 'esc_attr',
					'transport' => 'postMessage',
      )
  );

  $wp_customize->add_control('asalah_conk_id', array(
      'label'      => __('Twitter Consumer Key', 'writing'),
      'section'    => 'asalah_social_general',
      'settings'   => 'asalah_conk_id',
  ));

	// Twitter Consumer Secret
  $wp_customize->add_setting(
      'asalah_cons_id',
      array(
					'transport' => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control('asalah_cons_id', array(
      'label'      => __('Twitter Consumer Secret', 'writing'),
      'section'    => 'asalah_social_general',
      'settings'   => 'asalah_cons_id',
  ));

	// Twitter Access Token
  $wp_customize->add_setting(
      'asalah_at_id',
      array(
          'sanitize_callback' => 'esc_attr',
					'transport' => 'postMessage',
      )
  );

  $wp_customize->add_control('asalah_at_id', array(
      'label'      => __('Twitter Access Token', 'writing'),
      'section'    => 'asalah_social_general',
      'settings'   => 'asalah_at_id',
  ));

	// Twitter Access Token Secret
  $wp_customize->add_setting(
      'asalah_ats_id',
      array(
          'sanitize_callback' => 'esc_attr',
					'transport' => 'postMessage',
      )
  );

  $wp_customize->add_control('asalah_ats_id', array(
      'label'      => __('Twitter Access Token Secret', 'writing'),
      'section'    => 'asalah_social_general',
      'settings'   => 'asalah_ats_id',
  ));
	/* end Twitter Keys */
	/***
	End General Social Section
	***/

	/***
	Start Share Icons List Section
	***/
	/* Social Share buttons */
	$default_shown_share = array('facebook', 'twitter', 'gplus', 'linkedin', 'pinterest');
	foreach ($share_buttons as $network=>$social) {

		if (in_array($network, $default_shown_share)) {
			$show = 'yes';
		} else {
			$show = 'no';
		}

		$wp_customize->add_setting(
        'asalah_'.$network.'_share',
        array(
            'sanitize_callback' => 'esc_attr',
						'default'  => $show,
						'transport' => 'postMessage',
        )
    );

		$wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_'.$network.'_share', array(
	        'label'      => __($social.' Share', 'writing'),
	        'section'    => 'asalah_social_share_list',
	        'settings'   => 'asalah_'.$network.'_share',
	        'choices'    => array(
	            'yes' => __('Yes', 'writing'),
	            'no' => __('No', 'writing'),
	        ),
	    )
		));

	}
	/***
	End Share Icons List Section
	***/

	/***
	Start Social Links List Section
	***/
	/* social profiles */

  foreach ($social_networks as $network => $social ) {
		if ($network == 'envelope') {

		$wp_customize->add_setting(
				'asalah_'.$network.'_url',
				array(
						'transport' => 'postMessage',
						'sanitize_callback' => 'esc_attr',
				)
		);

		$wp_customize->add_control('asalah_'.$network.'_url', array(
				'label'      => $social.' URL',
				'section'    => 'asalah_social_link_list',
				'settings'   => 'asalah_'.$network.'_url',
		));
		} else {

	    $wp_customize->add_setting(
	        'asalah_'.$network.'_url',
	        array(
							'transport' => 'postMessage',
	            'sanitize_callback' => 'esc_url',
	        )
	    );

	    $wp_customize->add_control('asalah_'.$network.'_url', array(
	        'label'      => $social.' URL',
	        'section'    => 'asalah_social_link_list',
	        'settings'   => 'asalah_'.$network.'_url',
	    ));
		}
  }
	/***
	End Social Links List Section
	***/

	/***
	Start Facebook Comments Section
	***/
  /* Enable Facebook Comments */
  $wp_customize->add_setting(
      'asalah_enable_facebook_comments',
      array(
          'default'     => false,
					'transport' => 'refresh',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_enable_facebook_comments', array(
	      'label'      => 'Enable facebook comments at single posts',
	      'section'    => 'asalah_facebook_comments',
	  )
	));

	// FB App ID
  $wp_customize->add_setting(
      'asalah_facebook_app_id',
      array(
				  'default' => '',
					'transport' => 'refresh',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control('asalah_facebook_app_id',
      array(
          'section'  => 'asalah_facebook_comments',
          'label'    => 'Facebook App ID',
          'type'     => 'text',
      )
  );

	// FB Comments HTML5
  $wp_customize->add_setting(
      'asalah_facebook_comments_html5',
      array(
					'transport' => 'refresh',
          'sanitize_callback' => 'esc_attr',
      )
  );

	$wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_facebook_comments_html5', array(
	      'label'      => __('Use HTML5', 'writing'),
	      'section'    => 'asalah_facebook_comments',
	      'settings'   => 'asalah_facebook_comments_html5',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing'),
	      ),
	  )
	));

	// FB Comments Width
	$wp_customize->add_setting(
      'asalah_facebook_comments_width',
      array(
          'default'            => '100&#37;',
					'transport' => 'refresh',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control('asalah_facebook_comments_width',
      array(
          'section'  => 'asalah_facebook_comments',
          'label'    => 'Facebook Comments Width',
          'type'     => 'text',

      )
  );

	// Number of FB Comments
	$wp_customize->add_setting(
      'asalah_facebook_comments_num',
      array(
          'default'            => '',
					'transport' => 'refresh',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control('asalah_facebook_comments_num',
      array(
          'section'  => 'asalah_facebook_comments',
          'label'    => 'Number of comments',
          'type'     => 'text',
      )
  );
	/***
	End Facebook Comments Section
	***/
	/***
	End Social Panel
	***/

	/***
	Start Logo Panel
	***/
	/* General Logo Section */
	// Logo Position
	$wp_customize->add_setting(
			'asalah_logo_position',
			array(
					'default'     => 'header',
					'transport' => 'refresh',
					'sanitize_callback' => 'esc_attr',
			)
	);

	$wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_logo_position', array(
				'label'      => __('Logo Position (Default is in header', 'writing'),
				'description' => __('In case of top bar, text is only allowed.', 'writing'),
				'section'    => 'asalah_logo_general',
				'settings'   => 'asalah_logo_position',
				'choices'    => array(
						'header' => __('Header (default)', 'writing'),
						'top_bar' => __('Top Bar', 'writing'),
				),
		)
	));

	// Logo Type
	$wp_customize->add_setting(
			'asalah_logo_type',
			array(
					'default'     => '',
					'transport' => 'postMessage',
					'sanitize_callback' => 'esc_attr',
			)
	);

	$wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_logo_type', array(
				'label'      => __('Logo Type (Default is Text or Image if available)', 'writing'),
				'description' => __('You can customize <a data-control="asalah_logo_text" data-focus="section" href="#" class="asalah-custom-refresh-partial">Text Logo Settings</a>, or <a data-control="asalah_logo_image" data-focus="section" href="#" class="asalah-custom-refresh-partial">Image Logo Settings</a>.', 'writing'),
				'section'    => 'asalah_logo_general',
				'settings'   => 'asalah_logo_type',
				'choices'    => array(
						'' => __('Default', 'writing'),
						'text' => __('Text', 'writing'),
						'image' => __('Image', 'writing'),
						'image_text' => __('Image Logo & Site Name', 'writing'),
				),
		)
	));

	// Center Logo
	$wp_customize->add_setting(
			'asalah_center_logo',
			array(
					'default'     => 0,
					'sanitize_callback' => 'esc_attr',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_center_logo', array(
				'label'      => 'Center logo',
				'section'    => 'asalah_logo_general',
		)
	));

	// Sticky Logo
	$wp_customize->add_setting(
			'asalah_sticky_logo',
			array(
					'default'     => 'no',
					'transport' => 'postMessage',
					'sanitize_callback' => 'esc_attr',
			)
	);

	$wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_sticky_logo', array(
				'label'      => __('Sticky Logo at mobile', 'writing'),
				'section'    => 'asalah_logo_general',
				'settings'   => 'asalah_sticky_logo',
				'choices'    => array(
						'yes' => __('Yes', 'writing'),
						'no' => __('No', 'writing')
				),
		)
	));
	/* End General Logo Section */

	/* Start Logo Image Section */
	// upload default logo image
  $wp_customize->add_setting(
      'asalah_default_logo',
      array(
          'default'     => '',
          'sanitize_callback' => 'esc_url',
					'transport' => 'postMessage',
      )
  );

  $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'asalah_default_logo', array(
      'label'      => __('Site Logo', 'writing'),
      'section'    => 'asalah_logo_image',
      'settings'   => 'asalah_default_logo',
  )));

	// Upload Retina Logo Image
  $wp_customize->add_setting(
      'asalah_default_logo_retina',
      array(
          'default'     => '',
          'sanitize_callback' => 'esc_url',
					'transport' => 'postMessage',
      )
  );

  $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'asalah_default_logo_retina', array(
      'label'      => __('Retina Logo ( Double size as default logo )', 'writing'),
      'section'    => 'asalah_logo_image',
      'settings'   => 'asalah_default_logo_retina',
  )));

	// Logo Image Width
	$option = 'asalah_logo_width';
	$section = 'asalah_logo_image';
	$max = 500;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Logo Width ( 0 for auto width )',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 5,
		),
		)
	));

	// Logo Image Height
	$option = 'asalah_logo_height';
	$section = 'asalah_logo_image';
	$max = 500;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Logo Height ( 0 for auto Height )',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 5,
		),
		)
	));
	// Logo Image Top Margin (in case of Image & Text logo type)
	$option = 'asalah_logo_image_t_margin';
	$section = 'asalah_logo_image';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Logo Image Top Space/Margin ( 0 for auto width )',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 1,
		),
		)
	));
	/* End Logo Image Section */

	/* Start Logo Text Section */
	// Logo Text Top Margin (in case of Image & Text logo type)
	$option = 'asalah_logo_text_t_margin';
	$section = 'asalah_logo_text';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Logo Text Top Space/Margin ( 0 for auto width )',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 1,
		),
		)
	));
	// Logo Font Type
	$wp_customize->add_setting(
			'asalah_logo_font_type',
			array(
					'default'     => 'writing_font',
					'sanitize_callback' => 'esc_attr',
					'transport' => 'postMessage',
			)
	);

	$wp_customize->add_control('asalah_logo_font_type', array(
			'label'      => __('Logo Font Type', 'writing'),
			'section'    => 'asalah_logo_text',
			'settings'   => 'asalah_logo_font_type',
			'type'       => 'select',
			'choices'    => $font_choices,
	));

	// Logo Font Size
	$option = 'asalah_logo_font_size';
	$section = 'asalah_logo_text';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Logo Font Size (0 for auto)',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 5,
		),
		)
	));

	// Remove Logo Dot
	$wp_customize->add_setting(
			'asalah_remove_logo_dot',
			array(
					'default'     => false,
					'sanitize_callback' => 'esc_attr',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_remove_logo_dot', array(
				'label'      => 'Remove logo dot',
				'section'    => 'asalah_logo_text',
		)
	));
	/* End Logo Text Section */

	/* Start Tagline Section */
	// Tagline Place
  $wp_customize->add_setting(
      'asalah_show_tagline',
      array(
          'default'     => 'hide',
          'sanitize_callback' => 'esc_attr',
					'transport' => 'postMessage',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_show_tagline', array(
	      'label'      => __('Tagline Place', 'writing'),
	      'section'    => 'asalah_logo_tagline',
	      'settings'   => 'asalah_show_tagline',
	      'choices'    => array(
	          'beside' => __('Beside Title', 'writing'),
	          'below' => __('Below Title', 'writing'),
	          'hide' => __('Hide', 'writing'),
	      ),
	  )
	));

	// Tagline font type
	$wp_customize->add_setting(
			'asalah_tagline_font_type',
			array(
					'default'     => 'writing_font',
					'sanitize_callback' => 'esc_attr',
					'transport' => 'postMessage',
			)
	);

	$wp_customize->add_control('asalah_tagline_font_type', array(
			'label'      => __('Tagline Font Type', 'writing'),
			'section'    => 'asalah_logo_tagline',
			'settings'   => 'asalah_tagline_font_type',
			'type'       => 'select',
			'choices'    => $font_choices,
	));

	// Tagline Font Size
	$option = 'asalah_tagline_font_size';
	$section = 'asalah_logo_tagline';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Tagline Font Size (0 for auto)',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 2,
		),
		)
	));

	// Tagline Line Height
	$option = 'asalah_tagline_line_height';
	$section = 'asalah_logo_tagline';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Tagline Line Height (0 for auto)',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 2,
		),
		)
	));

	// Tagline Show Under Image Logo
	$wp_customize->add_setting(
			'asalah_show_tagline_under_imagelogo',
			array(
					'default'     => false,
					'sanitize_callback' => 'esc_attr',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_show_tagline_under_imagelogo', array(
				'label'      => 'Show Tagline with Image Logo',
				'section'    => 'asalah_logo_tagline',
		)
	));
	/* End Tagline Section */
	/***
	End Logo Panel
	***/

	/***
	Start Header Panel
	***/
	/* Top Bar Section */
	// Sticky Menu
	$wp_customize->add_setting(
			'asalah_sticky_menu',
			array(
					'default'     => 'no',
					'sanitize_callback' => 'esc_attr',
					'transport' => 'refresh',
			)
	);

	$wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_sticky_menu', array(
				'label'      => __('Sticky Menu?', 'writing'),
				'section'    => 'asalah_header_topbar',
				'settings'   => 'asalah_sticky_menu',
				'choices'    => array(
						'yes' => __('Yes', 'writing'),
						'no' => __('No', 'writing')
				),
		)
	));

	// Show Search Icon
	$wp_customize->add_setting(
			'asalah_show_search_header',
			array(
					'default' => 'yes',
					'transport' => 'postMessage',
					'sanitize_callback' => 'esc_attr',
			)
	);

	$wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_show_search_header', array(
				'label'      => __('Show Search at Top Bar', 'writing'),
				'section'    => 'asalah_header_topbar',
				'settings'   => 'asalah_show_search_header',
				'choices'    => array(
						'yes' => __('Yes', 'writing'),
						'no' => __('No', 'writing'),
				),
		)
	));

	// Mobile Menu Text
	$wp_customize->add_setting(
      'asalah_menu_button_text',
      array(
          'sanitize_callback' => 'esc_attr',
          'default'            => '',
					'transport' => 'postMessage',
      )
  );

  $wp_customize->add_control('asalah_menu_button_text',
      array(
          'section'  => 'asalah_header_topbar',
          'label'    => 'Menu Button Text (leave blank for default "Menu")',
          'type'     => 'text',
      )
  );

	// Enable Top Bar BG Color
	$wp_customize->add_setting(
			'asalah_enable_top_menu_color',
			array(
					'default'     => false,
					'sanitize_callback' => 'esc_attr',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_enable_top_menu_color', array(
				'label'      => 'Change Top Menu Color',
				'section'    => 'asalah_header_topbar',
		)
	));

	// Top Bar BG Color
	$wp_customize->add_setting(
			'asalah_top_menu_color',
			array(
					'default'     => '#fff',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control(
			new WP_Customize_Color_Control(
					$wp_customize,
					'asalah_top_menu_color',
					array(
							'label'      => __( 'Top Menu Background Color', 'writing' ),
							'section'    => 'asalah_header_topbar',
							'settings'   => 'asalah_top_menu_color',
					)
			)
	);

	// Enable Top Bar Text Color
	$wp_customize->add_setting(
			'asalah_enable_top_menu_text_color',
			array(
					'default'     => false,
					'sanitize_callback' => 'esc_attr',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_enable_top_menu_text_color', array(
				'label'      => 'Change Top Menu Text Color',
				'section'    => 'asalah_header_topbar',
		)
	));

	// Top Bar Text Color
	$wp_customize->add_setting(
			'asalah_top_menu_text_color',
			array(
					'default'     => '#333',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control(
			new WP_Customize_Color_Control(
					$wp_customize,
					'asalah_top_menu_text_color',
					array(
							'label'      => __( 'Top Menu Text Color', 'writing' ),
							'section'    => 'asalah_header_topbar',
							'settings'   => 'asalah_top_menu_text_color',
					)
			)
	);

	// Enable Top Bar Hover Color
	$wp_customize->add_setting(
			'asalah_enable_top_menu_hover_color',
			array(
					'default'     => false,
					'sanitize_callback' => 'esc_attr',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_enable_top_menu_hover_color', array(
				'label'      => 'Change Top Menu Text Hover Color',
				'section'    => 'asalah_header_topbar',
		)
	));

	// Top Bar Hover Color
	$wp_customize->add_setting(
			'asalah_top_menu_hover_color',
			array(
					'default'     => '#333',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control(
			new WP_Customize_Color_Control(
					$wp_customize,
					'asalah_top_menu_hover_color',
					array(
							'label'      => __( 'Top Menu Text Hover Color', 'writing' ),
							'section'    => 'asalah_header_topbar',
							'settings'   => 'asalah_top_menu_hover_color',
					)
			)
	);
	/* End Top Bar Section */

	/* Header Section */
	// Header BG
	$wp_customize->add_setting(
			'asalah_header_background',
			array(
					'default'     => 0,
					'transport' => 'postMessage',
					'sanitize_callback' => 'esc_url',
			)
	);

	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'asalah_header_background', array(
			'label'      => __('Header Background', 'writing'),
			'section'    => 'asalah_header_area',
			'settings'   => 'asalah_header_background',
	)));

	// Header BG Style
	$wp_customize->add_setting(
      'asalah_header_background_style',
      array(
          'default'     => 'single',
					'transport' => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_header_background_style', array(
	      'label'      => __('Header Background Style', 'writing'),
	      'section'    => 'asalah_header_area',
	      'settings'   => 'asalah_header_background_style',
	      'choices'    => array(
	          'single' => __('Single', 'writing'),
	          'tiled' => __('Tiled', 'writing'),
	          'cover' => __('Cover', 'writing'),
	      ),
	  )
	));

	// Boxed Header Option
	$wp_customize->add_setting(
			'asalah_boxed_header',
			array(
					'default'     => false,
					'transport' => 'postMessage',
					'sanitize_callback' => 'esc_attr',

			)
	);

	$wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_boxed_header', array(
				'label'      => 'Boxed Header',
				'section'    => 'asalah_header_area',
		)
	));

	// Header Height
	$option = 'asalah_header_height';
	$section = 'asalah_header_area';
	$max = 500;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Header Height ( 0 for auto Height )',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 5,
		),
		)
	));

	// Enable Header BG Color
	$wp_customize->add_setting(
			'asalah_enable_header_color',
			array(
					'default'     => false,
					'sanitize_callback' => 'esc_attr',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_enable_header_color', array(
				'label'      => 'Change Header Color',
				'section'    => 'asalah_header_area',
		)
	));

	// Header BG Color
	$wp_customize->add_setting(
			'asalah_header_color',
			array(
					'default'     => '#fff',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
					$wp_customize,
					'asalah_header_color',
					array(
							'label'      => __( 'Header background Color', 'writing' ),
							'section'    => 'asalah_header_area',
							'settings'   => 'asalah_header_color',
					)
			)
	);

	// Enable Header Text Color
	$wp_customize->add_setting(
			'asalah_enable_header_text_color',
			array(
					'default'     => false,
					'sanitize_callback' => 'esc_attr',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_enable_header_text_color', array(
				'label'      => 'Change Header Text Color',
				'section'    => 'asalah_header_area',
		)
	));

	// Header Text Color
	$wp_customize->add_setting(
			'asalah_header_text_color',
			array(
					'default'     => '#333',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control(
			new WP_Customize_Color_Control(
					$wp_customize,
					'asalah_header_text_color',
					array(
							'label'      => __( 'Header Text Color', 'writing' ),
							'section'    => 'asalah_header_area',
							'settings'   => 'asalah_header_text_color',
					)
			)
	);

	// Enable Header Text Hover Color
	$wp_customize->add_setting(
			'asalah_enable_header_hover_color',
			array(
					'default'     => false,
					'sanitize_callback' => 'esc_attr',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_enable_header_hover_color', array(
				'label'      => 'Change Header Text Hover Color',
				'section'    => 'asalah_header_area',
		)
	));

	// Header Text Hover Color
	$wp_customize->add_setting(
			'asalah_header_hover_color',
			array(
					'default'     => '#333',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control(
			new WP_Customize_Color_Control(
					$wp_customize,
					'asalah_header_hover_color',
					array(
							'label'      => __( 'Header Text Hover Color', 'writing' ),
							'section'    => 'asalah_header_area',
							'settings'   => 'asalah_header_hover_color',
					)
			)
	);
	/* End Header Section */
	/***
	End Header Panel
	***/

	/***
	Start General Style Section
	***/
	// Site Main Color
	$wp_customize->add_setting(
			'asalah_main_color',
			array(
					'default'     => '#f47e00',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control(
			new WP_Customize_Color_Control(
					$wp_customize,
					'asalah_main_color',
					array(
							'label'      => __( 'Main Color', 'writing' ),
							'section'    => 'asalah_site_style',
							'settings'   => 'asalah_main_color',
					)
			)
	);

	// Enable Body BG Color
	$wp_customize->add_setting(
			'asalah_enable_body_background_color',
			array(
					'default'     => false,
					'sanitize_callback' => 'esc_attr',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_enable_body_background_color', array(
				'label'      => 'Change Site Background Color',
				'section'    => 'asalah_site_style',
		)
	));

	// Body BG Color
	$wp_customize->add_setting(
			'asalah_body_background_color',
			array(
					'default'     => '#fff',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control(
			new WP_Customize_Color_Control(
					$wp_customize,
					'asalah_body_background_color',
					array(
							'label'      => __( 'Site Background Color', 'writing' ),
							'section'    => 'asalah_site_style',
							'settings'   => 'asalah_body_background_color',
					)
			)
	);

	// Enable Content BG Color
	$wp_customize->add_setting(
			'asalah_enable_post_background_color',
			array(
					'default'     => false,
					'sanitize_callback' => 'esc_attr',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_enable_post_background_color', array(
				'label'      => 'Change Content Background Color',
				'section'    => 'asalah_site_style',
		)
	));

	// Content BG Color
	$wp_customize->add_setting(
			'asalah_post_background_color',
			array(
					'default' => '',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control(
			new WP_Customize_Color_Control(
					$wp_customize,
					'asalah_post_background_color',
					array(
							'label'      => __( 'Content Background Color', 'writing' ),
							'section'    => 'asalah_site_style',
							'settings'   => 'asalah_post_background_color',
					)
			)
	);

	// Enable Main Text Color
	$wp_customize->add_setting(
			'asalah_enable_main_text_color',
			array(
					'default'     => false,
					'sanitize_callback' => 'esc_attr',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_enable_main_text_color', array(
				'label'      => 'Change Main Text Color',
				'section'    => 'asalah_site_style',
		)
	));

	// Main Text Color
	$wp_customize->add_setting(
			'asalah_main_text_color',
			array(
					'default' => '#333',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control(
			new WP_Customize_Color_Control(
					$wp_customize,
					'asalah_main_text_color',
					array(
							'label'      => __( 'Main Text Color', 'writing' ),
							'section'    => 'asalah_site_style',
							'settings'   => 'asalah_main_text_color',
					)
			)
	);

	// Enable Text Hover Color
	$wp_customize->add_setting(
			'asalah_enable_text_hover_color',
			array(
					'default'     => false,
					'sanitize_callback' => 'esc_attr',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_enable_text_hover_color', array(
				'label'      => 'Change Titles Hover Color',
				'section'    => 'asalah_site_style',
		)
	));

	// Text Hover Color
	$wp_customize->add_setting(
			'asalah_text_hover_color',
			array(
					'default' => '#333',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'   => 'postMessage',
			)
	);

	$wp_customize->add_control(
			new WP_Customize_Color_Control(
					$wp_customize,
					'asalah_text_hover_color',
					array(
							'label'      => __( 'Titles Hover Color', 'writing' ),
							'section'    => 'asalah_site_style',
							'settings'   => 'asalah_text_hover_color',
					)
			)
	);

	// Enable js conditional load
  $wp_customize->add_setting(
      'asalah_js_conditional_load',
      array(
          'default'     => 0,
          'sanitize_callback' => 'esc_attr',
					'transport'   => 'postMessage',
      )
  );

  $wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_js_conditional_load', array(
	      'label'      => __('Enable Conditional Javascript Loading (to be used with minifying/combining plugins)', 'writing'),
	      'section'    => 'asalah_performance',
	      'settings'   => 'asalah_js_conditional_load',
	  )
	));

	// Async Theme scripts
  $wp_customize->add_setting(
      'asalah_async_scripts',
      array(
          'default'     => 0,
          'sanitize_callback' => 'esc_attr',
					'transport'   => 'postMessage',
      )
  );

  $wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_async_scripts', array(
	      'label'      => __("Async Theme JS files (just for Writing files, it's recommended to use a plugin for all the website's files)", 'writing'),
	      'section'    => 'asalah_performance',
	      'settings'   => 'asalah_async_scripts',
	  )
	));

	// Defer Theme scripts
  $wp_customize->add_setting(
      'asalah_defer_scripts',
      array(
          'default'     => 0,
          'sanitize_callback' => 'esc_attr',
					'transport'   => 'postMessage',
      )
  );

  $wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_defer_scripts', array(
	      'label'      => __("Defer Theme JS files (just for Writing files, it's recommended to use a plugin for all the website's files)", 'writing'),
	      'section'    => 'asalah_performance',
	      'settings'   => 'asalah_defer_scripts',
	  )
	));

	// Enable custom fontawesome icons load
  $wp_customize->add_setting(
      'asalah_fontawesome_icons_load',
      array(
          'default'     => 0,
          'sanitize_callback' => 'esc_attr',
					'transport'   => 'postMessage',
      )
  );

  $wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_fontawesome_icons_load', array(
	      'label'      => __('Load only fontawesome icons that are used in the original theme (recommended)', 'writing'),
	      'section'    => 'asalah_performance',
	      'settings'   => 'asalah_fontawesome_icons_load',
	  )
	));

	/* Lazy loading iframes */
	$wp_customize->add_setting(
			'asalah_lazyload_iframe_banner',
			array(
					'default'     => false,
					'sanitize_callback' => 'esc_attr',
					'transport' => 'refresh',
			)
	);

	$wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_lazyload_iframe_banner', array(
				'label'      => 'Lazy Load Video & Audio Banners',
				'section'    => 'asalah_performance',
		)
	));

	/* Lazy loading images */
		$wp_customize->add_setting(
			'asalah_lazyload_image_banner',
			array(
				'default'     => false,
				'sanitize_callback' => 'esc_attr',
				'transport' => 'refresh',
			)
		);

		$wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_lazyload_image_banner', array(
			'label'      => 'Lazy Load Images',
			'section'    => 'asalah_performance',
		)
	));

	$wp_customize->add_setting(
			'asalah_lazload_placeholder_image',
			array(
					'default'     => 'yes',
					'sanitize_callback' => 'esc_attr',
					'transport' => 'refresh',
			)
	);

	$wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_lazload_placeholder_image', array(
				'label'      => __('Lazy Load Images Loader', 'writing'),
				'section'    => 'asalah_performance',
				'settings'   => 'asalah_lazload_placeholder_image',
				'choices'    => array(
						'yes' => __('Yes', 'writing'),
						'no' => __('No', 'writing')
				),
		)
	));

	$wp_customize->add_setting(
      'asalah_lazyload_effect',
      array(
          'default'     => '',
          'sanitize_callback' => 'esc_attr',
					'transport' => 'refresh',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_lazyload_effect', array(
      'label'      => __('Images Lazy Load Effect', 'writing'),
      'section'    => 'asalah_performance',
      'settings'   => 'asalah_lazyload_effect',
      'choices'    => array(
          '' => __('None', 'writing'),
          'lazyfadeIn' => __('Fading', 'writing'),
          'lazyblur-up' => __('Blur', 'writing'),
      ),
	  )
	));


	// Enable Custom CSS
  $wp_customize->add_setting(
      'asalah_enable_custom_css',
      array(
          'default'     => 0,
          'sanitize_callback' => 'esc_attr',
					'transport'   => 'postMessage',
      )
  );

  $wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_enable_custom_css', array(
	      'label'      => __('Enable Custom CSS Code', 'writing'),
	      'section'    => 'asalah_site_style',
	      'settings'   => 'asalah_enable_custom_css',
	  )
	));

	// Custom CSS
	$wp_customize->add_setting(
      'asalah_custom_css_code',
      array(
          'default'     => '',
    'sanitize_callback' => 'balanceTags',
					'transport'   => 'postMessage',
      )
  );

  $wp_customize->add_control('asalah_custom_css_code', array(
      'label'      => __('Add Custom CSS Code', 'writing'),
      'section'    => 'asalah_site_style',
      'settings'   => 'asalah_custom_css_code',
      'type'       => 'textarea',
  ));

	// Enable Custom JS
	$wp_customize->add_setting(
	  'asalah_enable_custom_js',
	  array(
	      'default'     => false,
				'transport' => 'postMessage',
	      'sanitize_callback' => 'esc_attr',
	  )
	);

  $wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_enable_custom_js', array(
	      'label'      => __('Enable Custom JS Code', 'writing'),
	      'section'    => 'asalah_site_style',
	      'settings'   => 'asalah_enable_custom_js',
	  )
	));

	// Custom JS
  $wp_customize->add_setting(
      'asalah_custom_js_code',
      array(
          'default'     => '',
					'transport' => 'refresh',
					'sanitize_callback' => 'balanceTags'
      )
  );

  $wp_customize->add_control('asalah_custom_js_code', array(
	  'label'      => __('Add Custom JS Code', 'writing'),
	  'section'    => 'asalah_site_style',
	  'settings'   => 'asalah_custom_js_code',
	  'type'       => 'textarea',
	));
	/***
	End General Style Section
	***/

	/***
	Start Header/Footer Section
	***/
	// Header Code
	$wp_customize->add_setting(
      'asalah_custom_header_code',
      array(
          'default'     => '',
					'transport' => 'refresh',
					'sanitize_callback' => 'balanceTags'
      )
  );

  $wp_customize->add_control('asalah_custom_header_code', array(
    'label'      => __('Add Header Content Code', 'writing'),
    'section'    => 'asalah_custom_code',
    'settings'   => 'asalah_custom_header_code',
    'type'       => 'textarea',
  ));

	// Footer Code
	$wp_customize->add_setting(
      'asalah_custom_footer_code',
      array(
          'default'     => '',
					'transport'   => 'refresh',
					'sanitize_callback' => 'balanceTags'
      )
  );

  $wp_customize->add_control('asalah_custom_footer_code', array(
    'label'      => __('Add Footer Content Code', 'writing'),
    'section'    => 'asalah_custom_code',
    'settings'   => 'asalah_custom_footer_code',
    'type'       => 'textarea',
	));
	/***
	End Header/Footer Section
	***/


	/***
	Start Typography Panel
	***/
	/* General Typography Section */

	// Use System Fonts
	$wp_customize->add_setting(
			'asalah_load_system_fonts',
			array(
					'default'     => false,
					'sanitize_callback' => 'esc_attr',
					'transport'   => 'refresh',
			)
	);

	$wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_load_system_fonts', array(
				'label'      => 'Use System Fonts',
				'section'    => 'asalah_typography_general',
		)
	));


		// Load Google Fonts Asynchronous
	  $wp_customize->add_setting(
	      'asalah_async_google_fonts',
	      array(
	          'default'     => 0,
	          'sanitize_callback' => 'esc_attr',
						'transport'   => 'postMessage',
	      )
	  );

	  $wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_async_google_fonts', array(
		      'label'      => __("Load Google Fonts Asynchronous (BETA, if had any issues please contact support)", 'writing'),
		      'section'    => 'asalah_typography_general',
		      'settings'   => 'asalah_async_google_fonts',
		  )
		));

	// Load Fonts Locally
	$wp_customize->add_setting(
			'asalah_load_fonts_locally',
			array(
					'default'     => 'no',
					'sanitize_callback' => 'esc_attr',
					'transport' => 'refresh',
			)
	);

	$wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_load_fonts_locally', array(
				'label'      => __('Load Fonts Locally? (don\'t load from google fonts CDN)', 'writing'),
				'section'    => 'asalah_typography_general',
				'settings'   => 'asalah_load_fonts_locally',
				'choices'    => array(
						'yes' => __('Yes', 'writing'),
						'no' => __('No', 'writing')
				),
		)
	));

	$wp_customize->add_setting(
			'asalah_font_subset',
			array(
					'default'     => 'latin',
					'sanitize_callback' => 'multiselect_sanitize',
					'transport' => 'refresh',
			)
	);

	$wp_customize->add_control( new Customize_Control_Multiple_Select( $wp_customize, 'asalah_font_subset', array(
				'label'      => __('Set Fonts Subsets', 'writing'),
				'section'    => 'asalah_typography_general',
				'settings'   => 'asalah_font_subset',
				'type'       => 'multiple-select',
				'choices'    => array(
						'all' => 'All',
						"latin" => "Latin",
						"latin-ext" => "Latin Extended",
						"vietnamese" => "Vietnamese",
						"cyrillic" => "Cyrillic",
						"cyrillic-ext" => "Cyrillic Extended",
						"devanagari" => "Devanagari",
						"greek" => "Greek",
						"greek-ext" => "Greek Extended",
						"korean" => "Korean",
						"thai" => "Thai",
						"khmer" => "Khmer",
						"arabic" => "Arabic",
						"telugu" => "Telugu",
						"hebrew" => "Hebrew",
						"chinese-simplified" => "Chinese Simplified",
						"gujarati" => "Gujarati",
						"tamil" => "Tamil",
						"japanese" => "Japanese",
						"bengali" => "Bengali",
						"malayalam" => "Malayalam",
						"chinese-traditional" => "Chinese Traditional",
						"gurmukhi" => "Gurmukhi",
						"chinese-hongkong" => "Chinese Hongkong",
						"kannada" => "Kannada",
						"myanmar" => "Myanmar",
						"oriya" => "Oriya",
						"sinhala" => "Sinhala",
						"tibetan" => "Tibetan"
				),
		)
	));

	/* Main Font Section */
	$wp_customize->add_setting(
			'asalah_main_font_type',
			array(
					'default'     => 'writing_font',
					'sanitize_callback' => 'esc_attr',
					'transport' => 'refresh',
			)
	);

	$wp_customize->add_control('asalah_main_font_type', array(
			'label'      => __('Site Main Font Type', 'writing'),
			'section'    => 'asalah_typography_main',
			'settings'   => 'asalah_main_font_type',
			'type'       => 'select',
			'choices'    => $font_choices,
	));

	$option = 'asalah_main_font_size';
	$section = 'asalah_typography_main';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
			)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Site Main Font Size (0 for auto)',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 2,
		),
		)
	));

	$option = 'asalah_main_line_height';
	$section = 'asalah_typography_main';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Site Main Line Height (0 for auto)',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 2,
		),
		)
	));

	/* Menu Font Section */
	$wp_customize->add_setting(
			'asalah_menu_font_type',
			array(
					'default'     => 'writing_font',
					'sanitize_callback' => 'esc_attr',
					'transport' => 'refresh',
			)
	);

	$wp_customize->add_control('asalah_menu_font_type', array(
			'label'      => __('Menu Font Type', 'writing'),
			'section'    => 'asalah_typography_menu',
			'settings'   => 'asalah_menu_font_type',
			'type'       => 'select',
			'choices'    => $font_choices,
	));

	$option = 'asalah_menu_font_size';
	$section = 'asalah_typography_menu';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Menu Font Size (0 for auto)',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 2,
		),
		)
	));

	$option = 'asalah_menu_line_height';
	$section = 'asalah_typography_menu';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Menu Line Height (0 for auto)',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 2,
		),
		)
	));

	/* Blog List Title Font Section */
	$wp_customize->add_setting(
			'asalah_bloglist_title_font_type',
			array(
					'default'     => 'writing_font',
					'sanitize_callback' => 'esc_attr',
					'transport' => 'refresh',
			)
	);

	$wp_customize->add_control('asalah_bloglist_title_font_type', array(
			'label'      => __('Blog List Post Title Font Type', 'writing'),
			'section'    => 'asalah_typography_blog_title',
			'settings'   => 'asalah_bloglist_title_font_type',
			'type'       => 'select',
			'choices'    => $font_choices,
	));

	$option = 'asalah_bloglist_title_font_size';
	$section = 'asalah_typography_blog_title';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Blog List Post Title Font Size (0 for auto)',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 2,
		),
		)
	));

	$option = 'asalah_bloglist_title_line_height';
	$section = 'asalah_typography_blog_title';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Blog List Post Title Line Height (0 for auto)',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 2,
		),
		)
	));

	/* Single Blog Title Font Section */
	$wp_customize->add_setting(
			'asalah_blogsingle_title_font_type',
			array(
					'default'     => 'writing_font',
					'sanitize_callback' => 'esc_attr',
					'transport' => 'refresh',
			)
	);

	$wp_customize->add_control('asalah_blogsingle_title_font_type', array(
			'label'      => __('Single Post Title Font Type', 'writing'),
			'section'    => 'asalah_typography_single_title',
			'settings'   => 'asalah_blogsingle_title_font_type',
			'type'       => 'select',
			'choices'    => $font_choices,
	));

	$option = 'asalah_blogsingle_title_font_size';
	$section = 'asalah_typography_single_title';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Single Post Title Font Size (0 for auto)',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 2,
		),
		)
	));

	$option = 'asalah_blogsingle_title_line_height';
	$section = 'asalah_typography_single_title';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Single Post Title Line Height (0 for auto)',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 2,
		),
		)
	));

	/* Meta Info Font Section */
	$wp_customize->add_setting(
			'asalah_metainfo_font_type',
			array(
					'default'     => 'writing_font',
					'sanitize_callback' => 'esc_attr',
					'transport' => 'refresh',
			)
	);

	$wp_customize->add_control('asalah_metainfo_font_type', array(
			'label'      => __('Meta Info Font Type', 'writing'),
			'section'    => 'asalah_typography_meta',
			'settings'   => 'asalah_metainfo_font_type',
			'type'       => 'select',
			'choices'    => $font_choices,
	));

	$option = 'asalah_metainfo_font_size';
	$section = 'asalah_typography_meta';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Meta Info Font Size (0 for auto)',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 2,
		),
		)
	));

	$option = 'asalah_metainfo_line_height';
	$section = 'asalah_typography_meta';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Meta Info Line Height (0 for auto)',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 2,
		),
		)
	));

	/* Widgets Titles Font Section */
	$wp_customize->add_setting(
			'asalah_widgettitle_font_type',
			array(
					'default'     => 'writing_font',
					'sanitize_callback' => 'esc_attr',
					'transport' => 'refresh',
			)
	);

	$wp_customize->add_control('asalah_widgettitle_font_type', array(
			'label'      => __('Widget Title Font Type', 'writing'),
			'section'    => 'asalah_typography_widgettitle',
			'settings'   => 'asalah_widgettitle_font_type',
			'type'       => 'select',
			'choices'    => $font_choices,
	));

	$option = 'asalah_widgettitle_font_size';
	$section = 'asalah_typography_widgettitle';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Widget Title Font Size (0 for auto)',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 2,
		),
		)
	));

	$option = 'asalah_widgettitle_line_height';
	$section = 'asalah_typography_widgettitle';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control( new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Widget Title Line Height (0 for auto)',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 2,
		),
		)
	));

	/* Blog Content Font Section */
	$wp_customize->add_setting(
			'asalah_blog_font_type',
			array(
					'default'     => 'writing_font',
					'sanitize_callback' => 'esc_attr',
					'transport' => 'refresh',
			)
	);

	$wp_customize->add_control('asalah_blog_font_type', array(
			'label'      => __('Blog Content Font Type', 'writing'),
			'section'    => 'asalah_typography_blog_content',
			'settings'   => 'asalah_blog_font_type',
			'type'       => 'select',
			'choices'    => $font_choices,
	));

	$option = 'asalah_blog_font_size';
	$section = 'asalah_typography_blog_content';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Blog Content Font Size (0 for auto)',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 2,
		),
		)
	));

	$option = 'asalah_blog_line_height';
	$section = 'asalah_typography_blog_content';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Blog Content Line Height (0 for auto)',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 2,
		),
		)
	));

	/* Single Blog Content Font Section */
	$option = 'asalah_blog_description_font_size';
	$section = 'asalah_typography_blog_description';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Blog Post Description Font Size (0 for auto)',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 2,
		),
		)
	));

	$option = 'asalah_blog_description_line_height';
	$section = 'asalah_typography_blog_description';
	$max = 100;
	$min = 0;
	$wp_customize->add_setting( $option,
		array(
			'default' => 0,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Blog Post Description Line Height (0 for auto)',
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 2,
		),
		)
	));

	/* Headlines Font Section */
	$wp_customize->add_setting(
			'asalah_head_font_type',
			array(
					'default'     => 'writing_font',
					'sanitize_callback' => 'esc_attr',
					'transport' => 'refresh',
			)
	);

	$wp_customize->add_control('asalah_head_font_type', array(
			'label'      => __('Headlines Font Type', 'writing'),
			'section'    => 'asalah_typography_headlines',
			'settings'   => 'asalah_head_font_type',
			'type'       => 'select',
			'choices'    => $font_choices,
	));

	$headings = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');

	foreach ($headings as $head) {

		$option = 'asalah_'.$head.'_font_size';
		$section = 'asalah_typography_headlines';
		$max = 100;
		$min = 0;
		$wp_customize->add_setting( $option,
			array(
				'default' => 0,
				'sanitize_callback' => 'esc_attr',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
			array(
				'label' => $head.' Font Size (0 for auto)',
				'section' => $section,
				'settings' => $option,
				'input_attrs' => array(
					'min'   => $min,
					'max'   => $max,
					'step'  => 2,
			),
			)
		));

		$option = 'asalah_'.$head.'_line_height';
		$section = 'asalah_typography_headlines';
		$max = 100;
		$min = 0;
		$wp_customize->add_setting( $option,
			array(
				'default' => 0,
				'sanitize_callback' => 'esc_attr',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
			array(
				'label' => $head.' Line Height (0 for auto)',
				'section' => $section,
				'settings' => $option,
				'input_attrs' => array(
					'min'   => $min,
					'max'   => $max,
					'step'  => 2,
			),
			)
		));

	}
	/***
	End Typography Panel
	***/

	/***
	Start Layout Panel
	***/
	/* Start General Layout Section */
	// Site Width
	$option = 'asalah_site_width';
	$section = 'asalah_layout_general';
	$max = 2000;
	$min = 500;
	$wp_customize->add_setting( $option,
		array(
			'default' => 910,
			'sanitize_callback' => 'esc_attr',
			'transport' => 'refresh',
		)
	);

	$wp_customize->add_control(new asalah_Slider_Custom_Control( $wp_customize, $option,
		array(
			'label' => 'Site Width (Minimum 500px)',
			'description' => __('Use <a rel="nofollow noreferrer" target="_blank" href="https://wordpress.org/plugins/regenerate-thumbnails/">Regenerate Thumbnails</a> plugin after changing the options.', 'writing'),
			'section' => $section,
			'settings' => $option,
			'input_attrs' => array(
				'min'   => $min,
				'max'   => $max,
				'step'  => 50,
		),
		)
	));

	// Sidebar Postion
  $wp_customize->add_setting(
      'asalah_sidebar_position',
      array(
          'default'     => 'left',
          'sanitize_callback' => 'esc_attr',
					'transport' => 'refresh',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_sidebar_position', array(
      'label'      => __('Sidebar Position', 'writing'),
      'section'    => 'asalah_layout_general',
      'settings'   => 'asalah_sidebar_position',
      'choices'    => array(
          'left' => __('Left Sidebar', 'writing'),
          'right' => __('Right Sidebar', 'writing'),
          'none' => __('No Sidebar', 'writing'),
      ),
	  )
	));

	// Sliding Sidebar
	$wp_customize->add_setting(
		'asalah_enable_sliding_sidebar',
		array(
			'default'     => 'yes',
			'sanitize_callback' => 'esc_attr',
			'transport' => 'refresh',
		)
	);

	$wp_customize->add_control(new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_enable_sliding_sidebar', array(
			'label'      => __('Sliding Sidebar', 'writing'),
			'section'    => 'asalah_layout_general',
			'settings'   => 'asalah_enable_sliding_sidebar',
			'choices'    => array(
				'yes' => __('Show', 'writing'),
				'no' => __('Hide', 'writing')
			),
		)
	));

	// Sliding Sidebar Icon image
	if (get_bloginfo('version') >= '4.3') {

		$wp_customize->add_setting(
				'asalah_header_avatar',
				array(
						'default'     => '',
						'transport' => 'postMessage',
						'sanitize_callback' => 'esc_attr',

				)
		);

		$wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'asalah_header_avatar', array(
			'label'      => __('Sliding Sidebar Icon Avatar', 'writing'),
			'section'    => 'asalah_layout_general',
			'settings'   => 'asalah_header_avatar',
			'flex_width'  => true, // Allow any width, making the specified value recommended. False by default.
			'flex_height' => true, // Require the resulting image to be exactly as tall as the height attribute (default).
			'width'       => 40,
			'height'      => 40,
		)));

	} else {
		$wp_customize->add_setting(
				'asalah_header_avatar',
				array(
						'default'     => '',
						'transport' => 'postMessage',
						'sanitize_callback' => 'esc_url',

				)
		);

		$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'asalah_header_avatar', array(
			'label'      => __('Sliding Sidebar Icon Avatar', 'writing'),
			'section'    => 'asalah_layout_general',
			'settings'   => 'asalah_header_avatar',
		)));
	}


	// Blog Style
  $wp_customize->add_setting(
      'asalah_blog_style',
      array(
          'default'     => 'default',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_blog_style', array(
	      'label'      => __('Default Blog Style', 'writing'),
	      'section'    => 'asalah_layout_general',
	      'settings'   => 'asalah_blog_style',
	      'choices'    => array(
	          'default' => __('Default (Classic)', 'writing'),
	          'banners' => __('Banners First', 'writing'),
	          'masonry' => __('Masonry', 'writing'),
	          'list' => __('List', 'writing'),
	          'banner_grid' => __('Masonry with Featured Post', 'writing'),
	          'banner_list' => __('List with Featured Post', 'writing'),
	      ),
	  )
	));

	/* Disable Masonry Effect */
  $wp_customize->add_setting(
      'asalah_disable_masonry_effect',
      array(
          'default'     => false,
					'transport' => 'refresh',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_disable_masonry_effect', array(
	      'label'      => 'Disable Masonry Effect (show as grid)',
	      'section'    => 'asalah_layout_general',
	  )
	));

	// Pagination Style
	$wp_customize->add_setting(
      'asalah_pagination_style',
      array(
          'default'     => 'nav',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control(new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_pagination_style', array(
	      'label'      => __('Pagination Style', 'writing'),
	      'section'    => 'asalah_layout_general',
	      'settings'   => 'asalah_pagination_style',
	      'choices'    => array(
	          'nav' => __('Older/Newer Links', 'writing'),
	          'num' => __('Numerical', 'writing'),
						'ajax' => __('Ajax', 'writing')
	      ),
	  )
	));

	// Pagination Style
	$wp_customize->add_setting(
      'asalah_footer_widgets_number',
      array(
          'default'     => '3',
					'transport'   => 'refresh',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control(new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_footer_widgets_number', array(
	      'label'      => __('Footer Widget Columns', 'writing'),
	      'section'    => 'asalah_layout_general',
	      'settings'   => 'asalah_footer_widgets_number',
	      'choices'    => array(
	          '3' => __('3', 'writing'),
	          '2' => __('2', 'writing'),
						'1' => __('1', 'writing')
	      ),
	  )
	));

	// Show Author Info At Author Page
  $wp_customize->add_setting(
      'asalah_show_author_info_page',
      array(
          'default'     => 'no',
          'sanitize_callback' => 'esc_attr',
					'transport' => 'postMessage',
      )
  );

  $wp_customize->add_control(new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_show_author_info_page', array(
	      'label'      => __('Show Author Info at Author Page', 'writing'),
	      'section'    => 'asalah_layout_general',
	      'settings'   => 'asalah_show_author_info_page',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing')
	      ),
	  )
	));
	/* End General Layout */
	/* Start Banner Layout */
	// Image Quality Optimization
	$wp_customize->add_setting(
		'asalah_image_optimization',
		array(
			'default'     => 'no',
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_image_optimization', array(
			'label'      => __('Optimize Featured Images Quality', 'writing'),
			'description' => __('Use <a rel="nofollow noreferrer" target="_blank" href="https://wordpress.org/plugins/regenerate-thumbnails/">Regenerate Thumbnails</a> plugin after changing the options.', 'writing'),
			'section'    => 'asalah_layout_banner',
			'settings'   => 'asalah_image_optimization',
			'choices'    => array(
				'no' => __('No', 'writing'),
				'yes' => __('Yes', 'writing')
			),
		)
	));

	// Enable featured images sizes for different widths
	if (asalah_option('asalah_site_width') != '') {
		$banners_default = false;
	} else {
		$banners_default = true;
	}
	$wp_customize->add_setting(
      'asalah_banners_devices_size',
      array(
          'default'     => $banners_default,
          'sanitize_callback' => 'esc_attr',
					'transport' => 'refresh',
      )
  );

  $wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_banners_devices_size', array(
	      'label'      => 'Enable different sizes for different screens',
				'description' => __('Recommended, Use <a rel="nofollow noreferrer" target="_blank" href="https://wordpress.org/plugins/regenerate-thumbnails/">Regenerate Thumbnails</a> plugin after changing the options.', 'writing'),
	      'section'    => 'asalah_layout_banner',
	  )
	));

	// Disable Theme Gallery
	$wp_customize->add_setting(
      'asalah_deactivate_theme_gallery',
      array(
          'default'     => false,
          'sanitize_callback' => 'esc_attr',
					'transport' => 'refresh',
      )
  );

  $wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_deactivate_theme_gallery', array(
	      'label'      => 'Disable Default Theme Gallery',
	      'section'    => 'asalah_layout_banner',
	  )
	));

	// Disable Featured Images rounded corners
	$wp_customize->add_setting(
      'asalah_disable_featured_rnd_crnr',
      array(
          'default'     => false,
          'sanitize_callback' => 'esc_attr',
					'transport' => 'refresh',
      )
  );

  $wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_disable_featured_rnd_crnr', array(
	      'label'      => 'Disable Featured Images Rounded Corners',
	      'section'    => 'asalah_layout_banner',
	  )
	));

	// Show Banner at Standard Post Single
	$wp_customize->add_setting(
      'asalah_show_banner_standard',
      array(
          'default'     => false,
          'sanitize_callback' => 'esc_attr',
					'transport' => 'postMessage',
      )
  );

  $wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_show_banner_standard', array(
	      'label'      => 'Show banner at Single Standard Post',
				'descriotion' => 'For old blogs that already have lots of standard posts width Featured Images.',
	      'section'    => 'asalah_layout_banner',
	  )
	));

	// Show Featured Image Caption at blog list
	$wp_customize->add_setting(
      'asalah_banner_blog_caption',
      array(
          'default'     => false,
          'sanitize_callback' => 'esc_attr',
					'transport' => 'postMessage',
      )
  );

  $wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_banner_blog_caption', array(
	      'label'      => 'Show Featured Image Caption at Posts list',
				'description' => 'Classic & Banners First blog layouts only',
	      'section'    => 'asalah_layout_banner',
	  )
	));

	// Show Featured Image Caption at single post
	$wp_customize->add_setting(
      'asalah_banner_single_caption',
      array(
          'default'     => false,
          'sanitize_callback' => 'esc_attr',
					'transport' => 'postMessage',
      )
  );

  $wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_banner_single_caption', array(
	      'label'      => 'Show Featured Image Caption at Single Page/Post',
	      'section'    => 'asalah_layout_banner',
	  )
	));

	// Blog Banner Crop
	$wp_customize->add_setting(
		'asalah_blog_image_crop',
		array(
			'default'     => 'yes',
			'transport' => 'postMessage',
			'sanitize_callback' => 'esc_attr',
		)
	);

	$wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_blog_image_crop', array(
			'label'      => __('Crop Blog Banners in Blog List ('.(intval(asalah_option('asalah_site_width'))-30).'px x 400px)', 'writing'),
			'section'    => 'asalah_layout_banner',
			'settings'   => 'asalah_blog_image_crop',
			'choices'    => array(
				'yes' => __('Yes', 'writing'),
				'no' => __('No', 'writing')
			),
		)
	));

	// Gallery Banner Crop
	$wp_customize->add_setting(
      'asalah_blog_gallery_crop',
      array(
          'default'     => 'yes',
					'transport' => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_blog_gallery_crop', array(
	      'label'      => __('Crop Gallery Images in Blog List ('.(intval(asalah_option('asalah_site_width'))-30).'px x 400px)', 'writing'),
	      'section'    => 'asalah_layout_banner',
	      'settings'   => 'asalah_blog_gallery_crop',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing')
	      ),
	  )
	));

	// Single Banner Crop
	$wp_customize->add_setting(
			'asalah_single_thumb_crop',
			array(
					'default'     => 'yes',
					'transport' => 'postMessage',
					'sanitize_callback' => 'esc_attr',
			)
	);

	$wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_single_thumb_crop', array(
				'label'      => __('Crop Single Page Image 940px x 590px)', 'writing'),
				'section'    => 'asalah_layout_banner',
				'settings'   => 'asalah_single_thumb_crop',
				'choices'    => array(
						'yes' => __('Yes', 'writing'),
						'no' => __('No', 'writing')
				),
		)
	));

	// Single Banner Crop
	$wp_customize->add_setting(
			'asalah_single_thumb_same_blog',
			array(
					'default'     => 'no',
					'transport' => 'postMessage',
					'sanitize_callback' => 'esc_attr',
			)
	);

	$wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_single_thumb_same_blog', array(
				'label'      => __('Make Single Post/Page Image Same As Blog List Images ('.(intval(asalah_option('asalah_site_width'))-30).'px x 400px)', 'writing'),
				'section'    => 'asalah_layout_banner',
				'settings'   => 'asalah_single_thumb_same_blog',
				'choices'    => array(
						'yes' => __('Yes', 'writing'),
						'no' => __('No', 'writing')
				),
		)
	));

	// Enable Custom Single Image Size
	$wp_customize->add_setting(
			'asalah_enable_custom_single_image_size',
			array(
					'default'     => false,
					'transport' => 'postMessage',
					'sanitize_callback' => 'esc_attr',
			)
	);

	$wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'asalah_enable_custom_single_image_size', array(
				'label'      => __('Enable Custom Single Image Size', 'writing'),
				'section'    => 'asalah_layout_banner',
				'settings'   => 'asalah_enable_custom_single_image_size',
		)
	));

	// Custom Single Banner Width
	$wp_customize->add_setting(
      'asalah_custom_image_size_width',
      array(
				  'default' => '',
					'transport' => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control(
      'asalah_custom_image_size_width',
      array(
          'section'  => 'asalah_layout_banner',
          'label'    => 'Custom Single Image Width',
          'type'     => 'text',
      )
  );

	// Custom Single Banner Height
	$wp_customize->add_setting(
      'asalah_custom_image_size_height',
      array(
				  'default' => '',
					'transport' => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control(
      'asalah_custom_image_size_height',
      array(
          'section'  => 'asalah_layout_banner',
          'label'    => 'Custom Single Image Height',
          'type'     => 'text',
      )
  );

	// Title and Featured Image position at single posts
	$wp_customize->add_setting(
      'asalah_single_title_above_featured',
      array(
          'default'     => false,
					'transport' => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_single_title_above_featured', array(
	      'label'      => __('Featured Image Position at Single Posts/Pages', 'writing'),
	      'section'    => 'asalah_layout_banner',
	      'settings'   => 'asalah_single_title_above_featured',
	      'choices'    => array(
	          false => __('Above Title', 'writing'),
	          true => __('Under Title', 'writing'),
	      ),
	  )
	));
	/* End Banner Layout */

	/* Start Meta Info Section */

	// Show Meta Tags
  $wp_customize->add_setting(
      'asalah_show_meta',
      array(
          'default'     => 'yes',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_show_meta', array(
	      'label'      => __('Show Meta Info', 'writing'),
	      'section'    => 'asalah_layout_meta_tags',
	      'settings'   => 'asalah_show_meta',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing')
	      ),
	  )
	));

	// Post Format Icon
	$wp_customize->add_setting(
      'asalah_media_template_layout',
      array(
          'default'     => 'default',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_media_template_layout', array(
	      'label'      => __('Post Format Icon', 'writing'),
	      'section'    => 'asalah_layout_meta_tags',
	      'settings'   => 'asalah_media_template_layout',
	      'choices'    => array(
	          'default' => __('Link to default posts list layout', 'writing'),
						'media_lib' => __('Link to posts list grid layout', 'writing'),
						'none' => __('Not linked', 'writing'),
						'hide' => __('Hide', 'writing')
	      ),
	  )
	));

	// Show Categories
	$wp_customize->add_setting(
      'asalah_show_categories',
      array(
          'default'     => 'yes',
          'sanitize_callback' => 'esc_attr',
					'transport' => 'postMessage',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_show_categories', array(
	      'label'      => __('Show Categories in Post Meta', 'writing'),
	      'section'    => 'asalah_layout_meta_tags',
	      'settings'   => 'asalah_show_categories',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing')
	      ),
	  )
	));

	// Show Tags
	$wp_customize->add_setting(
      'asalah_show_tags',
      array(
          'default'     => 'yes',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_show_tags', array(
	      'label'      => __('Show Tags in Post Meta', 'writing'),
	      'section'    => 'asalah_layout_meta_tags',
	      'settings'   => 'asalah_show_tags',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing')
	      ),
	  )
	));

	// Show Date
	$wp_customize->add_setting(
      'asalah_show_date',
      array(
          'default'     => 'yes',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_show_date', array(
	      'label'      => __('Show Date in Post Meta', 'writing'),
	      'section'    => 'asalah_layout_meta_tags',
	      'settings'   => 'asalah_show_date',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing')
	      ),
	  )
	));

	// Show Updated Date
	$wp_customize->add_setting(
      'asalah_show_update_date',
      array(
          'default'     => 'no',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_show_update_date', array(
	      'label'      => __('Show Updated Date in Post Meta', 'writing'),
	      'section'    => 'asalah_layout_meta_tags',
	      'settings'   => 'asalah_show_update_date',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing')
	      ),
	  )
	));

	// Word before Updated
	$wp_customize->add_setting(
      'asalah_update_date_word',
      array(
          'default'     => '',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

	$wp_customize->add_control(
      'asalah_update_date_word',
      array(
          'section'  => 'asalah_layout_meta_tags',
          'label'    => 'Word to show before updated date',
          'type'     => 'text'
      )
  );

	// Show Views Number
	$wp_customize->add_setting(
		'asalah_hits_counter',
		array(
			'default'     => 'no',
			'sanitize_callback' => 'esc_attr',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_hits_counter', array(
			'label'      => __('Show views number', 'writing'),
			'section'    => 'asalah_layout_meta_tags',
			'settings'   => 'asalah_hits_counter',
			'choices'    => array(
				'yes' => __('Yes', 'writing'),
				'no' => __('No', 'writing')
			),
		)
	));

	// Show Comments Num
	$wp_customize->add_setting(
      'asalah_show_comments_number',
      array(
          'default'     => 'yes',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_show_comments_number', array(
	      'label'      => __('Show Comments Number in Post Meta', 'writing'),
	      'section'    => 'asalah_layout_meta_tags',
	      'settings'   => 'asalah_show_comments_number',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing')
	      ),
	  )
	));

	// Show Author
	$wp_customize->add_setting(
      'asalah_show_author',
      array(
          'default'     => 'yes',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_show_author', array(
	      'label'      => __('Show Author in Post Meta', 'writing'),
	      'section'    => 'asalah_layout_meta_tags',
	      'settings'   => 'asalah_show_author',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing')
	      ),
	  )
	));
	/* End Meta Info Section */

	/* Start Content Settings Section */
	// Content Width Style (Narrow/Wide)
  $wp_customize->add_setting(
      'asalah_content_width_layout',
      array(
          'default'     => 'wide',
          'sanitize_callback' => 'esc_attr',
					'transport' => 'postMessage',
      )
  );

  $wp_customize->add_control(new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_content_width_layout', array(
	      'label'      => __('Posts Content Width', 'writing'),
	      'section'    => 'asalah_layout_general',
	      'settings'   => 'asalah_content_width_layout',
	      'choices'    => array(
	          'wide' => __('Wide', 'writing'),
	          'narrow' => __('Narrow', 'writing'),
	      ),
	  )
	));

	// Post Content
	$wp_customize->add_setting(
			'asalah_post_content_show',
			array(
					'default'     => 'yes',
					'transport'   => 'postMessage',
					'sanitize_callback' => 'esc_attr',
			)
	);

	$wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_post_content_show', array(
				'label'      => __('Show Post Content', 'writing'),
				'section'    => 'asalah_layout_post_content',
				'settings'   => 'asalah_post_content_show',
				'choices'    => array(
						'yes' => __('Yes', 'writing'),
						'no' => __('No', 'writing')
				),
		)
	));

	// Post Content Formatting
	$wp_customize->add_setting(
			'asalah_post_with_formatting',
			array(
					'default'     => 'no',
					'transport'   => 'postMessage',
					'sanitize_callback' => 'esc_attr',
			)
	);

	$wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_post_with_formatting', array(
				'label'      => __('Show Post Content With Formatting at blog list', 'writing'),
				'section'    => 'asalah_layout_post_content',
				'settings'   => 'asalah_post_with_formatting',
				'choices'    => array(
						'no' => __('No', 'writing'),
						'yes' => __('Yes', 'writing'),
				),
		)
	));

	// Post Excerpt
  $wp_customize->add_setting(
      'asalah_post_excerpt',
      array(
          'default'     => 'enabled',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_post_excerpt', array(
	      'label'      => __('Post Excerpt', 'writing'),
	      'section'    => 'asalah_layout_post_content',
	      'settings'   => 'asalah_post_excerpt',
	      'choices'    => array(
	          'enabled' => __('Enabled', 'writing'),
	          'disabled' => __('Disabled', 'writing'),
	      ),
	  )
	));

	// Post Excerpt Limit
  $wp_customize->add_setting(
      'asalah_post_excerpt_limit',
      array(
          'default'            => '',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control(
      'asalah_post_excerpt_limit',
      array(
          'section'  => 'asalah_layout_post_content',
          'label'    => 'Excerpt length (No. of words)',
          'type'     => 'text'
      )
  );

	// Post Excerpt End Text
  $wp_customize->add_setting(
      'asalah_post_excerpt_text',
      array(
          'sanitize_callback' => 'esc_attr',
					'transport'   => 'postMessage',
          'default'            => ' &hellip; ',
      )
  );

  $wp_customize->add_control(
      'asalah_post_excerpt_text',
      array(
          'section'  => 'asalah_layout_post_content',
          'label'    => 'End of Excerpt text',
          'type'     => 'text',
      )
  );

	// Single Post Title
	$wp_customize->add_setting(
      'asalah_show_single_post_title',
      array(
          'default'     => 'yes',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_show_single_post_title', array(
	      'label'      => __('Show Single Post Title', 'writing'),
	      'section'    => 'asalah_layout_post_content',
	      'settings'   => 'asalah_show_single_post_title',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing'),
	      ),
	  )
	));

	// Embed pinterest links
	$wp_customize->add_setting(
      'asalah_embed_pinterest',
      array(
          'default'     => 'no',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_embed_pinterest', array(
	      'label'      => __('Embed Pinterest links', 'writing'),
	      'section'    => 'asalah_layout_post_content',
	      'settings'   => 'asalah_embed_pinterest',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing'),
	      ),
	  )
	));
	/* End Content Settings Section */

	/* Start Share and Continue Reading Settings Section */
	// Show Continue Reading
	$wp_customize->add_setting(
			'asalah_cont_read_show',
			array(
					'default'     => 'yes',
					'transport'   => 'postMessage',
					'sanitize_callback' => 'esc_attr',
			)
	);

	$wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_cont_read_show', array(
				'label'      => __('Show Continue Reading Button', 'writing'),
				'section'    => 'asalah_layout_control_post',
				'settings'   => 'asalah_cont_read_show',
				'choices'    => array(
						'yes' => __('Yes', 'writing'),
						'no' => __('No', 'writing')
				),
		)
	));

	// Continue Reading Text
	$wp_customize->add_setting(
			'asalah_cont_read_text',
			array(
					'default'     => 'Continue Reading',
					'transport'   => 'postMessage',
					'sanitize_callback' => 'esc_attr',
			)
	);

	$wp_customize->add_control('asalah_cont_read_text', array(
			'label'      => __('Continue Reading Button Text', 'writing'),
			'section'    => 'asalah_layout_control_post',
			'settings'   => 'asalah_cont_read_text',
			'type'       => 'text',
			));

	// Show Share
  $wp_customize->add_setting(
      'asalah_show_share',
      array(
          'default'     => 'yes',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_show_share', array(
	      'label'      => __('Show Share Icons', 'writing'),
	      'section'    => 'asalah_layout_control_post',
	      'settings'   => 'asalah_show_share',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing')
	      ),
	  )
	));

	// Show Share Effect
	$wp_customize->add_setting(
      'asalah_show_share_effect',
      array(
          'default'     => 'hover',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_show_share_effect', array(
	      'label'      => __('Show Share Icons Action', 'writing'),
	      'section'    => 'asalah_layout_control_post',
	      'settings'   => 'asalah_show_share_effect',
	      'choices'    => array(
	          'hover' => __('On Hovering/Mouse Over', 'writing'),
	          'always' => __('Always', 'writing')
	      ),
	  )
	));
	/* End Share and Continue Reading Settings Section */

	/* Start General Post/Page Settings Section */
	// Show Author Box
  $wp_customize->add_setting(
      'asalah_plain_page_title',
      array(
          'default'     => 'no',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_plain_page_title', array(
	      'label'      => __('Set Pages Title Style like Posts Title Style', 'writing'),
	      'section'    => 'asalah_layout_single',
	      'settings'   => 'asalah_plain_page_title',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing')
	      ),
	  )
	));

	// Show Author Box
  $wp_customize->add_setting(
      'show_author_box',
      array(
          'default'     => 'yes',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'show_author_box', array(
	      'label'      => __('Show Author Box', 'writing'),
	      'section'    => 'asalah_layout_single',
	      'settings'   => 'show_author_box',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing')
	      ),
	  )
	));

	// Show Posts Nav
	$wp_customize->add_setting(
      'asalah_show_posts_navigation',
      array(
          'default'     => 'yes',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_show_posts_navigation', array(
	      'label'      => __('Show Posts Navigation', 'writing'),
	      'section'    => 'asalah_layout_single',
	      'settings'   => 'asalah_show_posts_navigation',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing')
	      ),
	  )
	));

	// Show Posts Nav
	$wp_customize->add_setting(
      'asalah_posts_navigation_range',
      array(
          'default'     => 'all',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_posts_navigation_range', array(
	      'label'      => __('Show Next/Prev posts', 'writing'),
	      'section'    => 'asalah_layout_single',
	      'settings'   => 'asalah_posts_navigation_range',
	      'choices'    => array(
	          'all' => __('All Posts', 'writing'),
	          'category' => __('Posts In Same Category', 'writing')
	      ),
	  )
	));

	// Show Related Posts
  $wp_customize->add_setting(
      'asalah_show_related',
      array(
          'default'     => 'yes',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_show_related', array(
	      'label'      => __('Show Related Posts', 'writing'),
	      'section'    => 'asalah_layout_single',
	      'settings'   => 'asalah_show_related',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing')
	      ),
	  )
	));

	// Related Posts Relation Type
  $wp_customize->add_setting(
      'asalah_relation_posts',
      array(
          'default'     => 'category',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_relation_posts', array(
	      'label'      => __('Related Posts According to', 'writing'),
	      'section'    => 'asalah_layout_single',
	      'settings'   => 'asalah_relation_posts',
	      'choices'    => array(
	          'category' => __('Categories', 'writing'),
	          'tag' => __('Tags', 'writing'),
						'author' => __('Author', 'writing'),
	      ),
	  )
	));

	// Comments Order
  $wp_customize->add_setting(
      'asalah_show_comments_order',
      array(
          'default'     => 'oldest',
					'transport'   => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_show_comments_order', array(
	      'label'      => __('Show Comments Order', 'writing'),
	      'section'    => 'asalah_layout_single',
	      'settings'   => 'asalah_show_comments_order',
	      'choices'    => array(
	          'oldest' => 'Show oldest first',
						'newest' => 'Show most recent'
	      ),
	  )
	));

	// Show Share On Single
	$wp_customize->add_setting(
			'asalah_single_show_share',
			array(
					'default'     => 'yes',
					'transport'   => 'postMessage',
					'sanitize_callback' => 'esc_attr',
			)
	);

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_single_show_share', array(
	      'label'      => __('Show Share Icons At single posts', 'writing'),
	      'section'    => 'asalah_layout',
	      'settings'   => 'asalah_layout_single',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing')
	      ),
	  )
	));

	// Share Position
  $wp_customize->add_setting(
      'asalah_share_position',
      array(
          'default'     => 'after_content',
					'transport' => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_share_position', array(
	      'label'      => __('Share Icons Position', 'writing'),
	      'section'    => 'asalah_layout_single',
	      'settings'   => 'asalah_share_position',
	      'choices'    => array(
	          'after_content' => __('After Post Content', 'writing'),
	          'before_content' => __('Before Post Content', 'writing'),
						'after_before_content' => __('After & Before Post Content', 'writing')
	      ),
	  )
	));

	// Show Reading Progress
	$wp_customize->add_setting(
      'asalah_reading_progress',
      array(
          'default'     => 'no',
					'transport' => 'refresh',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_reading_progress', array(
	      'label'      => __('Show Reading Progress Bar', 'writing'),
	      'section'    => 'asalah_layout_single',
	      'settings'   => 'asalah_reading_progress',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing')
	      ),
	  )
	));
	/* End General Post/Page Settings Section */

	/* Start Privacy Notice Section */
	// Show Privacy Notice
	$wp_customize->add_setting(
      'writing_show_cookies_notice',
      array(
          'default'     => false,
					'transport' => 'refresh',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Toggle_Switch_Custom_control( $wp_customize, 'writing_show_cookies_notice', array(
	      'label'      => 'Show Privacy Notice',
	      'section'    => 'asalah_layout_privacy_notice',
	  )
	));

	/* show cookies notice */
	$wp_customize->add_setting(
	    'writing_show_cookies_notice',
	    array(
	    	'sanitize_callback' => 'absint',
	        'default'     => 0,
	    )
	);
	$wp_customize->add_control(new asalah_Toggle_Switch_Custom_control( $wp_customize, 'writing_show_cookies_notice', array(
	    'label'      => esc_attr__('Show a notice to tell site visitors that this site is using cookies, after you activate this option you still need to add cookies description text for notice to appear.', 'writing'),
	    'section'    => 'asalah_layout_privacy_notice',
	    'settings'   => 'writing_show_cookies_notice',
		)
	));

	$wp_customize->add_setting(
	    'writing_show_cookies_icon',
	    array(
	    	'sanitize_callback' => 'absint',
	        'default'     => 1,
	    )
	);
	$wp_customize->add_control(new asalah_Toggle_Switch_Custom_control( $wp_customize, 'writing_show_cookies_icon', array(
	    'label'      => esc_attr__('Show cookies box icon', 'writing'),
	    'section'    => 'asalah_layout_privacy_notice',
	    'settings'   => 'writing_show_cookies_icon',
		)
	));

	$wp_customize->add_setting(
        'writing_cookies_icon_class',
        array(
            'sanitize_callback' => 'esc_attr',
			'default' => '',
        )
    );
    $wp_customize->add_control('writing_cookies_icon_class', array(
        'label'  => esc_attr__('Cookies Font Awesome icon class', 'writing'),
        'description'  => esc_attr__('If you want to change cookies icon, you can choose other icon from Font Awesome library and add the full class of desired icon here to replace it.', 'writing'),
        'section'    => 'asalah_layout_privacy_notice',
        'settings'   => 'writing_cookies_icon_class',
        'type' => 'text'
    ));

	$wp_customize->add_setting(
        'writing_cookies_title',
        array(
            'sanitize_callback' => 'esc_attr',
			'default' => '',
        )
    );
    $wp_customize->add_control('writing_cookies_title', array(
        'label'      => esc_attr__('Cookies notice title', 'writing'),
        'section'    => 'asalah_layout_privacy_notice',
        'settings'   => 'writing_cookies_title',
        'type' => 'textarea'
    ));

    $wp_customize->add_setting(
        'writing_cookies_description_text',
        array(
            'sanitize_callback' => 'writing_sanitize_minimal_decoration',
			'default' => 'This site uses cookies so that we can remember you and understand how you use our site.You can change this message and links below in your site.',
        )
    );
    $wp_customize->add_control('writing_cookies_description_text', array(
        'label'      => esc_attr__('Cookies notice description text', 'writing'),
        'description' => esc_attr__( 'This text is used to tell your visitors that this site is using cookies, Allowed HTML Tags: a, em, br, strong, img, i.', 'writing' ),
        'section'    => 'asalah_layout_privacy_notice',
        'settings'   => 'writing_cookies_description_text',
        'type' => 'textarea'
    ));

    $wp_customize->add_setting(
        'writing_cookies_links_text',
        array(
            'sanitize_callback' => 'writing_sanitize_minimal_decoration',
						'default' => 'Please read our < a href = "#" > Cookies < /a> &amp; <a href="#">Privacy</a > policies',
        )
    );
    $wp_customize->add_control('writing_cookies_links_text', array(
        'label'      => esc_attr__('Cookies notice links area', 'writing'),
        'description' => esc_attr__( 'This text will appear just before the agree button to show your policies pages links, Allowed HTML Tags: a, em, br, strong, img, i.', 'writing' ),
        'section'    => 'asalah_layout_privacy_notice',
        'settings'   => 'writing_cookies_links_text',
        'type' => 'textarea'
    ));
    /* end cookies notice */
	/***
	End Layout Panel
	***/

	/***
	Start Taxonomies Panel
	***/
	/* Start Categories Settings Section */
	// Category Title Start
	$wp_customize->add_setting(
      'asalah_custom_cat_start',
      array(
				  'default' => '',
					'transport' => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control(
      'asalah_custom_cat_start',
      array(
          'section'  => 'asalah_taxonomies_cat',
          'label'    => 'Category Title Start',
					'description' => 'Add space to remove Title, leave blank for default',
          'type'     => 'text',
      )
  );

	// Category Description
	$wp_customize->add_setting(
      'asalah_cat_desc',
      array(
          'default'     => 'yes',
					'transport' => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_cat_desc', array(
	      'label'      => __('Show Category Description', 'writing'),
	      'section'    => 'asalah_taxonomies_cat',
	      'settings'   => 'asalah_cat_desc',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing')
	      ),
	  )
	));
	/* End Categories Settings Section */
	/* Start Tags Settings Section */
	// Tag Title Start
	$wp_customize->add_setting(
      'asalah_custom_tag_start',
      array(
				  'default' => '',
					'transport' => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control(
      'asalah_custom_tag_start',
      array(
          'section'  => 'asalah_taxonomies_tag',
          'label'    => 'Tag Title Start',
					'description' => 'Add space to remove Title, leave blank for default',
          'type'     => 'text',
      )
  );

	// Tag Description
	$wp_customize->add_setting(
      'asalah_tag_desc',
      array(
          'default'     => 'yes',
					'transport' => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control( new asalah_Text_Radio_Button_Custom_Control( $wp_customize, 'asalah_tag_desc', array(
	      'label'      => __('Show Tag Description', 'writing'),
	      'section'    => 'asalah_taxonomies_tag',
	      'settings'   => 'asalah_tag_desc',
	      'choices'    => array(
	          'yes' => __('Yes', 'writing'),
	          'no' => __('No', 'writing')
	      ),
	  )
	));
	/* End Tags Settings Section */
	/***
	End Taxonomies Panel
	***/
  /* Custom Background */

  $wp_customize->add_setting( 'background_image', array(
      'default'        => get_theme_support( 'custom-background', 'default-image' ),
      'theme_supports' => 'custom-background',
			'transport' => 'refresh',
      'sanitize_callback' => 'esc_attr',
  ) );

  $wp_customize->add_setting( new WP_Customize_Background_Image_Setting( $wp_customize, 'background_image_thumb', array(
      'theme_supports' => 'custom-background',
			'transport' => 'refresh',
      'sanitize_callback' => 'esc_attr',
  ) ) );

  $wp_customize->add_control( new WP_Customize_Background_Image_Control( $wp_customize ) );

  $wp_customize->add_setting( 'background_repeat', array(
      'default'        => 'repeat',
      'theme_supports' => 'custom-background',
			'transport' => 'refresh',
      'sanitize_callback' => 'esc_attr',
  ) );

  $wp_customize->add_control( 'background_repeat', array(
      'label'      => __( 'Background Repeat', 'writing' ),
      'section'    => 'background_image',
      'type'       => 'radio',
      'choices'    => array(
          'no-repeat'  => __('No Repeat', 'writing'),
          'repeat'     => __('Tile', 'writing'),
          'repeat-x'   => __('Tile Horizontally', 'writing'),
          'repeat-y'   => __('Tile Vertically', 'writing'),
      ),
  ) );

  $wp_customize->add_setting( 'background_position_x', array(
      'default'        => 'left',
      'theme_supports' => 'custom-background',
			'transport' => 'refresh',
      'sanitize_callback' => 'esc_attr',
  ) );

  $wp_customize->add_control( 'background_position_x', array(
      'label'      => __( 'Background Position', 'writing' ),
      'section'    => 'background_image',
      'type'       => 'radio',
      'choices'    => array(
          'left'       => __('Left', 'writing'),
          'center'     => __('Center', 'writing'),
          'right'      => __('Right', 'writing'),
      ),
  ) );

  $wp_customize->add_setting( 'background_attachment', array(
      'default'        => 'fixed',
      'theme_supports' => 'custom-background',
			'transport' => 'refresh',
      'sanitize_callback' => 'esc_attr',
  ) );

  $wp_customize->add_control( 'background_attachment', array(
      'label'      => __( 'Background Attachment', 'writing' ),
      'section'    => 'background_image',
      'type'       => 'radio',
      'choices'    => array(
          'fixed'      => __('Fixed', 'writing'),
          'scroll'     => __('Scroll', 'writing'),
      ),
  ) );

	// Number of Posts
  $wp_customize->add_setting(
      'posts_per_page',
      array(
					'type' => 'option',
				  'default' => get_option('posts_per_page'),
					'transport' => 'postMessage',
          'sanitize_callback' => 'esc_attr',
      )
  );

  $wp_customize->add_control('posts_per_page',
      array(
          'section'  => 'static_front_page',
          'label'    => 'Number of Posts',
          'type'     => 'text',
      )
  );

	/* --------
	change title and description to postMessage
	------------------------------------------- */
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_control( 'blogname' )->description = __('You can customize Text Logo Style from <a data-control="asalah_logo_text" data-focus="section" href="#" class="asalah-custom-refresh-partial">Text Logo Settings</a>.', 'writing');
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_control( 'blogdescription' )->description = __('You can customize tagline from <a data-control="asalah_show_tagline" href="#" class="asalah-custom-refresh-partial">Tagline Settings</a>.', 'writing');
	$wp_customize->remove_control( 'display_header_text' );

	$custom_css_items = array(
												'asalah_remove_logo_dot',
												'asalah_header_background',
												'asalah_header_background_style',
												'asalah_header_height',
												'asalah_enable_header_color',
												'asalah_header_color',
												'asalah_enable_header_text_color',
												'asalah_header_text_color',
												'asalah_enable_header_hover_color',
												'asalah_header_hover_color',
												'asalah_center_logo',
												'asalah_custom_css_code',
												'asalah_logo_font_size',
												'asalah_tagline_font_size',
												'asalah_tagline_line_height',
												'asalah_enable_top_menu_color',
												'asalah_top_menu_color',
												'asalah_enable_top_menu_text_color',
												'asalah_top_menu_text_color',
												'asalah_enable_top_menu_hover_color',
												'asalah_top_menu_hover_color',
												'asalah_main_color',
												'asalah_enable_body_background_color',
												'asalah_body_background_color',
												'asalah_enable_post_background_color',
												'asalah_post_background_color',
												'asalah_enable_main_text_color',
												'asalah_main_text_color',
												'asalah_enable_text_hover_color',
												'asalah_text_hover_color',
												'asalah_enable_custom_css',
												'asalah_main_font_size',
												'asalah_main_line_height',
												'asalah_menu_font_size',
												'asalah_menu_line_height',
												'asalah_bloglist_title_font_size',
												'asalah_bloglist_title_line_height',
												'asalah_blogsingle_title_font_size',
												'asalah_blogsingle_title_line_height',
												'asalah_metainfo_font_size',
												'asalah_metainfo_line_height',
												'asalah_widgettitle_font_size',
												'asalah_widgettitle_line_height',
												'asalah_blog_font_size',
												'asalah_blog_line_height',
												'asalah_blog_description_font_size',
												'asalah_blog_description_line_height',

											);
	// add typography headings classes
	for ($head_tag = 1; $head_tag  < 7; $head_tag ++) {
		array_push($custom_css_items, 'asalah_h'.$head_tag.'_font_size');
		array_push($custom_css_items, 'asalah_h'.$head_tag.'_line_height');
	}
	// blog description section
	$wp_customize->selective_refresh->add_partial( 'asalah_remove_logo_dot', array(
		'selector' => '#asalah_custom_style_code',
		'settings' => $custom_css_items,
		'container_inclusive' => false,
		'render_callback' => 'asalah_customize_partial_custom_css_code',
		'fallback_refresh' => false
	) );
}
add_action( 'customize_register', 'asalah_register_theme_customizer' );
?>
