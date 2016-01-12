<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

<?php if ( is_active_sidebar( 'presse-widget-area' ) ) : ?>
<div class="sidebar">
	<?php dynamic_sidebar( 'presse-widget-area' ); ?>
</div>
<?php endif; ?>

<div id="content" class="wrapper">
	<div class="main-content" id="content-mit-sidebar">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<?php // previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'twentyten' ) . ' %title' ); ?>
		<?php // next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '' ); ?>

		<h1><?php the_title(); ?></h1>
		<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
		<?php // twentyten_posted_on(); ?>

		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>

		<?php // previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'twentyten' ) . ' %title' ); ?> 

		<!-- <div class="dennis-sep-line" style="margin: 20px 0 20px 0;"></div> -->
		<a href="/pressebereich/" title="RegioHelden Pressespiegel" class="read-more"><i class="fa fa-angle-double-left"></i> Zurück zum Pressebereich</a> 
		<?php // next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '' ); ?>

		<?php // comments_template( '', false ); ?>

		<?php endwhile; // end of the loop. ?>

		<?php // twentyten_posted_in(); ?>
		<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>

	</div> <!-- content -->

	<div class="clearfix"></div>
</div> <!-- contentwrapper -->


<?php // get_sidebar(); ?>
<?php get_footer(); ?>