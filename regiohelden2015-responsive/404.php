<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

<div class="error-404-wrapper">

    <div class="error-404-content">
                <h1>Ups...</h1>
                <p>Leider ist die Seite nicht (mehr) verfügbar. Nehmen Sie doch eine andere, wir haben genug davon. Hier ist eine zufällig für Sie ausgewählte:</p>
                <br />
                <?php
                $args=array(
                  'orderby' => 'rand',
                  'post_type' => 'page',
                  'post_status' => 'publish',
                  'posts_per_page' => 1,
                  'caller_get_posts'=> 1
                );
                $my_query = null;
                $my_query = new WP_Query($args);
                if( $my_query->have_posts() ) {
                  echo '';
                  while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <a class="awesome large" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    <?php
                  endwhile;
                }
                wp_reset_query();  // Restore global post data stomped by the_post().
                ?>
                
                <div class="clearfix"></div>
    </div>
</div>

<?php get_footer(); ?>