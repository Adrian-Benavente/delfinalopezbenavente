<?php
/**
 * Front Page Template - Delfina López Benavente
 *
 * Plantilla para la página de inicio con las 8 secciones.
 * El contenido se renderiza desde template-parts.
 *
 * @package Delfina_Lopez_Benavente
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div id="content" class="dlb-home-content">
	<?php
	get_template_part( 'template-parts/home/section', 'hero' );
	get_template_part( 'template-parts/home/section', 'servicios' );
	get_template_part( 'template-parts/home/section', 'como-trabajo' );
	get_template_part( 'template-parts/home/section', 'proyectos' );
	get_template_part( 'template-parts/home/section', 'fotografia' );
	get_template_part( 'template-parts/home/section', 'instagram' );
	get_template_part( 'template-parts/home/section', 'sobre-mi' );
	get_template_part( 'template-parts/home/section', 'contacto' );
	?>
</div>

<?php
get_footer();
