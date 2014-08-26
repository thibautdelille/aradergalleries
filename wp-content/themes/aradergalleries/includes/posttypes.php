<?php

// Add new post type for Pieces
add_action('init', 'aradersf_pieces_init');
function aradersf_pieces_init() 
{
	$piece_labels = array(
		'name' => _x('Piece', 'post type general name'),
		'singular_name' => _x('Piece', 'post type singular name'),
		'all_items' => __('All Pieces'),
		'add_new' => _x('Add new piece', 'pieces'),
		'add_new_item' => __('Add new piece'),
		'edit_item' => __('Edit piece'),
		'new_item' => __('New piece'),
		'view_item' => __('View piece'),
		'search_items' => __('Search in pieces'),
		'not_found' =>  __('No pieces found'),
		'not_found_in_trash' => __('No pieces found in trash'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $piece_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title','editor','author','excerpt'),
		'has_archive' => 'pieces'
	); 
	register_post_type('pieces',$args);
}

// Add new post type for Artist
add_action('init', 'aradersf_artists_init');
function aradersf_Artists_init() 
{
	$artist_labels = array(
		'name' => _x('Artists', 'post type general name'),
		'singular_name' => _x('Artist', 'post type singular name'),
		'all_items' => __('All Artists'),
		'add_new' => _x('Add new artist', 'artists'),
		'add_new_item' => __('Add new artist'),
		'edit_item' => __('Edit artist'),
		'new_item' => __('New artist'),
		'view_item' => __('View artist'),
		'search_items' => __('Search in artists'),
		'not_found' =>  __('No artists found'),
		'not_found_in_trash' => __('No artists found in trash'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $artist_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title','editor','author','excerpt'),
		'has_archive' => 'artists'
	); 
	register_post_type('artists',$args);
}


// Add new post type for Collections
add_action('init', 'arader_collections_init');
function arader_collections_init() 
{
	$collection_labels = array(
		'name' => _x('Collections', 'post type general name'),
		'singular_name' => _x('Collection', 'post type singular name'),
		'all_items' => __('All Collections'),
		'add_new' => _x('Add new collection', 'collections'),
		'add_new_item' => __('Add new collection'),
		'edit_item' => __('Edit collection'),
		'new_item' => __('New collection'),
		'view_item' => __('View collection'),
		'search_items' => __('Search in collections'),
		'not_found' =>  __('No collections found'),
		'not_found_in_trash' => __('No collections found in trash'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $collection_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title','editor','author','excerpt'),
		'has_archive' => 'collections'
	); 
	register_post_type('collections',$args);
}
// Add custom taxonomies
add_action( 'init', 'arader_create_taxonomies', 0 );

function arader_create_taxonomies() 
{
	// selection
	$selection_labels = array(
		'name' => _x( 'Selection', 'taxonomy general name' ),
		'singular_name' => _x( 'Selection', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search in selections' ),
		'all_items' => __( 'All selections' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit selection' ), 
		'update_item' => __( 'Update selection' ),
		'add_new_item' => __( 'Add new selection' ),
		'new_item_name' => __( 'New selection' ),
		'menu_name' => __( 'Selection' ),
	);
	
	register_taxonomy('selection',array('pieces','artists','collections'),array(
		'hierarchical' => true,
		'labels' => $selection_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'selection' )
	));
	
	// Sizes
	$sizes_labels = array(
		'name' => _x( 'Sizes', 'taxonomy general name' ),
		'singular_name' => _x( 'Size', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search in sizes' ),
		'popular_items' => __( 'Popular sizes' ),
		'all_items' => __( 'All sizes' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit size' ), 
		'update_item' => __( 'Update size' ),
		'add_new_item' => __( 'Add new size' ),
		'new_item_name' => __( 'New size name' ),
		'separate_items_with_commas' => __( 'Separate sizes with commas' ),
	    'add_or_remove_items' => __( 'Add or remove sizes' ),
	    'choose_from_most_used' => __( 'Choose from the most used sizes' ),
		'menu_name' => __( 'Sizes' ),
	);
	register_taxonomy('sizes',array('pieces','artists','collections'),array(
		'hierarchical' => false,
		'labels' => $sizes_labels,
		'show_ui' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array('slug' => 'size' )
	));

	// Location
	$location_labels = array(
		'name' => _x( 'Location', 'taxonomy general name' ),
		'singular_name' => _x( 'Location', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search in locations' ),
		'all_items' => __( 'All locations' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit location' ), 
		'update_item' => __( 'Update location' ),
		'add_new_item' => __( 'Add new location' ),
		'new_item_name' => __( 'New location' ),
		'menu_name' => __( 'Location' ),
	);
	register_taxonomy('location',array('pieces','artists','collections'),array(
		'hierarchical' => true,
		'labels' => $location_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'location' )
	));
	
	// Location
	$currentlocation_labels = array(
		'name' => _x( 'Current Location', 'taxonomy general name' ),
		'singular_name' => _x( 'Current Location', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search in current locations' ),
		'all_items' => __( 'All current locations' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit current location' ), 
		'update_item' => __( 'Update current location' ),
		'add_new_item' => __( 'Add new current location' ),
		'new_item_name' => __( 'New current location' ),
		'menu_name' => __( 'Current Location' ),
	);
	register_taxonomy('currentlocation',array('pieces','collections'),array(
		'hierarchical' => true,
		'labels' => $currentlocation_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'currentlocation' )
	));
	
	// Dates
	$dates_labels = array(
		'name' => _x( 'Dates', 'taxonomy general name' ),
		'singular_name' => _x( 'Dates', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search in dates' ),
		'all_items' => __( 'All dates' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit date' ), 
		'update_item' => __( 'Update date' ),
		'add_new_item' => __( 'Add new date' ),
		'new_item_name' => __( 'New date' ),
		'menu_name' => __( 'Dates' ),
	);
	register_taxonomy('dates',array('pieces','artists','collections'),array(
		'hierarchical' => true,
		'labels' => $dates_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'date' )
	));

	// Technique 
	$techniques_labels = array(
		'name' => _x( 'Techniques', 'taxonomy general name' ),
		'singular_name' => _x( 'Technique', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search in techniques' ),
		'popular_items' => __( 'Popular techniques' ),
		'all_items' => __( 'All techniques' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit technique' ), 
		'update_item' => __( 'Update technique' ),
		'add_new_item' => __( 'Add new technique' ),
		'new_item_name' => __( 'New technique name' ),
		'separate_items_with_commas' => __( 'Separate techniques with commas' ),
	    'add_or_remove_items' => __( 'Add or remove techniques' ),
	    'choose_from_most_used' => __( 'Choose from the most used techniques' ),
		'menu_name' => __( 'Techniques' ),
	);
	register_taxonomy('techniques',array('pieces','artists','collections'),array(
		'hierarchical' => false,
		'labels' => $techniques_labels,
		'show_ui' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array('slug' => 'technique' )
	));

	// Publication 
	$publication_labels = array(
		'name' => _x( 'Publications', 'taxonomy general name' ),
		'singular_name' => _x( 'Publication', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search in publications' ),
		'popular_items' => __( 'Popular publications' ),
		'all_items' => __( 'All publications' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit publication' ), 
		'update_item' => __( 'Update publication' ),
		'add_new_item' => __( 'Add new publication' ),
		'new_item_name' => __( 'New publication name' ),
		'separate_items_with_commas' => __( 'Separate publications with commas' ),
	    'add_or_remove_items' => __( 'Add or remove publications' ),
	    'choose_from_most_used' => __( 'Choose from the most used publications' ),
		'menu_name' => __( 'Publications' ),
	);
	register_taxonomy('publications',array('pieces','artists','collections'),array(
		'hierarchical' => false,
		'labels' => $publication_labels,
		'show_ui' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array('slug' => 'publications' )
	));
	/*
	// Price 
	$price_labels = array(
		'name' => _x( 'Prices', 'taxonomy general name' ),
		'singular_name' => _x( 'Price', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search in prices' ),
		'popular_items' => __( 'Popular prices' ),
		'all_items' => __( 'All prices' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit price' ), 
		'update_item' => __( 'Update price' ),
		'add_new_item' => __( 'Add new price' ),
		'new_item_name' => __( 'New price name' ),
		'separate_items_with_commas' => __( 'Separate prices with commas' ),
	    'add_or_remove_items' => __( 'Add or remove prices' ),
	    'choose_from_most_used' => __( 'Choose from the most used prices' ),
		'menu_name' => __( 'Prices' ),
	);
	register_taxonomy('prices',array('pieces'),array(
		'hierarchical' => false,
		'labels' => $price_labels,
		'show_ui' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array('slug' => 'prices' )
	));
	*/
}


?>