<?php
/**
 * Template part for Cómo trabajo section - Delfina López Benavente
 *
 * @package Delfina_Lopez_Benavente
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Vídeo / placeholder de la sección Cómo trabajo.
 * Pon a true para volver a mostrarlo sin tocar el marcado.
 */
$dlb_show_como_trabajo_video = false;

$steps = array(
	array(
		'num'  => '01',
		'title' => __( 'Análisis de marca', 'delfina-lopez-benavente' ),
		'text'  => __( 'Antes de crear contenido analizo la base de la marca. Esto incluye entender su posicionamiento, narrativa y estructura de comunicación actual.', 'delfina-lopez-benavente' ),
	),
	array(
		'num'  => '02',
		'title' => __( 'Sistema visual', 'delfina-lopez-benavente' ),
		'text'  => __( 'A partir del análisis se desarrolla un sistema visual coherente que ayude a comunicar mejor la identidad de la marca. El diseño comunica incluso antes del texto.', 'delfina-lopez-benavente' ),
	),
	array(
		'num'  => '03',
		'title' => __( 'Arquitectura de contenido', 'delfina-lopez-benavente' ),
		'text'  => __( 'Se define cómo funcionará el contenido dentro del sistema. Esto incluye pilares estratégicos, narrativa y estructura de publicaciones.', 'delfina-lopez-benavente' ),
	),
	array(
		'num'  => '04',
		'title' => __( 'Ejecución y optimización', 'delfina-lopez-benavente' ),
		'text'  => __( 'Finalmente se desarrolla el contenido y se analiza su rendimiento para realizar ajustes estratégicos.', 'delfina-lopez-benavente' ),
	),
);
?>

<section id="como-trabajo" class="dlb-section dlb-como-trabajo">
	<div class="dlb-container">
		<header class="dlb-section__header">
			<h2 class="dlb-section__title"><?php esc_html_e( 'Cómo trabajo', 'delfina-lopez-benavente' ); ?></h2>
			<p class="dlb-section__intro">
				<?php esc_html_e( 'Mi trabajo se basa en desarrollar sistemas de contenido claros y coherentes. El proceso suele organizarse en cuatro etapas.', 'delfina-lopez-benavente' ); ?>
			</p>
		</header>
		<div class="dlb-como-trabajo__steps">
			<?php foreach ( $steps as $step ) : ?>
				<article class="dlb-como-trabajo__step">
					<span class="dlb-como-trabajo__num" aria-hidden="true"><?php echo esc_html( $step['num'] ); ?></span>
					<div class="dlb-como-trabajo__content">
						<h3 class="dlb-como-trabajo__step-title"><?php echo esc_html( $step['title'] ); ?></h3>
						<p class="dlb-como-trabajo__step-text"><?php echo esc_html( $step['text'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
		<?php if ( $dlb_show_como_trabajo_video ) : ?>
		<div class="dlb-como-trabajo__media">
			<div class="dlb-placeholder-video">
				<img
					src="<?php echo delfina_lopez_benavente_esc_image_src( delfina_lopez_benavente_placeholder_image( 800, 450, 'proceso' ) ); ?>"
					alt="<?php esc_attr_e( 'Video placeholder', 'delfina-lopez-benavente' ); ?>"
					width="800"
					height="450"
					loading="lazy"
				/>
				<span class="dlb-placeholder-video__icon" aria-hidden="true">▶</span>
			</div>
		</div>
		<?php endif; ?>
	</div>
</section>
