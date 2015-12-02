<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
get_header();
?>

<section class="content error-404">
    <h1><?php _e( 'Not Found', 'twentyten' ); ?></h1>
	<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'twentyten' ); ?></p>
	<?php get_search_form(); ?>
</section> <!-- /content -->

<aside class="sidebar sidebar-desktop">
        <?php get_sidebar(); ?>
    </aside> <!-- /sidebar -->

<script>
	// focus on search field after it has loaded
	document.getElementById('s').focus();
</script>

<?php get_footer(); ?>