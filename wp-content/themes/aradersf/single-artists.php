<?php get_header(); the_post()?>
		<div class="clear"></div>
<?php get_sidebar(); ?>
		
		<div class="content-wrap">
			<div class="back">
				<a href="<?php echo bloginfo('url')?>">< back</a>
			</div>
			<div class="hr"></div>
			<h3><?php the_title();
					$term_list = wp_get_post_terms($post->ID, 'dates', array("fields" => "all"));
					if($term_list){ 
						$dates = '';
						foreach($term_list as $term){
							if($dates!='')
								$dates .= ', '; 
							$dates .= $term->name;
						}
						echo ' ('.$dates.')';
				 }?></h3>
			<div class="hr"></div>
				<br/>
			<?php the_content();
			the_post_entry($post);?>
			
				
			<div class="hr"></div>
			<div class="elements-wrap">
			<h4 class="grey"><i>Collections</i></h4>
				<?php
					$args = array(
    					'numberposts' => -1,
    					'offset' => 0,
    					'orderby' => 'post_date',
    					'order' => 'DESC',
    					'post_type' => 'collections',
    					'meta_query' => array(
            			array(
                    			'key' => 'artist',
                    			'value' => $post->ID,
                    			'compare' => 'LIKE'
            					)
    					)
					);
					$collections = get_posts( $args );
					the_collections($collections);
				?>
			<div class="clear"></div>
			<div class="hr"></div>
			<h4 class="grey"><i>Pieces</i></h4>
				<?php
					$args = array(
    					'numberposts' => -1,
    					'offset' => 0,
    					'orderby' => 'post_date',
    					'order' => 'DESC',
    					'post_type' => 'pieces',
    					'meta_query' => array(
            				array(
                    			'key' => 'artist',
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