<?php
/**
 * Generic single project content - Delfina López Benavente
 *
 * Fallback for projects without a custom template.
 *
 * @package Delfina_Lopez_Benavente
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

while ( have_posts() ) :
	the_post();
	$thumbnail_id = get_post_thumbnail_id();
	$image_url    = $thumbnail_id
		? wp_get_attachment_image_url( $thumbnail_id, 'large' )
		: delfina_lopez_benavente_placeholder_image( 1200, 600, get_the_title() );
	?>
	<main id="primary" class="dlb-proyecto dlb-proyecto--generic">
		<article class="dlb-proyecto__article">
			<?php
			get_template_part(
				'template-parts/proyecto/hero',
				null,
				array(
					'image_url' => $image_url,
					'title'     => get_the_title(),
					'subtitle'  => has_excerpt() ? get_the_excerpt() : '',
				)
			);
			?>
			<div class="dlb-proyecto__content dlb-container">
				<?php the_content(); ?>
			</div>
			<footer class="dlb-proyecto__footer dlb-container">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>#proyectos" class="dlb-button dlb-button--secondary">
					<?php esc_html_e( 'Volver a Proyectos', 'delfina-lopez-benavente' ); ?>
				</a>
			</footer>
		</article>
	</main>
	<?php
endwhile;
