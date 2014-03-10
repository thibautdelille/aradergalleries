<?php
	function the_collections($collections){
		foreach($collections as $post):
			$args = array(
				'numberposts' => 1,
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
				
			if($pieces){
				$piece = $pieces[0];
			?>
			<div class="element <?php echo get_post_type( $post->ID )?>">
				<div class="thumb">
					<a href="<?php echo get_permalink($post->ID)?>">
						<?php displayThumb($piece)?>
					</a>
				</div>
				<a href="<?php echo get_permalink($post->ID)?>">
					<h5 class="title"><?php echo get_the_title( $post->ID )?></h5>
				</a>
 				<?php the_artist_name($post, 'h6'); ?>
			</div>
		<?php }//end if $pieces
		endforeach;
	}
	
	function displayThumb($post){
		$attachment_id = get_field('large_image', $post->ID);
		$img = wp_get_attachment_image_src($attachment_id, $size='medium', $icon = false);
		
		$parentW = '228';
		$parentH = '220';
		$imgW = $img[1];
		$imgH = $img[2];
					
		$ratioImg = $imgW/$imgH;
		$ratioParent = $parentW/$parentH;
		//resize the image
		if($ratioImg>=$ratioParent){
			$newWidth = $parentW - 40;
			$newHeight = $imgH*$newWidth/$imgW;
			$widthHover = $parentW - 34;
			$heightHover = $imgH*$widthHover/$imgW;
		}else{
			$newHeight = $parentH - 40;
			$newWidth = $imgW*$newHeight/$imgH;
			$heightHover = $parentW - 34;
			$widthHover = $imgW*$heightHover/$imgH;
		}
		$top = ($parentH - $newHeight)/2;
		echo '<img src="'.$img[0].'" style="margin-top:'.$top.'px" width="'.$newWidth.'px" height="'.$newHeight.'px" widthInit="'.$newWidth.'px" heightInit="'.$newHeight.'px" widthHover="'.$widthHover.'px" heightHover="'.$heightHover.'px"/>';	
	}
	
	function the_pieces($pieces, $display_artist = true){
		foreach($pieces as $post):
			$attachment_id = get_field('large_image', $post->ID);
			$img = wp_get_attachment_image($attachment_id, $size='medium', $icon = false);
		?>
					
		<div class="element <?php echo get_post_type( $post->ID )?>">
			<div class="thumb">
				<a href="<?php echo get_permalink($post->ID)?>">
					<?php displayThumb($post)?>
				</a>
			</div>
			<a href="<?php echo get_permalink($post->ID)?>">
				<h5 class="title"><?php echo get_the_title( $post->ID )?></h5>
			</a>
 			<?php if($display_artist){
 				the_artist_name($post, 'h6');
			} ?>
		</div>
		<?php 
			endforeach;
	}
	function the_artists($artists){
		foreach($artists as $post):
			$args = array(
				'numberposts' => 1,
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
					
			if($pieces){
				$piece = $pieces[0];
				$attachment_id = get_field('large_image', $piece->ID);
				$img = wp_get_attachment_image_src($attachment_id, $size='medium', $icon = false);
			?>
					
			<div class="element <?php echo get_post_type( $post->ID )?>">
				<div class="thumb">
					<a href="<?php echo get_permalink($post->ID)?>">
						<?php displayThumb($piece)?>
					</a>
				</div>
				<a href="<?php echo get_permalink($post->ID)?>">
					<?php the_artist($post, 'h6'); ?>
				</a>
 				
			</div>
		<?php }//end if $pieces
		endforeach;
	}
	function the_artist_name($post, $tag, $before=''){
			$i = 0;
		echo '<'.$tag.' class="grey">'.$before;
		$i = 0;
 		foreach(get_field('artist', $post->ID) as $post_object):
			if($i!=0){
				echo " and ";
			} 
			$i++; 
			the_artist($post_object, $tag, $before);
		 endforeach; 
		echo '</'.$tag.'>';
	}
	function the_artist($post_object, $tag, $before=''){
			echo '<a class="grey" href="'.get_permalink($post_object->ID).'">';
 			echo get_the_title($post_object->ID);
 			$term_list = wp_get_post_terms($post_object->ID, 'dates', array("fields" => "all"));
			$dates = '';
			foreach($term_list as $term){
				if($dates!='')
					$dates .= '-'; 
				$dates .= $term->name;
			}
			echo '</a>';
		
	}
	
	/*function the_artist($post_object, $tag, $before){
			if($i!=0){?> and <?php } $i++;?>
 			<a class="grey" href="<?php echo get_permalink($post_object->ID)?>">
    			<?php echo get_the_title($post_object->ID); 
    			$term_list = wp_get_post_terms($post_object->ID, 'dates', array("fields" => "all"));
				$dates = '';
				foreach($term_list as $term){
					if($dates!='')
						$dates .= '-'; 
					$dates .= $term->name;
				}
				if($dates!='') echo ' ('.$dates.')';
    			?></a>
    		</<?php echo $tag;?>><?php
	}*/
	
	function the_next($currentPiece){
		$collections = get_field('collections', $currentPiece->ID);
			
		$pieces = get_the_pieces($collections[0]);
		
		$indexCurrent=0;
		$i=0;
		foreach ($pieces as $piece){
			if($piece->ID == $currentPiece->ID){
				$indexCurrent = $i;
			}
			$i++;
		}
		
		if($indexCurrent>=sizeof($pieces)-1){
			$indexCurrent = 0;
		}else{
			$indexCurrent++;
		}
		echo "Next piece</br><a href='".get_permalink($pieces[$indexCurrent]->ID)."'>".get_the_title($pieces[$indexCurrent]->ID)." ></a>";
	}
	
	function the_previous($currentPiece){
		$collections = get_field('collections', $currentPiece->ID);
			
		$pieces = get_the_pieces($collections[0]);
		
		$indexCurrent=0;
		$i=0;
		foreach ($pieces as $piece){
			if($piece->ID == $currentPiece->ID){
				$indexCurrent = $i;
			}
			$i++;
		}
		
		if($indexCurrent<=0){
			$indexCurrent = sizeof($pieces)-1;
		}else{
			$indexCurrent--;
		}
		echo "Previous piece</br><a href='".get_permalink($pieces[$indexCurrent]->ID)."'>< ".get_the_title($pieces[$indexCurrent]->ID)."</a>";
	}
	
	function get_the_pieces($collection){
		$args = array(
			'numberposts' => 50,
    		'offset' => 0,
    		'orderby' => 'post_date',
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
			
		return get_posts( $args );
	}
	
	function the_post_entry($post){	
		$nbEntry = 0;
		echo '<div class="entry-tag">';
		if(addTermList($post, 'publications', 'publications', 'From:', ', ')){
			$nbEntry++;
		}
		if(addTermList($post, 'location', 'location', 'Location:', ', ')){
			$nbEntry++;
		}
		if(addTermList($post, 'dates', 'date', 'Date:', ' - ')){
			$nbEntry++;
		}
		if(addTermList($post, 'techniques', 'technique', 'Techniques:', ' - ')){
			$nbEntry++;
		}
		if(addTermList($post, 'sizes', 'size', 'Sizes:', ' - ')){
			$nbEntry++;
		}
		if(get_field('more_infos')!=''){
		 	the_field('more_infos');
		 	echo '<br/>';
			$nbEntry++;
		}
		if($nbEntry>0){
		 	echo '<br/>';
		} 
		echo '</div>';
	}
	
	function addTermList($post, $termList, $termSlug, $beginTerm, $separator){
		$term_list = wp_get_post_terms($post->ID, $termList, array("fields" => "all"));
		if($term_list){ 
			echo $beginTerm." ";
			$html = '';
			foreach($term_list as $term){
				if($html!=''){
					$html .= $separator; 
				}
				$html .='<a href="'. get_bloginfo('url').'/'.$termSlug.'/'.$term->slug.'">'.$term->name.'</a>';
		 	}
		 	echo $html.'<br/>';
			return true;
		}else{
			if(get_post_type( $post->ID ) == "pieces"){
				$collection = get_field('collections', $post->ID);
				return addTermList($collection[0], $termList, $termSlug, $beginTerm, $separator);
			}
			return false;
		}
	}