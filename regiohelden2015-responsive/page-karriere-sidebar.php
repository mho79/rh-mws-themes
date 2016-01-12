<?php
/**
 * Template Name: Karriere mit Sidebar
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

<?php if ( is_active_sidebar( 'karriere-widget-area' ) ) : ?>
	<div class="sidebar">
		<?php dynamic_sidebar( 'karriere-widget-area' ); ?>
	</div>
<?php endif; ?>

<div id="content" class="wrapper">
<div class="main-content" id="content-mit-sidebar">


	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<?php
	global $post;
	$children = get_pages( array( 'child_of' => $post->ID ) );
	if ( is_page() && $post->post_parent ) : ?>
		<div class="navi-pusher"></div>
	<?php elseif ( is_page() && count( $children ) > 0 ) : ?>
		<div class="navi-pusher"></div>
	<?php else : ?>
		<!-- nix -->
	<?php endif; ?>

	<?php
	// Must be inside a loop.
	/*
	if ( has_post_thumbnail() ) {
		the_post_thumbnail();
	}
	else {
		echo '';
	} */
	?>
	    <?php the_content(); ?>
	    <?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>

		<?php // comments_template( '', true ); ?>

	</div> <!-- main-content -->

	<?php endwhile; ?>


</div>
</div> <!-- content -->
	<div class="clearfix"></div>
<?php get_footer(); ?>