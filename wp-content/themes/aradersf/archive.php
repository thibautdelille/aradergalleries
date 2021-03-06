<?php get_header(); ?>
		<div class="clear"></div>
		<br/>
<?php get_sidebar(); ?>
		
		<div class="content-wrap">
			<h3><?php echo  wp_title('');?></h3>
			<div class="hr"></div>
				<?php 
					$aCollections = array();
					$aPieces = array();
					$aArtists = array();
					while (have_posts()) : the_post(); 
					if(get_post_type( $post->ID ) == "collections"){
						array_push($aCollections, $post);
					}
					if(get_post_type( $post->ID ) == "pieces"){
						array_push($aPieces, $post);
					}
					if(get_post_type( $post->ID ) == "artists"){
						array_push($aArtists, $post);
					}
					endWhile;
					
				if(($aCollections&&$aPieces)||($aCollections&&$aArtists)){
				?>
				<h4 class="grey"><i>Collections</i></h4>
				
				<?php }?>
			<div class="elements-wrap">
				<?php the_collections($aCollections)?>
			</div>
				<?php 
				if($aCollections&&$aPieces){
				?>
				<div class="clear"></div>
				<div class="hr"></div>
				<?php }
				if(($aCollections&&$aPieces)||($aPieces&&$aArtists)){
				?>
				<h4 class="grey"><i>Pieces</i></h4>
				
				<?php }?>
			<div class="elements-wrap">
				<?php the_pieces($aPieces);?>
			</div>
				<?php 
				if(($aCollections&&$aArtists)||($aPieces&&$aArtists)){
				?>
				<div class="clear"></div>
				<div class="hr"></div>
				<h4 class="grey"><i>Artists</i></h4>
				
				<?php }?>
				<div class="right layout">
					<span class="icon-list"></span>
					<span class="icon-layout"></span>
				</div>
				<div class="clear"></div>
			<div class="elements-wrap">
				<?php the_artists($aArtists);?>
			</div>
		</div>

<?php get_footer(); ?>