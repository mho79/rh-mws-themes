<?php
/**
 * MWS 2016 functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package MWS_2016
 */

/**
 * add redux config
 */
if ( file_exists( dirname( __FILE__ ) . '/theme-options/mws_themeoptions.php' ) ) {
 	require_once( dirname( __FILE__ ) . '/theme-options/mws_themeoptions.php' );
}

/**
 * menu walker for creating bootstrap menus
 */
if ( file_exists( dirname( __FILE__ ) . '/_inc/wp_bootstrap_navwalker.php' ) ) {
 	require_once( dirname( __FILE__ ) . '/_inc/wp_bootstrap_navwalker.php' );
}

if ( ! function_exists( 'rh_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function rh_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on RH MWS 2015, use a find and replace
	 * to change 'rh' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'rh', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'main' => __( 'Hauptmenü', 'rh' ),
		'adwords' => __( 'AdWords Menü', 'rh' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );
}
endif; // rh_setup
add_action( 'after_setup_theme', 'rh_setup' );

/**
 * remove theme editor from menu
 */
function remove_theme_edit() {
	remove_submenu_page( 'themes.php', 'theme-editor.php' );
}
add_action( 'admin_menu', 'remove_theme_edit', 999 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rh_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Main', 'rh' ),
		'id'            => 'sidebar-main',
		'description'   => 'Sidebar auf der rechten Seite',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Footer', 'rh' ),
		'id'            => 'sidebar-footer',
		'description'   => 'Sidebar im Footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'rh_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function rh_scripts() {
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Open+Sans+Condensed:300,700|Libre+Baskerville:400,700|Cutive+Mono' );
	wp_enqueue_style( 'bootstrap', esc_url( get_stylesheet_directory_uri() ) . '/css/vendor/bootstrap/bootstrap.min.css' );
	wp_enqueue_style( 'rh-style', get_stylesheet_uri() );
	wp_enqueue_style( 'dynamic', admin_url('admin-ajax.php').'?action=dynamic_css' );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap', esc_url( get_stylesheet_directory_uri() ) . '/js/vendor/bootstrap/bootstrap.min.js', array(), false, true );
	wp_enqueue_script( 'parallax', esc_url( get_stylesheet_directory_uri() ) . '/js/vendor/parallax.min.js', array(), false, true );
	wp_enqueue_script( 'rh-script', esc_url( get_stylesheet_directory_uri() ) . '/js/mws.js', array('bootstrap'), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'rh_scripts' );

/**
 * get dynamically generated css file
 */
function dynamic_css() {
	require( get_template_directory() . '/css/dynamic.php.css' );
	
	return;
}
add_action('wp_ajax_dynamic_css', 'dynamic_css');
add_action('wp_ajax_nopriv_dynamic_css', 'dynamic_css');

function rh_the_posts_navigation() {
	$navigation = '';
 
    // Don't print empty markup if there's only one page.
    if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
        $args = wp_parse_args( $args, array(
            'prev_text'          => __( 'Older posts' ),
            'next_text'          => __( 'Newer posts' ),
        ) );
 
        $next_link = get_previous_posts_link( $args['next_text'] );
        $prev_link = get_next_posts_link( $args['prev_text'] );

        if ( $prev_link ) {
            $navigation .= '<div class="nav-previous">' . $prev_link . '</div>';
        }
 
        if ( $next_link ) {
            $navigation .= '<div class="nav-next">' . $next_link . '</div>';
        }

 		$class = 'posts-navigation';

        $template = '
			<nav class="navigation %1$s" role="navigation">
				<div class="nav-links">%2$s</div>
			</nav>
		';

		$navigation = sprintf( $template, sanitize_html_class( $class ), $navigation );
    }
 
    echo $navigation;
}
add_action('the_posts_navigation', 'rh_the_posts_navigation');

function bootstrap3_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    
    $req      = get_option( 'require_name_email' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;

    $fields   =  array(
        'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . ( $req ? ' required' : '' ) . '></div>',
        'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" required></div>',
        'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
                    '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '"></div>'        
    );
    
    return $fields;
}
add_filter( 'comment_form_default_fields', 'bootstrap3_comment_form_fields' );

function bootstrap3_comment_form( $args ) {
    $args['comment_field'] = '
    	<div class="form-group comment-form-comment">
            <label for="comment">' . _x( 'Kommentar', 'rh' ) . '</label> 
            <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" required></textarea>
        </div>';

    $args['class_submit'] = 'btn btn-primary'; // since WP 4.1
    
    return $args;
}
add_filter( 'comment_form_defaults', 'bootstrap3_comment_form' );

/**
 * proxy number shortcode
 */
function proxy_number_shortcode() {
	if ( function_exists('is_mobile') && is_mobile() ) {
		return '<a class="proxy-number" href="tel:{regiohelden.proxy.number}">{regiohelden.proxy.number}</a>';
	} else {
		return '{regiohelden.proxy.number}';
	}
}
add_shortcode('ProxyNumber', 'proxy_number_shortcode');

/**
 * allow shortcodes in widgets
 */
add_filter('widget_text', 'do_shortcode');