<?php
/**
 * Tipo de post Clientes: logos da faixa "Nossos clientes" (Figma 5051:163).
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', 'mse_register_cliente' );

/**
 * Registra o tipo de post.
 */
function mse_register_cliente() {
	$labels = array_merge(
		mse_cpt_labels( 'Cliente', 'Clientes', 'cliente', 'clientes' ),
		array(
			'featured_image'        => 'Logo',
			'set_featured_image'    => 'Definir logo',
			'remove_featured_image' => 'Remover logo',
			'use_featured_image'    => 'Usar como logo',
		)
	);

	register_post_type(
		'mse_cliente',
		array(
			'labels'        => $labels,
			'public'        => false,
			'show_ui'       => true,
			'show_in_rest'  => true,
			'menu_position' => 21,
			'menu_icon'     => 'dashicons-groups',
			'supports'      => array( 'title', 'thumbnail', 'page-attributes' ),
		)
	);
}

mse_register_meta_box(
	'mse_cliente',
	'Exibição do logo',
	array(
		'_mse_logo_altura' => array(
			'label'   => 'Altura do logo (px)',
			'type'    => 'number',
			'default' => '40',
			'help'    => 'A largura acompanha a proporção. Envie o arquivo com o dobro do tamanho exibido para telas de alta densidade.',
		),
	)
);

add_filter( 'manage_mse_cliente_posts_columns', 'mse_cliente_columns' );

/**
 * Coluna de logo na listagem.
 *
 * @param array $columns Colunas.
 * @return array
 */
function mse_cliente_columns( $columns ) {
	return array_slice( $columns, 0, 1, true ) + array( 'mse_logo' => 'Logo' ) + array_slice( $columns, 1, null, true );
}

add_action( 'manage_mse_cliente_posts_custom_column', 'mse_cliente_column_content', 10, 2 );

/**
 * Conteúdo da coluna de logo.
 *
 * @param string $column  Coluna.
 * @param int    $post_id Post.
 */
function mse_cliente_column_content( $column, $post_id ) {
	if ( 'mse_logo' === $column && has_post_thumbnail( $post_id ) ) {
		echo get_the_post_thumbnail( $post_id, array( 120, 40 ), array( 'style' => 'max-height:40px;width:auto;background:#fff' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
