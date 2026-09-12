<?php
/**
 * Campos personalizados nativos (meta boxes), sem plugin.
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;

/**
 * Rótulos de um tipo de post.
 *
 * @param string $singular       Ex.: Produto.
 * @param string $plural         Ex.: Produtos.
 * @param string $singular_lower Ex.: produto.
 * @param string $plural_lower   Ex.: produtos.
 * @return array
 */
function mse_cpt_labels( $singular, $plural, $singular_lower, $plural_lower ) {
	return array(
		'name'               => $plural,
		'singular_name'      => $singular,
		'menu_name'          => $plural,
		'add_new'            => 'Adicionar',
		'add_new_item'       => 'Adicionar ' . $singular_lower,
		'edit_item'          => 'Editar ' . $singular_lower,
		'new_item'           => 'Novo ' . $singular_lower,
		'view_item'          => 'Ver ' . $singular_lower,
		'all_items'          => 'Todos os ' . $plural_lower,
		'search_items'       => 'Buscar ' . $plural_lower,
		'not_found'          => 'Nenhum item encontrado.',
		'not_found_in_trash' => 'Nenhum item na lixeira.',
	);
}

/**
 * Registra uma meta box com campos simples para um tipo de post.
 *
 * Campo: chave de meta => array( label, type, help?, options?, default? ).
 * Tipos: text, url, number, textarea, select, checkbox, gallery.
 *
 * @param string $post_type Tipo de post.
 * @param string $title     Título da caixa.
 * @param array  $fields    Campos.
 */
function mse_register_meta_box( $post_type, $title, $fields ) {
	add_action(
		'add_meta_boxes_' . $post_type,
		function () use ( $post_type, $title, $fields ) {
			add_meta_box( 'mse-campos-' . $post_type, $title, 'mse_render_meta_box', $post_type, 'normal', 'high', array( 'fields' => $fields ) );
		}
	);

	add_action(
		'save_post_' . $post_type,
		function ( $post_id ) use ( $post_type, $fields ) {
			mse_save_meta_box( $post_id, $post_type, $fields );
		}
	);
}

/**
 * Imprime os campos da meta box.
 *
 * @param WP_Post $post Post.
 * @param array   $box  Dados da caixa (args.fields).
 */
