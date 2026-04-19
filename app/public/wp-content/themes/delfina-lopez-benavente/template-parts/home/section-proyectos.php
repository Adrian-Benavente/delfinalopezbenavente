<?php
/**
 * Template part for Proyectos section - Delfina López Benavente
 *
 * Muestra los proyectos del CPT 'proyecto'. Placeholders si no hay contenido.
 *
 * @package Delfina_Lopez_Benavente
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$proyectos = new WP_Query(
	array(
		'post_type'      => 'proyecto',
		'posts_per_page' => 12,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'ASC',
	)
);

$proyectos_count   = $proyectos->have_posts() ? $proyectos->post_count : 3;
$use_carousel      = $proyectos_count > 3;
$placeholder_titles = array(
	__( 'Ortofrutta Luigi', 'delfina-lopez-benavente' ),
	__( 'Sistema de contenido', 'delfina-lopez-benavente' ),
	__( 'Dirección creativa', 'delfina-lopez-benavente' ),
	__( 'Estrategia digital', 'delfina-lopez-benavente' ),
	__( 'Diseño editorial', 'delfina-lopez-benavente' ),
	__( 'Contenido de marca', 'delfina-lopez-benavente' ),
);
?>

<section id="proyectos" class="dlb-section dlb-proyectos <?php echo $use_carousel ? 'dlb-proyectos--carousel' : 'dlb-proyectos--grid'; ?>" data-proyectos-count="<?php echo (int) $proyectos_count; ?>">
	<div class="dlb-container">
		<header class="dlb-section__header">
			<h2 class="dlb-section__title"><?php esc_html_e( 'Proyectos', 'delfina-lopez-benavente' ); ?></h2>
			<p class="dlb-section__intro">
				<?php esc_html_e( 'Cada marca necesita una estructura distinta. Aquí puedes ver algunos ejemplos de proyectos, sistemas de contenido y trabajos desarrollados para distintas marcas. Los proyectos muestran tanto el enfoque estratégico como la ejecución visual.', 'delfina-lopez-benavente' ); ?>
			</p>
		</header>
		<?php if ( $use_carousel ) : ?>
		<div class="dlb-proyectos__carousel-wrapper">
			<div class="dlb-proyectos__carousel swiper">
				<div class="swiper-wrapper">
					<?php
					if ( $proyectos->have_posts() ) :
						while ( $proyectos->have_posts() ) :
							$proyectos->the_post();
							$thumbnail_id = get_post_thumbnail_id();
							$image_url    = $thumbnail_id
								? wp_get_attachment_image_url( $thumbnail_id, 'large' )
								: delfina_lopez_benavente_placeholder_image( 600, 400, get_the_title() );
							$project_url  = get_post_meta( get_the_ID(), '_dlb_proyecto_url', true );
							?>
							<div class="swiper-slide">
								<article class="dlb-proyectos__card">
									<a href="<?php echo $project_url ? esc_url( $project_url ) : esc_url( get_permalink() ); ?>" class="dlb-proyectos__link" <?php echo $project_url ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
										<img
											src="<?php echo delfina_lopez_benavente_esc_image_src( $image_url ); ?>"
											alt="<?php echo esc_attr( get_the_title() ); ?>"
											width="600"
											height="400"
											loading="lazy"
											class="dlb-proyectos__image"
										/>
										<div class="dlb-proyectos__overlay">
											<h3 class="dlb-proyectos__title"><?php the_title(); ?></h3>
											<?php if ( has_excerpt() ) : ?>
												<p class="dlb-proyectos__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
											<?php endif; ?>
										</div>
									</a>
								</article>
							</div>
							<?php
						endwhile;
						wp_reset_postdata();
					else :
						foreach ( $placeholder_titles as $i => $title ) :
							$num = $i + 1;
							?>
							<div class="swiper-slide">
								<article class="dlb-proyectos__card dlb-proyectos__card--placeholder">
									<div class="dlb-proyectos__link">
										<img
											src="<?php echo delfina_lopez_benavente_esc_image_src( delfina_lopez_benavente_placeholder_image( 600, 400, 'proyecto-' . $num ) ); ?>"
											alt="<?php echo esc_attr( $title ); ?>"
											width="600"
											height="400"
											loading="lazy"
											class="dlb-proyectos__image"
										/>
										<div class="dlb-proyectos__overlay">
											<h3 class="dlb-proyectos__title"><?php echo esc_html( $title ); ?></h3>
										</div>
									</div>
								</article>
							</div>
							<?php
						endforeach;
					endif;
					?>
				</div>
				<button type="button" class="dlb-proyectos__prev swiper-button-prev" aria-label="<?php esc_attr_e( 'Proyecto anterior', 'delfina-lopez-benavente' ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 12H6"/><path d="M12 6l-6 6 6 6"/></svg>
				</button>
				<button type="button" class="dlb-proyectos__next swiper-button-next" aria-label="<?php esc_attr_e( 'Proyecto siguiente', 'delfina-lopez-benavente' ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 12h12"/><path d="M12 6l6 6-6 6"/></svg>
				</button>
			</div>
		</div>
		<?php else : ?>
		<div class="dlb-proyectos__grid">
			<?php
			if ( $proyectos->have_posts() ) :
				while ( $proyectos->have_posts() ) :
					$proyectos->the_post();
					$thumbnail_id = get_post_thumbnail_id();
					$image_url    = $thumbnail_id
						? wp_get_attachment_image_url( $thumbnail_id, 'large' )
						: delfina_lopez_benavente_placeholder_image( 600, 400, get_the_title() );
					$project_url  = get_post_meta( get_the_ID(), '_dlb_proyecto_url', true );
					?>
					<article class="dlb-proyectos__card">
						<a href="<?php echo $project_url ? esc_url( $project_url ) : esc_url( get_permalink() ); ?>" class="dlb-proyectos__link" <?php echo $project_url ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
							<img
								src="<?php echo delfina_lopez_benavente_esc_image_src( $image_url ); ?>"
								alt="<?php echo esc_attr( get_the_title() ); ?>"
								width="600"
								height="400"
								loading="lazy"
								class="dlb-proyectos__image"
							/>
							<div class="dlb-proyectos__overlay">
								<h3 class="dlb-proyectos__title"><?php the_title(); ?></h3>
								<?php if ( has_excerpt() ) : ?>
									<p class="dlb-proyectos__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
								<?php endif; ?>
							</div>
						</a>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				foreach ( array_slice( $placeholder_titles, 0, 3 ) as $i => $title ) :
					$num = $i + 1;
					?>
					<article class="dlb-proyectos__card dlb-proyectos__card--placeholder">
						<div class="dlb-proyectos__link">
							<img
								src="<?php echo delfina_lopez_benavente_esc_image_src( delfina_lopez_benavente_placeholder_image( 600, 400, 'proyecto-' . $num ) ); ?>"
								alt="<?php echo esc_attr( $title ); ?>"
								width="600"
								height="400"
								loading="lazy"
								class="dlb-proyectos__image"
							/>
							<div class="dlb-proyectos__overlay">
								<h3 class="dlb-proyectos__title"><?php echo esc_html( $title ); ?></h3>
							</div>
						</div>
					</article>
					<?php
				endforeach;
			endif;
			?>
		</div>
		<?php endif; ?>
		<?php if ( $proyectos->post_count > 0 ) : ?>
			<div class="dlb-proyectos__footer">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'proyecto' ) ); ?>" class="dlb-button dlb-button--secondary">
					<?php esc_html_e( 'Ver todos los proyectos', 'delfina-lopez-benavente' ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>
