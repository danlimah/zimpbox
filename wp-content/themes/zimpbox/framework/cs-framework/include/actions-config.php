<?php
/**
 * The template for requried actions hooks.
 *
 * @package mevo
 * @since 1.0
 */

add_action( 'wp_head', 'mevo_print_header_info');
add_action( 'widgets_init', 'mevo_register_widgets' );
add_action( 'wp_enqueue_scripts', 'mevo_enqueue_scripts');
add_action( 'wp_head', 'mevo_custom_styles', 8);
add_action( 'tgmpa_register', 'mevo_include_required_plugins' );

define( 'CS_ACTIVE_FRAMEWORK', true );
define( 'CS_ACTIVE_METABOX',   false );
define( 'CS_ACTIVE_SHORTCODE', false );
define( 'CS_ACTIVE_CUSTOMIZE', false );

function mevo_register_widgets() {
	// register sidebars
	register_sidebar(
		array(
			'id' 			=> 'sidebar',
			'name' 			=> esc_html__( 'Sidebar', 'mevo' ),
			'before_widget' => '<div class="widget">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'description' 	=> esc_html__( 'Drag the widgets for sidebars.', 'mevo' )
		)
	);
	
	register_sidebar(
		array(
			'id' 			=> 'first-footer-sidebar',
			'name' 			=> esc_html__( 'First footer sidebar', 'mevo' ),
			'before_widget' => '<div id="%1$s" class="element widget-wrapper clearfix col1-3 home grey auto %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h4 class="f-widget-title">',
			'after_title' 	=> '</h4>',
			'description' 	=> esc_html__( 'Drag the widgets for sidebars.', 'mevo' )
		)
	);

	register_sidebar(
		array(
			'id' 			=> 'second-footer-sidebar',
			'name' 			=> esc_html__( 'Second footer sidebar', 'mevo' ),
			'before_widget' => '<div id="%1$s" class="element widget-wrapper clearfix col1-3 home grey auto %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h4 class="f-widget-title">',
			'after_title' 	=> '</h4>',
			'description' 	=> esc_html__( 'Drag the widgets for sidebars.', 'mevo' )
		)
	);

	register_sidebar(
		array(
			'id' 			=> 'third-footer-sidebar',
			'name' 			=> esc_html__( 'Third footer sidebar', 'mevo' ),
			'before_widget' => '<div id="%1$s" class="element widget-wrapper clearfix col1-3 home grey auto %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h4 class="f-widget-title">',
			'after_title' 	=> '</h4>',
			'description' 	=> esc_html__( 'Drag the widgets for sidebars.', 'mevo' )
		)
	);

	register_sidebar(
		array(
			'id' 			=> 'fourth-footer-sidebar',
			'name' 			=> esc_html__( 'Fourth footer sidebar', 'mevo' ),
			'before_widget' => '<div id="%1$s" class="element widget-wrapper clearfix col1-3 home grey auto %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h4 class="f-widget-title">',
			'after_title' 	=> '</h4>',
			'description' 	=> esc_html__( 'Drag the widgets for sidebars.', 'mevo' )
		)
	);
}


function mevo_print_header_info() {
	$head = '';
	$custom_css = cs_get_option( 'custom_css_styles' );
	$header_color = cs_get_option( 'header_color' );
	$custom_css .= ( ! empty( $header_color ) ) ? '.header.style-2, .header.style-1.scrolled, .header.style-3.show {background: ' . cs_get_option( "header_color" ) . ';} ' : '';
	if ( ! empty( $custom_css ) ) {
    	$head = '
    	<style>
    		' . $custom_css . '
    	</style>';
	}
	print $head;
}

/**
* @ return null
* @ param none
* @ loads all the js and css script to frontend
**/
function mevo_enqueue_scripts() {
	global $mevo;

	// general settings
	if( ( is_admin() ) ) { return; }

	// add TinyMCE style
	add_editor_style();

	wp_enqueue_script( 'idangerous', 	  T_URI . '/assets/js/idangerous.swiper.min.js', 						array( 'jquery' ), false, true );
	wp_enqueue_script( 'tubular', 	  	  T_URI . '/assets/js/jquery.tubular.1.0.js', 							array( 'jquery' ), false, true );
	wp_enqueue_script( 'isotope', 		  T_URI . '/assets/js/isotope.pkgd.min.js', 							array( 'jquery' ), false, true );
	wp_enqueue_script( 'viewportchecker', T_URI . '/assets/js/jquery.viewportchecker.min.js', 					array( 'jquery' ), false, true );
	wp_enqueue_script( 'countTo', 		  T_URI . '/assets/js/jquery.countTo.js', 								array( 'jquery' ), false, true );
	wp_enqueue_script( 'circliful', 	  T_URI . '/assets/js/jquery.circliful.min.js', 						array( 'jquery' ), false, true );
	wp_enqueue_script( 'imagelightbox',   T_URI . '/assets/js/imagelightbox.min.js', 							array( 'jquery' ), false, true );
	wp_enqueue_script( 'gmaps', 		 'http://maps.googleapis.com/maps/api/js?sensor=false&amp;language=en', array( 'jquery' ), false, true );
	wp_enqueue_script( 'map', 			  T_URI . '/assets/js/map.js', 											array( 'jquery' ), false, true );
	wp_enqueue_script( 'global', 		  T_URI . '/assets/js/global.js', 										array( 'jquery' ), false, true );
	wp_enqueue_script( 'navigation', 	  T_URI . '/assets/js/anchors.navigation.js', 							array( 'jquery' ), false, true );

	wp_enqueue_script( 'jquery-migrate' );

	// including jQuery plugins
	wp_localize_script('jquery-scripts', 'get',
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'siteurl' => get_template_directory_uri()
		)
	);

	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'wp-css',		    T_URI . '/style.css' );
	wp_enqueue_style( 'animate',		T_URI . '/assets/css/animate.css' );
	wp_enqueue_style( 'bootstrap',		T_URI . '/assets/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome',	T_URI . '/assets/css/font-awesome.min.css' );
	wp_enqueue_style( 'idangerous',		T_URI . '/assets/css/idangerous.swiper.css' );
	wp_enqueue_style( 'theme-style',	T_URI . '/assets/css/style.css' );
	// Add styles for Onepage site type;
	if( $mevo['site_type'] == 'onepage' ) {
		wp_enqueue_style( 'dynamic-css',	admin_url('admin-ajax.php').'?action=mevo_dynamic_css', '', '1.0');
	}
}

