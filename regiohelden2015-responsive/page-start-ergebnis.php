<?php
/**
 * Template Name: Start - Ergebnis
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
            
            <div class="start-widget-ergebnis-phone">
            	<h3>Telefonische Beratung:</h3>
					<table width="100%" border="0">
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
        
                    <!--  ----------------------------------------------------------------------  		-->
                    <!--  HINWEIS: Bei diesen Feldern handelt es sich um optionale Elemente für   		-->
                    <!--  die Fehlerbehebung. Kommentieren Sie diese Zeilen aus, wenn Sie einen   		-->
                    <!--  Test im Debug-Modus durchführen möchten.                                		-->
                    <!-- <input type="hidden" name="debug" value=1>                               		-->
                    <!-- <input type="hidden" name="debugEmail" value="tilman.ockert@regiohelden.de"> 	-->
                    <!--  ----------------------------------------------------------------------  		-->
        
                    <div class="sf-input"><label for="last_name">Name *</label><input  id="last_name" name="last_name" type="text" required /></div>
                    <div class="sf-input"><label for="00N20000003iFuE">Telefon *</label><input  id="00N20000003iFuE" name="00N20000003iFuE" type="text" required parsley-trigger="change" parsley-minlength="4" /></div>
                    <div class="sf-input"><label for="email">E-Mail</label><input  id="email" name="email" type="text" /></div>
                    <input type="hidden" name="lead_source" value="RegioHelden.de - Startseite">  
                    <input type="hidden" id="phone" maxlength="40" name="phone" size="20" type="text" value="ka" />   
                    
                    <div class="clearfix"></div>
                    
                    <div class="sf-input sf-submit"><input type="submit" name="submit" value="Kostenlos beraten lassen!"></div>
                </form>
                <div class="clearfix"></div>
			</div>
            <div class="clearfix"></div>
            <span class="start-credit">&sup1; Google Keyword Planner, Daten vom <?php echo date('d.m.Y'); ?></span>
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
