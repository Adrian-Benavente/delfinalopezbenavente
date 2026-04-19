<?php
/**
 * Template part for Sobre mí section - Delfina López Benavente
 *
 * @package Delfina_Lopez_Benavente
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section id="sobre-mi" class="dlb-section dlb-sobre-mi">
	<div class="dlb-container">
		<div class="dlb-sobre-mi__grid">
			<div class="dlb-sobre-mi__media">
				<img
					src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/sobre-mi/delfina.jpeg' ); ?>"
					alt="<?php esc_attr_e( 'Delfina López Benavente', 'delfina-lopez-benavente' ); ?>"
					width="500"
					height="500"
					loading="lazy"
					class="dlb-sobre-mi__image"
				/>
			</div>
			<div class="dlb-sobre-mi__content">
				<header class="dlb-section__header">
					<h2 class="dlb-section__title"><?php esc_html_e( 'Sobre mí', 'delfina-lopez-benavente' ); ?></h2>
				</header>
				<div class="dlb-sobre-mi__text">
					<p>
						<?php esc_html_e( 'Soy estratega de contenido y diseñadora digital. Trabajo ayudando a marcas a construir sistemas de contenido que conecten estrategia, diseño y narrativa para mejorar su presencia digital.', 'delfina-lopez-benavente' ); ?>
					</p>
					<p>
						<?php esc_html_e( 'A lo largo de los últimos años he desarrollado contenido para distintos proyectos y marcas, combinando pensamiento estratégico con ejecución creativa.', 'delfina-lopez-benavente' ); ?>
					</p>
					<p>
						<?php esc_html_e( 'Mi enfoque parte de una idea simple: el contenido no debería publicarse al azar. Cuando una marca tiene una estructura clara, una identidad visual coherente y una narrativa bien definida, su comunicación se vuelve más sólida y reconocible.', 'delfina-lopez-benavente' ); ?>
					</p>
					<p>
						<?php esc_html_e( 'Por eso mi trabajo combina análisis, dirección creativa y producción de contenido.', 'delfina-lopez-benavente' ); ?>
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
