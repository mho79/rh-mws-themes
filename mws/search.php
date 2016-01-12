<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
			<?php if ( have_posts() ) : ?>
				<header>
					<h1><?php printf( esc_html__( 'Suchergebnisse für: %s', 'rh' ), '<i>' . get_search_query() . '</i>' ); ?></h1>
				</header><!-- .page-header -->

				<?php while ( have_posts() ) : the_post();
					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );
				endwhile;
				
				rh_the_posts_navigation();
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif; ?>
		</main>

		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>
