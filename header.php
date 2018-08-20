<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GHC
 */

use Samrap\Acf\Acf;

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ghc' ); ?></a>

	<header id="masthead" class="site-header" style="background-image: url(<?php echo esc_url( ghc_post_thumbnail_url() ); ?>);">
		<div class="site-branding">
			<div class="container">
				<?php the_custom_logo(); ?>
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					<br/><span class="meta">an outreach event of the <a href="https://www.ncll.org/">National Center for Life and Liberty</a> | #GHC2019</span>
				</h1>

				<nav id="top-navigation" class="main-navigation">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'top-menu',
						'menu_id'        => 'top-menu',
					) );
					?>
				</nav><!-- #site-navigation -->
			</div><!-- .container -->
		</div><!-- .site-branding -->

		<div class="header">
			<div class="container">
				<?php

				// Get default title.
				if ( is_singular() ) {
					$default_title = get_the_title();
				} elseif ( is_archive() ) {
					$default_title = get_the_archive_title();
				}

				// Get custom title.
				$title       = ACF::field( 'page_title' )->default( $default_title )->get();
				$subtitle    = ACF::field( 'page_subtitle' )->default( '' )->get();
				$button_url  = ACF::field( 'button_url' )->default( '' )->escape( 'esc_url' )->get();
				$button_text = ACF::field( 'button_text' )->default( '' )->escape( 'esc_attr' )->get();

				// Get locations titles.
				if ( is_singular( 'location' ) ) {
					$ghc_base    = GHC_Base::get_main_instance();
					$title       = get_field( 'convention_short_name' ) . ' Homeschool Convention';
					$subtitle    = $ghc_base->format_date_range( get_field( 'begin_date' ), get_field( 'end_date' ), 'Ymd' );
					$button_url  = '#register';
					$button_text = 'Don&rsquo;t Miss Out!';
				}

				// Add custom hard-coded headers.
				if ( is_tax( 'ghc_special_tracks_taxonomy' ) ) {
					echo '<h2 class="subtitle">Special Track</h2>';
				} elseif ( is_singular( 'speaker' ) ) {
					echo '<h2 class="subtitle">Speaker</h2>';
				}

				if ( ! empty( $title ) ) {
					echo '<h1 class="title">' . $title . '</h1>'; // WPCS: XSS ok because it’s escaped above.
				}

				if ( ! empty( $subtitle ) ) {
					echo '<h2 class="subtitle">' . $subtitle . '</h2>'; // WPCS: XSS ok because it’s escaped above.
				}

				if ( ! empty( $button_url ) && ! empty( $button_text ) ) {
					echo '<p><a class="button" href="' . $button_url . '">' . $button_text . '</a></p>'; // WPCS: XSS ok because it’s escaped above.
				}

				?>
			</div>
		</div>
	</header><!-- #masthead -->

	<nav id="site-navigation" class="main-navigation">
		<div class="container">
			<button class="menu-toggle dashicons-before dashicons-menu" aria-controls="primary-menu" aria-expanded="false" title="Menu"></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary-menu',
				'menu_id'        => 'primary-menu',
			) );
			?>
		</div>
	</nav><!-- #site-navigation -->

	<div id="content" class="site-content">
