<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package RH_MWS_2015
 */

?>

<section class="no-results not-found">
	<header>
		<h1><?php esc_html_e( 'Nichts gefunden', 'rh' ); ?></h1>
	</header>

	<div class="page-content">
		<?php if ( is_search() ) : ?>
			<p><?php esc_html_e( 'Sorry, deine Suche hat keine Ergebnisse zurückgeliefert. Probier es doch mit einem anderen Suchbegriff nocheinmal.', 'rh' ); ?></p>
			
			<?php get_search_form(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Der gesuchte Inhalt konnte nicht gefunden werden, vielleicht hilft die Suchfunktion weiter.', 'rh' ); ?></p>
			
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</section>
