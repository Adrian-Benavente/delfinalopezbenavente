<?php
/**
 * Setup Header and Footer - Delfina López Benavente
 *
 * Importa las plantillas de header y footer e configura Header Footer Elementor.
 * Ejecutar desde: Apariencia > DLB Setup
 *
 * @package Delfina_Lopez_Benavente
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add setup admin menu.
 */
function delfina_lopez_benavente_setup_menu(): void {
	add_theme_page(
		__( 'DLB Setup', 'delfina-lopez-benavente' ),
		__( 'DLB Setup', 'delfina-lopez-benavente' ),
		'manage_options',
		'dlb-setup',
		'delfina_lopez_benavente_setup_page'
	);
}
add_action( 'admin_menu', 'delfina_lopez_benavente_setup_menu' );

/**
 * Setup page callback.
 */
function delfina_lopez_benavente_setup_page(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( isset( $_GET['dlb_run_setup'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'dlb_run_setup' ) ) {
		$result = delfina_lopez_benavente_run_header_footer_setup();
		?>
		<div class="notice notice-<?php echo $result['success'] ? 'success' : 'error'; ?> is-dismissible">
			<p><?php echo esc_html( $result['message'] ); ?></p>
		</div>
		<?php
	}

	if ( isset( $_GET['dlb_create_homepage'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'dlb_create_homepage' ) ) {
		delfina_lopez_benavente_create_homepage();
		?>
		<div class="notice notice-success is-dismissible">
			<p><?php esc_html_e( 'Página de inicio creada. Edítala con Elementor para añadir las 8 secciones.', 'delfina-lopez-benavente' ); ?></p>
			<p><a href="<?php echo esc_url( admin_url( 'post.php?post=' . get_option( 'page_on_front' ) . '&action=elementor' ) ); ?>" class="button"><?php esc_html_e( 'Editar con Elementor', 'delfina-lopez-benavente' ); ?></a></p>
		</div>
		<?php
	}

	if ( isset( $_GET['dlb_apply_logo'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'dlb_apply_logo' ) ) {
		$result = delfina_lopez_benavente_apply_theme_logo();
		?>
		<div class="notice notice-<?php echo $result['success'] ? 'success' : 'error'; ?> is-dismissible">
			<p><?php echo esc_html( $result['message'] ); ?></p>
		</div>
		<?php
	}

	if ( isset( $_POST['dlb_save_instagram'] ) ) {
		check_admin_referer( 'dlb_save_instagram' );
		$raw = isset( $_POST['dlb_instagram_shortcode'] ) ? wp_unslash( $_POST['dlb_instagram_shortcode'] ) : '';
		update_option( 'delfina_lopez_benavente_instagram_shortcode', sanitize_text_field( $raw ) );
		?>
		<div class="notice notice-success is-dismissible">
			<p><?php esc_html_e( 'Shortcode guardado.', 'delfina-lopez-benavente' ); ?></p>
		</div>
		<?php
	}

	if ( isset( $_POST['dlb_clear_instagram'] ) ) {
		check_admin_referer( 'dlb_clear_instagram' );
		delete_option( 'delfina_lopez_benavente_instagram_shortcode' );
		?>
		<div class="notice notice-success is-dismissible">
			<p><?php esc_html_e( 'Shortcode eliminado. Se mostrará el placeholder en la home.', 'delfina-lopez-benavente' ); ?></p>
		</div>
		<?php
	}

	if ( isset( $_GET['dlb_create_form'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'dlb_create_form' ) ) {
		$form_id = delfina_lopez_benavente_create_contact_form();
		if ( $form_id ) {
			update_option( 'delfina_lopez_benavente_contact_form_id', $form_id );
			?>
			<div class="notice notice-success is-dismissible">
				<p><?php echo esc_html( sprintf( __( 'Formulario de contacto creado. Usa el shortcode [wpforms id="%d"] en la sección de contacto.', 'delfina-lopez-benavente' ), (int) $form_id ) ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'admin.php?page=wpforms-builder&view=fields&form_id=' . $form_id ) ); ?>" class="button"><?php esc_html_e( 'Editar formulario', 'delfina-lopez-benavente' ); ?></a></p>
			</div>
			<?php
		} else {
			?>
			<div class="notice notice-error is-dismissible">
				<p><?php esc_html_e( 'Error al crear el formulario. Verifica que WPForms esté activo.', 'delfina-lopez-benavente' ); ?></p>
			</div>
			<?php
		}
	}

	$header_id  = class_exists( 'Header_Footer_Elementor' ) ? Header_Footer_Elementor::get_settings( 'type_header', '' ) : '';
	$footer_id  = class_exists( 'Header_Footer_Elementor' ) ? Header_Footer_Elementor::get_settings( 'type_footer', '' ) : '';
	$setup_done = ! empty( $header_id ) && ! empty( $footer_id );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Delfina López Benavente - Setup', 'delfina-lopez-benavente' ); ?></h1>

		<?php if ( ! $setup_done ) : ?>
			<p><?php esc_html_e( 'Configura el header y footer con las plantillas del tema.', 'delfina-lopez-benavente' ); ?></p>
			<p>
				<a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'dlb_run_setup', '1' ), 'dlb_run_setup' ) ); ?>" class="button button-primary">
					<?php esc_html_e( 'Importar Header y Footer', 'delfina-lopez-benavente' ); ?>
				</a>
			</p>
			<p class="description">
				<?php esc_html_e( 'Esto creará las plantillas DLB Header y DLB Footer en Header Footer Elementor.', 'delfina-lopez-benavente' ); ?>
			</p>
		<?php else : ?>
			<p><?php esc_html_e( 'Header y Footer ya están configurados.', 'delfina-lopez-benavente' ); ?></p>
			<p>
				<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=elementor_library' ) ); ?>" class="button">
					<?php esc_html_e( 'Ver plantillas', 'delfina-lopez-benavente' ); ?>
				</a>
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=header-footer-elementor' ) ); ?>" class="button">
					<?php esc_html_e( 'Configurar HFE', 'delfina-lopez-benavente' ); ?>
				</a>
			</p>
		<?php endif; ?>

		<?php
		$homepage_id = get_option( 'page_on_front' );
		if ( ! $homepage_id ) :
			?>
			<hr>
			<h2><?php esc_html_e( 'Página de inicio', 'delfina-lopez-benavente' ); ?></h2>
			<p><?php esc_html_e( 'Crea la página de inicio para editar con Elementor (Hero, Servicios, Cómo trabajo, Proyectos, Fotografía, Instagram, Sobre mí, Contacto).', 'delfina-lopez-benavente' ); ?></p>
			<p>
				<a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'dlb_create_homepage', '1' ), 'dlb_create_homepage' ) ); ?>" class="button">
					<?php esc_html_e( 'Crear página de inicio', 'delfina-lopez-benavente' ); ?>
				</a>
			</p>
		<?php else : ?>
			<hr>
			<h2><?php esc_html_e( 'Página de inicio', 'delfina-lopez-benavente' ); ?></h2>
			<p>
				<a href="<?php echo esc_url( admin_url( 'post.php?post=' . $homepage_id . '&action=elementor' ) ); ?>" class="button"><?php esc_html_e( 'Editar inicio con Elementor', 'delfina-lopez-benavente' ); ?></a>
			</p>
		<?php endif; ?>

		<?php
		$contact_form_id = get_option( 'delfina_lopez_benavente_contact_form_id' );
		if ( ! $contact_form_id ) :
			?>
			<hr>
			<h2><?php esc_html_e( 'Formulario de contacto', 'delfina-lopez-benavente' ); ?></h2>
			<p><?php esc_html_e( 'Crea el formulario de contacto con WPForms (Nombre, Email, Empresa, Tipo de servicio, Presupuesto, Mensaje).', 'delfina-lopez-benavente' ); ?></p>
			<p>
				<a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'dlb_create_form', '1' ), 'dlb_create_form' ) ); ?>" class="button">
					<?php esc_html_e( 'Crear formulario de contacto', 'delfina-lopez-benavente' ); ?>
				</a>
			</p>
		<?php else : ?>
			<hr>
			<h2><?php esc_html_e( 'Formulario de contacto', 'delfina-lopez-benavente' ); ?></h2>
			<p><?php esc_html_e( 'Shortcode para la sección Contacto:', 'delfina-lopez-benavente' ); ?> <code>[wpforms id="<?php echo (int) $contact_form_id; ?>"]</code></p>
			<p>
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=wpforms-builder&view=fields&form_id=' . $contact_form_id ) ); ?>" class="button"><?php esc_html_e( 'Editar formulario', 'delfina-lopez-benavente' ); ?></a>
			</p>
		<?php endif; ?>

		<hr>
		<h2><?php esc_html_e( 'Logo del sitio', 'delfina-lopez-benavente' ); ?></h2>
		<p><?php esc_html_e( 'Aplica el logotipo de Delfina López Benavente desde los assets del tema, reemplazando el logo actual.', 'delfina-lopez-benavente' ); ?></p>
		<p>
			<a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'dlb_apply_logo', '1' ), 'dlb_apply_logo' ) ); ?>" class="button">
				<?php esc_html_e( 'Aplicar logo del tema', 'delfina-lopez-benavente' ); ?>
			</a>
		</p>
		<p class="description">
			<?php esc_html_e( 'Archivo: assets/images/logo-delfina-lopez-benavente.png', 'delfina-lopez-benavente' ); ?>
		</p>

		<hr>
		<h2><?php esc_html_e( 'Instagram Feed', 'delfina-lopez-benavente' ); ?></h2>
		<p><?php esc_html_e( 'Para la sección "Contenido reciente" de Instagram, instala el plugin Smash Balloon Instagram Feed:', 'delfina-lopez-benavente' ); ?></p>
		<p>
			<a href="<?php echo esc_url( admin_url( 'plugin-install.php?s=instagram+feed+smash+balloon&tab=search&type=term' ) ); ?>" class="button">
				<?php esc_html_e( 'Instalar Instagram Feed', 'delfina-lopez-benavente' ); ?>
			</a>
		</p>
		<p class="description">
			<?php esc_html_e( 'Tras instalar, conecta tu cuenta de Instagram en la configuración del plugin. Luego pega su shortcode abajo para mostrarlo en la home.', 'delfina-lopez-benavente' ); ?>
		</p>

		<?php $ig_shortcode = (string) get_option( 'delfina_lopez_benavente_instagram_shortcode', '' ); ?>

		<h3><?php esc_html_e( 'Shortcode del feed', 'delfina-lopez-benavente' ); ?></h3>
		<form method="post" action="">
			<?php wp_nonce_field( 'dlb_save_instagram' ); ?>
			<p>
				<label for="dlb_instagram_shortcode">
					<?php esc_html_e( 'Pega aquí el shortcode del plugin:', 'delfina-lopez-benavente' ); ?>
				</label>
				<br>
				<input
					type="text"
					id="dlb_instagram_shortcode"
					name="dlb_instagram_shortcode"
					value="<?php echo esc_attr( $ig_shortcode ); ?>"
					class="regular-text"
					placeholder="[instagram-feed feed=1]"
				>
			</p>
			<p>
				<button type="submit" name="dlb_save_instagram" class="button button-primary">
					<?php esc_html_e( 'Guardar shortcode', 'delfina-lopez-benavente' ); ?>
				</button>
			</p>
		</form>

		<?php if ( ! empty( $ig_shortcode ) ) : ?>
			<form method="post" action="" style="margin-top: 0.5rem;">
				<?php wp_nonce_field( 'dlb_clear_instagram' ); ?>
				<button type="submit" name="dlb_clear_instagram" class="button">
					<?php esc_html_e( 'Quitar shortcode', 'delfina-lopez-benavente' ); ?>
				</button>
			</form>

			<h4><?php esc_html_e( 'Vista previa', 'delfina-lopez-benavente' ); ?></h4>
			<div style="border: 1px solid #dcdcde; padding: 1rem; background: #fff; max-width: 900px;">
				<?php echo do_shortcode( $ig_shortcode ); ?>
			</div>
			<p class="description">
				<?php esc_html_e( 'La previsualización carga el shortcode tal cual. Si el plugin solo encola sus estilos/scripts en el front, la vista previa puede verse sin estilos; en la home se verá correcto.', 'delfina-lopez-benavente' ); ?>
			</p>
		<?php endif; ?>

		<hr>
		<h2><?php esc_html_e( 'Creación manual', 'delfina-lopez-benavente' ); ?></h2>
		<p><?php esc_html_e( 'Si el setup automático falla, crea el header y footer manualmente:', 'delfina-lopez-benavente' ); ?></p>
		<ol>
			<li><?php esc_html_e( 'Ve a Elementor > Header & Footer Builder', 'delfina-lopez-benavente' ); ?></li>
			<li><?php esc_html_e( 'Crea un nuevo Header y un nuevo Footer', 'delfina-lopez-benavente' ); ?></li>
			<li><?php esc_html_e( 'Edita con Elementor y asigna "Display on: Entire Website"', 'delfina-lopez-benavente' ); ?></li>
		</ol>
	</div>
	<?php
}

