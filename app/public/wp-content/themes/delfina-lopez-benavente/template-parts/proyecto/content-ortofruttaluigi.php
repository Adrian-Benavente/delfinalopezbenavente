<?php
/**
 * Ortofrutta Luigi - Project case study template
 *
 * @package Delfina_Lopez_Benavente
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$base_uri = get_stylesheet_directory_uri() . '/assets/images/proyectos/ortofruttaluigi/';
$img = function ( $filename ) use ( $base_uri ) {
	return $base_uri . rawurlencode( $filename );
};
?>

<main id="primary" class="dlb-proyecto dlb-proyecto--ortofruttaluigi">
	<?php
	get_template_part(
		'template-parts/proyecto/hero',
		null,
		array(
			'image_url' => $img( 'ortofruttaluigi.webp' ),
			'title'     => __( 'Ortofrutta Luigi', 'delfina-lopez-benavente' ),
			'subtitle'  => __( 'Identidad visual y sistema de contenido para redes sociales de una frutería italiana.', 'delfina-lopez-benavente' ),
		)
	);
	?>

	<!-- 2. Ortofrutta Luigi (brand intro) -->
	<section class="dlb-proyecto__section dlb-proyecto__intro">
		<div class="dlb-container">
			<p class="dlb-proyecto__intro-text"><?php
					printf(
						'<strong>%1$s</strong> %2$s',
						esc_html__( 'Ortofrutta Luigi', 'delfina-lopez-benavente' ),
						esc_html__( 'es una frutería de barrio inspirada en los pequeños comercios locales de Italia, donde el producto fresco, la cercanía con los clientes y la tradición forman parte del día a día.', 'delfina-lopez-benavente' )
					);
				?></p>
			<p class="dlb-proyecto__intro-text">
				<?php esc_html_e( 'El objetivo del proyecto fue crear una identidad visual simple y reconocible que transmitiera frescura, autenticidad y el carácter artesanal del negocio.', 'delfina-lopez-benavente' ); ?>
			</p>
		</div>
	</section>

	<!-- 3. Explicación del proyecto -->
	<section class="dlb-proyecto__section dlb-proyecto__about">
		<div class="dlb-container">
			<p class="dlb-proyecto__about-text">
				<?php esc_html_e( 'Para ello se diseñó un sistema de comunicación pensado principalmente para redes sociales, que permite mostrar de forma clara y rápida:', 'delfina-lopez-benavente' ); ?>
			</p>
			<ul class="dlb-proyecto__list">
				<li><?php esc_html_e( 'Productos de temporada', 'delfina-lopez-benavente' ); ?></li>
				<li><?php esc_html_e( 'Nuevas llegadas', 'delfina-lopez-benavente' ); ?></li>
				<li><?php esc_html_e( 'Ofertas del día', 'delfina-lopez-benavente' ); ?></li>
				<li><?php esc_html_e( 'Información del local', 'delfina-lopez-benavente' ); ?></li>
			</ul>
			<p class="dlb-proyecto__about-text">
				<?php esc_html_e( 'El estilo visual se apoya en fotografía cálida y natural, combinada con tipografía clara y mensajes directos que facilitan la lectura y destacan el producto.', 'delfina-lopez-benavente' ); ?>
			</p>
			<p class="dlb-proyecto__about-text">
				<?php esc_html_e( 'Además del sistema de publicaciones, la identidad también se aplicó a elementos físicos del negocio, como bolsas de papel utilizadas para la compra diaria. Esto permite extender la marca al espacio del comercio y reforzar su reconocimiento en la experiencia del cliente.', 'delfina-lopez-benavente' ); ?>
			</p>
			<p class="dlb-proyecto__about-text">
				<?php esc_html_e( 'El resultado es un sistema visual flexible que permite mantener una comunicación constante en redes sociales y en el punto de venta, sin perder coherencia ni identidad de marca.', 'delfina-lopez-benavente' ); ?>
			</p>
		</div>
	</section>

	<!-- Meta: Rol, Herramientas, Tipo -->
	<section class="dlb-proyecto__section dlb-proyecto__meta">
		<div class="dlb-container">
			<dl class="dlb-proyecto__meta-grid">
				<div>
					<dt><?php esc_html_e( 'Rol', 'delfina-lopez-benavente' ); ?></dt>
					<dd><?php esc_html_e( 'Identidad visual · Social media design', 'delfina-lopez-benavente' ); ?></dd>
				</div>
				<div>
					<dt><?php esc_html_e( 'Herramientas', 'delfina-lopez-benavente' ); ?></dt>
					<dd><?php esc_html_e( 'Canva · Illustrator · Lightroom · Photoshop', 'delfina-lopez-benavente' ); ?></dd>
				</div>
				<div>
					<dt><?php esc_html_e( 'Tipo de proyecto', 'delfina-lopez-benavente' ); ?></dt>
					<dd><?php esc_html_e( 'Proyecto conceptual', 'delfina-lopez-benavente' ); ?></dd>
				</div>
			</dl>
		</div>
	</section>

	<!-- 4. Paleta de colores -->
	<section class="dlb-proyecto__section dlb-proyecto__palette">
		<div class="dlb-container">
			<h2 class="dlb-proyecto__section-title"><?php esc_html_e( 'Paleta de colores', 'delfina-lopez-benavente' ); ?></h2>
			<div class="dlb-proyecto__palette-swatches">
				<div class="dlb-proyecto__swatch dlb-proyecto__swatch--wine">
					<div class="dlb-proyecto__swatch-color-wrap">
						<span class="dlb-proyecto__swatch-hex" aria-hidden="true">#7f0027</span>
						<span class="dlb-proyecto__swatch-color" style="background-color: #7f0027;"></span>
					</div>
					<span class="dlb-proyecto__swatch-label"><?php esc_html_e( 'Rojo vino', 'delfina-lopez-benavente' ); ?></span>
					<span class="dlb-proyecto__swatch-desc"><?php esc_html_e( 'Color principal de marca, asociado a productos frescos y a la identidad visual del negocio.', 'delfina-lopez-benavente' ); ?></span>
				</div>
				<div class="dlb-proyecto__swatch dlb-proyecto__swatch--olive">
					<div class="dlb-proyecto__swatch-color-wrap">
						<span class="dlb-proyecto__swatch-hex" aria-hidden="true">#444021</span>
						<span class="dlb-proyecto__swatch-color" style="background-color: #444021;"></span>
					</div>
					<span class="dlb-proyecto__swatch-label"><?php esc_html_e( 'Verde oliva', 'delfina-lopez-benavente' ); ?></span>
					<span class="dlb-proyecto__swatch-desc"><?php esc_html_e( 'Color de apoyo que evoca agricultura y productos naturales.', 'delfina-lopez-benavente' ); ?></span>
				</div>
				<div class="dlb-proyecto__swatch dlb-proyecto__swatch--mustard">
					<div class="dlb-proyecto__swatch-color-wrap">
						<span class="dlb-proyecto__swatch-hex" aria-hidden="true">#bc6f1a</span>
						<span class="dlb-proyecto__swatch-color" style="background-color: #bc6f1a;"></span>
					</div>
					<span class="dlb-proyecto__swatch-label"><?php esc_html_e( 'Mostaza cálido', 'delfina-lopez-benavente' ); ?></span>
					<span class="dlb-proyecto__swatch-desc"><?php esc_html_e( 'Color de acento que aporta calidez y recuerda la iluminación de los mercados y tiendas de barrio.', 'delfina-lopez-benavente' ); ?></span>
				</div>
			</div>
		</div>
	</section>

	<!-- 5. Tipografía -->
	<section class="dlb-proyecto__section dlb-proyecto__typography">
		<div class="dlb-container">
			<h2 class="dlb-proyecto__section-title"><?php esc_html_e( 'Tipografía', 'delfina-lopez-benavente' ); ?></h2>
			<div class="dlb-proyecto__typography-block">
				<h3><?php esc_html_e( 'Logotipo', 'delfina-lopez-benavente' ); ?></h3>
				<p><?php esc_html_e( 'Serif elegante inspirada en rótulos tradicionales italianos.', 'delfina-lopez-benavente' ); ?></p>
			</div>
			<div class="dlb-proyecto__typography-block">
				<h3><?php esc_html_e( 'Sistema de comunicación', 'delfina-lopez-benavente' ); ?></h3>
				<p><?php esc_html_e( 'Sans serif en bold para destacar productos, nombres y precios de forma clara y directa.', 'delfina-lopez-benavente' ); ?></p>
			</div>
		</div>
	</section>

	<!-- 6. Estilo fotográfico -->
	<section class="dlb-proyecto__section dlb-proyecto__photography">
		<div class="dlb-container">
			<h2 class="dlb-proyecto__section-title"><?php esc_html_e( 'Estilo fotográfico', 'delfina-lopez-benavente' ); ?></h2>
			<p class="dlb-proyecto__photography-desc">
				<?php esc_html_e( 'Fotografía cálida centrada en el producto. Se priorizan frutas y verduras frescas presentadas de forma natural en cestas y puestos de mercado para transmitir cercanía y autenticidad.', 'delfina-lopez-benavente' ); ?>
			</p>
			<figure class="dlb-proyecto__figure">
				<img
					src="<?php echo esc_url( $img( 'ortofrutta luigi 3.webp' ) ); ?>"
					alt="<?php esc_attr_e( 'Ortofrutta Luigi - Fotografía de producto', 'delfina-lopez-benavente' ); ?>"
					class="dlb-proyecto__photo"
				/>
			</figure>
		</div>
	</section>

	<!-- 7. Aplicación de marca (bolsas) -->
	<section class="dlb-proyecto__section dlb-proyecto__brand-application">
		<div class="dlb-container">
			<h2 class="dlb-proyecto__section-title"><?php esc_html_e( 'Aplicación de marca', 'delfina-lopez-benavente' ); ?></h2>
			<p class="dlb-proyecto__brand-text">
				<?php esc_html_e( 'La identidad también se aplica en elementos físicos como bolsas de papel utilizadas en la tienda. Este tipo de aplicación permite trasladar la marca al espacio real del comercio y reforzar su presencia en la experiencia de compra.', 'delfina-lopez-benavente' ); ?>
			</p>
			<figure class="dlb-proyecto__figure">
				<img
					src="<?php echo esc_url( $img( 'paper-shopping-bags-model2.webp' ) ); ?>"
					alt="<?php esc_attr_e( 'Ortofrutta Luigi - Bolsas de papel', 'delfina-lopez-benavente' ); ?>"
					class="dlb-proyecto__photo"
				/>
			</figure>
		</div>
	</section>

	<!-- 8. Sistema de publicaciones -->
	<section class="dlb-proyecto__section dlb-proyecto__content-system">
		<div class="dlb-container">
			<h2 class="dlb-proyecto__section-title"><?php esc_html_e( 'Sistema de contenido', 'delfina-lopez-benavente' ); ?></h2>
			<p class="dlb-proyecto__system-desc">
				<?php esc_html_e( 'El sistema permite crear publicaciones rápidas para diferentes tipos de comunicación:', 'delfina-lopez-benavente' ); ?>
			</p>
			<div class="dlb-proyecto__system-cards">
				<div class="dlb-proyecto__system-card">
					<span class="dlb-proyecto__system-card-title"><?php esc_html_e( 'Producto con precio', 'delfina-lopez-benavente' ); ?></span>
					<span class="dlb-proyecto__system-card-example"><?php esc_html_e( 'Ej: Limoni, Pomodori', 'delfina-lopez-benavente' ); ?></span>
				</div>
				<div class="dlb-proyecto__system-card">
					<span class="dlb-proyecto__system-card-title"><?php esc_html_e( 'Nuevos productos', 'delfina-lopez-benavente' ); ?></span>
					<span class="dlb-proyecto__system-card-example"><?php esc_html_e( 'Ej: Basilico appena arrivato', 'delfina-lopez-benavente' ); ?></span>
				</div>
				<div class="dlb-proyecto__system-card">
					<span class="dlb-proyecto__system-card-title"><?php esc_html_e( 'Producto destacado', 'delfina-lopez-benavente' ); ?></span>
					<span class="dlb-proyecto__system-card-example"><?php esc_html_e( 'Ej: Aglio e peperoncino', 'delfina-lopez-benavente' ); ?></span>
				</div>
				<div class="dlb-proyecto__system-card">
					<span class="dlb-proyecto__system-card-title"><?php esc_html_e( 'Información del local', 'delfina-lopez-benavente' ); ?></span>
					<span class="dlb-proyecto__system-card-example"><?php esc_html_e( 'Ej: Horario de apertura', 'delfina-lopez-benavente' ); ?></span>
				</div>
			</div>
		</div>
	</section>

	<!-- 9. Posts destacados -->
	<section class="dlb-proyecto__section dlb-proyecto__featured-posts">
		<div class="dlb-container">
			<h2 class="dlb-proyecto__section-title"><?php esc_html_e( 'Posts destacados', 'delfina-lopez-benavente' ); ?></h2>
			<div class="dlb-proyecto__posts-grid">
				<?php
				$featured_posts = array( 'instagram-feed-1.webp', 'instagram-feed-2.webp', 'instagram-feed-3.webp', 'instagram-feed-4.webp' );
				foreach ( $featured_posts as $file ) :
					?>
					<article class="dlb-proyecto__post-card">
						<img src="<?php echo esc_url( $img( $file ) ); ?>" alt="<?php esc_attr_e( 'Ortofrutta Luigi', 'delfina-lopez-benavente' ); ?>" loading="lazy" />
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- 10. Feed completo -->
	<section class="dlb-proyecto__section dlb-proyecto__feed">
		<div class="dlb-container">
			<h2 class="dlb-proyecto__section-title"><?php esc_html_e( 'Feed completo', 'delfina-lopez-benavente' ); ?></h2>
			<figure class="dlb-proyecto__feed-figure">
				<img
					src="<?php echo esc_url( $img( 'feed-completo.webp' ) ); ?>"
					alt="<?php esc_attr_e( 'Ortofrutta Luigi - Feed completo', 'delfina-lopez-benavente' ); ?>"
					loading="lazy"
					class="dlb-proyecto__feed-image"
				/>
			</figure>
		</div>
	</section>

	<!-- Back link -->
	<section class="dlb-proyecto__section dlb-proyecto__back">
		<div class="dlb-container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>#proyectos" class="dlb-button dlb-button--secondary">
				<?php esc_html_e( 'Volver a Proyectos', 'delfina-lopez-benavente' ); ?>
			</a>
		</div>
	</section>
</main>
