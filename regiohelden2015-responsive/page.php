<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
get_header(); ?>

        <?php
        global $post;
        $children = get_pages( array( 'child_of' => $post->ID ) );
        if ( is_page() && $post->post_parent ) : ?>
            <div class="navi-pusher"></div>
        <?php elseif ( is_page() && count( $children ) > 0 ) : ?>
            <div class="navi-pusher"></div>
        <?php else : ?>
            <div class="navi-pusher"></div>
        <?php endif; ?>

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php if ( is_front_page() ) { ?>
		<?php // the_title(); ?>
		<?php } else { ?>	
		<?php // the_title(); ?>
		<?php } ?>				
		

        <?php the_content(); ?>

        <?php endwhile; ?>


<?php // get_sidebar(); ?>
<?php get_footer(); ?>