<?php
/**
 * The template includes necessary functions for theme.
 *
 * @package gnoli
 * @since 1.0
 */

if ( is_user_logged_in() ) {
	add_filter('show_admin_bar', '__return_true');
}

if ( ! isset( $content_width ) ) {
    $content_width = 960; /* pixels */
}

defined( 'T_URI' )  or define( 'T_URI',  get_template_directory_uri() );
defined( 'T_PATH' ) or define( 'T_PATH', get_template_directory() );
defined( 'F_PATH' ) or define( 'F_PATH', 'framework/cs-framework' );

// Framework integration
// ----------------------------------------------------------------------------------------------------
require_once dirname( __FILE__ ) . '/framework/cs-framework/include/helper-functions.php';
require_once dirname( __FILE__ ) . '/framework/cs-framework/include/include-config.php';
require_once dirname( __FILE__ ) . '/framework/cs-framework/include/actions-config.php';
require_once dirname( __FILE__ ) . '/framework/cs-framework/cs-framework.php';
require_once dirname( __FILE__ ) . '/framework/class-tgm-plugin-activation.php';

function gnoli_after_setup() {
    register_nav_menus( array( 'primary-menu' => __( 'Top Navigation', 'gnoli' ) ) );
    add_theme_support('post-formats', array('video', 'gallery', 'audio', 'quote'));
    add_theme_support( 'custom-header' );
    add_theme_support( 'custom-background' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'gnoli_after_setup' );


/**
 * Сustom gnoli menu.
 */
function gnoli_custom_menu() {
    if ( has_nav_menu( 'primary-menu' ) ) {
        wp_nav_menu( array( 'container' => '', 'theme_location' => 'primary-menu' ) );
    } else {
        print '<span class="no-menu">Please register Top Navigation from <a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" target="_blank">Appearance &gt; Menus</a></span>';
    }
}

function my_admin_bar_init() {
remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('admin_bar_init', 'my_admin_bar_init');

/*function gnoli_custom_comment_redirect($val, $args) {
    //var_dump($args);exit();//
    return '/';
}
add_filter('get_comment_link', 'gnoli_custom_comment_redirect', 10, 2);
*/