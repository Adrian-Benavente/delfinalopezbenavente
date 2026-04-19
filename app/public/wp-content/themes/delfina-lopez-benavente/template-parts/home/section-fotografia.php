<?php
/**
 * Template part for Fotografía section - Delfina López Benavente
 *
 * Muestra fotografías del CPT 'fotografia'. Placeholders si no hay contenido.
 * Carrusel Swiper con autoplay en bucle.
 *
 * @package Delfina_Lopez_Benavente
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$fotografias = new WP_Query(
	array(
		'post_type'      => 'fotografia',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
	)
);

$show_gallery_footer = $fotografias->post_count > 0;

/**
 * Abre un slide del carrusel con retardo de animación escalonada.
 *
 * @param int $index Índice 1-based del slide.
 */
$dlb_fotografia_open_slide = static function ( int $index ): void {
	$delay = 0.4 + ( $index - 1 ) * 0.1;
	printf(
		'<div class="swiper-slide" style="--dlb-stagger: %ss">',
		esc_attr( number_format( $delay, 2, '.', '' ) )
	);
};
?>

<section id="fotografia" class="dlb-section dlb-fotografia">
	<div class="dlb-container">
		<header class="dlb-section__header">
			<h2 class="dlb-section__title"><?php esc_html_e( 'Fotografía', 'delfina-lopez-benavente' ); ?></h2>
			<p class="dlb-section__intro">
				<?php esc_html_e( 'La fotografía también forma parte de mi forma de observar el mundo visual. Aquí comparto algunas imágenes realizadas durante viajes y proyectos personales. Estas fotografías reflejan mi mirada estética y mi interés por la composición, la luz y el detalle.', 'delfina-lopez-benavente' ); ?>
			</p>
		</header>
		<div class="dlb-fotografia__carousel-wrapper">
			<div class="dlb-fotografia__carousel swiper">
				<div class="swiper-wrapper">
					<?php
					$foto_slide_i = 0;
					if ( $fotografias->have_posts() ) :
						while ( $fotografias->have_posts() ) :
							$fotografias->the_post();
							++$foto_slide_i;
							$thumbnail_id = get_post_thumbnail_id();
							$image_url    = $thumbnail_id
								? wp_get_attachment_image_url( $thumbnail_id, 'large' )
								: delfina_lopez_benavente_placeholder_image( 400, 400, get_the_title() );
							$full_url     = $thumbnail_id
								? wp_get_attachment_image_url( $thumbnail_id, 'full' )
								: $image_url;
							$caption      = has_excerpt() ? get_the_excerpt() : get_the_title();
							$dlb_fotografia_open_slide( $foto_slide_i );
							?>
							<article class="dlb-fotografia__card">
								<a href="<?php echo delfina_lopez_benavente_esc_image_src( $full_url ); ?>" class="dlb-fotografia__link" data-dlb-lightbox data-dlb-caption="<?php echo esc_attr( $caption ); ?>">
									<span class="dlb-fotografia__image-wrap">
										<img
											src="<?php echo delfina_lopez_benavente_esc_image_src( $image_url ); ?>"
											alt="<?php echo esc_attr( get_the_title() ); ?>"
											width="400"
											height="400"
											loading="lazy"
											class="dlb-fotografia__image"
										/>
										<span class="dlb-fotografia__zoom-icon" aria-hidden="true">
											<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
										</span>
									</span>
									<?php if ( has_excerpt() ) : ?>
										<p class="dlb-fotografia__caption"><?php echo esc_html( get_the_excerpt() ); ?></p>
									<?php endif; ?>
								</a>
							</article>
							</div>
							<?php
						endwhile;
						wp_reset_postdata();
					else :
						$folder_images = delfina_lopez_benavente_get_fotografia_folder_images();
						if ( ! empty( $folder_images ) ) :
							foreach ( $folder_images as $img ) :
								++$foto_slide_i;
								$dlb_fotografia_open_slide( $foto_slide_i );
								?>
								<article class="dlb-fotografia__card">
									<a href="<?php echo delfina_lopez_benavente_esc_image_src( $img['full_url'] ); ?>" class="dlb-fotografia__link" data-dlb-lightbox data-dlb-caption="<?php echo esc_attr( $img['alt'] ); ?>">
										<span class="dlb-fotografia__image-wrap">
											<img
												src="<?php echo delfina_lopez_benavente_esc_image_src( $img['url'] ); ?>"
												alt="<?php echo esc_attr( $img['alt'] ); ?>"
												width="400"
												height="400"
												loading="lazy"
												class="dlb-fotografia__image"
											/>
											<span class="dlb-fotografia__zoom-icon" aria-hidden="true">
												<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
											</span>
										</span>
									</a>
								</article>
								</div>
								<?php
							endforeach;
						else :
							for ( $i = 1; $i <= 6; $i++ ) :
								++$foto_slide_i;
								$placeholder_url = delfina_lopez_benavente_placeholder_image( 400, 400, 'fotografia-' . $i );
								$dlb_fotografia_open_slide( $foto_slide_i );
								?>
								<article class="dlb-fotografia__card dlb-fotografia__card--placeholder">
									<a href="<?php echo delfina_lopez_benavente_esc_image_src( $placeholder_url ); ?>" class="dlb-fotografia__link" data-dlb-lightbox data-dlb-caption="<?php esc_attr_e( 'Fotografía placeholder', 'delfina-lopez-benavente' ); ?>">
										<span class="dlb-fotografia__image-wrap">
											<img
												src="<?php echo delfina_lopez_benavente_esc_image_src( $placeholder_url ); ?>"
												alt="<?php esc_attr_e( 'Fotografía placeholder', 'delfina-lopez-benavente' ); ?>"
												width="400"
												height="400"
												loading="lazy"
												class="dlb-fotografia__image"
											/>
											<span class="dlb-fotografia__zoom-icon" aria-hidden="true">
												<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
											</span>
										</span>
									</a>
								</article>
								</div>
								<?php
							endfor;
						endif;
					endif;
					?>
				</div>
				<button type="button" class="dlb-fotografia__prev swiper-button-prev" aria-label="<?php esc_attr_e( 'Fotografía anterior', 'delfina-lopez-benavente' ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 12H6"/><path d="M12 6l-6 6 6 6"/></svg>
				</button>
				<button type="button" class="dlb-fotografia__next swiper-button-next" aria-label="<?php esc_attr_e( 'Fotografía siguiente', 'delfina-lopez-benavente' ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 12h12"/><path d="M12 6l6 6-6 6"/></svg>
				</button>
			</div>
		</div>
		<?php if ( $show_gallery_footer ) : ?>
			<div class="dlb-fotografia__footer">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'fotografia' ) ); ?>" class="dlb-button dlb-button--secondary">
					<?php esc_html_e( 'Ver galería completa', 'delfina-lopez-benavente' ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>
