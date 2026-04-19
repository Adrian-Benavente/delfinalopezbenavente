<?php
/**
 * Template part for Servicios section - Delfina López Benavente
 *
 * Carrusel Swiper con efecto péndulo (GSAP) en el front.
 *
 * @package Delfina_Lopez_Benavente
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$services = array(
	array(
		'title'   => __( 'Estrategia de contenido', 'delfina-lopez-benavente' ),
		'desc'    => __( 'Desarrollo la base estratégica sobre la que se construirá la comunicación digital de una marca.', 'delfina-lopez-benavente' ),
		'items'   => array(
			__( 'Análisis de posicionamiento', 'delfina-lopez-benavente' ),
			__( 'Narrativa de marca', 'delfina-lopez-benavente' ),
			__( 'Arquitectura de contenido', 'delfina-lopez-benavente' ),
			__( 'Definición de pilares estratégicos', 'delfina-lopez-benavente' ),
			__( 'Detección de oportunidades', 'delfina-lopez-benavente' ),
		),
	),
	array(
		'title'   => __( 'Branding e identidad visual', 'delfina-lopez-benavente' ),
		'desc'    => __( 'Diseño identidades visuales que ayudan a las marcas a comunicar de forma clara y reconocible.', 'delfina-lopez-benavente' ),
		'items'   => array(
			__( 'Identidad visual', 'delfina-lopez-benavente' ),
			__( 'Sistema gráfico para redes', 'delfina-lopez-benavente' ),
			__( 'Lineamientos visuales', 'delfina-lopez-benavente' ),
			__( 'Tipografía y color', 'delfina-lopez-benavente' ),
			__( 'Aplicación a formatos digitales', 'delfina-lopez-benavente' ),
		),
	),
	array(
		'title'   => __( 'Diseño de contenido para redes', 'delfina-lopez-benavente' ),
		'desc'    => __( 'Creación de piezas visuales diseñadas para comunicar de forma clara y atractiva.', 'delfina-lopez-benavente' ),
		'items'   => array(
			__( 'Diseño de carruseles', 'delfina-lopez-benavente' ),
			__( 'Diseño de publicaciones', 'delfina-lopez-benavente' ),
			__( 'Contenido visual para redes', 'delfina-lopez-benavente' ),
			__( 'Adaptación de piezas a distintos formatos', 'delfina-lopez-benavente' ),
		),
	),
	array(
		'title'   => __( 'Gestión de redes sociales', 'delfina-lopez-benavente' ),
		'desc'    => __( 'Acompañamiento en la planificación y gestión del contenido en redes sociales.', 'delfina-lopez-benavente' ),
		'items'   => array(
			__( 'Planificación de contenido', 'delfina-lopez-benavente' ),
			__( 'Publicación y gestión de redes', 'delfina-lopez-benavente' ),
			__( 'Dirección creativa', 'delfina-lopez-benavente' ),
			__( 'Optimización de perfiles', 'delfina-lopez-benavente' ),
			__( 'Análisis de resultados', 'delfina-lopez-benavente' ),
		),
	),
	array(
		'title'   => __( 'Producción de contenido', 'delfina-lopez-benavente' ),
		'desc'    => __( 'Creación de contenido visual para redes sociales.', 'delfina-lopez-benavente' ),
		'items'   => array(
			__( 'Fotografía', 'delfina-lopez-benavente' ),
			__( 'Video corto para reels o TikTok', 'delfina-lopez-benavente' ),
			__( 'Contenido para campañas', 'delfina-lopez-benavente' ),
			__( 'Contenido para eventos', 'delfina-lopez-benavente' ),
			__( 'Packs de contenido para negocios', 'delfina-lopez-benavente' ),
		),
	),
);
?>

<section id="servicios" class="dlb-section dlb-servicios">
	<div class="dlb-container">
		<header class="dlb-section__header">
			<h2 class="dlb-section__title"><?php esc_html_e( 'Servicios', 'delfina-lopez-benavente' ); ?></h2>
			<p class="dlb-section__intro">
				<?php esc_html_e( 'Trabajo con marcas que quieren mejorar su presencia digital desarrollando sistemas de contenido coherentes, estratégicos y visualmente sólidos. Los servicios se adaptan según las necesidades de cada proyecto.', 'delfina-lopez-benavente' ); ?>
			</p>
		</header>
		<div class="dlb-servicios__carousel-wrap" aria-label="<?php echo esc_attr__( 'Listado de servicios', 'delfina-lopez-benavente' ); ?>">
			<div class="dlb-servicios__carousel swiper">
				<div class="dlb-servicios__rail" aria-hidden="true"></div>
				<div class="swiper-wrapper">
					<?php foreach ( $services as $index => $service ) : ?>
						<?php $num = sprintf( '%02d', $index + 1 ); ?>
						<div class="swiper-slide">
							<div class="dlb-servicios__pendulum">
								<article class="dlb-servicios__card">
									<span class="dlb-servicios__card-num" aria-hidden="true"><?php echo esc_html( $num ); ?></span>
									<h3 class="dlb-servicios__card-title"><?php echo esc_html( $service['title'] ); ?></h3>
									<p class="dlb-servicios__card-desc"><?php echo esc_html( $service['desc'] ); ?></p>
									<ul class="dlb-servicios__card-list">
										<?php foreach ( $service['items'] as $item ) : ?>
											<li><?php echo esc_html( $item ); ?></li>
										<?php endforeach; ?>
									</ul>
								</article>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<button type="button" class="dlb-servicios__prev swiper-button-prev" aria-label="<?php esc_attr_e( 'Servicio anterior', 'delfina-lopez-benavente' ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 12H6"/><path d="M12 6l-6 6 6 6"/></svg>
			</button>
			<button type="button" class="dlb-servicios__next swiper-button-next" aria-label="<?php esc_attr_e( 'Servicio siguiente', 'delfina-lopez-benavente' ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 12h12"/><path d="M12 6l6 6-6 6"/></svg>
			</button>
		</div>
	</div>
</section>
