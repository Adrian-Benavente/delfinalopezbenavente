<?php
/**
 * Setup WPForms - Delfina López Benavente
 *
 * Crea el formulario de contacto con los campos especificados.
 *
 * @package Delfina_Lopez_Benavente
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Create contact form.
 *
 * @return int|false Form ID or false on failure.
 */
function delfina_lopez_benavente_create_contact_form() {
	if ( ! function_exists( 'wpforms' ) ) {
		return false;
	}

	$form_handler = wpforms()->obj( 'form' );
	if ( ! $form_handler ) {
		return false;
	}

	$form_data = array(
		'field_id' => 7,
		'fields'   => array(
			1 => array(
				'id'       => 1,
				'type'     => 'text',
				'label'    => __( 'Nombre', 'delfina-lopez-benavente' ),
				'size'     => 'medium',
				'required' => '1',
			),
			2 => array(
				'id'       => 2,
				'type'     => 'email',
				'label'    => __( 'Email', 'delfina-lopez-benavente' ),
				'size'     => 'medium',
				'required' => '1',
			),
			3 => array(
				'id'       => 3,
				'type'     => 'text',
				'label'    => __( 'Empresa o proyecto', 'delfina-lopez-benavente' ),
				'size'     => 'medium',
				'required' => '',
			),
			4 => array(
				'id'      => 4,
				'type'    => 'select',
				'label'   => __( 'Tipo de servicio que busca', 'delfina-lopez-benavente' ),
				'size'    => 'medium',
				'choices' => array(
					1 => array( 'label' => __( 'Estrategia de contenido', 'delfina-lopez-benavente' ), 'value' => '' ),
					2 => array( 'label' => __( 'Branding e identidad visual', 'delfina-lopez-benavente' ), 'value' => '' ),
					3 => array( 'label' => __( 'Diseño de contenido para redes', 'delfina-lopez-benavente' ), 'value' => '' ),
					4 => array( 'label' => __( 'Gestión de redes sociales', 'delfina-lopez-benavente' ), 'value' => '' ),
					5 => array( 'label' => __( 'Producción de contenido', 'delfina-lopez-benavente' ), 'value' => '' ),
					6 => array( 'label' => __( 'Otro', 'delfina-lopez-benavente' ), 'value' => '' ),
				),
				'placeholder' => '---',
				'required'   => '',
			),
			5 => array(
				'id'      => 5,
				'type'    => 'select',
				'label'   => __( 'Presupuesto aproximado', 'delfina-lopez-benavente' ),
				'size'    => 'medium',
				'choices' => array(
					1 => array( 'label' => __( 'Menos de 500€', 'delfina-lopez-benavente' ), 'value' => '' ),
					2 => array( 'label' => __( '500€ - 1.500€', 'delfina-lopez-benavente' ), 'value' => '' ),
					3 => array( 'label' => __( '1.500€ - 3.000€', 'delfina-lopez-benavente' ), 'value' => '' ),
					4 => array( 'label' => __( '3.000€ - 5.000€', 'delfina-lopez-benavente' ), 'value' => '' ),
					5 => array( 'label' => __( 'Más de 5.000€', 'delfina-lopez-benavente' ), 'value' => '' ),
					6 => array( 'label' => __( 'Por definir', 'delfina-lopez-benavente' ), 'value' => '' ),
				),
				'placeholder' => '---',
				'required'   => '',
			),
			6 => array(
				'id'       => 6,
				'type'     => 'textarea',
				'label'    => __( 'Mensaje', 'delfina-lopez-benavente' ),
				'size'     => 'medium',
				'required' => '1',
			),
		),
		'settings' => array(
			'form_title'               => __( 'Contacto DLB', 'delfina-lopez-benavente' ),
			'form_desc'                => '',
			'submit_text'              => __( 'Enviar consulta', 'delfina-lopez-benavente' ),
			'submit_text_processing'   => __( 'Enviando...', 'delfina-lopez-benavente' ),
			'notification_enable'      => '1',
			'notifications'            => array(
				'1' => array(
					'email'          => delfina_lopez_benavente_contact_email(),
					'subject'        => sprintf( /* translators: %s - form name */ __( 'Nueva consulta: %s', 'delfina-lopez-benavente' ), __( 'Contacto DLB', 'delfina-lopez-benavente' ) ),
					'sender_name'    => get_bloginfo( 'name' ),
					'sender_address' => delfina_lopez_benavente_contact_email(),
					'message'        => '{all_fields}',
				),
			),
			'confirmations'            => array(
				'1' => array(
					'type'           => 'message',
					'message'        => __( 'Gracias por tu mensaje. Te responderé lo antes posible.', 'delfina-lopez-benavente' ),
					'message_scroll' => '1',
				),
			),
		),
	);

	$form_id = $form_handler->add(
		$form_data['settings']['form_title'],
		array( 'post_content' => wpforms_encode( $form_data ) ),
		array( 'builder' => false )
	);

	return $form_id;
}
