<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));
	
    // Add Support for Custom Header - Uncomment below if you're going to use
    add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/


// navigation
function mws_nav()
{
	wp_nav_menu(
        array( 
            'container' => 'nav', 
            'container_class' => '', 
            'container_id' => 'nav', 
            'theme_location' => 'hauptnavi', 
            'fallback_cb' => 'false', 
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>' 
            )
	);
}

function mws_mobile_nav()
{
    wp_nav_menu(
        array( 
            'container' => 'nav', 
            'container_class' => '', 
            'container_id' => 'mobile-nav', 
            'theme_location' => 'hauptnavi', 
            'fallback_cb' => 'false', 
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>' 
            )
    );
}

function adwords_mws_nav()
{
    wp_nav_menu(
        array( 
            'container' => 'nav', 
            'container_class' => '', 
            'container_id' => 'nav', 
            'theme_location' => 'adwordsnavi', 
            'fallback_cb' => 'false', 
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>' 
            )
    );
}

function adwords_mws_mobile_nav()
{
    wp_nav_menu(
        array( 
            'container' => 'nav', 
            'container_class' => '', 
            'container_id' => 'mobile-nav', 
            'theme_location' => 'adwordsnavi', 
            'fallback_cb' => 'false', 
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>' 
            )
    );
}

add_action('wp_enqueue_scripts', 'no_more_jquery');

function no_more_jquery(){
    wp_deregister_script('jquery');
    wp_register_script('jquery', "http" . 
    ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . 
    "://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js", false, null);
    wp_enqueue_script('jquery');
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

    	wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        
    }
} 

// Load HTML5 Blank styles
 function html5blank_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('html5blank'); // Enqueue it!


}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'hauptnavi' => __('Header Menu', 'html5blank'), // Main Navigation
        'adwordsnavi' => __('AdWords Navigation', 'html5blank'), // AdWords Navigation
    ));
}



// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}



// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{


    // Define Sidebar Widget Area 
    register_sidebar(array(
        'name' => __('Footer Widgets', 'html5blank'),
        'description' => __('Footer Widgets', 'html5blank'),
        'id' => 'footer-widget-area',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('Sidebar Widgets', 'html5blank'),
        'description' => __('Sidebar Widgets', 'html5blank'),
        'id' => 'sidebar-widget-area',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
 function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Shortcode Test
function formular_function( $atts ) {

    $a = shortcode_atts( array(
        'name' => 'ausgeblendet',
        'address' => 'ausgeblendet',
        'telephone' => 'ausgeblendet',
        'nachricht' => 'ausgeblendet',
        'button_text' => 'Absenden!',
        'title' => 'Jetzt anfragen!',
        'datenschutz' => 'deaktiviert',
    ), $atts );

    ob_start();
        ?> <h4 class="sidebar-widget-title"><?php  echo esc_attr($a['title']);  ?></h4><form class="kontaktformular" action="https://herocentral.de/proxy/contact/{regiohelden.proxy.id}/{regiohelden.campaign.id}/custom" method="post" target="_blank" parsley-validate="" novalidate parsley-focus="first"><?php
        
    if ($a['name'] == 'pflichtfeld' or $a['name'] == ' pflichtfeld') {
        ?><label for="id_name">Name *</label><input id="id_name" name="name" type="text" required="" class="parsley-validated"><?php
    }
    elseif ($a['name'] == 'optional' or $a['name'] == ' optional') {
        ?><label for="id_name">Name</label><input id="id_name" name="name" type="text" class="parsley-validated"><?php
    }

    if ($a['address'] == 'pflichtfeld' or $a['name'] == ' pflichtfeld') {
        ?><label for="id_address">E-Mail *</label><input id="id_address" name="address" type="email" required="" parsley-trigger="change" class="parsley-validated"><?php
    }
    elseif ($a['address'] == 'optional' or $a['name'] == ' optional') {
        ?><label for="id_address">E-Mail</label><input id="id_address" name="address" type="email" parsley-trigger="change" class="parsley-validated"><?php
    }

    if ($a['telephone'] == 'pflichtfeld' or $a['name'] == ' pflichtfeld') {
        ?><label for="id_telephone">Telefon *</label><input id="id_telephone" name="telephone" type="text" required="" parsley-trigger="change" parsley-minlength="4" class="parsley-validated"><?php
    }
    elseif ($a['telephone'] == 'optional' or $a['name'] == ' optional') {
        ?><label for="id_telephone">Telefon</label><input id="id_telephone" name="telephone" type="text" parsley-trigger="change" parsley-minlength="4" class="parsley-validated"><?php
    }

    if ($a['nachricht'] == 'pflichtfeld' or $a['name'] == ' pflichtfeld') {
        ?><label for="id_message">Nachricht *</label><textarea id="id_message" name="message" parsley-trigger="change" required parsley-minlength="6" class="parsley-validated"></textarea><?php
    }
    elseif ($a['nachricht'] == 'optional' or $a['name'] == ' optional') {
        ?><label for="id_message">Nachricht</label><textarea id="id_message" name="message" parsley-trigger="change" parsley-minlength="6" class="parsley-validated"></textarea><?php
    }

    ?><br><br><input type="submit" name="" value="<?php  echo esc_attr($a['button_text']);  ?>" onclick="javascript:clickConv();">

    <?php
   
    if ($a['datenschutz'] == 'aktiviert') {
        ?><div style="clear: both;"></div><span style="font-size: 9px; line-height:7px; float: right; margin: 25px 0 0 0;"><a class="datenschutz-open-close" href="javascript:void(0);">Hinweise zum Datenschutz</a></span> <span style="font-size: 9px; line-height:7px; float: left; margin: 25px 0 0 0;">* erforderlich</span><?php
    }
        
        ?></form> <div class="clearfix"></div> <?php

        return ob_get_clean();

}

add_shortcode('formular', 'formular_function');


// Add Actions
// add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
// add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
// add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
// add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
// remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
// add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether


// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// Dennis Specials ////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/theme-options/tocki_redux_themeoptions.php' ) ) {
    require_once( dirname( __FILE__ ) . '/theme-options/tocki_redux_themeoptions.php' );
}


// customize admin footer text
function custom_admin_footer() {
        echo 'Webdesign & Wordpress von Tilman Ockert und Dennis Hipp f&uuml;r <a href="http://regiohelden.de" target="_blank">RegioHelden</a> - E-Mail: <a href="mailto:webdesign@regiohelden.de">webdesign@regiohelden.de</a> | ';
}
add_filter('admin_footer_text', 'custom_admin_footer');

// Proper way to enqueue scripts and styles
function theme_name_scripts() {
  
    wp_enqueue_script( 'Fade Slide Toggle Plugin', get_template_directory_uri() . '/js/jquery.fadeSliderToggle.js', array('jquery'), '', true );
    wp_enqueue_script( 'Fade Slide Toggle Plugin', get_template_directory_uri() . '/js/jquery.smooth-scroll.js', array('jquery'), '', true );
    wp_enqueue_script( 'Fade Slide Toggle Plugin', get_template_directory_uri() . '/js/mobilemenu.js', array('jquery'), '', true );
    wp_enqueue_script( 'Form Validation', get_template_directory_uri() . '/js/parsley.js', array(), '', true );

    wp_register_script('MMenu', get_template_directory_uri() . '/js/jquery.mmenu.min.all.js', array('jquery'), '');
    wp_enqueue_script( 'MMenu');



}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );


// Subseite "Anpassen ausblenden"
add_action( 'admin_menu', 'adjust_the_wp_menu', 999 );
function adjust_the_wp_menu() {
  $page = remove_submenu_page( 'themes.php', 'theme-editor.php' );
  // $page[0] is the menu title
  // $page[1] is the minimum level or capability required
  // $page[2] is the URL to the item's file
}


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