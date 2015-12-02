<?php 
/**
 * Template Name: adwords
 *
 * A custom page to seperate AdWords LP and SEO LP.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
if ((   $tocki_redux_themeoptions['tocki_redux_mobile_switcher'] == 1)
    &&  !empty($tocki_redux_themeoptions["tocki_redux_mobile_campaign"])
    &&  is_mobile()
    &&  !isset($_COOKIE['MobileCookie'])
    ) {
    
    // A cookie will be set that the user wont be redirected anymore
    setcookie('MobileCookie', 'true');
    $_COOKIE['MobileCookie'] = 'true';
    // Creating of the redirect URL
    $redirect_url = get_permalink( $post->ID ) . '?campaignId=' . $tocki_redux_themeoptions["tocki_redux_mobile_campaign"];
    // Redirect
    wp_redirect( $redirect_url, 301 ); exit;
} 
else { 
?>
    <?php get_header(); ?>
    <aside class="sidebar sidebar-desktop">
        <?php get_sidebar(); ?>
    </aside> <!-- /sidebar -->
    <section class="content">
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <!-- <h1><?php the_title(); ?></h1> -->
            <?php the_content(); ?>
            <?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
        <?php endwhile; ?>
    </section> <!-- /content -->
    <aside class="sidebar sidebar-mobile">
        <?php include( TEMPLATEPATH . '/sidebar.php'); ?>
    </aside> <!-- /sidebar -->
    <?php get_footer(); ?>

<?php } ?>