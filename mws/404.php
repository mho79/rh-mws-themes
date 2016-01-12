<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package MWS_2016
 */
get_header(); ?>

	<div class="row">
		<?php
			$content_class = 'col-lg-8 col-sm-7';
			if (!is_active_sidebar('sidebar-main') || $mws_options['fullwidth']):
				$content_class = 'col-lg-12';
			endif;
		?>
		<main id="main" class="<?php echo $content_class; ?> col-xs-12" role="main">
			<section class="error-404 not-found">
				<header>
					<h1>
						<?php esc_html_e( 'Oops! Seite nicht gefunden.', 'rh' ); ?>
					</h1>
				</header>

				<p><?php esc_html_e( 'Die Seite konnte nicht gefunden werden, vielleicht hilft die Suchfunktion weiter.', 'rh' ); ?></p>

				<?php get_search_form(); ?>
			</section>
		</main>

		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>