<?php
/**
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
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
	 * @uses add_custom_background() To add support for a custom background.
	 * @uses add_editor_style() To style the visual editor.
	 * @uses load_theme_textdomain() For translation/localization support.
	 * @uses add_custom_image_header() To add support for a custom header.
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
		add_custom_background( 'devpress_custom_background_callback' );
		
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
		add_custom_image_header( '', 'twentyten_admin_header_style' );

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
	 * Referenced via add_custom_image_header() in twentyten_setup().
	 * @since Twenty Ten 1.0
	 */
	function twentyten_admin_header_style() {
		echo '
			<style type="text/css">
				#headimg {
					border-bottom: 1px solid #000;
					border-top: 4px solid #000;
				}
			</style>
		';
	}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
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


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// Tocki Specials /////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/theme-options/tocki_redux_themeoptions.php' ) ) {
    require_once( dirname( __FILE__ ) . '/theme-options/tocki_redux_themeoptions.php' );
}

/**
 * customize admin footer text
 */
function custom_admin_footer() {
	echo 'Webdesign & Wordpress von Tilman Ockert f&uuml;r <a href="http://regiohelden.de" target="_blank">RegioHelden</a> - E-Mail: <a href="mailto:tilman.ockert@regiohelden.de">tilman.ockert@regiohelden.de</a>';
}
add_filter('admin_footer_text', 'custom_admin_footer');

/**
 * Subseite "Anpassen ausblenden
 */
function adjust_the_wp_menu() {
  	$page = remove_submenu_page( 'themes.php', 'theme-editor.php' );
}
add_action( 'admin_menu', 'adjust_the_wp_menu', 999 );

/**
 * zählt die Widgets im Footer
 * @param  array $params
 * @return array
 */
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

/**
 * Shortcode für die Telefonnummer
 */
function ProxyNumberShortcode() {
	if (is_mobile()) {
		return '<a class="tocki-proxy-number" href="tel:{regiohelden.proxy.number}">{regiohelden.proxy.number}</a>';
	} else {
		return '{regiohelden.proxy.number}';
	}
}
add_shortcode('ProxyNumber', 'ProxyNumberShortcode');

/**
 * Shortcode auch in Widgets aktivieren
 */
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