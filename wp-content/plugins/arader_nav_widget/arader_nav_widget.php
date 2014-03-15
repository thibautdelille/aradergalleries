<?php
/*
Plugin Name: Arader Nav Widget
Plugin URI: http://www.aradersf.com
Description: This plugin display the left navigation for the aradersf.com website
Author: Thibaut Delille
Version: 1.0
Author URI: http://www.thibautdelille.com/
 */
class AraderNavWidget extends WP_Widget
{
	function AraderNavWidget() {
		$widget_options = array(
		'classname'		=>		'arader-nav-widget',
		'description' 	=>		'Just a simple widget'
		);
		
		parent::WP_Widget('arader_nav_widget', 'Arader Nav Widget', $widget_options);
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
		$title = ( $instance['title'] ) ? $instance['title'] : 'The Arader Nav Widget';
		
 
 		$terms = get_terms("selection");
 		$body_html = "";
 		$count = count($terms);
 		if ( $count > 0 ){
    		$body_html .= "<ul>";
     		foreach ( $terms as $term ) {
				$body_html .= "<li>" . format_link(get_bloginfo('url').'/selection/'.$term->slug.'/', $term->name) . "</li>";
 				//$body_html .= $this->get_list_by_category($term->slug);
 				
        	}
     		$body_html .= "</ul>";
 		}


		$body = ( $instance['body'] ) ? $instance['body'] : $body_html;
		
		$before_widget = '<nav>';
		$before_title = '<div class="hr"></div><h5>';
		$after_title = '</h5><div class="hr"></div>';
		$after_widget = '</nav>';
		?>
		<?php echo $before_widget ?>
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
	
function arader_nav_widget_init() {
	register_widget("AraderNavWidget");
}
add_action('widgets_init','arader_nav_widget_init');