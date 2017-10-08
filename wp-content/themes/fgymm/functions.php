<?php
/*
 * fGymm functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 */

require_once( trailingslashit( get_template_directory() ) . 'customize-pro/class-customize.php' );

if ( ! function_exists( 'fgymm_setup' ) ) :
/**
 * fGymm setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 */
function fgymm_setup() {

	load_theme_textdomain( 'fgymm', get_template_directory() . '/languages' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Primary Menu', 'fgymm' ),
	) );

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 0, true );

	global $content_width;
	if ( ! isset( $content_width ) )
		$content_width = 900;

	add_theme_support( 'automatic-feed-links' );

	// add Custom background				 
	$args = array(
		'default-color' 	 => '#FFFFFF',
	);
	add_theme_support( 'custom-background', $args );

	// add custom header
    add_theme_support( 'custom-header', array (
                       'default-image'          => '',
                       'random-default'         => '',
                       'flex-height'            => true,
                       'flex-width'             => true,
                       'uploads'                => true,
                       'width'                  => 900,
                       'height'                 => 100,
                       'default-text-color'        => '#cccccc',
                       'wp-head-callback'       => 'fgymm_header_style',
                    ) );

    // add custom logo
    add_theme_support( 'custom-logo', array (
                       'width'                  => 145,
                       'height'                 => 36,
                       'flex-height'            => true,
                       'flex-width'             => true,
                    ) );
					
	add_theme_support( "title-tag" );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form', 'comment-list',
	) );

	

	// add the visual editor to resemble the theme style
	add_editor_style( array( 'css/editor-style.css', get_template_directory_uri() . '/css/font-awesome.min.css' ) );
}
endif; // fgymm_setup
add_action( 'after_setup_theme', 'fgymm_setup' );

/**
 * the main function to load scripts in the fGymm theme
 * if you add a new load of script, style, etc. you can use that function
 * instead of adding a new wp_enqueue_scripts action for it.
 */
