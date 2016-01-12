<?php
if ( ! class_exists( 'Redux' ) ) {
    return;
}

$opt_name = 'mws_options';

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    'opt_name' => $opt_name, // This is where your data is stored in the database and also becomes your global variable name.
    'display_name' => 'Hallo', // Name that appears at the top of your panel
    'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
    'menu_type' => 'submenu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => true, // Show the sections below the admin menu item or not
    'menu_title' => __('Theme Options', 'rh'),
    'page' => __('MWS Theme Options', 'rh'),
    'google_api_key' => 'AIzaSyBmxvj356eHsFewIL-uQ06YZITc4lCY1Sc', // Must be defined to add google fonts to the typography module
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => true,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => false,
    // Show the time the page took to load, etc
    'update_notice'        => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
    // OPTIONAL -> Give you extra features
    'page_priority'        => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => '_options',
    // Page slug used to denote the panel
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => true,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.
    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
    //'compiler'             => true,
    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'light',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    ),        
);

if (!isset($args['global_variable']) || $args['global_variable'] !== false) {
    if (!empty($args['global_variable'])) {
        $v = $args['global_variable'];
    } else {
        $v = str_replace("-", "_", $args['opt_name']);
    }
    $args['intro_text'] = sprintf(__('<p>Die globale Variable für das Template lautet: <strong>$%1$s</strong></p>', 'redux-framework-demo'), $v);
} else {
    $args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo');
}

Redux::setArgs( $opt_name, $args );

Redux::setSection( $opt_name, array(
    'title' => 'Theme Einstellungen',
    'icon' => 'el-icon-edit',
    'fields' => array(
        array(
            'id' => 'page_title',
            'type' => 'text',
            'title' => 'HTML Title',
            'subtitle' => 'Seiten-übergreifender Anteil',
            'desc' => 'Der Seiten-übergreifende Teil des HMTL Titels. Der zweite Teil wird vom Seiten-Titel der jeweiligen Seite bestimmt. "erster Teil | zweiter Teil"',
        ),
         array(
            'id' => 'favicon',
            'type' => 'text',
            'title' => 'Favicon',
            'subtitle' => 'URL zum Favicon des Kunden.',
            'default'  => '',
        ),
        array(
            'id' => 'whitelabel',
            'type' => 'radio',
            'title' => 'Whitelabel Kunde',
            'subtitle' => 'Link im Footer',
            'options'  => array(
                '1' => 'ohne Angabe', 
                '2' => 'RegioHelden Link', 
                '3' => 'Marcapo', 
                '4' => 'Stuttgarter Zeitung'
            ),
            'default' => '2'
        ),
         array(
            'id' => 'mobile_switcher',
            'type' => 'switch',
            'title' => 'Andere CampaignID für Mobilgeräte',
            'subtitle' => 'Mobile Nutzer mit einer getrennten Kampagne messen',
            'desc' => 'Wenn aktiv, werden mobile Nutzer mit einer anderen Kampagne gemessen',
            'default' => false
        ),
        array(
            'id' => 'mobile_campaign',
            'required' => array('mobile_switcher', 'equals', '1'),
            'type' => 'text',
            'title' => 'ID der mobilen Kampagne',
            'subtitle' => 'Muss zuvor angelegt werden.',
        ),
        array(
            'id' => 'robots',
            'type' => 'switch',
            'title' => 'Suchmaschinen zulassen',
            'subtitle' => 'Obacht: doppelter Content!',
            'desc' => '"Aus" setzt einen Meta-Tag und gibt Suchmaschinen die Anweisung, dass sie die Seite nicht indexieren sollen.',
            'default' => false
        ),
        array(
            'id' => 'form_conversion',
            'type' => 'switch',
            'title' => 'AdWords Conversion Tracking',
            'subtitle' => 'Ermöglicht das Tracken des Kontakt Formulars mit AdWords Conversion Code',
            'desc' => 'Angaben in AdWords unter "Tools > Conversions"',
            'default' => false
        ),
        array(
            'id' => 'form_conversion_id',
            'required' => array('form_conversion', 'equals', '1'),
            'type' => 'text',
            'title' => 'google_conversion_id',
        ),
        array(
            'id' => 'form_conversion_label',
            'required' => array('form_conversion', 'equals', '1'),
            'type' => 'text',
            'title' => 'google_conversion_label',
        ),
        array(
            'id' => 'whitelabel',
            'type' => 'radio',
            'title' => 'Whitelabel Kunde',
            'subtitle' => 'Link im Footer der LP',
            'options'  => array(
                '1' => 'ohne Angabe', 
                '2' => 'RegioHelden', 
                '3' => 'Marcapo', 
                '4' => 'Stuttgarter Zeitung'
            ),
            'default' => '2'
        ),
    ),
));

