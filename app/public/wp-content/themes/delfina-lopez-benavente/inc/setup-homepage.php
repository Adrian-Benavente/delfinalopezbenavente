<?php
/**
 * Setup Homepage - Delfina López Benavente
 *
 * Crea la página de inicio con estructura para las 8 secciones.
 * El contenido se edita con Elementor.
 *
 * @package Delfina_Lopez_Benavente
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Create homepage on theme activation.
 */
function delfina_lopez_benavente_create_homepage_on_activation(): void {
	if ( get_option( 'delfina_lopez_benavente_homepage_created' ) ) {
		return;
	}
	delfina_lopez_benavente_create_homepage();
	update_option( 'delfina_lopez_benavente_homepage_created', true );
}
add_action( 'after_switch_theme', 'delfina_lopez_benavente_create_homepage_on_activation' );

/**
 * Create homepage page and set as front page.
 */
function delfina_lopez_benavente_create_homepage(): void {
	$page_id = wp_insert_post(
		array(
			'post_title'   => __( 'Inicio', 'delfina-lopez-benavente' ),
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_content' => '<!-- Elementor placeholder -->',
		)
	);

	if ( $page_id && ! is_wp_error( $page_id ) ) {
		update_post_meta( $page_id, '_wp_page_template', 'elementor_canvas' );
		update_post_meta( $page_id, '_elementor_edit_mode', 'builder' );
		update_option( 'page_on_front', $page_id );
		update_option( 'show_on_front', 'page' );
	}
}
