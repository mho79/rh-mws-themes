<?php
/**
 * Template Name: Start - Seitwert-Ausgabe
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

<?php $auswertung = $GLOBALS["websiteauswertung"]; ?>

<!-- ##############################  SalesForce Mailer ##############################  -->

<?php $keyword_to_sf = 'Keyword1: ';
	$keyword_to_sf .= $_POST["search_volume_keyword1"];
	$keyword_to_sf .= ' - Keyword2: ';
	$keyword_to_sf .= $_POST["search_volume_keyword2"];?>

<?php $url = 'https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
$data = array('oid' => '00D20000000KnRL', 
			'URL' => $_POST["URL"], 
			'lead_source' => 'Website Check', 
			'phone' => 'ka',  
			'state' => 'UN', 
			'country' => 'Deutschland',
			'email' => $_POST["email"], 
			'00N20000003iFuE' => $keyword_to_sf
			);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
?>

<!-- ##############################  /SalesForce Mailer ##############################  -->

<div id="" class="wrapper">


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="main-content">

<?php $PostURL = $_POST["URL"]; 
$PostMail = $_POST["email"]; 
$umlauts = "Ŕ,Á,Â,Ă,Ä,Ĺ,Ç,Č,É,Ę,Ë,Ě,Í,Î,Ď,Ň,Ó,Ô,Ő,Ö,Ř,Ů,Ú,Ű,Ü,Ý,ŕ,á,â,ă,ä,ĺ,ç,č,é,ę,ë,ě,í,î,ď,đ,ň,ó,ô,ő,ö,ř,ů,ú,ű,ü,ý,˙,Ń,ń";
$umlauts = explode(",", $umlauts);
?>

<?php foreach($umlauts as $umlaut){
    if (false !== (strpos($PostURL, $umlaut))){ // URL enthält einen Umlaut ?>

		<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/RegioHelden-WebAnalyse-Screen.png" />

        <div class="start-widget-ergebnis" style="
        									margin-top: 0px; 
                                            background: #f28722; 
                                            position: relative; 
                                            -moz-box-shadow: none;
                                            -webkit-box-shadow: none;
                                            box-shadow: none;
                                            position: relative;
                                            z-index: 0;
                                            ">
            
            <div class="salesforce-form" style="width: 860px; float: left;">
                <h1 style="color: #fff;">Domains mit Umlauten werden nicht unterstützt</h1>
                <span style="color: #fbd9b9;">Leider können wir Websites, die einen Umlaute enthalten, aus technischen Gründen nicht prüfen.</span>
                <br /><br />
                    <form action="http://www.regiohelden.de/start/website-analyse" method="post">
                    <div class="sf-input" style="padding-top: 0px;"><label for="URL" style="color: #fff; font-size: 18px; padding-top: 15px;">Ihre Website</label><input id="URL" name="URL" type="text" placeholder="" style="width: 360px; padding: 14px 5px; margin: 0 10px; background: #fff; color: #000; border: #b1b3b4 1px solid; font-weight: 400; font-size: 18px;" /></div>
                    
                    <input type=hidden name="search_volume_keyword1" value="<?php echo htmlspecialchars($_POST["search_volume_keyword1"]); ?>">
                    <input type=hidden name="search_volume_keyword2" value="<?php echo htmlspecialchars($_POST["search_volume_keyword2"]); ?>">
                    
                    <div class="sf-input sf-submit"><input style="margin: 0 0 0 50px; width: 292px; font-size: 18px; font-weight: 400;" type="submit" name="submit" value="Zur Auswertung"></div>
                </form>
                
                <div class="clearfix" style="height: 5px;"></div>
            </div>
            <div class="clearfix"></div>
        </div>

<?php }} // Ende Abfrage nach Umaluten in der URL ?>
        
<?php if (strpos($PostURL,'https') !== false) { // URL enthält https ?>

		<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/RegioHelden-WebAnalyse-Screen.png" />

        <div class="start-widget-ergebnis" style="
        									margin-top: 0px; 
                                            background: #f28722; 
                                            position: relative; 
                                            -moz-box-shadow: none;
                                            -webkit-box-shadow: none;
                                            box-shadow: none;
                                            position: relative;
                                            z-index: 0;
                                            ">
            
            <div class="salesforce-form" style="width: 860px; float: left;">
                <h1 style="color: #fff;">Leider wird "https://" nicht unterstützt</h1>
                <span style="color: #fbd9b9;">Gerne können Sie Seiten ohne "https://" analysieren lassen. Aus technischen Gründen können wir Websites, die eine verschlüsselte Datenübertragung erfordern, nicht prüfen.</span>
                <br /><br />
                    <form action="http://www.regiohelden.de/start/website-analyse" method="post">
                    <div class="sf-input" style="padding-top: 0px;"><label for="URL" style="color: #fff; font-size: 18px; padding-top: 15px;">Ihre Website</label><input id="URL" name="URL" type="text" placeholder="" style="width: 360px; padding: 14px 5px; margin: 0 10px; background: #fff; color: #000; border: #b1b3b4 1px solid; font-weight: 400; font-size: 18px;" /></div>
                    
                    <input type=hidden name="search_volume_keyword1" value="<?php echo htmlspecialchars($_POST["search_volume_keyword1"]); ?>">
                    <input type=hidden name="search_volume_keyword2" value="<?php echo htmlspecialchars($_POST["search_volume_keyword2"]); ?>">
                    
                    <div class="sf-input sf-submit"><input style="margin: 0 0 0 50px; width: 292px; font-size: 18px; font-weight: 400;" type="submit" name="submit" value="Zur Auswertung"></div>
                </form>
                
                <div class="clearfix" style="height: 5px;"></div>
            </div>
            <div class="clearfix"></div>
        </div>		

<?php } elseif (empty($PostURL)) { // URL ist 0, nicht mit einem Wert belegt, oder nicht gesetzt ?>

		<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/RegioHelden-WebAnalyse-Screen.png" />

        <div class="start-widget-ergebnis" style="
        									margin-top: 0px; 
                                            background: #f28722; 
                                            position: relative; 
                                            -moz-box-shadow: none;
                                            -webkit-box-shadow: none;
                                            box-shadow: none;
                                            position: relative;
                                            z-index: 0;
                                            ">
            
            <div class="salesforce-form" style="width: 860px; float: left;">
                <h1 style="color: #fff;">Analysieren Sie jetzt das Potential Ihrer Website!</h1>
                <span style="color: #fbd9b9;">Im nächsten Schritt sehen Sie mit Hilfe unseres kostenlosen Analyse-Tools umfangreiche Angaben zu Ihrer Website, der Gewichtung bei Google und wie gut Ihre Website im Vergleich zu anderen aus Ihrer Branche ist.</span>
                <br /><br />
                    <form action="http://www.regiohelden.de/start/website-analyse" method="post">
                    <div class="sf-input" style="padding-top: 0px;"><label for="URL" style="color: #fff; font-size: 18px; padding-top: 15px;">Ihre Website</label><input id="URL" name="URL" type="text" placeholder="" style="width: 360px; padding: 14px 5px; margin: 0 10px; background: #fff; color: #000; border: #b1b3b4 1px solid; font-weight: 400; font-size: 18px;" /></div>
                    
                    <input type=hidden name="search_volume_keyword1" value="<?php echo htmlspecialchars($_POST["search_volume_keyword1"]); ?>">
                    <input type=hidden name="search_volume_keyword2" value="<?php echo htmlspecialchars($_POST["search_volume_keyword2"]); ?>">
                    
                    <div class="sf-input sf-submit"><input style="margin: 0 0 0 50px; width: 292px; font-size: 18px; font-weight: 400;" type="submit" name="submit" value="Zur Auswertung"></div>
                </form>
                
                <div class="clearfix" style="height: 5px;"></div>
            </div>
            <div class="clearfix"></div>
        </div>

<?php } else { // URL ist gesetzt ?>
                
                <div class="row-fluid">          
                        <div class="wpb_content_element span12 cta wpb_text_column">
                            <h1 style="margin-top: 0;"><span style="color: #58585a;">Ihre Auswertung für</span> <?php echo htmlspecialchars($_POST["URL"]); ?></h1>
                            <div class="clearfix"></div>
                            <div style="width: 450px; float: left; margin: 0;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="238px" > 
                                    RegioHelden Wertung<br />
                                    Gewichtung bei Google<br />
                                    Bekanntheit im Internet<br />
                                    Social Media Aktivitäten<br />
                                    Technische Bewertung<br />
                                    Externe Verlinkungen</span>
                                </td>
                                <td> 
                                    <span style="color: #f28722;"><?php echo $auswertung["seitwert"]["ergebnis"]." von ".$auswertung["seitwert"]["max"]." Punkten"; ?></span><br />
                                    <span style="color: #f28722;"><?php echo $auswertung["google"]["ergebnis"]." von ".$auswertung["google"]["max"]." Punkten"; ?></span><br />
                                    <span style="color: #f28722;"><?php echo $auswertung["alexa"]["ergebnis"]." von ".$auswertung["alexa"]["max"]." Punkten"; ?></span><br />
                                    <span style="color: #f28722;"><?php echo $auswertung["social"]["ergebnis"]." von ".$auswertung["social"]["max"]." Punkten"; ?></span><br />
                                    <span style="color: #f28722;"><?php echo $auswertung["technical"]["ergebnis"]." von ".$auswertung["technical"]["max"]." Punkten"; ?></span><br />
                                    <span style="color: #f28722;"><?php echo $auswertung["yahoo"]["ergebnis"]." von ".$auswertung["yahoo"]["max"]." Punkten"; ?></span>
                                </td>
                              </tr>
                            </table>
                
                               
                            </div>




                            <div style="width: 322px; height:200px; float: right; margin: 0;">
                    <?php 
                         if (false !== (strpos($PostURL, 'http'))) {
                            echo "<div id='url-screenshot'><iframe id='frame' src='";
                            echo htmlspecialchars($_POST["URL"]);
                            echo "'></iframe></div>";
                         }
                         else {
                            echo "<div id='url-screenshot'><iframe id='frame' src='http://";
                            echo htmlspecialchars($_POST["URL"]);
                            echo "'></iframe></div>";
                         }

                     ?>
                            </div>
                            <div class="clearfix"></div>
                        </div> <!-- /cta -->
                </div>
                
                <div class="row-fluid">        
                        <div class="wpb_content_element span6 cta cta-special wpb_text_column" style="height: 550px; background: <?php bloginfo( 'stylesheet_directory' ); ?>/images/loading.gif; background-position:center center;">
                            <h2 style="margin: 0 0 12px 0;">Ihre RegioHelden Wertung</h2>
                            <div id="donutchart1" style=""></div>
                            <span style="margin-top: -10px; font-size: 15px; float: left; line-height: 20px;"><b>RegioHelden Wertung: </b><?php echo $auswertung["seitwert"]["ergebnis"]." von ".$auswertung["seitwert"]["max"]." Punkten"; ?><br />Dies ist der Gesamtwert der einzelnen Bewertungskriterien plus weiterer Kriterien, wie das Alter der Website  oder die Wikipedia Referenz.</span>
                        </div> <!-- /cta -->
                               
                        <div class="wpb_content_element span6 cta cta-special wpb_text_column" style="height: 550px; background: <?php bloginfo( 'stylesheet_directory' ); ?>/images/loading.gif; background-position:center center;">        
                            <h2 style="margin: 0 0 12px 0;">Gewichtung bei Google</h2>
                            <div id="donutchart2" style=""></div>
                            <span style="margin-top: -10px; font-size: 15px; float: left; line-height: 20px;"><b>Gewichtung bei Google: </b><?php echo $auswertung["google"]["ergebnis"]." von ".$auswertung["google"]["max"]." Punkten"; ?><br />Dieser Wert wird durch die Positionierung bei Google, die Anzahl der Seitenaufrufe und durch externe Links, die auf die eingegebene Seite führen, beeinflusst.</span>
                        </div> <!-- /cta -->
                </div>
                
                <div class="row-fluid">      
                        <div class="wpb_content_element span6 cta cta-special wpb_text_column" style="height: 550px; background: <?php bloginfo( 'stylesheet_directory' ); ?>/images/loading.gif; background-position:center center;">
                            <h2 style="margin: 0 0 12px 0;">Bekanntheit im Internet</h2>
                            <div id="donutchart3" style=""></div>
                            <span style="margin-top: -10px; font-size: 15px; float: left; line-height: 20px;"><b>Bekanntheit im Internet: </b><?php echo $auswertung["alexa"]["ergebnis"]." von ".$auswertung["alexa"]["max"]." Punkten"; ?><br />Zeigt die Zugriffszahlen der letzten Tage und Wochen für D-A-CH, das Suchmaschinenranking und externe Verlinkungen.</span>
                        </div> <!-- /cta -->
                               
                        <div class="wpb_content_element span6 cta cta-special wpb_text_column" style="height: 550px; background: <?php bloginfo( 'stylesheet_directory' ); ?>/images/loading.gif; background-position:center center;">        
                            <h2 style="margin: 0 0 12px 0;">Social Media Aktivitäten</h2>
                            <div id="donutchart4" style=""></div>
                            <span style="margin-top: -10px; font-size: 15px; float: left; line-height: 20px;"><b>Social Media Aktivitäten: </b><?php echo $auswertung["social"]["ergebnis"]." von ".$auswertung["social"]["max"]." Punkten"; ?><br />Durchsucht z.B. Fan-Seiten auf Facebook und misst die Aktivität wie Likes und Kommentare. Des Weiteren fließen Twitter und Google+ Aktivitäten hinein.</span>
                        </div> <!-- /cta -->
                </div>
                
                <div class="row-fluid">        
                        <div class="wpb_content_element span6 cta cta-special wpb_text_column" style="height: 550px; background: <?php bloginfo( 'stylesheet_directory' ); ?>/images/loading.gif; background-position:center center;">
                            <h2 style="margin: 0 0 12px 0;">Technische Bewertung</h2>
                            <div id="donutchart5" style=""></div>
                            <span style="margin-top: -10px; font-size: 15px; float: left; line-height: 20px;"><b>Technische Bewertung: </b><?php echo $auswertung["technical"]["ergebnis"]." von ".$auswertung["technical"]["max"]." Punkten"; ?><br />Dieser Wert wird durch die Programmiercodes, Metadaten und Formatierungen bzw. den Seitenaufbau beeinflusst.</span>
                        </div> <!-- /cta -->
                               
                        <div class="wpb_content_element span6 cta cta-special wpb_text_column" style="height: 550px; background: <?php bloginfo( 'stylesheet_directory' ); ?>/images/loading.gif; background-position:center center;">        
                            <h2 style="margin: 0 0 12px 0;">Externe Verlinkungen</h2>
                            <div id="donutchart6" style=""></div>
                            <span style="margin-top: -10px; font-size: 15px; float: left; line-height: 20px;"><b>Externe Verlinkungen: </b><?php echo $auswertung["yahoo"]["ergebnis"]." von ".$auswertung["yahoo"]["max"]." Punkten"; ?><br />Misst Nennungen auf externen Seiten und weiteren Suchmaschinen, die mit einem Link auf die entsprechende Zielseite führen (Kooperationspartner, Presse, Blogs…).</span>
                        </div> <!-- /cta -->
                </div>
                <span style="margin-top: -15px; font-size: 12px; float: right;">Daten vom <?php echo date('d.m.Y'); ?> | Quelle: <a href="http://www.seitwert.de/" target="_blank"><img style="margin: -10px 0 0 7px;" src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/seitwert-logo.gif" /></a></span>
                        
                        <div class="clearfix"></div>
                        <?php the_content(); ?>
                        
                    <?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>	
                
                    <?php // comments_template( '', true ); ?>
                

<?php } // Ende: URL ist gesetzt?>


</div> <!-- main-content -->

<?php endwhile; ?>

</div> <!-- content -->

<!--  // ADWORDS KAMPAGNE STUTTGART //  Google Code for Lauri Tool Schritt 2 Conversion Page -->
	<script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 976942188;
    var google_conversion_language = "en";
    var google_conversion_format = "2";
    var google_conversion_color = "ffffff";
    var google_conversion_label = "LkdpCPSfrQkQ7Ojr0QM";
    
    var google_remarketing_only = false;
    /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
    <div style="display:inline;">
    <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/976942188/?label=LkdpCPSfrQkQ7Ojr0QM&amp;guid=ON&amp;script=0"/>
    </div>
    </noscript>

<?php get_footer(); ?>