Redux::setSection( $opt_name, array(
    'title' => 'Layout',
    'icon' => 'el-icon-picture',
    'fields' => array(
        array(
            'id' => 'nav_fullwidth',
            'type' => 'switch',
            'title' => 'Ganze Breite für den Navbar Container',
            'subtitle' => 'Soll die gesamte Browserbreite für die Navbar genutzt werden?',
            'default' => true
        ),
        array(
            'id' => 'header_fixed',
            'required' => array('nav_fullwidth', 'equals', '1'),
            'type' => 'switch',
            'title' => 'Header mit fixer Position',
            'subtitle' => 'Soll der Header mitscrollen?',
            'desc' => 'Wenn aktiv bewgt sich der Header beim scrollen mit.',
            'default' => true
        ),
        array(
            'id' => 'image_fullwidth',
            'type' => 'switch',
            'title' => 'Ganze Breite für Headerbild',
            'subtitle' => 'Soll die gesamte Browserbreite für das Headerbild genutzt werden?',
            'default' => true
        ),
        array(
            'id' => 'fullwidth',
            'type' => 'switch',
            'title' => 'Ganze Breite für Inhalt',
            'subtitle' => 'Soll die Sidebar unter dem Content dargestellt werden?',
            'default' => false
        ),
        array(
            'id' => 'footer_fullwidth',
            'type' => 'switch',
            'title' => 'Ganze Breite für den Footer Container',
            'subtitle' => 'Soll die gesamte Browserbreite für den Footer genutzt werden?',
            'default' => true
        ),
        array(
            'id' => 'divide_1',
            'type' => 'divide',
        ),
        array(
            'id' => 'logo',
            'type' => 'media',
            'title' => 'Logo für den Header',
            'desc' => 'Uploade ein Bild für den Kopfbereich.',
        ),
        array(
            'id' => 'logo_url',
            'type' => 'text',
            'title' => 'Logo benutzerdef. URL',
            'subtitle' => 'Gültige URL oder relativen Pfad angeben.',
            'default' => '/',
        ),
        array(
            'id' => 'logo_row',
            'type' => 'switch',
            'title' => 'Logo umbrechen',
            'subtitle' => 'Logo in seperater Reihe?',
            'desc' => 'Wenn aktiv wird das Logo in einer extra Reihe über der Navigation dargestellt.',
            'default' => false
        ),
        array(
            'id' => 'divide_2',
            'type' => 'divide',
        ),
        array(
            'id' => 'keyvisual',
            'type' => 'media',
            'title' => 'Keyvisual',
            'desc' => 'Immer hübsch an die Ladezeiten denken :-)',
        ),
        array(
            'id' => 'keyvisual_height',
            'type' => 'text',
            'title' => 'Keyvisual Höhe',
            'desc' => 'Maximale Höhe des Keyviusals in px',
            'default' => '400'
        ),
        array(
            'id' => 'divide_9',
            'type' => 'divide',
        ),
        array(
            'id' => 'rounded_borders',
            'type' => 'switch',
            'title' => 'Abgerundete Ecken',
            'desc' => 'Wenn ausgeschaltet werden Ecken nicht abgerundet.',
            'default' => true
        ),
    ),
));

