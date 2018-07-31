<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package GHC
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_description( '<div class="archive-description container">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="content">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			?>

			</div>

			<?php

			if ( in_array( get_post_type(), array( 'exhibitor', 'hotel', 'speaker', 'special_event' ), true ) ) {
				echo '<p class="pages">' . paginate_links( array( 'show_all' => true ) ) . '</p>';
			} else {
				the_posts_navigation();
			}

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