/**
 * Apply theme logo as site logo (custom_logo).
 * Imports logo from assets to media library and sets it.
 *
 * @return array{success: bool, message: string}
 */
function delfina_lopez_benavente_apply_theme_logo(): array {
	$logo_file = get_stylesheet_directory() . '/assets/images/logo-delfina-lopez-benavente.png';

	if ( ! file_exists( $logo_file ) ) {
		return array(
			'success' => false,
			'message' => __( 'No se encontró el archivo logo-delfina-lopez-benavente.png en assets/images/', 'delfina-lopez-benavente' ),
		);
	}

	$file_content = file_get_contents( $logo_file );
	if ( false === $file_content ) {
		return array(
			'success' => false,
			'message' => __( 'Error al leer el archivo del logo.', 'delfina-lopez-benavente' ),
		);
	}

	$upload = wp_upload_bits( 'logo-delfina-lopez-benavente.png', null, $file_content );
	if ( ! empty( $upload['error'] ) ) {
		return array(
			'success' => false,
			'message' => $upload['error'],
		);
	}

	$attachment = array(
		'post_mime_type' => 'image/png',
		'post_title'     => 'Delfina López Benavente - Logo',
		'post_content'   => '',
		'post_status'    => 'inherit',
	);

	$attach_id = wp_insert_attachment( $attachment, $upload['file'] );
	if ( is_wp_error( $attach_id ) ) {
		return array(
			'success' => false,
			'message' => $attach_id->get_error_message(),
		);
	}

	require_once ABSPATH . 'wp-admin/includes/image.php';
	$attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
	wp_update_attachment_metadata( $attach_id, $attach_data );

	set_theme_mod( 'custom_logo', $attach_id );

	return array(
		'success' => true,
		'message' => __( 'Logo aplicado correctamente. Se mostrará en el header.', 'delfina-lopez-benavente' ),
	);
}

