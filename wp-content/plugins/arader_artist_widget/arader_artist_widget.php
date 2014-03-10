<?php
/*
Plugin Name: Arader Artist Widget
Plugin URI: http://www.aradersf.com
Description: This plugin display the list of artist for the aradersf.com website
Author: Thibaut Delille
Version: 1.0
Author URI: http://www.thibautdelille.com/
 */
class AraderArtistWidget extends WP_Widget
{
	function AraderArtistWidget() {
		$widget_options = array(
		'classname'		=>		'arader-artist-widget',
		'description' 	=>		'Display the list of the artist for the aradersf website'
		);
		
		parent::WP_Widget('arader_artist_widget', 'Arader Artist Widget', $widget_options);
	}
	
	function get_list_by_category($slug){
		$args = array(
			'post_type' => 'collections',
			'tax_query' => array(
				array(
					'taxonomy' => 'selection',
					'field' => 'slug',
					'terms' => array( $slug )
				)
			)
		);
		$query = new WP_Query($args);
		
		$return = "";
		while ( $query->have_posts() ) : $query->the_post();
			$return .= '<li class="sub-menu-item">';
			$return .= format_link(get_permalink(), get_the_title());
			$return .= '</li>';
		endwhile;
		
		if($return!=""){
			$return = "<ul class='sub-menu'>".$return."</ul>";
		}
		return $return;
	}
	
	function widget( $args, $instance ) {
		extract ( $args, EXTR_SKIP );
		$title = ( $instance['title'] ) ? $instance['title'] : 'The Arader Artist Widget';
		
		$args = array(
			'post_type'=> 'artists'
		);
		$aArtists = query_posts( $args );
		//print_r($aArtists);
 		$body_html = "";
    		$body_html .= "<ul>";
     		foreach ( $aArtists as $artist ) {
     			//$body_html .="<li>featured:".get_field("featured", $artist->ID)."</li>";
     			if(get_field("featured", $artist->ID) == "Yes"){
					$body_html .= "<li><a href='" . get_permalink($artist->ID) ."'>". get_the_title($artist->ID) . "</a></li>";
 				}
 				//$body_html .= $this->get_list_by_category($term->slug);
 				
        	}
     		$body_html .= "</ul>";


		$body = ( $instance['body'] ) ? $instance['body'] : $body_html;
		
		$before_widget = '<nav>';
		$before_title = '<div class="hr"></div><h5>';
		$after_title = '</h5><div class="hr"></div>';
		$after_widget = '</nav>';
		?>
		<?php echo $before_widget ?>
		<?php echo $before_title . $title . $after_title ?>
		<?php echo $body ?>
		<?php echo $after_widget ?>
		<?php 
	}
	
	function form( $instance ) {
		?>
		<label for="<?php echo $this->get_field_id('title'); ?>">
		Title: 
		<input id="<?php echo $this->get_field_id('title'); ?>"
				name="<?php echo $this->get_field_name('title'); ?>"
				value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</label>
		<?php 
	}
	
}
	
function arader_artist_widget_init() {
	register_widget("AraderArtistWidget");
}
add_action('widgets_init','arader_artist_widget_init');