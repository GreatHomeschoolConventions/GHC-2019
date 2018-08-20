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

			<div class="content">

			<?php echo do_shortcode( '[locations_map]' );?>

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
