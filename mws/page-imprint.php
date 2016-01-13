<?php
/**
 * Template Name: Impressum
 * The template for displaying the imprint.
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package MWS_2016
 */
get_header(); ?>

	<div class="row">
		<main id="main" class="col-xs-12" role="main">
			<header>
				<?php the_title( '<h1>', '</h1>' ); ?>
			</header>

			<div class="row">
				<div class="col-md-4 col-sm-6 col-xs-12">
					<?php
						if(!empty($mws_options['imprint_col_1'])) {
							echo nl2br($mws_options['imprint_col_1']);
						}
					?>
				</div>

				<div class="col-md-4 col-sm-6 col-xs-12">
					<?php
						if(!empty($mws_options['imprint_col_2'])) {
							echo nl2br($mws_options['imprint_col_2']);
						}
					?>
				</div>

				<div class="col-md-4 col-sm-6 col-xs-12">
					<?php
						if(!empty($mws_options['imprint_col_3'])) {
							echo nl2br($mws_options['imprint_col_3']);
						}
					?>
				</div>
			</div>
		</main>
	</div>

<?php get_footer(); ?>