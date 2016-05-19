<?php
/*
Plugin Name: Mevo Plugins
Plugin URI: https://relstudiosnx.com/demos/efa/
Author: NrgThemes
Author URI: https://www.relstudiosnx.com
Version: 1.0.1
Description: Includes Portfolio Custom Post Type and Visual Composer Shortcodes
Text Domain: mevo
*/

// Define Constants
defined('EF_ROOT')		or define('EF_ROOT', dirname(__FILE__));
defined('EF_VERSION')	or define('EF_VERSION', '1.0');
require_once( EF_ROOT .'/importer/init.php' );

if( ! class_exists( 'Mevo_Plugins' ) ) {

	class Mevo_Plugins {

		private $assets_js;

		public function __construct() {
			$this->assets_js	= plugins_url('/composer/js', __FILE__);
			$this->assets_css   = plugins_url('/composer/css', __FILE__);
			add_action('init', array($this, 'mevo_register_portfolio'), 0);
			add_action('admin_init', array($this, 'mevo_load_map'));
			add_action( 'admin_print_scripts-post.php', array($this, 'vc_enqueue_scripts'), 99);
			add_action( 'admin_print_scripts-post-new.php', array($this, 'vc_enqueue_scripts'), 99);
			$this->mevo_load_shortcodes();
		}

		public function mevo_register_portfolio() {
			$post_type_labels       = array(
		      'name'                => 'Portfolios',
		      'singular_name'       => 'Portfolio',
		      'menu_name'           => 'Portfolio',
		      'parent_item_colon'   => 'Parent Item:',
		      'all_items'           => 'All Portfolios',
		      'view_item'           => 'View Item',
		      'add_new_item'        => 'Add New Item',
		      'add_new'             => 'Add New',
		      'edit_item'           => 'Edit Item',
		      'update_item'         => 'Update Item',
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
		      'supports'            => array( 'editor', 'title', 'thumbnail', 'comments' ),
		      'taxonomies'          => array( 'post' ),
		      'hierarchical'        => false,
		      'public'              => true,
		      'show_ui'             => true,
		      'show_in_menu'        => true,
		      'show_in_nav_menus'   => true,
		      'show_in_admin_bar'   => true,
		      'can_export'          => true,
		      'has_archive'         => true,
		      'exclude_from_search' => true,
		      'publicly_queryable'  => true,
		      'rewrite'             => $post_type_rewrite,
		      'capability_type'     => 'post',
		    );
		    register_post_type( 'portfolio', $post_type_args );

		    $taxonomy_labels                = array(
		      'name'                        => 'Portfolio',
		      'singular_name'               => 'Portfolio',
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
		      'show_tagcloud'       => true,
		      'rewrite'             => $taxonomy_rewrite,
		    );
		    register_taxonomy( 'portfolio-category', 'portfolio', $taxonomy_args );


		    $taxonomy_tags_args     = array(
		      'hierarchical'        => false,
		      'show_admin_column'   => true,
		      'rewrite'             => 'portfolio-tag',
		      'label'               => 'Tags',
		      'singular_label'      => 'Tags',
		    );
		    register_taxonomy( 'portfolio-tag', array('portfolio'), $taxonomy_tags_args );

		} //end of register portfolio

		public function mevo_load_map() {
			if(class_exists('Vc_Manager')) {
				require_once( EF_ROOT .'/'. 'composer/map.php');
				require_once( EF_ROOT .'/'. 'composer/init.php');
			}
		}

		public function mevo_load_shortcodes() {

			foreach( glob( EF_ROOT . '/'. 'shortcodes/mevo_*.php' ) as $shortcode ) {
				require_once(EF_ROOT .'/'. 'shortcodes/'. basename( $shortcode ) );
			}

		}

		public function vc_enqueue_scripts() {
			wp_enqueue_script( 'vc-script', $this->assets_js .'/vc-script.js' ,  array('jquery'), '1.0.0', true );
			wp_enqueue_style( 'rs-vc-custom', $this->assets_css. '/vc-style.css' );
		}

	} // end of class

	new Mevo_Plugins;
} // end of class_exists
