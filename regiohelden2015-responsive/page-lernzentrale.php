<?php
/**
 * Template Name: Lernzentral
 *
 * A custom page template with sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>
<div class="navi-pusher"></div>
<?php if ( is_active_sidebar( 'lernzentrale-widget-area' ) ) : ?>
	<div class="sidebar" id="sidebar-rechts">
		<?php dynamic_sidebar( 'lernzentrale-widget-area' ); ?>
	</div>
<?php endif; ?>

<div id="content" class="wrapper lernzentrale">
<h1><?php echo get_the_title(); ?></h1>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php
global $post;
$children = get_pages( array( 'child_of' => $post->ID ) );
if ( is_page() && $post->post_parent ) : ?>
	<!-- <div class="navi-pusher"></div> -->
<?php elseif ( is_page() && count( $children ) > 0 ) : ?>
	<!-- <div class="navi-pusher"></div> -->
<?php else : ?>
	<!-- nix -->
<?php endif; ?>

<?php
// Must be inside a loop.

if ( has_post_thumbnail() ) {
	the_post_thumbnail();
}
else {
	echo '';
}
?>

<div class="main-content" id="content-mit-sidebar-rechts">

        <?php the_content(); ?>
        <?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>

</div> <!-- main-content -->

<?php endwhile; ?>

<div class="clearfix"></div>

</div> <!-- content -->

<?php get_footer(); ?>