function mse_render_meta_box( $post, $box ) {
	wp_nonce_field( 'mse_meta_' . $post->post_type, 'mse_meta_nonce' );

	foreach ( $box['args']['fields'] as $key => $field ) {
		$type  = $field['type'];
		$value = get_post_meta( $post->ID, $key, true );
		if ( '' === $value && isset( $field['default'] ) && 'auto-draft' === $post->post_status ) {
			$value = $field['default'];
		}
		$id = 'mse-' . sanitize_html_class( $key );

		echo '<div class="mse-field mse-field--' . esc_attr( $type ) . '">';

		switch ( $type ) {
			case 'textarea':
				printf( '<label for="%1$s">%2$s</label><textarea id="%1$s" name="%3$s" rows="5">%4$s</textarea>', esc_attr( $id ), esc_html( $field['label'] ), esc_attr( $key ), esc_textarea( $value ) );
				break;

			case 'select':
				printf( '<label for="%1$s">%2$s</label><select id="%1$s" name="%3$s">', esc_attr( $id ), esc_html( $field['label'] ), esc_attr( $key ) );
				foreach ( $field['options'] as $option => $option_label ) {
					printf( '<option value="%1$s"%2$s>%3$s</option>', esc_attr( $option ), selected( $value, $option, false ), esc_html( $option_label ) );
				}
				echo '</select>';
				break;

			case 'checkbox':
				printf( '<label><input type="checkbox" name="%1$s" value="1"%2$s> %3$s</label>', esc_attr( $key ), checked( $value, '1', false ), esc_html( $field['label'] ) );
				break;

			case 'gallery':
				$ids = array_filter( array_map( 'absint', explode( ',', (string) $value ) ) );
				echo '<div class="mse-gallery">';
				printf( '<label>%s</label>', esc_html( $field['label'] ) );
				printf( '<input type="hidden" name="%1$s" value="%2$s">', esc_attr( $key ), esc_attr( implode( ',', $ids ) ) );
				echo '<ul class="mse-gallery__preview">';
				foreach ( $ids as $attachment_id ) {
					echo '<li>' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '</li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				echo '</ul>';
				echo '<button type="button" class="button mse-gallery__select">Selecionar imagens</button> ';
				echo '<button type="button" class="button-link mse-gallery__clear">Remover todas</button>';
				echo '</div>';
				break;

			case 'number':
				printf( '<label for="%1$s">%2$s</label><input type="number" min="1" step="1" id="%1$s" name="%3$s" value="%4$s">', esc_attr( $id ), esc_html( $field['label'] ), esc_attr( $key ), esc_attr( $value ) );
				break;

			default:
				printf( '<label for="%1$s">%2$s</label><input type="text" id="%1$s" name="%3$s" value="%4$s">', esc_attr( $id ), esc_html( $field['label'] ), esc_attr( $key ), esc_attr( $value ) );
		}

		if ( ! empty( $field['help'] ) ) {
			echo '<p class="description">' . esc_html( $field['help'] ) . '</p>';
		}

		echo '</div>';
	}
}

/**
 * Salva os campos da meta box.
 *
 * @param int    $post_id   ID do post.
 * @param string $post_type Tipo de post.
 * @param array  $fields    Campos.
 */
function mse_save_meta_box( $post_id, $post_type, $fields ) {
	if ( ! isset( $_POST['mse_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['mse_meta_nonce'] ) ), 'mse_meta_' . $post_type ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || wp_is_post_revision( $post_id ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	foreach ( $fields as $key => $field ) {
		$raw = isset( $_POST[ $key ] ) ? wp_unslash( $_POST[ $key ] ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

		switch ( $field['type'] ) {
			case 'textarea':
				$value = sanitize_textarea_field( $raw );
				break;
			case 'checkbox':
				$value = $raw ? '1' : '';
				break;
			case 'number':
				$value = '' === $raw ? '' : (string) absint( $raw );
				break;
			case 'gallery':
				$value = implode( ',', array_filter( array_map( 'absint', explode( ',', (string) $raw ) ) ) );
				break;
			case 'select':
				$value = array_key_exists( $raw, $field['options'] ) ? $raw : '';
				break;
			case 'url':
				$value = mse_sanitize_link( $raw );
				break;
			default:
				$value = sanitize_text_field( $raw );
		}

		update_post_meta( $post_id, $key, $value );
	}
}

add_filter( 'enter_title_here', 'mse_title_placeholder', 10, 2 );

/**
 * Placeholder do título por tipo de post.
 *
 * @param string  $text Texto padrão.
 * @param WP_Post $post Post.
 * @return string
 */
function mse_title_placeholder( $text, $post ) {
	$placeholders = array(
		'mse_produto'    => 'Nome do produto',
		'mse_cliente'    => 'Nome da empresa',
		'mse_depoimento' => 'Nome de quem deu o depoimento',
	);
	return isset( $placeholders[ $post->post_type ] ) ? $placeholders[ $post->post_type ] : $text;
}

add_action( 'admin_enqueue_scripts', 'mse_admin_assets' );

/**
 * Estilos dos campos e seletor de imagens nas telas de edição do tema.
 *
 * @param string $hook Tela atual.
 */
function mse_admin_assets( $hook ) {
	$screen = get_current_screen();
	if ( ! $screen || ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) || ! in_array( $screen->post_type, array( 'mse_produto', 'mse_cliente', 'mse_depoimento' ), true ) ) {
		return;
	}

	wp_register_style( 'mse-admin', false, array(), MSE_VERSION );
	wp_enqueue_style( 'mse-admin' );
	wp_add_inline_style(
		'mse-admin',
		'.mse-field{margin:0 0 18px}.mse-field>label,.mse-gallery>label{display:block;margin-bottom:4px;font-weight:600}.mse-field input[type=text],.mse-field input[type=number],.mse-field textarea,.mse-field select{width:100%;max-width:680px}.mse-gallery__preview{display:flex;flex-wrap:wrap;gap:8px;margin:8px 0;padding:0;list-style:none}.mse-gallery__preview img{display:block;width:80px;height:80px;object-fit:cover;border-radius:4px}'
	);

	if ( 'mse_produto' === $screen->post_type ) {
		wp_enqueue_media();
		wp_enqueue_script( 'mse-admin', MSE_URI . '/assets/js/admin.js', array( 'jquery' ), MSE_VERSION, true );
	}
}
