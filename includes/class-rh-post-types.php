<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
 
 /**
 * Register 'Recipe' Custom Post Type.
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0.0
 */

class RH_Post_Types {

    public static function init() {
 
    	add_action( 'init', array( __CLASS__, 'register_taxonomies' ), 6 );
    	add_action( 'init', array( __CLASS__, 'register_post_types' ), 6 );

    }

    /**
	 * Register 'Course' Taxonomy.
	 *
	 * @package   Recipe Hero
	 * @author    Captain Theme <info@captaintheme.com>
	 * @since 	  1.0.0
	 */

	public static function register_taxonomies() {

		/**
		 * Course Taxonomy
		 **/

		$course_labels = array(
			'name' 					=> _x( 'Courses', 'taxonomy general name' ),
			'singular_name' 		=> _x( 'Course', 'taxonomy singular name' ),
			'add_new' 				=> _x( 'Add New Course', 'Course'),
			'add_new_item' 			=> __( 'Add New Course' ),
			'edit_item' 			=> __( 'Edit Course' ),
			'new_item' 				=> __( 'New Course' ),
			'view_item' 			=> __( 'View Course' ),
			'search_items' 			=> __( 'Search Courses' ),
			'not_found' 			=> __( 'No Course found' ),
			'not_found_in_trash' 	=> __( 'No Course found in Trash' ),
		);
		
		$course_pages = array('recipe');
		
		$course_args = array(
			'labels' 			=> $course_labels,
			'singular_label' 	=> __( 'Course' ),
			'public' 			=> true,
			'show_ui' 			=> true,
			'hierarchical' 		=> false,
			'show_tagcloud' 	=> false,
			'show_in_nav_menus' => false,
			'rewrite' 			=> array('slug' => 'courses', 'with_front' => false ),
		 );
		register_taxonomy( 'course', $course_pages, $course_args );

		/**
		 * Cuisine Taxonomy
		 **/

		$cuisine_labels = array(
			'name' 					=> _x( 'Cuisines', 'taxonomy general name' ),
			'singular_name' 		=> _x( 'Cuisine', 'taxonomy singular name' ),
			'add_new' 				=> _x( 'Add New Cuisine', 'Cuisine'),
			'add_new_item' 			=> __( 'Add New Cuisine' ),
			'edit_item' 			=> __( 'Edit Cuisine' ),
			'new_item' 				=> __( 'New Cuisine' ),
			'view_item' 			=> __( 'View Cuisine' ),
			'search_items' 			=> __( 'Search Cuisines' ),
			'not_found' 			=> __( 'No Cuisine found' ),
			'not_found_in_trash' 	=> __( 'No Cuisine found in Trash' ),
		);
		
		$cuisine_pages = array('recipe');
		
		$cuisine_args = array(
			'labels' 			=> $cuisine_labels,
			'singular_label' 	=> __( 'Cuisine' ),
			'public' 			=> true,
			'show_ui' 			=> true,
			'hierarchical' 		=> false,
			'show_tagcloud' 	=> false,
			'show_in_nav_menus' => false,
			'rewrite' 			=> array( 'slug' => 'cuisines', 'with_front' => false ),
		 );

		register_taxonomy( 'cuisine', $cuisine_pages, $cuisine_args );

	}

    /**
	 * Register 'Recipe' Post Type.
	 *
	 * @package   Recipe Hero
	 * @author    Captain Theme <info@captaintheme.com>
	 * @since 	  1.0.0
	 */

    public static function register_post_types() {

		$labels 		= array(
			'name' 				=> _x( 'Recipes', 'post type general name' ),
			'singular_name'		=> _x( 'Recipe', 'post type singular name' ),
			'all_items'			=> __( 'Recipes' ),
			'add_new' 			=> __( 'Add New' ),
			'add_new_item' 		=> __( 'Add New Recipe' ),
			'edit_item' 		=> __( 'Edit Recipe' ),
			'new_item' 			=> __( 'New Recipe' ),
			'view_item' 		=> __( 'View Recipe' ),
			'search_items' 		=> __( 'Search Recipes' ),
			'not_found' 		=> __( 'No Recipes found' ),
			'not_found_in_trash'=> __( 'No Recipes found in the trash' ),
			'parent_item_colon' => '',
			'menu_name'			=> __( 'Recipe Hero' )
		);
		
		$taxonomies 	= array();

		$supports   	= array( 'title','editor','author','thumbnail','excerpt','comments','publicize','page-attributes' );
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __( 'Recipe' ),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'exclude_from_search'=> false,
			'show_in_nav_menus'	=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> true,
			'hierarchical' 		=> false, // Hierarchical causes memory issues - WP loads all records!
			'rewrite' 			=> array( 'slug' => 'recipes', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 35,
			'menu_icon' 		=> 'dashicons-shield',
			'taxonomies'		=> $taxonomies
		 );

		 register_post_type( 'recipe', $post_type_args );

	}

}

RH_Post_types::init();