/**
 * Run header/footer setup: create elementor-hf templates for HFE.
 *
 * @return array{success: bool, message: string}
 */
function delfina_lopez_benavente_run_header_footer_setup(): array {
	if ( ! class_exists( '\Elementor\Plugin' ) ) {
		return array(
			'success' => false,
			'message' => __( 'Elementor no está activo.', 'delfina-lopez-benavente' ),
		);
	}

	if ( ! post_type_exists( 'elementor-hf' ) ) {
		return array(
			'success' => false,
			'message' => __( 'Header Footer Elementor no está activo.', 'delfina-lopez-benavente' ),
		);
	}

	$template_dir = get_stylesheet_directory() . '/templates/';
	$header_file  = $template_dir . 'dlf-header.json';
	$footer_file  = $template_dir . 'dlf-footer.json';

	if ( ! file_exists( $header_file ) || ! file_exists( $footer_file ) ) {
		return array(
			'success' => false,
			'message' => __( 'No se encontraron los archivos de plantilla.', 'delfina-lopez-benavente' ),
		);
	}

	$header_data = json_decode( (string) file_get_contents( $header_file ), true );
	$footer_data = json_decode( (string) file_get_contents( $footer_file ), true );

	if ( empty( $header_data['content'] ) || empty( $footer_data['content'] ) ) {
		return array(
			'success' => false,
			'message' => __( 'Archivos de plantilla inválidos.', 'delfina-lopez-benavente' ),
		);
	}

	$default_locations = array(
		'rule'     => array( 0 => 'basic-global' ),
		'specific' => array(),
	);

	$header_id = delfina_lopez_benavente_create_hfe_template(
		'DLB Header',
		'type_header',
		$header_data['content'],
		$default_locations
	);

	$footer_id = delfina_lopez_benavente_create_hfe_template(
		'DLB Footer',
		'type_footer',
		$footer_data['content'],
		$default_locations
	);

	if ( ! $header_id || ! $footer_id ) {
		return array(
			'success' => false,
			'message' => __( 'Error al crear las plantillas.', 'delfina-lopez-benavente' ),
		);
	}

	return array(
		'success' => true,
		'message' => __( 'Header y Footer configurados correctamente. Las plantillas están en Elementor > Header & Footer Builder.', 'delfina-lopez-benavente' ),
	);
}

/**
 * Create an elementor-hf template post.
 *
 * @param string $title    Post title.
 * @param string $type     ehf_template_type: type_header, type_footer.
 * @param array  $content  Elementor content array.
 * @param array  $locations Target include locations.
 * @return int Post ID or 0 on failure.
 */
function delfina_lopez_benavente_create_hfe_template( string $title, string $type, array $content, array $locations ): int {
	$post_id = wp_insert_post(
		array(
			'post_title'   => $title,
			'post_type'    => 'elementor-hf',
			'post_status'  => 'publish',
			'post_content' => '',
		)
	);

	if ( is_wp_error( $post_id ) || ! $post_id ) {
		return 0;
	}

	update_post_meta( $post_id, 'ehf_template_type', $type );
	update_post_meta( $post_id, 'ehf_target_include_locations', $locations );
	update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );
	update_post_meta( $post_id, '_elementor_template_type', $type );
	update_post_meta( $post_id, '_elementor_data', wp_json_encode( $content ) );

	if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
		$css_file = new \Elementor\Core\Files\CSS\Post( $post_id );
		$css_file->update();
	}

	return (int) $post_id;
}
