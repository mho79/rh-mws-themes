<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>
<div class="navi-pusher"></div>   
<?php if ( is_active_sidebar( 'presse-widget-area' ) ) : ?>
    <div class="sidebar">
        <?php dynamic_sidebar( 'presse-widget-area' ); ?>
    </div>
<?php endif; ?>

<div id="content" class="wrapper">
<div class="main-content" id="content-mit-sidebar">
<h1>RegioHelden Pressebereich</h1>
<p>In diesem Pressebereich wollen wir Journalisten, Blogger und alle Interessierten mit Infomationen rund um die RegioHelden versorgen. Was machen die RegioHelden eigentlich? Wir schalten und verwalten Werbeanzeigen für lokale Unternehmen und Kunden aus über 50 Branchen, darunter Ärzte, Friseure und Schlüsseldienste. Aktuell sind es mehrere Tausend Google-Kampagnen. Dabei wird für jede Kampagne und die dazu passenden Keywords eine eigene Telefonnummer freigeschaltet. Auf diese Weise können die Kunden über die Anzahl der Telefonanrufe, die Neukunden und damit den Nutzen ihrer Online-Kampagne erfassen - lokale Internetwerbung, die messbar ist.</p>
<?php
// get_template_part( 'loop', 'index' );
?>
<h2><a href="/presse/pressemitteilungen">Die 5 neusten Pressemitteilungen:</a></h2>
<ul>
<?php
$recentposts = get_posts('numberposts=5&category=1');
foreach ($recentposts as $post) :
setup_postdata($post); ?>
<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
<?php endforeach; ?>
</ul>
<a class="read-more overview" href="/presse/pressemitteilungen">Mehr aus diesem Bereich <i class="fa fa-angle-double-right"></i></a>
<h2><a href="/presse/pressenennungen">Die 5 neusten Pressenennungen:</a></h2>
<ul>
<?php
$recentposts = get_posts('numberposts=5&category=162');
foreach ($recentposts as $post) :
setup_postdata($post); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
<?php endforeach; ?>
</ul>
<a class="read-more overview" href="/presse/pressenennungen">Mehr aus diesem Bereich <i class="fa fa-angle-double-right"></i></a>
<br><br>
<div class="cta">
<h3>Ansprechpartner für Presseanfragen</h3>
<img class="size-thumbnail alignright grayscale" style="margin-bottom: 0; margin-left: 21px; margin-top: -26px; border-radius: 100%; height: 100px;width: auto;" src="/wp-content/uploads/sites/1005/2015/08/STROEER_Andrea_Breyther_presse.jpg" alt="Ansprechpartnerin für Presse-Anfragen"><p><strong>Andrea Breyther</strong><br>
PR-Managerin (Ströer SE)</p>
<p>Tel.: +49 22 36. 96 45 - 246<br>
E-Mail: presse@stroeer.de
</p>
<h3>RegioHelden Pressemappe</h3>
<p><br><a href="/wp-content/uploads/2015/05/Pressekit.zip" class="awesome large" target="_blank">Herunterladen (3,3 MB)</a></p>
</div>
</div> <!-- content -->

<div class="clearfix"></div>
</div> <!-- contentwrapper -->





<?php // get_sidebar(); ?>
<?php get_footer(); ?>