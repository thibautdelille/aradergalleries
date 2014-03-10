<?php get_header(); ?>
		<div class="clear"></div>
<?php get_sidebar(); ?>
		
		<div class="content-wrap">
			<div class="back">
				<a href="<?php echo bloginfo('url')?>">< back</a>
			</div>
			<div class="hr"></div>
			<h3><?php echo single_cat_title( '', false )?></h3>
			<div class="hr"></div>
			<div class="elements-wrap">
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
				
				<?php }
					the_collections($aCollections);
				
				if($aCollections&&$aPieces){
				?>
				<div class="clear"></div>
				<div class="hr"></div>
				<?php }
				if(($aCollections&&$aPieces)||($aPieces&&$aArtists)){
				?>
				<h4 class="grey"><i>Pieces</i></h4>
				
				<?php }
				the_pieces($aPieces);
				
				if(($aCollections&&$aArtists)||($aPieces&&$aArtists)){
				?>
				<div class="clear"></div>
				<div class="hr"></div>
				<h4 class="grey"><i>Artist</i></h4>
				
				<?php }
				the_artists($aArtists);?>
			</div>
		</div>

<?php get_footer(); ?>