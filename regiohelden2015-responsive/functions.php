<?php
if ( ! function_exists( 'twentyten_posted_in' ) ) :
	/**
	 * Prints HTML with meta information for the current post (category, tags and permalink).
	 *
	 * @since Twenty Ten 1.0
	 */
	function twentyten_posted_in() {
		// Retrieves tag list of current post, separated by commas.
		$tag_list = get_the_tag_list( '', ', ' );
		if ( $tag_list ) {
			$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
		} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
			$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
		} else {
			$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
		}
		// Prints the string, replacing the placeholders.
		printf(
			$posted_in,
			get_the_category_list( ', ' ),
			$tag_list,
			get_permalink(),
			the_title_attribute( 'echo=0' )
		);
	}
endif;

if ( ! function_exists( 'twentyten_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post—date/time and author.
	 *
	 * @since Twenty Ten 1.0
	 */
	function twentyten_posted_on() {
		printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
			'meta-prep meta-prep-author',
			sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
				get_permalink(),
				esc_attr( get_the_time() ),
				get_the_date()
			),
			sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
				get_author_posts_url( get_the_author_meta( 'ID' ) ),
				sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
				get_the_author()
			)
		);
	}
endif;

if ( ! function_exists( 'twentyten_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * To override this walker in a child theme without modifying the comments template
	 * simply create your own twentyten_comment(), and that function will be used instead.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Twenty Ten 1.0
	 */
	function twentyten_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 40 ); ?>
				<?php printf( __( '%s <span class="says">says:</span>', 'twentyten' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</div><!-- .comment-author .vcard -->
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' );
				?>
			</div><!-- .comment-meta .commentmetadata -->

			<div class="comment-body"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div><!-- #comment-##  -->

		<?php
				break;
			case 'pingback'  :
			case 'trackback' :
		?>
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'twentyten'), ' ' ); ?></p>
		<?php
				break;
		endswitch;
	}
endif;

// ------- DEREGISTER

function deregister() {
	wp_deregister_script('jquery');
}

// ------- REGISTER

function register_scripts() {
	wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', false, '1.8.3');
	wp_register_script('mmenu', get_template_directory_uri() . '/js/jquery.mmenu.min.all.js', array('jquery'), '4.7.5');
	wp_register_script('fixedelements', get_template_directory_uri() . '/js/jquery.mmenu.fixedelements.min.js', array('mmenu'), '1.0');
	wp_register_script('maps-api', 'http://maps.googleapis.com/maps/api/js?sensor=false', array('jquery'), '3.0');
	wp_register_script('regiohelden-js', get_template_directory_uri() . '/js/regiohelden.js', array('jquery', 'mmenu', 'maps-api'), '1.0');
	wp_register_script('fancybox', get_template_directory_uri() . '/js/jquery.fancybox.js', array('jquery'), '2.1.5');
	// wp_register_script('parsley', get_template_directory_uri() . '/js/parsley.js', array('jquery', 'mmenu', 'maps-api'), '1.2.1');
	// wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), '2.8.3');
}

function register_styles() {
	wp_register_style( 'mmenu-style', get_template_directory_uri() . '/css/jquery.mmenu.all.css', '', '' );
	wp_register_style( 'theme-style', get_template_directory_uri() . '/style.css', array('mmenu-style'), '' );
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array('mmenu-style'), '' );
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array('theme-style'), '' );
}

// ------- ENQUEUE

function enqueue_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'mmenu');
	wp_enqueue_script( 'fixedelements');
	wp_enqueue_script( 'maps-api');
	wp_enqueue_script( 'regiohelden-js');
	wp_enqueue_script( 'fancybox');
	// wp_enqueue_style( 'parsley' );
	// wp_enqueue_script( 'modernizr');
	wp_enqueue_style( 'mmenu-style' );
}

function enqueue_styles() {
	//wp_enqueue_style( 'fancy-css' );
	wp_enqueue_style( 'theme-style' );
	wp_enqueue_style( 'font-awesome' );
}


