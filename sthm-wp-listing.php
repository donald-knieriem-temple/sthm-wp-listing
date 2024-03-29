<?php
/*
Plugin Name: STHM Job Listings
Description: Custom post type for STHM externship, internship, and assistantship listings
*/

  
/*
* Creating a function to create our CPT
*/
 
function custom_post_type() {
 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => __( 'Job Listings', 'Post Type General Name', 'twentyseventeen' ),
        'singular_name'       => __( 'Job Listing', 'Post Type Singular Name', 'twentyseventeen' ),
        'menu_name'           => __( 'Job Listings', 'twentyseventeen' ),
        'parent_item_colon'   => __( 'Parent Listing', 'twentyseventeen' ),
        'all_items'           => __( 'All Listings', 'twentyseventeen' ),
        'view_item'           => __( 'View Listing', 'twentyseventeen' ),
        'add_new_item'        => __( 'Add New Listing', 'twentyseventeen' ),
        'add_new'             => __( 'Add New', 'twentyseventeen' ),
        'edit_item'           => __( 'Edit Listing', 'twentyseventeen' ),
        'update_item'         => __( 'Update Listing', 'twentyseventeen' ),
        'search_items'        => __( 'Search Listing', 'twentyseventeen' ),
        'not_found'           => __( 'Not Found', 'twentyseventeen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentyseventeen' ),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'job_listings', 'twentyseventeen' ),
        'description'         => __( 'Job listings', 'twentyseventeen' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        /*'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'revisions', 'custom-fields', ),*/
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'listing_type' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        /*'hierarchical'        => false,*/
        'public'              => true,
        /*'show_ui'             => true,
        'show_in_menu'        => true,*/
        'query_var'           => true,
        'rewrite'             => array( 'slug' => 'job_listings'),
        /*'show_in_nav_menus'   => false,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,*/
        'menu_icon'           => 'dashicons-hammer',
        'can_export'          => true,
        /*'has_archive'         => true,*/
        'exclude_from_search' => true,
        'publicly_queryable'  => true,
        /*'capability_type'     => 'post',*/
    );
     
    // Registering your Custom Post Type
    register_post_type( 'job_listings', $args );
    //flush_rewrite_rules();
 
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
 
add_action( 'init', 'custom_post_type' );

// create job listing taxonomy for the post type "job_listings"
function create_job_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Listing Types', 'taxonomy general name', 'twentyseventeen' ),
        'singular_name'     => _x( 'Type', 'taxonomy singular name', 'twentyseventeen' ),
        'search_items'      => __( 'Search Listing Types', 'twentyseventeen' ),
        'all_items'         => __( 'All Types', 'twentyseventeen' ),
        'parent_item'       => __( 'Parent Type', 'twentyseventeen' ),
        'parent_item_colon' => __( 'Parent Type:', 'twentyseventeen' ),
        'edit_item'         => __( 'Edit Type', 'twentyseventeen' ),
        'update_item'       => __( 'Update Type', 'twentyseventeen' ),
        'add_new_item'      => __( 'Add New Listing Type', 'twentyseventeen' ),
        'new_item_name'     => __( 'New Type Name', 'twentyseventeen' ),
        'menu_name'         => __( 'Listing Types', 'twentyseventeen' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'listing_type' ),
    );

    register_taxonomy( 'listing_type', array( 'job_listings' ), $args );

}

// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_job_taxonomies', 0 );

?>