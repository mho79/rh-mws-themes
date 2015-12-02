<?php
/**
 * Template Name: blank
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

<section class="content">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post();
		the_content();
		edit_post_link( __( 'Edit', 'twentyten' ), '', '' );
	endwhile; ?>
</section> <!-- /content -->

<?php get_footer(); ?>