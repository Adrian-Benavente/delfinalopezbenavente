<?php
/**
 * Template part for Instagram / Contenido reciente section - Delfina López Benavente
 *
 * Placeholder para el feed de Instagram. Integrar shortcode del plugin cuando esté configurado.
 *
 * @package Delfina_Lopez_Benavente
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Shortcodes comunes: smash-balloon (instagram-feed), wpinstagram, etc.
$instagram_shortcode = apply_filters( 'delfina_lopez_benavente_instagram_shortcode', '' );
?>

<section id="instagram" class="dlb-section dlb-instagram">
	<div class="dlb-container">
		<header class="dlb-section__header">
			<h2 class="dlb-section__title"><?php esc_html_e( 'Contenido reciente', 'delfina-lopez-benavente' ); ?></h2>
			<p class="dlb-section__intro">
				<?php esc_html_e( 'Aquí puedes ver algunas publicaciones recientes y proyectos compartidos en Instagram.', 'delfina-lopez-benavente' ); ?>
			</p>
		</header>
		<div class="dlb-instagram__content">
			<?php
			if ( ! empty( $instagram_shortcode ) ) {
				echo do_shortcode( $instagram_shortcode );
			} else {
				// Placeholder: grid de imágenes placeholder.
				?>
				<div class="dlb-instagram__placeholder-grid">
					<?php for ( $i = 1; $i <= 6; $i++ ) : ?>
						<div class="dlb-instagram__placeholder-item">
							<img
								src="<?php echo delfina_lopez_benavente_esc_image_src( delfina_lopez_benavente_placeholder_image( 300, 300, 'instagram-' . $i ) ); ?>"
								alt="<?php esc_attr_e( 'Instagram placeholder', 'delfina-lopez-benavente' ); ?>"
								width="300"
								height="300"
								loading="lazy"
							/>
						</div>
					<?php endfor; ?>
				</div>
				<p class="dlb-instagram__placeholder-note">
					<?php esc_html_e( 'El feed de Instagram se mostrará aquí cuando esté configurado.', 'delfina-lopez-benavente' ); ?>
				</p>
			<?php } ?>
		</div>
	</div>
</section>
