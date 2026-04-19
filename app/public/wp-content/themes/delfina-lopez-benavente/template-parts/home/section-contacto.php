<?php
/**
 * Template part for Contacto section - Delfina López Benavente
 *
 * Incluye formulario WPForms y datos de contacto.
 *
 * @package Delfina_Lopez_Benavente
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$form_id   = (int) get_option( 'delfina_lopez_benavente_contact_form_id', 0 );
$has_form  = $form_id > 0 && function_exists( 'wpforms_display' );
$form_post = $form_id > 0 ? get_post( $form_id ) : null;
$form_ok   = $has_form && $form_post && get_post_type( $form_post ) === 'wpforms';
?>

<section id="contacto" class="dlb-section dlb-contacto">
	<div class="dlb-container">
		<header class="dlb-section__header">
			<h2 class="dlb-section__title"><?php esc_html_e( 'Trabajemos juntos', 'delfina-lopez-benavente' ); ?></h2>
			<p class="dlb-section__intro">
				<?php esc_html_e( 'Si quieres mejorar la forma en que tu marca comunica en digital, podemos empezar con una conversación. Completa el formulario y te responderé lo antes posible.', 'delfina-lopez-benavente' ); ?>
			</p>
		</header>
		<div class="dlb-contacto__grid">
			<div class="dlb-contacto__form">
				<?php
				if ( $form_ok ) {
					wpforms_display( $form_id );
				} else {
					?>
					<p class="dlb-contacto__placeholder">
						<?php esc_html_e( 'El formulario de contacto se mostrará aquí. Crea el formulario desde Apariencia > DLB Setup.', 'delfina-lopez-benavente' ); ?>
					</p>
					<?php
				}
				?>
			</div>
			<aside class="dlb-contacto__info">
				<h3 class="dlb-contacto__info-title"><?php esc_html_e( 'Contacto', 'delfina-lopez-benavente' ); ?></h3>
				<ul class="dlb-contacto__list">
					<li>
						<span class="dlb-contacto__label"><?php esc_html_e( 'Email:', 'delfina-lopez-benavente' ); ?></span>
						<?php $contact_email = delfina_lopez_benavente_contact_email(); ?>
						<a href="mailto:<?php echo esc_attr( $contact_email ); ?>"><?php echo esc_html( $contact_email ); ?></a>
					</li>
					<li>
						<span class="dlb-contacto__label"><?php esc_html_e( 'Instagram:', 'delfina-lopez-benavente' ); ?></span>
						<?php
						$instagram_url = get_theme_mod( 'dlb_instagram_url', '' );
						$instagram_handle = get_theme_mod( 'dlb_instagram_handle', '' );
						if ( $instagram_url || $instagram_handle ) :
							$url = $instagram_url ?: 'https://instagram.com/' . ltrim( $instagram_handle, '@' );
							$label = $instagram_handle ?: $instagram_url;
							?>
							<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $label ); ?></a>
						<?php else : ?>
							<span class="dlb-contacto__placeholder-text"><?php esc_html_e( 'Por configurar', 'delfina-lopez-benavente' ); ?></span>
						<?php endif; ?>
					</li>
				</ul>
			</aside>
		</div>
	</div>
</section>