Redux::setSection( $opt_name, array(
    'title' => 'Farben',
    'icon' => 'el-icon-tint',
    'fields' => array(
        array(
            'id' => 'body_background',
            'type' => 'background',
            'title' => 'Body Hintergrund',
            'default' => array(
                'background' => '#fff',
            )
        ),
        array(
            'id' => 'logo_row_bg',
            'required' => array('logo_row', 'equals', '1'),
            'type' => 'color',
            'title' => 'Logozeile Hintergrundfarbe',
            'validate' => 'color',
            'default' => '#fff'
        ),
        array(
            'id' => 'divide_3',
            'type' => 'divide',
        ),
        array(
            'id' => 'navbar_bg',
            'type' => 'color',
            'title' => 'Navbar Hintergrundfarbe',
            'validate' => 'color',
            'default' => '#f8f8f8'
        ),
        array(
            'id' => 'navbar_border',
            'type' => 'border',
            'title' => 'Navbar Rahmen',
            'all' => false,
            'default'  => array(
                'border-color'  => '#e7e7e7', 
                'border-style'  => 'solid', 
                'border-top'    => '0', 
                'border-right'  => '0', 
                'border-bottom' => '1px', 
                'border-left'   => '0'
            )
        ),
        array(
            'id' => 'divide_4',
            'type' => 'divide',
        ),
        array(
            'id' => 'content_bg',
            'type' => 'color',
            'title' => 'Content Hintergrundfarbe',
            'validate' => 'color',
            'default' => '#fff'
        ),
        array(
            'id' => 'footer_bg',
            'type' => 'color',
            'title' => 'Footer Hintergrundfarbe',
            'subtitle' => 'Standard-Farbe für Buttons, Boxen, usw.',
            'validate' => 'color',
            'default' => '#f8f8f8'
        ),
        array(
            'id' => 'corporate_color',
            'type' => 'color',
            'title' => 'Corporate Color',
            'subtitle' => 'Standard-Farbe für Buttons, Boxen, usw.',
            'validate' => 'color',
            'default' => '#337ab7'
        ),
        array(
            'id' => 'divide_5',
            'type' => 'divide',
        ),
        array(
            'id' => 'color_settings',
            'type' => 'switch',
            'title' => 'Erweiterte Farbeinstellungen',
            'subtitle' => 'Detailiertere Angaben zu Farben.',
            'default' => false
        ),
        array(
            'id' => 'menu_active',
            'required' => array('color_settings', 'equals', '1'),
            'type' => 'color',
            'title' => 'Aktiver Menüpunkt',
            'validate' => 'color',
            'default' => '#e7e7e7'
        ),
        array(
            'id' => 'menu_text',
            'required' => array('color_settings', 'equals', '1'),
            'type' => 'color',
            'title' => 'Menüpunkt Textfarbe',
            'validate' => 'color',
            'default' => '#777'
        ),
        array(
            'id' => 'menu_active_text',
            'required' => array('color_settings', 'equals', '1'),
            'type' => 'color',
            'title' => 'Aktiver Menüpunkt Textfarbe',
            'validate' => 'color',
            'default' => '#555'
        ),
        array(
            'id' => 'dropdown_bg',
            'required' => array('color_settings', 'equals', '1'),
            'type' => 'color',
            'title' => 'Menüpunkt (Dropdown)',
            'validate' => 'color',
            'default' => '#e7e7e7'
        ),
        array(
            'id' => 'dropdown_active_bg',
            'required' => array('color_settings', 'equals', '1'),
            'type' => 'color',
            'title' => 'Aktiver Menüpunkt (Dropdown)',
            'validate' => 'color',
            'default' => '#286090'
        ),
        array(
            'id' => 'dropdown_text',
            'required' => array('color_settings', 'equals', '1'),
            'type' => 'color',
            'title' => 'Menüpunkt (Dropdown) Textfarbe',
            'validate' => 'color',
            'default' => '#777'
        ),
        array(
            'id' => 'dropdown_active_text',
            'required' => array('color_settings', 'equals', '1'),
            'type' => 'color',
            'title' => 'Aktiver Menüpunkt (Dropdown) Textfarbe',
            'validate' => 'color',
            'default' => '#fff'
        ),
        array(
            'id' => 'button_bg',
            'required' => array('color_settings', 'equals', '1'),
            'type' => 'color',
            'title' => 'Button Hintergrund',
            'validate' => 'color',
            'default' => '#286090'
        ),
        array(
            'id' => 'button_text',
            'required' => array('color_settings', 'equals', '1'),
            'type' => 'color',
            'title' => 'Button Textfarbe',
            'validate' => 'color',
            'default' => '#fff'
        ),
        array(
            'id' => 'phone_bg',
            'required' => array('color_settings', 'equals', '1'),
            'type' => 'color',
            'title' => 'Phonebox Hintergrund',
            'validate' => 'color',
            'default' => '#286090'
        ),
        array(
            'id' => 'phone_text',
            'required' => array('color_settings', 'equals', '1'),
            'type' => 'color',
            'title' => 'Phonebox Textfarbe',
            'validate' => 'color',
            'default' => '#fff'
        ),
    ),
));


