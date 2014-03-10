<?php get_header(); the_post();?>

	<?php dynamic_sidebar('Home Widget') ?>
		<!--<div class="news">
			<div class="text">
				<h1>Maps on Sale</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec facilisis consectetur nunc, euismod dignissim metus pretium id. </p>
			</div>
			<img src="<?php bloginfo('template_url'); ?>/images/maps_for_sale.jpg"></img>
		</div>-->
<?php get_sidebar(); ?>
		<div class="content-wrap">
			<img src="<?php bloginfo('template_url'); ?>/images/gallery_home.jpg"></img>
			<div class="text">
				<?php the_content(); ?>
			</div>
		</div>


<?php get_footer(); ?>