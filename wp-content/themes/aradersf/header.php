<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
		   <?php
		         bloginfo('name');
		         /*
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		         */
		   ?>
	</title>
	
	<link rel="shortcut icon" href="/favicon.ico">
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php if ( is_singular() ) wp_enqueue_script('comment-reply'); ?>
	
	<?php wp_head(); ?>
	
	<script src="<?php bloginfo('template_url'); ?>/js/jquery.hoverflow.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/script.js"></script>
	
</head>

<body <?php body_class(); ?>>
	<header>
		<a class="logo" href="/"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="Arader Galleries Logo"></img></a>
		<h5>432 & 435 Jackson Street, San Francisco</h5>
		<nav>
			<?php wp_nav_menu( array( 'menu' => 'Header Menu' ) ); ?>
			<a href="/checkout">
				<div class="cart">
					<span class="icon-cart"></span>(<?php echo wpspc_get_total_cart_qty()?>)
				</div>
			</a>
			<div id="search" class="widget widget_search">
				<form id="searchform" method="get" action="<?php echo bloginfo('url');?>">
					<div>
						<input id="s" type="text" defaultValue="Search" value="Search" name="s">
					</div>
				</form>
			</div>
			<img id="left_fold" src="<?php bloginfo('template_url'); ?>/images/left_fold.png">
			<img id="right_fold" src="<?php bloginfo('template_url'); ?>/images/right_fold.png">
		</nav>		
	</header>
	<div class="bgimage-container">
		<img id="image_bg" src="<?php bloginfo('template_url'); ?>/images/image_bg.jpg">
	</div>
	<div class="page-wrap">