/**
* Include plugins
**/
function mevo_include_required_plugins() {

	$plugins = array(

		array(
			'name'     				=> 'Contact Form 7', // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Visual Composer', // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> 'http://demo.nrgthemes.com/projects/plugins/js_composer.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Mevo Plugins', // The plugin name
			'slug'     				=> 'mevo-plugins', // The plugin slug (typically the folder name)
			'source'   				=> T_PATH .'/'. F_PATH .'/importer/plugins/mevo-plugins.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
	);

	// Change this to your theme text domain, used for internationalising strings

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'mevo',         			// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> esc_html__( 'Install Required Plugins', 'mevo' ),
			'menu_title'                       			=> esc_html__( 'Install Plugins', 'mevo' ),
			'installing'                       			=> esc_html__( 'Installing Plugin: %s', 'mevo' ), // %1$s = plugin name
			'oops'                             			=> esc_html__( 'Something went wrong with the plugin API.', 'mevo' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'mevo' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'mevo' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'mevo' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'mevo' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'mevo' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'mevo' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' , 'mevo' ),// %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'mevo' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' , 'mevo' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' , 'mevo' ),
			'return'                           			=> esc_html__( 'Return to Required Plugins Installer', 'mevo' ),
			'plugin_activated'                 			=> esc_html__( 'Plugin activated successfully.', 'mevo' ),
			'complete' 									=> esc_html__( 'All plugins installed and activated successfully. %s', 'mevo' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);
	tgmpa( $plugins, $config );
}

function mevo_custom_styles() {

	$style = '<style type="text/css" media="screen">';

	///HEADER LOGO//////////////////////////////////////////////////////
	$site_logo = cs_get_option( 'site_logo' );
	if ( $site_logo[0] == 'imglogo' ) {
		//Header logo image
		$header_logo = cs_get_option( 'image_logo' );
		$header_logo_retina = cs_get_option( 'image_logo_2x' );
		$header_logo_height = cs_get_option( 'img_logo_height' );
		$header_logo_width = cs_get_option( 'img_logo_width' );

		$style .= '.header-logo {background:url(' . $header_logo . ') center no-repeat; width:' . $header_logo_width . 'px !important; height:' . $header_logo_height . 'px !important;}';
		if ( strlen( $header_logo_retina ) > 3 ) {
			$style .= 'only screen and (min-device-pixel-ratio: 1.5) { .header-logo {background:url(' . $header_logo_retina . ') center no-repeat; width:' . $header_logo_width . 'px !important; height:' . $header_logo_height . 'px !important;} } }';
		}

	} else {
		//Header logo text
		$header_tagline_color = cs_get_option( 'logo_tagline_color' );
		$style .= ( ! empty( $header_tagline_color ) ) ? '.logo-wrapper .tagline span { color:' . $header_tagline_color . '; }' : '';
		$style .= '.logo-wrapper h1#logo a {background: transparent; text-indent: inherit; line-height: 52px; }';

		$header_logo_color = cs_get_option( 'text_logo_color' );
		$style .= ( ! empty( $header_logo_color ) ) ? '.logo-wrapper h1#logo a {color:' . $header_logo_color . ';}' : '';

		$text_logo_font_size = cs_get_option( 'text_logo_font_size' );
		$style .= ( ! empty( $text_logo_font_size ) ) ? '.logo-wrapper h1#logo a {font-size:' . $text_logo_font_size . ';}' : '';

		$header_logo_width = cs_get_option( 'text_logo_width' );
		$style .= ( ! empty( $header_logo_width ) ) ? '#logo {width:' . $header_logo_width . ' !important;}' : '';
	}
	$style .= '</style>';

	print $style;
}

function mevo_dynamic_css() {
	require( get_template_directory() . '/assets/css/custom.css.php' );
	wp_die();
}
add_action( 'wp_ajax_nopriv_mevo_dynamic_css', 'mevo_dynamic_css' );
add_action( 'wp_ajax_mevo_dynamic_css', 'mevo_dynamic_css' );