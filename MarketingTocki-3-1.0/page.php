<?php 
if (   $tocki_redux_themeoptions['tocki_redux_mobile_switcher'] == 1
    && !empty($tocki_redux_themeoptions["tocki_redux_mobile_campaign"])
    && is_mobile()
    && !isset($_COOKIE['MobileCookie'])
    ) {
    // A cookie will be set that the user won't be redirected anymore
    setcookie('MobileCookie', 'true');
    $_COOKIE['MobileCookie'] = 'true';
    // Creating of the redirect URL
    $redirect_url = get_permalink( $post->ID ) . '?campaignId=' . $tocki_redux_themeoptions["tocki_redux_mobile_campaign"];
    // Redirect
    wp_redirect( $redirect_url, 301 );
    exit;
} else { 
    get_header(); ?>

    <section class="content">
        <?php if ( have_posts() ) while ( have_posts() ) : the_post();
            the_content();
            edit_post_link( __( 'Edit', 'twentyten' ), '', '' );
        endwhile; ?>
    </section> <!-- /content -->

    <aside class="sidebar sidebar-desktop">
        <?php get_sidebar(); ?>
    </aside> <!-- /sidebar -->
    
    <?php get_footer();
} ?>