function fgymm_load_scripts() {

	// load main stylesheet.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array( ) );
	wp_enqueue_style( 'fgymm-style', get_stylesheet_uri(), array() );
	
	wp_enqueue_style( 'fgymm-fonts', fgymm_fonts_url(), array(), null );
	
	// Load thread comments reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
	
	// Load Utilities JS Script
	wp_enqueue_script( 'fgymm-utilities-js', get_template_directory_uri() . '/js/utilities.js', array( 'jquery' ) );
	
	wp_enqueue_script( 'jquery.mobile.customized', get_template_directory_uri() . '/js/jquery.mobile.customized.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery.easing.1.3', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array( 'jquery' ) );
	wp_enqueue_script( 'camera', get_template_directory_uri() . '/js/camera.min.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'fgymm_load_scripts' );

/**
 *	widgets-init action handler. Used to register widgets and register widget areas
 */
function fgymm_widgets_init() {

	// Sidebar Widget.
	register_sidebar( array (
						'name'	 		 =>	 __( 'Sidebar Widget Area', 'fgymm'),
						'id'		 	 =>	 'sidebar-widget-area',
						'description'	 =>  __( 'The sidebar widget area', 'fgymm'),
						'before_widget'	 =>  '',
						'after_widget'	 =>  '',
						'before_title'	 =>  '<div class="sidebar-before-title"></div><h3 class="sidebar-title">',
						'after_title'	 =>  '</h3><div class="sidebar-after-title"></div>',
					) );

	/**
	 * Add Homepage Columns Widget areas
	 */
	register_sidebar( array (
							'name'			 =>  __( 'Homepage Column #1', 'fgymm' ),
							'id' 			 =>  'homepage-column-1-widget-area',
							'description'	 =>  __( 'The Homepage Column #1 widget area', 'fgymm' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="sidebar-title">',
							'after_title'	 =>  '</h2><div class="sidebar-after-title"></div>',
						) );
						
	register_sidebar( array (
							'name'			 =>  __( 'Homepage Column #2', 'fgymm' ),
							'id' 			 =>  'homepage-column-2-widget-area',
							'description'	 =>  __( 'The Homepage Column #2 widget area', 'fgymm' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="sidebar-title">',
							'after_title'	 =>  '</h2><div class="sidebar-after-title"></div>',
						) );

	register_sidebar( array (
							'name'			 =>  __( 'Homepage Column #3', 'fgymm' ),
							'id' 			 =>  'homepage-column-3-widget-area',
							'description'	 =>  __( 'The Homepage Column #3 widget area', 'fgymm' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="sidebar-title">',
							'after_title'	 =>  '</h2><div class="sidebar-after-title"></div>',
						) );


	// Register Footer Column #1
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #1', 'fgymm' ),
							'id' 			 =>  'footer-column-1-widget-area',
							'description'	 =>  __( 'The Footer Column #1 widget area', 'fgymm' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
	
	// Register Footer Column #2
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #2', 'fgymm' ),
							'id' 			 =>  'footer-column-2-widget-area',
							'description'	 =>  __( 'The Footer Column #2 widget area', 'fgymm' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
	
	// Register Footer Column #3
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #3', 'fgymm' ),
							'id' 			 =>  'footer-column-3-widget-area',
							'description'	 =>  __( 'The Footer Column #3 widget area', 'fgymm' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
}
add_action( 'widgets_init', 'fgymm_widgets_init' );

/**
 *	Load google font url used in the fGymm theme
 */
function fgymm_fonts_url() {

    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by PT Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $pt_sans = _x( 'on', 'PT Sans font: on or off', 'fgymm' );
 
    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $open_sans = _x( 'on', 'Open Sans font: on or off', 'fgymm' );
 
    if ( 'off' !== $pt_sans || 'off' !== $open_sans ) {
        $font_families = array();
 
        if ( 'off' !== $pt_sans ) {
            $font_families[] = 'PT+Sans:400,400italic,700,700italic';
        }
 
        if ( 'off' !== $open_sans ) {
            $font_families[] = 'Open Sans:700italic,400,800,600';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }
 
    return $fonts_url;
}

function fgymm_show_social_sites() {

	$socialURL = get_theme_mod('fgymm_social_facebook', '#');
	if ( !empty($socialURL) ) {

		echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Facebook', 'fgymm') . '" class="facebook16"></a>';
	}

	$socialURL = get_theme_mod('fgymm_social_google', '#');
	if ( !empty($socialURL) ) {

		echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Google+', 'fgymm') . '" class="google16"></a>';
	}

	$socialURL = get_theme_mod('fgymm_social_twitter', '#');
	if ( !empty($socialURL) ) {

		echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Twitter', 'fgymm') . '" class="twitter16"></a>';
	}

	$socialURL = get_theme_mod('fgymm_social_linkedin', '#');
	if ( !empty($socialURL) ) {

		echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on LinkedIn', 'fgymm') . '" class="linkedin16"></a>';
	}

	$socialURL = get_theme_mod('fgymm_social_instagram', '#');
	if ( !empty($socialURL) ) {

		echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Instagram', 'fgymm') . '" class="instagram16"></a>';
	}

	$socialURL = get_theme_mod('fgymm_social_rss', get_bloginfo( 'rss2_url' ));
	if ( !empty($socialURL) ) {

		echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow our RSS Feeds', 'fgymm') . '" class="rss16"></a>';
	}

	$socialURL = get_theme_mod('fgymm_social_tumblr', '#');
	if ( !empty($socialURL) ) {

		echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Tumblr', 'fgymm') . '" class="tumblr16"></a>';
	}

	$socialURL = get_theme_mod('fgymm_social_youtube', '#');
	if ( !empty($socialURL) ) {

		echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Youtube', 'fgymm') . '" class="youtube16"></a>';
	}

	$socialURL = get_theme_mod('fgymm_social_pinterest', '#');
	if ( !empty($socialURL) ) {

		echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Pinterest', 'fgymm') . '" class="pinterest16"></a>';
	}

	$socialURL = get_theme_mod('fgymm_social_vk', '#');
	if ( !empty($socialURL) ) {

		echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on VK', 'fgymm') . '" class="vk16"></a>';
	}

	$socialURL = get_theme_mod('fgymm_social_flickr', '#');
	if ( !empty($socialURL) ) {

		echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Flickr', 'fgymm') . '" class="flickr16"></a>';
	}

	$socialURL = get_theme_mod('fgymm_social_vine', '#');
	if ( !empty($socialURL) ) {

		echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Vine', 'fgymm') . '" class="vine16"></a>';
	}
}

/**
 * Display website's logo image
 */
function fgymm_show_website_logo_image_and_title() {

	if ( has_custom_logo() ) {

        the_custom_logo();
    }

    $header_text_color = get_header_textcolor();

    if ( 'blank' !== $header_text_color ) {
    
        echo '<div id="site-identity">';
        echo '<a href="' . esc_url( home_url('/') ) . '" title="' . esc_attr( get_bloginfo('name') ) . '">';
        echo '<h1 class="entry-title">' . esc_html( get_bloginfo('name') ) . '</h1>';
        echo '</a>';
        echo '<strong>' . esc_html( get_bloginfo('description') ) . '</strong>';
        echo '</div>';
    }
}

/**
 *	Displays the copyright text.
 */
function fgymm_show_copyright_text() {
	
	$footerText = get_theme_mod('fgymm_footer_copyright', null);

	if ( !empty( $footerText ) ) {

		echo esc_html( $footerText ) . ' | ';		
	}
}

/**
 * Displays the slider
 */
function fgymm_display_slider() {
?>
	<div class="camera_wrap camera_emboss" id="camera_wrap">
		<?php
			// display slides
			for ( $i = 1; $i <= 3; ++$i ) {

					$defaultSlideContent = __( '<h3>Lorem ipsum dolor</h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><a title="Read more" href="#">Read more</a>', 'fgymm' );
					
					$defaultSlideImage = get_template_directory_uri().'/images/slider/' . $i .'.jpg';

					$slideContent = get_theme_mod( 'fgymm_slide'.$i.'_content', html_entity_decode( $defaultSlideContent ) );
					$slideImage = get_theme_mod( 'fgymm_slide'.$i.'_image', $defaultSlideImage );

				?>

					<div data-thumb="<?php echo esc_attr( $slideImage ); ?>" data-src="<?php echo esc_attr( $slideImage ); ?>">
						<div class="camera_caption fadeFromBottom">
							<?php echo $slideContent; ?>
						</div>
					</div>
<?php		} ?>
	</div><!-- #camera_wrap -->
<?php 
}

/**
 *	Used to load the content for posts and pages.
 */
function fgymm_the_content() {

	// Display Thumbnails if thumbnail is set for the post
	if ( has_post_thumbnail() ) {
?>

		<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail(); ?>
		</a>
								
<?php
	}
	the_content( __( 'Read More', 'fgymm') );
}

/**
 *	Displays the single content.
 */
function fgymm_the_content_single() {

	// Display Thumbnails if thumbnail is set for the post
	if ( has_post_thumbnail() ) {

		the_post_thumbnail();
	}
	the_content( __( 'Read More...', 'fgymm') );
}

/**
 * Register theme settings in the customizer
 */
function fgymm_customize_register( $wp_customize ) {

	/**
	 * Add Slider Section
	 */
	$wp_customize->add_section(
		'fgymm_slider_section',
		array(
			'title'       => __( 'Slider', 'fgymm' ),
			'capability'  => 'edit_theme_options',
		)
	);
	
	for ($i = 1; $i <= 3; ++$i) {
	
		$slideContentId = 'fgymm_slide'.$i.'_content';
		$slideImageId = 'fgymm_slide'.$i.'_image';
		$defaultSliderImagePath = get_template_directory_uri().'/images/slider/'.$i.'.jpg';
	
		// Add Slide Content
		$wp_customize->add_setting(
			$slideContentId,
			array(
				'default'           => __( '<h2>Lorem ipsum dolor</h2><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><a title="Read more" href="#">Read more</a>', 'fgymm' ),
				'sanitize_callback' => 'force_balance_tags',
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $slideContentId,
									array(
										'label'          => sprintf( esc_html__( 'Slide #%s Content', 'fgymm' ), $i ),
										'section'        => 'fgymm_slider_section',
										'settings'       => $slideContentId,
										'type'           => 'textarea',
										)
									)
		);
		
		// Add Slide Background Image
		$wp_customize->add_setting( $slideImageId,
			array(
				'default' => $defaultSliderImagePath,
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $slideImageId,
				array(
					'label'   	 => sprintf( esc_html__( 'Slide #%s Image', 'fgymm' ), $i ),
					'section' 	 => 'fgymm_slider_section',
					'settings'   => $slideImageId,
				) 
			)
		);
	}

	/**
	 * Add Footer Section
	 */
	$wp_customize->add_section(
		'fgymm_footer_section',
		array(
			'title'       => __( 'Footer', 'fgymm' ),
			'capability'  => 'edit_theme_options',
		)
	);
	
	// Add footer copyright text
	$wp_customize->add_setting(
		'fgymm_footer_copyright',
		array(
		    'default'           => '',
		    'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fgymm_footer_copyright',
        array(
            'label'          => __( 'Copyright Text', 'fgymm' ),
            'section'        => 'fgymm_footer_section',
            'settings'       => 'fgymm_footer_copyright',
            'type'           => 'text',
            )
        )
	);

	/**
	 * Add Social Sites Section
	 */
	$wp_customize->add_section(
		'fgymm_social_section',
		array(
			'title'       => __( 'Social Sites', 'fgymm' ),
			'capability'  => 'edit_theme_options',
		)
	);
	
	// Add facebook url
	$wp_customize->add_setting(
		'fgymm_social_facebook',
		array(
		    'default'           => '#',
		    'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fgymm_social_facebook',
        array(
            'label'          => __( 'Facebook Page URL', 'fgymm' ),
            'section'        => 'fgymm_social_section',
            'settings'       => 'fgymm_social_facebook',
            'type'           => 'text',
            )
        )
	);

	// Add google+ url
	$wp_customize->add_setting(
		'fgymm_social_google',
		array(
		    'default'           => '#',
		    'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fgymm_social_google',
        array(
            'label'          => __( 'Google+ Page URL', 'fgymm' ),
            'section'        => 'fgymm_social_section',
            'settings'       => 'fgymm_social_google',
            'type'           => 'text',
            )
        )
	);

	// Add Twitter url
	$wp_customize->add_setting(
		'fgymm_social_twitter',
		array(
		    'default'           => '#',
		    'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fgymm_social_twitter',
        array(
            'label'          => __( 'Twitter URL', 'fgymm' ),
            'section'        => 'fgymm_social_section',
            'settings'       => 'fgymm_social_twitter',
            'type'           => 'text',
            )
        )
	);

	// Add LinkedIn url
	$wp_customize->add_setting(
		'fgymm_social_linkedin',
		array(
		    'default'           => '#',
		    'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fgymm_social_linkedin',
        array(
            'label'          => __( 'LinkedIn URL', 'fgymm' ),
            'section'        => 'fgymm_social_section',
            'settings'       => 'fgymm_social_linkedin',
            'type'           => 'text',
            )
        )
	);

	// Add Instagram url
	$wp_customize->add_setting(
		'fgymm_social_instagram',
		array(
		    'default'           => '#',
		    'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fgymm_social_instagram',
        array(
            'label'          => __( 'LinkedIn URL', 'fgymm' ),
            'section'        => 'fgymm_social_section',
            'settings'       => 'fgymm_social_instagram',
            'type'           => 'text',
            )
        )
	);

	// Add RSS Feeds url
	$wp_customize->add_setting(
		'fgymm_social_rss',
		array(
		    'default'           => get_bloginfo( 'rss2_url' ),
		    'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fgymm_social_rss',
        array(
            'label'          => __( 'RSS Feeds URL', 'fgymm' ),
            'section'        => 'fgymm_social_section',
            'settings'       => 'fgymm_social_rss',
            'type'           => 'text',
            )
        )
	);

	// Add Tumblr url
	$wp_customize->add_setting(
		'fgymm_social_tumblr',
		array(
		    'default'           => '#',
		    'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fgymm_social_tumblr',
        array(
            'label'          => __( 'Tumblr URL', 'fgymm' ),
            'section'        => 'fgymm_social_section',
            'settings'       => 'fgymm_social_tumblr',
            'type'           => 'text',
            )
        )
	);

	// Add YouTube channel url
	$wp_customize->add_setting(
		'fgymm_social_youtube',
		array(
		    'default'           => '#',
		    'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fgymm_social_youtube',
        array(
            'label'          => __( 'YouTube channel URL', 'fgymm' ),
            'section'        => 'fgymm_social_section',
            'settings'       => 'fgymm_social_youtube',
            'type'           => 'text',
            )
        )
	);

	// Add Pinterest url
	$wp_customize->add_setting(
		'fgymm_social_pinterest',
		array(
		    'default'           => '#',
		    'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fgymm_social_pinterest',
        array(
            'label'          => __( 'Pinterest URL', 'fgymm' ),
            'section'        => 'fgymm_social_section',
            'settings'       => 'fgymm_social_pinterest',
            'type'           => 'text',
            )
        )
	);

	// Add VK url
	$wp_customize->add_setting(
		'fgymm_social_vk',
		array(
		    'default'           => '#',
		    'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fgymm_social_vk',
        array(
            'label'          => __( 'VK URL', 'fgymm' ),
            'section'        => 'fgymm_social_section',
            'settings'       => 'fgymm_social_vk',
            'type'           => 'text',
            )
        )
	);

	// Add Flickr url
	$wp_customize->add_setting(
		'fgymm_social_flickr',
		array(
		    'default'           => '#',
		    'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fgymm_social_flickr',
        array(
            'label'          => __( 'Flickr URL', 'fgymm' ),
            'section'        => 'fgymm_social_section',
            'settings'       => 'fgymm_social_flickr',
            'type'           => 'text',
            )
        )
	);

	// Add Vine url
	$wp_customize->add_setting(
		'fgymm_social_vine',
		array(
		    'default'           => '#',
		    'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fgymm_social_vine',
        array(
            'label'          => __( 'Vine URL', 'fgymm' ),
            'section'        => 'fgymm_social_section',
            'settings'       => 'fgymm_social_vine',
            'type'           => 'text',
            )
        )
	);
}
add_action('customize_register', 'fgymm_customize_register');

/**
 *	Displays date for blog posts
 */
function fgymm_show_post_date() { 

	$postDate = strtotime( get_the_time( get_option( 'date_format' ) ) );
?>
	<div class="postdate">
		<div class="day">
			<?php echo date( 'd', $postDate ); ?>
		</div>
		<div class="month">
			<?php echo date( 'M', $postDate); ?>
		</div>
		<div class="year">
			<?php echo date( 'Y', $postDate); ?>
		</div>
	</div>
<?php
}

function fgymm_header_style() {

    $header_text_color = get_header_textcolor();

    if ( ! has_header_image()
        && ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color
             || 'blank' === $header_text_color ) ) {

        return;
    }

    $headerImage = get_header_image();
?>
    <style type="text/css">
        <?php if ( has_header_image() ) : ?>

                #header-main-fixed {background-image: url("<?php echo esc_url( $headerImage ); ?>");}

        <?php endif; ?>

        <?php if ( get_theme_support( 'custom-header', 'default-text-color' ) !== $header_text_color
                    && 'blank' !== $header_text_color ) : ?>

                #header-main-fixed, #header-main-fixed h1.entry-title {color: #<?php echo esc_attr( $header_text_color ); ?>;}

        <?php endif; ?>
    </style>
<?php

}

?>