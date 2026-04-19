<?php
/**
 * Hero section for single projects - Delfina López Benavente
 *
 * Parallax sutil y overlay oscuro. Reutilizable en todos los proyectos.
 *
 * @package Delfina_Lopez_Benavente
 *
 * @param string $image_url URL de la imagen del hero.
 * @param string $title     Título del proyecto.
 * @param string $subtitle  Subtítulo o extracto (opcional).
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args      = wp_parse_args( $args ?? array(), array( 'image_url' => '', 'title' => '', 'subtitle' => '' ) );
$image_url = $args['image_url'];
$title     = $args['title'];
$subtitle  = $args['subtitle'];

if ( empty( $image_url ) ) {
	return;
}

$bg_url_safe = ( strpos( $image_url, 'data:' ) === 0 )
	? esc_attr( $image_url )
	: esc_url( $image_url );
?>
<section class="dlb-proyecto__hero" style="--hero-bg-url: url('<?php echo $bg_url_safe; ?>');">
	<div class="dlb-proyecto__hero-inner">
		<img
			src="<?php echo delfina_lopez_benavente_esc_image_src( $image_url ); ?>"
			alt="<?php echo esc_attr( $title ); ?>"
			class="dlb-proyecto__hero-image"
			loading="eager"
			fetchpriority="high"
		/>
		<div class="dlb-proyecto__hero-overlay">
			<?php if ( $title ) : ?>
				<h1 class="dlb-proyecto__hero-title"><?php echo esc_html( $title ); ?></h1>
			<?php endif; ?>
			<?php if ( $subtitle ) : ?>
				<p class="dlb-proyecto__hero-subtitle"><?php echo esc_html( $subtitle ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>
