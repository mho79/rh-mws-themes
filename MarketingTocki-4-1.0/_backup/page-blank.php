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
 ?>
<?php get_header(); ?>
<section class="content">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<!-- <h1><?php the_title(); ?></h1> -->
	<?php the_content(); ?>
	<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
<?php endwhile; ?>
</section> <!-- /content -->
<?php get_footer(); ?>