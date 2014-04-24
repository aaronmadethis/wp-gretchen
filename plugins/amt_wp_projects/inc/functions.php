<?php

// -- register install script
register_activation_hook(__FILE__, 'amt_wp_projects_install');

// -- register the deactivation script
register_deactivation_hook(__FILE__, 'amt_wp_projects_deactivate');

// -- runs when plug-in is installed
function amt_wp_projects_install(){
}

// -- run on uninstall deletes options
function amt_wp_projects_deactivate() {
	// -- delete options
	// -- delete_option('total_columns');
}

// Load our custom assets.
add_action( 'admin_enqueue_scripts', 'amt_wp_projects_assets');

function amt_wp_projects_assets(){

}

// -- Set up the post types
add_action('init', 'amt_wp_projects_regiser_post_types');

// -- Register Post Types function
function amt_wp_projects_regiser_post_types(){

	// -- set arguments for the portfolio_page post type
	$amt_wp_pt_args = array(
		'public' => true,
		'query_var' => 'amt_projects',
		'rewrite' => array(
				'slug' => 'work/portfolio',
				'with_front' => false
		),
		'supports' => array(
			'title',
			'page-attributes',
			'thumbnail' 
		),
		'labels' => array(
			'name' => 'Projects',
			'singular_name' => 'Project',
			'add_new' => 'Add a Project',
			'add_new_item' => 'Add a Project',
			'edit_item' => 'Edit a Project',
			'new_item' => 'New Project',
			'view_item' => 'View Projects',
			'search_items' => 'Search Projects',
			'not_found' => 'No Projects Found',
			'not_found_in_trash' => 'No Projects Found in Trash'
		),
		'capability_type' => 'page',
		'hierarchical' => true,
        // 'register_meta_box_cb' => 'add_portfolio_metaboxes',
        'taxonomies' => array( 'category', 'post_tag' ),
        'has_archive'   => true
	);

	// -- register the portfolio post type
	register_post_type( 'amt_projects', $amt_wp_pt_args );
}

