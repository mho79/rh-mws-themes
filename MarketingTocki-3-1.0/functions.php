<?php
/**
 * TwentyTen functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyten_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyten_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 *
	 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
	 * functions.php file.
	 *
	 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
	 * @uses register_nav_menus() To add support for navigation menus.
	 * @uses add_editor_style() To style the visual editor.
	 * @uses load_theme_textdomain() For translation/localization support.
	 * @uses register_default_headers() To register the default custom header images provided with the theme.
	 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
	 *
	 * @since Twenty Ten 1.0
	 */
	function twentyten_setup() {
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Make theme available for translation
		// Translations can be filed in the /languages/ directory
		load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

		$locale = get_locale();
		$locale_file = TEMPLATEPATH . "/languages/$locale.php";
		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'hauptnavi' => __( 'Hauptnavigation', 'twentyten' ),
			'adwordsnavi' => __( 'AdWordsNavigation', 'twentyten' ),
		) );

		// This theme allows users to set a custom background
		add_theme_support( 'custom-background', array(
			'wp-head-callback' => 'devpress_custom_background_callback'
		) );
		
		function devpress_custom_background_callback() {
			/* Get the background image. */
			$image = get_background_image();
		
			/* If there's an image, just call the normal WordPress callback. We won't do anything here. */
			if ( !empty( $image ) ) {
				_custom_background_cb();
				return;
			}
		
			/* Get the background color. */
			$color = get_background_color();
		
			/* If no background color, return. */
			if ( empty( $color ) ) {
				return;
			}
		
			/* Use 'background' instead of 'background-color'. */
			$style = "background: #{$color};";
			echo '<style type="text/css">body { ' . trim( $style ) . ' }</style>';
		}

		// Your changeable header business starts here
		define( 'HEADER_TEXTCOLOR', '' );
		// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
		define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );

		// The height and width of your custom header. You can hook into the theme's own filters to change these values.
		// Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
		define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyten_header_image_width', 940 ) );
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyten_header_image_height', 198 ) );

		// We'll be using post thumbnails for custom header images on posts and pages.
		// We want them to be 940 pixels wide by 198 pixels tall.
		// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
		set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

		// Don't support text inside the header image.
		define( 'NO_HEADER_TEXT', true );

		// Add a way for the custom header to be styled in the admin panel that controls
		// custom headers. See twentyten_admin_header_style(), below.
		add_theme_support( 'custom-header', array(
			'admin-head-callback' =>  'twentyten_admin_header_style'
		) );

		// ... and thus ends the changeable header business.

		// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
		register_default_headers( array(
			'berries' => array(
				'url' => '%s/images/headers/starkers.png',
				'thumbnail_url' => '%s/images/headers/starkers-thumbnail.png',
				/* translators: header image description */
				'description' => __( 'Starkers', 'twentyten' )
			)
		) );
	}
endif;

if ( ! function_exists( 'twentyten_admin_header_style' ) ) :
	/**
	 * Styles the header image displayed on the Appearance > Header admin panel.
	 *
	 * Referenced via add_custom_image_header() in twentyten_setup().
	 *
	 * @since Twenty Ten 1.0
	 */
	function twentyten_admin_header_style() {
		echo '<style type="text/css">
		/* Shows the same border as on front end */
		#headimg {
			border-bottom: 1px solid #000;
			border-top: 4px solid #000;
		}
		/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
			#headimg #name { }
			#headimg #desc { }
		*/
		</style>';
	}
endif;

/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 *
 * If we have a site description and we're viewing the home page or a blog posts
 * page (when using a static front page), then we will add the site description.
 *
 * If we're viewing a search result, then we're going to recreate the title entirely.
 * We're going to add page numbers to all titles as well, to the middle of a search
 * result title and the end of all other titles.
 *
 * The site title also gets added to all titles.
 *
 * @since Twenty Ten 1.0
 *
 * @param string $title Title generated by wp_title()
 * @param string $separator The separator passed to wp_title(). Twenty Ten uses a
 * 	vertical bar, "|", as a separator in header.php.
 * @return string The new title, ready for the <title> tag.
 */
