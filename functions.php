<?php
/**
 * GHC functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package GHC
 */

require_once 'vendor/autoload.php';
use Samrap\Acf\Acf;

/**
 * Set theme version constant.
 */
define( 'AQD_THEME_VERSION', wp_get_theme()->get( 'Version' ) );

if ( ! function_exists( 'ghc_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ghc_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on GHC, use a find and replace
		 * to change 'ghc' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ghc', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in these locations.
		register_nav_menus( array(
			'primary-menu' => esc_html__( 'Primary', 'ghc' ),
			'top-menu'     => esc_html__( 'Top', 'ghc' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ghc_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'ghc_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ghc_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ghc_content_width', 640 );
}
add_action( 'after_setup_theme', 'ghc_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ghc_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ghc' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ghc' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ghc_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ghc_scripts() {
	wp_enqueue_style( 'ghc-style', get_template_directory_uri() . '/assets/css/style.min.css', array(), AQD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	wp_enqueue_script( 'ghc-navigation', get_template_directory_uri() . '/assets/js/navigation.min.js', array(), AQD_THEME_VERSION, true );

	wp_enqueue_script( 'ghc-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), AQD_THEME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	?>
	<script type="text/javascript">
		WebFontConfig={google:{families:["Montserrat:300,300i,500,500i,600,600i","Sanchez:400,400i"]}},function(e){var t=e.createElement("script"),o=e.scripts[0];t.src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js",t.async=!0,o.parentNode.insertBefore(t,o)}(document);
	</script>
	<?php
}
add_action( 'wp_enqueue_scripts', 'ghc_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Modifies testimonial author HTML.
 *
 * @param  string $content Default author HTML.
 * @param  string $author  Author name.
 *
 * @return string          Modified author HTML.
 */
function ghc_testimonial_custom_author_html( $content, $author ) {
	$content = '<p class="author">&mdash; ' . esc_attr( $author ) . ' &mdash;</p>';
	return $content;
}
add_filter( 'simple_testimonials_author_html', 'ghc_testimonial_custom_author_html', 10, 2 );

/**
 * Add container wrapper to testimonial shortcode.
 *
 * @return void Prints HTML content.
 */
function ghc_testimonial_before_posts() {
	echo '<div class="container">';

	$testimonial_bg = ACF::option( 'testimonial_background' )->expect( 'string' )->default( '' )->escape( 'esc_url' )->get();

	if ( ! empty( $testimonial_bg ) ) {
		echo '<style type="text/css">.testimonials.shortcode {background-image: url(' . $testimonial_bg . ')}</style>'; // WPCS: XSS ok because it’s escaped above.
	}
}
add_action( 'simple_testimonials_before_posts', 'ghc_testimonial_before_posts' );
/**
 * Add container wrapper to testimonial shortcode.
 *
 * @return void Prints HTML content.
 */
function ghc_testimonial_after_posts() {
	echo '</div>';
}
add_action( 'simple_testimonials_after_posts', 'ghc_testimonial_after_posts' );
