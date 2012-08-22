<?php $theme_options = get_option('hp_options'); ?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
	<meta property="og:title" content="<?php the_title(); ?>" /> 
	<meta property="og:url" content="<?php the_permalink(); ?>" />
	<meta property="fb:app_id" content="<?= $theme_options['fb_app_id']; ?>" />
	<?= (isset($theme_options['fb_user_id'])) ? "<meta property='fb:admins' content='$theme_options[fb_user_id]' />" : "" ?>
	<?php 
	if( is_single() ){ 
	    $thumbnail = get_post_thumbnail_id( $post->ID );
	    $thumb_url = wp_get_attachment_image_src($thumbnail,'large');
	    $thumb_url = $thumb_url[0];
	    if( $thumb_url != null ){
	    	echo "<meta property='og:image' content='$thumb_url' />";
	    }
	    echo "
	<meta property='og:type' content='article' />
	";
	    $query = new WP_Query('p='.$post->ID);
	    echo "<meta name='description' content=\"".$query->posts[0]->post_excerpt."\" />
	<meta property='og:description' content=\"".$query->posts[0]->post_excerpt."\" />
	";
	//<meta name="author" content="Nick ONeill">
	}else{
		if( isset($theme_options['logo']) ){
	?>
	<meta property="og:image" content="<?= $theme_options['logo'] ?>" /> 
	<?php } }
	if( isset($theme_options['logo']) ){
	?>
	<style type='text/css'>
		body > header h1{
			text-indent:-3000px;
			background:url('<?= $theme_options['logo'] ?>') no-repeat;
			height: 110px;
			width: 300px;
		}
	</style>
	<?php } ?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php if (is_home()) : ?>
	<?php bloginfo('name'); ?>
	<?php elseif (!is_home()) : ?>
	<?php the_title(); ?>
	<?php endif; ?></title>
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
  	var js, fjs = d.getElementsByTagName(s)[0];
  	if (d.getElementById(id)) return;
  	js = d.createElement(s); js.id = id;
  	js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?= $theme_options['fb_app_id']; ?>";
  	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<header>
		<h1><a href='/'><?php bloginfo('name'); ?></a></h1>
		<p><?= $theme_options['site_description'] ?></p>
	</header>
	<section>