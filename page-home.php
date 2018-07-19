<?php
/**
 * Template Name: Home Page
 *
 * @package GHC
 */

use Samrap\Acf\Acf;

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			$tagline = ACF::field( 'tagline_stripe' )->expect( 'array' )->default( [] )->get();

			if ( ! empty( $tagline ) ) :
				?>
				<ul class="tagline-stripe theme orange bg">
					<div class="container">
					<?php
					foreach ( $tagline as $item ) {
						echo '<li>';
						if ( ! empty( $item['url'] ) ) {
							echo '<a href="' . esc_url( $item['url'] ) . '">';
						}
						echo '<span class="dashicons ' . esc_attr( $item['icon'] ) . '"></span><span class="description">' . esc_attr( $item['text'] ) . '</span>';
						if ( ! empty( $item['url'] ) ) {
							echo '</a>';
						}
						echo '</li>';
					}
					?>
					</div>
				</ul>
			<?php endif; ?>

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
