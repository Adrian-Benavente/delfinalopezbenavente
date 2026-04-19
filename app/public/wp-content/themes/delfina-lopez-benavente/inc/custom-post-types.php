<?php
/**
 * Custom Post Types - Delfina López Benavente
 *
 * Registra los CPTs: Proyectos (portfolio) y Fotografía.
 *
 * @package Delfina_Lopez_Benavente
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Proyectos (portfolio) post type.
 */
function delfina_lopez_benavente_register_proyecto_cpt(): void {
	$labels = array(
		'name'               => _x( 'Proyectos', 'post type general name', 'delfina-lopez-benavente' ),
		'singular_name'      => _x( 'Proyecto', 'post type singular name', 'delfina-lopez-benavente' ),
		'menu_name'          => _x( 'Proyectos', 'admin menu', 'delfina-lopez-benavente' ),
		'add_new'            => _x( 'Añadir nuevo', 'proyecto', 'delfina-lopez-benavente' ),
		'add_new_item'       => __( 'Añadir nuevo proyecto', 'delfina-lopez-benavente' ),
		'edit_item'          => __( 'Editar proyecto', 'delfina-lopez-benavente' ),
		'new_item'           => __( 'Nuevo proyecto', 'delfina-lopez-benavente' ),
		'view_item'          => __( 'Ver proyecto', 'delfina-lopez-benavente' ),
		'search_items'       => __( 'Buscar proyectos', 'delfina-lopez-benavente' ),
		'not_found'          => __( 'No se encontraron proyectos', 'delfina-lopez-benavente' ),
		'not_found_in_trash' => __( 'No hay proyectos en la papelera', 'delfina-lopez-benavente' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable'  => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'proyectos' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'      => false,
		'menu_position'     => 20,
		'menu_icon'         => 'dashicons-portfolio',
		'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest'      => true,
	);

	register_post_type( 'proyecto', $args );
}

/**
 * Register Fotografía post type.
 */
function delfina_lopez_benavente_register_fotografia_cpt(): void {
	$labels = array(
		'name'               => _x( 'Fotografías', 'post type general name', 'delfina-lopez-benavente' ),
		'singular_name'      => _x( 'Fotografía', 'post type singular name', 'delfina-lopez-benavente' ),
		'menu_name'          => _x( 'Fotografía', 'admin menu', 'delfina-lopez-benavente' ),
		'add_new'            => _x( 'Añadir nueva', 'fotografia', 'delfina-lopez-benavente' ),
		'add_new_item'       => __( 'Añadir nueva fotografía', 'delfina-lopez-benavente' ),
		'edit_item'          => __( 'Editar fotografía', 'delfina-lopez-benavente' ),
		'new_item'           => __( 'Nueva fotografía', 'delfina-lopez-benavente' ),
		'view_item'          => __( 'Ver fotografía', 'delfina-lopez-benavente' ),
		'search_items'       => __( 'Buscar fotografías', 'delfina-lopez-benavente' ),
		'not_found'          => __( 'No se encontraron fotografías', 'delfina-lopez-benavente' ),
		'not_found_in_trash' => __( 'No hay fotografías en la papelera', 'delfina-lopez-benavente' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable'  => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'fotografia' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'      => false,
		'menu_position'     => 21,
		'menu_icon'         => 'dashicons-camera',
		'supports'          => array( 'title', 'thumbnail', 'excerpt' ),
		'show_in_rest'      => true,
	);

	register_post_type( 'fotografia', $args );
}

/**
 * Register taxonomies for Proyectos.
 */
function delfina_lopez_benavente_register_proyecto_taxonomy(): void {
	register_taxonomy(
		'categoria_proyecto',
		'proyecto',
		array(
			'labels'            => array(
				'name'          => _x( 'Categorías', 'taxonomy general name', 'delfina-lopez-benavente' ),
				'singular_name' => _x( 'Categoría', 'taxonomy singular name', 'delfina-lopez-benavente' ),
			),
			'hierarchical'      => true,
			'public'           => true,
			'rewrite'          => array( 'slug' => 'categoria-proyecto' ),
			'show_in_rest'     => true,
		)
	);
}

/**
 * Register taxonomies for Fotografía.
 */
function delfina_lopez_benavente_register_fotografia_taxonomy(): void {
	register_taxonomy(
		'categoria_fotografia',
		'fotografia',
		array(
			'labels'            => array(
				'name'          => _x( 'Categorías', 'taxonomy general name', 'delfina-lopez-benavente' ),
				'singular_name' => _x( 'Categoría', 'taxonomy singular name', 'delfina-lopez-benavente' ),
			),
			'hierarchical'      => true,
			'public'           => true,
			'rewrite'          => array( 'slug' => 'categoria-fotografia' ),
			'show_in_rest'     => true,
		)
	);
}

/**
 * Add meta box for project URL.
 */
function delfina_lopez_benavente_proyecto_meta_boxes(): void {
	add_meta_box(
		'dlb_proyecto_url',
		__( 'Enlace del proyecto', 'delfina-lopez-benavente' ),
		'delfina_lopez_benavente_proyecto_url_callback',
		'proyecto',
		'side'
	);
}

/**
 * Meta box callback for project URL.
 *
 * @param WP_Post $post Current post object.
 */
function delfina_lopez_benavente_proyecto_url_callback( WP_Post $post ): void {
	wp_nonce_field( 'dlb_proyecto_url_nonce', 'dlb_proyecto_url_nonce' );
	$url = get_post_meta( $post->ID, '_dlb_proyecto_url', true );
	?>
	<p>
		<label for="dlb_proyecto_url"><?php esc_html_e( 'URL del proyecto (opcional)', 'delfina-lopez-benavente' ); ?></label>
		<input type="url" id="dlb_proyecto_url" name="dlb_proyecto_url" value="<?php echo esc_url( $url ); ?>" class="widefat" />
	</p>
	<?php
}

/**
 * Save project URL meta.
 *
 * @param int $post_id Post ID.
 */
function delfina_lopez_benavente_save_proyecto_url( int $post_id ): void {
	if ( ! isset( $_POST['dlb_proyecto_url_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['dlb_proyecto_url_nonce'] ) ), 'dlb_proyecto_url_nonce' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['dlb_proyecto_url'] ) ) {
		update_post_meta( $post_id, '_dlb_proyecto_url', esc_url_raw( wp_unslash( $_POST['dlb_proyecto_url'] ) ) );
	}
}

add_action( 'add_meta_boxes', 'delfina_lopez_benavente_proyecto_meta_boxes' );
add_action( 'save_post_proyecto', 'delfina_lopez_benavente_save_proyecto_url' );
add_action( 'init', 'delfina_lopez_benavente_register_proyecto_cpt' );
add_action( 'init', 'delfina_lopez_benavente_register_fotografia_cpt' );
add_action( 'init', 'delfina_lopez_benavente_register_proyecto_taxonomy' );
add_action( 'init', 'delfina_lopez_benavente_register_fotografia_taxonomy' );
