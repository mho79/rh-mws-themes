<?php get_header(); ?>
<aside class="sidebar sidebar-desktop">
    <?php get_sidebar(); ?>
</aside> <!-- /sidebar -->
<section class="content">
    <div>
        <h1>Seite nicht gefunden (404)</h1>
        <p>Die Seite konnte leider nicht gefunden werden. Hier geht es <a href="/">zur Startseite</a>.</p>
    </div>
</section> <!-- /content -->
<aside class="sidebar sidebar-mobile">
    <?php include( TEMPLATEPATH . '/sidebar.php'); ?>
</aside> <!-- /sidebar -->
<?php get_footer(); ?>