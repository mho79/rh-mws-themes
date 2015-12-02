<?php
/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
 * */

if (!class_exists("Redux_Framework_sample_config")) {

    class Redux_Framework_sample_config {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {
            // This is needed. Bah WordPress bugs.  ;)
            if ( defined('TEMPLATEPATH') && strpos(__FILE__,TEMPLATEPATH) !== false) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);    
            }
        }

        public function initSettings() {

            if ( !class_exists("ReduxFramework" ) ) {
                return;
            }       
            
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/plugin/hooks', array( $this, 'remove_demo' ) );
            // Function to test the compiler hook and demo CSS output.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2); 
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            // Dynamically add a section. Can be also used to modify sections/fields
            add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css) {
            //echo "<h1>The compiler hook has run!";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
              require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
              $wp_filesystem->put_contents(
              $filename,
              $css,
              FS_CHMOD_FILE // predefined mode settings for WP files
              );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
		 
        function dynamic_section($sections) {
            //$sections = array();
			/*
            $sections[] = array(
                'title' => __('Section via hook', 'redux-framework-demo'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );
*/
            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = "Testing filter hook!";

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::get_instance(), 'plugin_meta_demo_mode_link'), null, 2);
            }

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action('admin_notices', array(ReduxFrameworkPlugin::get_instance(), 'admin_notices'));
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode(".", $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[] = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct = wp_get_theme();
            $this->theme = $ct;
            $item_name = $this->theme->get('Name');
            $tags = $this->theme->Tags;
            $screenshot = $this->theme->get_screenshot();
            $class = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'redux-framework-demo'), $this->theme->display('Name'));
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
            <?php endif; ?>

                <h4>
            <?php echo $this->theme->display('Name'); ?>
                </h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'redux-framework-demo'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'redux-framework-demo'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'redux-framework-demo') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
                <?php
                if ($this->theme->parent()) {
                    printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'redux-framework-demo'), $this->theme->parent()->display('Name'));
                }
                ?>

                </div>

            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }



