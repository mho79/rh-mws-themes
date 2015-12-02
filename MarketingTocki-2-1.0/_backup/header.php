<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> <?php if ( is_page_template( 'page-blank.php' ) ) { ?>id="blank-html"<?php } ?> >
<head>
<?php global $tocki_redux_themeoptions; // globale Variable für die Theme Options. ?>
<title><?php the_title(); ?> | <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_title"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_title"]; }; ?></title>
<link rel="shortcut icon" href="<?php  if (!empty($tocki_redux_themeoptions["tocki_redux_favicon"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_favicon"]; }; ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" /> <!-- allgemeines CSS -->
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/font-awesome-4.4.0/css/font-awesome.min.css" /> <!-- font awesome 4.1.0 -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php if ($tocki_redux_themeoptions['tocki_redux_mobile_iphone_numbers_klickable'] == 1) { ?>
	<!-- Telefon-Nr. auf iOS werden als Links anzeigen -->
<?php } else { ?>
	<meta name="format-detection" content="telephone=no"> <!-- Telefon-Nr. auf iOS NICHT als Links anzeigen -->
<?php } ?>

<?php if ($tocki_redux_themeoptions['tocki_redux_seo_switcher'] == 1) { ?>
	<!-- Suchmaschinen zulassen -->
<?php } else { ?>
	<meta name='robots' content='noindex,follow' /> <!-- Suchmaschinen ausschliessen -->
<?php } ?>


<?php wp_head(); ?>

<style type="text/css">
<?php if (!empty($tocki_redux_themeoptions["tocki_redux_header_height"])) { ?>.header{ min-height: <?php echo $tocki_redux_themeoptions["tocki_redux_header_height"]; ?>}<?php }; ?>
		@media only screen and ( max-width: 840px ) 
			{
				<?php if (!empty($tocki_redux_themeoptions["tocki_redux_header_height"])) { ?>.header{ min-height: <?php echo ($tocki_redux_themeoptions["tocki_redux_header_height"] * 0.75); ?>px}<?php }; ?>
			}


<?php if ($tocki_redux_themeoptions['tocki_redux_header_logo_switch'] == 1) { ?>
				.logoimg.kleiner {
					width: <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_header_logo_small_width"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_header_logo_small_width"]; }; ?>;
					}
<?php }; ?>

<?php if (empty($tocki_redux_themeoptions["tocki_redux_typography_titles_h1"]["color"])) { ?>h1,<?php }; ?>
.corporate-color,
blockquote:before,
a:link:not(.tocki-proxy-number), a:visited:not(.tocki-proxy-number), a:active:not(.tocki-proxy-number), a:hover:not(.tocki-proxy-number),
.content .leistungen ul li {
	color: <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; }; ?>;
	}

.content a.tocki-proxy-number:link, .content a.tocki-proxy-number, .content a.tocki-proxy-number:active, .content a.tocki-proxy-number:hover{
	color: <?php echo $tocki_redux_themeoptions["tocki_redux_typography_body"]["color"]; ?>;
	}

.corporate-border {
	border: 10px solid <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; }; ?>;
	}

.corporate-top-border,
.sidebar-mobile .sidebar-box:first-child {
	border-top: 1px dotted <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; }; ?>;
	}

.sidebar {
	border-left: 1px dotted <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; }; ?>;
	}
		@media only screen and ( max-width: 840px ) 
			{
			.sidebar {
				border-left: none; /* Hallo Saz */
				}
			}

.corporate-bottom-border {
	border-bottom: 1px dotted <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; }; ?>;
	}

.header-logo,
.header .phonebox{
	background: <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_header_logo_bg"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_header_logo_bg"]; }; ?>;
	}

/* Menu Styles */
<?php if ($tocki_redux_themeoptions['tocki_redux_colorextend'] == 1) { ?>

/* Hex to RGB */
<?php 
	function hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);
		
		if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return implode(",", $rgb); // returns the rgb values separated by commas
		//return $rgb; // returns an array with the rgb values
	} 
	$tockihex = $tocki_redux_themeoptions["tocki_redux_colorextend_menu_bg"]["color"];
	$rgb = hex2rgb($tockihex);
