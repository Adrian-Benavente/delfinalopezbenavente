<?php
/**
 * Template part for Hero section - Delfina López Benavente
 *
 * @package Delfina_Lopez_Benavente
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_bg_path = get_stylesheet_directory() . '/assets/images/hero-image.png';
$hero_bg_url  = file_exists( $hero_bg_path )
	? get_stylesheet_directory_uri() . '/assets/images/hero-image.png'
	: delfina_lopez_benavente_placeholder_image( 1920, 1080, 'hero' );
?>
<section
	id="hero"
	class="dlb-section dlb-hero"
	style="<?php echo esc_attr( '--dlb-hero-bg-image: url(' . esc_url( $hero_bg_url ) . ');' ); ?>"
>
	<div class="dlb-container">
		<div class="dlb-hero__content">
			<h1 class="dlb-hero__title">
				<?php
				$title_line1 = esc_html( __( 'Estrategia, diseño y contenido', 'delfina-lopez-benavente' ) );
				$title_line2 = __( 'para marcas que quieren crecer con intención.', 'delfina-lopez-benavente' );
				$title_line2 = str_replace( 'intención', '<span class="dlb-hero__highlight">intención</span>', esc_html( $title_line2 ) );
				echo wp_kses(
					$title_line1 . '<br />' . $title_line2,
					array(
						'br'   => array(),
						'span' => array( 'class' => array() ),
					)
				);
				?>
			</h1>
			<p class="dlb-hero__subtitle">
				<?php esc_html_e( 'Desarrollo sistemas de comunicación que convierten contenido en crecimiento real.', 'delfina-lopez-benavente' ); ?>
			</p>
			<a href="#contacto" class="dlb-button dlb-button--primary dlb-hero__cta">
				<?php esc_html_e( 'Reservar una llamada', 'delfina-lopez-benavente' ); ?>
			</a>
		</div>
	</div>
	<a href="#servicios" class="dlb-hero__scroll-indicator" aria-label="<?php esc_attr_e( 'Desplazarse hacia abajo', 'delfina-lopez-benavente' ); ?>">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg>
	</a>
</section>
