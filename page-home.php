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

			// Homepage bottom CTA.
			$home_cta = ACF::field( 'bottom_cta' )->get();
			if ( count( $home_cta ) > 0 ) {
				?>
				<div class="home-cta" style="background-image: url(<?php echo esc_url( $home_cta['cta_background_image'] ); ?>)">
					<div class="container">
						<?php echo wp_kses_post( $home_cta['cta_text'] ); ?>
					</div>
				</div>
				<?php
			}

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
