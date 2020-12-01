<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />

	<!-- bg browser -->
	<meta name="theme-color" content="#000">
	<meta name="apple-mobile-web-app-status-bar-style" content="#000">
	<meta name="apple-mobile-web-app-status-bar-style" content="#000">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<header></header>

	<!-- Slider and Banner Internal -->
	<?php echo SliderAndBannerInternal(); ?>

	<!-- container -->
	<div class="container">
