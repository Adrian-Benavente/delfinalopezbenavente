<?php
/**
 * Admin: bulk upload de Fotografías desde la Biblioteca.
 *
 * Añade un botón "Añadir desde Biblioteca" en la pantalla del listado del CPT
 * `fotografia` que permite seleccionar múltiples imágenes de la Biblioteca de
 * Medios y crea un post de `fotografia` por cada una.
 *
 * @package Delfina_Lopez_Benavente
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Comprueba si estamos en la pantalla del listado del CPT `fotografia`.
 */
function delfina_lopez_benavente_fotografia_is_list_screen(): bool {
	if ( ! is_admin() ) {
		return false;
	}

	$pagenow = isset( $GLOBALS['pagenow'] ) ? (string) $GLOBALS['pagenow'] : '';
	if ( 'edit.php' !== $pagenow ) {
		return false;
	}

	$post_type = isset( $_GET['post_type'] ) ? sanitize_key( wp_unslash( (string) $_GET['post_type'] ) ) : '';

	return 'fotografia' === $post_type;
}

/**
 * Enqueue del media uploader y del script que inyecta el botón.
 */
function delfina_lopez_benavente_fotografia_admin_assets(): void {
	if ( ! delfina_lopez_benavente_fotografia_is_list_screen() ) {
		return;
	}

	wp_enqueue_media();
	wp_enqueue_script(
		'delfina-lopez-benavente-admin-fotografia',
		get_stylesheet_directory_uri() . '/assets/js/admin-fotografia.js',
		array( 'jquery' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
	wp_localize_script(
		'delfina-lopez-benavente-admin-fotografia',
		'DLB_FOTO',
		array(
			'btnLabel'    => __( 'Añadir desde Biblioteca', 'delfina-lopez-benavente' ),
			'mediaTitle'  => __( 'Selecciona fotografías', 'delfina-lopez-benavente' ),
			'mediaButton' => __( 'Crear fotografías', 'delfina-lopez-benavente' ),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'delfina_lopez_benavente_fotografia_admin_assets' );

/**
 * Inyecta el form oculto que el JS envía para crear las fotografías en bulk.
 */
function delfina_lopez_benavente_fotografia_admin_footer(): void {
	if ( ! delfina_lopez_benavente_fotografia_is_list_screen() ) {
		return;
	}
	?>
	<form
		id="dlb-fotografia-bulk-form"
		method="post"
		action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"
		style="display:none;"
	>
		<?php wp_nonce_field( 'dlb_bulk_fotografia' ); ?>
		<input type="hidden" name="action" value="dlb_bulk_fotografia" />
		<input type="hidden" name="fotografia_ids" id="dlb-fotografia-ids" value="" />
	</form>
	<?php
}
add_action( 'admin_footer-edit.php', 'delfina_lopez_benavente_fotografia_admin_footer' );

/**
 * Handler del POST que crea los posts de `fotografia`.
 */
function delfina_lopez_benavente_fotografia_bulk_handler(): void {
	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_die( esc_html__( 'Sin permisos.', 'delfina-lopez-benavente' ), 403 );
	}

	check_admin_referer( 'dlb_bulk_fotografia' );

	$raw_ids = isset( $_POST['fotografia_ids'] )
		? sanitize_text_field( wp_unslash( (string) $_POST['fotografia_ids'] ) )
		: '';

	$ids = array_values(
		array_filter(
			array_map( 'absint', explode( ',', $raw_ids ) )
		)
	);

	$stats = delfina_lopez_benavente_bulk_create_fotografia( $ids );

	$redirect = add_query_arg(
		array(
			'post_type'   => 'fotografia',
			'dlb_created' => $stats['created'],
			'dlb_skipped' => $stats['skipped'],
		),
		admin_url( 'edit.php' )
	);

	wp_safe_redirect( $redirect );
	exit;
}
add_action( 'admin_post_dlb_bulk_fotografia', 'delfina_lopez_benavente_fotografia_bulk_handler' );

/**
 * Muestra un aviso en el listado tras redirigir desde el handler.
 */
function delfina_lopez_benavente_fotografia_admin_notice(): void {
	if ( ! delfina_lopez_benavente_fotografia_is_list_screen() ) {
		return;
	}

	if ( ! isset( $_GET['dlb_created'] ) && ! isset( $_GET['dlb_skipped'] ) ) {
		return;
	}

	$created = isset( $_GET['dlb_created'] ) ? absint( wp_unslash( (string) $_GET['dlb_created'] ) ) : 0;
	$skipped = isset( $_GET['dlb_skipped'] ) ? absint( wp_unslash( (string) $_GET['dlb_skipped'] ) ) : 0;
	?>
	<div class="notice notice-success is-dismissible">
		<p>
			<?php
			printf(
				/* translators: 1: created count, 2: skipped count */
				esc_html__( 'Fotografías creadas: %1$d. Omitidas: %2$d.', 'delfina-lopez-benavente' ),
				(int) $created,
				(int) $skipped
			);
			?>
		</p>
	</div>
	<?php
}
add_action( 'admin_notices', 'delfina_lopez_benavente_fotografia_admin_notice' );

/**
 * Crea posts del CPT `fotografia` a partir de IDs de attachments.
 *
 * Omite attachments que no sean imagen y attachments que ya estén asociados
 * como thumbnail de otro post de `fotografia`.
 *
 * @param array<int, int> $ids Lista de IDs de attachments.
 * @return array{created: int, skipped: int}
 */
function delfina_lopez_benavente_bulk_create_fotografia( array $ids ): array {
	$created = 0;
	$skipped = 0;

	foreach ( $ids as $attachment_id ) {
		$attachment_id = (int) $attachment_id;
		if ( $attachment_id <= 0 || ! wp_attachment_is_image( $attachment_id ) ) {
			++$skipped;
			continue;
		}

		$existing = get_posts(
			array(
				'post_type'      => 'fotografia',
				'post_status'    => 'any',
				'posts_per_page' => 1,
				'fields'         => 'ids',
				'meta_query'     => array(
					array(
						'key'     => '_thumbnail_id',
						'value'   => $attachment_id,
						'compare' => '=',
					),
				),
				'no_found_rows'  => true,
			)
		);

		if ( ! empty( $existing ) ) {
			++$skipped;
			continue;
		}

		$title   = get_the_title( $attachment_id );
		$caption = (string) wp_get_attachment_caption( $attachment_id );

		$post_id = wp_insert_post(
			array(
				'post_type'    => 'fotografia',
				'post_status'  => 'publish',
				'post_title'   => '' !== $title ? $title : sprintf( /* translators: %d: attachment ID */ __( 'Fotografía %d', 'delfina-lopez-benavente' ), $attachment_id ),
				'post_excerpt' => $caption,
			),
			true
		);

		if ( is_wp_error( $post_id ) || 0 === $post_id ) {
			++$skipped;
			continue;
		}

		set_post_thumbnail( $post_id, $attachment_id );
		++$created;
	}

	return array(
		'created' => $created,
		'skipped' => $skipped,
	);
}
