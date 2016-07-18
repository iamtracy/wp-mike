<?php
/**
 * The template for requried actions hooks.
 *
 * @package gnoli
 * @since 1.0
 */

add_action( 'wp_enqueue_scripts', 'enqueue_scripts');
add_action( 'wp_head', 'gnoli_custom_styles', 8);
add_action( 'widgets_init', 'gnoli_register_widgets' );
add_action( 'tgmpa_register', 'gnoli_include_required_plugins' );

define( 'CS_ACTIVE_FRAMEWORK', true );
define( 'CS_ACTIVE_METABOX',   true );
define( 'CS_ACTIVE_SHORTCODE', false );
define( 'CS_ACTIVE_CUSTOMIZE', false );

/*
 * Register sidebar.
 */
function gnoli_register_widgets() {
	// register sidebars
	register_sidebar(
		array(
			'id' 			=> 'sidebar',
			'name' 			=> 'Sidebar',
			'before_widget' => '<div id="%1$s" class="sidebar-item %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h5>',
			'after_title' 	=> '</h5>',
			'description' 	=> 'Drag the widgets for sidebars.'
		)
	);
}

/**
* @ return null
* @ param none
* @ loads all the js and css script to frontend
**/
function enqueue_scripts() {

	// general settings
	if( ( is_admin() ) ) { return; }
	wp_enqueue_script( 'scripts-js',	T_URI . '/assets/js/lib/scripts.js',			 array( 'jquery' ), false, true );
	wp_enqueue_script( 'modernizr',     T_URI . '/assets/js/lib/modernizr-2.6.2.min.js', array( 'jquery' ), true, false );
	wp_enqueue_script( 'main-js', 		T_URI . '/assets/js/main.js',					 array( 'jquery' ), false, true );

	// add TinyMCE style
	add_editor_style();
	
	wp_enqueue_script( 'jquery' );
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
	// register style
	wp_enqueue_style( 'wp-css',			  T_URI . '/style.css' );
	wp_enqueue_style( 'animsition',		  T_URI . '/assets/css/animsition.min.css' );
	wp_enqueue_style( 'bootstrap',		  T_URI . '/assets/css/bootstrap.min.css' );
	wp_enqueue_style( 'magnific-popup',	  T_URI . '/assets/css/magnific-popup.css' );
	wp_enqueue_style( 'animate-css',	  T_URI . '/assets/css/animate.css' );
	wp_enqueue_style( 'font-awesome',	  T_URI . '/assets/css/font-awesome.min.css' );
	wp_enqueue_style( 'pe-icon-7-stroke', T_URI . '/assets/css/pe-icon-7-stroke.css' );
	wp_enqueue_style( 'main-css',		  T_URI . '/assets/css/main.css' );

	wp_enqueue_style( 'dynamic-css', admin_url('admin-ajax.php').'?action=dynamic_css', '', '1.2');
}

/**
 * Filter the page title.
 */
function gnoli_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'gnoli' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'gnoli_wp_title', 10, 2 );

/**
* Include plugins
**/
function gnoli_include_required_plugins() {

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
			'name'     				=> 'Gnoli Plugins', // The plugin name
			'slug'     				=> 'gnoli-plugins', // The plugin slug (typically the folder name)
			'source'   				=> T_PATH .'/'. F_PATH .'/include/plugins/gnoli-plugins.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.10.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
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
		'domain'       		=> 'rs',         			// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'rs' ),
			'menu_title'                       			=> __( 'Install Plugins', 'rs' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'rs' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'rs' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'rs' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'rs' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'rs' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );
}

function gnoli_custom_styles() {
	global $gnoli;
	$style = '';

	if ( $gnoli['text_logo_style'] == 'custom' ||  $gnoli['img_logo_style'] == 'custom' ) {

		$style .= '<style type="text/css" media="screen">';

		///HEADER LOGO//////////////////////////////////////////////////////
		if ( $gnoli['site_logo'] == 'txtlogo' ) {
			//Header logo text
			if ( $gnoli['text_logo_style'] == 'custom' ) {

				$style .= 'a.logo {';
				$style .=  ( ! empty( $gnoli['text_logo_color'] ) ) ? 'color:' . $gnoli['text_logo_color'] . ' !important;' : '';
				$style .=  ( ! empty( $gnoli['text_logo_width'] ) ) ? 'width:' . $gnoli['text_logo_width'] . ' !important;' : '';
				$style .=  ( ! empty( $gnoli['text_logo_font_size'] ) ) ? 'font-size:' . $gnoli['text_logo_font_size'] . ' !important;' : '';
				$style .= '}';
			}

		} else {
			//Header logo image
			if ( $gnoli['img_logo_style'] == 'custom' ) {
				$style .= '.logo img {';
				$style .=  ( ! empty( $gnoli['img_logo_width'] ) ) ? 'width:' . $gnoli['img_logo_width'] . ' !important;' : '';
				$style .=  ( ! empty( $gnoli['img_logo_height'] ) ) ? 'height:' . $gnoli['img_logo_height'] . ' !important;' : '';
				$style .= '}';
			}
		}

		$style .= '</style>';
	}

	print $style;
}
// integration custom css
add_action('wp_ajax_dynamic_css', 'gnoli_dynamic_css');
add_action('wp_ajax_nopriv_dynamic_css', 'gnoli_dynamic_css');
function gnoli_dynamic_css() {
	require_once get_template_directory().'/assets/css/custom.css.php';
	exit;
}