<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<?php global $tocki_redux_themeoptions; ?>
		<meta charset="<?php bloginfo('charset'); ?>">

		<title><?php the_title(); ?> | <?php if (!empty($tocki_redux_themeoptions["tocki_redux_title"])) { echo $tocki_redux_themeoptions["tocki_redux_title"]; } ?></title>

		<link rel="shortcut icon" href="<?php if (!empty($tocki_redux_themeoptions["tocki_redux_favicon"])) { echo $tocki_redux_themeoptions["tocki_redux_favicon"]["url"]; } ?>">
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>"> <!-- allgemeines CSS -->
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/font-awesome-4.4.0/css/font-awesome.min.css"> <!-- font awesome 4.1.0 -->
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/jquery.mmenu.all.css"> 
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<?php if ($tocki_redux_themeoptions['tocki_redux_mobile_iphone_numbers_klickable'] == 1) { ?>
			<!-- Telefon-Nr. auf iOS werden als Links anzeigen -->
		<?php } else { ?>
			<meta name="format-detection" content="telephone=no"> <!-- Telefon-Nr. auf iOS NICHT als Links anzeigen -->
		<?php } ?>

		<?php if ($tocki_redux_themeoptions['tocki_redux_seo_switcher'] == 1) { ?>
			<!-- Suchmaschinen zulassen -->
		<?php } else { ?>
			<meta name="robots" content="noindex,follow"><!-- Suchmaschinen ausschliessen -->
		<?php } ?>

		<?php wp_head(); ?>

		<style>
			<?php if (!empty($tocki_redux_themeoptions["tocki_redux_header_logo"])) { ?>  
				.site-title {
					background-image: url("<?php echo $tocki_redux_themeoptions["tocki_redux_header_logo"]["url"]; ?>");
				}
			<?php } ?>


			<?php if (!empty($tocki_redux_themeoptions["tocki_redux_header_logo_width"])) { ?>
				.site-title {
					width: <?php echo $tocki_redux_themeoptions["tocki_redux_header_logo_width"]; ?>;
				}
			<?php } ?>


			<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_menu_bg"])) { ?>
				.site-header, .bumper {
					background-color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_bg"]; ?>;
				}
			<?php } ?>

			<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_menu_normal"])) { ?>
				.nav ul li a, .nav ul .sub-menu, .nav ul .sub-menu a {
					background-color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_normal"]; ?>;
				}
			<?php } ?>

			<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_menu_active"])) { ?>
				.nav ul .current-menu-item > a, .nav ul .sub-menu .current-menu-item > a, .nav ul li a:hover, .nav ul .current-menu-item > a, .nav ul .sub-menu a:hover {
					background-color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_active"]; ?>;
				}
			<?php } ?>

			<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_menu_height_normal"])) { ?>
				.site-header {
		  			height: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_height_normal"]; ?>;
		  		}
			<?php } ?>

			<?php if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_menu_height_small"])) { ?>
				@media only screen and (min-width: 1023px) {
					.shrink .site-header, .shrink .title-area  {
			  			height: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_menu_height_small"]; ?>;
			  		}
				}
			<?php } ?>

			@media only screen and (max-width: 1023px) {
			  	.site-header {
			    	height: auto;
			  	}
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
				echo $tocki_redux_themeoptions["tocki_redux_code_badge_css"];
			} else {

			} ?>
			
			.corporate-color {
				color: <?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; } ?>;
			}

			form.kontaktformular input[type=submit],
			.tocki-sidebar-button {
				background-color: <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; } ?>;
			}

			form.kontaktformular input,
			form.kontaktformular textarea,
			form.kontaktformular select {
				border: 1px solid <?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; } ?>;
			}
				
			form.kontaktformular input[type=submit],
			.tocki-sidebar-button {	
				background: <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; } ?> ;
			}

			<?php 
			if ($tocki_redux_themeoptions['tocki_redux_colorextend'] == 1) {
				if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_header_cta"])) { ?>
					.colorextend-header-cta { color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_header_cta"]; ?>;}
				<?php }
				if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_bullets"])) { ?>
					.content .leistungen ul li{ color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_bullets"]; ?>;}
				<?php }
				if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_form_border"])) { ?>
					form.kontaktformular input, form.kontaktformular textarea, form.kontaktformular select{border: 1px solid <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_form_border"]; ?>;}
				<?php }
				if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_form_submit"])) { ?>
					form.kontaktformular input[type=submit]{background: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_form_submit"]; ?>;}
				<?php }
				if (!empty($tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"])) { ?>
					.content-phonebox{
						border-style: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"]["border-style"]; ?>; 
						border-color: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"]["border-color"]; ?>;
						border-top-width: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"]["border-top"]; ?>;
						border-right-width: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"]["border-right"]; ?>;
						border-bottom-width: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"]["border-bottom"]; ?>;
						border-left-width: <?php echo $tocki_redux_themeoptions["tocki_redux_colorextend_cta_borders"]["border-left"]; ?>;
					}
				<?php }
			} ?>

			a.tocki-sidebar-button { color: #fff; }
			a.awesome, a.awesome:visited { background-color: <?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; } ?>; color: #fff; }
			a.awesome:hover { background-color: <?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; } ?>; color: #fff; }

			<?php if (!empty($tocki_redux_themeoptions["tocki_redux_code_css"])) { 
				echo $tocki_redux_themeoptions["tocki_redux_code_css"];
			}
			if (!empty($tocki_redux_themeoptions["tocki_redux_code_css_715"])) {
				echo $tocki_redux_themeoptions["tocki_redux_code_css_715"];
			}
			if (!empty($tocki_redux_themeoptions["tocki_redux_code_css_500"])) {
				echo $tocki_redux_themeoptions["tocki_redux_code_css_500"];
			} ?>

			.content-phonebox{
				border-style: solid;
				border-color: <?php  if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; } ?>;
				border-top-width: 5px;
				border-right-width: 5px;
				border-bottom-width: 5px;
				border-left-width: 5px;
			}

			.sidebar > div {
				border-color: <?php if (!empty($tocki_redux_themeoptions["tocki_redux_corporate_color"])) { ?><?php echo $tocki_redux_themeoptions["tocki_redux_corporate_color"]; } ?>;
				border-top-width: 1px;
				border-style: dotted;
				border-right-width: 0px;
				border-bottom-width: 0px;
				border-left-width: 0px;
				padding-bottom: 25px;
			}

			.sidebar > div:first-child {
				border-top-width: 0;
			}

			.sidebar > div:last-child {
				padding-bottom: 0;
			}

			.sidebar .widget_tocki_sidebar_map {
				padding-top: 40px;
			}
		</style>

		<?php if (!empty($tocki_redux_themeoptions["tocki_redux_code_header"])) { 
			echo $tocki_redux_themeoptions["tocki_redux_code_header"];
		} ?>
	</head>

	<body <?php body_class(); ?>>
		<!-- wrapper -->
		<div class="wrapper first">
			<?php if (!empty($tocki_redux_themeoptions["tocki_redux_codeextend"])) {
				echo $tocki_redux_themeoptions["tocki_redux_code_badge_html"]; 
			} else { 

		    } ?>
    
			<?php if ( is_page_template( 'page-blank.php' ) ) {
				// kein Menu auf der blank-page
			} else { ?>
				<!-- header -->
				<header class="mobile-header fixed">
					<a href="#mmenu"><i class="fa fa-bars fa-2x"></i><i class="fa fa-angle-left fa-2x"></i></a>
				</header>

				<header class="site-header fixed" role="banner">
		            <div class="wrapper">
		                <div class="title-area">
		                    <p class="site-title">
		                    	<?php if ( is_page_template( 'page-adwords.php' ) ) { ?>
									<a href="<?php echo get_permalink( $post->post_parent ); ?>">
										<?php bloginfo('name'); ?>
									</a>
								<?php // then check if it has a costum url in themeoptions
								} elseif (!empty($tocki_redux_themeoptions["tocki_redux_header_url"])) { ?>
									<a href="<?php echo $tocki_redux_themeoptions["tocki_redux_header_url"]; ?>">
									 	<?php bloginfo('name'); ?>
									</a>
								<?php } else {; ?>
									<a href="<?php echo home_url(); ?>" title="Startseite | <?php bloginfo('name'); ?>">
										<?php bloginfo('name'); ?>
									</a>
								<?php } ?>
							</p>

		                    <p class="logo-tel">
	               				Tel: <span>{regiohelden.proxy.number}</span>
		                    </p>
		                </div>

		                <aside>
		                    <section class="widget widget_nav_menu">
		                        <div class="widget-wrapper">
		                            <nav class="nav" role="navigation">
										<?php 
										if (( $tocki_redux_themeoptions['tocki_redux_child_menues'] == 1)) {
											if($post->post_parent) {
											  	$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
											  	$titlenamer = get_the_title($post->post_parent);
											} else {
											  	$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
											  	$titlenamer = get_the_title($post->ID);
											}
											
											if ($children) { ?>
												<ul id="menu-hauptnavi" class="menu">
													<?php 
													if(!function_exists('get_post_top_ancestor_id')) {
														function get_post_top_ancestor_id() {
														    global $post;
														    
														    if($post->post_parent){
														        $ancestors = array_reverse(get_post_ancestors($post->ID));
														        return $ancestors[0];
														    }
														    
														    return $post->ID;
														}
													}

													wp_list_pages( array('title_li' => '', 'include' => get_post_top_ancestor_id()) );
													echo $children; ?>
												</ul>
											<?php }
										} elseif ( is_page_template( 'page-adwords.php' ) ) {
											adwords_mws_nav();
										} else { 
											mws_nav();
										} ?>
									</nav>
		                        </div>
		                    </section>
		                </aside>
		            </div>
		        </header>

		        <div class="bumper"></div>
			<?php } ?>