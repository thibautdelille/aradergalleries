<?php
/*
Plugin Name: Arader Small Feature
Plugin URI: http://www.aradersf.com
Description: This plugin display the small feature for the aradersf.com website
Author: Thibaut Delille
Version: 1.0
Author URI: http://www.thibautdelille.com/
 */
class AraderSmallFeature extends WP_Widget
{
	function AraderSmallFeature() {
		$widget_options = array(
		'classname'		=>		'arader-small-feature',
		'description' 	=>		'Display the small feature for the aradersf website'
		);
		
		parent::WP_Widget('arader_small_feature', 'Arader Small Feature', $widget_options);
	}
	
	
	function widget( $args, $instance ) {
		extract ( $args, EXTR_SKIP );
		
		?>
		
		<div class="feature">
			<a href="<?php echo $instance['url'] ?>"><img src="<?php echo $instance['image'] ?>"></img></a>
			<p>
			<?php echo $instance['body'] ?>
			</p>
			<a href="<?php echo $instance['url'] ?>"><p>more infos ></p></a>
		</div>
		<?php
		
		/*
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
		<?php */
	}
	
	function form( $instance ) {
		?>
		<label for="<?php echo $this->get_field_id('body'); ?>">
		Body: 
		<input id="<?php echo $this->get_field_id('body'); ?>"
				name="<?php echo $this->get_field_name('body'); ?>"
				value="<?php echo esc_attr( $instance['body'] ); ?>" />
		</label>
		<label for="<?php echo $this->get_field_id('image'); ?>">
		<br/>
		Image: 
		<input id="<?php echo $this->get_field_id('image'); ?>"
				name="<?php echo $this->get_field_name('image'); ?>"
				value="<?php echo esc_attr( $instance['image'] ); ?>" />
		</label>
		<br/>
		<label for="<?php echo $this->get_field_id('url'); ?>">
		Url: 
		<input id="<?php echo $this->get_field_id('url'); ?>"
				name="<?php echo $this->get_field_name('url'); ?>"
				value="<?php echo esc_attr( $instance['url'] ); ?>" />
		</label>
		<?php 
	}
	
}
	
function arader_small_feature_init() {
	register_widget("AraderSmallFeature");
}
add_action('widgets_init','arader_small_feature_init');