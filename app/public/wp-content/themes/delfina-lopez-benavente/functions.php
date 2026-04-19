<?php
/**
 * Delfina López Benavente - Child Theme Functions
 *
 * @package Delfina_Lopez_Benavente
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Client contact email. */
const DLB_CONTACT_EMAIL = 'contact@delfinalopezbenavente.com';

/**
 * Get the theme contact email. Filterable for overrides.
 *
 * @return string Contact email address.
 */
function delfina_lopez_benavente_contact_email(): string {
	return (string) apply_filters( 'delfina_lopez_benavente_contact_email', DLB_CONTACT_EMAIL );
}

/**
 * Enqueue parent and child theme styles.
 */
function delfina_lopez_benavente_enqueue_styles(): void {
	wp_enqueue_style(
		'blocksy-style',
		get_template_directory_uri() . '/style.css',
		array(),
		wp_get_theme( 'blocksy' )->get( 'Version' )
	);

	wp_enqueue_style(
		'delfina-lopez-benavente-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'blocksy-style' ),
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_style(
		'delfina-lopez-benavente-custom',
		get_stylesheet_directory_uri() . '/assets/css/custom.css',
		array( 'delfina-lopez-benavente-style' ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'delfina_lopez_benavente_enqueue_styles', 15 );

/**
 * Enqueue lightbox, carousel, Swiper, and GSAP (front page only).
 */
function delfina_lopez_benavente_enqueue_scripts(): void {
	if ( is_front_page() ) {
		wp_enqueue_script(
			'delfina-lopez-benavente-scroll-animations',
			get_stylesheet_directory_uri() . '/assets/js/scroll-animations.js',
			array(),
			wp_get_theme()->get( 'Version' ),
			true
		);
		wp_enqueue_script(
			'delfina-lopez-benavente-lightbox',
			get_stylesheet_directory_uri() . '/assets/js/lightbox.js',
			array(),
			wp_get_theme()->get( 'Version' ),
			true
		);
		// Swiper para carrusel de proyectos.
		wp_enqueue_style(
			'swiper',
			'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
			array(),
			'11'
		);
		wp_enqueue_script(
			'swiper',
			'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
			array(),
			'11',
			true
		);
		wp_enqueue_script(
			'delfina-lopez-benavente-proyectos-carousel',
			get_stylesheet_directory_uri() . '/assets/js/proyectos-carousel.js',
			array( 'swiper' ),
			wp_get_theme()->get( 'Version' ),
			true
		);
		wp_enqueue_script(
			'delfina-lopez-benavente-fotografia-carousel',
			get_stylesheet_directory_uri() . '/assets/js/fotografia-carousel.js',
			array( 'swiper' ),
			wp_get_theme()->get( 'Version' ),
			true
		);
		// GSAP + ScrollTrigger (front page).
		wp_enqueue_script(
			'gsap',
			'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js',
			array(),
			'3.12.5',
			true
		);
		wp_enqueue_script(
			'gsap-scrolltrigger',
			'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js',
			array( 'gsap' ),
			'3.12.5',
			true
		);
		wp_enqueue_script(
			'delfina-lopez-benavente-gsap-init',
			get_stylesheet_directory_uri() . '/assets/js/gsap-init.js',
			array( 'gsap', 'gsap-scrolltrigger' ),
			wp_get_theme()->get( 'Version' ),
			true
		);
		wp_enqueue_script(
			'delfina-lopez-benavente-servicios-carousel',
			get_stylesheet_directory_uri() . '/assets/js/servicios-carousel.js',
			array( 'swiper', 'gsap' ),
			wp_get_theme()->get( 'Version' ),
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'delfina_lopez_benavente_enqueue_scripts', 20 );

/**
 * Enqueue Google Fonts (Inter - alternativa gratuita a General Sans).
 */
function delfina_lopez_benavente_enqueue_fonts(): void {
	wp_enqueue_style(
		'delfina-lopez-benavente-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
		array(),
		null
	);
}
add_action( 'wp_enqueue_scripts', 'delfina_lopez_benavente_enqueue_fonts', 5 );

/**
 * Load custom post types.
 */
function delfina_lopez_benavente_load_custom_post_types(): void {
	$cpt_file = get_stylesheet_directory() . '/inc/custom-post-types.php';
	if ( file_exists( $cpt_file ) ) {
		require_once $cpt_file;
	}
}
add_action( 'after_setup_theme', 'delfina_lopez_benavente_load_custom_post_types' );

/**
 * Load header/footer setup and homepage setup (admin only).
 */
function delfina_lopez_benavente_load_setup(): void {
	if ( is_admin() ) {
		$setup_file = get_stylesheet_directory() . '/inc/setup-header-footer.php';
		if ( file_exists( $setup_file ) ) {
			require_once $setup_file;
		}
		$homepage_file = get_stylesheet_directory() . '/inc/setup-homepage.php';
		if ( file_exists( $homepage_file ) ) {
			require_once $homepage_file;
		}
		$wpforms_file = get_stylesheet_directory() . '/inc/setup-wpforms.php';
		if ( file_exists( $wpforms_file ) ) {
			require_once $wpforms_file;
		}
		$fotografia_admin_file = get_stylesheet_directory() . '/inc/admin-fotografia.php';
		if ( file_exists( $fotografia_admin_file ) ) {
			require_once $fotografia_admin_file;
		}
	}
}
add_action( 'after_setup_theme', 'delfina_lopez_benavente_load_setup' );

/**
 * Placeholder images from Blocksy (copied to child theme). Eliminar cuando tengas las definitivas.
 *
 * @var array<string, string>
 */
const DLB_PLACEHOLDER_IMAGES = array(
	'hero'         => 'pattern-image-1.webp',
	'proceso'      => 'pattern-image-2.webp',
	'sobre-mi'     => 'pattern-avatar-1.webp',
	'proyecto-1'   => 'proyectos/ortofruttaluigi/ortofruttaluigi-thumbnail.webp',
	'proyecto-2'   => 'pattern-image-3.webp',
	'proyecto-3'   => 'pattern-image-4.webp',
	'fotografia-1' => 'pattern-image-1.webp',
	'fotografia-2' => 'pattern-image-2.webp',
	'fotografia-3' => 'pattern-image-3.webp',
	'fotografia-4' => 'pattern-image-4.webp',
	'fotografia-5' => 'pattern-image-5.webp',
	'fotografia-6' => 'pattern-image-6.webp',
	'instagram-1'  => 'pattern-image-1.webp',
	'instagram-2'  => 'pattern-image-2.webp',
	'instagram-3'  => 'pattern-image-3.webp',
	'instagram-4'  => 'pattern-image-4.webp',
	'instagram-5'  => 'pattern-image-5.webp',
	'instagram-6'  => 'pattern-image-6.webp',
);

/**
 * Get placeholder image URL for home sections.
 * Usa imágenes de Blocksy copiadas al child theme. Fallback a SVG si no hay match.
 *
 * @param int    $width  Image width in pixels (para fallback SVG).
 * @param int    $height Image height in pixels (para fallback SVG).
 * @param string $label  Label para mapear a imagen (hero, proceso, sobre-mi, proyecto-N, fotografia-N, instagram-N).
 * @return string Placeholder image URL.
 */
function delfina_lopez_benavente_placeholder_image( int $width = 800, int $height = 600, string $label = '' ): string {
	$filename = null;
	if ( ! empty( $label ) && defined( 'DLB_PLACEHOLDER_IMAGES' ) && isset( DLB_PLACEHOLDER_IMAGES[ $label ] ) ) {
		$filename = DLB_PLACEHOLDER_IMAGES[ $label ];
	} elseif ( ! empty( $label ) ) {
		$index    = ( abs( crc32( $label ) ) % 6 ) + 1;
		$filename = 'pattern-image-' . $index . '.webp';
	}

	if ( $filename ) {
		$path = get_stylesheet_directory() . '/assets/images/' . $filename;
		if ( file_exists( $path ) ) {
			return get_stylesheet_directory_uri() . '/assets/images/' . $filename;
		}
	}

	// Fallback: SVG data URI para labels dinámicos (ej. títulos de proyectos).
	$text = ! empty( $label ) ? sprintf( /* translators: %s: section or context */ __( 'Imagen placeholder - %s', 'delfina-lopez-benavente' ), $label ) : __( 'Imagen placeholder', 'delfina-lopez-benavente' );
	$svg = sprintf(
		'<svg xmlns="http://www.w3.org/2000/svg" width="%1$d" height="%2$d" viewBox="0 0 %1$d %2$d"><rect fill="#d5c7d6" width="100%%" height="100%%"/><text fill="#66316b" font-family="Inter,sans-serif" font-size="18" x="50%%" y="50%%" text-anchor="middle" dy=".3em">%3$s</text></svg>',
		$width,
		$height,
		esc_html( $text )
	);
	return 'data:image/svg+xml;base64,' . base64_encode( $svg );
}

/**
 * Escape image src attribute. Use esc_attr for data URIs (esc_url strips them).
 *
 * @param string $url Image URL or data URI.
 * @return string Escaped value for src attribute.
 */
function delfina_lopez_benavente_esc_image_src( string $url ): string {
	return ( strpos( $url, 'data:' ) === 0 ) ? esc_attr( $url ) : esc_url( $url );
}

/**
 * Get project asset URL (image or file) from theme assets.
 *
 * @param string $project_slug Project slug (e.g. 'ortofruttaluigi').
 * @param string $filename    Filename within project folder (e.g. 'ortofruttaluigi.webp').
 * @return string URL to asset, or empty string if file not found.
 */
function delfina_lopez_benavente_project_asset_url( string $project_slug, string $filename ): string {
	$base = 'assets/images/proyectos/' . $project_slug . '/';
	$path = get_stylesheet_directory() . '/' . $base . $filename;
	if ( file_exists( $path ) ) {
		return get_stylesheet_directory_uri() . '/' . $base . rawurlencode( $filename );
	}
	return '';
}

/**
 * Get image URLs from assets/images/fotografia/ folder.
 * Used when CPT 'fotografia' has no posts.
 *
 * @param int|null $limit Maximum number of images to return. Null = all images.
 * @return array<int, array{url: string, full_url: string, alt: string}> Array of image data.
 */
function delfina_lopez_benavente_get_fotografia_folder_images( ?int $limit = null ): array {
	$dir   = get_stylesheet_directory() . '/assets/images/fotografia/';
	$uri   = get_stylesheet_directory_uri() . '/assets/images/fotografia/';
	$exts  = array( 'jpg', 'jpeg', 'png', 'webp', 'gif' );
	$files = array();

	if ( ! is_dir( $dir ) ) {
		return array();
	}

	$items = scandir( $dir );
	if ( $items === false ) {
		return array();
	}

	foreach ( $items as $file ) {
		if ( $file === '.' || $file === '..' ) {
			continue;
		}
		$ext = strtolower( pathinfo( $file, PATHINFO_EXTENSION ) );
		if ( in_array( $ext, $exts, true ) ) {
			$files[] = $file;
		}
	}

	natsort( $files );
	$files = array_values( $files );
	if ( $limit !== null ) {
		$files = array_slice( $files, 0, $limit );
	}

	$result = array();
	foreach ( $files as $file ) {
		$result[] = array(
			'url'      => $uri . $file,
			'full_url' => $uri . $file,
			'alt'      => pathinfo( $file, PATHINFO_FILENAME ),
		);
	}

	return $result;
}

/**
 * Feed the Instagram shortcode filter from the DLB Setup option.
 *
 * Respects previous non-empty values from other filters.
 *
 * @param string $shortcode Shortcode provided by earlier filters (may be empty).
 * @return string Shortcode to render in the Instagram section.
 */
function delfina_lopez_benavente_filter_instagram_shortcode( string $shortcode ): string {
	if ( $shortcode !== '' ) {
		return $shortcode;
	}

	return (string) get_option( 'delfina_lopez_benavente_instagram_shortcode', '' );
}
add_filter( 'delfina_lopez_benavente_instagram_shortcode', 'delfina_lopez_benavente_filter_instagram_shortcode' );