add_action('init', 'deregister');

add_action('init', 'register_scripts');
add_action('wp_enqueue_scripts', 'register_styles');

add_action('init', 'enqueue_scripts');
add_action('wp_enqueue_scripts', 'enqueue_styles');


// ------- NAVS 

register_nav_menus( array(
	'hauptnavi' => __( 'Hauptnavigation', 'twentyten' ),
	'mobile-hauptnavi' => __( 'mobile Hauptnavigation', 'twentyten' ),
	'footer' => __( 'Footer navigation', 'twentyten' ),
) );

// ------- WIDGETS

function widgets_init() {
	// Area 1, Links vom Inhalt.
	register_sidebar( array(
		'name' => __( 'Karriere Sidebar', 'twentyten' ),
		'id' => 'karriere-widget-area',
		'description' => __( 'wird nur auf Seiten mit dem Template für Karriere angezeigt', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	// Area 1.2, Links vom Inhalt.
	register_sidebar( array(
		'name' => __( 'Presse Sidebar', 'twentyten' ),
		'id' => 'presse-widget-area',
		'description' => __( 'wird nur auf Seiten mit dem Template für Presse angezeigt', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	// Area 1.3, Links vom Inhalt.
	register_sidebar( array(
		'name' => __( 'Sidebar Lernzentrale', 'twentyten' ),
		'id' => 'lernzentrale-widget-area',
		'description' => __( 'wird nur auf Seiten mit dem Template für Lernzentrale angezeigt', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	// Area 2, im Footer.
	register_sidebar( array(
		'name' => __( 'Footer Widget', 'twentyten' ),
		'id' => 'footer-widget-area',
		'description' => __( 'Footer ganze Breite', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Area 3, Links vom Inhalt.
	register_sidebar( array(
		'name' => __( 'Produkte Sidebar', 'twentyten' ),
		'id' => 'produkt-widget-area',
		'description' => __( 'wird nur auf Seiten mit dem Template für Produkte angezeigt', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	// Startseite.
	register_sidebar( array(
		'name' => __( 'Startseite Widget', 'twentyten' ),
		'id' => 'start-widget-area',
		'description' => __( 'für das Laura Tool auf der Startseite', 'twentyten' ),
		'before_widget' => '<div class="laura-tool">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
}

add_action( 'widgets_init', 'widgets_init' );

// ------- MISC

function custom_admin_footer() {
	echo 'RegioHelden Responsive von <a href="#" target="_blank">Laura</a> & <a href="http://hipp.design" target="_blank">Dennis</a> <3';
}

function rh_wp_title( $title, $separator ) {
	if ( is_feed() )
		return $title;
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'twentyten' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'twentyten' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}

// ------- SALESFORCE SHORTCODES

function SalesforceShortcode_lang() {
	return '<div class="salesforce-form">
			<form action="https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST" parsley-validate novalidate parsley-focus="first">
				<input type=hidden name="oid" value="00D20000000KnRL">
				<input type=hidden name="retURL" value="http://www.regiohelden.de/start/dankeschoen/">
	
				<div class="sf-input"><label for="last_name">Name *</label><input  id="last_name" name="last_name" type="text" required /></div>
				<div class="sf-input"><label for="company">Firma</label><input  id="company" name="company" type="text" /></div>
				<div class="sf-input"><label for="00N20000003iFuE">Telefon *</label><input  id="00N20000003iFuE" name="00N20000003iFuE" type="text" required parsley-trigger="change" parsley-minlength="4" /></div>
				<div class="sf-input"><label for="email">E-Mail</label><input  id="email" name="email" type="text" /></div>
				<div class="sf-input"><label for="zip">PLZ</label><input  id="zip" name="zip" type="text" data-parsley-type="number" /></div>
				<div class="sf-input"><label for="city">Stadt</label><input  id="city"name="city" type="text" /></div>
				<div class="sf-input"><label for="URL">Website</label><input  id="URL" name="URL" type="text" /></div>
				<div class="sf-input sf-textfeld"><label for="description">Nachricht</label><input  id="description" name="description" type="text" /></div>
				<input type="hidden" name="lead_source" value="RegioHelden.de - Kontaktseite">     
				<input type="hidden" id="phone" maxlength="40" name="phone" size="20" type="text" value="ka" />   
				<input type="hidden" id="state" maxlength="40" name="state" size="20" type="text" value="UN" /> 
				<input type="hidden" id="country" maxlength="40" name="country" size="20" type="text" value="Deutschland" /> 
				
				<div class="clearfix"></div>
				
				<div class="sf-input sf-submit"><input type="submit" name="submit" value="Kostenlos beraten lassen!"></div>
			</form>
			<div class="clearfix"></div>
			</div>';
}
add_shortcode('Salesforce lang', 'SalesforceShortcode_lang');


function SalesforceShortcode_Partner() {
	return '<form action="https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST" parsley-validate novalidate parsley-focus="first">
<input type=hidden name="oid" value="00D20000000KnRL">
<input type=hidden name="retURL" value="http://www.regiohelden.de/start/dankeschoen/">

<div class="sf-input"><label for="last_name">Name *</label><input  id="last_name" name="last_name" type="text" required /></div>
<div class="sf-input"><label for="company">Firma</label><input  id="company" name="company" type="text" /></div>
<div class="sf-input"><label for="00N20000003iFuE">Telefon *</label><input  id="00N20000003iFuE" name="00N20000003iFuE" type="text" required parsley-trigger="change" parsley-minlength="4" /></div>
<div class="sf-input"><label for="email">E-Mail</label><input  id="email" name="email" type="text" /></div>

<div class="sf-input"><label for="URL">Website</label><input  id="URL" name="URL" type="text" /></div>

<div class="sf-input sf-textfeld"><label for="description[anzahlmitarbeiter]">Anzahl Mitarbeiter</label>
<select name="description[anzahlmitarbeiter]" id="descriptionanzahlmitarbeiter">
<option value="0">0 / Freelancer</option>
<option value="1-10">1-10</option>
<option value="10-50">10-50</option>
<option value="50-100">50-100</option>
<option value="100+">100+</option>
</select></div>

<div class="sf-input sf-textfeld"><label for="description[anzahlkunden]">Anzahl Kunden</label>
<select id="descriptionanzahlkunden" name="description[anzahlkunden]">
<option value="1-10">1-10</option>
<option value="10-50">10-50</option>
<option value="50-100">50-100</option>
<option value="100-500">100-500</option>
<option value="500-1.000">500-1.000</option>
<option value="1.000-5.000">1.000-5.000</option>
<option value="5.000+">5.000+</option>
</select></div>

<div class="sf-input sf-textfeld"><label for="description[nachricht]">Nachricht</label><input  id="descriptionnachricht" name="description[nachricht]" type="text" /></div>

<input type="hidden" name="lead_source" value="RegioHelden.de - Partnerprogramm">     
<input type="hidden" id="phone" maxlength="40" name="phone" size="20" type="text" value="ka" />   
<input type="hidden" id="state" maxlength="40" name="state" size="20" type="text" value="UN" /> 
<input type="hidden" id="country" maxlength="40" name="country" size="20" type="text" value="Deutschland" /> 

<div class="clearfix"></div>

<div class="sf-input sf-submit"><input type="submit" name="submit" value="Absenden" class="sendbutton"></div>
</form>';
}
add_shortcode('Salesforce Partner', 'SalesforceShortcode_partner');


function SalesforceShortcode_kurz() {
	return '<div class="salesforce-form">
			<form action="https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST" parsley-validate novalidate parsley-focus="first">
				<input type=hidden name="oid" value="00D20000000KnRL">
				<input type=hidden name="retURL" value="http://www.regiohelden.de/start/dankeschoen/">
	
				<div class="sf-input"><label for="last_name">Name *</label><input  id="last_name" name="last_name" type="text" required /></div>
				<div class="sf-input"><label for="00N20000003iFuE">Telefon *</label><input  id="00N20000003iFuE" name="00N20000003iFuE" type="text" required parsley-trigger="change" parsley-minlength="4" /></div>
				<div class="sf-input"><label for="email">E-Mail</label><input  id="email" name="email" type="text" /></div>
				<input type="hidden" name="lead_source" value="RegioHelden.de - '.$_SERVER['REQUEST_URI'].'">  
				<input type="hidden" id="phone" maxlength="40" name="phone" size="20" type="text" value="ka" />   
				<input type="hidden" id="state" maxlength="40" name="state" size="20" type="text" value="UN" /> 
				<input type="hidden" id="country" maxlength="40" name="country" size="20" type="text" value="Deutschland" /> 
				
				<div class="clearfix"></div>
				
				<div class="sf-input sf-submit"><input type="submit" name="submit" value="Kostenlos beraten lassen!"></div>
			</form>
			<div class="clearfix"></div>
			</div>';
}
add_shortcode('Salesforce kurz', 'SalesforceShortcode_kurz');


function SalesforceShortcode_komplett() {
	return '<div class="salesforce-form-komplett">
				<div class="start-widget-ergebnis-phone">
					<h3>Telefonische Beratung:</h3>
					<table width="100%" border="0" style="margin-bottom: 25px;">
					  <tr>
						<td class="stadtname">Stuttgart</td>
						<td>0711 &ndash; 205 287 24</td>
					  </tr>
					  <tr>
						<td class="stadtname">Berlin</td>
						<td>030 &ndash; 965 358 81</td>
					  </tr>
					  <tr>
						<td class="stadtname">Hamburg</td>
						<td>040 &ndash; 637 974 81</td>
					  </tr>
					  <tr>
						<td class="stadtname">München</td>
						<td>089 &ndash; 217 660 61</td>
					  </tr>
					  <tr>
						<td class="stadtname">Köln</td>
						<td>0221 &ndash; 968 879 47</td>
					  </tr>
					</table>
	
				</div>
				
				<div class="start-widget-ergebnis-mail salesforce-form">
					<h3>...oder Infos anfordern:</h3>
					<form action="https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST" parsley-validate novalidate parsley-focus="first">
						<input type=hidden name="oid" value="00D20000000KnRL">
						<input type=hidden name="retURL" value="http://www.regiohelden.de/start/dankeschoen/">

						<div class="sf-input"><label for="last_name">Name *</label><input  id="last_name" name="last_name" type="text" required /></div>
						<div class="sf-input"><label for="00N20000003iFuE">Telefon *</label><input  id="00N20000003iFuE" name="00N20000003iFuE" type="text" required parsley-trigger="change" parsley-minlength="4" /></div>
						<div class="sf-input"><label for="email">E-Mail</label><input  id="email" name="email" type="text" /></div>
						<input type="hidden" name="lead_source" value="RegioHelden.de - '.$_SERVER['REQUEST_URI'].'">  
						<input type="hidden" id="phone" maxlength="40" name="phone" size="20" type="text" value="ka" /> 
						<input type="hidden" id="state" maxlength="40" name="state" size="20" type="text" value="UN" /> 
						<input type="hidden" id="country" maxlength="40" name="country" size="20" type="text" value="Deutschland" /> 
						
						<div class="clearfix"></div>
						
						<div class="sf-input sf-submit"><input type="submit" name="submit" value="Kostenlos beraten lassen!"></div>
					</form>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>';
}
add_shortcode('Salesforce komplett', 'SalesforceShortcode_komplett');

add_filter('admin_footer_text', 'custom_admin_footer');
add_filter( 'wp_title', 'rh_wp_title', 10, 2 );