?>

	<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_menu_bg"])) { ?>
	.menu-bg
		{ 
		background-color: rgba(<?php print_r($rgb); ?>,<?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_bg"]["alpha"]; ?>);
		}
		
	#nav li ul li a:hover,
	#nav li ul:not( :hover ) li.active a
		{ 
		color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_bg"]["color"]; ?>;
		}
	<?php }; ?>
	<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_menu_active"])) { ?>	
	#nav > ul:not( :hover ) > li.active > a,
	#nav li a:active, 				
	#nav li.current-menu-item a,
	#nav ul li.current-menu-parent a,
	#nav ul li.current_page_parent a,
	#nav ul li.current_page_item a{
		color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_active"]; ?>;		
	}
	#nav > ul > li:hover > a,
	#nav ul li.current-menu-item ul li a:hover,
	#nav ul li.current-menu-parent ul li a:hover,
	#nav ul li.current-menu-parent ul li.current-menu-item a,
	#nav li ul{ 
		background-color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_active"]; ?>;
		color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_bg"]["color"]; ?>;
		}
	<?php }; ?>
	
	<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_menu_bg"])) { ?>
		@media only screen and ( max-width: 840px ) 
			{
				#nav > a,
				.menu-bg {
					background-color: rgba(<?php print_r($rgb); ?>,<?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_bg"]["alpha"]; ?>);
				}
			}
	<?php } ?>
	
	<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_menu_active"])) { ?>
		@media only screen and ( max-width: 840px ) 
			{
				#nav ul { 
					background-color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_active"]; ?>;
				}
				#nav > ul > li:not( :last-child ) > a {
					border-bottom: 1px solid <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_active"]; ?>;
				}
				#nav > ul:not( :hover ) > li.active > a,
				#nav li a:active, 				
				#nav li.current-menu-item a,
				#nav ul li.current-menu-parent a,
				#nav ul li.current_page_parent a,
				#nav ul li.current_page_item a {
					color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_bg"]["color"]; ?>;
				}
			}
	<?php } ?>
<?php } else { ?>


	<?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?>
	#nav > ul,
	#nav li ul li a:hover,
	#nav li ul:not( :hover ) li.active a
		{ 
		background-color: <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; }; ?>;
		}
	#nav li ul a {
		border-top: 1px solid <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; }; ?>;
		}
	<?php }; ?>
	<?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?>
	#nav > ul > li:hover > a,
	#nav > ul:not( :hover ) > li.active > a,
	#nav li a:active, 				
	#nav li.current-menu-item a,
	#nav ul li.current-menu-item ul li a:hover,
	#nav ul li.current-menu-parent ul li a:hover,
	#nav ul li.current-menu-parent ul li.current-menu-item a,
	#nav ul li.current-menu-parent a,
	#nav ul li.current_page_parent a,
	#nav ul li.current_page_item a,
	#nav li ul{ 
		background-color: <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; }; ?>;
		opacity: 0.5;
   		filter:Alpha(Opacity=50);
		}
	
	#nav > ul > li:not( :last-child ) > a{	
		border-right: 1px solid #fff;
	}
	<?php }; ?>
	
	<?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?>
		@media only screen and ( max-width: 840px ) 
			{
				#nav > a {
					background-color: <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; }; ?>;
				}
			}
	<?php } ?>
	
	<?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?>
		@media only screen and ( max-width: 840px ) 
			{
				#nav > ul > li:not( :last-child ) > a {
					border-bottom: 1px solid #fff;
				}
			}
	<?php } ?>


<?php } ?>

.logoimg {
	height: <?php if (!empty($tocki_redux_themeoptions["tocki_redux_header_logo_height"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_header_logo_height"]; }; ?>;
	width: <?php if (!empty($tocki_redux_themeoptions["tocki_redux_header_logo_width"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_header_logo_width"]; }; ?>;
}
		@media only screen and ( max-width: 840px ) 
			{
				.logoimg,
				.logoimg.kleiner {
					height: <?php if (!empty($tocki_redux_themeoptions["tocki_redux_header_logo_height"])) { ?><?php echo ($tocki_redux_themeoptions["tocki_redux_header_logo_height"] / 2); }; ?>px;
					width: <?php if (!empty($tocki_redux_themeoptions["tocki_redux_header_logo_width"])) { ?><?php echo ($tocki_redux_themeoptions["tocki_redux_header_logo_width"] / 2); }; ?>px;
				}
			}

form.kontaktformular input[type=submit],
.tocki-sidebar-button {
	background-color: <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; }; ?>;
	}

form.kontaktformular input,
form.kontaktformular textarea,
form.kontaktformular select {
	border: 1px solid <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; }; ?>;
	}
	
form.kontaktformular input[type=submit],
.tocki-sidebar-button {	
		background: <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; }; ?> ;
		}

<?php if ($tocki_redux_themeoptions['tocki_redux_colorextend'] == 1) { ?>
	<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_header_cta"])) { ?>.colorextend-header-cta, 
			.header .phonebox a.tocki-proxy-number:link, 
			.header .phonebox a.tocki-proxy-number,
			.header .phonebox a.tocki-proxy-number:active, 
			.header .phonebox a.tocki-proxy-number:hover{ color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_header_cta"]; ?>;}<?php }; ?>
	<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_bullets"])) { ?>.content .leistungen ul li{ color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_bullets"]; ?>;}<?php }; ?>
	<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_form_border"])) { ?>form.kontaktformular input, form.kontaktformular textarea, form.kontaktformular select{border: 1px solid <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_form_border"]; ?>;}<?php }; ?>
	<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_form_submit"])) { ?>form.kontaktformular input[type=submit]{background: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_form_submit"]; ?>;}<?php }; ?>
	<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"])) { ?>.content-phonebox{
						border-style: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"]["border-style"]; ?>; 
						border-color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"]["border-color"]; ?>;
						border-top-width: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"]["border-top"]; ?>;
						border-right-width: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"]["border-right"]; ?>;
						border-bottom-width: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"]["border-bottom"]; ?>;
						border-left-width: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"]["border-left"]; ?>;
						}<?php }; ?>
	
