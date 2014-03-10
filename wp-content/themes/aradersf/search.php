<?php get_header(); ?>
		<div class="clear"></div>
		<br/>
<?php get_sidebar(); ?>
		
		<div class="content-wrap">
			<div class="back">
				<a href="<?php echo bloginfo('url')?>">< home</a>
			</div>
			<div class="hr"></div>
			<h3>Search Results for : <?php echo get_search_query() ?></h3>
			<div class="hr"></div>
			<?php if(have_posts()){?>
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
					
				if(($aArtists&&$aPieces)||($aCollections&&$aArtists)){
				?>
				<h4 class="grey"><i>Artists</i></h4>
				
				<?php }
					the_artists($aArtists);
				
				if(($aCollections&&$aPieces)||($aCollections&&$aArtists)){
				?>
				<div class="clear"></div>
				<div class="hr"></div>
				<h4 class="grey"><i>Collections</i></h4>
				
				<?php }
				the_collections($aCollections);
				
				if(($aCollections&&$aPieces)||($aPieces&&$aArtists)){
				?>
				<div class="clear"></div>
				<div class="hr"></div>
				<h4 class="grey"><i>Pieces</i></h4>
				
				<?php }
				the_pieces($aPieces);?>
			</div>
			<?php }else{?>
				<h4>No results found.</h4>
			<?php }?>
		</div>
<!--
	<?php if (have_posts()) : ?>

		<h2>Search Results</h2>

		<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

				<h2><?php the_title(); ?></h2>

				<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

				<div class="entry">
					<?php the_excerpt(); ?>
				</div>

			</div>

		<?php endwhile; ?>

		<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

	<?php else : ?>

		<h2>No posts found.</h2>

	<?php endif; ?>

<?php get_sidebar(); ?>
-->
<?php get_footer(); ?>