Redux::setSection( $opt_name, array(
    'title' => 'Typographie',
    'icon' => 'el-icon-fontsize',
    'fields' => array(
        array(
            'id'          => 'body_text',
            'type'        => 'typography', 
            'title'       => 'Body Text',
            'subtitle'    => 'Schriftart für alle Inhalte',
            'google'      => true, 
            'font-backup' => true,
            'text-align'  => false,
            'output'      => array('body, input, textarea, select'),
            'subsets'     => false,
            'units'       => 'px',
            'default'     => array(),
        ),
        array(
            'id'          => 'text_bold',
            'type'        => 'typography', 
            'title'       => 'Body Text - bold',
            'subtitle'    => 'Wenn Body Text auch in bold verwendet werden soll',
            'google'      => true, 
            'font-backup' => true,
            'text-align'  => false,
            'output'      => array('strong','b'),
            'subsets'     => false,
            'units'       => 'px',
            'default'     => array(),
        ),
        array(
            'id'          => 'text_main_nav',
            'type'        => 'typography', 
            'title'       => 'Menü',
            'subtitle'    => 'Schriftart, die im Menü verwendet werden soll',
            'google'      => true, 
            'font-backup' => true,
            'text-align'  => false,
            'output'      => array('#mainNav, #mainNav li, #mainNav a'),
            'subsets' => false,
            'units'       => 'px',
            'default'     => array(),
        ),
        array(
            'id'          => 'text_h1',
            'type'        => 'typography', 
            'title'       => 'h1 Schriftart',
            'subtitle'    => 'Typo für Überschriften h1',
            'google'      => true, 
            'font-backup' => true,
            'text-align'  => false,
            'subsets'     => false,
            'output'      => array('h1'),
            'units'       => 'px',
            'default'     => array(),
        ),
        array(
            'id'          => 'text_h2',
            'type'        => 'typography', 
            'title'       => 'h2 Schriftart',
            'subtitle'    => 'Typo für Überschriften h2',
            'google'      => true, 
            'font-backup' => true,
            'text-align'  => false,
            'subsets'     => false,
            'output'      => array('h2'),
            'units'       => 'px',
            'default'     => array(),
        ),
        array(
            'id'          => 'text_h3',
            'type'        => 'typography', 
            'title'       => 'h3 Schriftart',
            'subtitle'    => 'Typo für Überschriften h3',
            'google'      => true, 
            'font-backup' => true,
            'text-align'  => false,
            'subsets'     => false,
            'output'      => array('h3'),
            'units'       => 'px',
            'default'     => array(),
        ),
        array(
            'id'          => 'text_h4',
            'type'        => 'typography', 
            'title'       => 'h4 Schriftart',
            'subtitle'    => 'Typo für Überschriften h4',
            'google'      => true, 
            'font-backup' => true,
            'text-align'  => false,
            'subsets'     => false,
            'output'      => array('h4'),
            'units'       => 'px',
            'default'     => array(),
        ),
        array(
            'id'          => 'text_footer',
            'type'        => 'typography', 
            'title'       => 'Footer Schriftart',
            'subtitle'    => 'Typo für den Footer',
            'google'      => true, 
            'font-backup' => true,
            'text-align'  => false,
            'subsets'     => false,
            'output'      => array('.footer'),
            'units'       => 'px',
            'default'     => array(),
        ),
    ),
));

Redux::setSection( $opt_name, array(
    'title' => 'Extras',
    'icon' => 'el-icon-globe',
    'fields' => array(
        array(
            'id' => 'custom_css',
            'type' => 'ace_editor',
            'title' => 'Zusätzliches CSS',
            'subtitle' => 'Übrschreibt die Vorgaben aus dem Template.',
            'mode' => 'css',
            'theme' => 'monokai',
            'default' => '/* desktop */

/* small desktop */
@media all and (max-width: 992px) {

}

/* tablet */
@media all and (max-width: 768px) {

}

/* phone */
@media all and (max-width: 480px) {

}',
        ),
        array(
            'id' => 'code_header',
            'type' => 'ace_editor',
            'title' => 'Header Code',
            'subtitle' => 'JavaScript, etc. im Header',
            'mode' => 'html',
            'theme' => 'monokai'
        ),
        array(
            'id' => 'code_footer',
            'type' => 'ace_editor',
            'title' => 'Footer Code',
            'subtitle' => 'JavaScript, etc. im Footer',
            'mode' => 'html',
            'theme' => 'monokai'
        ),
        array(
            'id' => 'badge',
            'type' => 'switch',
            'title' => 'Badge',
            'subtitle' => 'Soll ein Aktions-Bagdge im Header angezeigt werden?',
            'default' => false
        ),
        array(
            'id' => 'badge_css',
            'required' => array('badge', 'equals', '1'),
            'type' => 'ace_editor',
            'title' => 'Badge - CSS',
            'mode' => 'css',
            'theme' => 'monokai',
            'default' => '.badge {
    position: absolute;
    top: 0;
    right: 0;
    z-index: 999;
}',
        ),
        array(
            'id' => 'badge_html',
            'required' => array('badge', 'equals', '1'),
            'type' => 'ace_editor',
            'title' => 'Badge - Quellcode',
            'mode' => 'html',
            'theme' => 'monokai',
            'default' => '<div class="badge">
    <img src="" alt="" height="" width="">
</div>',
        ),
    ),
));

Redux::setSection( $opt_name, array(
    'type' => 'divide',
));

/**
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 */
if ( ! function_exists( 'remove_demo' ) ) {
    function remove_demo() {
        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }
}
add_action( 'redux/loaded', 'remove_demo' );