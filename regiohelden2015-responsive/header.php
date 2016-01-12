<?php
/**
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
<meta name="theme-color" content="#f28722">

<meta http-equiv="cache-control" content="max-age=0">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
<meta http-equiv="pragma" content="no-cache">

<!-- Touch Favicons START -->
<link rel="apple-touch-icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/apple-touch-icon.png">
<link rel="apple-touch-icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/apple-touch-icon-57x57.png" sizes="57x57">
<link rel="apple-touch-icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/apple-touch-icon-60x60.png" sizes="60x60">
<link rel="apple-touch-icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/apple-touch-icon-72x72.png" sizes="72x72">
<link rel="apple-touch-icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/apple-touch-icon-76x76.png" sizes="76x76">
<link rel="apple-touch-icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/apple-touch-icon-114x114.png" sizes="114x114">
<link rel="apple-touch-icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/apple-touch-icon-120x120.png" sizes="120x120">
<link rel="apple-touch-icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/apple-touch-icon-128x128.png" sizes="128x128">
<link rel="apple-touch-icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/apple-touch-icon-144x144.png" sizes="144x144">
<link rel="apple-touch-icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/apple-touch-icon-152x152.png" sizes="152x152">
<link rel="apple-touch-icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/apple-touch-icon-180x180.png" sizes="180x180">
<link rel="apple-touch-icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/apple-touch-icon-precomposed.png">
<link rel="icon" type="image/png" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/favicon-160x160.png" sizes="160x160">
<link rel="icon" type="image/png" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/favicon-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/favicon-196x196.png" sizes="196x196">
<meta name="msapplication-TileImage" content="<?php bloginfo( 'stylesheet_directory' ); ?>/images/win8-tile-144x144.png"> 
<meta name="msapplication-TileColor" content="#f28722"> 
<meta name="msapplication-navbutton-color" content="#fff">
<meta name="application-name" content="RegioHelden"> 
<meta name="msapplication-tooltip" content="RegioHelden"> 
<meta name="apple-mobile-web-app-title" content="RegioHelden"> 
<meta name="msapplication-square70x70logo" content="<?php bloginfo( 'stylesheet_directory' ); ?>/images/win8-tile-70x70.png"> 
<meta name="msapplication-square144x144logo" content="<?php bloginfo( 'stylesheet_directory' ); ?>/images/win8-tile-144x144.png"> 
<meta name="msapplication-square150x150logo" content="<?php bloginfo( 'stylesheet_directory' ); ?>/images/win8-tile-150x150.png"> 
<meta name="msapplication-wide310x150logo" content="<?php bloginfo( 'stylesheet_directory' ); ?>/images/win8-tile-310x150.png"> 
<meta name="msapplication-square310x310logo" content="<?php bloginfo( 'stylesheet_directory' ); ?>/images/win8-tile-310x310.png"> 
<link rel="shortcut icon" type="image/png" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/favicon.png">
<!-- Touch Favicons END -->

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="author" href="<?php bloginfo( 'stylesheet_directory' ); ?>/humans.txt">

<!-- CI-Font START -->
<script>
  (function(d) {
    var config = {
      kitId: 'ebb6bki',
      scriptTimeout: 4000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='//use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>
<!-- CI Font END -->

<?php if(is_page(6506)){?>

<?php include (TEMPLATEPATH . "/inc-website-performance-ausgabe.php"); ?>

<script type="text/javascript" src="https://www.google.com/jsapi?autoload=%7B%22modules%22%3A%5B%7B%22name%22%3A%22visualization%22%2C%22version%22%3A%221.0%22%2C%22callback%22%3A%22drawChart%22%2C%22packages%22%3A%5B%22corechart%22%5D%7D%5D%7D">
</script>
<?php } ?>

<!-- wp_head START -->
<?php wp_head(); ?>
<!-- wp_head END -->
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/Organization">		
<!--[if lte IE 8]>
<div class="container-fluid ie-info">
	<div class="row">
		<div class="col-md-12">
			Ihr Webbrowser ist veraltet, daher kann es zu Darstellungsfehlern auf dieser Seite kommen. Bitte aktualisieren Sie Ihren Browser.</a>
		</div>
	</div>
</div>
<![endif]-->
<!-- Logo Header -->
<div class="container-fluid logo">
	<div class="row">
		<div class="col-md-12">
			<div class="logo-wrapper">
				<a itemprop="url" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="mobile-logo"> <img itemprop="logo" src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/rh-mobile-logo-2.svg" class="logo-img"> </a>
				<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="desktop-logo"> <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/regiohelden-gmbh-logo.svg" class="logo-img">
                <div class="logo-text"><span itemprop="name">RegioHelden</span>
				<em>Lokale Internetwerbung messbar</em></div></a>
			</div>
			<div class="top-header-cta">
					<span>Jetzt anrufen:</span><br><span class="header-nummer"><i class="fa fa-phone"></i> 0711 128 501-0</span><span class="header-nummer-mobile"><a href="tel:00497111285010"><i class="fa fa-phone"></i> 0711 128 501-0</a></span>
			</div>
			<div class="top-kunden-login">
				<a href="http://regioheld.com/administration" target="_blank" class="login-link"><i class="fa fa-sign-in"></i> Kunden-Login</a>
			</div>
		</div>
	</div>
</div>	   
<!-- Navigation -->
<div class="orange-top">
	<div class="row">
		
		<?php wp_nav_menu( array( 'container_class' => 'hauptnavi', 'theme_location' => 'hauptnavi' ) ); ?>
		<a href="#mmenu-navi" class="mobile-open-close">Navigation</a>
		
	</div>
</div>
<!-- Content Wrapper Start -->
<div class="container-fluid content">
	<main class="main-content">