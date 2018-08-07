<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GHC
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<nav id="footer-navigation" class="main-navigation">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'bottom-menu-1',
				'menu_id'        => 'bottom-menu-1',
				'menu_class'     => 'bottom-menu',
			) );

			wp_nav_menu( array(
				'theme_location' => 'bottom-menu-2',
				'menu_id'        => 'bottom-menu-2',
				'menu_class'     => 'bottom-menu',
			) );
			?>
		</nav><!-- #site-navigation -->

		<div class="site-info">
			&copy; <?php echo esc_attr( date( 'Y' ) ); ?>
			<span class="sep"> | </span>
			<?php the_privacy_policy_link(); ?>
			<span class="sep"> | </span>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'ghc' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Powered by %s', 'ghc' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme author. */
				printf( esc_html__( 'Theme by %1$s.', 'ghc' ), '<a href="http://www.jcrod.com/">JCRod</a> and <a href="https://andrewrminion.com/">AndrewRMinion Design</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