/* ------------------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------------------
----------------------------- ACTUAL DECLARATION OF SECTIONS --------------------------------------------
---------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------ */

			$this->sections[] = array(
                'title' => 'Theme Einstellungen',
                'icon' => 'el-icon-cogs',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields' => array(
                    array(
                        'id' => 'tocki_redux_title',
                        'type' => 'text',
                        'title' => 'HTML Title',
                        'subtitle' => 'Seiten-übergreifender Anteil"',
                        'desc' => 'Der Seiten-übergreifende Teil des HMTL Titels. Der zweite Teil wird vom Seiten-Titel der jeweiligen Seite bestimmt. "erster Teil | zweiter Teil"',
                    ),
                    array(
                        'id' => 'tocki_redux_favicon',
                        'type' => 'text',
                        'title' => 'Favicon',
                        'subtitle' => 'URL zum Favicon des Kunden.',
        				'default'  => 'http://00-tocki1.kunden.extern.regiohelden.de/wp-content/themes/LandingTocki-0.8/images/favicon.ico',
                    ),
                    array(
                        'id' => 'tocki_redux_whitelabel',
                        'type' => 'radio',
                        'title' => 'Whitelabel Kunde',
                        'subtitle' => 'Link im Footer der LP',
						//Must provide key => value pairs for radio options
						'options'  => array(
							'1' => 'ohne Angabe', 
							'2' => 'RegioHelden Link', 
							'3' => 'Marcapo', 
							'4' => 'Stuttgarter Zeitung'
						),
						'default' => '2'
                    ),
                    array(
                        'id' => 'tocki_redux_child_menues',
                        'type' => 'switch',
                        'title' => 'Getrennte Child-Menüs',
                        'subtitle' => 'Für SEO oder getrennte Stadtunterseiten separate Menüs zeigen',
                        'desc' => 'Wenn aktiv werden nur die Kindelemente (also Unter-Unterseiten) gezeigt, die zusammengehören.',
                        'default' => false
                    ),
                    array(
                        'id' => 'tocki_redux_mobile_switcher',
                        'type' => 'switch',
                        'title' => 'Andere CampaignID für Mobilgeräte',
                        'subtitle' => 'Wenn aktiv, werden mobile Nutzer mit einer anderen Kampagne gemessen',
                        'on'  => 'Mobile-ID an',
                        'off'  => 'Mobile-ID aus',
                        'default' => false
                    ),
                    array(
                        'id' => 'tocki_redux_mobile_campaign',
                        'required' => array('tocki_redux_mobile_switcher', 'equals', '1'),
                        'type' => 'text',
                        'title' => 'ID mobile Kampagne',
                        'subtitle' => 'Muss zuvor angelegt werden.',
                    ),
                    array(
                        'id' => 'tocki_redux_seo_switcher',
                        'type' => 'switch',
                        'title' => 'Suchmaschinen zulassen',
						'subtitle' => 'Obacht: doppelter Content!',
                        'desc' => '"Aus" setzt einen Meta-Tag und gibt Suchmaschinen die Anweisung, dass sie die Seite nicht indexieren sollen.',
						'default' => false
                    ),
                    array(
                        'id' => 'tocki_redux_formular_conversion_switcher',
                        'type' => 'switch',
                        'title' => 'AdWords Conversion Tracking',
						'subtitle' => 'Ermöglicht das Tracken des Kontakt Formulars mit AdWords Conversion Code',
                        'desc' => 'Angaben in AdWords unter "Tools > Conversions"',
						'default' => false
                    ),
						array(
							'id' => 'tocki_redux_formular_conversion_conversion_id',
							'required' => array('tocki_redux_formular_conversion_switcher', 'equals', '1'),
							'type' => 'text',
							'title' => 'google_conversion_id',
							'subtitle' => '',
						),
						array(
							'id' => 'tocki_redux_formular_conversion_conversion_label',
							'required' => array('tocki_redux_formular_conversion_switcher', 'equals', '1'),
							'type' => 'text',
							'title' => 'google_conversion_label',
							'subtitle' => '',
						),
                    array(
                        'id' => 'tocki_redux_footer',
                        'type' => 'ace_editor',
                        'title' => 'Remarketing/Analytics Code',
                        'subtitle' => 'Code wird im Footer eingebunden',
                        'mode' => 'html',
                        'theme' => 'monokai',
                        'desc' => 'HTML erlaubt.'
                    ),
					
                ),
            );

			$this->sections[] = array(
                'title' => 'Kontakt / Impressum',
                'icon' => 'el-icon-user',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields' => array(
                    array(
                        'id' => 'tocki_redux_firma',
                        'type' => 'text',
                        'title' => 'Firma',
                        'desc' => 'keine Variable verfügbar.',
                    ),
                    array(
                        'id' => 'tocki_redux_firma_zusatz',
                        'type' => 'text',
                        'title' => 'Zusätzliche Zeile (optional)',
                        'desc' => 'keine Variable verfügbar.',
                    ),
                    array(
                        'id' => 'tocki_redux_name',
                        'type' => 'text',
                        'title' => 'Name',
                        'subtitle' => 'Vor- und Nachname des Verantwortlichen',
                        'desc' => 'Wert aus Proxy: <span style="color: #0074A2; font-weight: bold;">{admin.customer.contact_person}</span>',
                    ),
                    array(
                        'id' => 'tocki_redux_strasse',
                        'type' => 'text',
                        'title' => 'Straße und Hausnr.',
                        'desc' => 'Wert aus Proxy: <span style="color: #0074A2; font-weight: bold;">{admin.customer.street}</span>',
                    ),
                    array(
                        'id' => 'tocki_redux_plz',
                        'type' => 'text',
                        'title' => 'PLZ',
                        'desc' => 'Wert aus Proxy: <span style="color: #0074A2; font-weight: bold;">{admin.customer.zipcode}</span>',
                    ),
                    array(
                        'id' => 'tocki_redux_ort',
                        'type' => 'text',
                        'title' => 'Ort',
                        'desc' => 'Wert aus Proxy: <span style="color: #0074A2; font-weight: bold;">{admin.customer.city}</span>',
                    ),
                    array(
                        'id' => 'tocki_redux_mail',
                        'type' => 'text',
                        'title' => 'Email',
                        'desc' => 'Wert aus Proxy: <span style="color: #0074A2; font-weight: bold;">{admin.customer.email}</span>',
                    ),
                    array(
                        'id' => 'section-impressum-start',
                        'type' => 'section',
                        'title' => '<br>Impressum',
                        'indent' => false // Indent all options below until the next 'section' option is set.
                    ),
                    array(
                        'id' => 'tocki_redux_impressum1_switcher',
                        'type' => 'switch',
                        'title' => 'Impressum Spalte 1',
						'subtitle' => 'Angaben von oben verwenden oder individeull eingeben.',
						'on'  => 'individuell',
						'off'  => 'automatisch',
						'default' => false
                    ),
                    array(
                        'id' => 'tocki_redux_impressum1',
                        'required' => array('tocki_redux_impressum1_switcher', 'equals', '1'),
                        'type' => 'editor',
                        'title' => 'Impressum Spalte 1',
                        'subtitle' => 'Werte aus dem Proxy verwenden:<br> <span style="color: #0074A2; font-weight: bold;">{admin.customer.contact_person} <br>{admin.customer.street} <br>{admin.customer.zipcode} {admin.customer.city} <br>{regiohelden.proxy.number} <br>{admin.customer.email}</span>',
                        'default' => '<h3>Verantwortlicher</h3>{customer.contact_person} <br>{customer.street} <br>{customer.zipcode} <br>{customer.city} <br>{customer.email} <br> <br>&copy; [current-year]',
                    ),
                    array(
                        'id' => 'tocki_redux_impressum2',
                        'type' => 'editor',
                        'title' => 'Impressum Spalte 2',
                    ),
                    array(
                        'id' => 'tocki_redux_impressum3',
                        'type' => 'editor',
                        'title' => 'Impressum Spalte 3',
                        'subtitle' => 'Im Normalfall für den Bildnachweis <br><a href="http://goo.gl/oRc7wV" target="_blank">Bildnachweis Doc</a>',
                    ),
					
                ),
            );

			$this->sections[] = array(
                'title' => 'Farbe / Typo',
                'icon' => 'el-icon-tint',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields' => array(
                    array(
						'id' => 'tocki_redux_background',
						'type' => 'background',
						'title' => 'Header Bild /<br>Body Background',
						'desc' => 'Immer hübsch an die Ladezeiten denken :-)',
						'default' => array(
							'background-color'  => '#F2F2F2', 
						),
        				'output'      => array('body')
                    ),	
                    array(
                        'id' => 'tocki_redux_header_height',
                        'type' => 'text',
                        'title' => 'Oberkante Content Bereich',
                        'subtitle' => 'Wie groß ist der Abstand zwischen Oberkante Website und Anfang Content.',
                        'default' => '150px',
                    ),		
                    array(
                        'id' => 'tocki_redux_content_padding_switch',
                        'type' => 'switch',
                        'title' => 'Padding für den Content Bereich',
						'desc' => 'Macht hauptsächlich dann Sinn, wenn der Content-Bereich über das Bild hinaus ragt.',
						'default' => false
                    ),
                    array(
                        'id' => 'tocki_redux_header_logo',
                        'type' => 'media',
                        'title' => 'Logo für den Header',
                        'desc' => 'Upload ein Bild für den Kopfbereich. (Standard: 320px x 140px)',
                    ),
                    array(
                        'id' => 'tocki_redux_header_logo_alt',
                        'type' => 'text',
                        'title' => 'Alt-Tag für Header-Logo',
                        'desc' => 'Gebe hier den Alt-Text für das Logo ein.',
                    ),
                    array(
                        'id' => 'tocki_redux_header_logo_height',
                        'type' => 'text',
                        'title' => 'Höhe der Logo-Box',
                        'subtitle' => 'Höhe der Box, in der das Logo zu sehen sein soll',
                        'default' => '250px',
                    ),	
                    array(
                        'id' => 'tocki_redux_header_logo_width',
                        'type' => 'text',
                        'title' => 'Breite der Logo-Box',
                        'subtitle' => 'Breite der Box, in der das Logo zu sehen sein soll',
                        'default' => '250px',
                    ),
                    array(
                        'id' => 'tocki_redux_header_url',
                        'type' => 'text',
                        'title' => 'Logo benutzerdef. URL',
                        'subtitle' => 'Gültige URL oder relativen Pfad angeben.',
                        'default' => '/',
                    ),
                    array(
                        'id' => 'tocki_redux_header_target',
                        'type' => 'switch',
                        'title' => 'Logo-URL im neuen Fenster öffnen',
                        'desc' => 'target "_blank" an- und ausschalten.',
                        'default' => false
                    ),
                    array(
                        'id' => 'tocki_redux_header_logo_switch',
                        'type' => 'switch',
                        'title' => 'Einstellungen für die Logo Animation',
						'subtitle' => 'Andere Breite für das verkelinerte Logo beim Scrollen',
						'default' => false
                    ),
                    array(
                        'id' => 'tocki_redux_header_logo_small_width',
                        'required' => array('tocki_redux_header_logo_switch', 'equals', '1'),
                        'type' => 'text',
                        'title' => 'Breite des kleinen Logos',
                        'subtitle' => 'Breite der Box, in der das Logo zu sehen sein soll, wenn gescrollt wird',
                        'default' => '99px',
                    ),	
                    array(
                        'id' => 'tocki_redux_header_logo_bg',
                        'type' => 'color',
                        'title' => 'Hintergrundfarbe für das Logo',
                        'subtitle' => '',
                        'validate' => 'color',
                    ),
                    /* array(
                        'id' => 'tocki_redux_header',
						'type' => 'background',
                        'title' => 'Header Hintergrund',
						'desc' => 'Breite min. 960px',
						'default' => array(
							'background-color'  => '#fff', 
						),
        				'output'      => array('.header')
                    ), */					
                    array(
                        'id' => 'tocki_redux_corporate_color',
                        'type' => 'color',
                        'title' => 'Corporate Color',
                        'subtitle' => 'Standard-Farbe für Buttons, Boxes und so.',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'tocki_redux_colorextend',
                        'type' => 'switch',
                        'title' => 'Erweiterte Farbeinstellungen',
						'subtitle' => 'Detailiertere Angaben zu Faben.',
						'default' => false
                    ),
                    array(
                        'id' => 'tocki_redux_colorextend_menu_bg',
                        'required' => array('tocki_redux_colorextend', 'equals', '1'),
                        'type' => 'color_rgba',
                        'title' => 'Menü: Hintergrundfarbe',
                        'default'  => array(
								'color' => '#FFF', 
								'alpha' => '0.9'
							),
                    ),
                    array(
                        'id' => 'tocki_redux_colorextend_menu_active',
                        'required' => array('tocki_redux_colorextend', 'equals', '1'),
                        'type' => 'color',
                        'title' => 'Menü: Aktiver Menüpunkt',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'tocki_redux_colorextend_header_cta',
                        'required' => array('tocki_redux_colorextend', 'equals', '1'),
                        'type' => 'color',
                        'title' => 'Header: Call To Action',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'tocki_redux_colorextend_bullets',
                        'required' => array('tocki_redux_colorextend', 'equals', '1'),
                        'type' => 'color',
                        'title' => 'Content: Bullets von Listen',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'tocki_redux_colorextend_cta_borders',
                        'required' => array('tocki_redux_colorextend', 'equals', '1'),
                        'type' => 'border',
                        'title' => 'Content: Boxes der CTAs',
						'all' => false
                    ),
                    array(
                        'id' => 'tocki_redux_colorextend_form_border',
                        'required' => array('tocki_redux_colorextend', 'equals', '1'),
                        'type' => 'color',
                        'title' => 'Sidebar: Formularfelder Rahmen',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'tocki_redux_colorextend_form_submit',
                        'required' => array('tocki_redux_colorextend', 'equals', '1'),
                        'type' => 'color',
                        'title' => 'Sidebar: Formularfelder Absende-Button',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'tocki_redux_colorextend_footer_bg',
                        'required' => array('tocki_redux_colorextend', 'equals', '1'),
                        'type' => 'background',
                        'title' => 'Footer: Hintergrund',
						'default' => array(
							'background-color'  => '#4D505F', 
						),
        				'output'      => array('.footer-wide')
                    ),
					
                    array(
                        'id' => 'section-typo-start',
                        'type' => 'section',
                        'title' => 'Typografie',
                        'indent' => false // Indent all options below until the next 'section' option is set.
                    ),
					
					array(
						'id'          => 'tocki_redux_typography_body',
						'type'        => 'typography', 
						'title'       => 'Body Text',
						'subtitle'    => 'Schriftart für alle Inhalte',
						'desc'		  => 'Default: Droid Sans, Normal 400, #333, 15px/22px',
						'google'      => true, 
						'font-backup' => true,
						'text-align'  => false,
        				'output'      => array('body','.content ul li .list-text'),
						'subsets' => false,
						'units'       => 'px',
						'default'     => array(
							'color'       => '#333', 
							'font-style'  => '400', 
							'font-family' => 'Droid Sans', 
							'google'      => true,
							'font-size'   => '15px', 
							'line-height' => '22px'
						),
					),
					array(
						'id'          => 'tocki_redux_typography_body_bold',
						'type'        => 'typography', 
						'title'       => 'Body Text - bold',
						'subtitle'    => 'Wenn Body Text auch in bold verwendet werden soll',
						'desc'		  => 'Default: leer lassen.',
						'google'      => true, 
						'font-backup' => true,
						'text-align'  => false,
        				'output'      => array('body strong','body bold'),
						'subsets' => false,
						'units'       => 'px',
						'default'     => array(
							'color'       => '', 
							'font-style'  => '', 
							'font-family' => '', 
							'google'      => true,
							'font-size'   => '', 
							'line-height' => ''
						),
					),
					array(
						'id'          => 'tocki_redux_typography_menu',
						'type'        => 'typography', 
						'title'       => 'Menü',
						'subtitle'    => 'Schriftart, die im Menü verwendet wirde',
						'desc'		  => 'Default: Droid Sans, Normal 400, #fff, 15px/22px',
						'google'      => true, 
						'font-backup' => true,
						'text-align'  => false,
        				'output'      => array('#nav','#nav li a','#nav > a','#nav > ul > li > a'),
						'subsets' => false,
						'units'       => 'px',
						'default'     => array(
							'color'       => '#333', 
							'font-style'  => '400', 
							'font-family' => 'Droid Sans', 
							'google'      => true,
							'font-size'   => '15px', 
							'line-height' => '22px'
						),
					),
					array(
						'id'          => 'tocki_redux_typography_titles_h1',
						'type'        => 'typography', 
						'title'       => 'h1 Schriftart',
						'subtitle'    => 'Typo für Überschriften h1',
						'google'      => true, 
						'font-backup' => true,
						'text-align'  => false,
						'subsets' 	  => false,
        				'output'      => array('h1'),
						'units'       => 'px',
						'default'     => array(
							'font-style'  => '400', 
							'font-family' => 'Yanone Kaffeesatz', 
							'google'      => true,
							'font-size'   => '25px', 
							'line-height' => '40px'
						),
					),
					array(
						'id'          => 'tocki_redux_typography_titles_h2',
						'type'        => 'typography', 
						'title'       => 'h2 Schriftart',
						'subtitle'    => 'Typo für Überschriften h2',
						'google'      => true, 
						'font-backup' => true,
						'text-align'  => false,
						'subsets' 	  => false,
        				'output'      => array('h2'),
						'units'       => 'px',
						'default'     => array(
							'font-style'  => '400', 
							'font-family' => 'Yanone Kaffeesatz', 
							'google'      => true,
							'font-size'   => '25px', 
							'line-height' => '40px'
						),
					),
					array(
						'id'          => 'tocki_redux_typography_sidebar_body',
						'type'        => 'typography', 
						'title'       => 'Sidebar Text',
						'subtitle'    => 'Schriftart für Inhalte in der Sidebar',
						'desc'		  => 'Default: Droid Sans, Normal 400, #333, 15px/22px',
						'google'      => true, 
						'font-backup' => true,
						'text-align'  => false,
        				'output'      => array('.sidebar'),
						'subsets' => false,
						'units'       => 'px',
						'default'     => array(
							'color'       => '#333', 
							'font-style'  => '400', 
							'font-family' => 'Droid Sans', 
							'google'      => true,
							'font-size'   => '15px', 
							'line-height' => '22px'
						),
					),
					array(
						'id'          => 'tocki_redux_typography_titles_sidebar',
						'type'        => 'typography', 
						'title'       => 'Überschriften Sidebar',
						'subtitle'    => 'Typo für Überschriften in der Sidebar',
						'google'      => true, 
						'font-backup' => true,
						'text-align'  => false,
						'subsets' 	  => false,
        				'output'      => array('.sidebar h4'),
						'units'       => 'px',
						'default'     => array(
							'font-style'  => '400', 
							'font-family' => 'Yanone Kaffeesatz', 
							'google'      => true,
							'font-size'   => '25px', 
							'line-height' => '40px'
						),
					),
					
                ),
            );


            $this->sections[] = array(
                'type' => 'divide',
            );

			$this->sections[] = array(
                'title' => 'Erweitert',
                'icon' => 'el-icon-edit',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields' => array(
                    array(
                        'id' => 'tocki_redux_code_css',
                        'type' => 'ace_editor',
                        'title' => 'Zusätzliches CSS',
                        'subtitle' => 'Übrschreibt die Vorgaben aus dem Template.',
                        'mode' => 'css',
                        'theme' => 'monokai'
                    ),
                    array(
                        'id' => 'tocki_redux_code_css_840',
                        'type' => 'ace_editor',
                        'title' => 'CSS max-width: 840px',
                        'subtitle' => 'Erste responsive-Stufe',
						'default' => '@media all and (max-width: 840px) {
	
}',
                        'mode' => 'css',
                        'theme' => 'monokai'
                    ),
                    array(
                        'id' => 'tocki_redux_code_css_500',
                        'type' => 'ace_editor',
                        'title' => 'CSS max-width: 500px',
                        'subtitle' => 'Erste responsive-Stufe',
						'default' => '@media all and (max-width: 500px) {
	
}',
                        'mode' => 'css',
                        'theme' => 'monokai'
                    ),
                    array(
                        'id' => 'tocki_redux_code_header',
                        'type' => 'ace_editor',
                        'title' => 'Header Code',
                        'subtitle' => 'JavaScript etc. im Header',
                        'mode' => 'html',
                        'theme' => 'monokai'
                    ),
                    array(
                        'id' => 'tocki_redux_code_footer',
                        'type' => 'ace_editor',
                        'title' => 'Footer Code',
                        'subtitle' => 'JavaScript etc. im Footer',
                        'mode' => 'html',
                        'theme' => 'monokai'
                    ),
                    array(
                        'id' => 'tocki_redux_codeextend',
                        'type' => 'switch',
                        'title' => 'Badge',
						'subtitle' => 'Soll ein Aktions-Bagdge im Header angezeigt werden?',
						'default' => false
                    ),
                    array(
                        'id' => 'tocki_redux_code_badge_css',
                        'required' => array('tocki_redux_codeextend', 'equals', '1'),
                        'type' => 'ace_editor',
                        'title' => 'Badge - CSS',
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'default' => '.badge {
	position: absolute;
	top: 0;
	left: 430px;
	z-index: 15;
}',
                    ),
                    array(
                        'id' => 'tocki_redux_code_badge_html',
                        'required' => array('tocki_redux_codeextend', 'equals', '1'),
                        'type' => 'ace_editor',
                        'title' => 'Badge - Quellcode',
                        'mode' => 'html',
                        'theme' => 'monokai',
                        'default' => '<div class="badge">
	<img src="..">
</div>',
                    ),
                    array(
                        'id' => 'section-mobile-erweitert-start',
                        'required' => array('tocki_redux_mobile_switcher', 'equals', '1'),
                        'type' => 'section',
                        'title' => '<br>mobile Version',
						'subtitle' => 'Um die Einstellungen vornehmen zu können muss die Browserweiche unter "Theme Einstellungen" aktiviert werden.',
                        'indent' => false // Indent all options below until the next 'section' option is set.
                    ),
                    array(
                        'id' => 'tocki_redux_mobile_css',
                        'required' => array('tocki_redux_mobile_switcher', 'equals', '1'),
                        'type' => 'ace_editor',
                        'title' => 'Badge - CSS',
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'title' => 'zusätzliches CSS - mobile Site',
                    ),
					
					
                ),
            );