<?php } else { ?>
<?php } ?>

<?php if ($tocki_redux_themeoptions['tocki_redux_content_padding_switch'] == 1) { ?>
	.main-middle {padding: 0 25px;}
	@media only screen and ( max-width: 960px ) {
		.main-middle {padding: 0;}
	}
	@media only screen and ( max-width: 840px ) {
		.main-middle {padding: 0 15px;}
	}
<?php } ?>

a.tocki-sidebar-button 				{ color: #fff; }
a.awesome, a.awesome:visited		{ background-color: <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; }; ?>; color: #fff;  }
a.awesome:hover						{ background-color: <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; }; ?>; color: #fff;  }


<?php if (!empty($tocki_redux_themeoptions["tocki_redux_code_css"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_code_css"];}; ?>
<?php if (!empty($tocki_redux_themeoptions["tocki_redux_code_css_840"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_code_css_840"];}; ?>
<?php if (!empty($tocki_redux_themeoptions["tocki_redux_code_css_500"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_code_css_500"];}; ?>

<?php if (!empty($tocki_redux_themeoptions["tocki_redux_codeextend"])) { ?>/* Badge CSS */ <?php echo $tocki_redux_themeoptions["tocki_redux_code_badge_css"];} else {; ?>/* Badge deaktiviert */<?php } ?>

</style>

<?php if (!empty($tocki_redux_themeoptions["tocki_redux_code_header"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_code_header"];}; ?>
 
</head>

<body <?php body_class(); ?> <?php if (has_post_thumbnail($post->ID)) { ?>style="background-image: url(<?php $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');echo $thumbnail_src [0];?>) "<?php } ?><?php if ( is_page_template( 'page-blank.php' ) ) { ?>style="background-image: none;"<?php }?>>

<?php if ( is_page_template( 'page-blank.php' ) ) {
	// kein Menu auf der blank-page
} else { ?>

    <div class="menu-bg">
        <div class="wrapper">
        <!-- MENU MUSS ERST IM BACKEND ZUGEWIESEN WERDEN! -->

        <?php 
		if (( $tocki_redux_themeoptions['tocki_redux_child_menues'] == 1)) {
		?>
		 	<?php
			if($post->post_parent) {
			  $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
			  $titlenamer = get_the_title($post->post_parent);
			  }

			  else {
			  $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
			  $titlenamer = get_the_title($post->ID);
			  }
			  if ($children) { ?>
			<nav id="nav" class="menu-hauptmenu-container"><a href="#nav" title="Menü anzeigen">Menü <i class="fa fa-angle-down fa-1x"></i></a><a href="#" title="Menü verbergen">Menü <i class="fa fa-angle-up fa-1x"></i></a>
			<ul id="menu-hauptmenu" class="menu">
			<?php 
			if(!function_exists('get_post_top_ancestor_id')){
			function get_post_top_ancestor_id(){
			    global $post;
			    
			    if($post->post_parent){
			        $ancestors = array_reverse(get_post_ancestors($post->ID));
			        return $ancestors[0];
			    }
			    
			    return $post->ID;
			}}
			?>
			<?php wp_list_pages( array('title_li'=>'','include'=>get_post_top_ancestor_id()) ); ?>
			<?php echo $children; ?>
			</ul>
			</nav>
		<?php } ?>
		<?php
		} 
		elseif ( is_page_template( 'page-adwords.php' ) ) {
			wp_nav_menu( array( 'container' => 'nav', 'container_class' => '', 'container_id' => 'nav', 'theme_location' => 'adwordsnavi', 'fallback_cb' => 'false', 'items_wrap' => '<a href="#nav" title="Menü anzeigen">Menü <i class="fa fa-angle-down fa-1x"></i></a><a href="#" title="Menü verbergen">Menü <i class="fa fa-angle-up fa-1x"></i></a><ul id="%1$s" class="%2$s">%3$s</ul>' ) );
		}
		else { 
			wp_nav_menu( array( 'container' => 'nav', 'container_class' => '', 'container_id' => 'nav', 'theme_location' => 'hauptnavi', 'fallback_cb' => 'false', 'items_wrap' => '<a href="#nav" title="Menü anzeigen">Menü <i class="fa fa-angle-down fa-1x"></i></a><a href="#" title="Menü verbergen">Menü <i class="fa fa-angle-up fa-1x"></i></a><ul id="%1$s" class="%2$s">%3$s</ul>' ) );
		} ?>

            <div class="header-logo" id="logo">
            	<?php if (( $tocki_redux_themeoptions['tocki_redux_child_menues'] == 1)) {  ?>
            		<a href="<?php echo get_permalink( $post->post_parent ); ?>"><img src="<?php echo $tocki_redux_themeoptions["tocki_redux_header_logo"]["url"]; ?>" alt="<?php echo $tocki_redux_themeoptions["tocki_redux_header_logo_alt"]; ?>" class="logoimg"></a>
			    <?php // first check if it is adwords page, then only show parent link
				}
			    elseif ( is_page_template( 'page-adwords.php' ) ) { ?>

			        <?php if (!empty($tocki_redux_themeoptions["tocki_redux_header_logo"]["url"])) { ?>
			            <a href="<?php echo get_permalink( $post->post_parent ); ?>"><img src="<?php echo $tocki_redux_themeoptions["tocki_redux_header_logo"]["url"]; ?>" alt="<?php echo $tocki_redux_themeoptions["tocki_redux_header_logo_alt"]; ?>" class="logoimg"></a>
			        <?php } ?>

			    <?php // then check if it has a costum url in themeoptions
				} elseif (!empty($tocki_redux_themeoptions["tocki_redux_header_url"])) { ?>

			        <?php if (!empty($tocki_redux_themeoptions["tocki_redux_header_logo"]["url"])) { ?>
			            <a href="<?php echo $tocki_redux_themeoptions["tocki_redux_header_url"]; ?>"<?php if ($tocki_redux_themeoptions['tocki_redux_header_target'] == 1) { ?>target="_blank"<?php } ?>><img src="<?php echo $tocki_redux_themeoptions["tocki_redux_header_logo"]["url"]; ?>" alt="<?php echo $tocki_redux_themeoptions["tocki_redux_header_logo_alt"]; ?>" class="logoimg"></a>
			        <?php } ?>

			    <?php // else: display the normal logo
				} else { ?>

			        <?php if (!empty($tocki_redux_themeoptions["tocki_redux_header_logo"]["url"])) { ?>
			            <a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo $tocki_redux_themeoptions["tocki_redux_header_logo"]["url"]; ?>" alt="<?php echo $tocki_redux_themeoptions["tocki_redux_header_logo_alt"]; ?>" class="logoimg"></a>
			        <?php } 
			        
			    } ?>  

			</div>

            <div class="logo-tel">
                Tel: <span><?php if (is_mobile()) {?><a href="tel:{regiohelden.proxy.number}"><?php }?>{regiohelden.proxy.number}<?php if (is_mobile()) {?></a><?php }?></span>
            </div>
        </div> <!-- /wrapper -->
    </div> <!-- /menu-bg -->

<?php } ?>

<div class="wrapper"> <!-- Beginn wrapper / Endet im Footer -->

	<?php if ( is_page_template( 'page-blank.php' ) ) {
        // kein Badge
    } else { ?>
    
    <?php if (!empty($tocki_redux_themeoptions["tocki_redux_codeextend"])) { ?><!-- Badge HTML --> <?php echo $tocki_redux_themeoptions["tocki_redux_code_badge_html"];} else {; ?><!-- Badge deaktiviert --><?php } ?>
    
        <!-- Beginn header  -->
        <header class="header">
            <div class="phonebox corporate-color colorextend-header-cta">
            <?php dynamic_sidebar( 'header-widget-area' ); ?>
            </div>
        </header> <!-- Ende header -->  
        
        <div style="clear: both;"></div>
            
            <!-- /////////////////////////////////////////////////////////////  MAIN CONTENT ///////////////////////////////////////////////////////////// -->
    
    <?php } ?>
    
    <div class="main-middle"> <!-- main-middle / Endet im Footer  -->  
