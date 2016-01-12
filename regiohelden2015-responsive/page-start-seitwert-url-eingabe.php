<?php
/**
 * Template Name: Start - Seitwert-URL-Eingabe
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

<div id="content" class="wrapper">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php
// Must be inside a loop.

if ( has_post_thumbnail() ) {
	the_post_thumbnail();
}
else {
	echo '';
}
?>

<div class="main-content">
    
		<?php if ( is_active_sidebar( 'start-widget-area' ) ) : ?>
        <div class="start-widget-ergebnis" style="position: relative;">
        <div style="position: absolute; top: -15px; left: -15px; z-index: 15;">
        	<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/schritt-1.png" />
        </div>
            <?php dynamic_sidebar( 'start-widget-area' ); ?>
            <div class="clearfix" style="height: 5px;"></div>
            <span class="start-credit" style="float: right;">Angaben laut Google Keyword Planner, Daten vom <?php echo date('d.m.Y'); ?></span>
            
        </div>
        <div class="start-widget-ergebnis" style="
        									margin-top: 35px; background: #f28722; position: relative; 
                                            -moz-box-shadow: none;
                                            -webkit-box-shadow: none;
                                            box-shadow: none;
                                            position: relative;
                                            z-index: 0;
                                            ">
        
        <div style="position: absolute; top: -58px; left: -50px; z-index: 15;">
        	<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/schritt-2.png" />
        </div>
            
            <div class="salesforce-form lauri-url-abfrage ausw-box">
                <h1 style="color: #fff; margin-left: 65px;">Analysieren Sie jetzt das Potential Ihrer Website!</h1>
                <span style="color: #fbd9b9;">Im nächsten Schritt sehen Sie mit Hilfe unseres kostenlosen Analyse-Tools umfangreiche Angaben zu Ihrer Website, der Gewichtung bei Google und wie gut Ihre Website im Vergleich zu anderen aus Ihrer Branche ist.</span>
                <br /><br />
                    <form action="http://www.regiohelden.de/start/website-analyse" method="post" parsley-validate novalidate parsley-focus="first">
                    <div class="sf-input" style="padding-top: 0px;"><label for="URL" style="color: #fff; font-size: 18px; padding-top: 15px;">Ihre Website</label><input id="URL" name="URL" type="text" placeholder="" style="" required /></div>
                    
                    <div style="clear: both;"></div>
                    
                    <div class="sf-input" style="padding-top: 0px;"><label for="email" style="color: #fff; font-size: 18px; padding-top: 15px;">Ihre E-Mail</label><input id="email" name="email" placeholder="" style="" type="email" data-parsley-type="email" required /></div>
                    
                    <input type=hidden name="search_volume_keyword1" value="<?php echo htmlspecialchars($_POST["search_volume_keyword1"]); ?>">
                    <input type=hidden name="search_volume_keyword2" value="<?php echo htmlspecialchars($_POST["search_volume_keyword2"]); ?>">
                    
                    <div class="sf-input sf-submit"><input style="ausw-senden" type="submit" name="submit" value="Zur Auswertung"></div>
                </form>
                
                <!--
                <form action="https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST" parsley-validate novalidate parsley-focus="first">
                    <input type=hidden name="oid" value="00D20000000KnRL">
                    <input type=hidden name="retURL" value="http://www.regiohelden.de/start/pagerank-ergebnis/">
                    <div class="sf-input" style="padding-top: 10px;"><label for="URL" style="color: #58585a; font-size: 18px; padding-top: 15px;">Ihre Website</label><input id="URL" name="URL" type="text" placeholder="http://" style="width: 360px; padding: 14px 5px; margin: 0 10px; background: #fff; color: #000; border: #b1b3b4 1px solid; font-weight: 400; font-size: 18px;" /></div>
                    <input type="hidden" name="lead_source" value="RegioHelden.de - stealth-mode">  
                    <input type="hidden" id="phone" maxlength="40" name="phone" size="20" type="text" value="ka" />
                    
                    <div class="sf-input sf-submit"><input style="margin: 0 0 0 50px; width: 292px; font-size: 18px; font-weight: 400;" type="submit" name="submit" value="Zur Auswertung"></div>
                </form>
                -->

<div class="clearfix" style="height: 5px;"></div>
</div>

<div class="clearfix"></div>
</div>
<?php endif; ?>

<?php the_content(); ?>

<?php // comments_template( '', true ); ?>

<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>


</div> <!-- main-content -->

<?php endwhile; ?>

<div class="clearfix"></div>
</div> <!-- content -->

<!-- // ADWORDS KAMPAGNE STUTTGART // Google Code for Lauri Tool Schritt 1 Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 976942188;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "KFH3CIydrQkQ7Ojr0QM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/976942188/?label=KFH3CIydrQkQ7Ojr0QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<?php get_footer(); ?>