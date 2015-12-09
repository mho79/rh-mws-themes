<?php
if (   $tocki_redux_themeoptions['tocki_redux_mobile_switcher'] == 1
    && !empty($tocki_redux_themeoptions["tocki_redux_mobile_campaign"])
    && is_mobile()
    && !isset($_COOKIE['MobileCookie'])
    ) {
    // A cookie will be set that the user wont be redirected anymore
    setcookie('MobileCookie', 'true');
    $_COOKIE['MobileCookie'] = 'true';
    // Creating of the redirect URL
    $redirect_url = get_permalink( $post->ID ) . '?campaignId=' . $tocki_redux_themeoptions["tocki_redux_mobile_campaign"];
    // Redirect
    wp_redirect( $redirect_url, 301 ); exit;
} else { 
    get_header(); ?>

    <section class="content">
        <?php if ( have_posts() ) : ?>
			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Suchergebnisse für: %s', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>

			...
		<?php else : ?>
			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title">Leider keine Ergebnisse zu Ihrer Suche gefunden!</h1>
				</header>

				<div class="entry-content">
					<p>
                        <strong>Vorschläge:</strong>

                        <ul>
                            <li>Achten Sie darauf, dass alle Wörter richtig geschrieben sind.</li>
                            <li>Probieren Sie es mit anderen Suchbegriffen.</li>
                            <li>Probieren Sie es mit allgemeineren Suchbegriffen.</li>
                        </ul>
                    </p>

					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
		<?php endif; ?>
    </section> <!-- /content -->

    <aside class="sidebar sidebar-desktop">
        <?php get_sidebar(); ?>
    </aside> <!-- /sidebar -->

    <?php get_footer();
} ?>