function twentyten_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() ) {
		return $title;
	}

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'twentyten' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 ) {
			$title .= " $separator " . sprintf( __( 'Page %s', 'twentyten' ), $paged );
		}
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $separator " . $site_description;
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $separator " . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
	}

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'twentyten_filter_wp_title', 10, 2 );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyten_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 **/
 
function twentyten_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'twentyten_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function twentyten_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyten_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function twentyten_auto_excerpt_more( $more ) {
	return ' &hellip;' . twentyten_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyten_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function twentyten_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyten_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyten_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since Twenty Ten 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function twentyten_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'twentyten_remove_gallery_css' );

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
			case '' : ?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<div id="comment-<?php comment_ID(); ?>">
						<div class="comment-author vcard">
							<?php echo get_avatar( $comment, 40 ); ?>
							<?php printf( __( '%s <span class="says">says:</span>', 'twentyten' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
						</div><!-- .comment-author .vcard -->

						<?php if ( $comment->comment_approved == '0' ) : ?>
							<em><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
							<br>
						<?php endif; ?>

						<div class="comment-meta commentmetadata">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
								<?php printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?>
							</a>
							<?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' ); ?>
						</div><!-- .comment-meta .commentmetadata -->

						<div class="comment-body"><?php comment_text(); ?></div>

						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div><!-- .reply -->
					</div><!-- #comment-##  -->
				</li>
				<?php break;
			case 'pingback'  :
			case 'trackback' : ?>
				<li class="post pingback">
					<p>
						<?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'twentyten'), ' ' ); ?>
					</p>
				</li>
				<?php break;
		endswitch;
	}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function twentyten_widgets_init() {
	// Widgets im Header (CTA).
	register_sidebar( array(
		'name' => __( 'Widgets Header', 'twentyten' ),
		'id' => 'header-widget-area',
		'description' => __( 'CTA im Header', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="header-widgets %2$s">',
		'after_widget' => '<div class="clearfix"></div></div>',
		'before_title' => '<h4 class="header-widgets-title">',
		'after_title' => '</h4>',
	) );

	// Widgets in der Sidebar
	register_sidebar( array(
		'name' => __( 'Widgets Sidebar', 'twentyten' ),
		'id' => 'sidebar-widget-area',
		'description' => __( 'Widgets für ', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="%2$s sidebar-box corporate-top-border">',
		'after_widget' => '<div class="clearfix"></div></div>',
		'before_title' => '<h4 class="sidebar-widget-title">',
		'after_title' => '</h4>',
	) );

	// Widgets im Footer
	register_sidebar( array(
		'name' => __( 'Footer: Widgets', 'twentyten' ),
		'id' => 'footer-widget-area',
		'description' => __( 'Falls man Widgets im Footer darstellen möchte', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="footer-widgets %2$s">',
		'after_widget' => '<div class="clearfix"></div></div>',
		'before_title' => '<h4 class="footer-widgets-title">',
		'after_title' => '</h4>',
	) );

	// Kontaktzeile im Footer
	register_sidebar( array(
		'name' => __( 'Footer: Replace Kontaktzeile', 'twentyten' ),
		'id' => 'kontaktzeile-widget-area',
		'description' => __( 'überschreibt die Zeile mit Kontaktangaben im Footer', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="kontaktzeile-widgets %2$s">',
		'after_widget' => '<div class="clearfix"></div></div>',
		'before_title' => '<h4 class="kontaktzeile-widgets-title">',
		'after_title' => '</h4>',
	) );

	// Widget im Footer
	register_sidebar( array(
		'name' => __( 'Footer: Replace Impressum', 'twentyten' ),
		'id' => 'impressum-widget-area',
		'description' => __( 'überschreibt das Impressum im Footer', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="impressum-widgets %2$s">',
		'after_widget' => '<div class="clearfix"></div></div>',
		'before_title' => '<h4 class="impressum-widgets-title">',
		'after_title' => '</h4>',
	) );

	// Widget im Footer
	register_sidebar( array(
		'name' => __( 'Footer: Replace Datenschutz', 'twentyten' ),
		'id' => 'datenschutz-widget-area',
		'description' => __( 'überschreibt das Datenschutz im Footer', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="datenschutz-widgets %2$s">',
		'after_widget' => '<div class="clearfix"></div></div>',
		'before_title' => '<h4 class="datenschutz-widgets-title">',
		'after_title' => '</h4>',
	) );
}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'twentyten_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );

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

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// Tocki Specials /////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/theme-options/tocki_redux_themeoptions.php' ) ) {
    require_once( dirname( __FILE__ ) . '/theme-options/tocki_redux_themeoptions.php' );
}

// customize admin footer text
function custom_admin_footer() {
	echo 'Webdesign & Wordpress von Tilman Ockert f&uuml;r <a href="http://regiohelden.de" target="_blank">RegioHelden</a> - E-Mail: <a href="mailto:tilman.ockert@regiohelden.de">tilman.ockert@regiohelden.de</a>';
}
add_filter('admin_footer_text', 'custom_admin_footer');


// Subseite "Anpassen ausblenden"
function adjust_the_wp_menu() {
  $page = remove_submenu_page( 'themes.php', 'theme-editor.php' );
  // $page[0] is the menu title
  // $page[1] is the minimum level or capability required
  // $page[2] is the URL to the item's file
}
add_action( 'admin_menu', 'adjust_the_wp_menu', 999 );

// zählt die Widgets im Footer
function cosmos_bottom_sidebar_params($params) {
    $sidebar_id = $params[0]['id'];
    if ( $sidebar_id == 'footer-widget-area' ) {
        $total_widgets = wp_get_sidebars_widgets();
        $sidebar_widgets = count($total_widgets[$sidebar_id]);
        $params[0]['before_widget'] = str_replace('class="', 'class="span' . floor(12 / $sidebar_widgets) . ' ', $params[0]['before_widget']);
    }
    return $params;
}
add_filter('dynamic_sidebar_params','cosmos_bottom_sidebar_params');

// Shortcode für die Telefonnummer
function ProxyNumberShortcode() {
	if (is_mobile()) {
		return '<a class="tocki-proxy-number" href="tel:{regiohelden.proxy.number}">{regiohelden.proxy.number}</a>';
	} else {
		return '{regiohelden.proxy.number}';
	}
}
add_shortcode('ProxyNumber', 'ProxyNumberShortcode');

// Shortcode auch in Widgets aktivieren
add_filter('widget_text', 'do_shortcode');

/**
 * create widget from visual composer plugin
 * @param  array  $conf   widget configuration
 * @return string $output widget html
 */
function createWidget($conf) {
    global $wp_widget_factory;

    if(empty($conf['widget_name'])) {
    	return;
    }

    $widget_name = $conf['widget_name'];

    if (!is_a($wp_widget_factory->widgets[$widget_name], 'WP_Widget')):
        $wp_class = 'WP_Widget_' . ucwords(strtolower($class));
        
        if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
            return;
        else:
            $class = $wp_class;
        endif;
    endif;
    
    ob_start();
    the_widget(
    	$widget_name, 
    	$conf, 
    	array(
    		'widget_id' => 'vc-widget-instance-' . uniqid(),
	        'before_widget' => '<div class="' . $widget_name . '">',
	        'after_widget' => '</div>',
	        'before_title' => '<h2>',
	        'after_title' => '</h2>'
	    )
	);

    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

/**
 * shortcode visual composer integration for contact widget
 * @param  array $atts
 * @return string widget html
 */
function form_widget($atts) {
	$atts['widget_name'] = 'mod_form_widget';

	return createWidget($atts);
}
add_shortcode('form_widget', 'form_widget'); 

/**
 * integrate mod form widget in visual composer
 */
function mod_form_integrateWithVC() {
   	vc_map(array(
      	"name" => "ModForm Kontaktformular",
      	"base" => "form_widget",
      	"class" => "",
      	"category" => __( 'Content', 'js_composer' ),
      	"description" => "Fügt ein Kontaktformular Widget in den Contentbereich ein",
      	"icon" => "vc_general vc_element-icon icon-wpb-atm",
      	"params" => array(
         	array(
            	"type" => "textfield",
            	"holder" => "div",
            	"class" => "",
            	"heading" => __( "Titel", "vc-extend" ),
            	"param_name" => "mod_form_title",
	        ),
	        array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Name", "vc-extend" ),
	            "param_name" => "mod_form_name",
	        ),
	        array(
	            "type" => "dropdown",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Name als Pflichtfeld", "vc-extend" ),
	            "param_name" => "mod_form_name_req",
	            "value" => array("","Ja")
	        ),
	        array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "E-Mail", "vc-extend" ),
	            "param_name" => "mod_form_mail",
	        ),
	        array(
	            "type" => "dropdown",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "E-Mail als Pflichtfeld", "vc-extend" ),
	            "param_name" => "mod_form_mail_req",
	            "value" => array("","Ja")
	        ),
	        array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Telefon", "vc-extend" ),
	            "param_name" => "mod_form_fon",
	        ),
	        array(
	            "type" => "dropdown",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Telefon als Pflichtfeld", "vc-extend" ),
	            "param_name" => "mod_form_fon_req",
	            "value" => array("","Ja")
	        ),
	        array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Nachricht", "vc-extend" ),
	            "param_name" => "mod_form_message",
	        ),
	        array(
	            "type" => "dropdown",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Nachricht als Pflichtfeld", "vc-extend" ),
	            "param_name" => "mod_form_message_req",
	            "value" => array("","Ja")
	        ),
	        array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Button Text", "vc-extend" ),
	            "param_name" => "mod_form_cta",
	        ),
      	)
   ));
}
add_action('vc_before_init', 'mod_form_integrateWithVC');

