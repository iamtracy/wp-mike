<?php
/*
Plugin Name: Gnoli Plugins
Plugin URI: https://nrgthemes.com/
Author: NRGThemes
Author URI: https://www.nrgthemes.com
Version: 1.10.7
Description: Includes Portfolio Custom Post Type and Visual Composer Shortcodes
Text Domain: gnoli
*/

// Define Constants
defined('EF_ROOT')		or define('EF_ROOT', dirname(__FILE__));
defined('EF_VERSION')	or define('EF_VERSION', '1.0');

if(!class_exists('Gnoli_Plugins')) {

	class Gnoli_Plugins {

		private $assets_js;

		public function __construct() {
			$this->assets_js	= plugins_url('/composer/js', __FILE__);
			$this->assets_css   = plugins_url('/composer/css', __FILE__);
			add_action(	'init', array( $this, 'gnoli_register_portfolio' ), 0);
			add_action(	'admin_init', array($this, 'gnoli_load_map'));
			add_action( 'admin_print_scripts-post.php', array($this, 'vc_enqueue_scripts'), 99);
			add_action( 'admin_print_scripts-post-new.php', array($this, 'vc_enqueue_scripts'), 99);
			$this->gnoli_load_shortcodes();
		}
		public function gnoli_register_portfolio() {

		   	$taxonomy_labels                = array(
			    'name'                        => 'Category',
			    'singular_name'               => 'Category',
			    'menu_name'                   => 'Categories',
			    'all_items'                   => 'All Categories',
			    'parent_item'                 => 'Parent Category',
			    'parent_item_colon'           => 'Parent Category:',
			    'new_item_name'               => 'New Category Name',
			    'add_new_item'                => 'Add New Category',
			    'edit_item'                   => 'Edit Category',
			    'update_item'                 => 'Update Category',
			    'separate_items_with_commas'  => 'Separate categories with commas',
			    'search_items'                => 'Search categories',
			    'add_or_remove_items'         => 'Add or remove categories',
			    'choose_from_most_used'       => 'Choose from the most used categories',
		   	);

		   	$taxonomy_rewrite         = array(
			    'slug'                  => 'portfolio-category',
			    'with_front'            => true,
			    'hierarchical'          => true,
		   	);

		   	$taxonomy_args          = array(
			    'labels'              => $taxonomy_labels,
			    'hierarchical'        => true,
			    'public'              => true,
			    'show_ui'             => true,
			    'show_admin_column'   => true,
			    'show_in_nav_menus'   => true,
			    'query_var'      	  => true,
			    'show_tagcloud'       => true,
			    'rewrite'             => $taxonomy_rewrite,
		   	);
		   	register_taxonomy( 'portfolio-category', array( 'portfolio'), $taxonomy_args );

		   	$taxonomy_labels                = array(
			    'name'                        => 'Tag',
			    'singular_name'               => 'Tag',
			    'menu_name'                   => 'Tags',
			    'all_items'                   => 'All Tags',
			    'parent_item'                 => 'Parent Tag',
			    'parent_item_colon'           => 'Parent Tag:',
			    'new_item_name'               => 'New Tag Name',
			    'add_new_item'                => 'Add New Tag',
			    'edit_item'                   => 'Edit Tag',
			    'update_item'                 => 'Update Tag',
			    'separate_items_with_commas'  => 'Separate categories with commas',
			    'search_items'                => 'Search categories',
			    'add_or_remove_items'         => 'Add or remove categories',
			    'choose_from_most_used'       => 'Choose from the most used categories',
		   	);

		   	$taxonomy_rewrite         = array(
			    'slug'                  => 'portfolio-tag',
			    'with_front'            => true,
			    'hierarchical'          => true,
		   	);

		   	$taxonomy_args          = array(
			    'labels'              => $taxonomy_labels,
			    'hierarchical'        => true,
			    'public'              => true,
			    'show_ui'             => true,
			    'show_admin_column'   => true,
			    'show_in_nav_menus'   => true,
			    'query_var'      	  => true,
			    'show_tagcloud'       => true,
			    'rewrite'             => $taxonomy_rewrite,
		   	);
		   	register_taxonomy( 'portfolio-tag', array( 'portfolio'), $taxonomy_args );

   			//Register new post type
		   	$post_type_labels       = array(
			    'name'                => 'Portfolio',
			    'singular_name'       => 'Portfolio',
			    'menu_name'           => 'Portfolio',
			    'parent_item_colon'   => 'Parent Portfolio:',
			    'all_items'           => 'All Portfolios',
			    'view_item'           => 'View Portfolio',
			    'add_new_item'        => 'Add New Portfolio',
			    'add_new'             => 'Add New',
			    'edit_item'           => 'Edit Portfolio',
			    'update_item'         => 'Update Portfolio',
			    'search_items'        => 'Search portfolios',
			    'not_found'           => 'No portfolios found',
			    'not_found_in_trash'  => 'No portfolios found in Trash',
		   	);

		   	$post_type_rewrite      = array(
			    'slug'                => 'portfolio-item',
			    'with_front'          => true,
			    'pages'               => true,
			    'feeds'               => true,
		   	);

		   	$post_type_args         = array(
			    'label'               => 'portfolio',
			    'description'         => 'Portfolio information pages',
			    'labels'              => $post_type_labels,
			    'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'revisions', ),
			    'taxonomies'          => array( 'post' ),
			    'hierarchical'        => false,
			    'public'              => true,
			    'show_ui'             => true,
			    'show_in_menu'        => true,
			    'menu_icon'     => 'dashicons-format-gallery',
			    'has_archive'         => true,
			    'publicly_queryable'  => true,
			    'rewrite'             => array( 'slug' => 'portfolio-item' ),
			    'capability_type'     => 'post',
		   	);

		   	register_post_type( 'portfolio', $post_type_args );

  		}

		public function gnoli_load_map() {
			if(class_exists('Vc_Manager')) {
				require_once( EF_ROOT .'/'. 'composer/map.php');
				require_once( EF_ROOT .'/'. 'composer/init.php');
			}
		}

		public function gnoli_load_shortcodes() {

			foreach( glob( EF_ROOT . '/'. 'shortcodes/gnoli_*.php' ) as $shortcode ) {
				require_once(EF_ROOT .'/'. 'shortcodes/'. basename( $shortcode ) );
			}
			foreach( glob( EF_ROOT . '/'. 'shortcodes/vc_*.php' ) as $shortcode ) {
				require_once(EF_ROOT .'/'. 'shortcodes/'. basename( $shortcode ) );
			}

		}

		public function vc_enqueue_scripts() {
			wp_enqueue_script( 'vc-script', $this->assets_js .'/vc-script.js' ,  array('jquery'), '1.0.0', true );
			wp_enqueue_style( 'rs-vc-custom', $this->assets_css. '/vc-style.css' );
		}

	} // end of class

	new Gnoli_Plugins;
} // end of class_exists

// Import Integration
// ----------------------------------------------------------------------------------------------------
require_once(dirname(__FILE__).'/importer/init.php');
