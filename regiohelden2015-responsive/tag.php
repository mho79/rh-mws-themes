<?php
/**
 * The template for displaying Tag Archive pages.
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
                <h1><?php
                    printf( __( 'Bekannt aus: %s', 'twentyten' ), '' . single_tag_title( '', false ) . '' );
                ?></h1>

<?php
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */
 get_template_part( 'loop', 'tag' );
?>

<a href="/pressebereich/" title="RegioHelden Pressespiegel" class="read-more"><i class="fa fa-angle-double-left"></i> Zurück zum Pressebereich</a> 

</div> <!-- content -->


    <div class="clearfix"></div>
</div> <!-- contentwrapper -->

<?php get_footer(); ?>