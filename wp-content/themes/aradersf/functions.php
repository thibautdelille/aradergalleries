<?php
	include_once(ABSPATH . 'wp-content/themes/aradersf/posttypes.php');
	include_once(ABSPATH . 'wp-content/themes/aradersf/inc/loop.php');
	// Add RSS links to <head> section
	automatic_feed_links();
	
	// Load jQuery
	if ( !is_admin() ) {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"), false);
	   wp_enqueue_script('jquery');
	}
	// Add icomoon font, used in the main stylesheet.
	wp_enqueue_style( 'icomoon', get_template_directory_uri() . '/icomoon/style.css', array(), '3.0.2' );

	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
	// Declare sidebar widget zone
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }

	function format_link($link, $name){
		return '<a href="'.$link.'">'.$name.'</a>'; 	
	}

	function aradersf_widgets_init() {
		register_sidebar( array(
			'name' => __( 'Footer Widget 1', 'aradersf' ),
			'id' => 'widget-footer',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		) );
		register_sidebar( array(
			'name' => __( 'Footer Widget 2', 'aradersf' ),
			'id' => 'widget-footer-2',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		) );
		
		register_sidebar( array(
			'name' => __( 'Home Widget', 'aradersf' ),
			'id' => 'widget-home',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		) );
	}
	add_action( 'widgets_init', 'aradersf_widgets_init' );
	

function format_price($price){
	$price .='';
	$return = '';
	while($price>=1000){
		$last = substr($price, -3);
		$price = substr($price, 0, -3);
		$return = ','.$last.$return;
	}
	$price = $price.$return.'.00';
	return $price;
}