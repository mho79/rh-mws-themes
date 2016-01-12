<?php
/**
 * Template Name: Startseite
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

<?php the_content(); ?>


<div class="start-boxen">

	<?php if ( is_active_sidebar( 'start-widget-area' ) ) : ?>
    <div class="start-widgets">
        <?php dynamic_sidebar( 'start-widget-area' ); ?>
        <div class="clearfix"></div>
    </div>
    <?php endif; ?>

</div> <!-- start-boxen -->

<?php endwhile; ?>

<?php get_footer(); ?>