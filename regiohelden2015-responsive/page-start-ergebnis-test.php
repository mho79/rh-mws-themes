<?php
/**
 * Template Name: Start - Ergebnis - Test
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
        <div class="start-widget-ergebnis">
            <?php dynamic_sidebar( 'start-widget-area' ); ?>
            <div class="clearfix" style="height: 35px;"></div>
            
            <div class="salesforce-form" style="width: 860px; float: left;">
                <h1>Analysieren Sie jetzt das Potential Ihrer Website!</h1>
                Im nächsten Schritt sehen Sie mit Hilfe unseres kostenlosen Analyse-Tools umfangreiche Informationen zu Ihrer Platzierung bei Google und wie gut Ihre Website im Vergleich zu anderen aus Ihrer Branche ist.
                <br /><br />
                <form action="https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST" parsley-validate novalidate parsley-focus="first">
                    <input type=hidden name="oid" value="00D20000000KnRL">
                    <input type=hidden name="retURL" value="http://www.regiohelden.de/start/pagerank-ergebnis/">
        
                    <!--  ----------------------------------------------------------------------  		-->
                    <!--  HINWEIS: Bei diesen Feldern handelt es sich um optionale Elemente für   		-->
                    <!--  die Fehlerbehebung. Kommentieren Sie diese Zeilen aus, wenn Sie einen   		-->
                    <!--  Test im Debug-Modus durchführen möchten.                                		-->
                    <!-- <input type="hidden" name="debug" value=1>                               		-->
                    <!-- <input type="hidden" name="debugEmail" value="tilman.ockert@regiohelden.de"> 	-->
                    <!--  ----------------------------------------------------------------------  		-->
                            
                    <div class="sf-input" style="padding-top: 10px;"><label for="URL" style="color: #58585a; font-size: 18px; padding-top: 15px;">Ihre Website</label><input id="URL" name="URL" type="text" placeholder="http://" style="width: 360px; padding: 14px 5px; margin: 0 10px; background: #fff; color: #000; border: #b1b3b4 1px solid; font-weight: 400; font-size: 18px;" /></div>
                    <input type="hidden" name="lead_source" value="RegioHelden.de - stealth-mode">  
                    <input type="hidden" id="phone" maxlength="40" name="phone" size="20" type="text" value="ka" />
                    
                    <div class="sf-input sf-submit"><input style="margin: 0 0 0 50px; width: 292px; font-size: 18px; font-weight: 400;" type="submit" name="submit" value="Zur Auswertung"></div>
                </form>
                <div class="clearfix" style="height: 50px;"></div>
            </div>
            
            
            
            <div class="clearfix"></div>
            <span class="start-credit">* Google Keyword Planner, Daten vom <?php echo date('d.m.Y'); ?></span>
        </div>
        <?php endif; ?>

        <?php the_content(); ?>

	<?php // comments_template( '', true ); ?>
    
    <?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>

</div> <!-- main-content -->

<?php endwhile; ?>



<div class="clearfix"></div>

</div> <!-- content -->

<?php get_footer(); ?>
