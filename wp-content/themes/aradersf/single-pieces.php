<?php get_header(); the_post()?>
		<div class="clear"></div>
		<div class="fullcontent-wrap">
			<h3><?php the_title()?></h3>
			<div class="piece-wrap">
				<div class="image">
				<?php
					$attachment_id = get_field('large_image', $piece->ID);
					$img = wp_get_attachment_image_src($attachment_id, $size='large', $icon = false);
					echo '<img src="'.$img[0].'"/>';
				?>
				</div>
				<div class="text">
				<?php
			 the_artist_name($post, 'h4', 'by ');
			 the_post_entry($post);
			 $price = get_field('price', $piece->ID);
			 $enable_paypal = get_field('enable_paypal', $piece->ID);
			 if($enable_paypal&&$price){
					echo '<p>$'.format_price($price).'</p>';
			 		echo print_wp_cart_button_for_product(get_the_title(), $price);
			 }
			?>
				<div class="entry-tag"><a href="/contact-us">Contact us</a> to learn more</div>

				</div>
				<div class="clear"></div>
				<div class="content">
					<?php the_content()?>
				</div>
			</div><!-- END OF PIECE -->
			<div class="hr"></div>
			<div class="previous">
				<?php the_previous($post);?> 
			</div>
			<div class="next">
				<?php the_next($post);?> 
			</div>
			<div class="clear"></div>
			<div class="hr"></div>
			<h4 class="grey">From the same collection</h4>
			<div class="elements-wrap">
				<?php
					$args = array(
    					'numberposts' => 4,
    					'offset' => 0,
    					'orderby' => 'rand',
    					'order' => 'DESC',
    					'post_type' => 'pieces',
    					'meta_query' => array(
            				array(
                    			'key' => 'collections',
                    			'value' => $collection->ID,
                    			'compare' => 'LIKE'
            					)
    					)
					);
					$pieces = get_posts( $args );
					the_pieces($pieces);?>
			</div><!-- END OF ElEMENT -->
			<div class="clear"></div>
		</div>

<?php get_footer(); ?>