/**
 * shortcode visual composer integration for maps widget
 * @param  array $atts
 * @return string widget html
 */
function map_widget($atts) {
	$atts['widget_name'] = 'widget_tocki_sidebar_map';

	if(!empty($atts['tocki-sidebar-map-marker'])) {
		$id = $atts['tocki-sidebar-map-marker'];
		$atts['tocki-sidebar-map-marker'] = wp_get_attachment_url($id);
	}

	return createWidget($atts);
}
add_shortcode('map_widget', 'map_widget'); 

/**
 * integrate mod form widget in visual composer
 */
function maps_integrateWithVC() {
   	vc_map(array(
      	"name" => "Google Map",
      	"base" => "map_widget",
      	"class" => "",
      	"category" => __( 'Content', 'js_composer' ),
      	"description" => "Fügt eine Google Ma im Content ein",
      	"icon" => "vc_general vc_element-icon icon-wpb-map-pin",
      	"params" => array(
	        array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Überschrift", "vc-extend" ),
	            "param_name" => "tocki-sidebar-map-title",
	            "value" => "Hier finden Sie uns"
	        ),
	        array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Firma", "vc-extend" ),
	            "param_name" => "tocki-sidebar-map-firma",
	        ),
	        array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Strasse", "vc-extend" ),
	            "param_name" => "tocki-sidebar-map-strasse",
	            "value" => "{customer.street}"
	        ),
	        array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "PLZ", "vc-extend" ),
	            "param_name" => "tocki-sidebar-map-plz",
	            "value" => "{customer.zipcode}"
	        ),
	        array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Ort", "vc-extend" ),
	            "param_name" => "tocki-sidebar-map-ort",
	            "value" => "{customer.city}"
	        ),
	        array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Koordinaten (lat lng Kommagetrennt)", "vc-extend" ),
	            "param_name" => "tocki-sidebar-map-coord",
	        ),
	        array(
	            "type" => "colorpicker",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Farbe", "vc-extend" ),
	            "param_name" => "tocki-sidebar-map-color",
	        ),
	        array(
	            "type" => "attach_image",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Marker-Icon", "vc-extend" ),
	            "param_name" => "tocki-sidebar-map-marker",
	        ),
	        array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Zoom", "vc-extend" ),
	            "param_name" => "tocki-sidebar-map-zoom",
	            "value" => 11
	        ),
      	)
   ));
}
add_action('vc_before_init', 'maps_integrateWithVC');