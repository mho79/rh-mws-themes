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
<html <?php language_attributes(); ?>>
	<head>
		<?php global $tocki_redux_themeoptions; // globale Variable für die Theme Options. ?>
		<meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

		<title>
			<?php the_title(); ?> | 
			<?php if (!empty($tocki_redux_themeoptions["tocki_redux_title"])) { 
				echo $tocki_redux_themeoptions["tocki_redux_title"]; 
			} ?>
		</title>

		<link rel="shortcut icon" href="<?php if (!empty($tocki_redux_themeoptions["tocki_redux_favicon"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_favicon"]; }; ?>">
		<link rel="stylesheet" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>"> <!-- allgemeines CSS -->
		<link rel="stylesheet" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/font-awesome-4.4.0/css/font-awesome.min.css"> <!-- font awesome 4.1.0 -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<?php if ($tocki_redux_themeoptions['tocki_redux_mobile_iphone_numbers_klickable'] == 1) { ?>
			<!-- Telefon-Nr. auf iOS werden als Links anzeigen -->
		<?php } else { ?>
			<meta name="format-detection" content="telephone=no"> <!-- Telefon-Nr. auf iOS NICHT als Links anzeigen -->
		<?php } ?>

		<?php if ($tocki_redux_themeoptions['tocki_redux_seo_switcher'] == 1) { ?>
			<!-- Suchmaschinen zulassen -->
		<?php } else { ?>
			<meta name='robots' content='noindex,follow'> <!-- Suchmaschinen ausschliessen -->
		<?php } ?>

		<?php wp_head(); ?>

		<style>
			<?php if (!empty($tocki_redux_themeoptions["tocki_redux_header_height"])) { ?>
				.header{ min-height: <?php echo $tocki_redux_themeoptions["tocki_redux_header_height"]; ?> }
			<?php } ?>

			<?php if (empty($tocki_redux_themeoptions["tocki_redux_typography_titles_h1"]["color"])) { ?>
				h1,
			<?php } ?>
			.corporate-color,
			blockquote:before,
			a:link,
			a:visited,
			a:active,
			a:hover,
			.content .leistungen ul li {
				color: <?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; } ?>;
			}

			.corporate-border {
				border: 10px solid <?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; } ?>;
			}

			.corporate-top-border {
				border-top: 1px dotted <?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; } ?>;
			}

			.corporate-bottom-border {
				border-bottom: 1px dotted <?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; } ?>;
			}

			/* Menu Styles */
			<?php if ($tocki_redux_themeoptions['tocki_redux_colorextend'] == 1) { ?>
				<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_menu_bg"])) { ?>
					#nav > ul,
					#nav li ul li a:hover,
					#nav li ul:not( :hover ) li.active a { 
						background-color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_bg"]; ?>;
					}

					#nav li ul a {
						border-top: 1px solid <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_bg"]; ?>;
					}
				<?php } ?>

				<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_menu_active"])) { ?>
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
					#nav li ul { 
						background-color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_active"]; ?>;
					}
					
					#nav > ul > li:not( :last-child ) > a {	
						border-right: 1px solid <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_active"]; ?>;
					}
				<?php } ?>
				
				<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_menu_bg"])) { ?>
					@media only screen and ( max-width: 715px ) {
						#nav > a {
							background-color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_bg"]; ?>;
						}
					}
				<?php } ?>
				
				<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_menu_active"])) { ?>
					@media only screen and ( max-width: 715px ) {
							#nav > ul > li:not( :last-child ) > a {
								border-bottom: 1px solid <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_active"]; ?>;
							}
						}
				<?php } ?>
			<?php } else { ?>
				<?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?>
					#nav > ul,
					#nav li ul li a:hover,
					#nav li ul:not( :hover ) li.active a { 
						background-color: <?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; } ?>;
					}

					#nav li ul a {
						border-top: 1px solid <?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; } ?>;
					}
				<?php } ?>

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
						background-color: <?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; } ?>;
						opacity: 0.5;
				   		filter:Alpha(Opacity=50);
					}
					
					#nav > ul > li:not( :last-child ) > a {	
						border-right: 1px solid #fff;
					}
				<?php } ?>
				
				<?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?>
					@media only screen and ( max-width: 715px ) {
						#nav > a {
							background-color: <?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) {  echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; } ?>;
						}
					}
				<?php } ?>
				
				<?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?>
					@media only screen and ( max-width: 715px ) 
						{
							#nav > ul > li:not( :last-child ) > a {
								border-bottom: 1px solid #fff;
							}
						}
				<?php } ?>
			<?php } ?>

			form.kontaktformular input[type=submit],
			.tocki-sidebar-button {
				background-color: <?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; } ?>;
			}

			form.kontaktformular input,
			form.kontaktformular textarea,
			form.kontaktformular select {
				border: 1px solid <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; } ?>;
			}
				
			form.kontaktformular input[type=submit],
			.tocki-sidebar-button {	
				background: <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; } ?> ;
			}

			<?php if ($tocki_redux_themeoptions['tocki_redux_colorextend'] == 1) { ?>
				<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_header_cta"])) { ?>
						.colorextend-header-cta{ color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_header_cta"]; ?>;}
					<?php } ?>
				<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_bullets"])) { ?>
						.content .leistungen ul li{ color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_bullets"]; ?>;}
					<?php } ?>
				<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_form_border"])) { ?>
					form.kontaktformular input, 
					form.kontaktformular textarea, 
					form.kontaktformular select{ border: 1px solid <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_form_border"]; ?>; }
				<?php } ?>
				<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_form_submit"])) { ?>
					form.kontaktformular input[type=submit]{background: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_form_submit"]; ?>; }
				<?php } ?>
				<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"])) { ?>
					.content-phonebox{
						border-style: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"]["border-style"]; ?>; 
						border-color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"]["border-color"]; ?>;
						border-top-width: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"]["border-top"]; ?>;
						border-right-width: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"]["border-right"]; ?>;
						border-bottom-width: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"]["border-bottom"]; ?>;
						border-left-width: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"]["border-left"]; ?>;
					}
				<?php } ?>
			<?php } else { ?>
			<?php } ?>

			a.tocki-sidebar-button { color: #fff; }

			a.awesome, 
			a.awesome:visited { 
				background-color: <?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; }; ?>; 
				color: #fff; 
			}

			a.awesome:hover { 
				background-color: <?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; }; ?>;
				color: #fff;
			}

			<?php 
			if (!empty($tocki_redux_themeoptions["tocki_redux_code_css"])) {
				echo $tocki_redux_themeoptions["tocki_redux_code_css"];
			}

			if (!empty($tocki_redux_themeoptions["tocki_redux_code_css_715"])) { 
				echo $tocki_redux_themeoptions["tocki_redux_code_css_715"];
			}

			if (!empty($tocki_redux_themeoptions["tocki_redux_code_css_500"])) { 
				echo $tocki_redux_themeoptions["tocki_redux_code_css_500"];
			}

			if (!empty($tocki_redux_themeoptions["tocki_redux_codeextend"])) { 
				/* Badge CSS */
				echo $tocki_redux_themeoptions["tocki_redux_code_badge_css"];
			} else {
				/* Badge deaktiviert */
			} ?>
		</style>

		<?php if (!empty($tocki_redux_themeoptions["tocki_redux_code_header"])) { 
			echo $tocki_redux_themeoptions["tocki_redux_code_header"];
		} ?>
	</head>

	<body <?php body_class(); ?> <?php if ( is_page_template( 'page-blank.php' ) ) { ?>style="background-image: none;"<?php }?>>
		<div class="wrapper"> <!-- Beginn wrapper / Endet im Footer -->
			<?php if ( is_page_template( 'page-blank.php' ) ) {
				// kein Menu auf der blank-page
			} else {
				if (!empty($tocki_redux_themeoptions["tocki_redux_codeextend"])) {
					/* Badge HTML */
					echo $tocki_redux_themeoptions["tocki_redux_code_badge_html"];
				} else {
					/* Badge deaktiviert */
				}

				if ($tocki_redux_themeoptions['tocki_redux_child_menues'] == 1) {
					if($post->post_parent) {
				  		$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
				  		$titlenamer = get_the_title($post->post_parent);
				  	} else {
				  		$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
				  		$titlenamer = get_the_title($post->ID);
				  	}

				  	if ($children) { ?>
						<nav id="nav" class="menu-hauptmenu-container"><a href="#nav" title="Menü anzeigen">Menü <i class="fa fa-angle-down fa-1x"></i></a><a href="#" title="Menü verbergen">Menü <i class="fa fa-angle-up fa-1x"></i></a>
							<ul id="menu-hauptmenu" class="menu">
								<?php 
								if(!function_exists('get_post_top_ancestor_id')){
									function get_post_top_ancestor_id() {
									    global $post;
									    
									    if($post->post_parent){
									        $ancestors = array_reverse(get_post_ancestors($post->ID));
									        return $ancestors[0];
									    }
									    
									    return $post->ID;
									}
								}

								wp_list_pages( array('title_li'=>'','include'=>get_post_top_ancestor_id()) );
								echo $children; ?>
							</ul>
						</nav>
					<?php 
					}
				}  elseif ( is_page_template( 'page-adwords.php' ) ) {
					wp_nav_menu(
						array('container' => 'nav',
							  'container_class' => '',
							  'container_id' => 'nav',
							  'theme_location' => 'adwordsnavi',
							  'fallback_cb' => 'false',
							  'items_wrap' => '<a href="#nav" title="Menü anzeigen">Menü <i class="fa fa-angle-down fa-1x"></i></a><a href="#" title="Menü verbergen">Menü <i class="fa fa-angle-up fa-1x"></i></a><ul id="%1$s" class="%2$s">%3$s</ul>'
						)
					);
				} else { 
					wp_nav_menu(
						array('container' => 'nav',
							'container_class' => '',
							'container_id' => 'nav',
							'theme_location' =>'hauptnavi',
							'fallback_cb' => 'false',
							'items_wrap' => '<a href="#nav" title="Menü anzeigen">Menü <i class="fa fa-angle-down fa-1x"></i></a><a href="#" title="Menü verbergen">Menü <i class="fa fa-angle-up fa-1x"></i></a><ul id="%1$s" class="%2$s">%3$s</ul>'
						)
					);
				} ?>
			
			 	<!-- Beginn header  -->
				<header class="header" <?php if (has_post_thumbnail($post->ID)) { ?>style="background: url(<?php $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');echo $thumbnail_src [0];?>) no-repeat;"<?php } ?>>
			    	<div class="header-logo">
					    <?php
					    // first check if it is adwords page, then only show parent link
					    if ( is_page_template( 'page-adwords.php' ) ) {
					    	if (!empty($tocki_redux_themeoptions["tocki_redux_header_logo"]["url"])) { ?>
					            <a href="<?php echo get_permalink( $post->post_parent ); ?>"><img src="<?php echo $tocki_redux_themeoptions["tocki_redux_header_logo"]["url"]; ?>" class="logoimg"></a>
					        <?php }
					    // then check if it has a costum url in themeoptions
						} elseif (!empty($tocki_redux_themeoptions["tocki_redux_header_url"])) {
							if (!empty($tocki_redux_themeoptions["tocki_redux_header_logo"]["url"])) { ?>
					            <a href="<?php echo $tocki_redux_themeoptions["tocki_redux_header_url"]; ?>"<?php if ($tocki_redux_themeoptions['tocki_redux_header_target'] == 1) { ?>target="_blank"<?php } ?>><img src="<?php echo $tocki_redux_themeoptions["tocki_redux_header_logo"]["url"]; ?>" class="logoimg"></a>
					        <?php }
					    // else: display the normal logo
						} else {
							if (!empty($tocki_redux_themeoptions["tocki_redux_header_logo"]["url"])) { ?>
					            <a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo $tocki_redux_themeoptions["tocki_redux_header_logo"]["url"]; ?>" class="logoimg"></a>
					        <?php } 
					    } ?>
					</div>

			    	<div class="phonebox corporate-color colorextend-header-cta">
			        	<?php dynamic_sidebar( 'header-widget-area' ); ?>
			        </div>

			        <div class="clearfix"></div>
			    </header> <!-- Ende header -->  
			    
			    <div class="clearfix"></div>
			<?php } ?>
			   	
			<!-- /////////////////////////////////////////////////////////////  MAIN CONTENT ///////////////////////////////////////////////////////////// -->
			<div class="main-middle"> <!-- main-middle / Endet im Footer  -->