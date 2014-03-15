<?php get_header(); the_post()?>
		<div class="clear"></div>
<?php get_sidebar(); ?>
		
		<div class="content-wrap">
			<h3><?php the_title()?></h3>
			<?php the_artist_name($post_object, 'h4', 'By ');?>
			<?php the_post_entry($post)?>
			<?php the_content()?>
			
				
			<div class="hr"></div>
			<div class="elements-wrap">
			
				<?php
					$args = array(
    					'numberposts' => -1,
    					'offset' => 0,
    					'orderby' => 'post_date',
    					'order' => 'DESC',
    					'post_type' => 'pieces',
    					'meta_query' => array(
            				array(
                    			'key' => 'collections',
                    			'value' => $post->ID,
                    			'compare' => 'LIKE'
            					)
    					)
					);
					$pieces = get_posts( $args );
					the_pieces($pieces);
				?>
			</div>
		</div>

<?php get_footer(); ?>