/* ------------------------------------------------ ENDE ------------------------------------ */








            $theme_info = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'redux-framework-demo') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'redux-framework-demo') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'redux-framework-demo') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'redux-framework-demo') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            if (file_exists(dirname(__FILE__) . '/../README.md')) {
                $this->sections['theme_docs'] = array(
                    'icon' => 'el-icon-list-alt',
                    'title' => __('Documentation', 'redux-framework-demo'),
                    'fields' => array(
                        array(
                            'id' => '17',
                            'type' => 'raw',
                            'markdown' => true,
                            'content' => file_get_contents(dirname(__FILE__) . '/../README.md')
                        ),
                    ),
                );
            }//if

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon' => 'el-icon-book',
                    'title' => __('Documentation', 'redux-framework-demo'),
                    'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id' => 'redux-opts-1',
                'title' => __('Theme Information 1', 'redux-framework-demo'),
                'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );

            $this->args['help_tabs'][] = array(
                'id' => 'redux-opts-2',
                'title' => __('Theme Information 2', 'redux-framework-demo'),
                'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'tocki_redux_themeoptions', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'), // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
                'menu_type' => 'submenu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true, // Show the sections below the admin menu item or not
                'menu_title' => __('Theme Options', 'redux-framework-demo'),
                'page' => __('Tocki Theme Options', 'redux-framework-demo'),
                'google_api_key' => 'AIzaSyBmxvj356eHsFewIL-uQ06YZITc4lCY1Sc', // Must be defined to add google fonts to the typography module
                //'admin_bar' => false, // Show the panel pages on the admin bar
                'global_variable' => '', // Set a different name for your global variable other than the opt_name
                'dev_mode' => false, // Show the time the page took to load, etc
                'customizer' => true, // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'menu_icon' => '', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'             	=> 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                //'footer_credit'      	=> '', // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => false, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '', // __( '', $this->args['domain'] );            
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.		
/*            $this->args['share_icons'][] = array(
                'url' => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon' => 'el-icon-github'
                    // 'img' => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url' => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon' => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url' => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon' => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url' => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon' => 'el-icon-linkedin'
            );
*/


            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace("-", "_", $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf(__('<p>Die globale Variable für das Template lautet: <strong>$%1$s</strong></p>', 'redux-framework-demo'), $v);
            } else {
                $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo');
            }

            // Add content after the form.
            $this->args['footer_text'] = __('<p>Wordpress Theme Magic Version 2 von Tilman Ockert f&uuml;r RegioHelden :-)</p>', 'redux-framework-demo');
        }

    }

    new Redux_Framework_sample_config();
}


/**

  Custom function for the callback referenced above

 */
if (!function_exists('redux_my_custom_field')):

    function redux_my_custom_field($field, $value) {
        print_r($field);
        print_r($value);
    }

endif;

/**

  Custom function for the callback validation referenced above

 * */
if (!function_exists('redux_validate_callback_function')):

    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';
        /*
          do your validation

          if(something) {
          $value = $value;
          } elseif(something else) {
          $error = true;
          $value = $existing_value;
          $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }


endif;
